<div class="account-table-wrap">
    <div class="account-table-scroll">
        <table class="table account-orders-table account-cart-table mb-0">
            <thead>
                <tr>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Product') }}</th>
                    <th>{{ __('Metal Type') }}</th>
                    <th>{{ __('Metal Colour') }}</th>
                    <th>{{ __('Size') }}</th>
                    <th>{{ __('Quantity') }}</th>
                    <th>{{ __('Ref') }}</th>
                    <th>{{ __('Notes') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $allTotal = 0; $VAT = 0; @endphp
                @if($cartItem)
                    @foreach($cartItem as $id => $item)
                        @php
                            $quantity = isset($item['quantity']) ? (float) str_replace(',', '', $item['quantity']) : 0;
                            $price = isset($item['price']) ? (float) str_replace(',', '', $item['price']) : 0;
                            $Total = $quantity * $price;
                            $allTotal += $Total;
                            $VAT = $allTotal * 0.2;
                        @endphp
                        <tr id="cart_item-{{ $id }}">
                            <td>
                                <div class="account-order-thumb">
                                    <img src="{{ asset($item['photo']) }}" alt="{{ $item['item_title'] ?? __('Product') }}">
                                </div>
                            </td>
                            <td class="text-nowrap">{{ $item['sku'] }}</td>
                            <td>{{ $item['item_title'] }}</td>
                            <td>
                                @if(!is_null($item['metal_type']))
                                    {{ config('params.metal_type')[$item['metal_type']] }}
                                @endif
                            </td>
                            <td>{{ $item['metal_colour'] }}</td>
                            <td>{{ $item['cart_size'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['ref'] }}</td>
                            <td class="account-notes-cell">{{ $item['notes'] }}</td>
                            <td>
                                <div class="account-actions account-actions--text">
                                    <a href="javascript:void(0)" data-id="{{ $item['cart_id'] }}" class="account-link-action order-btn">{{ __('Order') }}</a>
                                    <a href="javascript:void(0)" data-id="{{ $item['cart_id'] }}" class="account-action-btn account-action-btn--edit edit-btn" title="{{ __('Edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="{{ $item['cart_id'] }}" class="account-action-btn account-action-btn--cancel remove-item-cart" title="{{ __('Delete') }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="account-empty-cell">
                            <div class="account-empty-state">
                                <i class="fa fa-shopping-bag"></i>
                                <p>{{ __('Your cart is empty') }}</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
