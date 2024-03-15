<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::paginate(10);
        return view('faq.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        Faq::create([
            "question" => $request->question,
            "answer" => $request->answer,
        ]);
        return redirect()->back()->with('success', 'سوال با موفقیت افزوده شد');

    }

    public function show($id)
    {
        $faq = Faq::findOrFail( $id );
        return view('faq.show', compact('faq'));

    }

    public function update(Request $request, $id){
        Faq::findOrFail( $id )->update([
            "question" => $request->question,
            "answer" => $request->answer,
        ]);
        return redirect()->back()->with('success','سوال به موفقیت ویرایش شد');
    }

    public function destroy($id){
        Faq::findOrFail( $id )->delete();
        return redirect()->back()->with('success','سوال به موفقیت حذف شد');
    }
}
