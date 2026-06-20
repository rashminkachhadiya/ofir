<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orders Report</title>
    <style>
        @page {
            margin: 8mm;
        }
        body {
            color: #222;
            font-family: sans-serif;
            font-size: 10px;
            line-height: 1.3;
        }
        .order-page {
            page-break-inside: avoid;
        }
        .page-break {
            page-break-after: always;
        }
        .header-table,
        .main-table,
        .detail-table,
        .note-table {
            border-collapse: collapse;
            width: 100%;
        }
        .header-table td {
            border: none;
            padding: 0 0 6px;
            vertical-align: top;
        }
        .title {
            font-size: 17px;
            font-weight: bold;
            margin: 0;
        }
        .generated {
            color: #666;
            font-size: 9px;
            text-align: right;
        }
        .main-table td {
            border: none;
            padding: 0;
            vertical-align: top;
        }
        .image-panel {
            width: 32%;
            padding-right: 8px !important;
        }
        .detail-panel {
            width: 68%;
        }
        .section-title {
            background: #f1f3f5;
            border: 1px solid #d5d9de;
            font-size: 11px;
            font-weight: bold;
            margin: 0 0 4px;
            padding: 5px 7px;
        }
        .detail-table th {
            background: #fafafa;
            border: 1px solid #d5d9de;
            font-size: 9px;
            padding: 5px;
            text-align: left;
            width: 22%;
        }
        .detail-table td {
            border: 1px solid #d5d9de;
            padding: 5px;
            vertical-align: top;
            width: 28%;
        }
        .image-box {
            border: 1px solid #d5d9de;
            padding: 7px;
            text-align: center;
        }
        .thumbs {
            margin-top: 6px;
            text-align: left;
        }
        .note-table th {
            background: #fafafa;
            border: 1px solid #d5d9de;
            font-size: 9px;
            padding: 5px;
            text-align: left;
            width: 18%;
        }
        .note-table td {
            border: 1px solid #d5d9de;
            padding: 5px;
            vertical-align: top;
        }
        .mt {
            margin-top: 8px;
        }
        .muted {
            color: #777;
            font-size: 9px;
        }
    </style>
</head>
<body>
@foreach($orders as $order)
    @php
        $category = '-';
        if ($order->sub_category_id !== null && isset(config('params.'.$order->category_id)[$order->sub_category_id])) {
            $category = config('params.'.$order->category_id)[$order->sub_category_id];
        } elseif (isset(config('params.categories')[$order->category_id])) {
            $category = config('params.categories')[$order->category_id];
        }

        $supplierName = (!is_null($order->supplier_name) && isset($supplier[$order->supplier_name])) ? $supplier[$order->supplier_name] : '-';
        $metalType = (!is_null($order->metal_type) && isset(config('params.metal_type')[$order->metal_type])) ? config('params.metal_type')[$order->metal_type] : '-';
        $metalColour = (!is_null($order->metal_colour) && isset(config('params.metal_colour')[$order->metal_colour])) ? config('params.metal_colour')[$order->metal_colour] : '-';
        $orderStatus = isset(config('params.order_status')[$order->order_status]) ? config('params.order_status')[$order->order_status] : '-';
        $currency = (!is_null($order->est_price_currency) && isset(config('params.currency')[$order->est_price_currency])) ? config('params.currency')[$order->est_price_currency] : '';
        $orderImages = $order->orderPicture;
        $mainImage = $orderImages->first();
        $mainImagePath = $mainImage ? public_path('assets/images/users/order/'.$mainImage->images) : null;
        $thumbImages = $orderImages->slice(1, 6);
        $hiddenImageCount = max($orderImages->count() - 7, 0);
        $customerNotes = \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', (string) $order->notes)), 260, '...');
        $adminNotes = \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', (string) $order->admin_notes)), 260, '...');
    @endphp

    <div class="order-page {{ !$loop->last ? 'page-break' : '' }}">
        <table class="header-table">
            <tr>
                <td>
                    <div class="title">Order Details</div>
                    <div class="muted">Order #{{ $order->order_number ?? '-' }}</div>
                </td>
                <td class="generated">Generated {{ now()->format('d/m/Y H:i') }}</td>
            </tr>
        </table>

        <table class="main-table">
            <tr>
                <td class="image-panel">
                    <div class="section-title">Product Image</div>
                    <div class="image-box">
                        @if($mainImagePath && file_exists($mainImagePath))
                            <img src="{{ $mainImagePath }}" width="190" height="190" style="width: 190px; height: 190px; border: 0;">
                        @else
                            <span class="muted">No image available.</span>
                        @endif

                        @if($thumbImages->count() > 0)
                            <div class="thumbs">
                                @foreach($thumbImages as $image)
                                    @php $thumbPath = public_path('assets/images/users/order/'.$image->images); @endphp
                                    @if(file_exists($thumbPath))
                                        <img src="{{ $thumbPath }}" width="38" height="38" style="width: 38px; height: 38px; border: 1px solid #d5d9de; margin-right: 2px; margin-bottom: 2px;">
                                    @endif
                                @endforeach
                                @if($hiddenImageCount > 0)
                                    <div class="muted">+{{ $hiddenImageCount }} more image(s)</div>
                                @endif
                            </div>
                        @endif
                    </div>
                </td>
                <td class="detail-panel">
                    <div class="section-title">General Information</div>
                    <table class="detail-table">
                        <tr>
                            <th>Order Date</th>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                            <th>Order Number</th>
                            <td>{{ $order->order_number ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Code (SKU)</th>
                            <td>{{ $order->sku ?? '-' }}</td>
                            <th>Status</th>
                            <td>{{ $orderStatus }}</td>
                        </tr>
                        <tr>
                            <th>Order By</th>
                            <td>{{ optional($order->orderUser)->f_name ?? '-' }}</td>
                            <th>Email</th>
                            <td>{{ optional($order->orderUser)->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Supplier</th>
                            <td>{{ $supplierName }}</td>
                            <th>Reference</th>
                            <td>{{ $order->ref ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $category }}</td>
                            <th>Size / Qty</th>
                            <td>{{ $order->size ?? '-' }} / {{ $order->quantity ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Metal Type</th>
                            <td>{{ $metalType }}</td>
                            <th>Metal Colour</th>
                            <td>{{ $metalColour }}</td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td>{{ $order->weight ?? '-' }}</td>
                            <th>Prices</th>
                            <td>{{ $currency }}{{ number_format((float) ($order->est_price ?? 0), 2, '.', '') }} / {{ $currency }}{{ $order->tot_est_price ?? '0.00' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="section-title mt">Gem Information</div>
        <table class="detail-table">
            <tr>
                <th>Gem</th>
                <td>{{ $order->gem ?? '-' }}</td>
                <th>Shape</th>
                <td>{{ $order->shape ?? '-' }}</td>
            </tr>
            <tr>
                <th>Carat</th>
                <td>{{ $order->carat ?? '-' }}</td>
                <th>Colour</th>
                <td>{{ $order->colour ?? '-' }}</td>
            </tr>
            <tr>
                <th>Cleaerty</th>
                <td>{{ $order->cleaerty ?? '-' }}</td>
                <th>Pcs</th>
                <td>{{ $order->pcs ?? '-' }}</td>
            </tr>
        </table>

        <div class="section-title mt">Notes</div>
        <table class="note-table">
            <tr>
                <th>Customer Notes</th>
                <td>{{ $customerNotes ?: '-' }}</td>
            </tr>
            <tr>
                <th>Admin Notes</th>
                <td>{{ $adminNotes ?: '-' }}</td>
            </tr>
        </table>
    </div>
@endforeach
</body>
</html>
