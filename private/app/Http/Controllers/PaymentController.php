<?php

namespace App\Http\Controllers;

use App\UserClass;
use Illuminate\Http\Request;
use Larabookir\Gateway\PortInterface;
use Larabookir\Gateway\Zarinpal\Zarinpal;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
//        return $request->all();

        $this->validate($request, [
                'class_id' => 'required|exists:class_rooms,id',
                'gateway_id' => 'required',
        ]);

        if (\Auth::check()) {
            $user = auth()->user();

            $user_class = new UserClass();
            $user_class->user_id = $user->id;
            $user_class->classroom_id = $request->class_id;
            $user_class->status = 1;
            $user_class->save();

            if ($user_class) {
                return view('main_template.pages.message')
                        ->with('type', 'success')
                        ->with('title', __('messages.global.success'))
                        ->with('message', __('messages.global.success-description'));
            } else {
                return view('main_template.pages.message')
                        ->with('type', 'error')
                        ->with('title', __('messages.global.error'))
                        ->with('message', __('messages.global.error-description'));
            }
        }
        return response()->json(['message' => 'unauthenticated!'], 401);

    }

    public function pay(Request $request)
    {
        try {

            /** @var Zarinpal $gateway */
            $gateway = \Gateway::make('payir');

            $gateway->setCallback(url(session('lang') . '/payment/callback')); // You can also change the callback
            $gateway->price(1000)
                    // setShipmentPrice(10) // optional - just for paypal
                    // setProductName("My Product") // optional - just for paypal
                    ->ready();

            $refId = $gateway->refId(); // شماره ارجاع بانک
            $transID = $gateway->transactionId(); // شماره تراکنش

            // در اینجا
            //  شماره تراکنش  بانک را با توجه به نوع ساختار دیتابیس تان
            //  در جداول مورد نیاز و بسته به نیاز سیستم تان
            // ذخیره کنید .

            return $gateway->redirect();

        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        try {
            /** @var PortInterface $gateway */
            $gateway = \Gateway::verify($request->transaction_id);
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();
dd($trackingCode,$refId,$cardNumber);
            // تراکنش با موفقیت سمت بانک تایید گردید
            // در این مرحله عملیات خرید کاربر را تکمیل میکنیم

        } catch (\Larabookir\Gateway\Exceptions\RetryException $e) {

            // تراکنش قبلا سمت بانک تاییده شده است و
            // کاربر احتمالا صفحه را مجددا رفرش کرده است
            // لذا تنها فاکتور خرید قبل را مجدد به کاربر نمایش میدهیم

            echo $e->getMessage() . "<br>";

        } catch (\Exception $e) {

            // نمایش خطای بانک
            echo $e->getMessage();
        }
    }
}
