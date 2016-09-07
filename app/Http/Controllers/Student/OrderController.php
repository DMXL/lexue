<?php

namespace App\Http\Controllers\Student;

use App\Models\Course\Order;
use App\Models\Course\Lecture;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $student;

    /**
     * LectureController constructor.
     */
    public function __construct()
    {
        $this->student = authUser();
    }

    public function index()
    {
        $orders = $this->student->orders()
            ->where('is_lecture', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->frontView('wechat.orders.index', compact('orders'));
    }

    public function show()
    {
        //
    }
}
