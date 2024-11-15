<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdvController extends Controller {
    
    public function pdv(Request $request) {

        if($request->client) {
            $client = User::find($request->client);
            $itens  = Cart::where('customer_id', $client->id)->whereNull('payment_token')->orderBy('id', 'desc')->get();
        } else {
            $client = false;
            $itens  = [];
        }

        return view('app.Order.PDV.pdv', [
            'client'    => $client,
            'clients'   => User::where('api_key', Auth::user()->api_key)->where('type', 4)->orderBy('name', 'asc')->get(),
            'products'  => Product::where('license', Auth::user()->api_key)->orderBy('name', 'asc')->get(),
            'itens'     => $itens
        ]);
    }

    public function addPdv(Request $request) {

        $product = Product::find($request->product_id);
        if(($product->stock !== null && $product->stock < 1) || $product->status != 1) {
            return redirect()->back()->with('error', 'Produto indisponível no momento!');
        }

        if(($product->stock < $request->qtd) && $product->stock != null) {
            return redirect()->back()->with('error', 'Quantidade excede o estoque!');
        }

        $cart = new Cart();
        $cart->name         = $product->name;
        $cart->qtd          = max(1, $request->qtd);
        $cart->value        = ($product->value * max(1, $request->qtd));
        $cart->customer_id  = $request->client_id;
        $cart->product_id   = $product->id;
        $cart->license      = Auth::user()->api_key;
        if($cart->save()) {
            return redirect()->back()->with('success', 'Produto adicionado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível adicionar o produto!');
    }

    public function removePdv(Request $request) {

        $cart = Cart::find($request->id);
        if($cart && $cart->delete()) {
            return redirect()->back()->with('success', 'Produto removido com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível remover o Produto!');
    }
}
