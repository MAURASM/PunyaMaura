<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SupplierOrderController extends Controller
{

    public function index()
    {
        $orders = Order::join('products', 'products.product_id', '=', 'orders.order_product_id')
            ->join('users', 'users.id', '=', 'orders.order_reseller_id')
            ->where('orders.order_supplier_id', auth()->user()->id)
            ->orderby('orders.order_id', 'desc')
            ->get();

        return view('supplier.order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        Order::where('order_id', $id)->update([
            'order_status' => $request->order_status,
            'order_note' => $request->order_note
        ]);

        return redirect()->route('supplier.order.index')->with('success', 'Pesanan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        //
    }

    public function history()
    {


        $orders = Order::join('products', 'products.product_id', '=', 'orders.order_product_id')
            ->join('users', 'users.id', '=', 'orders.order_reseller_id')
            ->where('orders.order_supplier_id', auth()->user()->id)
            ->where('orders.order_status', '=', 'Selesai')
            ->orderby('orders.order_id', 'desc')
            ->get();



        return view('supplier.order.history', compact('orders'));
    }
}
