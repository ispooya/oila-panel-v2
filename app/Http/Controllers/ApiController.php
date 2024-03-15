<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GeneralDetaController;
use App\Models\BoardMember;
use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerCategory;
use App\Models\Faq;
use App\Models\generalDeta;
use App\Models\Manager;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Seller;
use App\Models\Solution;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Array_;

class ApiController extends Controller
{
    public function getBoardMember()
    {
        Log::info("run getBoardMember!");
        $boardMembers = BoardMember::all();
        return $boardMembers;
    }

    public function getManagersContact()
    {
        $managers = Manager::all();
        return $managers;

    }

    public function getSolution()
    {
        $solutions = Solution::with('services')->get();
        return $solutions;
    }

    public function getPartner()
    {
        $partners = Partner::all();
        return $partners;
    }

    public function getCustomer()
    {
        $customers = CustomerCategory::with('customers')->get();
        return $customers;
    }
    public function getHomeCustomer()
    {
        $customers = Customer::where('home',true)->get();
        return $customers;
    }

    public function getValue()
    {
        $values = Value::all();
        return $values;
    }

    public function getAboutUs()
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


        return [
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
            ];

    }

    public function getContactUs()
    {
        $s1title = generalDeta::where('key', 'contact.s1.title')->first();
        $s1subtitle = generalDeta::where('key', 'contact.s1.subtitle')->first();
        $managementPhone = generalDeta::where('key', 'managementphone')->first();
        $salesPhone = generalDeta::where('key', 'salesphone')->first();
        $address = generalDeta::where('key', 'address')->first();
        $map = generalDeta::where('key', 'map')->first();
        $s2title = generalDeta::where('key', 'contact.s2.title')->first();
        $s2subtitle = generalDeta::where('key', 'contact.s2.subtitle')->first();
        $s3title = generalDeta::where('key', 'contact.s3.title')->first();
        $s3subtitle = generalDeta::where('key', 'contact.s3.subtitle')->first();
        $questions =  Faq::latest()->get();
        $sellers = Seller::latest()->get();

        return [
            's1title' => $s1title->value,
            's1subtitle' => $s1subtitle->value,
            'managementPhone' => $managementPhone->value,
            'salesPhone' => $salesPhone->value,
            'address' => $address->value,
            'map' => $map->value,
            's2title' => $s2title->value,
            's2subtitle' => $s2subtitle->value,
            's3title' => $s3title->value,
            's3subtitle' => $s3subtitle->value,
            'questions' => $questions,
            'sellers' => $sellers ,
        ];

    }

    public function lastNews()
    {
        Log::info("hi!");
        $news = Post::orderBy('id', 'DESC')->first();
        Log::info($news);
        return $news;
    }

    public function homeNews()
    {
        Log::info("hi!");
        $news = Post::latest()->take(3)->get();
        Log::info($news);
        return $news;
    }

    public function getChart()
    {
        return generalDeta::where('key', 'chart')->first();
    }

    public function getHomeContent()
    {
        $slider = GeneralDetaController::getHomeSlider();
        $section1 = GeneralDetaController::getHomeSection1();
        $section3 = GeneralDetaController::getHomeSection3();
        $section4 = GeneralDetaController::getHomeSection4();
        $section5 = GeneralDetaController::getHomeSection5();
        $section6 = GeneralDetaController::getHomeSection6();
        return response()->json([
            'slider' => $slider,
            's1' => $section1,
            's3' => $section3,
            's4' => $section4,
            's5' => $section5,
            's6' => $section6,
        ]);
    }
    public function getProductsPageContent()
    {
        $title = generalDeta::where('key', 'prPage.title')->first();
        $subtitle = generalDeta::where('key', 'prPage.subtitle')->first();
        $categories = Product::latest()->get();

        return response()->json([
            'title' => $title->value,
            'subtitle' => $subtitle->value,
            'products' => $categories,
        ]);
    }
    public function getCatProducts($id)
    {
        $products = Product::where('category_id',$id)->get();
        $category = ProductCategory::find($id);

        return response()->json([
            'title' => "محصولات $category->name اویلا",
            'subtitle' => "برای راهنمایی دقیق‌تر روی هر محصول کلیک کنید",
            'products' => $products,
        ]);
    }

    public function getProductInfo($id)
    {
        $product = Product::where('id',$id)->with(['fpps', 'uses', 'posts'])->firstOrFail();
        return response()->json($product);
    }
    public function getOurStoryContent()
    {
        $head = GeneralDetaController::getStoryHead();
        $s1 = GeneralDetaController::getStorySection1();
        $s2 = GeneralDetaController::getStorySection2();
        $s3 = GeneralDetaController::getStorySection3();
        $s5 = GeneralDetaController::getStorySection5();
        $s6 = GeneralDetaController::getStorySection6();

        return response()->json([
            'head' => $head,
            's1' => $s1,
            's2' => $s2,
            's3' => $s3,
            's5' => $s5,
            's6' => $s6,
        ]);
    }
    public function getJobContent()
    {
//        $head = GeneralDetaController::getStoryHead();
//        $s1 = GeneralDetaController::getStorySection1();
        $s1 = GeneralDetaController::getJobSection1();
        $s2 = GeneralDetaController::getJobSection2();
        $s3 = GeneralDetaController::getJobSection3();
        $s4 = GeneralDetaController::getJobSection4();
//        $s6 = GeneralDetaController::getStorySection6();

        return response()->json([
//            'head' => $head,
            's1' => $s1,
            's2' => $s2,
            's3' => $s3,
            's4' => $s4,
//            's6' => $s6,
        ]);
    }

    public function getHomeContentHead()
    {

    }


    /**
     * home page video
     *
     * @return Section 5 content
     */
    public function getHomeSection5(): array
    {
        $title = generalDeta::where('key', 'home.s5.title')->first();
        $subtitle = generalDeta::where('key', 'home.s5.subtitle')->first();
        $video = generalDeta::where('key', 'home.s5.video')->first();

        return ['title' => $title->value, 'subtitle' => $subtitle->value, 'video' => $video->value,];
    }
    public function getSocialPage()
    {
        $instagram = generalDeta::where('key', 'instagram')->first();
        $twitter = generalDeta::where('key', 'twitter')->first();
        $linkedin = generalDeta::where('key', 'linkedin')->first();
        $aparat = generalDeta::where('key', 'aparat')->first();

        return [
            'instagram' => $instagram->value,
            'twitter' => $twitter->value,
            'linkedin' => $linkedin->value,
            'aparat' => $aparat->value,
            ];
    }

    public function getAfq()
    {
        $faqs = Faq::all();
        return response()->json($faqs);
    }
    public function getMag()
    {
        $categories = Category::with('posts')->get();
        return response()->json($categories);
    }
    public function lastPost()
    {
        $posts = Post::latest()->take(4)->get();
        return response()->json($posts);
    }
    public function getPost($slug)
    {
        $post = Post::where('slug',$slug)->first();
        return response()->json($post);
    }

    public function getCatPosts($id)
    {
        $cat = Category::with('posts')->find($id);
        return response()->json($cat->posts);

    }
    public function getProducts()
    {
        $products = Product::with('fpps')->with('uses')->get();
        return $products;

    }

    public function getLastPostSection()
    {
        return response()->json([
            GeneralDetaController::getHomeSection5()
        ]);
    }
}
