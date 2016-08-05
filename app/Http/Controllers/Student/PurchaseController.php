<?php

namespace App\Http\Controllers\Student;

use App\Models\Course\Lecture;
use App\Models\Course\Order;
use App\Models\Course\Tutorial;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate();

        $tutorials = Tutorial::orderByLatest()->paginate();

        $lectures = Lecture::orderByLatest()->paginate();

        return $this->frontView('purchases.index', compact('orders', 'tutorials', 'lectures'));
    }
}
