@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-12">
    <div class="dashboard-body">
        <div class="order-wrap">
            <div class="account-form">
                <div class="dashboard-body__bar">
                    <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
                </div>
                <div class="account-form__content mb-4">
                    <h3 class="account-form__title mb-2">{{$pageTitle}} </h3>
                </div>
                <form action="{{route('user.service.order.payment')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-3">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form--label">@lang('Category')</label>
                                <div class="col-sm-12">
                                    <select class="select form--control category" name="category_id">
                                        <option selected>@lang('Select Category')</option>
                                        @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form--label">@lang('Service')</label>
                                <div class="col-sm-12">
                                    <select class="select form--control services" name="service_id">
                                        <option selected>@lang('Select Service')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="link" class="form--label"> @lang('Your Link')</label>
                                <input type="text" class="form--control" id="link" name="link" placeholder="@lang('Your Link')">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="quantity" class="form--label">@lang('Quantity')</label>
                                <input type="number" class="form--control" id="quantity" min="1" name="quantity" placeholder="@lang('Quantity')">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price" class="form--label">@lang('Price')</label>
                                <input type="text" class="form--control price" id="price" name="price" placeholder="@lang('Price')" readonly>
                            </div>
                        </div>

                        <div class="card custom--card mt-4 service-details">

                        </div>


                        <div class="col-sm-12">
                            <button type="submit" class="btn btn--base w-25">
                               @lang('Place Order') <i class="fas fa-arrow-right"></i>
                                <span style="top: 16px; left: 578px;"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
<script>
    "use strict";
    $(document).ready(function() {

    $('.category').on('change', function() {
      var categoryId = $(this).val();

      $.ajax({
        url: '{{ route('user.get.category.service', ['id' => ':id']) }}'.replace(':id', categoryId),
        type: 'GET',
        success: function(response) {
          var services = response.services;
          var serviceOptions = '';
          services.forEach(function(service) {
            serviceOptions += '<option value="' + service.id + '">' + service.name + '</option>';
          });
          $('.services').html(serviceOptions);

          var firstServicePrice = services[0].price;
          var firstServiceName = services[0].name;
          var firstServiceMin = services[0].min;
          var firstServiceMax = services[0].max;
          var firstServiceDetails = services[0].details;
          var category = response.category;

          $('.price').val(firstServicePrice);


          var orginalPrice = $('.price').val();
        $(document).on("input", "#quantity", function() {

        var quantity = $('#quantity').val()

        var total_price = (orginalPrice / 1000) * quantity;
            $('.price').val(total_price.toFixed(2));
        });
        $('input[name=quantity]').attr('min', firstServiceMin).attr('max', firstServiceMax);



          var serviceDetailsHtml = `
        <div class="card custom--card mt-4 service-details">
          <div class="card-header">
            <h5 class="card-title">Service Details</h5>
          </div>
          <div class="card-body">
            <div class="selling-group-item">
              <small class="text-muted">Category</small>
              <span>${category}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Service Name</small>
              <span>${firstServiceName}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Price</small>
              <span>$ ${firstServicePrice}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Min</small>
              <span> ${firstServiceMin}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Max</small>
              <span> ${firstServiceMax}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Details</small>
              <span> ${firstServiceDetails}</span>
            </div>
          </div>
        </div>
      `;
      $('.service-details').html(serviceDetailsHtml);


        }
      });
    });


    $('.services').on('change', function() {

        $('#quantity').val('');

        var orginalPrice = $('.price').val();
        $(document).on("input", "#quantity", function() {

        var quantity = $('#quantity').val()

        var total_price = (orginalPrice / 1000) * quantity;
            $('.price').val(total_price.toFixed(2));
        });



      var serviceId = $(this).val();
      $.ajax({
        url: '{{ route('user.get.category.service.price', ['id' => ':id']) }}'.replace(':id', serviceId),
        type: 'GET',
        success: function(response) {

        $('input[name=quantity]').attr('min', response.min).attr('max', response.max);
        $('.price').val(response.price);

          var serviceDetailsHtml = `
        <div class="card custom--card mt-4 service-details">
          <div class="card-header">
            <h5 class="card-title">Service Details</h5>
          </div>
          <div class="card-body">
            <div class="selling-group-item">
              <small class="text-muted">Category</small>
              <span>${response.category}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Service Name</small>
              <span>${response.name}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Price</small>
              <span>$ ${response.price}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Min</small>
              <span> ${response.min}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Max</small>
              <span> ${response.max}</span>
            </div>
            <div class="selling-group-item">
              <small class="text-muted">Details</small>
              <span> ${response.details}</span>
            </div>
          </div>
        </div>
      `;
      $('.service-details').html(serviceDetailsHtml);


        }
      });
    });



  });
</script>
@endpush
