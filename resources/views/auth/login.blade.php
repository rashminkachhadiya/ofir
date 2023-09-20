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
  border-radius: 40px;
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
</style>
    <div class="back row">
        <div class="div-center">
            <div class="main">
                <div class="signup-content">
                    <div class="signup-form">
                        <form method="POST" action="{{ route('login') }}" class="register-form" id="register-form">
                            @csrf
                            <h4>Log In</h4>
                            <p>Enter your Username and password to access account</p>
                            
                            <div class="form-floating mb-3">
                              <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required>
                              <label for="floatingInput">Username</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                              <label for="floatingPassword">Password</label>
                                @if ($errors->has('password'))
                                <span class="is-invalid">The password field is required.</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-block">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="" style="display:none;" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
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
