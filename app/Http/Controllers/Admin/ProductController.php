<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        // Get Product
        $product = DB::table('product')->get();

        return view('admin.product.index', [
            'data'   => $product
        ]);
    }

    public function add()
    {
        return view('admin.product.add');
    }

    public function add_process(Request $request)
    {
        if ($request->hasFile('file')) {
            $arr_file   = [];
            $file       = $request->file('file');
            for ($i=0; $i <  count($file); $i++) {
                $extension = $file[$i]->extension();
                $fileName  = time() . $i . '.' . $extension;
                $file[$i]->move('image', $fileName);
                array_push($arr_file, $fileName);
            }
        }

        $arr_size       = [];
        $size           = $request->size;
        for ($i=0; $i < count($size); $i++) {
            array_push($arr_size, $size[$i]);
        }

        DB::table('product')->insert([
            'product_name'     => $request->name,
            'product_category' => $request->category,
            'product_stock'    => $request->stock,
            'product_price'    => str_replace('.','',$request->price),
            'product_image'    => json_encode($arr_file),
            'product_size'     => json_encode($arr_size),
            'product_status'   => 1,
        ]);

        return json_encode('success');
    }

    public function delete_process(Request $request)
    {
        $image  = json_decode($request->image);
        for ($i=0; $i < count($image); $i++) {
            $this->delete_image($image[$i]);
        }
        DB::table('product')->where('product_id', $request->id)->delete();
        return json_encode('success');
    }

    public function delete_image($image)
    {
        return File::delete('image/'.$image);
    }

    public function edit($id)
    {
        $product = DB::table('product')->where('product_id', $id)->first();
        return view('admin.product.edit', ['data' => $product]);
    }

    public function edit_process(Request $request)
    {
        $arr_size       = [];
        $size           = $request->size;
        for ($i=0; $i < count($size); $i++) {
            array_push($arr_size, $size[$i]);
        }

        if ($request->hasFile('file')) {
            $image      = json_decode($request->image);
            for ($i=0; $i < count($image); $i++) {
                $this->delete_image($image[$i]);
            }

            $arr_file   = [];
            $file       = $request->file('file');
            for ($i=0; $i <  count($file); $i++) {
                $extension = $file[$i]->extension();
                $fileName  = time() . $i . '.' . $extension;
                $file[$i]->move('image', $fileName);
                array_push($arr_file, $fileName);
            }

            DB::table('product')->where('product_id',$request->id)->update([
                'product_id'       => $request->id,
                'product_name'     => $request->name,
                'product_category' => $request->category,
                'product_stock'    => $request->stock,
                'product_price'    => str_replace('.','',$request->price),
                'product_image'    => json_encode($arr_file),
                'product_size'     => json_encode($arr_size),
                'product_status'   => 1,
            ]);
        } else {
            DB::table('product')->where('product_id',$request->id)->update([
                'product_id'       => $request->id,
                'product_name'     => $request->name,
                'product_category' => $request->category,
                'product_stock'    => $request->stock,
                'product_price'    => str_replace('.','',$request->price),
                // 'product_image'    => json_encode($arr_file),
                'product_size'     => json_encode($arr_size),
                'product_status'   => 1,
            ]);
        }

        return json_encode('success');
    }
}
