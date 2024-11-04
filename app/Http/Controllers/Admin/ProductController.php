<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';
    public function index()
    {
        $data = Product::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__,compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->except('img_thumb');
        if ($request->hasFile('img_thumb')) {
            $data['img_thumb'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumb'));
        } else {
            $data['img_thumb'] = '';
        }
        Product::query()->create($data);
        return redirect()->route('admin.products.index')->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->except('img_thumb');
       
        if ($request->hasFile('img_thumb')) {
            $data['img_thumb'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumb'));
            if(!empty($product->img_thumb) && Storage::exists($product->img_thumb)) {
                Storage::delete($product->img_thumb);
            }
           
        } else {
            $data['img_thumb'] = $product->img_thumb;
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Xóa thành công');
    }
}
