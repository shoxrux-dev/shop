<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultstringLength(191);
        Paginator::useBootstrap();

        $categories = Category::where('parent_id', null)->get();
        View::share('categories', $categories);

//        $carts = Cart::where('user_id', Auth::id())->get();
//        View::share('carts', $carts);

        View::composer('*', function($view){
            $carts = Cart::where('user_id', Auth::id())->get();
            $view->with(['carts' => $carts]);
        });

    }
}
