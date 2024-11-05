<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest('id')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    // app/Http/Controllers/OrderController.php

    // app/Http/Controllers/OrderController.php

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $nonReversibleStatuses = ['completed', 'cancelled'];

        if (!in_array($order->status, $nonReversibleStatuses)) {
            $order->status = $request->input('status'); // Cập nhật trạng thái
            $order->save();

            return redirect()->route('admin.orders.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
        } else {
            return redirect()->route('admin.orders.index')->with('error', 'Không thể thay đổi trạng thái của đơn hàng này.');
        }
    }
    // app/Http/Controllers/OrderController.php

    public function invoice($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('admin.orders.invoice', compact('order'));
    }
    public function pdfInvoice($id)
    {
        $order = Order::with('items')->findOrFail($id);
        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));
        return $pdf->download('invoice_' . $order->id . '.pdf');
    }
    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
