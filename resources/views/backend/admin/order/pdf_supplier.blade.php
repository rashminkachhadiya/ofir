<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
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
        .td_tag {
            font-size: 12px; 
            line-height: 15px;
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
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td width="60%">Supplier Name: &nbsp;</td>
                                                <td>{{ $supplier[$order->supplier_name] }}</td>
                                            </tr>
                                            <tr>
                                                <td width="60%">Date: </td>
                                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td width="60%">Order No: &nbsp;</td>
                                                <td><strong>{{ $order->order_number }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td width="60%">Code: &nbsp;</td>
                                                <td>{{ $order->sku }}</td>
                                            </tr>
                                            <tr>
                                                <td width="60%">Category: &nbsp;</td>
                                                <td>{{ config('params.categories')[$order->category_id] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="40%" align="center" valign="top">
                                    <table border="0" style="margin-left:50px;" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td width="60%">Category: &nbsp;</td>
                                                <td>{{ config('params.categories')[$order->category_id] }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td width="60%">Metal Type: &nbsp;</td>
                                                <td>
                                                    @if(!is_null($order->metal_type))
                                                    {{ config('params.metal_type')[$order->metal_type] }}
                                                    @endif
                                                </td>
                                            </tr><tr>
                                                <td></td>
                                                <td width="60%">Metal Colour: &nbsp;</td>
                                                <td>
                                                    @if(!is_null($order->mmetal_colour))
                                                    {{ config('params.metal_colour')[$order->metal_colour] }}
                                                    @endif
                                                </td>
                                            </tr><tr>
                                                <td></td>
                                                <td width="60%">Size: &nbsp;</td>
                                                <td>{{ $order->size }}</td>
                                            </tr><tr>
                                                <td></td>
                                                <td width="60%">Weight: &nbsp;</td>
                                                <td>{{ $order->weight }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td width="60%">Qty: &nbsp;</td>
                                                <td>{{ $order->quantity }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="30%" align="left" style="vertical-align: baseline;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td colspan="2" style="text-align: center"><strong>Gem Info</strong></td>
                                            </tr>
                                            <tr>
                                                <td width="60%">Gem:</td>
                                                <td width="40%">{{ $order->gem }}</td>
                                            </tr>
                                            <tr>
                                                <td width="60%">Shape:</td>
                                                <td width="40%">{{ $order->shape }}</td>
                                            </tr>
                                            <tr>
                                                <td width="60%">Carat:</td>
                                                <td width="40%">{{ $order->carat }}</td>
                                            </tr><tr>
                                                <td width="60%">Colour:</td>
                                                <td width="40%">{{ $order->colour }}</td>
                                            </tr><tr>
                                                <td width="60%">Cleaerty:</td>
                                                <td width="40%">{{ $order->cleaerty }}</td>
                                            </tr><tr>
                                                <td width="60%">Pcs:</td>
                                                <td width="40%">{{ $order->pcs }}</td>
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
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                @foreach($order->orderPicture as $image)
                                    <div class="col-md-2 mt-2">
                                        <img width="170px;" height="170px" src="{{asset('assets/images/users/order/').'/'.$image->images}}">
                                    </div>
                                @endforeach
                               
                            </tbody>
                        </table></td>
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