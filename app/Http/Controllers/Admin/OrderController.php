<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $orders = Order::query();

        if ($request->date != null) {
            $orders->whereDate('created_at', $request->date);
        }

        if ($request->status != null) {
            $orders->where('status_message', 'LIKE', '%' . $request->status . '%');
        }

        $orders = $orders->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }
    public function show(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            return view('admin.orders.view', compact('order'));
        } else {
            return redirect('admin/orders')->with('message', 'Order not found');
        }
    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            $order->update([
                'status_message' => $request->order_status
            ]);

            return redirect('admin/orders/' . $orderId)->with('message', 'Order Status Updated Successfully!');
        } else {
            return redirect('admin/orders/' . $orderId)->with('message', 'Order not found');
        }
    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];

        $todayDate = Carbon::now()->format('d-m-Y');
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        return $pdf->download('invoice-' . $order->id . '-' . $todayDate . '.pdf');
    }
}
