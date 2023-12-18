@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent">
                <a href="{{route('customer')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Customer အချက်အလက်ကိုပြုပြင်မည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-9">
                        <form method="POST" action="{{route('customer.update', $customer->id)}}" id="customer_edit">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="" class="form-label mb-3">အမည်</label>
                                <input type="text" class="form-control" name="name" value="{{$customer->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label mb-3">အီးမေးလ် / Email</label>
                                <input type="email" class="form-control" name="email" value="{{$customer->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label mb-3">ဖုန်းနံပါတ် / Phone</label>
                                <input type="number" class="form-control" name="phone" value="{{$customer->phone}}">
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
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent">
                <a href="{{route('customer')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Customer စကား၀ှက်ကိုပြောင်းလဲမည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-9">
                        <form method="POST" action="{{route('customer.updatePassword', $customer->id)}}" id="password_edit">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="" class="form-label mb-3">စကား၀ှက်အသစ် / New Password</label>
                                <input type="text" class="form-control" name="password" value="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label mb-3">စကားဝှက်အတည်ပြုခြင်း / Confirm Password</label>
                                <input type="text" class="form-control" name="password_confirmation" value="">
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

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateCustomerRequest', '#customer_edit') !!}
    {!! JsValidator::formRequest('App\Http\Requests\UpdateCustomerPasswordRequest', '#password_edit') !!}


@endsection
