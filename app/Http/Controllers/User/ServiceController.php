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

class ServiceController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'فایل ها';
        } elseif ('single') {
            return 'فایل';
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
        $foods = Service::where('garanty',  'LIKE', '%'.$request->garanty.'%' )->where('color',  'LIKE', '%'.$request->color.'%' )->get();
        if ($request->food_type != 'all') {
            $foods = $foods->where('food_type', $request->food_type);
        }
        if ($request->memory != 'all') {
            $foods = $foods->where('memory', $request->memory);
        }
        if ($request->brand != 'all') {
            $foods = $foods->where('brand', $request->brand);
        }
        if ($request->band_type != 'all') {
            $foods = $foods->where('band_type', $request->band_type);
        }
        // $food_photo = Photo::where('pictures_type', 'App\Model\Service')->whereIn('pictures_id', $foods->pluck('id'))->get();
        $categories = Category::all();
        return view('user.restaurant.food.index',compact('foods','categories'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);

    }
    
    public function index() 
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

        $foods = Service::where('user_id', auth()->user()->id)->get();
        // $food_photo = Photo::where('pictures_type', 'App\Model\Service')->whereIn('pictures_id', $foods->pluck('id'))->get();
        $categories = Category::where('user_id', auth()->user()->id)->get();
        return view('user.restaurant.food.index',compact('foods','categories'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);

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
        $category_id = $restaurant_food;
        return view('user.restaurant.food.index',compact('foods','categories','category_id'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);

    }

    public function show2($brand) 
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

        $foods      = Service::where('user_id', auth()->user()->id)->where('brand', $brand)->get();
        $categories = Category::where('user_id', auth()->user()->id)->get();
        $brand_title = $brand;
        return view('user.restaurant.food.index',compact('foods','categories','brand_title'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);

    }

    public function create()
    {
        // $items = ServiceCat::where('type','service')->where('id','!=',4)->get();
        // $cat   = Category::where('user_id',auth()->user()->id)->get();
        $categories = Category::where('user_id', auth()->user()->id)->get();
        return view('user.restaurant.food.create',compact('categories'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            // 'category_id' => 'required',
            'title' => 'required|max:240',
            // 'slug' => 'required|max:250|unique:services',
            'text' => 'required',
            'price' => 'required',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:5120',
//            'file' => 'nullable|mimes:pdf|max:30720',
            // 'video_link' => 'required',
        ],
            [
                // 'category_id.required' => 'لطفا دسته بندی خدمت را انتخاب کنید',
                'title.required' => 'لطفا عنوان خدمت را وارد کنید',
                'title.max' => 'عنوان خدمت  نباید بیشتر از 240 کاراکتر باشد',
//                 'slug.required' => 'لطفا نامک را وارد کنید',
//                 'slug.max' => 'نامک نباید بیشتر از 250 کاراکتر باشد',
//                 'slug.unique' => ' نامک وارد شده یکبار ثبت شده',
                'text.required' => 'لطفا توضیحات را وارد کنید',
                'price.required' => 'لطفا هزینه را وارد کنید',
                'photo.required' => 'لطفا یک تصویر انتخاب کنید',
                'photo.image' => 'لطفا یک تصویر انتخاب کنید',
                'photo.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                'photo.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
// //                'file.mimes' => 'لطفا یک فایل با پسوند (pdf) انتخاب کنید',
// //                'file.max' => 'لطفا حجم فایل حداکثر 30 مگابایت باشد',
//                 // 'video_link.required' => 'لطفا لینک ویدیو را وارد کنید',
            ]);

        try {
            $item = new Service();
            $item->rom = $request->rom;
            $item->garanty_price = $request->garanty_price;
            $item->content = $request->content;
            $item->brand = $request->brand;
            $item->color = $request->color;
            $item->garanty = $request->garanty;
            $item->memory = $request->memory;
            $item->band_type = $request->band_type;
            $maxValue = Service::max('order') +1;
            $item->food_type = $request->food_type;
            $item->user_id = auth()->user()->id;
            $item->category_id = $request->category_id;
            $item->title = $request->title;
            $item->slug = $request->slug;
            $item->text = $request->text;
            $item->time_start = $request->time_start;
            $item->time_end = $request->time_end;
            $item->time = $request->time;
            $item->video_link = $request->video_link;
//            $item->info_plus = $request->info_plus;
            $item->limited = $request->limited;
            $item->order = $maxValue;
            $item->price = $request->price;
            $item->save();
            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $item->photo()->save($photo);
            }
//            if ($request->hasFile('file')) {
//                $file = new Filep();
//                $file->path = file_store($request->file, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/files/', 'file-');;
//                $item->file()->save($file);
//            }

            // return redirect()->route('user.index')->with('flash_message', ' آیتم با موفقیت ایجاد شد.');
            return redirect()->route('user.restaurant-foods.index')->with('flash_message', ' آیتم با موفقیت ایجاد شد.');
        } catch (\Exception $e) {

            return redirect()->back()->with('flash_message', 'مشکلی در ایجاد آیتم بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function edit($restaurant_food)
    {
        $food = Service::find($restaurant_food);
        $categories = Category::where('user_id', auth()->user()->id)->get();
        $food_photo = Photo::where('pictures_type', 'App\Model\Service')->where('pictures_id', $food->id)->first();
        return view('user.restaurant.food.edit', compact('food','categories','food_photo'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function update(Request $request, $restaurant_food)
    { 
        $this->validate($request, [
//             'category_id' => 'required',
//             // 'service_type' => 'required',
            // 'title' => 'required|max:240',
//             'slug' => 'required|max:250|unique:services,slug,'.$id,
            // 'text' => 'required',
            // 'price' => 'required',
            // 'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
// //            'file' => 'nullable|mimes:pdf|max:30720',
//             // 'video_link' => 'required',
        ],
            [
//                 'category_id.required' => 'لطفا دسته بندی خدمت را انتخاب کنید',
                // 'title.required' => 'لطفا عنوان خدمت را وارد کنید',
                // 'title.max' => 'عنوان خدمت  نباید بیشتر از 240 کاراکتر باشد',
//                 'slug.required' => 'لطفا نامک را وارد کنید',
//                 'slug.max' => 'نامک نباید بیشتر از 250 کاراکتر باشد',
//                 'slug.unique' => ' نامک وارد شده یکبار ثبت شده',
                // 'text.required' => 'لطفا توضیحات را وارد کنید',
                // 'price.required' => 'لطفا هزینه را وارد کنید',
                // 'photo.image' => 'لطفا یک تصویر انتخاب کنید',
                // 'photo.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                // 'photo.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
// //                'file.mimes' => 'لطفا یک فایل با پسوند (pdf) انتخاب کنید',
// //                'file.max' => 'لطفا حجم فایل حداکثر 30 مگابایت باشد',
//                 // 'video_link.required' => 'لطفا لینک ویدیو را وارد کنید',

            ]);
        $item = Service::find($restaurant_food);
        try {
            if ($request->food_type) {
                $item->food_type = $request->food_type;
            }
            if ($request->category_id) {
                $item->category_id = $request->category_id;
            }
            if ($request->service_type) {
                $item->service_type = $request->service_type;
            }
            if ($request->title) {
                $item->title = $request->title;
                $item->status = 'active';
            }
            if ($request->status) {
                $item->status = $request->status;
            }
            if ($request->text) {
                $item->text = $request->text;
            }
            if ($request->price) {
                $item->price = $request->price;
            }
            if ($request->limited) {
                $item->limited = $request->limited;
            }
            if ($request->brand) {
                $item->brand = $request->brand;
            }
            if ($request->color) {
                $item->color = $request->color;
            }
            if ($request->garanty) {
                $item->garanty = $request->garanty;
            }
            if ($request->memory) {
                $item->memory = $request->memory;
            }
            if ($request->band_type) {
                $item->band_type = $request->band_type;
            }

            if ($request->rom) {
                $item->rom = $request->rom;
            }
            if ($request->garanty_price) {
                $item->garanty_price = $request->garanty_price;
            }
            if ($request->content) {
                $item->content = $request->content;
            }
            $item->time_start = $request->time_start;
            $item->time_end = $request->time_end;
            $item->time = $request->time;
            $item->video_link = $request->video_link;
//            $item->info_plus = $request->info_plus;
            $item->update();
            if ($request->hasFile('photo')) {
                if ($item->photo)
                {
                    $old_path = $item->photo->path;
                    File::delete($old_path);
                    $item->photo->delete();
                }
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $item->photo()->save($photo);
            }
//            if ($request->hasFile('file')) {
//                if ($item->file)
//                {
//                    $old_path = $item->file->path;
//                    File::delete($old_path);
//                    $item->file->delete();
//                }
//                $file = new Filep();
//                $file->path = file_store($request->file, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/files/', 'file-');;
//                $item->file()->save($file);
//            }
            // return redirect()->route('user.index')->with('flash_message', 'آیتم با موفقیت ویرایش شد.');
            return redirect()->route('user.restaurant-foods.index')->with('flash_message', 'آیتم با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message', 'مشکلی در ویرایش آیتم بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function update2(Request $request) {
        try {
            $item = Service::find($request->id);
            switch ($request->column) {
                case 'food_type':
                    $item->food_type = $request->value;
                    break;
                case 'category_id':
                    $item->category_id = $request->value;
                    break;
                case 'service_type':
                    $item->service_type = $request->value;
                    break;
                case 'title':
                    $item->title = $request->value;
                    break;
                case 'text':
                    $item->text = $request->value;
                    break;
                case 'price':
                    $item->price = $request->value;
                    break;
                case 'limited':
                    $item->limited = $request->value;
                    break;
                case 'brand':
                    $item->brand = $request->value;
                    break;
                case 'color':
                    $item->color = $request->value;
                    break;
                case 'garanty':
                    $item->garanty = $request->value;
                    break;
                case 'status':
                    $item->status = $request->value;
                    break;
                case 'memory':
                    $item->memory = $request->value;
                    break;
                case 'band_type':
                    $item->band_type = $request->value;
                    break;
                case 'rom':
                    $item->rom = $request->value;
                    break;
                case 'content':
                    $item->content = $request->value;
                    break;
                case 'garanty_price':
                    $item->garanty_price = $request->value;
                    break;
            }
            $item->update();
            return response()->json('Ajax request submitted successfully');
        } catch (\Throwable $th) {
            return response()->json('مشگل در ارسال فورم صفحه را مجددا بارگیری کنید');
        }
    }

    public function destroy($id)
    {
        $item = Service::where('user_id', auth()->user()->id)->findOrFail($id);
        //TODO delete photos 
        try {
            // if(count($item->join))
            // {
            //     return redirect()->back()->withInput()->with('err_message', 'خدمت در پکیج تعریف شده و قابل حذف نمی باشد');
            // }
            $item->delete();
            return redirect()->back()->with('flash_message', 'آیتم با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message', 'مشکلی در حذف آیتم بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function active($id, $type)
    {
        $item = Service::find($id);
        try {
            $item->status = $type;
            $item->update();
            if ($type == 'pending') {
                return redirect()->back()->with('flash_message', 'نمایش خدمت با موفقیت غیرفعال شد.');
            }
            if ($type == 'active') {
                return redirect()->back()->with('flash_message', 'نمایش خدمت با موفقیت فعال شد.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message', 'مشکلی در تغییر وضعیت خدمت بوجود آمده،مجددا تلاش کنید');
        }
    }
    public function learn_index()
    {
        $items = Service::where('category_id',4)->paginate($this->controller_paginate());
        return view('admin.service.learn.index', compact('items'), ['title1' => 'خدمات', 'title2' => $this->controller_title('sum')]);
    }

    public function learn_create()
    {
        $items = ServiceCat::where('id','=',4)->get();
        return view('admin.service.learn.create',compact('items'), ['title1' => 'خدمات', 'title2' => 'افزودن خدمت']);
    }

    public function learn_store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:240',
            'slug' => 'required|max:250|unique:services',
            'text' => 'required',
            'price' => 'required',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'file' => 'nullable|mimes:pdf|max:30720',
            'video' => 'nullable|mimes:mp4|max:51200',
        ],
            [
                'category_id.required' => 'لطفا دسته بندی خدمت را انتخاب کنید',
                'title.required' => 'لطفا عنوان خدمت را وارد کنید',
                'title.max' => 'عنوان خدمت  نباید بیشتر از 240 کاراکتر باشد',
                'slug.required' => 'لطفا نامک را وارد کنید',
                'slug.max' => 'نامک نباید بیشتر از 250 کاراکتر باشد',
                'slug.unique' => ' نامک وارد شده یکبار ثبت شده',
                'text.required' => 'لطفا توضیحات را وارد کنید',
                'price.required' => 'لطفا هزینه را وارد کنید',
                'photo.required' => 'لطفا یک تصویر انتخاب کنید',
                'photo.image' => 'لطفا یک تصویر انتخاب کنید',
                'photo.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                'photo.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
                'file.mimes' => 'لطفا یک فایل با پسوند (pdf) انتخاب کنید',
                'file.max' => 'لطفا حجم فایل حداکثر 30 مگابایت باشد',
                'video.mimes' => 'لطفا یک ویدئو با پسوند (mp4) انتخاب کنید',
                'video.max' => 'لطفا حجم ویدئو حداکثر 50 مگابایت باشد',
            ]);
        try {
            $item = new Service();
            $item->category_id = $request->category_id;
            $item->title = $request->title;
            $item->slug = $request->slug;
            $item->text = $request->text;
            $item->time_start = $request->time_start;
            $item->time_end = $request->time_end;
            $item->time = $request->time;
//            $item->info_plus = $request->info_plus;
            $item->limited = $request->limited;
            $item->price = $request->price;
            $item->save();
            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $item->photo()->save($photo);
                img_resize(
                    $photo->path, //address img
                    $photo->path, //address save
                    500,// width: if width==0 -> width=auto
                    0 // height: if height==0 -> height=auto
                // end optimaiz
                );
            }
            if ($request->hasFile('file')) {
                $file = new Filep();
                $file->path = file_store($request->file, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/files/', 'file-');;
                $item->file()->save($file);
            }
            if ($request->hasFile('video')) {
                $video = new Video();
                $video->path = file_store($request->video, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/videos/', 'video-');;
                $item->video()->save($video);
            }
            return redirect()->route('admin.service.learn.list')->with('flash_message', ' خدمت با موفقیت ایجاد شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ایجاد خدمت بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function learn_edit($id)
    {
        $items = ServiceCat::where('id','=',4)->get();
        $item = Service::find($id);
        return view('admin.service.learn.edit', compact('items','item'), ['title1' => 'خدمات', 'title2' => 'ویرایش خدمت']);
    }

    public function learn_update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:240',
            'slug' => 'required|max:250|unique:services,slug,'.$id,
            'text' => 'required',
            'price' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'file' => 'nullable|mimes:pdf|max:30720',
            'video' => 'nullable|mimes:mp4|max:51200',
        ],
            [
                'category_id.required' => 'لطفا دسته بندی خدمت را انتخاب کنید',
                'title.required' => 'لطفا عنوان خدمت را وارد کنید',
                'title.max' => 'عنوان خدمت  نباید بیشتر از 240 کاراکتر باشد',
                'slug.required' => 'لطفا نامک را وارد کنید',
                'slug.max' => 'نامک نباید بیشتر از 250 کاراکتر باشد',
                'slug.unique' => ' نامک وارد شده یکبار ثبت شده',
                'text.required' => 'لطفا توضیحات را وارد کنید',
                'price.required' => 'لطفا هزینه را وارد کنید',
                'photo.image' => 'لطفا یک تصویر انتخاب کنید',
                'photo.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                'photo.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
                'file.mimes' => 'لطفا یک فایل با پسوند (pdf) انتخاب کنید',
                'file.max' => 'لطفا حجم فایل حداکثر 30 مگابایت باشد',
                'video.mimes' => 'لطفا یک ویدئو با پسوند (mp4) انتخاب کنید',
                'video.max' => 'لطفا حجم ویدئو حداکثر 50 مگابایت باشد',
            ]);
        $item = Service::find($id);
        try {
            $item->category_id = $request->category_id;
            $item->title = $request->title;
            $item->slug = $request->slug;
            $item->text = $request->text;
            $item->time_start = $request->time_start;
            $item->time_end = $request->time_end;
            $item->time = $request->time;
//            $item->info_plus = $request->info_plus;
            $item->limited = $request->limited;
            $item->price = $request->price;
            $item->update();
            if ($request->hasFile('photo')) {
                if ($item->photo)
                {
                    $old_path = $item->photo->path;
                    File::delete($old_path);
                    $item->photo->delete();
                }
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $item->photo()->save($photo);
                img_resize(
                    $photo->path, //address img
                    $photo->path, //address save
                    500,// width: if width==0 -> width=auto
                    0 // height: if height==0 -> height=auto
                // end optimaiz
                );
            }
            if ($request->hasFile('file')) {
                if ($item->file)
                {
                    $old_path = $item->file->path;
                    File::delete($old_path);
                    $item->file->delete();
                }
                $file = new Filep();
                $file->path = file_store($request->file, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/files/', 'file-');;
                $item->file()->save($file);
            }
            if ($request->hasFile('video')) {
                if ($item->video)
                {
                    $old_path = $item->video->path;
                    File::delete($old_path);
                    $item->video->delete();
                }
                $video = new Video();
                $video->path = file_store($request->video, 'source/asset/uploads/service/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/videos/', 'video-');;
                $item->video()->save($video);
            }
            return redirect()->route('admin.service.learn.list')->with('flash_message', 'خدمت با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ویرایش خدمت بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function learn_destroy($id)
    {
        $item = Service::find($id);
        try {
            if(count($item->join))
            {
                return redirect()->back()->withInput()->with('err_message', 'خدمت در پکیج تعریف شده و قابل حذف نمی باشد');
            }
            $item->delete();
            return redirect()->back()->with('flash_message', 'خدمت با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در حذف خدمت بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function learn_active($id, $type)
    {
        $item = Service::find($id);
        try {
            $item->status = $type;
            $item->update();
            if ($type == 'pending') {
                return redirect()->back()->with('flash_message', 'نمایش خدمت با موفقیت غیرفعال شد.');
            }
            if ($type == 'active') {
                return redirect()->back()->with('flash_message', 'نمایش خدمت با موفقیت فعال شد.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('flash_message', 'مشکلی در تغییر وضعیت خدمت بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function order($from, $to ,Request $request)
    {
        $itemf = Service::where('id',$from)->first();
        $from_order = $itemf->order;
        $itemf->order = rand(11111111,99999999)+$itemf->id;
        $itemf->save();

        $item = Service::where('id',$to)->first();
        $to_order = $item->order;
        $item->order = $from_order;
        $item->save();

        $item = Service::where('id',$from)->first();
        $item->order = $to_order;
        $item->save();

        return redirect()->back()->withInput();
    }
}


