<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function api()
    {
        return 'https://api.rajaongkir.com/starter/';
    }

    public function key()
    {
        return '476a683021950a195839716ca0ea8a88';
    }

    public function profile()
    {
        // Get Data profile
        $profile = DB::table('profile')->where('profile_id', 1)->first();
        return $profile;
    }
}
