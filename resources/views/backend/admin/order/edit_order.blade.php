@extends('backend.layouts.master')
@section('title', __('Edit Order'))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endpush

@section('content')
    <x-admin.page-header title="{{ __('Order Details') }}" icon="cart">
        <x-slot name="actions">
            <a class="btn btn-info btn-sm" href="{{ URL::to('/admin/pdf-download') }}?id={{ $order->id }}&flag=view">{{ __('View PDF') }}</a>
            <a class="btn btn-success btn-sm ml-2" href="{{ URL::to('/admin/pdf-download') }}?id={{ $order->id }}&flag=pdf">{{ __('Download PDF') }}</a>
        </x-slot>
    </x-admin.page-header>

    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card order-detail-card">
                <div class="card-body">
                    <form id="edit-tab" action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation admin-form-page" novalidate>
                    <div class="row">
                        <div class="col-lg-3 mb-4">
                            <div class="order-images-panel">
                                <div class="order-images-panel__header">
                                    <h6 class="order-images-panel__title">{{ __('Order Images') }}</h6>
                                    <span class="order-images-panel__code">{{ $order->sku }}</span>
                                </div>

                                <div id="order-image-dropzone" class="dropzone order-image-dropzone">
                                    <div class="dz-message order-image-dropzone__message">
                                        <div class="order-image-dropzone__icon">
                                            <i class="fa fa-cloud-upload"></i>
                                        </div>
                                        <span class="order-image-dropzone__text">{{ __('Click or drag images here') }}</span>
                                        <small class="order-image-dropzone__hint">{{ __('Upload multiple images — JPEG, PNG, GIF up to 12MB each') }}</small>
                                    </div>
                                </div>

                                <div id="order-image-dropzone-errors" class="order-image-dropzone__errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Order Date : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Order Number : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->order_number }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Code : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->sku }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Order By : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->orderUser->f_name }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Email : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->orderUser->email }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Order Status : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::select('status', config('params.order_status') ?? [],  $order->order_status ?? '', ['class' => 'form-control select2','data-control'=>"select2", 'id'=>'status']) !!}
                                </div>
                            </div>
                            <div class="d-flex mt-1">
                                <div class="col-md-6">
                                    <p><strong> Ref. : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="ref" name="ref" value="{{ $order->ref }}" placeholder="Ref.">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Category : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    @if($order->sub_category_id !== null && isset(config('params.'.$order->category_id)[$order->sub_category_id]))
                                    {{ config('params.'.$order->category_id)[$order->sub_category_id] }}
                                    @else
                                        {{ config('params.categories')[$order->category_id] ?? '' }}
                                    @endif
                                </div>
                            </div>
                            
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Supplier Name : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::select('supplier_name', $supplier ?? [],  $order->supplier_name ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'supplier_name']) !!}
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Metal Type : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::select('metal_type', $metalType ?? [],  $order->metal_type ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_type']) !!}
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Metal Colour : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::select('metal_colour', $metalColour ?? [],  $order->metal_colour ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_colour']) !!}
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Size : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="size" name="size" value="{{ $order->size }}" placeholder="Size" required>
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Weight : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="weight" name="weight" value="{{ $order->weight }}" placeholder="Weight" required>
                                    </div>
                                </div>
                                
                                
                                <div class="d-flex mt-1">
                                    <div class="col-md-3 pr-0">
                                        <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $order->quantity }}" placeholder="Quantity">
                                    </div>
                                    <div class="col-md-3 pr-0">
                                        {!! Form::select('est_currency', $currency ?? [],  $order->est_price_currency ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'est_currency']) !!}
                                    </div>
                                    <div class="col-md-3 pr-0">
                                        <input type="text" class="form-control" id="est_price" name="est_price" value="{{ $order->est_price }}" placeholder="Est Price">
                                    </div>
                                    <div class="col-md-6 ">
                                        <input type="text" class="form-control" id="tot_est_price" name="tot_est_price" value="{{ $order->tot_est_price }}" placeholder="Totol" readonly>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-3 p-1 pb-4 text-center">
                                        <div class="gem-info-panel">
                                        <h5 class="text-center">{{ __('Gem Info') }}</h5>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Gem. : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="gem" name="gem" value="{{ $order->gem }}" placeholder="Gem" required>
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Shape : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="shape" name="shape" value="{{ $order->shape }}" placeholder="Shape" required>
                                    </div>
                                </div><div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Carat : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="carat" name="carat" value="{{ $order->carat }}" placeholder="Carat" required>
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Colour : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="colour" name="gem_colour" value="{{ $order->colour }}" placeholder="Colour">
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Cleaerty : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="cleaerty" name="cleaerty" value="{{ $order->cleaerty }}" placeholder="Cleaerty" required>
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Pcs : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="pcs" name="pcs" value="{{ $order->pcs }}" placeholder="Pcs" required>
                                    </div>
                                </div>
                                <div class="float-right mt-2">
                                    <button type="button" class="btn btn-success update-submit">
                                        <i class="fa fa-save"></i> {{ __('Save') }}
                                    </button>
                                </div>
                                        </div>
                            </div>
                            
                        <div class="col-md-3 p-0">
                            <div class="d-flex mt-1">
                                <div class="col-md-6">
                                    <p><strong> Customer Notes : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-0">
                            <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong>Admin Notes : </strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control" id="notes" name="admin_notes" placeholder="Admin Notes" rows="3" required="false">{{ $order->admin_notes }}</textarea>
                                    </div>
                                </div> 
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        var orderImageDropzone = null;
        var deletedOrderImageIds = [];

        var existingOrderImages = [
            @foreach($order->orderPicture as $image)
            {
                id: {{ $image->id }},
                name: {!! json_encode($image->images) !!},
                url: {!! json_encode(asset('assets/images/users/order/'.$image->images)) !!}
            },
            @endforeach
        ];

        $(document).on("focusout", "#quantity, #est_price", function(e) {
            e.preventDefault();
            var totalPrice = parseFloat($("#quantity").val()) * parseFloat($("#est_price").val());
            if (!isNaN(totalPrice)) {
                $("#tot_est_price").val(totalPrice.toFixed(2));
            }
        });

        function addExistingOrderImage(dz, image) {
            var mockFile = {
                name: image.name,
                size: 12345,
                existing: true,
                imageId: image.id,
                accepted: true
            };

            dz.emit("addedfile", mockFile);
            dz.emit("thumbnail", mockFile, image.url);
            dz.emit("complete", mockFile);

            if (mockFile.previewElement) {
                mockFile.previewElement.classList.add('dz-success', 'dz-complete', 'dz-existing');
            }
        }

        $(document).ready(function () {
            orderImageDropzone = new Dropzone("#order-image-dropzone", {
                url: '{{ url("admin/update-order") }}',
                autoProcessQueue: false,
                uploadMultiple: false,
                parallelUploads: 50,
                addRemoveLinks: true,
                maxFilesize: 12,
                acceptedFiles: "image/jpeg,image/jpg,image/png,image/gif",
                dictRemoveFile: "{{ __('Remove') }}",
                dictFileTooBig: "{{ __('File is too big (max 12MB).') }}",
                dictInvalidFileType: "{{ __('Only JPEG, PNG and GIF images are allowed.') }}",
                init: function () {
                    var dz = this;

                    existingOrderImages.forEach(function (image) {
                        addExistingOrderImage(dz, image);
                    });

                    dz.on("removedfile", function (file) {
                        if (file.existing && file.imageId) {
                            if (deletedOrderImageIds.indexOf(file.imageId) === -1) {
                                deletedOrderImageIds.push(file.imageId);
                            }
                        }
                    });

                    dz.on("error", function (file, message) {
                        var text = typeof message === 'string' ? message : "{{ __('Unable to add this image.') }}";
                        $('#order-image-dropzone-errors').html('<div class="alert alert-warning py-2 mb-0">' + text + '</div>');
                        if (file && file.previewElement) {
                            file.previewElement.classList.add('dz-error');
                        }
                    });

                    dz.on("addedfile", function () {
                        $('#order-image-dropzone-errors').empty();
                    });
                }
            });

            $('body').on('click', '.update-submit', function(event) {
                event.preventDefault();

                var myData = new FormData($("#edit-tab")[0]);
                var CSRF_TOKEN = $('input[name="csrf_token"]').val();
                myData.append('_token', CSRF_TOKEN);
                myData.append('roles', []);

                if (orderImageDropzone) {
                    orderImageDropzone.files.forEach(function (file) {
                        if (!file.existing) {
                            myData.append('order_images[]', file);
                        }
                    });
                }

                deletedOrderImageIds.forEach(function (id) {
                    myData.append('delete_images[]', id);
                });

                $.ajax({
                    url: '{{ url("admin/update-order") }}',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.type === 'success') {
                            swal("Done!", "It was succesfully done!", "success");
                            if (typeof reload_table === 'function') {
                                reload_table();
                            }
                            if (typeof notify_view === 'function') {
                                notify_view(data.type, data.message);
                            }
                            window.location.reload();
                        } else if (data.type === 'error') {
                            if (data.errors) {
                                $.each(data.errors, function (key, val) {
                                    $('#error_' + key).html(val);
                                });
                            }
                            var errorMessage = data.message || "Please try again";
                            if (typeof notify_view === 'function') {
                                notify_view(data.type, errorMessage);
                            }
                            swal("Error sending!", errorMessage, "error");
                        }
                    }
                });
            });
        });
    </script>
    @endpush

    <style>
        .order-images-panel {
            background: #fff;
            border: 1px solid #e8ecf1;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.06);
        }

        .order-images-panel__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 0.85rem;
        }

        .order-images-panel__title {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 600;
            color: #1f2937;
        }

        .order-images-panel__code {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .order-image-dropzone {
            border: 2px dashed #cbd5e1 !important;
            border-radius: 12px !important;
            background: #f8fafc;
            min-height: 220px;
            padding: 0.75rem;
            transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        }

        .order-image-dropzone:hover,
        .order-image-dropzone.dz-drag-hover {
            border-color: #6366f1 !important;
            background: #f5f3ff;
            box-shadow: inset 0 0 0 1px rgba(99, 102, 241, 0.08);
        }

        .order-image-dropzone .dz-message {
            margin: 1.5rem 0;
        }

        .order-image-dropzone__message {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 0.35rem;
        }

        .order-image-dropzone__icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            color: #4f46e5;
            font-size: 1.35rem;
            margin-bottom: 0.25rem;
        }

        .order-image-dropzone__text {
            font-size: 0.92rem;
            font-weight: 600;
            color: #334155;
        }

        .order-image-dropzone__hint {
            font-size: 0.78rem;
            color: #64748b;
        }

        .order-image-dropzone .dz-preview {
            margin: 8px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: #fff;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.05);
        }

        .order-image-dropzone .dz-preview .dz-image {
            border-radius: 10px 10px 0 0;
            width: 120px;
            height: 120px;
        }

        .order-image-dropzone .dz-preview .dz-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .order-image-dropzone .dz-preview .dz-details {
            padding: 0.35rem 0.5rem 0.15rem;
            opacity: 1;
            position: relative;
        }

        .order-image-dropzone .dz-preview .dz-filename span {
            font-size: 0.72rem;
            color: #475569;
        }

        .order-image-dropzone .dz-preview .dz-size {
            display: none;
        }

        .order-image-dropzone .dz-preview .dz-remove {
            display: block;
            margin: 0;
            padding: 0.45rem 0.5rem 0.55rem;
            color: #dc2626;
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            border-top: 1px solid #f1f5f9;
            text-align: center;
        }

        .order-image-dropzone .dz-preview .dz-remove:hover {
            color: #b91c1c;
            text-decoration: none;
            background: #fef2f2;
        }

        .order-image-dropzone .dz-preview.dz-existing .dz-progress {
            display: none;
        }

        .order-image-dropzone__errors {
            margin-top: 0.75rem;
        }

        @media (max-width: 991.98px) {
            .order-image-dropzone {
                min-height: 180px;
            }
        }
    </style>
@stop