@extends('user.master')
@section('content')
    <style>
        #chunk div {
            font-size: 10px;
        }
    </style>
    <section class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="card res_table">
                    <div class="card-header pb-0">
                        <h5 class="card-title {{session()->get('locale')=='fa'? 'float-right' : 'float-left'}} mt-2">{{__('text.food.title_sum')}}</h5>
                        <button class="btn btn-success mx-3 mb-1" onclick="generatePDF()">پرینت این لیست</button>
                        <div class="dropdown px-1 {{session()->get('locale')=='fa'? 'float-left' : 'float-right'}}" style="position: unset;">
                            <button class="btn btn-secondary dropdown-toggle" style="font-size: 13px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 تعداد نمایش در هر ستون
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li class="border-bottom px-2"><a class="fix" href="{{route('user.print-custom-index',10)}}" title="category">10 آیتم در هر ستون</a></li>
                                    <li class="border-bottom px-2"><a class="fix" href="{{route('user.print-custom-index',25)}}" title="category">25 آیتم در هر ستون</a></li>
                                    <li class="border-bottom px-2"><a class="fix" href="{{route('user.print-custom-index',50)}}" title="category">50 آیتم در هر ستون</a></li>
                                    <li class="border-bottom px-2"><a class="fix" href="{{route('user.print-custom-index',100)}}" title="category">100 آیتم در هر ستون</a></li>
                                    <li class="border-bottom px-2"><a class="fix" href="{{route('user.print-custom-index',150)}}" title="category">150 آیتم در هر ستون</a></li>
                                    <li class="border-bottom px-2"><a class="fix" href="{{route('user.print-custom-index',200)}}" title="category">200 آیتم در هر ستون</a></li>
                                    <li class="border-bottom px-2"><a class="fix" href="{{route('user.print-custom-index',250)}}" title="category">250 آیتم در هر ستون</a></li>
                                    <li class="border-bottom px-2"><a class="fix" href="{{route('user.print-custom-index',350)}}" title="category">350 آیتم در هر ستون</a></li>
                                    <li class="border-bottom px-2"><a class="fix" href="{{route('user.print-custom-index',450)}}" title="category">450 آیتم در هر ستون</a></li>
                            </div>
                        </div>
                    </div>
                    <div id="example2">
                        @csrf
                        <div class="row mb-0 p-3">
                            <div class="col-3 text-end">
                                <img src="{{url(\App\Model\ServiceCat::where('user_id', auth()->user()->id)->first()->banner)}}" alt="banner" style="width: 140px;height: 60px;">
                            </div>
                            <div class="col my-auto text-center">
                                به علت نوسات لحظه ای قیمت های بازار بهتر است هنگام خرید قیمت های نهایی را از فروسگاه اسکای موبایل استعلام کنید
                                <br>
                                {{' آدرس : '.\App\Model\ServiceCat::where('user_id', auth()->user()->id)->first()->address.' شماره تماس :‌ '.\App\Model\ServiceCat::where('user_id', auth()->user()->id)->first()->dial}}

                            </div>
                            <div class="col-3 my-auto ">
                                {{' تاریخ بروزرسانی : '.my_jdate(\Carbon\Carbon::now(),'d F Y')}}
                                <br>
                                {{' ساعت : '.\Carbon\Carbon::now()->format('H:i')}}
                            </div>
                        </div>
                        <div class="row px-3" id="chunk" style="direction: ltr;">

                            @foreach($foods->chunk($myCount) as $lists)
                                <div class="col-lg-3 p-0">
                                    @foreach(\App\Model\Brand::all() as $brand)
                                        @if($lists->where('brand', $brand->title)->count())
                                            <div class="col p-1 bg-dark text-center text-white h6 my-0 mx-1 mx-xl-2">
                                                {{$brand->title}}
                                            </div>
                                            @foreach($lists->where('brand', $brand->title) as $item)
                                                <div class="mx-3">
                                                    <div class="row mb-0 py-0 p-1 text-center border-bottom" style="direction: ltr;">
                                                        <div class="col-6 p-0 p-1 border border-dark">
                                                            {{$item->title.' | '.$item->memory.' | '.$item->band_type}}
                                                        </div>
                                                        <div class="col p-0 p-1 border border-dark">{{str_replace(',',' ',$item->color)}}</div>
                                                        <div class="col p-0 p-1 border border-dark">
                                                            {{' فی عادی '.$item->price}}
                                                        </div>
                                                        <div class="col p-0 border border-dark">
                                                            {{' فی گارانتی '.$item->garanty_price}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="pag_ul">
                    {{-- {{ $foods->count()? $foods->appends(request()->query())->links(): '' }} --}}
                </div>
            </div>
        </div>
    </section>
    @unless ($foods->count())
        <h6 class="text-center text-danger">موردی یافت نشد</h6>
    @endunless
    @foreach($foods as $food)
        {{-- delete category --}}
        <div class="modal" id="deleteFood{{$food->id}}">
            <div class="modal-dialog mt-5 pt-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title text-danger">{{__('cat.modal_title')}}</h6>
                        <button type="button" class="close" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(array('route' => array('user.restaurant-foods.destroy', $food->id), 'method' => 'DELETE', 'files' => true)) }}
                            <h6 class="mb-3">{{__('cat.modal_body').' '.$food->title}}</h6>
                            {{ Form::button(__('cat.modal_btn'), array('type' => 'submit', 'class' => 'btn btn-danger')) }}
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cat.modal_btn2')}}</button>
                        {{ Form::close() }}
                    </div>
            
                </div>
            </div>
        </div>
        {{-- end delete category --}}
    @endforeach
      
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('user.print-search') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{__('text.search')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::label('food_type', __('text.food.add_type')) }}
                                <div class="form-group">
                                    <select id="food_type" name="food_type" class="form-control select2" required>
                                        <option value="all" selected >همه</option>
                                        @foreach (\App\Model\Category::where('status','!=','deactivate')->get() as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('brand', __('text.food.add_brand')) }}
                                <div class="form-group">
                                    <select id="brand" name="brand" class="form-control select2" required>
                                        <option value="all" selected >همه</option>
                                        <option value="اپل" >اپل</option>
                                        <option value="سامسونگ" >سامسونگ</option>
                                        <option value="هواوی" >هواوی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('garanty', __('text.food.add_garanty') ) }}
                                    <input type="text" name="garanty" id="garanty" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('color', __('text.food.add_color') ) }}
                                    <input type="text" name="color" id="color" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('memory', __('text.food.add_memory') ) }}
                                    <input type="text" name="memory" id="memory" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('band_type', __('text.food.add_band_type') ) }}
                                    <select id="band_type" name="band_type" class="form-control select2" required>
                                        <option value="all" selected>همه</option>
                                        <option value="3G-4G">3G-4G</option>
                                        <option value="3G-4G-5G">3G-4G-5G</option>
                                        <option value="2G-3G">2G-3G</option>
                                        <option value="2G">2G</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">{{__('text.search')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.modal_btn2')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>      
    <script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
    {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
    <script>
        function updateForm(element, item) {
            // console.log(event.keyCode);
            let right = 39;
            let left  = 37;
            if (window.event.keyCode == left) {
                $(".move:focus").parent().next().find(".move").focus();
            }
            if (window.event.keyCode == right) {
                $(".move:focus").parent().prev().find(".move").focus();
            }
            if (window.event.keyCode == left || window.event.keyCode == right) {
                // $.ajax({
                //     url: "restaurant-foods/ajax/update2",
                //     type: "POST",
                //     data: {
                //         id : item,
                //         column: element,
                //         value: $(`input[id=${element}${item}]`).val(),
                //         _token: $('input[name="_token"]').val(),
                //     },
                //     success:function(response) {
                //         console.log(response);
                //     },
                //     error: function(error) {
                //         console.log(error);
                //     },
                // });
            }
        };
    </script>
@endsection
