<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::with('images')->get();
        $product = Product::query()->latest('id')->take(5)->get();
        $products = Product::query()->latest('id')->take(8)->get();
        $categories = Category::all();
        return view('client.layouts.home', compact('product', 'products', 'categories', 'banners'));
    }
    public function detail(string $id)
    {
        $categories = Category::all();
        $products = Product::query()->latest('id')->take(4)->get();
        $product = DB::table('products')
            ->where('id', $id)
            ->first();

        return view('client.layouts.detail', compact('product', 'products', 'categories'));
    }
    public function shop()
    {

        $products = Product::query()->latest('id')->take(8)->get();
        $categories = Category::all();
        return view('client.layouts.shop', compact('products', 'categories'));
    }
    public function shopByCategory($iddm)
    {
        $categories = Category::all();
        $selectedCategory = Category::findOrFail($iddm);
        $products = Product::where('category_id', $selectedCategory->id)->get();
        return view('client.layouts.shop', compact('selectedCategory', 'products', 'categories'));
    }
    public function search(Request $request)
    {
        $categories = Category::all();
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        return view('client.layouts.shop', compact('products','query','categories'));
    }
    public function contact(){
        return view('client.layouts.contact');
    }
    
}
