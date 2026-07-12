@extends('frontend.layouts.master')
@section('title', __('New Order'))
@section('content')
    <x-auth-card :form="true" title="{{ __('Hi, :name', ['name' => Auth()->user()->f_name]) }}" subtitle="{{ __('Create New Order') }}">
        <a href="{{ URL::to('/') }}" class="back-link mb-3 d-inline-flex" aria-label="{{ __('Back to home') }}">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" aria-hidden="true"><path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg>
            <span>{{ __('Back') }}</span>
        </a>

        <form method="post" action="" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category_id">{{ __('Category') }}</label>
                {!! Form::select('category_id', $categories ?? [], $userRoleId ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'category_id']) !!}
            </div>

            <div class="form-group">
                <label for="dropzone">{{ __('Picture') }}</label>
                <div id="dropzone" class="dropzone dz-clickable form-fileupload">
                    <div class="dz-message dz-default text-center">
                        <span>{{ __('Click Here to upload Photo') }}</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="metal_type">{{ __('Metal Type') }}</label>
                {!! Form::select('metal_type', $metalType ?? [], $userRoleId ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'metal_type']) !!}
            </div>

            <div class="form-group">
                <label for="metal_colour">{{ __('Metal Colour') }}</label>
                {!! Form::select('metal_colour', $metalColour ?? [], $userRoleId ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'metal_colour']) !!}
            </div>

            <div class="form-group">
                <label for="size">{{ __('Size') }}</label>
                <input type="text" class="form-control" id="size" name="size" placeholder="{{ __('Size') }}" required>
            </div>

            <div class="form-group">
                <label for="quantity">{{ __('Quantity') }}</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="{{ __('Quantity') }}" required>
            </div>

            <div class="form-group">
                <label for="notes">{{ __('Notes') }}</label>
                <textarea class="form-control" id="notes" name="notes" placeholder="{{ __('Notes') }}" rows="4"></textarea>
            </div>
        </form>

        <button class="btn btn-success btn-block mt-3" id="uploadFile">{{ __('Submit') }}</button>
    </x-auth-card>

    <script type="text/javascript">
        Dropzone.options.dropzone = {
            url: '{{ url("order") }}',
            maxFilesize: 12,
            autoProcessQueue: false,
            renameFile: function(file) {
                var dt = new Date();
                return dt.getTime() + file.name;
            },
            parallelUploads: 50,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            uploadMultiple: true,
            init: function() {
                var submitButton = document.querySelector("#uploadFile");
                myDropzone = this;
                submitButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                myDropzone.on("addedfile", function(file) {
                    if (!file.type.match(/image.*/)) {
                        myDropzone.emit("thumbnail", file, "path/to/img");
                    }
                });
                myDropzone.on('sending', function(file, xhr, formData) {
                    formData.append('_token', $("input[name='_token']").val());
                    formData.append('category_id', $("#category_id").val());
                    formData.append('metal_type', $("#metal_type").val());
                    formData.append('metal_colour', $("#metal_colour").val());
                    formData.append('size', $("#size").val());
                    formData.append('quantity', $("#quantity").val());
                    formData.append('notes', $("#notes").val());
                });
            },
            success: function(file, response) {
                Swal.fire({
                    title: "{{ __('Order Confirmed') }}",
                    text: "{{ __('est. delivery 5 weeks') }}",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#1a1a2e',
                    cancelButtonColor: '#d33',
                    cancelButtonText: "{{ __('Create New Order') }}",
                    confirmButtonText: "{{ __('Done') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ URL::to('/') }}";
                    } else {
                        window.location.href = "{{ URL::to('/order') }}";
                    }
                });
            },
        };
    </script>
@endsection
