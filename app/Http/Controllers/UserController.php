<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'full_name' => 'string|required',
            'username' => 'string|nullable',
            'email' => 'email|required|unique:users,email',
            'password' => 'min:4|required',
            'phone' => 'string|nullable',
            'photo' => 'required',
            'address' => 'string|nullable',
            'role' => 'required|in:admin,customer,vendor',
            'status' => 'required|in:active,inactive'
        ]);

        $data =  $request->all();

        $data['password'] = Hash::make($request->password);

        $status = User::create($data);
        if ($status) {
            notify()->success('Successfully created user');
            return redirect()->route('user.index')->with('success');
        } else {
            notify()->error('Something went wrong');
            return back()->with('error');
        }
    }

    public function userStatus(Request $request)
    {
        if ($request->checked == 'true') {
            DB::table('users')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('users')->where('id', $request->id)->update(['status' => 'inactive']);
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
        $user = User::find($id);
        if ($user) {
            return view('admin.user.edit', compact('user'));
        } else {
            notify()->error('Something went wrong', 'Data not found');
            return back()->with('error');
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
        $user = User::find($id);
        if ($user) {
            $this->validate($request, [
                'full_name' => 'string|required',
                'username' => 'string|nullable',
                'email' => 'email|required|exists:users,email',
                'password' => 'min:4|required',
                'phone' => 'string|nullable',
                'photo' => 'required',
                'address' => 'string|nullable',
                'role' => 'required|in:admin,customer,vendor',
                'status' => 'required|in:active,inactive'
            ]);

            $data = $request->all();

            $data['password'] = Hash::make($request->password);

            $status = $user->fill($data)->save();

            if ($status) {
                notify()->success('Successfully edited user');
                return redirect()->route('user.index')->with('success');
            } else {
                notify()->error('Something went wrong');
                return back()->with('error');
            }
        } else {
            notify()->error('Something wrong, server maybe error');
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
        $user = User::find($id);
        if ($user) {
            $status = $user->delete();
            if ($status) {
                notify()->success('Successfully deleted user');
                return redirect()->route('user.index');
            }
        } else {
            notify()->error('Something wrong, data not found');
            return back();
        }
    }
}
