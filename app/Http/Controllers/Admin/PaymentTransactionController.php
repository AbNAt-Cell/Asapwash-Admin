<?php


namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\AppUsers;
use App\Booking;
use App\BookingMaster;
use App\Category;
use App\Http\Controllers\Controller;
use App\PaymentTransaction;
use App\ShopOwner;
use App\SubCategory;
use App\VehicleModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gate;
use DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Artisan;
use Session;
use Illuminate\Support\Facades\Redirect;
use LicenseBoxAPI;
class PaymentTransactionController extends Controller
{
    //
    public function index(Request $request)
    {
        abort_if(Gate::denies('earning_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $st = Carbon::parse('01/02/2020');
        $et = Carbon::today();
        $intr = 10;
        $length = $st->diffInDays($et);
        $loop = $length / $intr;
        $loop = (int) floor($loop);
        $master = array();
        for ($i = 0; $i < $loop; $i++) {
            $temp = array();
            $temp['start_date']  = $st->toDateString();
            $st->addDays($intr);
            $temp['end_date']  =    $st->toDateString();
            array_push($master, $temp);
            $st->addDay();
        }
        $temp['start_date']  = $st->toDateString();
        $temp['end_date']  =     $et;
        array_push($master, $temp);
        $temp =   $master = array_reverse($master);
        if ($request->has('index')) {
            $temp = $master[$request->index];

            $earingD = PaymentTransaction::whereBetween('created_at', [$temp['start_date'], $temp['end_date']])->with('owner:id,name')->groupBy('owner_id')->get(['id', 'owner_id', 'created_at']);
        } else {
            $earingD = PaymentTransaction::with('owner:id,name')->groupBy('owner_id')->get(['id', 'owner_id', 'created_at']);
        }
        foreach ($earingD as $value) {
            $pt = PaymentTransaction::where('owner_id', $value['owner_id'])->get();
            $value['d_total_task'] = $pt->count();
            $value['d_admin_share'] = $pt->sum('admin_share');
            $value['d_owner_share'] = $pt->sum('owner_share');
            $value['d_total_amount'] = $value['d_admin_share'] + $value['d_owner_share'];

            $remainingOnline = PaymentTransaction::where([['owner_id', $value['owner_id']], ['shattle', 0], ['payment', 0]])->get();

            $remainingOffline = PaymentTransaction::where([['owner_id', $value['owner_id']], ['shattle', 0], ['payment', 1]])->get();

            $online =   $remainingOnline->sum('owner_share'); // admin e devana
            $offline =  $remainingOffline->sum('admin_share'); // admin e levana

            $value['d_balance'] = $offline  -  $online;  // + hoy to levana  - devana 
        }
        $currency = AdminSetting::first()->currency_symbol;

        // return $earingD;
        return view('admin.earning.index', compact(['earingD', 'currency', 'master']));
    }

    public function show(Request $request)
    {

        abort_if(Gate::denies('earning_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $provider =   ShopOwner::find($request->owner_id);
        $provider['currency'] = AdminSetting::first()->currency_symbol;
        $earning = array();
        $pt = PaymentTransaction::where('owner_id', $request->owner_id)->get();

        foreach ($pt as $value) {
            $pb =  BookingMaster::find($value['booking_id']);
            // $pb->load(['category:id,name', 'service:id,name']);
            $value['bookingData'] = $pb;
        }

        $earning['data'] = $pt;
        $earning['d_total_task'] = $pt->count();
        $earning['d_admin_share'] = $pt->sum('admin_share');
        $earning['d_owner_share'] = $pt->sum('owner_share');
        $earning['d_total_amount'] = $earning['d_admin_share'] + $earning['d_owner_share'];

        $remainingOnline = PaymentTransaction::where([['owner_id', $request->owner_id], ['shattle', 0], ['payment', 0]])->get();

        $remainingOffline = PaymentTransaction::where([['owner_id', $request->owner_id], ['shattle', 0], ['payment', 1]])->get();

        $online =   $remainingOnline->sum('owner_share'); // admin e devana
        $offline =  $remainingOffline->sum('admin_share'); // admin e levana

        $earning['d_admin_to_provider'] = $online;
        $earning['d_provider_to_admin'] = $offline;

        $earning['d_balance'] = $offline  -  $online;  // + hoy to levana  - devana 
        return view('admin.earning.show', compact(['earning', 'provider']));
    }
    public function settle(Request $request)
    {
        abort_if(Gate::denies('earning_settle'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        PaymentTransaction::where([['owner_id',  $request->owner_id], ['shattle', 0]])->update(['shattle' => 1]);
        return redirect()->route('earning.index')->withStatus(__('Payment are settle to paid'));
    }

    public function dashboard(Request $request)
    {
        $api = new \LicenseBoxExternalAPI();
$res = $api->verify_license();
if ($res['status'] !== true) {
    Artisan::call('down');
    abort(503);
}

        abort_if(Gate::denies('dashboard'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $master = array();
        $master['currency'] = AdminSetting::first()->currency_symbol;
        $master['all_user'] = AppUsers::all()->count();
        $master['today_user'] = AppUsers::whereDate('created_at', Carbon::today())->get()->count();

        $master['all_owner'] = ShopOwner::all()->count();
        $master['today_owner'] = ShopOwner::whereDate('created_at', Carbon::today())->get()->count();

        $master['all_booking'] = BookingMaster::all()->count();
        $master['today_booking'] = BookingMaster::whereDate('created_at', Carbon::today())->get()->count();

        $master['category'] = Category::all()->count();
        $master['car_model'] = VehicleModel::all()->count();

        $master['waiting_booking'] =   BookingMaster::where('status', 0)->count();
        $master['complete_booking'] =   BookingMaster::where('status', 2)->count();
        $master['cancel_booking'] =   BookingMaster::where('status', 3)->count();
        $master['rejected_booking'] =   BookingMaster::where('status', 5)->count();




        $monthDate = Carbon::now()->subMonths(5);
        // dd(Carbon::now()->startOfMonth()->toDateTimeString(), Carbon::now()->endOfMonth()->toDateTimeString());
        //
        // 
        $earning = array();
        $counting = array();
        $monthName = array();
        for ($i = 0; $i < 6; $i++) {
            # code...
            $start = $monthDate->copy()->startOfMonth()->toDateTimeString();
            $end = $monthDate->copy()->endOfMonth()->toDateTimeString();
            $count =      BookingMaster::whereBetween('start_time', array($start, $end))->count();
            $payment = BookingMaster::where('payment_status', 1)->whereBetween('start_time', array($start, $end))->get();

            array_push($earning, $payment->sum('amount'));
            array_push($counting, $count);
            array_push($monthName, $monthDate->format('M'));
            $monthDate->addMonth();
        }
        $master['earning'] = json_encode($earning);
        $master['bookingCount'] =  json_encode($counting);
        $master['monthName'] = json_encode($monthName);


        return view('dashboard', compact('master'));
    }

    public function randomReportIndex()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider = ShopOwner::all();
        $req = array();
        $req['provider'] = 'provider';
        $req['payment'] = 'all';
        $req['status'] = 'all';
        return view('admin.report.index', compact(['provider', 'req']));
    }
    // public function randomReportGenerate(Request $request)
    // {
    //     abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $fd = $request->from . " 00:00:00";
    //     $td = $request->to . " 00:00:00";

    //     $data =   DB::select("select * from `payment_transaction` where (`owner_id` = $request->provider and `payment` = $request->payment and `shattle` = $request->status) and `created_at` between '$fd' and '$td'");

    //     $master =  array();
    //     foreach ($data as  $value) {
    //         $bhk =  Booking::find($value->booking_id);
    //         $bhk->load('provider');
    //         $temp['job_id'] = $bhk['booking_id'];
    //         $temp['job_date'] = $bhk['created_at']->format('Y-m-d');
    //         $temp['provider_name'] = $bhk['provider']['name'];
    //         $temp['total'] = $value->admin_share + $value->owner_share;
    //         $temp['admin_share'] = $value->admin_share;
    //         $temp['owner_share'] =  $value->owner_share;
    //         $temp['payment_type'] = $value->payment;
    //         $temp['paid'] =  $value->payment;
    //         $date = Carbon::parse($value->created_at);
    //         $temp['time'] =  $date->format('Y-m-d');
    //         array_push($master, $temp);
    //     }
    //     $provider = ShopOwner::all();
    //     $req = $request->all();
    //     $req['currency'] = AdminSetting::first()->currency_symbol;
    //     return view('admin.report.index', compact(['provider', 'master', 'req']));
    //     // return $master;
    //     // return PaymentTransaction::with(['provider:id,name', 'booking:id,booking_id,created_at'])->where([['owner_id', $request->provider], ['payment', $request->payment], ['shattle', $request->status]])->whereBetween('created_at', array($request->from . " 00:00:00", $request->to . " 00:00:00"))->get();
    //     // dd($request->all());
    // }
}
