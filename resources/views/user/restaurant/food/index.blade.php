@extends('user.master')
@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="card res_table">
                    <div class="card-header pb-0">
                        <h5 class="card-title {{session()->get('locale')=='fa'? 'float-right' : 'float-left'}} mt-2">{{__('text.food.title_sum')}}</h5>
                        <a href="{{ route('user.restaurant-foods.create') }}" class="{{session()->get('locale')=='fa'? 'float-left' : 'float-right'}} bg-primary rounded p-1 px-3 text-light">{{ __('text.add') }}</a>
                        @if (\Request::route()->getName()=='user.restaurant-foods.index'||\Request::route()->getName()=='user.restaurant-foods-show2'||\Request::route()->getName()=='user.restaurant-foods.show')
                            @if ($categories->count())
                                <div class="dropdown px-1 {{session()->get('locale')=='fa'? 'float-left' : 'float-right'}}" style="position: unset;">
                                    <button class="btn btn-secondary dropdown-toggle mx-2" style="font-size: 13px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if(isset($category_id)) {{App\Model\Category::where('id',$category_id)->first()->title}} @else همه {{ __('text.food.cats') }} @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach($categories as $ServiceCat)
                                            <li class="border-bottom px-2"><a class="fix" href="{{route('user.restaurant-foods.show',$ServiceCat->id)}}" title="category">{{$ServiceCat->title}}</a></li>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if ($categories->count())
                                <div class="dropdown px-1 {{session()->get('locale')=='fa'? 'float-left' : 'float-right'}}" style="position: unset;">
                                    <button class="btn btn-secondary dropdown-toggle" style="font-size: 13px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if(isset($brand_title)) {{\App\Model\Brand::where('title',$brand_title)->first()->title}} @else همه {{ __('text.food.brand') }} @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach(\App\Model\Brand::all() as $brand)
                                            <li class="border-bottom px-2"><a class="fix" href="{{route('user.restaurant-foods-show2',$brand->title)}}" title="category">{{$brand->title}}</a></li>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif
                        <button data-toggle="modal" data-target="#exampleModalLong" 
                        class="btn btn-secondary mx-2 {{session()->get('locale')=='fa'? 'float-left' : 'float-right'}}" style="font-size: 13px;"><i class="fa fa-search"></i></button>

                        <a href="{{ route('user.print.index') }}" class="{{session()->get('locale')=='fa'? 'float-right' : 'float-left'}} bg-dark rounded p-1 px-3 mx-2 text-light">Print</a>
                    </div>
                    <div class="h6 p-3">
                        برای ویرایش مقدار را تغییر داده
                        <br>
                        برای پیمایش سریع از کلید راست - چپ و بالا- پایین استفاده کنید
                    </div>
                    <div id="example2">
                        <div class="row text-center m-0">
                            {{-- <div class="col p-0 border">
                                    {{ __('text.food.brand') }}
                            </div> --}}
                            <div class="col p-0 border">
                                {{ __('text.food.name') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.price') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.add_garanty_price') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.add_garanty') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.add_rom') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.add_memory') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.add_band_type') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.add_content') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.add_color') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.add_description') }}
                            </div>
                            <div class="col p-0 border">
                                {{ __('text.food.actions') }}
                            </div>
                        </div>
                        @csrf
                        @foreach($foods as $item)
                            <div class="row mb-0 p-2 text-center sss border-bottom">
                                {{-- <div class="col">
                                    <select id="brand{{$item->id}}" name="brand" onchange="updateForm2('brand','{{$item->id}}')" class="form-control select2">
                                        @foreach(\App\Model\Brand::all() as $brand)
                                            <option value="{{$brand->title}}" @if($item->brand==$brand->title) selected @endif>{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col">
                                    <input type="text" name="title" class="form-control" id="title{{$item->id}}" onchange="updateForm('title','{{$item->id}}')" value="{{$item->title}}">
                                </div>
                                <div class="col">
                                    <input type="text" name="price" class="form-control move" id="price{{$item->id}}" onchange="updateForm('price','{{$item->id}}')" value="{{$item->price}}">
                                </div>
                                <div class="col">
                                    <input type="text" name="garanty_price" class="form-control move" id="garanty_price{{$item->id}}" onchange="updateForm('garanty_price','{{$item->id}}')" value="{{$item->garanty_price}}">
                                </div>
                                <div class="col">
                                    <input type="text" name="garanty" class="form-control" id="garanty{{$item->id}}" onchange="updateForm('garanty','{{$item->id}}')" value="{{$item->garanty}}">
                                </div>
                                <div class="col">
                                    <select id="rom{{$item->id}}" name="rom" class="form-control select2" onchange="updateForm2('rom','{{$item->id}}')" >
                                        <option value="ROM1" @if($item->rom=='ROM1') selected @endif>ROM1</option>
                                        <option value="ROM2" @if($item->rom=='ROM2') selected @endif>ROM2</option>
                                        <option value="ROM3" @if($item->rom=='ROM3') selected @endif>ROM3</option>
                                        <option value="ROM4" @if($item->rom=='ROM4') selected @endif>ROM4</option>
                                        <option value="ROM6" @if($item->rom=='ROM6') selected @endif>ROM6</option>
                                        <option value="ROM8" @if($item->rom=='ROM8') selected @endif>ROM8</option>
                                        <option value="ROM10" @if($item->rom=='ROM10') selected @endif>ROM10</option>
                                        <option value="ROM12" @if($item->rom=='ROM12') selected @endif>ROM12</option>
                                        <option value="ROM16" @if($item->rom=='ROM16') selected @endif>ROM16</option>
                                    </select>
                                    {{-- <input type="text" name="rom" class="form-control move" id="rom{{$item->id}}" onchange="updateForm('rom','{{$item->id}}')" value="{{$item->rom}}"> --}}
                                </div>
                                <div class="col">
                                    <select id="memory{{$item->id}}" name="memory" class="form-control select2" onchange="updateForm2('memory','{{$item->id}}')">
                                        <option value="4GB" @if($item->memory=='4GB') selected @endif>4GB</option>
                                        <option value="8GB" @if($item->memory=='8GB') selected @endif>8GB</option>
                                        <option value="16GB" @if($item->memory=='16GB') selected @endif>16GB</option>
                                        <option value="32GB" @if($item->memory=='32GB') selected @endif>32GB</option>
                                        <option value="64GB" @if($item->memory=='64GB') selected @endif>64GB</option>
                                        <option value="128GB" @if($item->memory=='128GB') selected @endif>128GB</option>
                                        <option value="256GB" @if($item->memory=='256GB') selected @endif>256GB</option>
                                        <option value="512GB" @if($item->memory=='512GB') selected @endif>512GB</option>
                                        <option value="1TB" @if($item->memory=='1TB') selected @endif>1TB</option>
                                    </select>
                                    {{-- <input type="text" name="memory" class="form-control move" id="memory{{$item->id}}" onchange="updateForm('memory','{{$item->id}}')" value="{{$item->memory}}"> --}}
                                </div>
                                <div class="col">
                                    <select id="band_type{{$item->id}}" name="band_type" class="form-control select2" onchange="updateForm2('band_type','{{$item->id}}')">
                                        <option value="3G-4G"  @if($item->band_type=='3G-4G') selected @endif>3G-4G</option>
                                        <option value="3G-4G-5G" @if($item->band_type=='3G-4G-5G') selected @endif>3G-4G-5G</option>
                                        <option value="2G-3G" @if($item->band_type=='2G-3G') selected @endif>2G-3G</option>
                                        <option value="2G" @if($item->band_type=='2G') selected @endif>2G</option>
                                    </select>
                                    {{-- <input type="text" name="band_type" class="form-control move" id="band_type{{$item->id}}" onchange="updateForm('band_type','{{$item->id}}')" value="{{$item->band_type}}"> --}}
                                </div>
                                <div class="col">
                                    <input type="text" name="content" class="form-control" id="content{{$item->id}}" onchange="updateForm('content','{{$item->id}}')" value="{{$item->content}}">
                                </div>
                                <div class="col">
                                    <input type="text" name="color" class="form-control" id="color{{$item->id}}" onchange="updateForm('color','{{$item->id}}')" value="{{$item->color}}">
                                </div>
                                <div class="col">
                                    <input type="text" name="text" class="form-control" id="text{{$item->id}}" onchange="updateForm('text','{{$item->id}}')" value="{{$item->text}}">
                                </div>
                                <div class="col">
                                    <a href="{{route('user.restaurant-foods.edit', $item->id)}}" class="badge bg-primary ml-1" title="{{ __('text.delete') }}"><i class="fa fa-edit"></i> </a>
                                    <a href="#" data-toggle="modal" data-target="#deleteFood{{$item->id}}" class="badge bg-danger mx-1" title="{{ __('text.edit') }}"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                            </form>
                        @endforeach
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
                <form action="{{ route('user.restaurant-foods-search') }}" method="post">
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
                                        @foreach(\App\Model\Brand::all() as $brand)
                                            <option value="{{$brand->title}}">{{$brand->title}}</option>
                                        @endforeach
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
                                    <select id="memory" name="memory" class="form-control select2">
                                        <option value="all" selected>همه</option>
                                        <option value="4GB">4GB</option>
                                        <option value="8GB">8GB</option>
                                        <option value="16GB">16GB</option>
                                        <option value="32GB">32GB</option>
                                        <option value="64GB">64GB</option>
                                        <option value="128GB">128GB</option>
                                        <option value="256GB">256GB</option>
                                        <option value="512GB">512GB</option>
                                        <option value="1TB">1TB</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('band_type', __('text.food.add_band_type') ) }}
                                    <select id="band_type" name="band_type" class="form-control select2">
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
        $(document).keydown(function(e) {
            let left    = 37;
            let top     = 38;
            let right   = 39;
            let bottom  = 40;
            
            if (window.event.keyCode == left) {
                $(".move:focus").parent().next().find(".move").focus();
            } else if (window.event.keyCode == right) {
                $(".move:focus").parent().prev().find(".move").focus();
            } else if (window.event.keyCode == top) {
                $(".move:focus").closest(".sss").prev().find(".move").focus();
            } else if (window.event.keyCode == bottom) {
                $(".move:focus").closest(".sss").next().find(".move").focus();
            }
        });
        function updateForm(element, item) {
            $.ajax({
                type: "POST",
                url: 'restaurant-foods/ajax/update2',
                data: {
                    id : item,
                    column: element,
                    value: $(`input[id=${element}${item}]`).val(),
                    _token: $('input[name="_token"]').val(),
                },
                // DataType:"text/html",
                success: function (response) {
                    console.log("success : "+response.success); 
                },error: function(response){
                    alert("error : "+response.error);
                }
            });
        }
        function updateForm2(element, item) {
            $.ajax({
                type: "POST",
                url: 'restaurant-foods/ajax/update2',
                data: {
                    id : item,
                    column: element,
                    value: $(`#${element}${item} :selected`).val(),
                    _token: $('input[name="_token"]').val(),
                },
                // DataType:"text/html",
                success: function (response) {
                    console.log("success : "+response); 
                },error: function(response){
                    alert("error : "+response.error);
                }
            });
        }
    </script>
@endsection
