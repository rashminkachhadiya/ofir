@extends('backend.layouts.master')
@section('title', 'Dashboard')
@section('content')
<style type="text/css">
	.{
		color:black;
	}
	.daterangepicker{
		color: black !important;
	}
</style>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Analytics Dashboard
                    <!-- <div class="page-title-subheading">This is an example dashboard created using build-in elements and
                        components.
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">New Orders</div>
                        <!-- <div class="widget-subheading">Last year expenses</div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><a href="{{ URL :: to('/admin/order') }}?param=new_order" class="text-white"><span>{{ $orderInformation->new_order }}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Orders</div>
                        <!-- <div class="widget-subheading">Last year expenses</div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><a class="text-white" href="{{ URL :: to('/admin/order') }}"><span>{{ $orderInformation->total_order }}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            
        </div>
        <div class="col-md-6 col-xl-4">
           <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">New Sell</div>
                        <!-- <div class="widget-subheading">Total Clients Profit</div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>&pound; {{ number_format((float)$orderInformation->new_sell, 2, '.', '') }}</span></div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Sell</div>
                        <!-- <div class="widget-subheading">Total Clients Profit</div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>&pound; {{ number_format((float)$orderInformation->total_order_price, 2, '.', '') }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            
        </div>
    </div>
	
    <div class="mt-2 bg-white">
        <h3 style="color: black;">{!! $chart1->options['chart_title'] !!}</h3>
        <div class="col-md-6">
	    <form action="" id="filtersForm">
	        <div class="input-group">
	        <input type="text" name="from-to" class="form-control mr-2" id="date_filter">
	        <span class="input-group-btn">
	            <input type="submit" class="btn btn-primary" value="Filter">
	        </span> 
	        </div>
	    </form>
	    </div>
        {!! $chart1->renderHtml() !!}
    </div>
	
@endsection
@push('script')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
	let searchParams = new URLSearchParams(window.location.search)
  let dateInterval = searchParams.get('from-to');
  let start = moment().subtract(29, 'days');
  let end = moment();

  if (dateInterval) {
      dateInterval = dateInterval.split(' - ');
      start = dateInterval[0];
      end = dateInterval[1];
  }

  $('#date_filter').daterangepicker({
      "showDropdowns": true,
      "showWeekNumbers": true,
      "alwaysShowCalendars": true,
      startDate: start,
      endDate: end,
      locale: {
          format: 'YYYY-MM-DD',
          firstDay: 1,
      },
      ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'This Year': [moment().startOf('year'), moment().endOf('year')],
          'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
          'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
      }
  });
</script>
@endpush
