<?php

namespace App\Http\Controllers\ShopOwner;

use App\AdminSetting;
use App\AppUsers;
use App\BookingMaster;
use App\Category;
use App\Http\Controllers\AppHelper;
use App\OwnerShop;
use Illuminate\Http\Request;



use App\Http\Controllers\Controller;
use App\Http\Controllers\GoogleMapsHelper;
use App\Notifications;
use App\Package;
use App\SubCategories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = OwnerShop::where('owner_id', Auth::id())->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
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
        try {
            // Validate request
            $request->validate([
                'name' => 'bail|required',
                'address' => 'bail|required',
                'phone_no' => 'bail|required',
                'start_time' => 'bail|required',
                'end_time' => 'bail|required'
            ]);

            $reqData = $request->all();

            // Handle image upload
            if (isset($reqData['image'])) {
                $reqData['image'] = (new AppHelper)->saveBase64($reqData['image']);
            }

            // Handle coordinates - use provided lat/lng or geocode the address
            if (!isset($reqData['lat']) || !isset($reqData['lng'])) {
                $coords = GoogleMapsHelper::getCoordinates($reqData['address']);
                if ($coords) {
                    $reqData['lat'] = $coords['lat'];
                    $reqData['lng'] = $coords['lng'];
                }
            }

            // Get authenticated owner ID
            $ownerId = Auth::id();
            if (!$ownerId) {
                \Log::error('Shop creation failed: User not authenticated');
                return response()->json([
                    'msg' => 'Authentication required. Please log in again.',
                    'success' => false
                ], 401);
            }

            $reqData['owner_id'] = $ownerId;

            // Create shop
            $data = OwnerShop::create($reqData);

            \Log::info('Shop created successfully', ['shop_id' => $data->id, 'owner_id' => $ownerId]);

            return response()->json([
                'msg' => 'Shop added successfully',
                'data' => $data,
                'success' => true
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Shop creation validation error', ['errors' => $e->errors()]);
            return response()->json([
                'msg' => 'Validation failed',
                'errors' => $e->errors(),
                'success' => false
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Shop creation error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'msg' => 'Error creating shop: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OwnerShop  $ownerShop
     * @return \Illuminate\Http\Response
     */
    public function show($id, OwnerShop $ownerShop)
    {
        //
        $shop = OwnerShop::find($id)->setAppends(['imageUri', 'avg_rating', 'packageData', 'serviceData', 'employeeData']);
        $cat = SubCategories::whereIn('id', $shop->service_id)->pluck('cat_id')->unique();
        $shop['cate'] = Category::whereIn('id', $cat)->where('status', 1)->get(['id', 'name', 'icon']);
        return response()->json(['msg' => null, 'data' => $shop, 'success' => true], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OwnerShop  $ownerShop
     * @return \Illuminate\Http\Response
     */
    public function edit(OwnerShop $ownerShop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OwnerShop  $ownerShop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $reqData = $request->all();

        if (isset($reqData['image'])) {
            $reqData['image'] = (new AppHelper)->saveBase64($reqData['image']);
        }

        if (isset($reqData['address']) && (!isset($reqData['lat']) || !isset($reqData['lng']))) {
            $coords = GoogleMapsHelper::getCoordinates($reqData['address']);
            if ($coords) {
                $reqData['lat'] = $coords['lat'];
                $reqData['lng'] = $coords['lng'];
            }
        }

        OwnerShop::find($id)->update($reqData);
        $data = OwnerShop::find($id);
        return response()->json(['msg' => 'Shop  update successfully', 'data' => $data, 'success' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OwnerShop  $ownerShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(OwnerShop $ownerShop)
    {
        //
    }
    public function singleShop($id)
    {
        $shop = OwnerShop::find($id)->setAppends(['imageUri', 'avg_rating', 'packageData', 'serviceData',]);
        $cat = SubCategories::whereIn('id', $shop->service_id)->pluck('cat_id')->unique();
        $shop['cate'] = Category::whereIn('id', $cat)->where('status', 1)->get(['id', 'name', 'icon']);
        return response()->json(['msg' => null, 'data' => $shop, 'success' => true], 200);
    }
    public function shopServiceByCate($id, $catid)
    {

        $service_id = OwnerShop::find($id)->service_id;
        $cat = SubCategories::whereIn('id', $service_id)->where('cat_id', $catid)->get();
        return response()->json(['msg' => null, 'data' => $cat, 'success' => true], 200);
    }
    public function allShop()
    {

        $master = OwnerShop::where('status', 1)->get(['name', 'id', 'image', 'address']);
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }
    public function shopByCategory($id)
    {
        $ids = SubCategories::where([['cat_id', $id], ['status', 1]])->orderBy('owner_id')->pluck('owner_id');
        $master = OwnerShop::whereIn('owner_id', $ids)->where('status', 1)->get(['name', 'id', 'image', 'address']);
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }
    public function packageSingle($id)
    {
        return response()->json(['msg' => null, 'data' => Package::find($id), 'success' => true], 200);
    }
    public function waitingBooking()
    {
        # code...
        $data = BookingMaster::with(['user:id,name,image', 'shop:id,name'])->where([['owner_id', Auth::id()], ['status', 0]])->get(['id', 'start_time', 'end_time', 'status', 'address', 'shop_id', 'vehicle_id', 'service_type', 'booking_id', 'user_id', 'amount']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function allBooking()
    {
        $data = BookingMaster::with(['user:id,name,image', 'shop:id,name'])->where([['owner_id', Auth::id()]])->get(['id', 'start_time', 'end_time', 'status', 'address', 'shop_id', 'vehicle_id', 'service_type', 'booking_id', 'user_id', 'amount']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function shopBooking($id)
    {
        $data = BookingMaster::with(['user:id,name,image'])->where([['owner_id', Auth::id()], ['shop_id', $id]])->get(['id', 'start_time', 'end_time', 'status', 'address', 'shop_id', 'vehicle_id', 'service_type', 'booking_id', 'user_id', 'amount']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function homeIndex()
    {
        $b = BookingMaster::where([['owner_id', Auth::id()], ['status', 2]])->whereDate('created_at', Carbon::today())->get();
        $h = BookingMaster::where([['owner_id', Auth::id()], ['service_type', 0]])->whereDate('created_at', Carbon::today())->get();
        $o = BookingMaster::where([['owner_id', Auth::id()], ['service_type', 1]])->whereDate('created_at', Carbon::today())->get();
        $master = array();
        $master['data'] = $b->count();
        $master['income'] = $b->sum('amount');
        $master['home_data'] = $h->count();
        $master['home_income'] = $h->sum('amount');
        $master['shop_data'] = $o->count();
        $master['shop_income'] = $o->sum('amount');
        $master['currency'] = AdminSetting::first()->currency_symbol;
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }
    public function homeIndexEmp()
    {
        $b = BookingMaster::where([['employee_id', Auth::id()], ['status', 2]])->whereDate('created_at', Carbon::today())->get();
        $h = BookingMaster::where([['employee_id', Auth::id()], ['service_type', 0]])->whereDate('created_at', Carbon::today())->get();
        $o = BookingMaster::where([['employee_id', Auth::id()], ['service_type', 1]])->whereDate('created_at', Carbon::today())->get();
        // $b = BookingMaster::where('owner_id',Auth::id());
        $master = array();
        $master['data'] = $b->count();
        $master['income'] = $b->sum('amount');
        $master['home_data'] = $h->count();
        $master['home_income'] = $h->sum('amount');
        $master['shop_data'] = $o->count();
        $master['shop_income'] = $o->sum('amount');
        $master['currency'] = AdminSetting::first()->currency_symbol;
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }
    public function notification()
    {
        $data = Notifications::where('owner_id', Auth::id())->orderBy('created_at', "desc")->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function searchByLocation(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $lat = $request->lat;
        $lng = $request->lng;
        $radius = $request->radius ?? 50; // default 50km


        if (DB::connection() instanceof \Illuminate\Database\SQLiteConnection) {
            $pdo = DB::connection()->getPdo();
            $pdo->sqliteCreateFunction('acos', 'acos', 1);
            $pdo->sqliteCreateFunction('cos', 'cos', 1);
            $pdo->sqliteCreateFunction('radians', 'deg2rad', 1);
            $pdo->sqliteCreateFunction('sin', 'sin', 1);
        }

        // Use raw SQL for SQLite compatibility with distance filtering
        $sql = "SELECT *, 
                ( 6371 * acos( cos( radians(?) ) *
                    cos( radians( lat ) )
                    * cos( radians( lng ) - radians(?) )
                    + sin( radians(?) ) *
                    sin( radians( lat ) ) ) ) AS distance
                FROM owner_shops
                WHERE status = 1
                ORDER BY distance";

        $results = DB::select($sql, [$lat, $lng, $lat]);

        // Filter by radius in PHP since SQLite has issues with HAVING on calculated columns
        $filteredResults = collect($results)->filter(function ($shop) use ($radius) {
            return $shop->distance < $radius;
        })->values();

        // Transform raw results through Eloquent model to get imageUri and avg_rating accessors
        $data = $filteredResults->map(function ($shop) {
            return OwnerShop::find($shop->id);
        })->filter()->values();

        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
}
