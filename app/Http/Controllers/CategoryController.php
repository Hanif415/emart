<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_categories = Category::where('is_parent', 1)->orderBy('title', 'asc')->get();
        return view('admin.categories.create', compact('parent_categories'));
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
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:on',
            'parent_id' => 'nullable',
            'status' => 'nullable|in:active, inactive'
        ]);

        $data = $request->all();
        // create a slug from title
        $slug = Str::slug($request->input('title'));
        // get the count of slug
        $slug_count = Category::where('slug', $slug)->count();
        // if slug more then 0 then customize slug
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        $status = Category::create($data);
        if ($status) {
            notify()->success('Successfully created category');
            return redirect()->route('category.index')->with('success');
        } else {
            notify()->error('Something went wrong');
            return back()->with('error');
        }
    }

    public function categoryStatus(Request $request)
    {
        if ($request->checked == 'true') {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'inactive']);
        }

        return response()->json(['msg' => 'Status Updated', 'status' => true]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $status = $category->delete();
            if ($status) {
                notify()->success('Successfully deleted banner');
                return redirect()->route('category.index');
            }
        } else {
            notify()->error('Something wrong, data not found');
            return back();
        }
    }
}
