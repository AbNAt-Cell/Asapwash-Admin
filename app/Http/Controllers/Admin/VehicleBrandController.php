<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\VehicleBrand;
use App\VehicleModel;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Artisan;
use LicenseBoxAPI;
use Symfony\Component\HttpFoundation\Response;
use LicenseBoxExternalAPI;

class VehicleBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if(Gate::denies('vehicleBrand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $api = new LicenseBoxAPI();
        $api = new LicenseBoxExternalAPI();

        $res = $api->verify_license();
        if ($res['status'] !== true) {
            Artisan::call('down');
            abort(503);
        }
        $vehicleBrand = VehicleBrand::all();

        return view('admin.vehicleBrand.index', compact('vehicleBrand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort_if(Gate::denies('vehicleBrand_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.vehicleBrand.create');
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
        $request->validate([
            'name' => 'bail|required|unique:vehicle_brand|max:255',
            'icon' => 'bail|required|image',
        ]);
        $reqData = $request->all();
        if ($request->icon && $request->icon != "undefined") {
            $reqData['icon'] = (new AppHelper)->saveImage($request);
        }
        $reqData['status'] = $request->has('status') ? 1 : 0;
        VehicleBrand::create($reqData);
        return redirect()->route('vehicleBrand.index')->withStatus(__('vehicleBrand is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleBrand $vehicleBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleBrand $vehicleBrand)
    {
        //
         abort_if(Gate::denies('vehicleBrand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.vehicleBrand.edit', compact('vehicleBrand'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleBrand $vehicleBrand)
    {
        //
        $request->validate([
            'name' => 'bail|required|max:255',
            'icon' => 'bail|sometimes|required|image',
        ]);
        $reqData = $request->all();
        if ($request->icon && $request->icon != "undefined") {
            $reqData['icon'] = (new AppHelper)->saveImage($request);
        }
        $reqData['status'] = $request->has('status') ? 1 : 0;
        $vehicleBrand->update($reqData);

        return redirect()->route('vehicleBrand.index')->withStatus(__('vehicleBrand is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleBrand $vehicleBrand)
    {
        //
          abort_if(Gate::denies('vehicleBrand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vehicleBrand->delete();

        return back()->withStatus(__('vehicleBrand is deleted successfully.'));
    }
    public function apiIndex()
    {
        $data = VehicleBrand::where('status', 1)->orderBy('name', 'asc')->get();

        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function getBrandModel($brand)
    {
        $data = VehicleModel::where('brand_id', $brand)->orderBy('name', 'asc')->get(['id','name']);

        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
}
