<?php

namespace App\Http\Controllers\Customer;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function home()
    {
        $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderBy('id', 'DESC')->limit('5')->get();
        return view('customer.index', compact('banners'));
    }
}