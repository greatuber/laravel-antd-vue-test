<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;

class PagesController extends Controller
{
    //
    public function index ()
    {
        $orders = Order::paginate(40);
        $totalOrders = Order::count();
        $page = request()->query('page') ? (int) request()->query('page'):1;
        return Inertia::render('Index', [
            'title' => 'Hello, this is working!',
            'ordersProp' => $orders,
            'pageProp' => $page,
            'totalOrdersProp' => $totalOrders
        ]);
    }

    public function ordersPaginated ()
    {
        $page = request()->query('page');
        $pageSize = request()->query('pageSize');
        $orders = Order::offset($page)
            ->limit($pageSize)
            ->get();
        return response()->json($orders);
    }
}
