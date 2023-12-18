@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent">
                <a href="{{ URL::previous() }}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Regions ကိုပြုပြင်မည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-9">
                        <form method="POST" action="{{route('region.update',$region->id)}}" id="delivery_create">
                            @csrf
                            <div class="mb-5">
                                <div class="ms-3 form-check form-switch">
                                    <input class="form-check-input" name="cod" type="checkbox" role="switch" id="flexSwitchCheckChecked" value="1" {{$region->cod == 1 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Cash On Delivery</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label mb-3">တိုင်း နှင့် ပြည်နယ်</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name',$region->name) }}" placeholder="Eg. region .....">
                            </div>
                            <div class="text-end submit-m-btn">
                                <button type="submit" class="submit-btn">အသစ်ပြုလုပ်မည်</button>
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreRegionRequest', '#delivery_create') !!}

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
    </script>
@endsection
