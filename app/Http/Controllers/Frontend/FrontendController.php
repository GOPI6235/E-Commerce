<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Rating;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FrontendController extends Controller
{
    public function index()
    {
        $mostSellingProducts = DB::table('products')
        ->select('products.id', 'products.name', 'products.slug', 'products.description', 'products.image', 'products.selling_price', 'products.original_price', DB::raw('SUM(order_items.qty) as total_sold'))
        ->join('order_items', 'products.id', '=', 'order_items.prod_id')
        ->groupBy('products.id', 'products.name', 'products.slug', 'products.description', 'products.image', 'products.selling_price', 'products.original_price')
        ->orderByDesc('total_sold')
        ->take(5)
        ->get();

        $mostSellingCategories = DB::table('categories')
        ->select('categories.name', 'categories.slug', 'categories.description', 'categories.image', DB::raw('SUM(order_items.qty) as total_sold'))
        ->join('products', 'categories.id', '=', 'products.cate_id')
        ->join('order_items', 'products.id', '=', 'order_items.prod_id')
        ->groupBy('categories.id', 'categories.name', 'categories.slug', 'categories.description', 'categories.image')
        ->orderByDesc('total_sold')
        ->take(4)
        ->get();
        
        
        $products = Product::where('trending','1')->take(4)->get();
        $category = category::where('popular','1')->get();
        return view('Frontend.index', compact('mostSellingProducts', 'mostSellingCategories','products','category'));
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
            if(Product::where('slug', $prod_slug)->firstorFail()->exists())
            {
                $products = Product::where('slug', $prod_slug)->first();
              
                $ratings = Rating::where('prod_id', $products->id)->get();
                $rating_sum = Rating::where('prod_id', $products->id)->sum('star_rated');
                $user_rating = Rating::where('prod_id', $products->id)->where('user_id', Auth::id())->first();

                $product_qty = Cart::where('user_id', Auth::id())->where('prod_id', $products->id)->value('prod_qty');


                $isInCart = Auth::check() && Auth::user()->carts()->where('prod_id', $products->id)->exists();


                if($ratings->count() > 0){
                    $rating_value = $rating_sum/$ratings->count();
                }
                else{
                    $rating_value = 0;
                }
                return view('Frontend.products.view', compact('products','ratings','rating_value','user_rating','product_qty','isInCart'));
            }
            else{
                return redirect('/')->with('status',"The link was broken");
            }
        }
        else{
            return redirect('/')->with('status',"category not fund");
        }
    }

    public function indexproductview($cate_id, $prod_id)
    {
        if(category::where('id', $cate_id)->exists())
        {
            if(Product::where('id', $prod_id)->firstorFail()->exists())
            {
                $products = Product::where('slug', $prod_id)->first();
               
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
