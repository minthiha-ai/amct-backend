@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent">
                <a href="{{route('product.color')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Color ကိုပြုပြင်မည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-9">
                        <form method="POST" action="{{route('product.color.update', $productColor->id)}}" id="color_update" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="employeeName" class="form-label mb-3">အမည် ( English )</label>
                                <input type="text" class="form-control" name="english_name" value="{{$productColor->english_name}}">
                            </div>
                            <div class="mb-3">
                                <label for="employeeName" class="form-label mb-3">အမည် ( Myanmar )</label>
                                <input type="text" class="form-control" name="myanmar_name" value="{{$productColor->myanmar_name}}">
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreColorRequest', '#color_update') !!}
@endsection