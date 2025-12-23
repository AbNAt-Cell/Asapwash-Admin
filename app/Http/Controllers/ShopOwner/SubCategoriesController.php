<?php

namespace App\Http\Controllers\ShopOwner;

use App\Category;
use App\Http\Controllers\Controller;

use App\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data =   SubCategories::where('owner_id', Auth::id())->get();
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
            'cat_id' => 'bail|required',
            'name' => 'bail|required|max:20',
            'price' => 'bail|required|min:1',
        ]);
        $reqData = $request->all();
        $reqData['owner_id'] = Auth::id();
        $data = SubCategories::create($reqData);
        return response()->json(['msg' => 'Service added successfully', 'data' => $data, 'success' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategories  $subCategories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data =   SubCategories::where('id',$id)->where('owner_id', Auth::id())->first();
        $data['category'] = Category::find($data->cat_id);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategories  $subCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategories $subCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategories  $subCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cat_id' => 'bail|required',
            'name' => 'bail|required',
            'price' => 'bail|required|min:1',
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            
            return response()->json(['success' => false, 'errors' => $errors], 422);
        }
        try {
            SubCategories::find($id)->update($request->all());
            $data =SubCategories::find($id);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'errors' => $th->getMessage()],);
        }
        return response()->json(['msg' => 'Service update successfully', 'data' =>$data, 'success' => true], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategories  $subCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        SubCategories::find($id)->delete();
        return response()->json(['msg' => 'Service deleted successfully', 'data' => null, 'success' => true], 200);
    }
}
