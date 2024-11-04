<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.categories.';
    const PATH_UPLOAD = 'categories';
    public function index()
    {
        $category = Category::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->except('cover');
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        } else {
            $data['cover'] = '';
        }
        Category::query()->create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->except('cover');
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));

            if(!empty($category->cover) && Storage::exists($category->cover)) {
                Storage::delete($category->cover);
            }
        } else {
            $data['cover'] = $category->cover;
        }
        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'chuyển vào thùng rác');
    }
    public function trashed()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.categories.trash', compact('categories'));
    }
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('admin.categories.index')->with('success', 'Khôi phục thành công');
    }
    public function forcedelete($id)
    {
        // Xóa hình ảnh nếu tồn tại
        $category = Category::onlyTrashed()->findOrFail($id);
        if (!empty($category->cover) && Storage::exists($category->cover)) {
            Storage::delete($category->cover);
        }

        // Xóa hoàn toàn bản ghi khỏi cơ sở dữ liệu
        $category->forceDelete();
    
        // Chuyển hướng và thông báo thành công
        return redirect()->route('admin.categories.index')->with('success', 'Xóa thành công');
    }
    
}
