@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent">
                <a href="{{route('currencies.index')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Currency ပြန်ပြင်မည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-9">
                        <form method="POST" action="{{route('currencies.update', $data->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="col-form-label">1 Yuan : </label>
                                </div>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input type="text" step=".1" class="form-control" name="kyats" value="{{ $data->kyats }}" placeholder="Enter Myanmar currency value" aria-label="Enter Myanmar currency value" aria-describedby="basic-addon2">
                                        <span class="input-group-text" id="basic-addon2">Kyats</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end submit-m-btn">
                                <button type="submit" class="submit-btn">currency ပြန်ပြင်မည်</button>
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
    {{-- {!! JsValidator::formRequest('App\Http\Requests\StoreCategoryRequest', '#category_create') !!}

    <script>
         $(document).ready(function() {
             $('#upload_img').on('change', function() {
                 let file_length = document.getElementById('upload_img').files.length;
                 if(file_length > 0) {
                     $('.preview_img').html('');
                     for(i = 0; i < file_length ; i++) {
                         $('.preview_img').html('');
                         $('.preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}" width=150 height =150/>`)
                     }
                 } else {
                     $('.preview_img').html(`<img src="{{ asset(config('app.companyInfo.logo')) }}" width=150 height=150 alt="">`);
                 }
             })
         })
    </script> --}}
@endsection
