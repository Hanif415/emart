<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'title' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data = $request->all();
        // create a slug from title
        $slug = Str::slug($request->input('title'));
        // get the count of slug
        $slug_count = Banner::where('slug', $slug)->count();
        // if slug more then 8 then customize slug
        if ($slug_count > 8) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        $status = Banner::create($data);
        if ($status) {
            notify()->success('Successfully created banner');
            return redirect()->route('banner.index')->with('success');
        } else {
            notify()->error('Something went wrong');
            return back()->with('error');
        }
    }

    public function bannerStatus(Request $request)
    {
        if ($request->checked == 'true') {
            DB::table('banners')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('banners')->where('id', $request->id)->update(['status' => 'inactive']);
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
        $banner = Banner::find($id);
        if ($banner) {
            return view('admin.banner.edit', compact('banner'));
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
            'title' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        // create a slug from title
        $slug = Str::slug($request->input('title'));
        // get the count of slug
        $slug_count = Banner::where('slug', $slug)->count();
        // if slug more then 8 then customize slug
        if ($slug_count > 8) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;

        $banner = Banner::find($id);

        $status = $banner->fill($data)->save();
        if ($status) {
            notify()->success('Successfully updated banner');
            return redirect()->route('banner.index')->with('success');
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
        $banner = Banner::find($id);
        if ($banner) {
            $status = $banner->delete();
            if ($status) {
                notify()->success('Successfully deleted banner');
                return redirect()->route('banner.index');
            }
        } else {
            notify()->error('Something wrong, data not found');
            return back();
        }
    }
}
