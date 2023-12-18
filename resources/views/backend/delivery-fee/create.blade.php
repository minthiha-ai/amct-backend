@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header bg-transparent">
                <a href="{{route('deliveryfee')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Delivery Fee အသစ်ဖန်တီးမည်</span>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-9">
                        <form method="POST" action="{{route('deliveryfee.store')}}" enctype="multipart/form-data" id="delivery_create">
                            @csrf

                            <div class="mb-3">
                                <label for="">တိုင်း နှင့် ပြည်နယ်</label>
                                <select name="region_id" class="form-control" id="">
                                    @foreach ($regions as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label mb-3">မြို့</label>
                                <input type="text" class="form-control" name="city" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label mb-3">ကျသင့်ငွေ</label>
                                <input type="number" class="form-control" name="fee">
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreDeliveryFeeRequest', '#delivery_create') !!}
@endsection
