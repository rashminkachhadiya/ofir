<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;

class OrderExport implements FromCollection, WithHeadings, WithColumnWidths,WithDrawings,WithMapping,WithEvents
{
	protected $selected;

	public function __construct($selected)
    {
        $this->selected = $selected;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::whereIn('id',$this->selected)->get();
    }

    public function drawings()
    {
    
        $orders = Order::whereIn('id',$this->selected)->get();
        $drawings = [];
        $start = 2;
        foreach ($orders as $order) {
            $drawing = new Drawing();
            $drawing->setName('Image');
            $drawing->setDescription('This is my Image');
            $drawing->setPath(public_path('/assets/images/users/order/').$order->orderPicture[0]->images);
            $drawing->setHeight(75);
            $drawing->setWidth(75);
            $drawing->setCoordinates('B'.$start);
            $start++;
            $drawings [] = ($drawing);   
        }
        
        return $drawings; 
    }

    public function headings(): array
    {
        return [
        	"Date",
        	"Image",
        	"Supplier",
        	"Number",
        	"Code",
        	"Category",
        	"Name",
        	"Size",
        	"Qty",
        	"Metal",
        	"Colour",
        	"Carat",
        	"Ref.",
        	"Est.",
        	"Status"
        ];
    }

    public function map($order): array
    {
    	$data = [
			Carbon::parse($order->created_at)->format('d/m/Y'),
    		"", 
            $order->orderSupplier->f_name,
            $order->order_number,
            $order->sku,
	        config('params.categories')[$order->category_id],
            $order->orderUser->f_name,
            $order->size,
            $order->quantity,
	        config('params.metal_type')[$order->metal_type],
	        config('params.metal_colour')[$order->metal_colour],
            $order->carat,
            $order->ref,
            $order->tot_est_price,
            config('params.order_status')[$order->order_status],
    	];

    	if(isset($order->orderPicture[0]->images) && !is_null($order->orderPicture[0]->images))
    	{
			$data = [
				Carbon::parse($order->created_at)->format('d/m/Y'),
                "",
	            $order->orderSupplier->f_name,
	            $order->order_number,
	            $order->sku,
	            config('params.categories')[$order->category_id],
	            $order->orderUser->f_name,
	            $order->size,
	            $order->quantity,
	        	config('params.metal_type')[$order->metal_type],
	            config('params.metal_colour')[$order->metal_colour],
	            $order->carat,
	            $order->ref,
	            $order->tot_est_price,
            	config('params.order_status')[$order->order_status],
    		];
    	}

    	return $data;
    }

    public function columnWidths(): array
	{
	    return [
	        'A' => 15,
	        'B' => 20,        
	        'C' => 15,
	        'D' => 15,
	        'F' => 15,
	        'G' => 15,
	        'I' => 10,
	        'O' => 20,  
	    ];
	}

	public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:O1')
                                ->getFont()
                                ->setBold(true);

                $orders = Order::whereIn('id',$this->selected)->get();
                echo "<pre>";
                print_r($orders);
                die;
                //Set row height
                $row = 2;
                for ($i = 2; $i < count($orders); $i++) //iterate based on row count
                {
                    $event->sheet->getRowDimension(2)->setRowHeight(50);
                    $row++;
                }
            },
        ];
    }
}
