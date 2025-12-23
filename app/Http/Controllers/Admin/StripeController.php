<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    //
    public function updateStripe(Request $request)
    {
        $data = [
            'STRIPE_KEY' => $request->STRIPE_KEY,
            'STRIPE_SECRET' => $request->STRIPE_SECRET,
        ];
        //  country_code
        try {
            (new AdminSettingController)->updateENV($data);
        } catch (\Throwable $th) {
        }

        $stipe_status = 0;
        if ($request->stipe_status == '1') {
            $stipe_status = 1;
        } else {

            $stipe_status = 0;
        }
        $pp = AdminSetting::get()->first();
        $pp->stipe_status = $stipe_status;
        $pp->update();
        // return "true";
        return redirect('setting')->withStatus(__('Stripe Configuration updated successfully.'));
    }
    public function updatePaypal(Request $request)
    {

        $data = [
            'P_PRODUCTION_CLIENT_ID' => $request->P_PRODUCTION_CLIENT_ID,
            'P_SANDBOX_CLIENT_ID' => $request->P_SANDBOX_CLIENT_ID,
        ];
        //  country_code
        try {
            (new AdminSettingController)->updateENV($data);
        } catch (\Throwable $th) {
        }

        $paypal_status = 0;
        if ($request->paypal_status == '1') {
            $paypal_status = 1;
        } else {

            $paypal_status = 0;
        }
        $pp = AdminSetting::get()->first();
        $pp->paypal_status = $paypal_status;
        $pp->update();
        // return "true";
        return redirect('setting')->withStatus(__('Paypal Configuration updated successfully.'));
    }
    public function updateRazor(Request $request)
    {
        $data = [
            'RAZOR_ID' => $request->RAZOR_ID,
        ];
        //  country_code
        try {
            (new AdminSettingController)->updateENV($data);
        } catch (\Throwable $th) {
        }

        $razor_status = 0;
        if ($request->razor_status == '1') {
            $razor_status = 1;
        } else {

            $razor_status = 0;
        }
        $pp = AdminSetting::get()->first();
        $pp->razor_status = $razor_status;
        $pp->update();
        // return "true";
        return redirect('setting')->withStatus(__('RazorPay Configuration updated successfully.'));
    }

    public function makePayment($amt, $token, $cur)
    {
        try {
            $stripe = new Stripe(env('STRIPE_SECRET'));
            $charge1 = $stripe->charges()->create([
                'currency' => $cur,
                'amount' => (float) $amt * 100,
                'source' => $token,
            ]);
            return ['charge_id' => $charge1['id'], 'status' => true];
        } catch (\Throwable $th) {
            // throw  $th;
            return ['charge_id' => '', 'status' => false];
        }
    }
}
