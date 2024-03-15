<?php

namespace App\Http\Controllers;

use App\Models\generalDeta;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class GeneralDetaController extends Controller
{

    public function aboutUs()
    {
        $img = generalDeta::where('key', 'about.img')->first();
        $video = generalDeta::where('key', 'about.video')->first();
        $title = generalDeta::where('key', 'about.title')->first();
        $subtitle = generalDeta::where('key', 'about.subtitle')->first();
        $s1title = generalDeta::where('key', 'about.s1.title')->first();
        $s1description = generalDeta::where('key', 'about.s1.description')->first();
        $s1img = generalDeta::where('key', 'about.s1.img')->first();
        $s2title = generalDeta::where('key', 'about.s2.title')->first();
        $s2description = generalDeta::where('key', 'about.s2.description')->first();
        $s2img = generalDeta::where('key', 'about.s2.img')->first();
        $s3title = generalDeta::where('key', 'about.s3.title')->first();
        $s3description = generalDeta::where('key', 'about.s3.description')->first();
        $s3img = generalDeta::where('key', 'about.s3.img')->first();
        $s4title = generalDeta::where('key', 'about.s4.title')->first();
        $s4description = generalDeta::where('key', 'about.s4.description')->first();
        $s4img = generalDeta::where('key', 'about.s4.img')->first();


        return view('general.about', [
            'img' => $img->value,
            'video' => $video->value,
            'title' => $title->value,
            'subtitle' => $subtitle->value,
            's1title' => $s1title->value,
            's1description' => $s1description->value,
            's1img' => $s1img->value,
            's2title' => $s2title->value,
            's2description' => $s2description->value,
            's2img' => $s2img->value,
            's3title' => $s3title->value,
            's3description' => $s3description->value,
            's3img' => $s3img->value,
            's4title' => $s4title->value,
            's4description' => $s4description->value,
            's4img' => $s4img->value,
        ]);
    }

    public function aboutUsStore(Request $request)
    {
        $this->validate($request, [
            'duty' => ['required', 'string'],
            'vision' => ['required', 'string'],
            'history' => ['required', 'string'],
        ]);
        generalDeta::where('key', 'duty')->update(['value' => $request['duty']]);
        generalDeta::where('key', 'vision')->update(['value' => $request['vision']]);
        generalDeta::where('key', 'history')->update(['value' => $request['history']]);
        return redirect()->back()->with('success', 'اطلاعات با موفقیت بروزرسانی شد');
    }

    public function contactUs()
    {
        $managementPhone = generalDeta::where('key', 'managementphone')->first();
        $salesPhone = generalDeta::where('key', 'salesphone')->first();
        $address = generalDeta::where('key', 'address')->first();
        $map = generalDeta::where('key', 'map')->first();

        return view('general.contact', ['managementPhone' => $managementPhone->value, 'salesPhone' => $salesPhone->value, 'address' => $address->value, 'map' => $map->value,]);
    }

    public function contactUsStore(Request $request)
    {
        $this->validate($request, [
            'managementphone' => ['required', 'string'],
            'salesphone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'map' => ['required', 'string'],
        ]);
        generalDeta::where('key', 'managementphone')->update(['value' => $request['managementphone']]);
        generalDeta::where('key', 'salesphone')->update(['value' => $request['salesphone']]);
        generalDeta::where('key', 'address')->update(['value' => $request['address']]);
        generalDeta::where('key', 'map')->update(['value' => $request['map']]);
        return redirect()->back()->with('success', 'اطلاعات با موفقیت بروزرسانی شد');
    }

    public function chart()
    {
        $chart = generalDeta::where('key', 'chart')->first();
        return view('chart.index', compact('chart'));
    }

    public function uploadChart(Request $request)
    {
        $chart = generalDeta::where('key', 'chart')->first();

        $image = $request->file('file');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('images/'), $imageName);
        if ($chart == null) {
            generalDeta::create([
                "key" => "chart",
                "value" => $imageName
            ]);
        } else {
            $chart->update(["value" => $imageName]);
        }
        return response()->json(['success' => $imageName]);

    }

    public function home()
    {
        $slider = $this->getHomeSlider();
        $s1 = $this->getHomeSection1();
        $s3 = $this->getHomeSection3();
        $s4 = $this->getHomeSection4();
        $s5 = $this->getHomeSection5();
        $s6 = $this->getHomeSection6();


        $products = Product::all();

        // dd($s1,$s3,$s4,$s5,$s6,$products);

        return view('general.home', compact('slider', 's1', 's3', 's4', 's5', 's6', 'products'));
    }

    public static function getHomeSlider(): array
    {
        $title = generalDeta::where('key', 'home.slider.title')->first();
        $subtitle = generalDeta::where('key', 'home.slider.subtitle')->first();
        $btntext = generalDeta::where('key', 'home.slider.btntext')->first();
        $btnurl = generalDeta::where('key', 'home.slider.btnurl')->first();
        $img = generalDeta::where('key', 'home.slider.img')->first();
        $video = generalDeta::where('key', 'home.slider.video')->first();

        return [
            'title' => $title->value,
            'subtitle' => $subtitle->value,
            'btntext' => $btntext->value,
            'btnurl' => $btnurl->value,
            'img' => $img->value,
            'video' => $video->value,
        ];
    }


    public static function getHomeSection1(): array
    {
        $title = generalDeta::where('key', 'home.product.title')->first();
        $products = Product::latest()->take(9)->get();


        return [
            'title' => $title->value,
            'products' => $products,
        ];
    }

    public static function getHomeSection3(): array
    {
        $title = generalDeta::where('key', 'home.s3.title')->first();
        $btnText = generalDeta::where('key', 'home.s3.btntext')->first();
        $btnUrl = generalDeta::where('key', 'home.s3.btnurl')->first();


        return [
            'title' => $title->value,
            'btnText' => $btnText->value,
            'btnUrl' => $btnUrl->value,
        ];
    }

    public static function getHomeSection4(): array
    {
        $title = generalDeta::where('key', 'home.s4.title')->first();
        $prBtnText = generalDeta::where('key', 'home.s4.prBtnText')->first();
        $recBtnText = generalDeta::where('key', 'home.s4.recBtnText')->first();
        $img = generalDeta::where('key', 'home.s4.img')->first();
        $productId = generalDeta::where('key', 'home.s4.productId')->first()->value;
        $postId = generalDeta::where('key', 'home.s4.postId')->first()->value;
        $product = Product::find($productId);
        $post = Post::find($postId);

        return [
            'title' => $title->value,
            'prBtn' => $prBtnText->value,
            'recBtn' => $recBtnText->value,
            'img' => $img->value,
            'post' => $post,
            'product' => $product,
        ];
    }


    public static function getHomeSection5(): array
    {
        $title = generalDeta::where('key', 'home.s5.title')->first();
        $posts = Post::latest()->take(4)->get();

        return ['title' => $title->value, 'posts' => $posts,];
    }

    public static function getHomeSection6(): array
    {
        $img = generalDeta::where('key', 'home.s6.img')->first();
        $typo = generalDeta::where('key', 'home.s6.typo')->first();
        $val1text = generalDeta::where('key', 'home.s6.val1text')->first();
        $val1img = generalDeta::where('key', 'home.s6.val1img')->first();
        $val2text = generalDeta::where('key', 'home.s6.val2text')->first();
        $val2img = generalDeta::where('key', 'home.s6.val2img')->first();
        $val3text = generalDeta::where('key', 'home.s6.val3text')->first();
        $val3img = generalDeta::where('key', 'home.s6.val3img')->first();
        $val4text = generalDeta::where('key', 'home.s6.val4text')->first();
        $val4img = generalDeta::where('key', 'home.s6.val4img')->first();


        return [
            'img' => $img->value,
            'typo' => $typo->value,
            'v1t' => $val1text->value,
            'v1i' => $val1img->value,
            'v2t' => $val2text->value,
            'v2i' => $val2img->value,
            'v3t' => $val3text->value,
            'v3i' => $val3img->value,
            'v4t' => $val4text->value,
            'v4i' => $val4img->value,
        ];
    }


    public function update(Request $request)
    {

        DB::beginTransaction();
        try {
            foreach ($request->except('_token') as $key => $value) {
                if ($request->files->get($key)) {
                    $path = 'images/';
                    $image = $request->file($key);
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path($path), $imageName);
                    generalDeta::where('key', str_replace('_', '.', $key))->update(['value' => "/$path" . $imageName]);
                } else {
                    generalDeta::where('key', str_replace('_', '.', $key))->update(['value' => $value]);
                }
            }
            DB::commit();
        } catch(Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->back()->with('success', 'ویرایش با موفقیت انجام شد');
    }
}
