<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index', [
            'transactions' => Order::with('order_details','table')->get(),
        ]);
    }

    public function destroy(Order $order)
    {
        OrderDetail::where('order_id', $order->id)->delete();
        $order->delete();  
        return to_route('transaction.index')->with('message','Berhasil Hapus Data Transaksi');     
    }

    public function print(Order $order) 
    {
        return view('transaction.print', [
            'order' => $order,
            'setting' => Setting::first(),
        ]);
    }
}
