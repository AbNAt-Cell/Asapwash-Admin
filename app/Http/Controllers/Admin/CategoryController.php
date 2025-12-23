<?php

namespace App\Http\Controllers\Admin;


use App\Category;
use App\Http\Controllers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        //   $coder   = new CoderController;
        //     if (method_exists($coder, 'realityCheck')) {
        //         $coder->realityCheck();
        //     }
         
            //  && method_exists('foo')
      
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.categories.create');
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
            'name' => 'bail|required|unique:categories|max:255',
            'icon' => 'bail|required|image',
        ]);
        $reqData = $request->all();
        if ($request->icon && $request->icon != "undefined") {
            $reqData['icon'] = (new AppHelper)->saveImage($request);
        }
        $reqData['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $reqData['status'] = $request->has('status') ? 1 : 0;
        Category::create($reqData);
        return redirect()->route('categories.index')->withStatus(__('Category is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        // abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
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
        $reqData['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $reqData['status'] = $request->has('status') ? 1 : 0;
        $category->update($reqData);

        return redirect()->route('categories.index')->withStatus(__('Category is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        // abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->delete();

        return back()->withStatus(__('Category is deleted successfully.'));
    }

    public function apiIndex()
    {
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();

        return response()->json(['msg' => null, 'data' => $categories, 'success' => true], 200);
    }
}
