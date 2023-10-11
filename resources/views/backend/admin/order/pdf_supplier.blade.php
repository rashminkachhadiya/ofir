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
                            <tr>
                                <td width="30%" align="left" valign="top">
                                     @foreach($order->orderPicture as $image)
                                        <img width="140px;" height="140px" src="{{asset('assets/images/users/order/').'/'.$image->images}}">
                                    @endforeach
                                </td>
                                <td width="70%" align="center" valign="top">
                                    <table id="details" width="100%" border="0" cellspacing="1" cellpadding="0">
                                        <tbody>
                                            <tr style="">
                                                <td width="10%" height="25" align="center" bgcolor="#000" valign="middle" style="border-right: 1px solid #000"><span style="font-size: 12px; color: #fff;">Date</span></td>
                                                <td width="10%" height="25" align="center" bgcolor="#000" valign="middle" style="border-right: 1px solid #000"><span style="font-size: 12px; color: #fff;">Order</span></td>
                                                <td width="10%" height="25" align="center" bgcolor="#000" valign="middle" style="border-right: 1px solid #000"><span style="font-size: 12px; color: #fff;">Name</span></td>
                                                <td width="10%" height="25" align="center" bgcolor="#000" valign="middle" style="border-right: 1px solid #000"><span style="font-size: 12px; color: #fff;">Code</span></td>
                                                <td width="10%" height="25" align="center" bgcolor="#000" valign="middle" style="border-right: 1px solid #000"><span style="font-size: 12px; color: #fff;">Size</span></td>
                                                <td width="10%" height="25" align="center" bgcolor="#000" valign="middle" style="border-right: 1px solid #000"><span style="font-size: 12px; color: #fff;">Qty</span></td>
                                                <td width="10%" height="25" align="center" bgcolor="#000" valign="middle" style="border-right: 1px solid #000"><span style="font-size: 12px; color: #fff;">Metal</span></td>
                                            </tr>
                                            <tr>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;" align="center">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;" align="center">{{ $order->order_number }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;" align="center">{{ $supplier[$order->supplier_name] }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;" align="center">{{ $order->sku }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;" align="center">{{ $order->size }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;" align="center">{{ $order->quantity }}</td>
                                                <td class="" style="font-size: 12px; line-height: 20px;border:1px solid black;border-collapse: collapse;border-spacing: -1px;" align="center">@if(!is_null($order->metal_type))
                                                    {{ config('params.metal_type')[$order->metal_type] }}
                                                    @endif</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>Note: </td>
                                                <td colspan="5">{{ $order->admin_notes }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
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