<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'nullable',
            'photo' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();

        // create a slug from title
        $slug = Str::slug($request->input('title'));

        // get the count of slug
        $slug_count = Brand::where('slug', $slug)->count();

        // if slug more then 0 then customize slug
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }

        $data['slug'] = $slug;

        $status = Brand::create($data);

        if ($status) {
            notify()->success('Successfully created brand');
            return redirect()->route('brand.index');
        } else {
            notify()->error('Something went wrong');
            return back();
        }
    }

    public function brandStatus(Request $request)
    {
        if ($request->checked == 'true') {
            DB::table('brands')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('brands')->where('id', $request->id)->update(['status' => 'inactive']);
        }

        return response()->json(['msg' => 'Status updated', 'status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            return view('admin.brand.edit', compact('brand'));
        } else {
            notify()->error('Something wrong, data not found');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate data request
        $this->validate($request, [
            'title' => 'nullable',
            'photo' => 'required',
        ]);

        $data = $request->all();

        // create a slug from title
        $slug = Str::slug($request->input('title'));

        // get the count of slug
        $slug_count = Brand::where('slug', $slug)->count();

        // if slug more then 0 then customize slug
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }

        $data['slug'] = $slug;

        $brand = Brand::find($id);

        $status = $brand->fill($data)->save();

        if ($status) {
            notify()->success('Successfully updated brand');
            return redirect()->route('brand.index')->with('success');
        } else {
            notify()->error('Something went wrong');
            return back()->with('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $status = $brand->delete();
            if ($status) {
                notify()->success('Successfully deleted brand');
                return redirect()->route('brand.index');
            }
        } else {
            notify()->error('Something wrong, data not found');
            return back();
        }
    }
}
