<div class="product-details-inner">
                <div class="row">
                    <div class="col-md-3">
                        <div class="product-large-slider">
                            <!-- @if(!empty($item->photo))
                            <div class="pro-large-img img-zoom">
                                <img  src="{{asset($item->photo)}}" alt="product-details" width="180px" height="180px" />
                            </div>
                            @endif -->
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                              <div style="border: 1px solid black;" class="carousel-inner">
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach($order->orderPicture as $image)
                                        @if($count == 0)
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{asset('assets/images/users/order/').'/'.$image->images}}" alt="Second slide">
                                            </div>
                                        
                                        @else
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="{{asset('assets/images/users/order/').'/'.$image->images}}" alt="Second slide">
                                            </div>
                                        @endif
                                    @endforeach
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 p-0">
                        <div class="d-flex">
                            <div class="col-md-6 p-0">
                                <strong>Date: </strong>
                            </div>
                            <div class="col-md-6 p-0">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-md-6 p-0">
                                <strong> Order No: </strong>
                            </div>
                            <div class="col-md-6 p-0">
                                {{ $order->order_number }}
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-md-6 p-0">
                                <strong> Code : </strong>
                            </div>
                            <div class="col-md-6 p-0">
                                {{ $order->sku }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-3">
                        
                    </div>
                </div>
                <hr>
                
            </div>