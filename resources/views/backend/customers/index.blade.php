@extends('main')

@section('content')
    <div class="card my_card">
        <div class="card-header d-flex justify-content-between py-4 align-items-center bg-transparent">
                <h5 class="mb-0 text-dark">Customers - <div class="badge badge-myColor" id="badgeTotalCount">{{ App\Models\Customer::count() }}</div></h5>
            </a>
        </div>

        <div class="card-body px-0">
            <div class="table-responsive">
                <table class="table  table-hover" id="datatable" style="width:100%;">
                    <thead class="text-center text-muted" style="background: #F3F6F9">
                        <th class="text-center no-sort">အမည် / Name</th>
                        <th class="text-center no-sort">အီးမေးလ် / Email</th>
                        <th class="text-center no-sort">ဖုန်းနံပါတ် / Phone</th>
                        <th class="text-center no-sort no-search">ပြင်မည်/ဖျက်မည်</th>
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
                ajax: "/customers/datatable/ssd",
                language : {
                    "searchPlaceholder": "By Email",
                  "processing": "<img src='{{asset('/images/loading.gif')}}' width='50px'/><p></p>",
                  "paginate" : {
                    "previous" : '<i class="mdi mdi-chevron-triple-left"></i>',
                    "next" : '<i class="mdi mdi-chevron-triple-right"></i>',
                  }
                },
                columns : [
                  {data: 'name', name: 'name', class: 'text-center'},
                  {data: 'email', name: 'email' , class: 'text-center'},
                  {data: 'phone', name: 'phone' , class: 'text-center'},
                  {data: 'action', name: 'action' , class: 'text-center'},
                  {data: 'is_banned', name: 'is_banned' , class: 'text-center'},
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


            $(document).on('click', '.ban_btn', function(e) {
              e.preventDefault();
              let id = $(this).data('id');
              customerBan('1',id);

            })

            $(document).on('click', '.unban_btn', function(e) {
              e.preventDefault();
              let id = $(this).data('id');
              customerBan('0',id);

            })

            function customerBan(isBanned,id){
                swal({
                text: "Are you sure?",
                icon: "info",
                buttons: true,
                dangerMode: true,
              })
              .then((response) => {
                if (response) {
                  $.ajax({
                    url : `/customers/ban/${id}`,
                    method : 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        'is_banned': isBanned,
                    },
                  }).done(function(res) {
                    let totalCount = $("#badgeTotalCount").text();
                        $('#badgeTotalCount').text(totalCount - 1);
                      table.ajax.reload();
                      Swal.fire({
                            icon: 'success',
                            title: `"${res.customerName}" has been ${ isBanned == '1' ? 'banned' : 'unbanned' } !`,
                            showConfirmButton: false,
                            timer: 1800
                        });
                  })
                }
              });
            }
        })
    </script>
@endsection
