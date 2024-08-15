<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TranferController extends Controller {
    
    public function transfers(Request $request) {

        $startDate = Auth::user()->created_at->toDateString();
        $finishDate = now()->toDateString();

        if($request->startDate) {
            $startDate = Carbon::parse($request->startDate)->toDateString();
        }

        if($request->finishDate) {
            $finishDate = Carbon::parse($request->finishDate)->toDateString();
        }

        $client = new Client();
        $response = $client->request('GET',  env('API_URL_ASSAS') . "v3/financialTransactions?startDate={$startDate}&finishDate={$finishDate}&order=desc", [
            'headers' => [
                'accept'        => 'application/json',
                'access_token'  => Auth::user()->api_key,
                'User-Agent'    => env('APP_NAME')
            ],
            'verify' => false,
        ]);

        $body = (string) $response->getBody();
        if ($response->getStatusCode() === 200) {
            
            $data = json_decode($body, true);
            $transfers = array_filter($data['data'], function($item) {
                return $item['type'] === 'TRANSFER';
            });
            
            return view('app.Finance.transfers', [
                'transfers' => $transfers
            ]);
        } else {
            return [];
        }
    }
}
