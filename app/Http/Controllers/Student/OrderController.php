<?php

namespace App\Http\Controllers\Student;

use App\Models\Course\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate();

        return $this->frontView('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $lecture = Lecture::find($id);

        return $this->frontView('lectures.show', compact('lecture'));
    }
}
