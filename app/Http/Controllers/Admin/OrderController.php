<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.index');
    }

    public function data($type)
    {
        // Get Product
        if ($type == '0') {
            $order = DB::table('order')->where('order_status', '=', 1)
                ->orWhere('order_status', '=', 2)
                ->get();
        } else {
            $order = DB::table('order')->where('order_status', $type)->get();
        }

        return view('admin.order.data', ['data' => $order]);
    }

    public function detail($id, $status)
    {
        // Get Detail Order
        $order = DB::table('order')->where('order_id', $id)->first();

        return view('admin.order.detail', [
            'order' => $order,
            'status' => $status
        ]);
    }

    public function history()
    {
        return view('admin.order.history');
    }

    public function history_data($type)
    {
        // Get Product
        if ($type == '0') {
            $order = DB::table('order')->where('order_status', '=', 3)
                ->orWhere('order_status', '=', 4)
                ->get();
        } else {
            $order = DB::table('order')->where('order_status', $type)->get();
        }

        return view('admin.order.data', ['data' => $order]);
    }

    public function accept(Request $request)
    {
        DB::table('order')->where('order_id', $request->id)->update([
            'order_status'             => 2
        ]);

        return json_encode('success');
    }

    public function cancel(Request $request)
    {
        DB::table('order')->where('order_id', $request->id)->update([
            'order_status'             => 4
        ]);

        return json_encode('success');
    }

    public function finish(Request $request)
    {
        DB::table('order')->where('order_id', $request->id)->update([
            'order_status'             => 3
        ]);

        return json_encode('success');
    }
}
