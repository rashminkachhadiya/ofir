@php
    $colspan = ($showRef ?? false) ? 13 : 12;
@endphp
<div class="account-table-wrap">
    <div class="account-table-scroll">
        <table class="table account-orders-table mb-0">
            <thead>
                <tr>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Number') }}</th>
                    <th>{{ __('Category') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Size') }}</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Colour') }}</th>
                    <th>{{ __('Carat') }}</th>
                    @if($showRef ?? false)
                        <th>{{ __('Ref') }}</th>
                    @endif
                    <th>{{ __('Est') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                    <th class="account-th-check">
                        <input class="account-checkbox master-checkbox" type="checkbox" name="ids[]" aria-label="{{ __('Select all') }}"/>
                    </th>
                </tr>
            </thead>
            <tbody id="{{ $tableId }}">
                @forelse($orders as $order)
                    @php
                        $statusKey = (string) $order->order_status;
                        $statusLabel = config('params.order_status')[$order->order_status] ?? '';
                        if ($statusKey === '0') {
                            $statusClass = 'status-pending';
                        } elseif ($statusKey === '1') {
                            $statusClass = 'status-ready';
                        } elseif ($statusKey === '2') {
                            $statusClass = 'status-done';
                        } elseif ($statusKey === '3') {
                            $statusClass = 'status-confirmed';
                        } elseif ($statusKey === '4') {
                            $statusClass = 'status-cancelled';
                        } else {
                            $statusClass = 'status-default';
                        }
                    @endphp
                    <tr>
                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/y') }}</td>
                        <td>
                            <div class="account-order-thumb">
                                @foreach($order->orderPicture as $image)
                                    <img src="{{ asset('assets/images/users/order/'.$image->images) }}" alt="{{ __('Order image') }}">
                                    @php break; @endphp
                                @endforeach
                            </div>
                        </td>
                        <td class="text-nowrap font-weight-bold">{{ $order->order_number }}</td>
                        <td>
                            @if($order->sub_category_id !== null && isset(config('params.'.$order->category_id)[$order->sub_category_id]))
                                {{ config('params.'.$order->category_id)[$order->sub_category_id] }}
                            @else
                                {{ config('params.categories')[$order->category_id] ?? '' }}
                            @endif
                        </td>
                        <td>
                            <span class="account-status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                        </td>
                        <td>{{ $order->size }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>
                            @if(!is_null($order->metal_colour))
                                {{ config('params.metal_colour')[$order->metal_colour] }}
                            @endif
                        </td>
                        <td>{{ $order->carat }}</td>
                        @if($showRef ?? false)
                            <td>{{ $order->ref }}</td>
                        @endif
                        <td class="text-nowrap">
                            @if(!is_null($order->est_price_currency))
                                {{ config('params.currency')[$order->est_price_currency] }}{{ $order->tot_est_price }}
                            @endif
                        </td>
                        <td>
                            <div class="account-actions">
                                <a href="javascript:void(0)" id="{{ $order->id }}" class="account-action-btn account-action-btn--view view" title="{{ __('View') }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if($order->order_status == 0)
                                    <a href="javascript:void(0)" id="{{ $order->id }}" class="account-action-btn account-action-btn--confirm order_confim" title="{{ __('Confirm Order') }}">
                                        <i class="fa fa-check"></i>
                                    </a>
                                @endif
                                @if($order->order_status == 3)
                                    <a href="javascript:void(0)" id="{{ $order->id }}" class="account-action-btn account-action-btn--cancel order_cancel" title="{{ __('Cancel Order') }}">
                                        <i class="fa fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td class="account-td-check">
                            <input class="account-checkbox child-checkbox" type="checkbox" value="{{ $order->id }}" name="ids[]" aria-label="{{ __('Select order') }}"/>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $colspan }}" class="account-empty-cell">
                            <div class="account-empty-state">
                                <i class="fa fa-inbox"></i>
                                <p>{{ __('No Any Order') }}</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
