@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')
<style type="text/css">
    .back {
  background: #e2e2e2;
  width: 100%;
  position: absolute;
  top: 0;
  /*bottom: 0;*/
}

.div-center {
  width: 700px;
  height: 100%;
  background-color: #fff;
  position: relative;
  left: 0;
  right: 0;
  top: 0;
  /*bottom: 0;*/
  margin: auto;
  /*max-width: 100%;
  max-height: 100%;*/
  overflow: auto;
  padding: 1em 2em;
  border-bottom: 2px solid #ccc;
  display: table;
}

div.content {
  display: table-cell;
  /*vertical-align: ;*/
  color: black !important;
}
</style>
    <div class="back row">
        <div class="div-center">
            <div class="content">
                <form method="post" action="" enctype="multipart/form-data" >
                  @csrf
                  <h4>Create Order</h4>
                  <div>
                    <label for=""> Category </label>
                      {!! Form::select('category_id', $categories ?? [],  $userRoleId ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'category_id']) !!}
                  </div>
                  <label for="">Picture</label>
                  <div id="dropzone" class="dropzone dz-clickable form-fileupload">
                    <div class="dz-message dz-default" style="text-align:center;">
                        <span>Click Here to upload Photo </span>
                    </div>
                  </div>
                  <div class="mt-2">
                    <label for=""> Metal Type </label>
                      {!! Form::select('metal_type', $metalType ?? [],  $userRoleId ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_type']) !!}
                  </div>
                  <div class="mt-2">
                    <label for=""> Metal Colour </label>
                      {!! Form::select('metal_colour', $metalColour ?? [],  $userRoleId ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_colour']) !!}
                  </div>

                  <div class="mt-2">
                    <label for=""> Size </label>
                      <input type="text" class="form-control" id="size" name="size" value="" placeholder="Size" required>
                  </div>

                  <div class="mt-2">
                    <label for=""> Quantity </label>
                      <input type="number" class="form-control" id="quantity" name="quantity" value="" placeholder="Quantity" required>
                  </div>

                  <div class="mt-2">
                    <label for=""> Notes </label>
                    <textarea type="text" class="form-control" id="notes" name="notes" value="" placeholder="Notes" rows="5" required="false"></textarea>
                  </div>
                </form>
                <div class="mt-2">
                  <button class="btn btn-success" id="uploadFile">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        Dropzone.options.dropzone =
         {
            url: '{{ url("order") }}',
            maxFilesize: 12,
            autoProcessQueue: false,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            parallelUploads: 50,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            uploadMultiple: true,
            init: function() {
              var submitButton = document.querySelector("#uploadFile")
              myDropzone = this;
              submitButton.addEventListener("click", function(e) {
                  e.preventDefault();
                  e.stopPropagation();
                  myDropzone.processQueue(); 
              });
              myDropzone.on("addedfile", function(file) {
                  if (!file.type.match(/image.*/)) {
                      if(file.type.match(/application.zip/)){
                          myDropzone.emit("thumbnail", file, "path/to/img");
                      } else {
                          myDropzone.emit("thumbnail", file, "path/to/img");
                      }
                  }
              });
            
              myDropzone.on('sending', function(file, xhr, formData){
                formData.append('_token',$("input[name='_token']").val());
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
                title: 'Order Confrimed',
                text: "est. delivery 5 weeks",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Create New Order',
                confirmButtonText: 'Done'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "{{ URL::to('/') }}";
                }else{
                  window.location.href = "{{ URL::to('/order') }}";
                }
              })
              // $('#display_images').html(response);
            },
      };
    </script>
@endsection