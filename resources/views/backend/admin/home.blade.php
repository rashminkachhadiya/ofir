@extends('backend.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <x-admin.page-header title="{{ __('Analytics Dashboard') }}" icon="rocket" />

    <div class="row">
        <div class="col-sm-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom stat-card">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">{{ __('New Orders') }}</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <a href="{{ URL::to('/admin/order') }}?param=new_order" class="text-white">
                                <span>{{ $orderInformation->new_order }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom stat-card">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">{{ __('Total Orders') }}</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <a class="text-white" href="{{ URL::to('/admin/order') }}">
                                <span>{{ $orderInformation->total_order }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom stat-card">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">{{ __('All Orders Confirmed') }}</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <a class="text-white" href="{{ URL::to('/admin/order') }}?order_status=3">
                                <span>{{ $orderInformation->all_confirm_order }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile stat-card">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">{{ __('New Sell') }}</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <span>&pound; {{ number_format((float)$orderInformation->new_sell, 2, '.', '') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile stat-card">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">{{ __('Total Sell') }}</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <span>&pound; {{ number_format((float)$orderInformation->total_order_price, 2, '.', '') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="chart-container">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
            <h3 class="mb-3 mb-md-0 h5">{!! $chart1->options['chart_title'] !!}</h3>
            <form action="" id="filtersForm" class="w-100" style="max-width: 400px;">
                <div class="input-group">
                    <input type="text" name="from-to" class="form-control" id="date_filter" aria-label="{{ __('Date range') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="chart-responsive">
            {!! $chart1->renderHtml() !!}
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endpush

@push('script')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    let searchParams = new URLSearchParams(window.location.search);
    let dateInterval = searchParams.get('from-to');
    let start = moment().subtract(29, 'days');
    let end = moment();

    if (dateInterval) {
        dateInterval = dateInterval.split(' - ');
        start = dateInterval[0];
        end = dateInterval[1];
    }

    $('#date_filter').daterangepicker({
        showDropdowns: true,
        showWeekNumbers: true,
        alwaysShowCalendars: true,
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
