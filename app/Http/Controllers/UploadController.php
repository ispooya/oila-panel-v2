<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request){
        $fileName=uniqid().'.'.$request->file('file')->getClientOriginalExtension();
        $path=$request->file('file')->storeAs('uploads/images', $fileName, 'public');
        return response()->json(['location'=>"/storage/$path"]); 
    }
}