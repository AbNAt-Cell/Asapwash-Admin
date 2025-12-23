<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VehicleBrand;
use App\VehicleModel;
use Illuminate\Http\Request;
use Gate;

use Symfony\Component\HttpFoundation\Response;
class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if(Gate::denies('vehicleModel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleModel = VehicleModel::with('brand:id,name')->get();

        return view('admin.vehicleModel.index', compact('vehicleModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort_if(Gate::denies('vehicleModel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand = VehicleBrand::orderBy('name','asc')->get();
        return view('admin.vehicleModel.create',compact('brand'));
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
            'name' => 'bail|required|',
            
        ]);
        $reqData = $request->all();
      
        VehicleModel::create($reqData);
        return redirect()->route('vehicleModel.index')->withStatus(__('vehicleModel is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleModel $vehicleModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleModel $vehicleModel)
    {
        //
        abort_if(Gate::denies('vehicleModel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand = VehicleBrand::orderBy('name', 'asc')->get();

        return view('admin.vehicleModel.edit', compact('vehicleModel','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleModel $vehicleModel)
    {
        //
        $request->validate([
            'name' => 'bail|required|max:255',
        ]);
        $reqData = $request->all();

        $vehicleModel->update($reqData);

        return redirect()->route('vehicleModel.index')->withStatus(__('vehicleModel is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleModel $vehicleModel)
    {
        //
        $vehicleModel->delete();

        return back()->withStatus(__('vehicle model is deleted successfully.'));
    }
}
