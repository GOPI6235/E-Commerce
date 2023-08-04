<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;
use App\Models\Rating;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($slug)
    {
        
        if(Product::where('slug', $slug)->firstOrFail()->exists())
            {
                $products = Product::where('slug', $slug)->first();
                $ratings = Rating::where('prod_id', $products->id)->get();
                $rating_sum = Rating::where('prod_id', $products->id)->sum('star_rated');
                $user_rating = Rating::where('prod_id', $products->id)->where('user_id', Auth::id())->first();

                $product_qty = Cart::where('user_id', Auth::id())->where('prod_id', $products->id)->value('prod_qty');
                $isInCart = Auth::check() && Auth::user()->carts()->where('prod_id', $products->id)->exists();


                if($ratings->count() > 0)
                {
                    $rating_value = $rating_sum/$ratings->count();
                }
                else
                {
                    $rating_value = 0;
                }
                return view('Frontend.products.view', compact('products','ratings','rating_value','user_rating','product_qty','isInCart'));
            }
            else{
                return redirect('/')->with('status',"The link was broken");
            }

        return view('products.show', compact('product'));
    }


    public function quickView($id)
    {
        $product = Product::find($id);
        return view('quick_view', compact('product'));
    }
}
