<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    //
    public function storeComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string',],
            'email' => ['required', 'email',],
            'comment' => ['required'],
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson(), 422);
        }

        $message = Comment::create([
            'post_id' => $request->post_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'status' => 0,
        ]);

        if ($message) {
            return Response()->json("نظر با موفقیت ثبت شد.", 200);

        } else {
            return Response()->json("خطایی رخ داده است لطفا مجددا امتحان نمایید", 400);

        }
    }

    public function index($status)
    {
        if ($status == "all") {
            $comments = Comment::orderBy('id', 'DESC')->paginate(10);
        } elseif ($status == "status_waiting") {
            $comments = Comment::where('status', 0)->orderBy('id', 'DESC')->paginate(10);
        }
        return view('comment.index', compact('comments'));
    }

    public function rejectComment(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->update([
            'status' => 2,
        ]);
        return Redirect::back();
    }

    public function acceptComment(Request $request){
        $comment = Comment::find($request->id);
        $comment->update([
            'status' => 1,
        ]);
        return Redirect::back();
    }
}
