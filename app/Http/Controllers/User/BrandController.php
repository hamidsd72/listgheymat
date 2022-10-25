<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Model\Setting;
use App\Model\Service;
use App\Model\ServiceCat;
use App\Model\ServicePackage;
use App\Model\ServiceJoinPackage;
use App\Model\ServicePackagePrice;
use App\Model\Photo;  
use App\Model\Filep;
use App\Model\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'برند ها';
        } elseif ('single') {
            return 'برند';
        }
    }

    public function controller_paginate()
    {
        $settings = Setting::select('paginate')->latest()->firstOrFail();
        return $settings->paginate;
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Brand::where('user_id', auth()->user()->id)->get();
        return view('user.restaurant.brands.index', compact('categories'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    // public function show($id)
    // {
    //     $ServiceCat = Category::find($id);
    //     $items = Service::where('food_type', $ServiceCat->id)->get();
    //     // $items = Service::where('category_id',$category_id)->orderByDesc('id')->paginate(50);

    //     // return view('user.category.edit', compact('item', 'items'), ['title1' => 'خدمات', 'title2' => 'افزودن پکیج خدمت']);
    //     return view('user.services', compact('ServiceCat','items'), ['title1' => 'خدمات', 'title2' => 'افزودن پکیج خدمت']);
    // }

    public function create()
    {
        return view('user.restaurant.brands.create', ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function store(Request $request)
    {
        // TODO az resturan karbar
        $cat = new Brand();
        $cat->user_id   = auth()->user()->id;
        $cat->title     = $request->title;
        $cat->status    = $request->status;
        $cat->save();
        // return redirect()->route('user.index')->with('flash_message', 'دسته با موفقیت ثبت شد.');
        return redirect()->route('user.restaurant-food-brands.index')->with('flash_message', 'دسته با موفقیت ثبت شد.');
    }

    public function store2(Request $request)
    {
        $cat = new Brand();
        $cat->user_id   = auth()->user()->id;
        $cat->title     = $request->title;
        $cat->status    = $request->status;
        $cat->save();
        return redirect()->route('user.restaurant-foods.create')->with('flash_message', 'دسته با موفقیت ثبت شد.');
    }

    public function edit($restaurant_food_brand)
    {
        $cat = Brand::find($restaurant_food_brand);
        return view('user.restaurant.brands.edit', compact('cat'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function update(Request $request ,$restaurant_food_brand)
    {
        $item = Brand::where('user_id', auth()->user()->id)->findOrFail($restaurant_food_brand);
        $item->title   = $request->title;
        $item->status  = $request->status;
        $item->save();
        // return redirect()->route('user.index')->with('flash_message', 'دسته با موفقیت ویرایش شد.');
        return redirect()->route('user.restaurant-food-brands.index')->with('flash_message', 'دسته با موفقیت ویرایش شد.');
    }

    public function destroy($restaurant_food_brand)
    {
        $item = Brand::where('user_id', auth()->user()->id)->findOrFail($restaurant_food_brand);
        try {
            if(Service::where('food_type', $item->id)->count())
            {
                // return redirect()->back()->with('این دسته دارای غذاهایی هست و قابل حذف نمی باشد');
                $err_message = 'این دسته دارای آیتمهایی هست و قابل حذف نمی باشد';
                $categories = Brand::where('user_id', auth()->user()->id)->get();
                return view('user.restaurant.categories.index', compact('categories','err_message'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
            }
            $item->delete();
            return redirect()->back()->with('flash_message', 'آیتم با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message', 'مشکلی در حذف آیتم بوجود آمده،مجددا تلاش کنید');
        }
    }
    
}


