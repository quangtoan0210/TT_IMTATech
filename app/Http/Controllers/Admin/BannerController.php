<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Banner;
use App\Models\BannerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::with('images')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'images.*' => 'required|image', // Mỗi file phải là một hình ảnh
            'status' => 'required|boolean',
        ]);

        $banner = Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('banner_images');
                $banner->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'images.*' => 'nullable|image',
        'status' => 'required|boolean',
    ]);

    // Cập nhật thông tin banner
    $banner->update([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    // Kiểm tra xem có ảnh nào được tải lên không
    if ($request->hasFile('images')) {
        // Xóa các ảnh hiện tại
        foreach ($banner->images as $image) {
            Storage::delete($image->image_path); // Xóa ảnh cũ khỏi bộ nhớ
            $image->delete(); // Xóa bản ghi ảnh khỏi cơ sở dữ liệu
        }

        // Lưu các ảnh mới
        foreach ($request->file('images') as $image) {
            $path = $image->store('banner_images');
            $banner->images()->create(['image_path' => $path]);
        }
    }

    return redirect()->route('admin.banners.index')->with('success', 'Cập nhật banner thành công.');
}


    public function destroy(Banner $banner)
    {
        foreach ($banner->images as $image) {
            Storage::delete($image->image_path);
        }
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
