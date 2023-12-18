@extends('main')

@section('content')
<div class="card my_card">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h5 class="mb-0 text-dark">Currency</h5>
            <a class="primary_button" href="{{route('currencies.create')}}">
                <div class="d-flex align-items-center">
                    <i class=" ri-add-circle-fill mr-2 primary-icon"></i>
                    <span class="button_content">Currency သတ်မှတ်မည်</span>
                </div>
            </a>
        </div>
        <div class="card-body px-0">
            <div class="table-responsive">
                <table class="table" id="datatable" style="width:100%;">
                    <thead class="text-center bg-light text-muted">
                        <th class="text-center no-sort">Myanmar Kyat</th>
                        <th class="text-center no-sort">Chinese Yuan</th>
                        <th class="text-center no-sort no-search">ပြင်မည်/ဖျက်မည်</th>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($data as $item)
                        <tr>
                            <td>1 Yuan</td>
                            <td>{{ $item->kyats }} Kyats</td>
                            <td class="d-flex justify-content-center">
                                <div class="hstack gap-3 flex-warp">
                                    <a href="{{ route('currencies.edit', $item->id) }}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                    <a href="javascript:void(0);" class="link-danger fs-15" onclick="document.getElementById('deleteForm{{ $item->id }}').submit()"><i class="ri-delete-bin-line"></i></a>
                                    <form id="deleteForm{{ $item->id }}" action="{{ route('currencies.destroy', $item->id) }}" class="d-none" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection

@section('script')
    {{-- <script>
      $(document).ready(function() {
            let table = $('#datatable').DataTable( {
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/categories/datatable/ssd",
                language : {
                  "processing": "<img src='{{asset('/images/loading.gif')}}' width='50px'/><p></p>",
                  "paginate" : {
                    "previous" : '<i class="mdi mdi-chevron-triple-left"></i>',
                    "next" : '<i class="mdi mdi-chevron-triple-right"></i>',
                  }
                },
                columns : [
                  {data: 'image', name: 'image', class: 'text-center'},
                  {data: 'name', name: 'name', class: 'text-center'},
                  {data: 'product_count', name: 'product_count', class: 'text-center'},
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

            $(document).on('click', '.delete_btn', function(e) {
              e.preventDefault();
              swal({
                text: "Are you sure?",
                icon: "info",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                  let id = $(this).data('id');
                  $.ajax({
                    url : `/categories/${id}`,
                    method : 'DELETE',
                  }).done(function(res) {
                    let totalCount = $("#badgeTotalCount").text();
                        $('#badgeTotalCount').text(totalCount - 1);
                      table.ajax.reload();
                      Toast.fire({
                      icon: 'success',
                      title: "အောင်မြင်ပါသည်။"
                    })
                  })
                }
              });
            })
        })
    </script> --}}
@endsection
