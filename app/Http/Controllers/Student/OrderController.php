<?php

namespace App\Http\Controllers\Student;

use App\Models\Course\Order;
use Carbon\Carbon;
use EasyWeChat\Payment\Order as PaymentOrder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $student;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->student = authUser();
    }

    public function index()
    {
        $raw = $this->student->lectures();
        $lecturesDesc = $raw->orderByLatest()->get();
        $lecturesAsc = $raw->orderByEarliest()->get();

        $upcoming = $lecturesAsc->filter(function($lecture) {
            return $lecture->start_time >= Carbon::now();
        });

        $ongoing = $lecturesDesc->filter(function($lecture) {
            return ($lecture->start_time < Carbon::now() && $lecture->end_time >= Carbon::now());
        });

        $finished = $lecturesDesc->filter(function($lecture) {
            return $lecture->end_time < Carbon::now();
        });

        return $this->frontView('wechat.orders.index', compact('upcoming', 'ongoing', 'finished'));
    }

    public function show()
    {
        //
    }

    public function pay($id)
    {
        $order = Order::find($id);

        $tradeInfo = array(
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => 'iPad mini 16G 白色',
            'detail'           => 'iPad mini 16G 白色',
            'out_trade_no'     => '5K8264ILTKCH16CQ2502SI8ZNMTM67VS',
            'total_fee'        => 0.01,
            'notify_url'       => route('m.students::orders.callback.lecture'), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
        );
        $attributes = \WechatCashier::prepay($tradeInfo);

        $apiList = array('chooseWXPay');
        $configs = \WechatCashier::config($apiList);

        return $this->frontView('wechat.orders.pay', compact('order', 'attributes', 'configs'));
    }

    public function handleLecturePaymentCallback()
    {

    }
}
