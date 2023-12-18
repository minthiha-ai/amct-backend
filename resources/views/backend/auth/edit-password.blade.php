@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent d-flex justify-content-between py-4">
                <a href="{{route('dashboard')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">စကား၀ှက်ကိုပြောင်းလဲမည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-9">
                        @if (Session::has('passwordError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ Session::get('passwordError') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{route('updatePassword')}}" >
                            @csrf

                            <div class="mb-3">
                                <label for="" class="form-label mb-3">စကား၀ှက်အသစ် / New Password</label>
                                <input type="password" class="form-control" name="newPassword" placeholder="enter your new password..." required>
                                @error('newPassword')
                                    <small class="text-danger">{{ $message  }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label mb-3">စကားဝှက်အတည်ပြုခြင်း / Confirm Password</label>
                                <input type="password" class="form-control" name="confirmPassword" placeholder="enter your confirm password..." required>
                                @error('confirmPassword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-end submit-m-btn">
                                <button type="submit" class="submit-btn">စကား၀ှက်ကိုပြောင်းလဲမည်</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

