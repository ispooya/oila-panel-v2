<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function uploadImg(Request $request)
    {
        $path = '/images/'.$request->type;
        $image = $request->file('file');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path($path), $imageName);
        return response()->json(['success' => "$path/" . $imageName]);
    }
    public function uploadTinyImg(Request $request)
    {
        Log::info("run uploadTinyImg function");
        $path = 'images/content';
        $image = $request->file('file');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path($path), $imageName);
        return response()->json(['location' => "/$path/" . $imageName]);
    }
    public function uploadSellerImg(Request $request)
    {
        $name = [];
        $original_name = [];
        foreach ($request->file('file') as $key => $value) {
            $path = '/images/sellers';

            $image = uniqid() . time() . '.' . $value->getClientOriginalExtension();
            $destinationPath = public_path($path);
            $value->move($destinationPath, $image);
            $name[] = $image;
            $original_name[] = $value->getClientOriginalName();
        }

        return response()->json([
            'name'          => $name,
            'original_name' => $original_name
        ]);
        Log::info("run uploadTinyImg function");
        $image = $request->file('file');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path($path), $imageName);
        return response()->json(['location' => "/$path/" . $imageName]);
    }
}
