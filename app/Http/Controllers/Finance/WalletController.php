<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WalletController extends Controller {
    
    public function wallet() {

        return view('app.Finance.wallet', [
            'wallet'       => $this->balance(Auth::user()->api_key),
            'split'        => $this->splits(Auth::user()->api_key),
            'statistic'    => $this->statistics(Auth::user()->api_key),
            'extracts'     => $this->extracts(Auth::user()->api_key),
        ]);
    }

    //Saldo na conta
    private function balance($api_key) {

        $client = new Client();
        $response = $client->request('GET',  env('API_URL_ASSAS') . 'v3/finance/balance', [
            'headers' => [
                'accept'       => 'application/json',
                'access_token' => $api_key,
                'User-Agent'   => env('APP_NAME')
            ],
            'verify' => false,
        ]);

        $body = (string) $response->getBody();
        if ($response->getStatusCode() === 200) {

            $data = json_decode($body, true);
            return $data['balance'];
        } else {
            return false;
        }
    }

    //Extrato
    private function extracts($api_key) {

        $client = new Client();
        $user = User::where('api_key', $api_key)->first();
        $startDate = $user->created_at->toDateString();
        $finishDate = now()->toDateString();

        $response = $client->request('GET',  env('API_URL_ASSAS') . "v3/financialTransactions?startDate={$startDate}&finishDate={$finishDate}&order=desc", [
            'headers' => [
                'accept'        => 'application/json',
                'access_token'  => $user->api_key,
                'User-Agent'    => env('APP_NAME')
            ],
            'verify' => false,
        ]);

        $body = (string) $response->getBody();
        if ($response->getStatusCode() === 200) {
            $data = json_decode($body, true);
            return $data['data'];
        } else {
            return [];
        }
    }

    //Recebivéis
    private function statistics($api_key) {

        $client = new Client();
        $response = $client->request('GET',  env('API_URL_ASSAS') . 'v3/finance/payment/statistics', [
            'headers' => [
                'accept'        => 'application/json',
                'access_token'  => $api_key,
                'User-Agent'    => env('APP_NAME')
            ],
            'verify' => false,
        ]);

        $body = (string) $response->getBody();
        if ($response->getStatusCode() === 200) {

            $data = json_decode($body, true);
            return $data['value'];
        } else {

            return false;
        }
    }

    //Comissões
    private function splits($api_key) {

        $client = new Client();
        $response = $client->request('GET',  env('API_URL_ASSAS') . 'v3/finance/split/statistics', [
            'headers' => [
                'accept'       => 'application/json',
                'access_token' => $api_key,
                'User-Agent'   => env('APP_NAME')
            ],
            'verify' => false,
        ]);

        $body = (string) $response->getBody();
        if ($response->getStatusCode() === 200) {

            $data = json_decode($body, true);
            return $data['income'];
        } else {
            return false;
        }
    }

    public function transferWallet(Request $request) {
        
        $password = $request->password;    
        if (Hash::check($password, auth()->user()->password)) {

            if(empty($request->key) || empty($request->value) || empty($request->type)) {
                return redirect()->back()->with('error', 'Dados incompletos!');
            }
    
            $transferSend = $this->transferSend($request->key, $this->formatarValor($request->value), $request->type);
    
            if($transferSend['success']) {
                return redirect()->back()->with('success', $transferSend['message']);
            }
    
            return redirect()->back()->with('error', 'Não foi possível realizar saque: '.$transferSend['message']);
        }

        return redirect()->back()->with('error', 'Senha inválida!');
    }

    private function transferSend($key, $value, $type) {

        $client = new Client();
        $user = auth()->user();

        try {
            $response = $client->request('POST', env('API_URL_ASSAS').'v3/transfers', [
                'headers' => [
                    'accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                    'access_token' => $user->api_key,
                    'User-Agent'   => env('APP_NAME')
                ],
                'json' => [
                    'value'             => $value,
                    'operationType'     => 'PIX',
                    'pixAddressKey'     => $key,
                    'pixAddressKeyType' => $type,
                    'description'       => 'Saque '.$user->name,
                ],
                'verify'  => false,
            ]);
    
            $body = $response->getBody()->getContents();
            $decodedBody = json_decode($body, true);
    
            if ($decodedBody['status'] === 'PENDING') {
                return ['success' => true, 'message' => 'Saque agendado com sucesso'];
            } else {
                return ['success' => false, 'message' => 'Situação do Saque: ' . $decodedBody['status']];
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->getResponse();
            $body = $response->getBody()->getContents();
            $decodedBody = json_decode($body, true);
    
            return ['success' => false, 'message' => $decodedBody['errors'][0]['description']];
        }
    }

    private function formatarValor($valor) {
        
        $valor = preg_replace('/[^0-9,.]/', '', $valor);
        $valor = str_replace(['.', ','], '', $valor);

        return number_format(floatval($valor) / 100, 2, '.', '');
    }

}
