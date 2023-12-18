@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent">
                <a href="{{route('product')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Product အသစ်ဖန်တီးမည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-12">
                        <form method="POST" action="{{route('product.store')}}" id="product_create" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-switch form-switch-md form-switch-primary ms-2 mb-4 d-flex align-items-center">
                                        <input class="form-check-input mb-0" name="instock" type="checkbox" role="switch" id="SwitchCheck7" checked value="1">
                                        <label class="form-check-label mb-0" for="SwitchCheck7">Instock</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-4">
                                        <label class="form-label">အမည်</label>
                                        <input type="text" class="form-control" name="name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-4">
                                        <label class="form-label">စျေးနှုန်း(Yuan)</label>
                                        <input type="number" class="form-control" name="price" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-4">
                                        <label for="category">အမျိူးအစား / Category</label>
                                        <select name="category_id" class="form-control  select-2" aria-label="Default select example" id='category'>
                                            <option selected disabled>Category ရွေးပါ</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">
                                                    {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-4">
                                        <label class="form-label">စျေးနှုန်း(Kyats)<span class="text-muted">(*optional)</span></label>
                                        <input type="number" class="form-control" name="kyat_price" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-4">
                                        <label for="brand">အမှတ်တံဆိပ် / Brand</label>
                                        <select name="brand_id" class="form-control select-2" aria-label="Default select example" id='brand'>
                                            <option selected disabled>Brand ရွေးပါ</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}">
                                                    {{$brand->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-4">
                                        <label for="">Model</label>
                                        <select class="select-2 form-control" name="models[]" multiple="multiple">
                                            <option disabled>Model ရွေးပါ</option>
                                            @foreach ($models as $item)
                                            <option value="{{$item->id}}">
                                                {{$item->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-4">
                                        <label class="form-label">ယူနစ် / Unit</label>
                                        <input type="text" class="form-control" name="unit" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-4">
                                        <label for="" class="form-label">Type</label>
                                        <select class="select-2 form-control" name="types[]" multiple="multiple">
                                            <option disabled>Type ရွေးပါ</option>
                                            @foreach ($types as $item)
                                            <option value="{{$item->id}}">
                                                {{$item->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                                            <option value="{{$item->id}}">
                                                {{$item->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="form-label">အကြောင်းအရာ / Description</label>
                                <textarea class="form-control" name="description" id="description" rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="images">Images</label>
                                <div class="input-images" id="images"></div>
                            </div>

                            <div class="text-end submit-m-btn">
                                <button type="submit" class="submit-btn">Product အသစ်ပြုလုပ်မည်</button>
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreProductRequest', '#product_create') !!}
    <script src="{{ asset('assets/js/image-uploader.min.js') }}"></script>
    <script>
        $(".input-images").imageUploader({
            maxSize: 2 * 1024 * 1024,
            maxFiles: 10,
        });
        $(document).ready(function() {
             $('.select-2').select2();
        });
    </script>
@endsection
