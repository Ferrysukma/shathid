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
            'province'  => $province
        ]);
    }

    public function get_city(Request $request)
    {
        $client  = new Client();
        // API Get City
        $url     = $this->base_url . 'city?province=' . $request->provinceId;
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
                    'contents' => 22,
                ],
                [
                    'name'     => 'destination',
                    'contents' => $request->city,
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
}
