<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use Carbon\Carbon;
use View;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    //
    public function index()
    {
    	$orderInformation = Order::select(DB::raw("sum(orders.tot_est_price) as total_order_price"),DB::raw("count(id) as total_order"),DB::raw("SUM(CASE 
            WHEN created_at >= '" . Carbon::yesterday() . "' OR created_at = now()  THEN 1 ELSE 0 END) AS new_order"),DB::raw("SUM(CASE 
            WHEN order_status = 3 THEN 1 ELSE 0 END) AS all_confirm_order"), DB::raw("SUM(CASE 
            WHEN created_at >= '" . Carbon::yesterday() . "' OR created_at = now()  THEN orders.tot_est_price ELSE 0 END) AS new_sell"))->first();


		$date = explode(" - ", request()->input('from-to', "")); 

		if(count($date) != 2)
		{
		    $date = [now()->subDays(29)->format("Y-m-d"), now()->format("Y-m-d")];
		}

    	$chart_options = [
		    'chart_title' => 'Order',
		    'report_type' => 'group_by_date',
		    'model' => 'App\Models\Order',
		    'group_by_field' => 'created_at',
		    'group_by_period' => 'day',
		    'filter_field'=> 'created_at',
		    'range_date_start'=> $date[0],
			'range_date_end'=> $date[1],
		    'chart_type' => 'line',
		    'continuous_time'       => true,
		    'group_by_field_format' => 'Y-m-d H:i:s',
		    'conditions'            => 
		        [['name' => 'Order', 'condition' => '', 'color' => 'blue', 'fill' => false],
		    	],
		];
		$chart1 = new LaravelChart($chart_options);

        return View::make('backend.admin.home',compact('orderInformation','chart1'));
    }
}
