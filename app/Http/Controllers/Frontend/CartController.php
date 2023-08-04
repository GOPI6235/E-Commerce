<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\category;
use App\Models\Product;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addproduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check())
        {
            $prod_check = Product::where('id',$product_id)->first();

            if ($prod_check) 
            {
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status' => 'warning', 'message' => $prod_check->name. " Already Added to Cart"]);
                }
                else{

                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => 'success', 'message' => $prod_check->name." Product Added to Cart"]);

                }
            }
        }else{
            return response()->json(['status' => 'warning', 'message' => "Login to Continue"]);
        }
    }

    // public function viewCart()
    // {
    //     $cartItems = DB::table('carts')
    //         ->join('products', 'carts.prod_id', '=', 'products.id')
    //         ->join('categories', 'products.category_id', '=', 'categories.id')
    //         ->where('carts.user_id', Auth::id())
    //         ->select('carts.*', 'products.name as product_name', 'products.image as product_image', 'products.selling_price as product_price', 'categories.name as category_name', 'categories.slug as category_slug')
    //         ->get();

    //     return view('Frontend.cart', compact('cartItems'));
    // }
    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product.category')
            ->get();
        
        return view('Frontend.cart', compact('cartItems'));
    }

    public function updatecart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if(Auth::check())
        {
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => "Quantity Updated"]);
            }
        }
    }

    public function deleteproduct(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = Cart::where('prod_id',$prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Product Deleted!"]);
            }
        }
        else{
            return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function cartcount()
    {
        $cartcount = Cart::where('user_id', Auth::id())->count();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

        return response()->json(['cartCount' => $cartcount, 'wishlistCount' => $wishlistCount]);
    }
}
