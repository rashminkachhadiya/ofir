<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Supplier Order</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            outline: 0;
            font-family: "Muli", sans-serif;
        }
        .page-break {
            page-break-after: always;
            page-break-inside: avoid;
        }
        footer{
            position: fixed;
            bottom: 10px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            /*color: white;*/
            text-align: center;
            line-height: 20px;
        }
        #details {
          /*border: 1px solid black;*/
          border-spacing: 0px;
           page-break-inside: avoid;
        }
        .td_tag {
            font-size: 12px; 
            line-height: 20px;
            border:1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div style="position: relative">

        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td width="20%" align="left" valign="middle">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="20%" align="left" valign="middle">
                                    
                                </td>
                            </tr>
                            </tbody>
                        </table></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td width="20%" align="left" valign="top">
                                     @foreach($order->orderPicture as $image)
                                        <img style="border: 1.5px solid black;border-collapse: collapse;border-spacing: -1px;" width="140px;" height="140px" src="{{asset('assets/images/users/order/').'/'.$image->images}}">
                                    @endforeach
                                </td>
                                <td width="70%" align="center" valign="top">
                                    <table id="details" width="100%" border="0" cellspacing="1" cellpadding="0">
                                        <tbody>
                                            <tr style="">
                                                <td width="12%" height="25" align="center" bgcolor="" valign="middle" style="border: 1px solid #000;border-bottom: none;border-right: none"><span style="font-size: 12px; color: #000;"><strong>Date</strong></span></td>
                                                <td width="15%" height="25" align="center" bgcolor="" valign="middle" style="border: 1px solid #000;border-bottom: none;border-right: none"><span style="font-size: 12px; color: #000;"><strong>Order</strong></span></td>
                                                <td width="10%" height="25" align="center" bgcolor="" valign="middle" style="border: 1px solid #000;border-bottom: none;border-right: none"><span style="font-size: 12px; color: #000;"><strong>Name</strong></span></td>
                                                <td width="12%" height="25" align="center" bgcolor="" valign="middle" style="border: 1px solid #000;border-bottom: none;border-right: none"><span style="font-size: 12px; color: #000;"><strong>Code</strong></span></td>
                                                <td width="7%" height="25" align="center" bgcolor="" valign="middle" style="border: 1px solid #000;border-bottom: none;border-right: none"><span style="font-size: 12px; color: #000;"><strong>Size</strong></span></td>
                                                <td width="7%" height="25" align="center" bgcolor="" valign="middle" style="border: 1px solid #000;border-bottom: none;border-right: none"><span style="font-size: 12px; color: #000;"><strong>Qty</strong></span></td>
                                                <td width="10%" height="25" align="center" bgcolor="" valign="middle" style="border: 1px solid #000;border-bottom: none;border-right: none"><span style="font-size: 12px; color: #000;"><strong>Metal</strong></span></td>
                                                <td width="10%" height="25" align="center" bgcolor="" valign="middle" style="border: 1px solid #000;border-bottom: none;"><span style="font-size: 12px; color: #000;"><strong>Colour</strong></span></td>
                                            </tr>
                                            <tr>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-right: none;" align="center">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;border-right: none;" align="center">{{ $order->order_number }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;border-right: none;" align="center">{{ $supplier[$order->supplier_name] }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;border-right: none;" align="center">{{ $order->sku }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;border-right: none;" align="center">{{ $order->size }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;border-right: none;" align="center">{{ $order->quantity }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;border-right: none;" align="center">@if(!is_null($order->metal_type))
                                                    {{ config('params.metal_type')[$order->metal_type] }}
                                                    @endif</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;" align="center">@if(!is_null($order->metal_colour))
                                                    {{ config('params.metal_colour')[$order->metal_colour] }}
                                                    @endif</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;border-right: none;" valign="top" rowspan="7">Note: </td>
                                                <td style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;border-left: none;" valign="top" colspan="7" rowspan="7">{{ $order->admin_notes }}</td>
                                            </tr>
                                            <tr><td>&nbsp;</td></tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            @endforeach
                            </tbody>
                        </table></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td >&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                
                            </tbody>
                        </table></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    </html>