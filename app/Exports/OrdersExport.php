<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Lấy dữ liệu đơn hàng để xuất ra file Excel
     */
    public function collection()
    {
        return Order::select(
            'id', 'user_id', 'first_name', 'last_name', 'email', 'mobile', 
            'address_1', 'address_2', 'country', 'city', 'state', 'zip', 
            'payment_method', 'total', 'status'
        )->with('user')->get();
    }

    /**
     * Định nghĩa tiêu đề của các cột
     */
    public function headings(): array
    {
        return [
            'Order ID',
            'User ID',
            'First Name',
            'Last Name',
            'Email',
            'Mobile',
            'Address 1',
            'Address 2',
            'Country',
            'City',
            'State',
            'Zip Code',
            'Payment Method',
            'Total',
            'Status',
        ];
    }

    /**
     * Định nghĩa cách hiển thị dữ liệu trong từng hàng
     */
    public function map($order): array
    {
        return [
            $order->id,
            $order->user_id,
            $order->first_name,
            $order->last_name,
            $order->email,
            $order->mobile,
            $order->address_1,
            $order->address_2,
            $order->country,
            $order->city,
            $order->state,
            $order->zip,
            $order->payment_method,
            $order->total,
            $order->status,
        ];
    }
}
