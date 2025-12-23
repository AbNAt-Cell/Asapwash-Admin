<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\AppUsers;
use App\BookingMaster;
use App\Http\Controllers\Controller;
use App\Notifications;
use App\OwnerShop;
use App\ShopEmployee;
use App\ShopOwner;
use App\StaticNoti;
use Berkayk\OneSignal\OneSignalClient;
use Gate;
use Illuminate\Http\Request;
use OneSignal;
use Config;
use Symfony\Component\HttpFoundation\Response;

class StaticNotiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if ($d = '') {
        } elseif ($d = "") {
        }
        abort_if(Gate::denies('notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $notis = StaticNoti::all();
        return view('admin.staticNotification.index', compact(['notis']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaticNoti  $staticNoti
     * @return \Illuminate\Http\Response
     */
    public function show(StaticNoti $staticNoti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaticNoti  $staticNoti
     * @return \Illuminate\Http\Response
     */
    public function edit(StaticNoti $staticNoti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaticNoti  $staticNoti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        abort_if(Gate::denies('notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        StaticNoti::find($id)->update($request->all());
        return back()->withStatus(__('Notification updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaticNoti  $staticNoti
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaticNoti $staticNoti)
    {
        //
    }
    public function customIndex()
    {
        abort_if(Gate::denies('custom_notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = AppUsers::all();

        return view('admin.customNotification.index', compact(['users']));
    }
    public function customUser(Request $request)
    {
        abort_if(Gate::denies('custom_notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tag = ['{{user_name}}'];

        $users = AppUsers::whereIn('id', $request->users)->where('device_token', '!=', null)->get(['name', 'id', 'device_token']);

        $title = $request->title;
        $sub_title = $request->sub_title;
        foreach ($users as $value) {
            # code...
            $replace = array($value['name']);
            $new_title = $this->tagReplace($title, $tag, $replace);
            $new_sub_title = $this->tagReplace($sub_title, $tag, $replace);

            $deviceTokens = array_filter(explode(',', $value['device_token']));

            // Send notification using OneSignal
            if (!empty($deviceTokens)) {
                $this->sendNotificationToMultipleTokens($deviceTokens, $new_sub_title, $new_title, 'user');
            }
        }
        return back()->withStatus(__('Notification sent successfully'));
    }

    private function tagReplace($string, $tag, $replace)
    {
        $new = str_replace($tag, $replace, $string);
        return $new;
    }

    public function baseNotification($arrayOfIDs, $type)
    {
        $user = AppUsers::find($arrayOfIDs['user_id']);
        $employee = $arrayOfIDs['employee_id'] ? ShopEmployee::find($arrayOfIDs['employee_id']) : null;
        $owner = ShopOwner::find($arrayOfIDs['owner_id']);

        if (AdminSetting::first()->notification == 0 ) {
            return false;
        }

        $noti = StaticNoti::find($type);
        $booking = BookingMaster::find($arrayOfIDs['bid']);


        $tag = ['{{user_name}}', '{{shop_name}}', '{{booking_date}}', '{{booking_id}}', '{{employee_name}}', '{{user_address}}'];
        $replace = [$user->name, OwnerShop::find($booking->shop_id)->name, $booking->start_time, $booking->booking_id, $employee?->name ?? '', $booking->address];
        $new_title = str_replace($tag, $replace, $noti->title);
        $new_sub_title = str_replace($tag, $replace, $noti->sub_title);

        $deviceTokens = [];
        $userType = '';

        switch ($noti->for_who) {
            case 0: // User
                Notifications::create([
                    'booking_id' => $arrayOfIDs['bid'],
                    'user_id' => $arrayOfIDs['user_id'],
                    'title' => $new_title,
                    'sub_title' => $new_sub_title,
                ]);
                if ($user->noti == 1) {
                    $deviceTokens = array_filter(explode(',', $user->device_token));
                    $userType = 'user';
                }
                break;

            case 1: // Owner
                Notifications::create([
                    'booking_id' => $arrayOfIDs['booking_id'],
                    'owner_id' => $arrayOfIDs['owner_id'],
                    'title' => $new_title,
                    'sub_title' => $new_sub_title,
                ]);
                if ($owner->noti == 1) {
                    $deviceTokens = array_filter(explode(',', $owner->device_token));
                    $userType = 'owner';
                }
                break;

            case 2: // Employee
                Notifications::create([
                    'booking_id' => $arrayOfIDs['booking_id'],
                    'emp_id' => $arrayOfIDs['employee_id'],
                    'sender_id' => $arrayOfIDs['user_id'],
                    'title' => $new_title,
                    'sub_title' => $new_sub_title,
                ]);
                if ($employee?->noti == 1) {
                    $deviceTokens = array_filter(explode(',', $employee->device_token));
                    $userType = 'employee';
                }
                break;
        }

        // Send notification using OneSignal
        if (!empty($deviceTokens)) {
            $this->sendNotificationToMultipleTokens($deviceTokens, $new_sub_title, $new_title, $userType);
        }
    }

    public function baseNotificationEmployee($arrayOfIDs, $type)
    {
        $user = AppUsers::find($arrayOfIDs['user_id']);
        $employee = $arrayOfIDs['employee_id'] ? ShopEmployee::find($arrayOfIDs['employee_id']) : null;
        $owner = ShopOwner::find($arrayOfIDs['owner_id']);

        if (AdminSetting::first()->notification == 0) {
            return false;
        }

        $noti = StaticNoti::find($type);
        $booking = BookingMaster::find($arrayOfIDs['bid']);


        $tag = ['{{user_name}}', '{{shop_name}}', '{{booking_date}}', '{{booking_id}}', '{{employee_name}}', '{{user_address}}'];
        $replace = [$user->name, OwnerShop::find($booking->shop_id)->name, $booking->start_time, $booking->booking_id, $employee?->name ?? '', $booking->address];
        $new_title = str_replace($tag, $replace, $noti->title);
        $new_sub_title = str_replace($tag, $replace, $noti->sub_title);

        $deviceTokens = [];
        $userType = '';

        switch ($noti->for_who) {
            case 0: // User
                Notifications::create([
                    'booking_id' => $arrayOfIDs['bid'],
                    'user_id' => $arrayOfIDs['user_id'],
                    'title' => $new_title,
                    'sub_title' => $new_sub_title,
                ]);
                if ($user->noti == 1) {
                    $deviceTokens = array_filter(explode(',', $user->device_token));
                    $userType = 'user';
                }
                break;

            case 1: // Owner
                Notifications::create([
                    'booking_id' => $arrayOfIDs['booking_id'],
                    'owner_id' => $arrayOfIDs['owner_id'],
                    'title' => $new_title,
                    'sub_title' => $new_sub_title,
                ]);
                if ($owner->noti == 1) {
                    $deviceTokens = array_filter(explode(',', $owner->device_token));
                    $userType = 'owner';
                }
                break;

            case 2: // Employee
                Notifications::create([
                    'booking_id' => $arrayOfIDs['booking_id'],
                    'emp_id' => $arrayOfIDs['employee_id'],
                    'sender_id' => $arrayOfIDs['user_id'],
                    'title' => $new_title,
                    'sub_title' => $new_sub_title,
                ]);
                if ($employee?->noti == 1) {
                    $deviceTokens = array_filter(explode(',', $employee->device_token));
                    $userType = 'employee';
                }
                break;
        }

        // Send notification using OneSignal
        if (!empty($deviceTokens)) {
            $this->sendNotificationToMultipleTokens($deviceTokens, $new_sub_title, $new_title, $userType);
        }
    }

    private function sendNotificationToMultipleTokens($deviceTokens, $sub, $header, $whichAPIKey)
    {
        try {
            $apiKey = null;
            $appID = null;
            switch ($whichAPIKey) {
                case 'user':
                    $apiKey = env('REST_API_KEY');
                    $appID = env('APP_ID');
                    break;
                case 'owner':
                    $apiKey = env('REST_API_KEY_OWNER');
                    $appID = env('APP_ID_OWNER');
                    break;
                case 'employee':
                    $apiKey = env('REST_API_KEY_EMPLOYEE');
                    $appID = env('APP_ID_EMPLOYEE');
                    break;
            }

            // Using async method to send notification in background, also because we dont need response from it in the current context
            $client = new OneSignalClient($appID, $apiKey, Config::get('onesignal.user_auth_key'));
            $client->async()->sendNotificationCustom([
                'headings' => ['en' => $header],
                'contents' => ['en' => $sub],
                'include_player_ids' => $deviceTokens,
            ]);
        } catch (\Exception $e) {
            info($e->getMessage());
        }
    }

    public function updateOnesignl(Request $request)
    {
        $data = [
            'APP_ID' => $request->APP_ID,
            'APP_ID_OWNER' => $request->APP_ID_OWNER,
            'APP_ID_EMPLOYEE' => $request->APP_ID_EMPLOYEE,
            'REST_API_KEY' => $request->REST_API_KEY,
            'REST_API_KEY_OWNER' => $request->REST_API_KEY_OWNER,
            'REST_API_KEY_EMPLOYEE' => $request->REST_API_KEY_EMPLOYEE,
            'USER_AUTH_KEY' => $request->USER_AUTH_KEY,
            'PROJECT_NUMBER' => $request->PROJECT_NUMBER,
        ];
        //  country_code
        try {
            (new AdminSettingController)->updateENV($data);
        } catch (\Exception $e) {
            info($e->getMessage());
        }

        // return "true";
        return redirect('setting')->withStatus(__('Onesignal Configuration updated successfully.'));
    }
}
