<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::all();
        return view('seller.index', compact('sellers'));
    }

    public function store(Request $request)
    {
        $seller = Seller::create([
            "name" => $request->name,
            "description" =>$request->description,
            "address" =>$request->address,
            "phone" =>$request->phone,
            "site" =>$request->site,
//            "img" => (string)$request->images,
            "img" => json_encode($request->images),
        ]);
        return redirect()->back()->with('success', 'مرکز فروش با موفقیت ثبت شد');

    }

    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();
        return redirect()->back()->with('success', 'خبر ' . $seller->name . ' با موفقیت حذف شد.');
    }
}
