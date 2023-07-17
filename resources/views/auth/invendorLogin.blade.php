<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>

    <link rel="stylesheet" href="{{ asset('inventory/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('inventory/assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{ asset('inventory/assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('inventory/assets/images/favicon.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Login</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="form-group">
                    <label>Email *</label>
                    <input type="email" class="form-control p_input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="password" class="form-control p_input @error('password') is-invalid @enderror" name="password">
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="remember"> Remember me </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  {{-- <div class="d-flex">
                    <button class="btn btn-facebook mr-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div> --}}
                  {{-- <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p> --}}
                </form>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>


    <script src="{{ asset('inventory/assets/vendors/js/vendor.bundle.base.js')}}"></script>

    <script src="{{ asset('inventory/assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('inventory/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('inventory/assets/js/misc.js')}}"></script>
    <script src="{{ asset('inventory/assets/js/settings.js')}}"></script>
    <script src="{{ asset('inventory/assets/js/todolist.js')}}"></script>

  </body>
</html>
