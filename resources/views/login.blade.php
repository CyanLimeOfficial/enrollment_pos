<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets/custom_assets/Picture/sign-in-pic.png') }}" type="image/x-icon" />
    <title>Sign In | CMS</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->


    <!-- ======== signin-wrapper start =========== -->
    <main class="signin-wrapper">
      <!-- ========== signin-section start ========== -->
      <section class="signin-section">
        <div class="container-fluid">
          <div class="row g-0 auth-row">
            <div class="col-lg-6">
              <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                  <div class="title text-center">
                    <h1 class=" mb-10" style="color: rgb(245, 234, 234);">POS Transmittal Enrollment</h1>
                    <p class="text-medium" style="color: rgb(222, 212, 212);">
                      Biliran Provincial Hospital
                    </p>
                  </div>
                  <div class="cover-image">
                    <img src="assets/custom_assets/Picture/sign-in-pic.png" alt="" />
                  </div>
                  <div class="shape-image">
                    <img src="assets/images/auth/shape.svg" alt="" />
                  </div>
                </div>
              </div>
            </div>
            <!-- end col -->
            <div class="col-lg-6">
              <div class="signin-wrapper bg-secondary-100">
                <div class="form-wrapper">
                  <h6 class="mb-15">Login Form</h6>
                  <p class="text-sm mb-25">
                    Start creating the best possible user experience for your
                    customers.
                  </p>
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                      <div class="col-12">
                        <div class="input-style-1">
                          <label>Username</label>
                          <input type="text" name="username" placeholder="Username" required autofocus />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="input-style-1">
                          <label>Password</label>
                          <input type="password" name="password" placeholder="Password" required />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check checkbox-style mb-30">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                          <label class="form-check-label" for="remember">
                            Remember me next time
                          </label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="button-group d-flex justify-content-center flex-wrap">
                          <button class="main-btn primary-btn btn-hover w-100 text-center" type="submit">
                            Sign In
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="singin-option pt-40">
                    <p class="text-sm text-medium text-dark text-center">

                        <!-- Flash Message -->
                        @if (session('status'))
                          <div class="alert alert-success">
                            {{ session('status') }}
                          </div>
                        @endif
                        @if ($errors->any())
                          <div class="alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- end col -->
          </div>
        </div>
      </section>
      <!-- ========== signin-section end ========== -->


    </main>
    <!-- ======== signin-wrapper end =========== -->

  <!-- ========= All JavaScript files linkup ======== -->
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/js/dynamic-pie-chart.js') }}"></script>
  <script src="{{ asset('assets/js/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
  <script src="{{ asset('assets/js/jvectormap.min.js') }}"></script>
  <script src="{{ asset('assets/js/world-merc.js') }}"></script>
  <script src="{{ asset('assets/js/polyfill.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

  </body>
</html>
