<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirm;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function cart()
    {
        $category = Category::all();
        return view('client.layouts.cart', compact('category'));
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price_sale,
            'qty' => 1,
            'options' => [
                'image' => $product->img_thumb,
            ],
        ]);
        return redirect()->back()->with('success', 'Cart added successfully');
    }

    public function qtyIncrement($rowId)
    {
        $product = Cart::get($rowId);
        Cart::update($rowId, $product->qty + 1);

        return redirect()->back();
    }

    public function qtyDecrement($rowId)
    {
        $product = Cart::get($rowId);
        if ($product->qty > 1) {
            Cart::update($rowId, $product->qty - 1);
        }

        return redirect()->back();
    }

    public function removeProduct($rowId)
    {
        Cart::remove($rowId);

        if (Cart::count() === 0) {
            session()->forget('cart.discount'); // Xóa giảm giá khi giỏ hàng trống
        }
        return redirect()->back()->with('error', 'xóa sản phẩm thành công');
    }
    public function checkout()
    {
     
        $cartItems = Cart::content();
        $subtotal = Cart::subtotal();
        $discount = session('cart.discount', 0); 
        return view('client.layouts.checkout', compact('cartItems', 'subtotal', 'discount'));
    }

    public function applyVoucher(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $voucher = Voucher::where('code', $request->code)->first();

        if (!$voucher) {
            return redirect()->back()->with('error', 'Invalid voucher code.');
        }
        if ($voucher->expires_at && $voucher->expires_at < now()) {
            return redirect()->back()->with('error', 'Voucher has expired.');
        }

        if (Cart::count() > 0) {
            // Lấy tổng giá trị giỏ hàng sau khi format
            $cartSubtotal = floatval(str_replace(',', '', Cart::subtotal()));

            $discountAmount = 0;

            if ($voucher->type == 'fixed') {
                $discountAmount = floatval($voucher->value);
            } elseif ($voucher->type == 'percentage') {
                $discountAmount = ($cartSubtotal * floatval($voucher->value)) / 100;
            }

            // Đặt giá trị vào session
            session(['cart.discount' => $discountAmount]);

            return redirect()->back()->with('success', 'Voucher applied successfully.');
        } else {
            // Giỏ hàng trống, xóa voucher khỏi session
            session()->forget('cart.discount');
            return redirect()->back()->with('info', 'Cart is empty. Voucher removed.');
        }
    }

}
