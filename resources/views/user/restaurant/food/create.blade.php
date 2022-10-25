@extends('user.master')
@section('content')

    <section id="add-cat" class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="card res_table">
                    <div class="card-header">
                        <h5 class="card-title {{session()->get('locale')=='fa'? 'float-right' : 'float-left'}} mt-2">{{__('text.add').' '.__('text.food.title_single')}}</h5>
                    </div>
                    
                    <div class="card-body res_table_in">
                        <div class="modal-body">
                            {{ Form::open(array('route' => 'user.restaurant-foods.store', 'method' => 'POST', 'files' => true)) }}
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('slug', '* نامک') }}
                                        {{ Form::text('slug',null, array('class' => 'form-control')) }}
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    {{ Form::label('food_type', __('text.food.add_type')) }}
                                    <div class="form-group" style="display: flex">
                                        <br>
                                        <select id="food_type" name="food_type" class="form-control select2" required>
                                            @foreach ($categories as $item)
                                                <option value="{{$item->id}}" @if($categories[0]->id == $item->id) selected @endif @if($item->status=='deactivate') disabled @endif>
                                                    {{$item->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <a href="#" class="add-group-plus" data-toggle="modal" data-target="#addCategory">
                                            <i class="fa fa-plus mt-1 text-dark" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('brand', __('text.food.add_brand')) }}
                                    <div class="form-group" style="display: flex">
                                        <br>
                                        <select id="brand" name="brand" class="form-control select2">
                                            @foreach(\App\Model\Brand::all() as $key => $brand)
                                                <option value="{{$brand->title}}" @if($key==0) selected @endif>{{$brand->title}}</option>
                                            @endforeach
                                        </select>
                                        <a href="#" class="add-group-plus" data-toggle="modal" data-target="#addBrand">
                                            <i class="fa fa-plus mt-1 text-dark" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('title', __('text.food.add_name') ) }}
                                        {{ Form::text('title',null, array('class' => 'form-control','required' => 'required')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('garanty', __('text.food.add_garanty') ) }}
                                        {{ Form::text('garanty',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('garanty_price', __('text.food.add_garanty_price') ) }}
                                        {{ Form::number('garanty_price',null, array('class' => 'form-control','required' => 'required','onkeyup'=>'number_price(this.value)')) }}
                                        <span id="price_span" class="span_p"><span id="pp_price"></span>{{__('text.food.add_currency')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('price', __('text.food.add_price') ) }}
                                        {{ Form::number('price',null, array('class' => 'form-control','required' => 'required','onkeyup'=>'number_price(this.value)')) }}
                                        <span id="price_span" class="span_p"><span id="pp_price"></span>{{__('text.food.add_currency')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('rom', __('text.food.add_rom') ) }}
                                        <select id="rom" name="rom" class="form-control select2" required>
                                            <option value="ROM1" selected>ROM1</option>
                                            <option value="ROM2">ROM2</option>
                                            <option value="ROM3">ROM3</option>
                                            <option value="ROM4">ROM4</option>
                                            <option value="ROM6">ROM6</option>
                                            <option value="ROM8">ROM8</option>
                                            <option value="ROM10">ROM10</option>
                                            <option value="ROM12">ROM12</option>
                                            <option value="ROM16">ROM16</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('memory', __('text.food.add_memory') ) }}
                                        <select id="memory" name="memory" class="form-control select2" required>
                                            <option value="4GB" selected>4GB</option>
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
                                        <select id="band_type" name="band_type" class="form-control select2" required>
                                            <option value="3G-4G" selected>3G-4G</option>
                                            <option value="3G-4G-5G">3G-4G-5G</option>
                                            <option value="2G-3G">2G-3G</option>
                                            <option value="2G">2G</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('color', __('text.food.add_color') ) }}
                                        {{ Form::text('color',null, array('class' => 'form-control','required' => 'required','placeholder' => 'با ویرگول جدا کنید')) }}
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('info_plus', '* ارايه غذا') }}
                                        <select id="info_plus" name="info_plus" class="form-control">
                                            <option value=1 selected >غذا موجود هست</option>
                                            <option value=0 >غذا تمام شده</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 mt-lg-2">
                                    <label for="status">{{ __('text.food.add_status') }}</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="active" selected>{{__('text.food.add_show')}}</option>
                                        <option value="pending">{{__('text.food.add_dont_show')}}</option>
                                    </select>
                                </div>
                                {{-- <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('sale_count', '* تخفیف') }}
                                        {{ Form::number('sale_count',null, array('class' => 'form-control','onkeyup'=>'number_price2(this.value)')) }}
                                        <span id="sale_count_span" class="span_p"><span id="pp_sale_count"></span> تومان </span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('time', '* زمان تقریبی تهیه غذا (دقیقه)') }}
                                        {{ Form::number('time',null, array('class' => 'form-control text-left')) }}
                                        </div>
                                    </div> 
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('limited', '* تعداد غذا') }}
                                            {{ Form::number('limited',null, array('class' => 'form-control text-left')) }}
                                        </div>
                                    </div> --}}
                                <div class="col-md-6">
                                    <label for="exampleInputFile">{{ __('text.food.add_img_size') }}</label>
                                    <div class="btn btn-file mt-2 col-12 border" style="color: #6c757d;">
                                        {{ __('text.food.add_img') }}
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="photo" accept=".jpeg,.jpg,.png" required>
                                    </div>
                                    {{-- <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="photo" accept=".jpeg,.jpg,.png">
                                            <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('content', __('text.food.add_content')) }}
                                        {{ Form::text('content',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('text', __('text.food.add_description')) }}
                                        {{ Form::textarea('text',null, array('class' => 'form-control textarea text-start','rows' => 3,'required' => 'required','onkeyup'=>'number_price(this.value)')) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::button(__('text.add'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
                            <a class="btn btn-secondary text-light mx-1" href="{{url()->previous()}}">{{__('text.modal_btn2')}}</a>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>

    <div class="modal" id="addCategory">
        <div class="modal-dialog mt-5 pt-5">
            <div class="modal-content">
        
                <div class="modal-header">
                    <h5 class="modal-title">{{__('text.cat.add_cat')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
        
                <div class="modal-body">
                    {{Form::open(array('route' => 'user.restaurant-food-categories2-create2', 'method' => 'POST', 'files' => true)) }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('title', __('text.cat.cat_name')) }}
                                    {{ Form::text('title',null, array('class' => 'form-control','required' => 'required')) }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="status">{{ __('text.food.add_status') }}</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="active" selected>{{__('text.food.add_show')}}</option>
                                    <option value="deactivate">{{__('text.food.add_dont_show')}}</option>
                                </select>
                            </div>
                        </div>
                        {{ Form::button(__('text.add'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.modal_btn2')}}</button>
                    {{ Form::close() }}
                </div>
        
            </div>
        </div>
    </div>

    <div class="modal" id="addBrand">
        <div class="modal-dialog mt-5 pt-5">
            <div class="modal-content">
        
                <div class="modal-header">
                    <h5 class="modal-title">{{__('text.cat.add_cat')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
        
                <div class="modal-body">
                    {{Form::open(array('route' => 'user.restaurant-food-brands2-create2', 'method' => 'POST', 'files' => true)) }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('title', __('text.cat.cat_name')) }}
                                    {{ Form::text('title',null, array('class' => 'form-control','required' => 'required')) }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="status">{{ __('text.food.add_status') }}</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="active" selected>{{__('text.food.add_show')}}</option>
                                    <option value="deactivate">{{__('text.food.add_dont_show')}}</option>
                                </select>
                            </div>
                        </div>
                        {{ Form::button(__('text.add'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.modal_btn2')}}</button>
                    {{ Form::close() }}
                </div>
        
            </div>
        </div>
    </div>

@endsection

<script>
    function number_price(a){
        $('#pp_price').text(a);
        $('#pp_price_1').text(a);
        $('#pp_price').text(function (e, n) {
            var lir1= n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return lir1;
        })
    }
</script>