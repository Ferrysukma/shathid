<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->base_url = Controller::api();
        $this->key      = Controller::key();
    }

    public function index()
    {
        $client  = new Client();
        // API Get Province
        $url     = $this->base_url . 'province';
        $request = $client->get($url, [
            'headers'   => [
                'key' => $this->key
            ]
        ]);
        $response = $request->getBody()->getContents();
        $status  = json_decode((string) $response, true)['rajaongkir']['status']['code'];

        if ($status == '200') {
            $province   = json_decode((string) $response, true)['rajaongkir']['results'];
        } else {
            $province   = 'empty';
        }

        // Get Data profile
        $profile = DB::table('profile')->where('profile_id', 1)->first();

        return view('admin.setting.index', [
            'province'  => $province,
            'profile'   => $profile
        ]);
    }

    public function get_city(Request $request)
    {
        $provinceId = explode('-', $request->province)[0];

        $client  = new Client();
        // API Get City
        $url     = $this->base_url . 'city?province=' . $provinceId;
        $request = $client->get($url, [
            'headers'   => [
                'key' => $this->key
            ]
        ]);
        $response = $request->getBody()->getContents();
        $status  = json_decode((string) $response, true)['rajaongkir']['status']['code'];

        if ($status == '200') {
            $city   = json_decode((string) $response, true)['rajaongkir']['results'];
        } else {
            $city   = 'empty';
        }

        return json_encode($city);
    }

    public function general_setting(Request $request)
    {
        DB::table('profile')->where('profile_id', $request->id)->update([
            'profile_id'             => $request->id,
            'profile_email'          => $request->email,
            'profile_phone'          => $request->phone,
            'profile_instagram'      => $request->instagram,
            'profile_facebook'       => $request->facebook,
            'profile_province'       => explode('-', $request->province)[1],
            'profile_province_id'    => explode('-', $request->province)[0],
            'profile_city'           => explode('-', $request->city)[1],
            'profile_city_id'        => explode('-', $request->city)[0],
            'profile_address'        => $request->address,
            'profile_bank'           => $request->bank,
            'profile_rekening'       => $request->rekening,
            'profile_nomor_rekening' => $request->nomorRekening
        ]);

        return json_encode('success');
    }
}
