<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $feature_products = Product::where('trending','1')->take(4)->get();
        $trending_category = category::where('popular','1')->take(5)->get();
        return view('Frontend.index', compact('feature_products','trending_category'));
    }

    public function category()
    {
        $category = category::where('status',0)->get();
        return view('Frontend.category',compact('category'));
    }

    public function viewcategory($slug)
    {
        if(category::where('slug', $slug)->exists())
        {
            $category = category ::where('slug', $slug)->first();
            $products = Product::where('cate_id', $category->id)->where('status', '0')->get();
            return view('Frontend.products.index', compact('category','products'));
        }
        else
        {
            return redirect('/')->with('status', 'slug doesnot exists');
        }

    }

    public function productview($cate_slug, $prod_slug)
    {
        if(category::where('slug', $cate_slug)->exists())
        {
            if(Product::where('slug', $prod_slug)->exists())
            {
                $products = Product::where('slug', $prod_slug)->first();
                $ratings = Rating::where('prod_id', $products->id)->get();
                $rating_sum = Rating::where('prod_id', $products->id)->sum('star_rated');
                $user_rating = Rating::where('prod_id', $products->id)->where('user_id', Auth::id())->first();

                if($ratings->count() > 0)
                {
                    $rating_value = $rating_sum/$ratings->count();
                }
                else
                {
                    $rating_value = 0;
                }
                return view('Frontend.products.view', compact('products','ratings','rating_value','user_rating'));
            }
            else{
                return redirect('/')->with('status',"The link was broken");
            }
        }
        else{
            return redirect('/')->with('status',"category not fund");
        }
    }

    public function productlistajax()
    {
        $products = Product::where('name')->where('status', '0')->get();
        $data = [];

        foreach($products as $item)
        {
            $data[] = $item['name'];
        }

        return $data;
    }

    public function searchproduct(Request $request)
    {
        $search_product = $request->product_name;

        if($search_product != "")
        {
            $product = Product::where("name","like","%$search_product%")->first();
            if($product){
                return redirect('category/'.$product->category->slug.'/'.$product->slug);
            }
            else
            {
                return redirect()->back()->with('status', " Not Found");
            
            }
        }
        else{
            return redirect()->back();
        }
    }

}
