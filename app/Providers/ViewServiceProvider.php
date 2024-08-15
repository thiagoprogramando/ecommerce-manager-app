<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Models\Category;


class ViewServiceProvider extends ServiceProvider {

    public function register(): void {
        //
    }

    public function boot(): void {

        View::composer('*', function ($view) {
            $categories = collect(); // Inicializa como uma coleção vazia

            if (Auth::check()) {
                $categories = Category::where('license', Auth::user()->api_key)->get();
            }

            // Compartilha as categorias com todas as views
            $view->with('categories', $categories);
        });
    }
}
