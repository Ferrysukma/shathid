<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->base_url = Controller::api();
        $this->key      = Controller::key();
        $this->profile  = Controller::profile();
    }

    public function index($id)
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

        // Get Detail Product
        $product      = DB::table('product')->where('product_id', $id)->first();

        return view('product.detail', [
            'product'   => $product,
            'province'  => $province,
            'profile'   => $this->profile
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

    public function get_courier(Request $request)
    {
        $weight  = $request->qty * 250;
        $cityId  = explode('-', $request->city)[0];
        $profile = $this->profile;
        $origin  = $profile->profile_city_id;

        $client  = new Client();
        // API Get City
        $url     = $this->base_url . 'cost';
        $request = $client->post($url, [
            'headers'   => [
                'key'           => $this->key
            ],
            'multipart' => [
                [
                    'name'     => 'origin',
                    'contents' => $origin,
                ],
                [
                    'name'     => 'destination',
                    'contents' => $cityId,
                ],
                [
                    'name'     => 'weight',
                    'contents' => $weight,
                ],
                [
                    'name'     => 'courier',
                    'contents' => $request->courier,
                ],
            ]
        ]);
        $response = $request->getBody()->getContents();
        $status  = json_decode((string) $response, true)['rajaongkir']['status']['code'];

        if ($status == '200') {
            $paket   = json_decode((string) $response, true)['rajaongkir']['results'];
        } else {
            $paket   = 'empty';
        }

        return json_encode($paket);
    }

    public function order(Request $request)
    {
        $price      = $request->price * $request->qty;
        if ($request->type == 'courier') {
            $service    = explode('-', $request->cost)[0];
            $province   = explode('-', $request->province)[1];
            $provinceId = explode('-', $request->province)[0];
            $city       = explode('-', $request->city)[1];
            $cityId     = explode('-', $request->city)[0];
        } else {
            $service    = null;
            $province   = null;
            $provinceId = null;
            $city       = null;
            $cityId     = null;
        }

        DB::table('order')->insert([
            'order_product_id'    => $request->product_id,
            'order_product_name'  => $request->product_name,
            'order_product_image' => $request->product_image,
            'order_product_price' => $request->price,
            'order_name'          => $request->name,
            'order_phone'         => $request->phone,
            'order_size'          => $request->size,
            'order_qty'           => $request->qty,
            'order_price'         => $price,
            'order_address'       => $request->address,
            'order_type'          => $request->type,
            'order_courier'       => $request->courier,
            'order_service'       => $service,
            'order_province'      => $province,
            'order_province_id'   => $provinceId,
            'order_city'          => $city,
            'order_city_id'       => $cityId,
            'order_ongkir'        => $request->ongkir,
            'order_status'        => 1,
        ]);

        return redirect('/');
    }
}
