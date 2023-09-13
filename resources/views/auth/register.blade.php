@extends('auth.layouts.app')
@section('content')
<style type="text/css">
    .back {
  background: #e2e2e2;
  width: 100%;
  position: absolute;
  top: 0;
  bottom: 0;
}

.div-center {
  width: 400px;
  height: 400px;
  background-color: #fff;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  max-width: 100%;
  max-height: 100%;
  overflow: auto;
  padding: 1em 2em;
  border-bottom: 2px solid #ccc;
  display: table;
}

div.content {
  display: table-cell;
  vertical-align: middle;
}

.is-invalid {
    color: red;
}
</style>
<div class="back row">
    <div class="div-center">
        <div class="main">
            <div class="signup-content">
                <div class="signup-form">
                   <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h4 class="mb-2">Registration</h4>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                  <input type="text" name="f_name" class="form-control" id="f_name" placeholder="name@example.com" value="{{ old('f_name') }}" required>
                                  <label for="floatingInput required">First Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                  <input type="text" name="l_name" class="form-control" id="l_name" placeholder="name@example.com" value="{{ old('l_name') }}">
                                  <label for="floatingInput required">Last Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                  <input type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required>
                                  <label for="floatingInput">Email address</label>
                                  @if ($errors->has('email'))
                                    <span class="is-invalid">{{ $errors->first('email') }}</span>
                                @endif
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="name@example.com" value="{{ old('mobile') }}">
                                    <label for="floatingInput required">Mobile</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form> 
                </div>
                <div class="signup-img">
                    <img src="{{ asset('assets/images/BG_image_8.png') }}" class="right-image" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection