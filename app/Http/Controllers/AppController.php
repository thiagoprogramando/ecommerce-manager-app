<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller {
    
    public function app() {

        $sale   = Order::where('license', Auth::user()->api_key)->where('status', 1)->get();
        $sent   = Order::where('license', Auth::user()->api_key)->where('status', 3)->get();
        $order  = Order::where('license', Auth::user()->api_key)->where('status', 0)->get();

        $products = Product::where('license', Auth::user()->api_key)->limit(10)->get();

        $views = View::where('license', Auth::user()->api_key)->selectRaw('MONTH(created_at) as month, COUNT(*) as total_views')->groupBy('month')->orderBy('month')->get();
        $labels = ['Jan', 'Fev', 'Mar', 'Abril', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        $data = array_fill(0, 12, 0);

        foreach ($views as $view) {
            $data[$view->month - 1] = $view->total_views;
        }

        return view('app.app', [
            'sale'     => $sale,
            'sent'     => $sent,
            'order'    => $order,
            'products' => $products,
            'labels'   => $labels,
            'data'     => $data
        ]);
    }

    public function search(Request $request) {

        $orders     = Order::where('name', 'LIKE', '%'.$request->search.'%')->where('license', Auth::user()->api_key)->get();
        $products   = Product::where('name', 'LIKE', '%'.$request->search.'%')->where('license', Auth::user()->api_key)->get();
        $users      = User::where('name', 'LIKE', '%'.$request->search.'%')->where('api_key', Auth::user()->api_key)->get();

        return view('app.Manager.search', [
            'search'     => $request->search,
            'orders'     => $orders,
            'products'   => $products,
            'users'      => $users,
        ]);
    }

}
