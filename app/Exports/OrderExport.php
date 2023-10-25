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

class OrderExport implements FromCollection, WithHeadings, WithColumnWidths, WithMapping, WithEvents
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

    // public function drawings()
    // {
    

    //     $drawing = new Drawing();

    
    //     $drawing->setName('Image');
    //     $drawing->setDescription('This is my Image');
    //     $drawing->setPath(public_path('/assets/images/users/order'));
    //     echo "Yess11";
    //     die;
        
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('D1');

    //     return $drawing;
    // }

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
    		$order->created_at,
    		"", 
            $order->supplier_name,
            $order->order_number,
            $order->sku,
	        config('params.categories')[$order->category_id],
            $order->orderUser->f_name,
            $order->size,
            $order->quantity,
            $order->metal_colour,
            $order->carat,
            $order->ref,
            $order->tot_est_price,
            config('params.order_status')[$order->order_status],
    	];

    	if(isset($order->orderPicture[0]->images) && !is_null($order->orderPicture[0]->images))
    	{
			$data = [
	    		$order->created_at,
	         	asset('assets/images/users/order/') . '/' . $order->orderPicture[0]->images,
	            $order->supplier_name,
	            $order->order_number,
	            $order->sku,
	            config('params.categories')[$order->category_id],
	            $order->orderUser->f_name,
	            $order->size,
	            $order->quantity,
	            $order->metal_colour,
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
	        'A' => 30,
	        'B' => 30,        
	        'C' => 30,
	        'D' => 30,  
	    ];
	}

	public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:N1')
                                ->getFont()
                                ->setBold(true);
   
            },
        ];
    }
}
