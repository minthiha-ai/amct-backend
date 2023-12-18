@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent d-flex justify-content-between py-4">
                <a href="{{route('dashboard')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Profile အချက်အလက်ကိုပြုပြင်မည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-9">
                        <form method="POST" action="{{route('profile.update')}}" id="edit-profile">
                            @csrf

                            <div class="mb-3">
                                <label for="" class="form-label mb-3">အမည်</label>
                                <input type="text" class="form-control" name="name" placeholder="enter your name..." value="{{ $data->name }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message  }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label mb-3">အီးမေးလ် / Email</label>
                                <input type="email" class="form-control" name="email" placeholder="enter your email..." value="{{ $data->email }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message  }}</small>
                                @enderror
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
    {!! JsValidator::formRequest('App\Http\Requests\UpdateAdminRequest', '#edit-profile') !!}
@endsection

