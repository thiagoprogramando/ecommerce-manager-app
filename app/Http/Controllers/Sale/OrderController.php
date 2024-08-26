<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    
    public function listOrders(Request $request) {

        $orders = Order::where('license', Auth::user()->api_key)->orderBy('id', 'desc')->paginate(30);
        return view('app.Order.order', [
            'orders' => $orders
        ]);
    }

    public function createOrder(Request $request) {

        $token = rand(0, 999) . strtoupper(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'))[0] . rand(0, 99) . strtoupper(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'))[0] . rand(999, 999999999999);

        $order                          = new Order();
        $order->name                    = $request->name;
        $order->value                   = $request->value;
        $order->status                  = 1;
        $order->payment_method          = $request->method;
        $order->payment_installments    = $request->installments;
        $order->payment_token           = $token;
        $order->license                 = Auth::user()->api_key;
        if($order->save()) {

            Cart::where('customer_id', $request->customer_id)
                ->whereNull('token_pay')
                ->update(['token_pay' => $token, 'status' => 1]);

                return redirect()->route('adm.list-orders')->with('success', 'Pedido concluído com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível finalizar o carrinho!');
    }

    public function deleteOrder(Request $request) {

        $order = Order::find($request->id);
        if($order) {

            if(empty($order->payment_token) && $order->delete()) {
                return redirect()->back()->with('success', 'Pedido cancelado com sucesso!');
            }
 
            if(!empty($order->payment_token) && $order->status != 1 && $order->status != 2) {

                $cancel = $this->cancelInvoice($order->payment_token);
                if(($cancel == 1 || $cancel == true) && $order->delete()) {
                    return redirect()->back()->with('success', 'Pedido cancelado com sucesso!');
                } else {
                    return redirect()->back()->with('error', 'Não foi possível cancelar o Pedido!');
                }
            }

            return redirect()->back()->with('error', 'Não foi possível cancelar o Pedido!');
        }

        return redirect()->back()->with('error', 'Nenhum pedido encontrado!');
    }

    private function cancelInvoice($token) {

        $client = new Client();
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => Auth::user()->api_key,
                'User-Agent'   => env('APP_NAME')
            ],
            'verify' => false
        ];

        $response = $client->delete(env('API_URL_ASSAS') . 'v3/payments/'.$token, $options);
        $body = (string) $response->getBody();
        
        if ($response->getStatusCode() === 200) {
            $data = json_decode($body, true);
    
            if(isset($data['deleted']) && $data['deleted'] == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
