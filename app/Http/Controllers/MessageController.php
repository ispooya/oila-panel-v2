<?php

namespace App\Http\Controllers;


use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    //

    public function storeContact(Request $request)
    {
        $rules = ['captcha' => 'required|captcha_api:'. request('key') . ',math'];
        $validator = validator()->make(request()->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid captcha',
            ], 422);

        } else {
            $validator = Validator::make($request->all(),[
                'name'=>['required','string',],
                'phone'=>['required','string',],
                'message'=>['required'],
            ]);
            if($validator->fails()){
                return Response()->json($validator->errors()->toJson(),422);
            }

            $message = Message::create([
                'message'=>$request->message,
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
            ]);

            if($message){
                return Response()->json("پیام شما با موفقیت ثبت شد.",200);

            }else{
                return Response()->json("خطایی رخ داده است لطفا مجددا امتحان نمایید",400);

            }
        }

    }

    public function index()
    {
        $messages = Message::orderBy('id', 'DESC')->paginate(10);
        return view('message.index',compact('messages'));
    }

    public function changeStatus(Request $request)
    {
        try {
            $message = Message::find($request->id);
            Log::info($message);
            $message->update([
                "status" => !$message->status
            ]);
            Log::info(!$message->status);

            return $message->status ? "true" : "false";

        }catch (\Exception $e){

        }
    }
}
