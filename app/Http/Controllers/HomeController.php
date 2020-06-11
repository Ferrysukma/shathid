<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->profile = Controller::profile();
    }

    public function index()
    {
        // Get Image Banner
        $banner  = DB::table('banner')->get();
        // Get Product
        $product = DB::table('product')->get();

        return view('home.index', [
            'banners'   => $banner,
            'products'  => $product,
            'profile'   => $this->profile
        ]);
    }

    public function product_category($categories)
    {
        if ($categories == 'short') {
            $category   = 'Short Sleeve';
        } elseif ($categories == 'long') {
            $category   = 'Long Sleeve';
        } else {
            $category   = '';
        }

        // Get Detail Product
        $product      = DB::table('product')->where('product_category', $category)->get();

        return view('home.product_category', [
            'products' => $product,
            'category' => $category,
            'profile'  => $this->profile
        ]);
    }
}
