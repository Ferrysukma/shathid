<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get Image Banner
        $banner = DB::table('banner')->get();

        return view('home.index', [
            'banners'   => $banner
        ]);
    }
}
