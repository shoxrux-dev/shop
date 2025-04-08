<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'product_color_id' => ['required', 'integer', 'exists:product_colors,id'],
            'product_size_id' => ['required', 'integer', 'exists:sizes,id'],
            'product_quantity' => ['required', 'integer'],
        ]);

        $product_id = $request->input('product_id');
        $product_color_id = $request->input('product_color_id');
        $product_size_id = $request->input('product_size_id');
        $product_quantity = $request->input('product_quantity');

        if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
            return back()->with('alreadyAdded', 'Product already added to cart!');
        } else {
            $cart = new Cart();
            $cart['user_id'] = Auth::id();
            $cart['product_id'] = $product_id;
            $cart['product_color_id'] = $product_color_id;
            $cart['product_size_id'] = $product_size_id;
            $cart['product_quantity'] = $product_quantity;
            $cart->save();
        }

        return back()->with('success', 'Successfully added to cart!');
    }

    public function deleteFromCart(int $cartId)
    {
        if(Cart::where('id', $cartId)->where('user_id', Auth::id())->exists()) {
            $cart = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();
            $cart->delete();
            return back()->with('success', 'Successfully removed from cart!');
        }
    }

}
