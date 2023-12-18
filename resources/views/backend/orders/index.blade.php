@extends('main')

@section('content')
    <div class="card order my_card">
        <div class="card-header d-flex justify-content-between py-4 align-items-center bg-transparent">
            <h5 class="mb-0 text-dark text-capitalize">Order Histories - <div class="badge badge-myColor">{{ App\Models\Order::count() }}</div></h5>
        </a>
    </div>
        <div class="card-body px-0">
            <div class="table-responsive">
                <table class="table table-borderless table-hover" id="datatable" style="width:100%;">
                    <thead class="text-center border-0 text-muted" style="background: #F3F6F9">
                        <th class="text-center no-sort">နာမည်</th>
                        <th class="text-center no-sort">နေရပ်လိပ်စာ / Address</th>
                        <th class="text-center no-sort">ငွေပေးချေမှုနည်းလမ်း / Payment Methods</th>
                        <th class="text-center no-sort no-search">အချိန်</th>
                        <th class="text-center no-sort no-search">Status</th>
                        <th class="text-center no-sort no-search">Remark</th>
                        <th class="text-center no-sort no-search">Control</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
      $(document).ready(function() {
            let table = $('#datatable').DataTable( {
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '/all-orders/datatable/ssd/',
                },
                language : {
                  "processing": "<img src='{{asset('/images/loading.gif')}}' width='50px'/><p></p>",
                  "paginate" : {
                    "previous" : '<i class="mdi mdi-chevron-triple-left"></i>',
                    "next" : '<i class="mdi mdi-chevron-triple-right"></i>',
                  }
                },
                columns : [
                  {data: 'name', name: 'name' , class: 'text-center'},
                  {data: 'address', name: 'address' , class: 'text-center'},
                  {data: 'payment_method', name: 'payment_method' , class: 'text-center'},
                  {data: 'created_at', name: 'created_at' , class: 'text-center'},
                  {data: 'status', name: 'status' , class: 'text-center'},
                  {data: 'remark', name: 'remark' , class: 'text-center'},
                  {data: 'action', name: 'action', class: 'text-center'},
                ],
                columnDefs : [
                  {
                    targets : 'hidden',
                    visible : false,
                    searchable : false,
                  },
                  {
                    targets : 'no-sort',
                    sortable : false,
                  },
                  {
                    targets : 'no-search',
                    searchable : false,
                  },
                  {
                    targets: [0],
                    class : "control"
                  },
                ]
            });

        })
    </script>
@endsection
