<?php


namespace App\Http\Controllers\ShopOwner;
use App\Package;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data =   Package::where('owner_id', Auth::id())->get();
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
        //
        $request->validate([
            'service' => 'bail|required',
            'name' => 'bail|required|max:50',
            'price' => 'bail|required|min:1',
        ]);
        $reqData = $request->all();
        $reqData['owner_id'] = Auth::id();
       $data=  Package::create($reqData);
        return response()->json(['msg' => 'Package added successfully', 'data' => $data, 'success' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Package::find($id);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate(['service' => 'bail|required',
            'name' => 'bail|required|max:50',
            'price' => 'bail|required|min:1',
        ]);
        Package::find($id)->update($request->all());
        $data = Package::find($id);
        return response()->json(['msg' => 'Package update successfully', 'data' => $data, 'success' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Package::find($id)->delete();
        return response()->json(['msg' => 'Package deleted successfully', 'data' => null, 'success' => true], 200);
    }
}
