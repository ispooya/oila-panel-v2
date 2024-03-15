<?php

namespace App\Http\Controllers;

use App\Models\Fpp;
use App\Models\Post;
use App\Models\PostProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFpp;
use App\Models\ProductUses;
use App\Models\ProductUsesRel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(20);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $fpps = Fpp::all();
        $uses = ProductUses::all();
        return view('product.create', compact('fpps'), compact('uses'));
    }

    public function store(Request $request)
    {
        $product = Product::create([
            "name" => $request->name,
            "img" => $request->img,
            "category_id" => $request->category,
            "description" => $request->description,
            "ingredients" => $request->ingredients,
        ]);
//        $uses = json_encode($request->use);
//        $fpps = json_encode($request->fpp);

        if ($request->use){
            foreach ($request->use as $use) {
                ProductUsesRel::create([
                    "product_id" => $product->id,
                    "uses_id" => $use
                ]);
            }
        }

        if ($request->fpp){
            foreach ($request->fpp as $fpp) {
                ProductFpp::create([
                    "product_id" => $product->id,
                    "fpp_id" => $fpp
                ]);
            }
        }

        if ($request->post){
            foreach ($request->post as $post) {
                PostProduct::create([
                    "product_id" => $product->id,
                    "post_id" => $post
                ]);
            }
        }

        return redirect()->back()->with('success', 'محصول ' . $request['name'] . ' با موفقیت افزوده شد');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        if ($request->img){
            $product->img = $request->img;
        }
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->ingredients = $request->ingredients;

        $product->save();

        // Delete existing relationships
        $product->uses()->detach();
        $product->fpps()->detach();
        $product->posts()->detach();

        // Create new relationships
        if ($request->use){
            foreach ($request->use as $use) {
                ProductUsesRel::create([
                    "product_id" => $product->id,
                    "uses_id" => $use
                ]);
            }
        }

        if ($request->fpp){
            foreach ($request->fpp as $fpp) {
                ProductFpp::create([
                    "product_id" => $product->id,
                    "fpp_id" => $fpp
                ]);
            }
        }

        if ($request->post){
            foreach ($request->post as $post) {
                PostProduct::create([
                    "product_id" => $product->id,
                    "post_id" => $post
                ]);
            }
        }
        return redirect()->back()->with('success', 'Product ' . $request['name'] . ' updated successfully');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->uses()->delete();
        $product->fpps()->delete();
        $product->posts()->delete();
        $product->delete();
        return redirect()->back()->with('success', 'خبر ' . $product->name . ' با موفقیت حذف شد.');
    }
    public function fppIndex()
    {
        $fpps = Fpp::all();
        return view('product.fpp', compact('fpps'));
    }

    public function fppStore(Request $request)
    {
        try {
            Fpp::create([
                "name" => $request->name,
                "icon" => $request->img,
            ]);
            return redirect()->back()->with('success', 'ویژگی محصول با موفقیت افزوده شد.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'عملیات با خطا مواجه شد!');

        }
    }

    public function fppDestroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $fpp = Fpp::findOrFail($id);
            ProductFpp::where('fpp_id',$fpp->id)->delete();
            $fpp->delete();

            DB::commit();
            return redirect()->back()->with('success', 'ویژگی محصول با موفقیت حذف شد.');
        } catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'عملیات با خطا مواجه شد!');
        }
    }

    public function usesIndex()
    {
        $uses = ProductUses::all();
        return view('product.uses', compact('uses'));
    }

    public function usesStore(Request $request)
    {
        try {
            ProductUses::create([
                "name" => $request->name,
                "icon" => $request->img,
            ]);
            return redirect()->back()->with('success', 'مورد استفاده محصول با موفقیت افزوده شد.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'عملیات با خطا مواجه شد!');

        }
    }

    public function usesDestroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $uses = ProductUses::findOrFail($id);
            ProductUsesRel::where('uses_id',$uses->id)->delete();
            $uses->delete();

            DB::commit();
            return redirect()->back()->with('success', 'مورد با موفقیت حذف شد.');
        } catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'عملیات با خطا مواجه شد!');
        }
    }

    public function categoryIndex()
    {
        $categories = ProductCategory::all();
        return view('product.category', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        try {
            ProductCategory::create([
                "name" => $request->name,
                "img" => $request->img,
            ]);
            return redirect()->back()->with('success', 'دسته بندی محصول با موفقیت افزوده شد.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'عملیات با خطا مواجه شد!');

        }
    }

    public function categoryDestroy(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        $categories = ProductCategory::all();

        return view('product.category', compact('categories'));

    }

    public function show($id)
    {
        $product = Product::with('uses', 'fpps', 'posts')->find($id);
        return view('product.show', compact('product'));
    }
}
