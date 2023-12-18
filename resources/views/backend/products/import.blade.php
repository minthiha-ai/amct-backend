@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent">
                <a href="{{route('product')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Product Excel Import အသစ်ဖန်တီးမည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-9">
                        <form method="POST" action="{{route('product.excel.import')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="upload mb-3">
                                <div class="preview_img">
                                    <img src="{{ asset(config('app.companyInfo.logo')) }}" width=150 height=150 alt="">
                                </div>
                                <div class="round">
                                  <input type="file" class="form-control" name="file">
                                  <i class ="ri-file-fill" style = "color: #fff;"></i>
                                </div>
                            </div>
                            <div class="text-end submit-m-btn">
                                <button type="submit" class="submit-btn">Import</button>
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
@endsection
