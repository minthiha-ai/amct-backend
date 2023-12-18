@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
                <a href="{{route('product')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Product အချက်အလက်</span>
                </a>
                <a class="primary_button" href="{{ route('product.edit',$product->id) }}">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-square-edit-outline btn_icon_size primary-icon mr-2"></i>
                        <span class="button_content">Product ကို ပြုပြင်မည်</span>
                    </div>
                </a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-12">
                        <table class="table table-bordered" style="width: 100%">
                            <tbody>
                                <tr>
                                    <th width="30%">အမည်</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">အမှတ်တံဆိပ် / Brand</th>
                                    <td>{{ $product->brand->name ??  '---' }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">အမျိူးအစား / Category</th>
                                    <td>{{ $product->category->name ?? '---' }}</td>
                                </tr>

                                <tr>
                                    <th width="30%">Model</th>
                                    <td>
                                        @foreach ($product->modals as $item)
                                            <div class="bg-light text-dark shadow-sm px-3 py-1 d-inline-block rounded mr-3">{{ $item->name }}</div>
                                        @endforeach
                                    </td>
                                </tr>


                                <tr>
                                    <th width="30%">Types</th>
                                    <td>
                                        @foreach ($product->types as $item)
                                            <div class="bg-light text-dark shadow-sm px-3 py-1 d-inline-block rounded mr-3">{{ $item->name }}</div>
                                        @endforeach
                                    </td>
                                </tr>


                                <tr>
                                    <th width="30%">Ranges</th>
                                    <td>
                                        @foreach ($product->ranges as $item)
                                            <div class="bg-light text-dark shadow-sm px-3 py-1 d-inline-block rounded mr-3">{{ $item->name }}</div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">
                                        <p class="mb-0 ">Unit</p>
                                    </th>
                                    <td class="">{{ $product->unit }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">
                                        <p class="mb-0 ">စျေးနှုန်း(Kyats)</p>
                                    </th>
                                    <td class="">{{ number_format($product->price)}} MMK</td>
                                </tr>
                                <tr>
                                    <th width="30%">
                                        <p class="mb-0 ">စျေးနှုန်း(Yuan)</p>
                                    </th>
                                    <td class="">{{ number_format($product->yuan_price)}} yuan</td>
                                </tr>
                                <tr>
                                    <th width="30%">
                                        <p class="mb-0 ">လက်ကျန်</p>
                                    </th>
                                    <td class="">
                                        <div class="badge rounded-pill {{ $product->instock ? 'badge-soft-success' : 'badge-soft-danger'}}">{{ $product->instock ? 'instock' : 'out of stock'}}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header bg-white">
                                <p class="mb-0">အကြောင်းအရာ / Description</p>
                            </div>
                            <div class="card-body">
                                <p>{{ $product->description ?? '---'}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header bg-white">
                                <p class="mb-0">Images</p>
                            </div>
                            <div class="card-body d-flex flex-wrap">
                                @foreach ($product->images as $img)
                                    <div class="mx-2 rounded">
                                        <img src="{{ $img->path }}" alt="{{ $product->name }}" class="rounded" srcset="" style="width: 500px; height: auto">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
      $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1800,
                width : '18em',
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        })
    </script>
@endsection

