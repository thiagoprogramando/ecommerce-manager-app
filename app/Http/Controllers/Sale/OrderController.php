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
        $order->customer_id             = $request->customer_id;
        $order->name                    = $request->name;
        $order->value                   = $request->value;
        $order->status                  = 1;
        $order->payment_method          = $request->method;
        $order->payment_installments    = $request->installments;
        $order->payment_token           = $token;
        $order->license                 = Auth::user()->api_key;
        if($order->save()) {

            Cart::where('customer_id', $request->customer_id)
                ->whereNull('payment_token')
                ->update(['payment_token' => $token, 'status' => 1]);

                return redirect()->route('adm.list-orders')->with('success', 'Pedido concluído com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível finalizar o carrinho!');
    }

    public function updateOrder(Request $request) {

        $order = Order::find($request->order_id);
        if ($order) {

            $order->tracking_code           = $request->tracking_code ?? null;
            $order->payment_method          = $request->payment_method;
            $order->payment_installments    = $request->payment_installments;
            $order->status                  = $request->status;

            if ($order->save()) {
                return redirect()->back()->with('success', 'Dados alterados com sucesso!');
            }

            return redirect()->back()->with('error', 'Não foi possível alterar os dados!');
        }

        return redirect()->back()->with('error', 'Não foi possível alterar os dados!');
    }

    public function deleteOrder(Request $request) {

        $order = Order::find($request->id);
        if($order && $order->delete()) {
            return redirect()->back()->with('success', 'Pedido cancelado com sucesso!');
        }

        return redirect()->back()->with('error', 'Nenhum pedido encontrado!');
    }
}
