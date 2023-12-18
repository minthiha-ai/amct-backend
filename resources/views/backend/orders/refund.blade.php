@extends('main')

@section('content')
<div class="row">

    <div class="col-12">
        <div class="card bg-white my_card">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ URL::previous() }}" class="card-title mb-0 d-inline-flex align-items-center create_title">
                        <i class=" ri-arrow-left-s-line mr-3 primary-icon"></i>
                        <span class="create_sub_title">Order Refund လုပ်မည်</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-6">
                        <label for="">Order အချက်အလက်</label>
                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle table-bordered mb-0">
                                  <tbody>
                                    <tr>
                                        <th width="20%">Name</th>
                                        <td>{{ $order['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Phone</th>
                                        <td>{{ $order['phone'] }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Address</th>
                                        <td>{{ $order['address'] }}</td>
                                    </tr>

                                    <tr>
                                        <th width="20%">Payment Type</th>
                                        <td>{{ $order['payment_method'] == 'payment' ? $order['payment']['payment_type'] : 'cod' }}</td>
                                    </tr>

                                    <tr>
                                        <th width="20%">Grand Total</th>
                                        <td>{{ $order['grand_total'] }} MMK</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Order Time</th>
                                        <td>{{ Carbon\Carbon::parse($order['created_at'])->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <form action="{{ route('order.saveRefund',$order['id']) }}" method="POST" id="order_cancel" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                  <label for="image">Screenshot</label>
                                  <div class="mb-3">
                                      <img src="{{ asset(config('app.companyInfo.logo')) }}" class="" id="imgPreview" alt="" style="width: 150px;border-radius: 10px;border: 1px dotted #888">
                                  </div>
                                  <input type="file" class="form-control" name="image" id="photo" accept="image/*"></input>
                              </div>
                            <div class="mb-4">
                                <label for="">Order refund လုပ်ရသည့် အကြောင်းအရင်း</label>
                                <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="submit-btn float-end">Order Refund လုပ်မည်</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
{!! JsValidator::formRequest('App\Http\Requests\OrderRefundRequest', '#order_cancel') !!}

    <script>
          $('#photo').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });

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

            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })

            $(document).on('click', '.updateStatusBtn', function(e) {
              e.preventDefault();
              swal({
                text: "Are you sure?",
                icon: "info",
                buttons: true,
                dangerMode: true,
              })
              .then((confirm) => {
                if (confirm) {
                  let id = '{{ $order['id'] }}';
                  let status = $('.updateStatusBtn').attr('data-status');
                  console.log(status);
                  $.ajax({
                    url : `/orders/${id}`,
                    method : 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        'status': status,
                    },
                  }).done(function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Order updated successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                  })
                }
              });
            })
        })
    </script>
@endsection

