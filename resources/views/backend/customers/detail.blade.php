@extends('main')

@section('content')
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="card my_card">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
                <a href="{{route('customer')}}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                    <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                    <span class="create_sub_title">Customer အချက်အလက်</span>
                </a>
                <a class="primary_button" href="{{ route('customer.edit',$customer->id) }}">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-square-edit-outline btn_icon_size primary-icon mr-2"></i>
                        <span class="button_content">Customer အချက်အလက်ကိုပြုပြင်မည်</span>
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
                                    <td>{{ $customer->name }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">အီးမေးလ် / Email</th>
                                    <td>{{ $customer->email ?? '-----'}}</td>
                                </tr>
                                <tr>
                                    <th width="30%">အီးမေးလ် / Phone</th>
                                    <td>{{ $customer->phone ?? '-----'}}</td>
                                </tr>
                                @if ($customer->is_banned == '1')
                                    <tr>
                                        <th width="30%">Is Banned</th>
                                        <td>
                                            <div class="badge bg-danger">Banned</div>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th width="30%">အကောင့်စဖွင့်ချိန် / Created At</th>
                                    <td>{{ $customer->created_at->diffForHumans()}}</td>
                                </tr>
                            </tbody>
                        </table>
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

