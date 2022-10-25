<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Model\Setting;
use App\Model\ServiceCat;
use App\Model\Service;
use App\Model\Photo;
use App\Model\Filep;
use App\Model\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Model\Category;

class PrintController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'جاپ کردن';
        } elseif ('single') {
            return 'چاپ کردن';
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

    public function search(Request $request) 
    {
        function fa_number($number) {
            $arr = array();
            for ($i=0; $i < strlen($number); $i++) { 
                switch ($number) {
                    case $number[$i] == "0":
                        array_push($arr, "۰" );
                    break;
                    case $number[$i] == "1":
                        array_push($arr, "۱" );
                    break;
                    case $number[$i] == "2":
                        array_push($arr, "۲" );
                    break;
                    case $number[$i] == "3":
                        array_push($arr, "۳" );
                    break;
                    case $number[$i] == "4":
                        array_push($arr, "۴" );
                    break;
                    case $number[$i] == "5":
                        array_push($arr, "۵" );
                    break;
                    case $number[$i] == "6":
                        array_push($arr, "۶" );
                    break;
                    case $number[$i] == "7":
                        array_push($arr, "۷" );
                    break;
                    case $number[$i] == "8":
                        array_push($arr, "۸" );
                    break;
                    case $number[$i] == "9":
                        array_push($arr, "۹" );
                    break;
                
                    default:
                        array_push($arr, $number[$i] );
                } 
            }
            return implode("",$arr);
        }
        $foods = Service::where('garanty',  'LIKE', '%'.$request->garanty.'%' )->where('color',  'LIKE', '%'.$request->color.'%' )->where('memory',  'LIKE', '%'.$request->memory.'%' )->get();
        if ($request->food_type != 'all') {
            $foods = $foods->where('food_type', $request->food_type);
        }
        if ($request->brand != 'all') {
            $foods = $foods->where('brand', $request->brand);
        }
        if ($request->band_type != 'all') {
            $foods = $foods->where('band_type', $request->band_type);
        }
        // $food_photo = Photo::where('pictures_type', 'App\Model\Service')->whereIn('pictures_id', $foods->pluck('id'))->get();
        $categories = Category::all();
        return view('user.restaurant.print.index',compact('foods','categories'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);

    }
    
    public function index($myCount=100) 
    {
        function fa_number($number) {
            $arr = array();
            for ($i=0; $i < strlen($number); $i++) { 
                switch ($number) {
                    case $number[$i] == "0":
                        array_push($arr, "۰" );
                    break;
                    case $number[$i] == "1":
                        array_push($arr, "۱" );
                    break;
                    case $number[$i] == "2":
                        array_push($arr, "۲" );
                    break;
                    case $number[$i] == "3":
                        array_push($arr, "۳" );
                    break;
                    case $number[$i] == "4":
                        array_push($arr, "۴" );
                    break;
                    case $number[$i] == "5":
                        array_push($arr, "۵" );
                    break;
                    case $number[$i] == "6":
                        array_push($arr, "۶" );
                    break;
                    case $number[$i] == "7":
                        array_push($arr, "۷" );
                    break;
                    case $number[$i] == "8":
                        array_push($arr, "۸" );
                    break;
                    case $number[$i] == "9":
                        array_push($arr, "۹" );
                    break;
                
                    default:
                        array_push($arr, $number[$i] );
                } 
            }
            return implode("",$arr);
        }

        $foods = Service::where('user_id', auth()->user()->id)->orderBy('brand')->get();
        // $myCount = intval($foods->count() / 4);
        // if ($myCount==1 && $foods->count()>4) {
        //     $myCount = 2;
        // } elseif ($myCount==0) {
        //     $myCount = 1;
        // }

        // $food_photo = Photo::where('pictures_type', 'App\Model\Service')->whereIn('pictures_id', $foods->pluck('id'))->get();
        $categories = Category::where('user_id', auth()->user()->id)->get();
        return view('user.restaurant.print.index',compact('foods','categories','myCount'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);

    }

    public function show($restaurant_food) 
    {
        function fa_number($number) {
            $arr = array();
            for ($i=0; $i < strlen($number); $i++) { 
                switch ($number) {
                    case $number[$i] == "0":
                        array_push($arr, "۰" );
                    break;
                    case $number[$i] == "1":
                        array_push($arr, "۱" );
                    break;
                    case $number[$i] == "2":
                        array_push($arr, "۲" );
                    break;
                    case $number[$i] == "3":
                        array_push($arr, "۳" );
                    break;
                    case $number[$i] == "4":
                        array_push($arr, "۴" );
                    break;
                    case $number[$i] == "5":
                        array_push($arr, "۵" );
                    break;
                    case $number[$i] == "6":
                        array_push($arr, "۶" );
                    break;
                    case $number[$i] == "7":
                        array_push($arr, "۷" );
                    break;
                    case $number[$i] == "8":
                        array_push($arr, "۸" );
                    break;
                    case $number[$i] == "9":
                        array_push($arr, "۹" );
                    break;
                
                    default:
                        array_push($arr, $number[$i] );
                } 
            }
            return implode("",$arr);
        }

        $foods = Service::where('user_id', auth()->user()->id)->where('food_type', $restaurant_food)->get();
        // $food_photo = Photo::where('pictures_type', 'App\Model\Service')->whereIn('pictures_id', $foods->pluck('id'))->get();
        $categories = Category::where('user_id', auth()->user()->id)->get();
        return view('user.restaurant.food.index',compact('foods','categories'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);

    }
}


