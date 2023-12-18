@extends('main')

@section('content')
   <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card card-animate bg-white my_card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-bold  text-truncate mb-0">
                                Total Orders</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-bold ff-secondary text-dark mb-4">
                                {{ App\Models\Order::count() }}
                            </h4>
                            <a href="{{ route('order') }}" class="text-decoration-underline text-dark-50">View all orders</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title rounded fs-3 bg-dark">
                                <i class="bx bx-shopping-bag"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card card-animate bg-white my_card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-bold  text-truncate mb-0">
                                 Pending Orders</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-bold ff-secondary text-dark  mb-4">
                                {{ App\Models\Order::where('status','pending')->count() }}
                            </h4>
                            <a href="{{route('orderByStatus','pending')}}" class="text-decoration-underline text-dark-50">View pending orders</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title rounded fs-3 bg-dark">
                                <i class="bx bx-shopping-bag"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card card-animate bg-white my_card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-bold  text-truncate mb-0">
                                Total Products </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-bold ff-secondary text-dark mb-4">
                                {{ App\Models\Product::count() }}
                            </h4>
                            <a href="{{ route('product') }}" class="text-decoration-underline text-dark-50">View products</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-dark rounded fs-3">
                                <i class="ri-product-hunt-fill"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card card-animate bg-white my_card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-bold  text-truncate mb-0">
                                Total Customers</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-bold ff-secondary text-dark mb-4">
                                {{ App\Models\Customer::count() }}
                            </h4>
                            <a href="{{ route('customer') }}" class="text-decoration-underline text-dark-50">View customers</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-dark rounded fs-3">
                                <i class="ri-user-3-fill"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>

   </div>
   <div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card my_card">
            <div class="card-header d-flex justify-content-between py-3 bg-transparent">
                <div class="d-flex align-items-center">
                    <span class="button_content">Top Products</span>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0" style="width:100%;">
                        <thead class="text-center text-muted" style="background: #F3F6F9" >
                            <th class="text-center">Image</th>
                            <th class="text-center">နာမည်</th>
                            <th class="text-center">Total Orders</th>
                        </thead>
                        <tbody>
                            @if ($topProducts->count() == 0)
                                <tr class="text-center">
                                    <td colspan="3" class="text-secondary">No data available in table</td>
                                </tr>
                            @else
                                @foreach ($topProducts as $item)
                                <tr class="text-center">
                                    <td>
                                        <img src="{{ $item->images->first()->path }}" class="thumbnail_img" alt="" srcset="">
                                    </td>
                                    <td>{{ strlen($item->name) > 15 ? substr($item->name,0,15).'.....' : $item->name }}</td>
                                    <td>{{ number_format($item->total_orders,) }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card my_card">
            <div class="card-header d-flex justify-content-between py-3 bg-transparent">
                <div class="d-flex align-items-center">
                    <span class="button_content">Top Customers</span>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0" style="width:100%;">
                        <thead class="text-center text-muted" style="background: #F3F6F9" >
                            <th class="text-center">နာမည်</th>
                            <th class="text-center">Email or Phone</th>
                            <th class="text-center">Total Amount</th>
                        </thead>
                        <tbody>
                            @if ($topCustomers->count() == 0)
                                <tr class="text-center">
                                    <td colspan="3" class="text-secondary">No data available in table</td>
                                </tr>
                            @else
                                @foreach ($topCustomers as $item)
                                <tr class="text-center">
                                    <td>{{ strlen($item->name) > 15 ? substr($item->name,0,15).'.....' : $item->name }}</td>
                                    <td>{{ $item->email ?? $item->phone }}</td>
                                    <td>{{ number_format($item->total_sales,) }} Ks</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
   </div>
@endsection
