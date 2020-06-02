<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        // Get Image Banner
        $banner = DB::table('banner')->get();

        return view('admin.home.index', ['data' => $banner]);
    }

    public function add_banner(Request $request)
    {
        if ($request->file('file')->isValid()) {
            $extension = $request->file->extension();
            $fileName  = time() . '.' . $extension;
            $file      = $request->file('file');
            $file->move('image', $fileName);
        }

        DB::table('banner')->insert([
            'banner_name'        => $request->name,
            'banner_description' => $request->description,
            'banner_image'       => $fileName,
        ]);

        return json_encode('success');
    }

    public function edit($id)
    {
        // Get Banner By Id
        $banner = DB::table('banner')->where('banner_id', $id)->first();
        return view('admin.home.edit', ['data' => $banner]);
    }

    public function edit_process(Request $request)
    {
        if ($request->hasFile('file')) {
            $extension = $request->file->extension();
            $fileName  = time() . '.' . $extension;
            $file      = $request->file('file');
            $file->move('image', $fileName);

            $this->delete_image($request->image);

            DB::table('banner')->where('banner_id',$request->id)->update([
                'banner_name'        => $request->name,
                'banner_description' => $request->description,
                'banner_image'       => $fileName,
            ]);
        } else {
            DB::table('banner')->where('banner_id',$request->id)->update([
                'banner_name'        => $request->name,
                'banner_description' => $request->description
            ]);
        }

        return json_encode('success');
    }

    public function delete_banner(Request $request)
    {
        $banner = DB::table('banner')->where('banner_id', $request->id)->first();
        $image  = $banner->banner_image;
        $this->delete_image($image);
        DB::table('banner')->where('banner_id', $request->id)->delete();
        return json_encode('success');
    }

    public function delete_image($image)
    {
        return File::delete('image/'.$image);
    }
}
