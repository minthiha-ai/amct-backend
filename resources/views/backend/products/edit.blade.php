@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent">
                <a href="{{route('product')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Product ကိုပြုပြင်မည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-12">
                        @if(Session::get('fail'))
                            <div class="alert alert-danger p-3 mb-3 text-center">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                        <form method="POST" action="{{route('product.update', $product->id)}}" id="product_update" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-switch form-switch-md form-switch-primary ms-2 mb-4 d-flex align-items-center">
                                        <input class="form-check-input mb-0" name="instock" type="checkbox" role="switch" id="SwitchCheck7" {{ old('instock',$product->instock) == 1 ? 'checked' : ''}} value="1">
                                        <label class="form-check-label mb-0" for="SwitchCheck7">Instock</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-label mb-3">အမည်</label>
                                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{$product->name}}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-label mb-3">စျေးနှုန်း</label>
                                        <input type="number" class="form-control" name="price" autocomplete="off" value="{{$product->yuan_price}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="category">အမျိူးအစား / Category</label>
                                        <select name="category_id" class="form-select select-2 mb-3" aria-label="Default select example" id='category'>
                                            <option selected disabled>အမျိူးအစား ရွေးပါ</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>
                                                    {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-4">
                                        <label class="form-label">စျေးနှုန်း(Kyats)<span class="text-muted">(*optional)</span></label>
                                        <input type="number" class="form-control" name="kyat_price" autocomplete="off" value="{{$product->price}}">
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="brand">အမှတ်တံဆိပ် / Brand</label>
                                            <select name="brand_id" class="form-select select-2 mb-3" aria-label="Default select example" id='brand'>
                                                <option selected disabled>အမှတ်တံဆိပ် ရွေးပါ</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{$brand->id}}" {{$brand->id == $product->brand_id ? 'selected' : ''}}>
                                                        {{$brand->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <label for="">Model</label>
                                        <select class="select-2 form-control" name="models[]" multiple="multiple">
                                            <option disabled>Model ရွေးပါ</option>
                                            @foreach ($models as $item)
                                                <option value="{{$item->id}}" @if(in_array($item->id, $product->modals->pluck('id')->toArray())) selected @endif>
                                                    {{$item->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-4">
                                            <label class="form-label">ယူနစ် / Unit</label>
                                            <input type="text" class="form-control" name="unit" autocomplete="off" value="{{ $product->unit }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                       <label for="" class="form-label">Type</label>
                                        <select class="select-2 form-control" name="types[]" multiple="multiple">
                                            <option disabled>Type ရွေးပါ</option>
                                            @foreach ($types as $item)
                                                <option value="{{$item->id}}" @if(in_array($item->id, $product->types->pluck('id')->toArray())) selected @endif>
                                                        {{$item->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-4">
                                                <label for="" class="form-label">Range</label>
                                                <select class="select-2 form-control" name="ranges[]" multiple="multiple">
                                                    <option disabled>Range ရွေးပါ</option>
                                                    @foreach ($ranges as $item)
                                                        <option value="{{$item->id}}" @if(in_array($item->id, $product->ranges->pluck('id')->toArray())) selected @endif>
                                                            {{$item->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="mb-5 mt-3">
                                <label for="description" class="form-label">အကြောင်းအရာ / Description</label>
                                <textarea class="form-control" name="description" id="description" rows="8">{{$product->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="images">Images</label>
                                <div class="input-images" id="images"></div>
                            </div>

                            <div class="text-end submit-m-btn">
                                <button type="submit" class="submit-btn">ပြင်ဆင်မှုများကိုသိမ်းမည်</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateProductRequest', '#product_update') !!}
    <script src="{{ asset('assets/js/image-uploader.min.js') }}"></script>
    <script>
        $.ajax({
            url: `/product-images/${`{{ $product->id }}`}`
            }).done(function(response) {
            if( response ){
                $('.input-images').imageUploader({
                    preloaded: response,
                    imagesInputName: 'images',
                    preloadedInputName: 'old',
                    maxSize: 2 * 1024 * 1024,
                    maxFiles: 10
                });
            }
        });

        $(document).ready(function() {
             $('.select-2').select2();
        });
    </script>
@endsection
