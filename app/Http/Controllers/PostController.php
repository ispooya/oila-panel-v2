<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(20);
//        dd($posts);
        return view('post.index',compact('posts'));
    }
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        Log::info($request);
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'content' => 'required',
            'categories' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20000',
        ],[
            "title.required"=>"!عنوان پست ضروری است",
            "slug.required"=>"!فیلد نام ضروری است",
            "slug.unique"=>"!این نامک قبلا ثبت شده است",
            "content.required"=>"فیلد محتوا ضروری است!",
            "categories.required"=>"دسته بندی محتوا ضروری است!",
            "shortContent.required"=>"فیلد محتوای خلاصه ضروری است!",
            "image.mimes"=>"تصویر مطلب باید با پسوند  (jpg, jpeg, png) باشد",
            "image.image"=>"تصویر مطلب باید با پسوند  (jpg, jpeg, png) باشد",
            "image.max"=>"حجم تصویر مطلب باید زیر ۲۰ مگابایت باشد",
            "contentType.required"=>"نوع محتوا را انتخاب کنید.",
        ]);

//        dd($request);
        DB::beginTransaction();
        try {
            $post = new Post();
            $post->user_id = $request->user()->id;
            $post->title = $request->input('title');
            $post->slug = $request->input('slug');
            $post->content = $request->input('content');
            $post->time = $request->input('time');
            $post->shortContent = $request->input('shortContent');
            $post->image = $request->input('img');
            $post->save();
            DB::commit();
            foreach ($request->categories as $category){
                PostCategory::create([
                    "post_id" => $post->id,
                    "category_id" => $category
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
        return redirect()->route('post.index')->with('success', 'مطلب ' . $post->title . ' با موفقیت افزوده شد.');

    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit')->with(compact('post'));
    }

    public function update(Request $request)
    {
        $post = Post::findOrFail($request->id);
        $request->validate([
            'title' => 'required',
            'slug' => $post->slug !== $request->input('slug') ? 'required|unique:posts,slug' : 'required',
            'content' => 'required',
            'shortContent' => 'required',
        ],[
            "title.required"=>"!عنوان پست ضروری است",
            "slug.required"=>"!فیلد نام ضروری است",
            "slug.unique"=>"!این نامک قبلا ثبت شده است",
            "content.required"=>"فیلد محتوا ضروری است!",
            "shortContent.required"=>"فیلد محتوای خلاصه ضروری است!",
            "image.mimes"=>"تصویر مطلب باید با پسوند  (jpg, jpeg, png) باشد",
            "image.image"=>"تصویر مطلب باید با پسوند  (jpg, jpeg, png) باشد",
            "image.max"=>"حجم تصویر مطلب باید زیر ۲۰ مگابایت باشد",
            "contentType.require"=>"نوع محتوا را انتخاب کنید.",
        ]);
        DB::beginTransaction();
        try {
            $post->title = $request->input('title');
            $post->slug = $request->input('slug');
            $post->content = $request->input('content');
            $post->shortContent = $request->input('shortContent');
            $post->image = $request->input('img');

            $post->save();
            DB::commit();
            return redirect()->route('post.index')->with('success', 'مطلب ' . $post->title . ' با موفقیت ویرایش شد.');
        } catch (\Throwable $th) {
            // throw $th;
            Log::info($th);
            DB::rollback();
            return redirect()->back()->with('error', 'عملیات با خطا مواجه شد !');
        }
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->comments()->delete();
        $post->delete();
        return redirect()->back()->with('success', 'خبر ' . $post->title . ' با موفقیت حذف شد.');
    }
}
