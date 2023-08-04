<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){

        $wishlist = wishlist::where('user_id',Auth::id())->get();
        return view('Frontend.whishlist',compact('wishlist'));
    }

    public function add(Request $request){
        
        $prod_id = $request->input('product_id');

        if(Auth::check()){

            $prod_check = Product::where('id',$prod_id)->first();

            if ($prod_check) 
            {
                if(wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status' => 'warning', 'message' => $prod_check->name. " Already Added to Wishlist"]);
                }
                else{

                    $wishlist = new wishlist();
                    $wishlist->prod_id = $prod_id;
                    $wishlist->user_id = Auth::id();
                    $wishlist->save();
                    return response()->json(['status' => 'success', 'message' => $prod_check->name." Product Added to Cart"]);
                    
                }
            }
            
        }
        else{
            return response()->json(['status' => 'warning', 'message' => "Login Now!!"]);

        }
    }

    public function delete(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            if(wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $wish = wishlist::where('prod_id',$prod_id)->where('user_id', Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "Item removed from wishlist!"]);
            }
        }
        else{
            return response()->json(['status' => "Login to Continue"]);
        }
    }
}
