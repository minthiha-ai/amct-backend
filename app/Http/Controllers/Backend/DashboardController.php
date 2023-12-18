<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class DashboardController extends Controller
{
    public function index()
    {
        $topProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_orders'))
            ->join('order_items', 'products.id', 'order_items.product_id')
            ->groupBy('order_items.product_id')
            ->with('images')
            ->active()
            ->orderBy('total_orders', 'desc')
            ->limit(5)
            ->get();
        $topCustomers = Customer::select('customers.*', DB::raw('SUM(orders.grand_total) as total_sales'))
            ->join('orders', 'orders.customer_id', 'customers.id')
            ->groupBy('customers.id')
            ->orderBy('total_sales', 'desc')
            ->limit(5)
            ->get();
        return view('backend.dashboard.index')->with(['topProducts' => $topProducts, 'topCustomers' => $topCustomers]);
    }

    public function deleteNoti($id)
    {
        $noti = DatabaseNotification::where('id', $id)->first();
        if (!$noti) return abort(404);
        $noti->delete();
        return redirect()->back();
    }
}