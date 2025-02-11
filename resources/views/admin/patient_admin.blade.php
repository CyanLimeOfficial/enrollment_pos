<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets/custom_assets/Picture/sign-in-pic.png')}}" type="image/x-icon" />
    <title>Patient | POS</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
<style>
  #patientModal .btn-primary i {
    font-size: 1.25rem !important;
    color: #fff !important;
    display: inline-block !important;
}
</style>
    <!-- Datatables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-2.2.1/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/dt/dt-2.2.1/datatables.min.js"></script>
    <!-- Excel Export -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
      <div class="navbar-logo">
        <a href="index.html">
          <img src="{{ asset('assets/custom_assets/Picture/sign-in-pic.png')}}" alt="logo" height="50px"/>
          <span class="text"><h2 style="color: #F5F8FC">POS</h2></span>
        </a>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item">
            <a
              href="#0"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_1"
              aria-controls="ddmenu_1"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z" />
                  <path
                    d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z" />
                </svg>
              </span>
              <span class="text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.patient_admin') }}">
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10 10C7.23858 10 5 7.76142 5 5C5 2.23858 7.23858 0 10 0C12.7614 0 15 2.23858 15 5C15 7.76142 12.7614 10 10 10ZM10 12C11.1046 12 12 12.8954 12 14V15H8V14C8 12.8954 8.89543 12 10 12ZM10 18C6.13401 18 3 14.866 3 11H17C17 14.866 13.866 18 10 18Z"/>
                </svg>
              </span>
              <span class="text">Patients</span>
            </a>
          </li>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_3"
              aria-controls="ddmenu_3"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
            <span class="icon">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M3.33334 3.35442C3.33334 2.4223 4.07954 1.66666 5.00001 1.66666H15C15.9205 1.66666 16.6667 2.4223 16.6667 3.35442V16.8565C16.6667 17.5519 15.8827 17.9489 15.3333 17.5317L13.8333 16.3924C13.537 16.1673 13.1297 16.1673 12.8333 16.3924L10.5 18.1646C10.2037 18.3896 9.79634 18.3896 9.50001 18.1646L7.16668 16.3924C6.87038 16.1673 6.46298 16.1673 6.16668 16.3924L4.66668 17.5317C4.11731 17.9489 3.33334 17.5519 3.33334 16.8565V3.35442ZM4.79168 5.04218C4.79168 5.39173 5.0715 5.6751 5.41668 5.6751H10C10.3452 5.6751 10.625 5.39173 10.625 5.04218C10.625 4.69264 10.3452 4.40927 10 4.40927H5.41668C5.0715 4.40927 4.79168 4.69264 4.79168 5.04218ZM5.41668 7.7848C5.0715 7.7848 4.79168 8.06817 4.79168 8.41774C4.79168 8.76724 5.0715 9.05066 5.41668 9.05066H10C10.3452 9.05066 10.625 8.76724 10.625 8.41774C10.625 8.06817 10.3452 7.7848 10 7.7848H5.41668ZM4.79168 11.7932C4.79168 12.1428 5.0715 12.4262 5.41668 12.4262H10C10.3452 12.4262 10.625 12.1428 10.625 11.7932C10.625 11.4437 10.3452 11.1603 10 11.1603H5.41668C5.0715 11.1603 4.79168 11.4437 4.79168 11.7932ZM13.3333 4.40927C12.9882 4.40927 12.7083 4.69264 12.7083 5.04218C12.7083 5.39173 12.9882 5.6751 13.3333 5.6751H14.5833C14.9285 5.6751 15.2083 5.39173 15.2083 5.04218C15.2083 4.69264 14.9285 4.40927 14.5833 4.40927H13.3333ZM12.7083 8.41774C12.7083 8.76724 12.9882 9.05066 13.3333 9.05066H14.5833C14.9285 9.05066 15.2083 8.76724 15.2083 8.41774C15.2083 8.06817 14.9285 7.7848 14.5833 7.7848H13.3333C12.9882 7.7848 12.7083 8.06817 12.7083 8.41774ZM13.3333 11.1603C12.9882 11.1603 12.7083 11.4437 12.7083 11.7932C12.7083 12.1428 12.9882 12.4262 13.3333 12.4262H14.5833C14.9285 12.4262 15.2083 12.1428 15.2083 11.7932C15.2083 11.4437 14.9285 11.1603 14.5833 11.1603H13.3333Z" />
              </svg>
            </span>
              <span class="text">Archive</span>
            </a>
            <ul id="ddmenu_3" class="collapse dropdown-nav">
              <li>
                <a href="{{ route('admin.archive.transmittal_archive_admin') }}"> Transmittal </a>
              </li>
              <li>
                <a href="{{ route('admin.archive.patientList_archive_admin') }}"> Patient List </a>
              </li>
            </ul>
          </li>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_4"
              aria-controls="ddmenu_4"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M1.66666 5.41669C1.66666 3.34562 3.34559 1.66669 5.41666 1.66669C7.48772 1.66669 9.16666 3.34562 9.16666 5.41669C9.16666 7.48775 7.48772 9.16669 5.41666 9.16669C3.34559 9.16669 1.66666 7.48775 1.66666 5.41669Z" />
                  <path
                    d="M1.66666 14.5834C1.66666 12.5123 3.34559 10.8334 5.41666 10.8334C7.48772 10.8334 9.16666 12.5123 9.16666 14.5834C9.16666 16.6545 7.48772 18.3334 5.41666 18.3334C3.34559 18.3334 1.66666 16.6545 1.66666 14.5834Z" />
                  <path
                    d="M10.8333 5.41669C10.8333 3.34562 12.5123 1.66669 14.5833 1.66669C16.6544 1.66669 18.3333 3.34562 18.3333 5.41669C18.3333 7.48775 16.6544 9.16669 14.5833 9.16669C12.5123 9.16669 10.8333 7.48775 10.8333 5.41669Z" />
                  <path
                    d="M10.8333 14.5834C10.8333 12.5123 12.5123 10.8334 14.5833 10.8334C16.6544 10.8334 18.3333 12.5123 18.3333 14.5834C18.3333 16.6545 16.6544 18.3334 14.5833 18.3334C12.5123 18.3334 10.8333 16.6545 10.8333 14.5834Z" />
                </svg>
              </span>
              <span class="text">Report </span>
            </a>
            <ul id="ddmenu_4" class="collapse dropdown-nav">
              <li>
                <a href="alerts.html"> Daily </a>
              </li>
              <li>
                <a href="buttons.html"> Weekly </a>
              </li>
              <li>
                <a href="cards.html"> Monthly </a>
              </li>
              <li>
                <a href="typography.html"> Yearly </a>
              </li>
            </ul>
          </li>
          <span class="divider"><hr /></span>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_55"
              aria-controls="ddmenu_55"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M5.48663 1.1466C5.77383 0.955131 6.16188 1.03274 6.35335 1.31994L6.87852 2.10769C7.20508 2.59755 7.20508 3.23571 6.87852 3.72556L6.35335 4.51331C6.16188 4.80052 5.77383 4.87813 5.48663 4.68666C5.19943 4.49519 5.12182 4.10715 5.31328 3.81994L5.83845 3.03219C5.88511 2.96221 5.88511 2.87105 5.83845 2.80106L5.31328 2.01331C5.12182 1.72611 5.19943 1.33806 5.48663 1.1466Z" />
                  <path
                    d="M2.49999 5.83331C2.03976 5.83331 1.66666 6.2064 1.66666 6.66665V10.8333C1.66666 13.5948 3.90523 15.8333 6.66666 15.8333H9.99999C12.1856 15.8333 14.0436 14.431 14.7235 12.4772C14.8134 12.4922 14.9058 12.5 15 12.5H16.6667C17.5872 12.5 18.3333 11.7538 18.3333 10.8333V8.33331C18.3333 7.41284 17.5872 6.66665 16.6667 6.66665H15C15 6.2064 14.6269 5.83331 14.1667 5.83331H2.49999ZM14.9829 11.2496C14.9942 11.1123 15 10.9735 15 10.8333V7.91665H16.6667C16.8967 7.91665 17.0833 8.10319 17.0833 8.33331V10.8333C17.0833 11.0634 16.8967 11.25 16.6667 11.25H15L14.9898 11.2498L14.9829 11.2496Z" />
                  <path
                    d="M8.85332 1.31994C8.6619 1.03274 8.27383 0.955131 7.98663 1.1466C7.69943 1.33806 7.62182 1.72611 7.81328 2.01331L8.33848 2.80106C8.38507 2.87105 8.38507 2.96221 8.33848 3.03219L7.81328 3.81994C7.62182 4.10715 7.69943 4.49519 7.98663 4.68666C8.27383 4.87813 8.6619 4.80052 8.85332 4.51331L9.37848 3.72556C9.70507 3.23571 9.70507 2.59755 9.37848 2.10769L8.85332 1.31994Z" />
                  <path
                    d="M10.4867 1.1466C10.7738 0.955131 11.1619 1.03274 11.3533 1.31994L11.8785 2.10769C12.2051 2.59755 12.2051 3.23571 11.8785 3.72556L11.3533 4.51331C11.1619 4.80052 10.7738 4.87813 10.4867 4.68666C10.1994 4.49519 10.1218 4.10715 10.3133 3.81994L10.8385 3.03219C10.8851 2.96221 10.8851 2.87105 10.8385 2.80106L10.3133 2.01331C10.1218 1.72611 10.1994 1.33806 10.4867 1.1466Z" />
                  <path
                    d="M2.49999 16.6667C2.03976 16.6667 1.66666 17.0398 1.66666 17.5C1.66666 17.9602 2.03976 18.3334 2.49999 18.3334H14.1667C14.6269 18.3334 15 17.9602 15 17.5C15 17.0398 14.6269 16.6667 14.1667 16.6667H2.49999Z" />
                </svg>
              </span>
              <span class="text">Audit Trail</span>
            </a>
            <ul id="ddmenu_55" class="collapse dropdown-nav">
              <li>
                <a href="icons.html"> User Activity </a>
              </li>
              <li>
                <a href="mdi-icons.html"> User Logs </a>
              </li>
              <li>
                <a href="mdi-icons.html"> System Logs </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a
              href="#0"
              class="collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_5"
              aria-controls="ddmenu_5"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M4.16666 3.33335C4.16666 2.41288 4.91285 1.66669 5.83332 1.66669H14.1667C15.0872 1.66669 15.8333 2.41288 15.8333 3.33335V16.6667C15.8333 17.5872 15.0872 18.3334 14.1667 18.3334H5.83332C4.91285 18.3334 4.16666 17.5872 4.16666 16.6667V3.33335ZM6.04166 5.00002C6.04166 5.3452 6.32148 5.62502 6.66666 5.62502H13.3333C13.6785 5.62502 13.9583 5.3452 13.9583 5.00002C13.9583 4.65485 13.6785 4.37502 13.3333 4.37502H6.66666C6.32148 4.37502 6.04166 4.65485 6.04166 5.00002ZM6.66666 6.87502C6.32148 6.87502 6.04166 7.15485 6.04166 7.50002C6.04166 7.8452 6.32148 8.12502 6.66666 8.12502H13.3333C13.6785 8.12502 13.9583 7.8452 13.9583 7.50002C13.9583 7.15485 13.6785 6.87502 13.3333 6.87502H6.66666ZM6.04166 10C6.04166 10.3452 6.32148 10.625 6.66666 10.625H9.99999C10.3452 10.625 10.625 10.3452 10.625 10C10.625 9.65485 10.3452 9.37502 9.99999 9.37502H6.66666C6.32148 9.37502 6.04166 9.65485 6.04166 10ZM9.99999 16.6667C10.9205 16.6667 11.6667 15.9205 11.6667 15C11.6667 14.0795 10.9205 13.3334 9.99999 13.3334C9.07949 13.3334 8.33332 14.0795 8.33332 15C8.33332 15.9205 9.07949 16.6667 9.99999 16.6667Z" />
                </svg>
              </span>
              <span class="text"> User Management </span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">

            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                <!-- notification start -->
                <div class="notification-box ml-15 d-none d-md-flex">
                  <button class="dropdown-toggle" type="button" id="notification" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M11 20.1667C9.88317 20.1667 8.88718 19.63 8.23901 18.7917H13.761C13.113 19.63 12.1169 20.1667 11 20.1667Z"
                        fill="" />
                      <path
                        d="M10.1157 2.74999C10.1157 2.24374 10.5117 1.83333 11 1.83333C11.4883 1.83333 11.8842 2.24374 11.8842 2.74999V2.82604C14.3932 3.26245 16.3051 5.52474 16.3051 8.24999V14.287C16.3051 14.5301 16.3982 14.7633 16.564 14.9352L18.2029 16.6342C18.4814 16.9229 18.2842 17.4167 17.8903 17.4167H4.10961C3.71574 17.4167 3.5185 16.9229 3.797 16.6342L5.43589 14.9352C5.6017 14.7633 5.69485 14.5301 5.69485 14.287V8.24999C5.69485 5.52474 7.60672 3.26245 10.1157 2.82604V2.74999Z"
                        fill="" />
                    </svg>
                    <span></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notification">
                    <li>
                      <a href="#0">
                        <div class="image">
                          <img src="assets/images/lead/lead-6.png" alt="" />
                        </div>
                        <div class="content">
                          <h6>
                            John Doe
                            <span class="text-regular">
                              comment on a product.
                            </span>
                          </h6>
                          <p>
                            Lorem ipsum dolor sit amet, consect etur adipiscing
                            elit Vivamus tortor.
                          </p>
                          <span>10 mins ago</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#0">
                        <div class="image">
                          <img src="assets/images/lead/lead-1.png" alt="" />
                        </div>
                        <div class="content">
                          <h6>
                            Jonathon
                            <span class="text-regular">
                              like on a product.
                            </span>
                          </h6>
                          <p>
                            Lorem ipsum dolor sit amet, consect etur adipiscing
                            elit Vivamus tortor.
                          </p>
                          <span>10 mins ago</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- notification end -->
                <!-- profile start -->
                <div class="profile-box ml-15">
                  <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-info">
                      <div class="info">
                        <!-- Display Profile Picture -->
                        <div class="image">
                            <!-- Check if profile picture is stored in session -->
                            @if(session('profile_picture'))
                            <img src="{{ session('profile_picture') }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 90px; height: 50px; object-fit: cover;">
                            @else
                                <!-- Default Profile Picture if none is stored -->
                                <img src="{{ asset('assets/images/profile/profile-image.png') }}" alt="Default Profile Picture" class="img-fluid rounded-circle" width="150">
                            @endif
                        </div>
                        <div>
                        <h6 class="fw-500">
                            {{ session('first_name') }}
                            {{ session('middle_name') ? session('middle_name') . ' ' : '' }}
                            {{ session('last_name') }}
                            {{ session('suffix') ? session('suffix') : '' }}
                        </h6>
                          <p>{{ session('user_type') }}</p>
                        </div>
                      </div>
                    </div>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                    <li>
                      <div class="author-info flex items-center !p-1">
                        <div class="content">
                          <h4 class="text-sm">
                          {{ session('first_name') }}
                            {{ session('middle_name') ? session('middle_name') . ' ' : '' }}
                            {{ session('last_name') }}
                            {{ session('suffix') ? session('suffix') : '' }}
                          </h4>
                          <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs" href="#">{{ session('email') ? session('email') : 'Email not available' }}</a>
                        </div>
                      </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="#0">
                        <i class="lni lni-user"></i> Profile Settings
                      </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; padding: 0;">
                          <i class="lni lni-exit"></i> Log Out
                        </button>
                      </form>
                    </li>

                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- ========== header end ========== -->

      <!-- ========== section start ========== -->
      <section class="section">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                </div>
              </div>
              <!-- end col -->

              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
          <!-- End Row -->
          <div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30">
                <div class="title">
                  <h2>Patient Enrolled POS</h2>
                </div>
                  <p class="text-sm mb-20">
                    List of patients.
                  </p>
                  <div class="container mt-3">
                      @if (session('success'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Success!</strong> {{ session('success') }}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      @endif

                      @if (session('error'))
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>Error!</strong> {{ session('error') }}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      @endif
                                </div>
                                <div class="modal fade" id="previewModal" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Preview & Transmittal Form</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Transmittal Form -->
                                                <form id="transmittalForm">
                                                  <div class="mb-3" style="display:block;">
                                                    <label for="transmittal_id">Transmittal ID</label>
                                                    <div class="d-flex align-items-center">
                                                        <input type="text" value="" class="form-control me-2 border border-danger" id="transmittal_id" name="transmittal_id" required readonly>
                                                        <input type="checkbox" id="editTransmittalId">
                                                        <label for="editTransmittalId" class="ms-1">Override</label>
                                                    </div>
                                                </div>

                                                <!-- Confirmation Modal -->
                                                <div class="modal fade" id="confirmEditModal" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirm Edit</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to override the Transmittal ID? This may affect record tracking.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" id="cancelEdit">Cancel</button>
                                                                <button type="button" class="btn btn-success" id="confirmEdit">Yes, Override</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                  $(document).ready(function() {
                                                      let editCheckbox = $('#editTransmittalId');
                                                      let transmittalInput = $('#transmittal_id');

                                                      function updateBorder() {
                                                          if (transmittalInput.prop('readonly')) {
                                                              transmittalInput.removeClass('border-success').addClass('border-danger'); // Red border when read-only
                                                          } else {
                                                              transmittalInput.removeClass('border-danger').addClass('border-success'); // Green border when editable
                                                          }
                                                      }

                                                      editCheckbox.on('change', function() {
                                                          if ($(this).is(':checked')) {
                                                              $('#confirmEditModal').modal('show'); // Show confirmation modal
                                                          } else {
                                                              transmittalInput.prop('readonly', true);
                                                              updateBorder();
                                                          }
                                                      });

                                                      // Confirm edit
                                                      $('#confirmEdit').on('click', function() {
                                                          transmittalInput.prop('readonly', false); // Enable input field
                                                          updateBorder();
                                                          $('#confirmEditModal').modal('hide');
                                                      });

                                                      // Cancel edit
                                                      $('#cancelEdit').on('click', function() {
                                                          editCheckbox.prop('checked', false); // Uncheck the box
                                                          $('#confirmEditModal').modal('hide');
                                                      });

                                                      // Apply initial border color
                                                      updateBorder();
                                                  });
                                                </script>
                                                    <div class="mb-3">
                                                        <label for="prepared_by">Prepared By</label>
                                                        <input type="text" class="form-control" id="prepared_by" name="prepared_by" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success" id="exportBtn">Submit</button>
                                                </form>
                                                <hr>
                                                <div class="table-wrapper table-responsive">
                                                    <!-- Selected Data Table -->
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th style="min-width: 130px;">Date of Expiry (60 days)</th>                                         
                                                                <th style="min-width: 100px;">Admitted</th>
                                                                <th style="min-width: 100px;">Discharge</th>
                                                                <th style="min-width: 250px;">MEMBER (Name of Member)</th>
                                                                <th style="min-width: 130px;">MEMBER - BIRTHDAY</th>
                                                                <th style="min-width: 250px;">DEPENDENT - PATIENT</th>
                                                                <th style="min-width: 130px;">DEPENDENT - BIRTHDAY</th>
                                                                <th style="min-width: 100px;">PIN</th>
                                                                <th style="min-width: 150px;">ATTACHMENT (Member)</th>
                                                                <th style="min-width: 150px;">ATTACHMENT (Dependent)</th>
                                                                <th style="min-width: 250px;">REASON / PURPOSE</th>
                                                                <th style="min-width: 200px;">STATUS</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="previewTableBody"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        // Handle Export to Excel
                                        $('#exportBtn').on('click', function(e) {
                                            e.preventDefault(); // Prevent form submission, use AJAX instead

                                            // Collect form data
                                            var transmittalId = $('#transmittal_id').val();
                                            var preparedBy = $('#prepared_by').val();

                                            // Collect table data from the preview table
                                            var tableData = [];
                                            $('#previewTableBody tr').each(function() {
                                                var rowData = [];
                                                $(this).find('td').each(function() {
                                                    rowData.push($(this).text().trim()); // Get trimmed text from each cell
                                                });
                                                if (rowData.length > 0) {
                                                    tableData.push(rowData);
                                                }
                                            });

                                            // Validate form data
                                            if (!transmittalId || !preparedBy) {
                                                alert("Please provide Transmittal ID and Prepared By details.");
                                                return;
                                            }

                                            if (tableData.length === 0) {
                                                alert('No data available in the table!');
                                                return;
                                            }

                                            
                                            var formData = {
                                                transmittal_id: transmittalId,
                                                prepared_by: preparedBy,
                                                tableData: JSON.stringify(tableData),
                                                _token: '{{ csrf_token() }}'  // Include CSRF token
                                            };

                                            
                                          // Show the modal immediately
                                          $('#loadingModal').modal('show');

                                            let countdown = 3;
                                            $('#countdownTimer').text(countdown);

                                            // Start the countdown
                                            let countdownInterval = setInterval(function () {
                                                countdown--;
                                                $('#countdownTimer').text(countdown);
                                                if (countdown <= 0) {
                                                    clearInterval(countdownInterval);
                                                    $('#loadingText').hide(); // Hide loading text
                                                    $('#modalFooter').show(); // Show buttons
                                                }
                                            }, 1000);

                                            // Debugging: Log values before sending
                                            console.log("Transmittal ID:", transmittalId);
                                            console.log("Prepared By:", preparedBy);
                                            console.log("Table Data:", tableData);

                                            // Send data via AJAX to export
                                            $.ajax({
                                                url: '{{ route('patients.store.transmittal') }}',  // Ensure this is the correct route
                                                type: 'POST',
                                                data: formData,  // Send data
                                                success: function(response) {
                                                    // Assuming the controller returns the file path for download

                                                    window.location.href = response;  // Redirect to download the file
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error("Error:", error);
                                                }
                                            });
                                        });

                                        // Handle preview button click
                                        $('#previewBtn').on('click', function() {
                                            let selectedRows = [];

                                            // Loop through all checked checkboxes
                                            $('.rowCheckbox:checked').each(function(index) {
                                                const tr = $(this).closest('tr'); // Get the closest table row
                                                const rowData = [`${index + 1}`]; // Start with row number

                                                // Loop through each cell in the row (excluding checkboxes and action buttons)
                                                $(tr).find('td:not(:first-child, :nth-child(2), :nth-child(4))').each(function() {
                                                    rowData.push($(this).text().trim());
                                                });

                                                if (rowData.length > 0) {
                                                    selectedRows.push(rowData);
                                                }
                                            });

                                            // Clear the preview table body
                                            $('#previewTableBody').empty();

                                            // Populate the preview table with selected rows
                                            selectedRows.forEach(row => {
                                                let rowHtml = '<tr>';
                                                row.forEach(cell => {
                                                    rowHtml += `<td>${cell}</td>`;
                                                });
                                                rowHtml += '</tr>';
                                                $('#previewTableBody').append(rowHtml);
                                            });

                                            // Update the number of claims
                                            $('#numClaims').val(selectedRows.length);

                                            // Fetch the latest transmittal_id and set it in the input field
                                            $.ajax({
                                                url: '/get-latest-transmittal',
                                                type: 'GET',
                                                success: function(response) {
                                                    $('#transmittal_id').val(response.transmittal_id);
                                                },
                                                error: function() {
                                                    alert('Failed to fetch the latest Transmittal ID');
                                                }
                                            });

                                            // Show the preview modal if there are selected rows
                                            if (selectedRows.length > 0) {
                                                $('#previewModal').modal('show');
                                            } else {
                                                alert('Please select at least one claim to preview!');
                                            }
                                        });


                                        // Handle select all checkbox
                                        $('#selectAll').on('change', function() {
                                            $('.rowCheckbox').prop('checked', this.checked);
                                        });

                                        $('#transmittalForm').on('submit', function (e) {
                                          e.preventDefault(); // Prevent default form submission

                                          // Collect table data from the preview table
                                          var tableData = [];
                                          $('#previewTableBody tr').each(function () {
                                              var rowData = {};
                                              $(this).find('td').each(function (index) {
                                                  rowData[index] = $(this).text().trim(); // Trim whitespace
                                              });
                                              tableData.push(rowData);
                                          });

                                          // Ensure transmittal_id and prepared_by are included
                                          var transmittalId = $('#transmittal_id').val();
                                          var preparedBy = $('#prepared_by').val();

                                          // Debugging: Log values before sending
                                          console.log("Transmittal ID:", transmittalId);
                                          console.log("Prepared By:", preparedBy);
                                          console.log("Table Data:", tableData);

                                          // Validate inputs
                                          if (!transmittalId || !preparedBy) {
                                              alert("Please provide Transmittal ID and Prepared By details.");
                                              return;
                                          }

                                          if (tableData.length === 0) {
                                              alert('No data available in the table!');
                                              return;
                                          }

                                          // Create FormData object
                                          var formData = new FormData(this);
                                          formData.append('tableData', JSON.stringify(tableData));
                                          formData.append('transmittal_id', transmittalId);
                                          formData.append('prepared_by', preparedBy);

                                          // Submit the form data via AJAX
                                          $.ajax({
                                              url: '{{ route('patients.store.transmittal') }}',
                                              type: 'POST',
                                              data: formData,
                                              processData: false,
                                              contentType: false,
                                              success: function (response) {
                                                  console.log("Success Response:", response); // ✅ Debug response

                                  
                                              },
                                              error: function (xhr) {
                                                  console.error("AJAX Error:", xhr.responseText); // Debug any errors
                                                  alert("Error: " + (xhr.responseJSON?.error || 'Something went wrong.'));
                                              }
                                          });
                                      });

                                    });
                                </script>
                                  <!-- Loading Modal -->
                                  <div id="loadingModal" class="modal fade" tabindex="-1" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title">Processing Transmittal</h5>
                                              </div>
                                              <div class="modal-body text-center">
                                                  <div id="loadingText">
                                                      <p>Please wait... <span id="countdownTimer">3</span> seconds</p>
                                                      <div class="spinner-border text-primary" role="status"></div>
                                                  </div>
                                                  <div id="modalFooter" style="display: none;">
                                                      <p>Transmittal export completed!</p>
                                                      <a id="visitArchiveBtn" href="{{ route('admin.archive.transmittal_archive_admin') }}" class="btn btn-success">Visit Archive</a>
                                                      <button type="button" href="{{ route('admin.patient_admin') }}" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- Edit Patient Details Modal -->

                              <div class="table-wrapper table-responsive">
                              <table id="selectable" class="display table table-striped cell-border table-hover dataTable">
                                  <!-- Add CSRF token and route URL inside the button -->
                                 
                                    <button id="previewBtn" class="btn btn-primary">Preview Selected</button>
                                    <!-- Modal -->
                                
                                  <thead>
                                      <tr>
                                          <th><input type="checkbox" id="selectAll"></th>
                                          <th>Action</th>
                                          <th style="min-width: 130px;">Date of Expiry (60 days)</th>
                                          <th style="min-width: 50px;">Discharge for counting for 60 days</th>
                                          <th style="min-width: 100px;">Admitted</th>
                                          <th style="min-width: 100px;">Discharge</th>
                                          <th style="min-width: 250px;">MEMBER (Name of Member)</th>
                                          <th style="min-width: 130px;">MEMBER - BIRTHDAY</th>
                                          <th style="min-width: 250px;">DEPENDENT - PATIENT</th>
                                          <th style="min-width: 130px;">DEPENDENT - BIRTHDAY</th>
                                          <th style="min-width: 100px;">PIN</th>
                                          <th style="min-width: 150px;">ATTACHMENT (Member)</th>
                                          <th style="min-width: 150px;">ATTACHMENT (Dependent)</th>
                                          <th style="min-width: 250px;">REASON / PURPOSE</th>
                                          <th style="min-width: 200px;">STATUS</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($patients as $patient)
                                          @foreach($patient->dependents as $dependent)
                                              <tr data-id="{{ $patient->health_record_id }}">
                                                  <!-- Checkbox -->
                                                  <td><input type="checkbox" class="rowCheckbox"></td>

                                                  <!-- Action -->
                                                  <td>
                                                      <div class="action">
                                                          <!-- View Details Button for Enrolled POS Patient -->
                                                          <button type="button" class="text-secondary" title="View Details" data-bs-toggle="modal" data-bs-target="#patientModal" data-patient-id="{{ $patient->health_record_id }}">
                                                              <i class="lni lni-eye"></i>
                                                          </button>
                                                          <!-- Patient Details Modal -->
<!-- Patient Details Modal (View Only) -->
<div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="patientModalLabel">Patient Details</h5>
        <!-- Button to open the Edit modal -->
        <div class="d-inline-flex align-items-center">
  <button style="color:black;" type="button" class="btn btn-primary" id="openEditModalBtn" title="Edit Details">
    <i style="color:black;" class="lni lni-pencil-alt"></i> Edit
  </button>
  <button style="color:black;" type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
      </div>
      <div class="modal-body">
        <!-- Patient details will be dynamically injected here -->
        <div id="patientDetailsContent"></div>
      </div>
    </div>
  </div>
</div>
                                                          <script>
                                                            $('#patientModal').on('show.bs.modal', function (event) {
                                                                var button = $(event.relatedTarget); // Button that triggered the modal
                                                                var patientId = button.data('patient-id'); // Extract the patient ID

                                                                // Use AJAX to fetch the patient details
                                                                $.ajax({
                                                                    url: '{{ route('admin.view_details', ':patientId') }}'.replace(':patientId', patientId),
                                                                    method: 'GET',
                                                                    success: function(response) {
                                                                        var content = `
                                                                            <ul>
                                                                                <!-- Patient Details -->
                                                                                <div class="card-header text-white" style="
                                                                                    background: linear-gradient(135deg, rgb(7, 118, 33), rgb(181, 202, 179));
                                                                                    border-bottom: none;
                                                                                    padding: 1rem;
                                                                                    border-radius: 20px 20px 0 0;
                                                                                ">
                                                                                    <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Patient Details</h5>
                                                                                </div>
                                                                                <li><strong>Health Record ID:</strong> ${response.health_record_id || ''}</li>
                                                                                <li><strong>PhilHealth ID:</strong> ${response.philhealth_id || ''}</li>
                                                                                <li><strong>Purpose:</strong> ${response.purpose || ''}</li>
                                                                                <li><strong>Provider Konsulta:</strong> ${response.provider_konsulta || ''}</li>
                                                                                
                                                                                <!-- Admission Details -->
                                                                                <li><strong>Admission Date:</strong> ${response.admission_date ? new Date(response.admission_date).toLocaleDateString('en-US') : ''}</li>
                                                                                <li><strong>Discharge Date:</strong> ${response.discharge_date ? new Date(response.discharge_date).toLocaleDateString('en-US') : ''}</li>
                                                                                
                                                                                <!-- Newly Added Fields -->
                                                                                <li><strong>Reason/Purpose:</strong> ${response.reason_or_purpose || ''}</li>
                                                                                <li><strong>Status:</strong> ${response.status || ''}</li>
                                                                                <li><strong>Attachment Type 1:</strong> ${response.attachment_type_1 || ''}</li>
                                                                                
                                                                                <!-- Personal Information -->
                                                                                <div class="card-header text-white" style="
                                                                                    background: linear-gradient(135deg, rgb(7, 118, 33), rgb(181, 202, 179));
                                                                                    border-bottom: none;
                                                                                    padding: 1rem;
                                                                                    border-radius: 20px 20px 0 0;
                                                                                ">
                                                                                    <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Personal Information</h5>
                                                                                </div>
                                                                                <li><strong>Member Name:</strong> ${response.member_first_name} ${response.member_middle_name || ''} ${response.member_last_name} ${response.member_extension_name || ''}</li>
                                                                                <li><strong>Member Mononym:</strong> ${response.member_mononym ? 'Yes' : 'No'}</li>
                                                                                <li><strong>Mother's Name:</strong> ${response.mother_first_name} ${response.mother_middle_name || ''} ${response.mother_last_name} ${response.mother_extension_name || ''}</li>
                                                                                <li><strong>Mother's Mononym:</strong> ${response.mother_mononym ? 'Yes' : 'No'}</li>
                                                                                <li><strong>Spouse's Name:</strong> ${response.spouse_first_name} ${response.spouse_middle_name || ''} ${response.spouse_last_name} ${response.spouse_extension_name || ''}</li>
                                                                                <li><strong>Spouse's Mononym:</strong> ${response.spouse_mononym ? 'Yes' : 'No'}</li>
                                                                                <li><strong>Date of Birth:</strong> ${response.date_of_birth ? new Date(response.date_of_birth).toLocaleDateString('en-US') : ''}</li>
                                                                                <li><strong>Place of Birth:</strong> ${response.place_of_birth || ''}</li>
                                                                                <li><strong>Sex:</strong> ${response.sex || ''}</li>
                                                                                <li><strong>Civil Status:</strong> ${response.civil_status || ''}</li>
                                                                                <li><strong>Citizenship:</strong> ${response.citizenship || ''}</li>
                                                                                <li><strong>PhilSys ID:</strong> ${response.philsys_id || ''}</li>
                                                                                <li><strong>Taxpayer ID:</strong> ${response.tax_payer_id || ''}</li>
                                                                                
                                                                                <!-- Contact and Address Information -->
                                                                                <div class="card-header text-white" style="
                                                                                    background: linear-gradient(135deg, rgb(7, 118, 33), rgb(181, 202, 179));
                                                                                    border-bottom: none;
                                                                                    padding: 1rem;
                                                                                    border-radius: 20px 20px 0 0;
                                                                                ">
                                                                                    <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Contact &amp; Address Information</h5>
                                                                                </div>
                                                                                <li><strong>Address:</strong> ${response.address || ''}</li>
                                                                                <li><strong>Contact Number:</strong> ${response.contact_number || ''}</li>
                                                                                <li><strong>Home Phone Number:</strong> ${response.home_phone_number || ''}</li>
                                                                                <li><strong>Business Direct Line:</strong> ${response.business_direct_line || ''}</li>
                                                                                <li><strong>Email Address:</strong> ${response.email_address || ''}</li>
                                                                                <li><strong>Mailing Address:</strong> ${response.mailing_address || ''}</li>
                                                                                
                                                                                <!-- Dependent Details -->
                                                                                <div class="card-header text-white" style="
                                                                                    background: linear-gradient(135deg, rgb(7, 118, 33), rgb(181, 202, 179));
                                                                                    border-bottom: none;
                                                                                    padding: 1rem;
                                                                                    border-radius: 20px 20px 0 0;
                                                                                ">
                                                                                    <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Dependent Details</h5>
                                                                                </div>
                                                                                ${response.dependents && response.dependents.length > 0 ? response.dependents.map(dependent => `
                                                                                    <ul>
                                                                                        <li><strong>Dependent Name:</strong> ${dependent.dependent_first_name} ${dependent.dependent_middle_name || ''} ${dependent.dependent_last_name} ${dependent.dependent_extension_name || ''}</li>
                                                                                        <li><strong>Relationship:</strong> ${dependent.dependent_relationship || ''}</li>
                                                                                        <li><strong>Date of Birth:</strong> ${dependent.dependent_date_of_birth ? new Date(dependent.dependent_date_of_birth).toLocaleDateString('en-US') : ''}</li>
                                                                                        <li><strong>Mononym:</strong> ${dependent.dependent_mononym ? 'Yes' : 'No'}</li>
                                                                                        <li><strong>Permanent Disability:</strong> ${dependent.permanent_disability ? 'Yes' : 'No'}</li>
                                                                                        <li><strong>Attachment Type 2:</strong> ${dependent.attachment_type_2 || ''}</li>
                                                                                        <li><strong>Admission Date:</strong> ${dependent.admission_date_2 ? new Date(dependent.admission_date_2).toLocaleDateString('en-US') : ''}</li>
                                                                                        <li><strong>Discharge Date:</strong> ${dependent.discharge_date_2 ? new Date(dependent.discharge_date_2).toLocaleDateString('en-US') : ''}</li>
                                                                                        <li><strong>Status:</strong> ${dependent.status_2 || ''}</li>
                                                                                        <li><strong>Reason/Purpose:</strong> ${dependent.reason_or_purpose2 || ''}</li>
                                                                                    </ul>
                                                                                    <hr style="border-top: 1px solid #000; margin: 1rem 0;">
                                                                                `).join('') : '<p>No dependents found.</p>'}
                                                                            </ul>
                                                                        `;
                                                                        $('#patientDetailsContent').html(content);
                                                                    },
                                                                    error: function() {
                                                                        $('#patientDetailsContent').html('<p>Error fetching patient details. Please try again later.</p>');
                                                                    }
                                                                });
                                                            });
                                                          </script>
                                                            <div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
                                                              <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h5 class="modal-title" id="editPatientModalLabel">Edit Patient Details</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <!-- Edit form will be dynamically injected here -->
                                                                    <div id="editPatientContent"></div>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <script>
                                                              // Global variable to store loaded patient data
                                                              let patientData = null;

                                                              // Function to render the read-only patient view
                                                              function renderPatientView(data) {
                                                                return `
                                                                  <ul>
                                                                    <!-- Patient Details -->
                                                                    <div class="card-header text-white" style="
                                                                        background: linear-gradient(135deg, rgb(7,118,33), rgb(181,202,179));
                                                                        border-bottom: none;
                                                                        padding: 1rem;
                                                                        border-radius: 20px 20px 0 0;
                                                                      ">
                                                                      <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Form Details</h5>
                                                                    </div>
                                                                    <li><strong>Health Record ID:</strong> ${data.health_record_id || ''}</li>
                                                                    <li><strong>PhilHealth ID:</strong> ${data.philhealth_id || ''}</li>
                                                                    <li><strong>Purpose:</strong> ${data.purpose || ''}</li>
                                                                    <li><strong>Provider Konsulta:</strong> ${data.provider_konsulta || ''}</li>
                                                                    <!-- Admission Details -->
                                                                    <li><strong>Admission Date:</strong> ${data.admission_date ? new Date(data.admission_date).toLocaleDateString('en-US') : ''}</li>
                                                                    <li><strong>Discharge Date:</strong> ${data.discharge_date ? new Date(data.discharge_date).toLocaleDateString('en-US') : ''}</li>
                                                                    <!-- Newly Added Fields -->
                                                                    <li><strong>Reason/Purpose:</strong> ${data.reason_or_purpose || ''}</li>
                                                                    <li><strong>Status:</strong> ${data.status || ''}</li>
                                                                    <li><strong>Attachment Type 1:</strong> ${data.attachment_type_1 || ''}</li>
                                                                    <li><strong>Attachment Type 2:</strong> ${data.attachment_type_2 || ''}</li>
                                                                    
                                                                    <!-- Personal Information -->
                                                                    <div class="card-header text-white" style="
                                                                        background: linear-gradient(135deg, rgb(7,118,33), rgb(181,202,179));
                                                                        border-bottom: none;
                                                                        padding: 1rem;
                                                                        border-radius: 20px 20px 0 0;
                                                                      ">
                                                                      <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Personal Information</h5>
                                                                    </div>
                                                                    <li><strong>Member Name:</strong> ${data.member_first_name} ${data.member_middle_name || ''} ${data.member_last_name} ${data.member_extension_name || ''}</li>
                                                                    <li><strong>Mononym:</strong> ${data.member_mononym ? 'Yes' : 'No'}</li>
                                                                    <li><strong>Mother's Name:</strong> ${data.mother_first_name} ${data.mother_middle_name || ''} ${data.mother_last_name} ${data.mother_extension_name || ''}</li>
                                                                    <li><strong>Mother's Mononym:</strong> ${data.mother_mononym ? 'Yes' : 'No'}</li>
                                                                    <li><strong>Spouse's Name:</strong> ${data.spouse_first_name} ${data.spouse_middle_name || ''} ${data.spouse_last_name} ${data.spouse_extension_name || ''}</li>
                                                                    <li><strong>Spouse's Mononym:</strong> ${data.spouse_mononym ? 'Yes' : 'No'}</li>
                                                                    <li><strong>Date of Birth:</strong> ${data.date_of_birth ? new Date(data.date_of_birth).toLocaleDateString('en-US') : ''}</li>
                                                                    <li><strong>Place of Birth:</strong> ${data.place_of_birth || ''}</li>
                                                                    <li><strong>Sex:</strong> ${data.sex || ''}</li>
                                                                    <li><strong>Civil Status:</strong> ${data.civil_status || ''}</li>
                                                                    <li><strong>Citizenship:</strong> ${data.citizenship || ''}</li>
                                                                    <li><strong>PhilSys ID:</strong> ${data.philsys_id || ''}</li>
                                                                    <li><strong>Taxpayer ID:</strong> ${data.tax_payer_id || ''}</li>
                                                                    
                                                                    <!-- Contact and Address Information -->
                                                                    <div class="card-header text-white" style="
                                                                        background: linear-gradient(135deg, rgb(7,118,33), rgb(181,202,179));
                                                                        border-bottom: none;
                                                                        padding: 1rem;
                                                                        border-radius: 20px 20px 0 0;
                                                                      ">
                                                                      <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Contact &amp; Address Information</h5>
                                                                    </div>
                                                                    <li><strong>Address:</strong> ${data.address || ''}</li>
                                                                    <li><strong>Contact Number:</strong> ${data.contact_number || ''}</li>
                                                                    <li><strong>Home Phone Number:</strong> ${data.home_phone_number || ''}</li>
                                                                    <li><strong>Business Direct Line:</strong> ${data.business_direct_line || ''}</li>
                                                                    <li><strong>Email Address:</strong> ${data.email_address || ''}</li>
                                                                    <li><strong>Mailing Address:</strong> ${data.mailing_address || ''}</li>
                                                                    
                                                                    <!-- Dependent Details -->
                                                                    <div class="card-header text-white" style="
                                                                        background: linear-gradient(135deg, rgb(7,118,33), rgb(181,202,179));
                                                                        border-bottom: none;
                                                                        padding: 1rem;
                                                                        border-radius: 20px 20px 0 0;
                                                                      ">
                                                                      <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Dependent Details</h5>
                                                                    </div>
                                                                    ${data.dependents && data.dependents.length > 0 ? data.dependents.map(dependent => `
                                                                      <ul>
                                                                        <li><strong>Dependent Name:</strong> ${dependent.dependent_first_name} ${dependent.dependent_middle_name || ''} ${dependent.dependent_last_name} ${dependent.dependent_extension_name || ''}</li>
                                                                        <li><strong>Relationship:</strong> ${dependent.dependent_relationship || ''}</li>
                                                                        <li><strong>Date of Birth:</strong> ${dependent.dependent_date_of_birth ? new Date(dependent.dependent_date_of_birth).toLocaleDateString('en-US') : ''}</li>
                                                                        <li><strong>Mononym:</strong> ${dependent.dependent_mononym ? 'Yes' : 'No'}</li>
                                                                        <li><strong>Permanent Disability:</strong> ${dependent.permanent_disability ? 'Yes' : 'No'}</li>
                                                                        <li><strong>Attachment Type 2:</strong> ${dependent.attachment_type_2 || ''}</li>
                                                                        <li><strong>Admission Date:</strong> ${dependent.admission_date_2 ? new Date(dependent.admission_date_2).toLocaleDateString('en-US') : ''}</li>
                                                                        <li><strong>Discharge Date:</strong> ${dependent.discharge_date_2 ? new Date(dependent.discharge_date_2).toLocaleDateString('en-US') : ''}</li>
                                                                        <li><strong>Status:</strong> ${dependent.status_2 || ''}</li>
                                                                        <li><strong>Reason/Purpose:</strong> ${dependent.reason_or_purpose2 || ''}</li>
                                                                      </ul>
                                                                      <hr style="border-top: 1px solid #000; margin: 1rem 0;">
                                                                    `).join('') : '<p>No dependents found.</p>'}
                                                                  </ul>
                                                                `;
                                                              }


                                                              // Function to render the edit form for patient and dependents
// Function to render the edit form for patient and dependents
function renderPatientEditForm(data) {
  return `
    <form id="editPatientForm">
      
      <!-- Patient Details Edit Section -->
      <fieldset class="border p-3 mb-3">
        <legend class="w-auto px-2" style="font-size:1.5rem; font-weight:600;">Form Details</legend>
        
        <div class="mb-3">
          <label for="health_record_id" class="form-label">Health Record ID</label>
          <input type="text" class="form-control" id="health_record_id" name="health_record_id" value="${data.health_record_id || ''}" readonly>
        </div>
        
        <div class="mb-3">
          <label for="philhealth_id" class="form-label">PhilHealth ID</label>
          <input type="text" class="form-control" id="philhealth_id" name="philhealth_id" placeholder="Enter PhilHealth ID" value="${data.philhealth_id || ''}">
        </div>
        
        <div class="mb-3">
          <label for="purpose" class="form-label">Purpose</label>
          <select class="form-select" id="purpose" name="purpose">
            <option value="Registration" ${data.purpose === 'Registration' ? 'selected' : ''}>Registration</option>
            <option value="Updating/Amendment" ${data.purpose === 'Updating/Amendment' ? 'selected' : ''}>Updating/Amendment</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="provider_konsulta" class="form-label">Provider Konsulta</label>
          <input type="text" class="form-control" id="provider_konsulta" name="provider_konsulta" placeholder="Enter Provider Konsulta" value="${data.provider_konsulta || ''}">
        </div>
        
        <div class="mb-3">
          <label for="admission_date" class="form-label">Admission Date</label>
          <input type="date" class="form-control" id="admission_date" name="admission_date" value="${data.admission_date ? new Date(data.admission_date).toISOString().split('T')[0] : ''}">
        </div>
        
        <div class="mb-3">
          <label for="discharge_date" class="form-label">Discharge Date</label>
          <input type="date" class="form-control" id="discharge_date" name="discharge_date" value="${data.discharge_date ? new Date(data.discharge_date).toISOString().split('T')[0] : ''}">
        </div>
        
        <div class="mb-3">
          <label for="reason_or_purpose" class="form-label">Reason/Purpose</label>
          <input type="text" class="form-control" id="reason_or_purpose" name="reason_or_purpose" placeholder="Enter Reason or Purpose" value="${data.reason_or_purpose || ''}">
        </div>
        
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <input type="text" class="form-control" id="status" name="status" placeholder="Enter Status" value="${data.status || ''}">
        </div>
        
        <div class="mb-3">
          <label for="attachment_type_1" class="form-label">Attachment Type 1</label>
          <input type="text" class="form-control" id="attachment_type_1" name="attachment_type_1" placeholder="Enter Attachment Type 1" value="${data.attachment_type_1 || ''}">
        </div>
        
        <div class="mb-3">
          <label for="attachment_type_2" class="form-label">Attachment Type 2</label>
          <input type="text" class="form-control" id="attachment_type_2" name="attachment_type_2" placeholder="Enter Attachment Type 2" value="${data.attachment_type_2 || ''}">
        </div>
      </fieldset>

      <!-- Personal Information Edit Section -->
      <fieldset class="border p-3 mb-3">
        <legend class="w-auto px-2" style="font-size:1.5rem; font-weight:600;">Personal Information</legend>
        
        <div class="mb-3">
          <label for="member_first_name" class="form-label">Member First Name</label>
          <input type="text" class="form-control" id="member_first_name" name="member_first_name" placeholder="Enter Member First Name" value="${data.member_first_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="member_middle_name" class="form-label">Member Middle Name</label>
          <input type="text" class="form-control" id="member_middle_name" name="member_middle_name" placeholder="Enter Member Middle Name" value="${data.member_middle_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="member_last_name" class="form-label">Member Last Name</label>
          <input type="text" class="form-control" id="member_last_name" name="member_last_name" placeholder="Enter Member Last Name" value="${data.member_last_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="member_extension_name" class="form-label">Member Extension Name</label>
          <input type="text" class="form-control" id="member_extension_name" name="member_extension_name" placeholder="Enter Member Extension Name" value="${data.member_extension_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="member_mononym" class="form-label">Member Mononym</label>
          <select class="form-select" id="member_mononym" name="member_mononym">
            <option value="1" ${data.member_mononym ? 'selected' : ''}>Yes</option>
            <option value="0" ${!data.member_mononym ? 'selected' : ''}>No</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="mother_first_name" class="form-label">Mother's First Name</label>
          <input type="text" class="form-control" id="mother_first_name" name="mother_first_name" placeholder="Enter Mother's First Name" value="${data.mother_first_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="mother_middle_name" class="form-label">Mother's Middle Name</label>
          <input type="text" class="form-control" id="mother_middle_name" name="mother_middle_name" placeholder="Enter Mother's Middle Name" value="${data.mother_middle_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="mother_last_name" class="form-label">Mother's Last Name</label>
          <input type="text" class="form-control" id="mother_last_name" name="mother_last_name" placeholder="Enter Mother's Last Name" value="${data.mother_last_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="mother_extension_name" class="form-label">Mother's Extension Name</label>
          <input type="text" class="form-control" id="mother_extension_name" name="mother_extension_name" placeholder="Enter Mother's Extension Name" value="${data.mother_extension_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="mother_mononym" class="form-label">Mother's Mononym</label>
          <select class="form-select" id="mother_mononym" name="mother_mononym">
            <option value="1" ${data.mother_mononym ? 'selected' : ''}>Yes</option>
            <option value="0" ${!data.mother_mononym ? 'selected' : ''}>No</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="spouse_first_name" class="form-label">Spouse's First Name</label>
          <input type="text" class="form-control" id="spouse_first_name" name="spouse_first_name" placeholder="Enter Spouse's First Name" value="${data.spouse_first_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="spouse_middle_name" class="form-label">Spouse's Middle Name</label>
          <input type="text" class="form-control" id="spouse_middle_name" name="spouse_middle_name" placeholder="Enter Spouse's Middle Name" value="${data.spouse_middle_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="spouse_last_name" class="form-label">Spouse's Last Name</label>
          <input type="text" class="form-control" id="spouse_last_name" name="spouse_last_name" placeholder="Enter Spouse's Last Name" value="${data.spouse_last_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="spouse_extension_name" class="form-label">Spouse's Extension Name</label>
          <input type="text" class="form-control" id="spouse_extension_name" name="spouse_extension_name" placeholder="Enter Spouse's Extension Name" value="${data.spouse_extension_name || ''}">
        </div>
        
        <div class="mb-3">
          <label for="spouse_mononym" class="form-label">Spouse's Mononym</label>
          <select class="form-select" id="spouse_mononym" name="spouse_mononym">
            <option value="1" ${data.spouse_mononym ? 'selected' : ''}>Yes</option>
            <option value="0" ${!data.spouse_mononym ? 'selected' : ''}>No</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="date_of_birth" class="form-label">Date of Birth</label>
          <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="${data.date_of_birth ? new Date(data.date_of_birth).toISOString().split('T')[0] : ''}">
        </div>
        
        <div class="mb-3">
          <label for="place_of_birth" class="form-label">Place of Birth</label>
          <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" placeholder="Enter Place of Birth" value="${data.place_of_birth || ''}">
        </div>
        
        <div class="mb-3">
          <label for="sex" class="form-label">Sex</label>
          <select class="form-select" id="sex" name="sex">
            <option value="Male" ${data.sex === 'Male' ? 'selected' : ''}>Male</option>
            <option value="Female" ${data.sex === 'Female' ? 'selected' : ''}>Female</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="civil_status" class="form-label">Civil Status</label>
          <select class="form-select" id="civil_status" name="civil_status">
            <option value="Single" ${data.civil_status === 'Single' ? 'selected' : ''}>Single</option>
            <option value="Married" ${data.civil_status === 'Married' ? 'selected' : ''}>Married</option>
            <option value="Annulled" ${data.civil_status === 'Annulled' ? 'selected' : ''}>Annulled</option>
            <option value="Widower" ${data.civil_status === 'Widower' ? 'selected' : ''}>Widower</option>
            <option value="Legally Separated" ${data.civil_status === 'Legally Separated' ? 'selected' : ''}>Legally Separated</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="citizenship" class="form-label">Citizenship</label>
          <select class="form-select" id="citizenship" name="citizenship">
            <option value="Filipino" ${data.citizenship === 'Filipino' ? 'selected' : ''}>Filipino</option>
            <option value="Foreign National" ${data.citizenship === 'Foreign National' ? 'selected' : ''}>Foreign National</option>
            <option value="Dual Citizen" ${data.citizenship === 'Dual Citizen' ? 'selected' : ''}>Dual Citizen</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="philsys_id" class="form-label">PhilSys ID</label>
          <input type="text" class="form-control" id="philsys_id" name="philsys_id" placeholder="Enter PhilSys ID" value="${data.philsys_id || ''}">
        </div>
        
        <div class="mb-3">
          <label for="tax_payer_id" class="form-label">Taxpayer ID</label>
          <input type="text" class="form-control" id="tax_payer_id" name="tax_payer_id" placeholder="Enter Taxpayer ID" value="${data.tax_payer_id || ''}">
        </div>
      </fieldset>

      <!-- Contact and Address Information Edit Section -->
      <fieldset class="border p-3 mb-3">
        <legend class="w-auto px-2" style="font-size:1.5rem; font-weight:600;">Contact &amp; Address Information</legend>
        
        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter Address">${data.address || ''}</textarea>
        </div>
        
        <div class="mb-3">
          <label for="contact_number" class="form-label">Contact Number</label>
          <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number" value="${data.contact_number || ''}">
        </div>
        
        <div class="mb-3">
          <label for="home_phone_number" class="form-label">Home Phone Number</label>
          <input type="text" class="form-control" id="home_phone_number" name="home_phone_number" placeholder="Enter Home Phone Number" value="${data.home_phone_number || ''}">
        </div>
        
        <div class="mb-3">
          <label for="business_direct_line" class="form-label">Business Direct Line</label>
          <input type="text" class="form-control" id="business_direct_line" name="business_direct_line" placeholder="Enter Business Direct Line" value="${data.business_direct_line || ''}">
        </div>
        
        <div class="mb-3">
          <label for="email_address" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Enter Email Address" value="${data.email_address || ''}">
        </div>
        
        <div class="mb-3">
          <label for="mailing_address" class="form-label">Mailing Address</label>
          <textarea class="form-control" id="mailing_address" name="mailing_address" rows="2" placeholder="Enter Mailing Address">${data.mailing_address || ''}</textarea>
        </div>
      </fieldset>

      <!-- Dependent Details Edit Section -->
      <fieldset class="border p-3 mb-3">
        <legend class="w-auto px-2" style="font-size:1.5rem; font-weight:600;">Dependent Details</legend>
        ${data.dependents && data.dependents.length > 0 ? data.dependents.map((dependent, index) => `
          <div class="dependent-edit mb-3" data-index="${index}">
            <!-- Hidden field for the dependent ID -->
            <input type="hidden" name="dependents[${index}][dependent_hospital_id]" value="${dependent.dependent_hospital_id || ''}">
            <div class="card mb-2">
              <div class="card-header" style="background: linear-gradient(135deg, rgb(7,118,33), rgb(181,202,179)); color: white;">
                Dependent ${index + 1} Details
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="dependent_first_name_${index}" class="form-label">Dependent First Name</label>
                  <input type="text" class="form-control" id="dependent_first_name_${index}" name="dependents[${index}][dependent_first_name]" placeholder="Enter Dependent First Name" value="${dependent.dependent_first_name || ''}">
                </div>
                <div class="mb-3">
                  <label for="dependent_middle_name_${index}" class="form-label">Dependent Middle Name</label>
                  <input type="text" class="form-control" id="dependent_middle_name_${index}" name="dependents[${index}][dependent_middle_name]" placeholder="Enter Dependent Middle Name" value="${dependent.dependent_middle_name || ''}">
                </div>
                <div class="mb-3">
                  <label for="dependent_last_name_${index}" class="form-label">Dependent Last Name</label>
                  <input type="text" class="form-control" id="dependent_last_name_${index}" name="dependents[${index}][dependent_last_name]" placeholder="Enter Dependent Last Name" value="${dependent.dependent_last_name || ''}">
                </div>
                <div class="mb-3">
                  <label for="dependent_extension_name_${index}" class="form-label">Dependent Extension Name</label>
                  <input type="text" class="form-control" id="dependent_extension_name_${index}" name="dependents[${index}][dependent_extension_name]" placeholder="Enter Dependent Extension Name" value="${dependent.dependent_extension_name || ''}">
                </div>
                <div class="mb-3">
                  <label for="dependent_relationship_${index}" class="form-label">Relationship</label>
                  <input type="text" class="form-control" id="dependent_relationship_${index}" name="dependents[${index}][dependent_relationship]" placeholder="Enter Relationship" value="${dependent.dependent_relationship || ''}">
                </div>
                <div class="mb-3">
                  <label for="dependent_date_of_birth_${index}" class="form-label">Dependent Date of Birth</label>
                  <input type="date" class="form-control" id="dependent_date_of_birth_${index}" name="dependents[${index}][dependent_date_of_birth]" value="${dependent.dependent_date_of_birth ? new Date(dependent.dependent_date_of_birth).toISOString().split('T')[0] : ''}">
                </div>
                <div class="mb-3">
                  <label for="dependent_mononym_${index}" class="form-label">Dependent Mononym</label>
                  <select class="form-select" id="dependent_mononym_${index}" name="dependents[${index}][dependent_mononym]">
                    <option value="1" ${dependent.dependent_mononym ? 'selected' : ''}>Yes</option>
                    <option value="0" ${!dependent.dependent_mononym ? 'selected' : ''}>No</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="permanent_disability_${index}" class="form-label">Permanent Disability</label>
                  <select class="form-select" id="permanent_disability_${index}" name="dependents[${index}][permanent_disability]">
                    <option value="1" ${dependent.permanent_disability ? 'selected' : ''}>Yes</option>
                    <option value="0" ${!dependent.permanent_disability ? 'selected' : ''}>No</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="attachment_type_2_${index}" class="form-label">Attachment Type 2</label>
                  <input type="text" class="form-control" id="attachment_type_2_${index}" name="dependents[${index}][attachment_type_2]" placeholder="Enter Attachment Type 2" value="${dependent.attachment_type_2 || ''}">
                </div>
                <div class="mb-3">
                  <label for="admission_date_2_${index}" class="form-label">Admission Date</label>
                  <input type="date" class="form-control" id="admission_date_2_${index}" name="dependents[${index}][admission_date_2]" value="${dependent.admission_date_2 ? new Date(dependent.admission_date_2).toISOString().split('T')[0] : ''}">
                </div>
                <div class="mb-3">
                  <label for="discharge_date_2_${index}" class="form-label">Discharge Date</label>
                  <input type="date" class="form-control" id="discharge_date_2_${index}" name="dependents[${index}][discharge_date_2]" value="${dependent.discharge_date_2 ? new Date(dependent.discharge_date_2).toISOString().split('T')[0] : ''}">
                </div>
                <div class="mb-3">
                  <label for="status_2_${index}" class="form-label">Status</label>
                  <input type="text" class="form-control" id="status_2_${index}" name="dependents[${index}][status_2]" placeholder="Enter Status" value="${dependent.status_2 || ''}">
                </div>
                <div class="mb-3">
                  <label for="reason_or_purpose2_${index}" class="form-label">Reason/Purpose</label>
                  <input type="text" class="form-control" id="reason_or_purpose2_${index}" name="dependents[${index}][reason_or_purpose2]" placeholder="Enter Reason/Purpose" value="${dependent.reason_or_purpose2 || ''}">
                </div>
              </div>
            </div>
          </div>
        `).join('') : '<p>No dependents found.</p>'}
      </fieldset>

      <div class="text-end">
        <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancel</button>
        <button type="submit" class="btn btn-primary" id="saveEditBtn">Save</button>
      </div>
    </form>
  `;
}


                                                              // When the view modal is shown, load the patient details (using your existing AJAX GET endpoint)
                                                              $('#patientModal').on('show.bs.modal', function (event) {
                                                                var button = $(event.relatedTarget);
                                                                var patientId = button.data('patient-id');
                                                                $.ajax({
                                                                  url: '{{ route("admin.view_details", ":patientId") }}'.replace(':patientId', patientId),
                                                                  method: 'GET',
                                                                  success: function(response) {
                                                                    patientData = response;
                                                                    $('#patientDetailsContent').html(renderPatientView(response));
                                                                  },
                                                                  error: function() {
                                                                    $('#patientDetailsContent').html('<p>Error fetching patient details. Please try again later.</p>');
                                                                  }
                                                                });
                                                              });

                                                              // Open the Edit modal when the Edit button in the view modal is clicked
                                                              $('#openEditModalBtn').on('click', function() {
                                                                if (patientData) {
                                                                  $('#editPatientContent').html(renderPatientEditForm(patientData));
                                                                  // Hide the view modal and show the edit modal
                                                                  var patientModalEl = document.getElementById('patientModal');
                                                                  var patientModal = bootstrap.Modal.getInstance(patientModalEl);
                                                                  patientModal.hide();
                                                                  var editModal = new bootstrap.Modal(document.getElementById('editPatientModal'));
                                                                  editModal.show();
                                                                }
                                                              });

                                                              // Handle cancel button in edit mode: hide the edit modal and reopen the view modal
                                                              $(document).on('click', '#cancelEditBtn', function() {
                                                                var editModalEl = document.getElementById('editPatientModal');
                                                                var editModal = bootstrap.Modal.getInstance(editModalEl);
                                                                editModal.hide();
                                                                // Reopen the view modal
                                                                var viewModal = new bootstrap.Modal(document.getElementById('patientModal'));
                                                                viewModal.show();
                                                              });

                                                              // Handle the edit form submission
                                                              $(document).on('submit', '#editPatientForm', function(e) {
                                                                e.preventDefault();
                                                                var formData = $(this).serialize();
                                                                $.ajax({
                                                                  url: '{{ route("admin.update_details", ":patientId") }}'.replace(':patientId', patientData.health_record_id),
                                                                  method: 'POST', // Use POST as defined in the route; adjust if you use PUT/PATCH
                                                                  data: formData,
                                                                  success: function(updatedData) {
                                                                    patientData = updatedData;
                                                                    // Hide the edit modal and refresh the view modal with updated data
                                                                    var editModalEl = document.getElementById('editPatientModal');
                                                                    var editModal = bootstrap.Modal.getInstance(editModalEl);
                                                                    editModal.hide();
                                                                    $('#patientDetailsContent').html(renderPatientView(updatedData));
                                                                    var viewModal = new bootstrap.Modal(document.getElementById('patientModal'));
                                                                    viewModal.show();
                                                                  },
                                                                  error: function() {
                                                                    alert('Failed to update patient details.');
                                                                  }
                                                                });
                                                              });
                                                            </script>


                                                          <!-- Delete User -->
                                                          <form action="{{ route('patients.delete', $patient->health_record_id) }}" method="POST" onsubmit="return confirmDeletion(event);">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button type="submit" class="text-danger" title="Delete Patient">
                                                                  <i class="lni lni-trash-can"></i>
                                                              </button>
                                                          </form>

                                                          <script>
                                                              function confirmDeletion(event) {
                                                                  // Show a prompt asking the user to type CONFIRM
                                                                  const userInput = prompt("To confirm deletion, please type 'CONFIRM':");

                                                                  // Check if the user typed CONFIRM (case-sensitive)
                                                                  if (userInput === "CONFIRM") {
                                                                      return true; // Allow form submission
                                                                  }

                                                                  // Prevent form submission if the input is incorrect
                                                                  alert("Deletion canceled. You must type 'CONFIRM' to delete the patient.");
                                                                  event.preventDefault();
                                                                  return false;
                                                              }
                                                          </script>
                                                      </div>
                                                  </td>
                                                  <!-- Date of Expiry (60 days) -->
                                                  <td>
                                                      {{ optional($patient->discharge_date ?? $dependent->discharge_date_2)->addDays(61)->format('Y/m/d') ?? '' }}
                                                  </td>

                                                  <!-- Discharge for counting for 60 days -->
                                                  <td>
                                                      @php
                                                          $dischargeDate = $patient->discharge_date ?? $dependent->discharge_date_2;
                                                          $dischargeDays = (int) ($dischargeDate ? \Carbon\Carbon::parse($dischargeDate)->addDays(61)->diffInDays(now(), false) : 0);
                                                      @endphp
                                                      {{ max(0, $dischargeDays) }} days
                                                  </td>



                                                  <!-- Admitted -->
                                                  <td>{{ optional($dependent->admission_date_2)->format('Y/m/d') ?? optional($patient->admission_date)->format('Y/m/d') ?? '' }}</td>

                                                  <!-- Discharge -->
                                                  <td>
                                                  {{ optional($dependent->discharge_date_2)->format('Y/m/d') ?? optional($patient->discharge_date)->format('Y/m/d') ?? '' }}
                                                  </td>

                                                  <!-- MEMBER (Name of Member) -->
                                                  <td>
                                                      {{ strtoupper($patient->member_last_name) }},
                                                      {{ strtoupper($patient->member_first_name) }}
                                                      @if($patient->member_middle_name) {{ strtoupper($patient->member_middle_name) }} @endif
                                                      @if($patient->member_extension_name) {{ strtoupper($patient->member_extension_name) }} @endif
                                                  </td>

                                                  <!-- MEMBER - BIRTHDAY -->
                                                  <td>{{ optional($patient->date_of_birth)->format('Y/m/d') ?? '' }}</td>

                                                  <!-- DEPENDENT - PATIENT -->
                                                  <td>
                                                      {{ strtoupper($dependent->dependent_last_name) }},
                                                      {{ strtoupper($dependent->dependent_first_name) }}
                                                      @if ($dependent->dependent_middle_name) {{ strtoupper($dependent->dependent_middle_name) }} @endif
                                                      @if ($dependent->dependent_extension_name) {{ strtoupper($dependent->dependent_extension_name) }} @endif
                                                  </td>

                                                  <!-- DEPENDENT - BIRTHDAY -->
                                                  <td>{{ $dependent->dependent_date_of_birth ? \Carbon\Carbon::parse($dependent->dependent_date_of_birth)->format('Y/m/d') : '' }}</td>


                                                  <!-- PIN -->
                                                  <td>{{ $patient->pin }}</td>

                                                  <!-- ATTACHMENT (Member) -->
                                                  <td>
                                                      @if($patient->attachment_1)
                                                          <a href="{{ route('patients.download', ['id' => $patient->health_record_id, 'attachment' => 1]) }}">
                                                              {{ $patient->attachment_type_1 }}
                                                          </a>
                                                      @else
                                                          
                                                      @endif
                                                  </td>

                                                  <!-- ATTACHMENT (Dependent) -->
                                                  <td>
                                                      @if ($dependent->attachment_2)
                                                          <a href="{{ route('patients.download', ['id' => $patient->health_record_id, 'attachment' => 2]) }}">
                                                              {{ $dependent->attachment_type_2 }}
                                                          </a>
                                                      @else
                                                          
                                                      @endif
                                                  </td>

                                                  <!-- REASON / PURPOSE -->
                                                  <td>{{ $dependent->reason_or_purpose2 ?? $patient->reason_or_purpose ?? '' }}</td>

                                                  <!-- STATUS -->
                                                  <td style="
                                                    {{ $patient->status === 'Already Updated' ? 'background: linear-gradient(to right, #006400, rgb(125, 210, 159)); color: white; font-size: 20px;' : 
                                                      ($patient->status === 'For Update' ? 'background: linear-gradient(to right, #8B0000, rgb(224, 133, 133)); color: white; font-size: 20px;' : 
                                                      ($dependent->status_2 === 'Already Updated' ? 'background: linear-gradient(to right, #006400, rgb(125, 210, 159)); color: white; font-size: 20px;' : 
                                                      ($dependent->status_2 === 'For Update' ? 'background: linear-gradient(to right, #8B0000, rgb(224, 133, 133)); color: white; font-size: 20px;' : '')))
                                                    }}
                                                  ">
                                                    {{ $patient->status ?: $dependent->status_2 ?: '' }}

                                                  </td>

                                              </tr>
                                          @endforeach
                                      @endforeach
                                  </tbody>
                              </table>

                                  <!-- end table -->
                                </div>
                                  <!-- Add Patient -->
                                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal" style="margin-top: 20px;">
                                    Add Patient
                                  </button>
                                  <script>
                                    function toggleMiddleName(checkbox, inputId) {
                                      const input = document.getElementById(inputId);
                                      input.disabled = checkbox.checked;
                                      if (checkbox.checked) {
                                        input.value = "";
                                      }
                                    }
                                  </script>
                                  <div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="addPatientModal">Add Patient</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <form id="addPatientForm" action="{{ route('patients.store') }}" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                          @csrf
                                            <div class="card-header text-white" style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                  <div>
                                                    <!-- Icon and Title -->
                                                    <div class="d-flex align-items-center">
                                                      <span class="me-3" style="font-size: 1.75rem; color: #ffffff;">
                                                        <i class="fas fa-id-card"></i> <!-- Font Awesome icon for personal details -->
                                                      </span>
                                                      <h5 class="mb-0" style="font-size: 1.5rem; font-weight: 600; color: #ffffff; text-align:center;">
                                                        Form Details
                                                      </h5>
                                                    </div>
                                                    <!-- Subtle Description -->
                                                  </div>
                                                </div>
                                            </div>
                                            <!-- PhilHealth Identification Number -->
                                            <div class="mb-3">
                                              <label for="philhealth_id">PhilHealth Identification Number (PIN) <span style="color: red;">*</span></label>
                                              <input type="number" class="form-control" id="philhealth_id" name="philhealth_id" required>
                                              <div class="invalid-feedback">Please enter your PhilHealth PIN.</div>
                                            </div>

                                            <!-- Purpose -->
                                            <div class="mb-3">
                                              <label for="purpose">Purpose <span style="color: red;">*</span></label>
                                              <select id="purpose" name="purpose" class="form-control" required>
                                                <option value="" disabled selected>Please select</option>
                                                <option value="Registration">Registration</option>
                                                <option value="Updating/Amendment">Updating/Amendment</option>
                                              </select>
                                              <div class="invalid-feedback">This is requirede.</div>
                                            </div>
                                            

                                            <!-- Preferred KonSulta Provider -->
                                            <div class="mb-3">
                                              <label for="provider">Preferred KonSulta Provider</label>
                                              <input type="text" class="form-control" id="provider" name="provider">
                                            </div>
                                              <div class="card-header text-white" style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                  <div>
                                                    <!-- Icon and Title -->
                                                    <div class="d-flex align-items-center">
                                                      <span class="me-3" style="font-size: 1.75rem; color: #ffffff;">
                                                        <i class="fas fa-id-card"></i> <!-- Font Awesome icon for personal details -->
                                                      </span>
                                                      <h5 class="mb-0" style="font-size: 1.5rem; font-weight: 600; color: #ffffff;">
                                                        Personal Details
                                                      </h5>
                                                    </div>
                                                    <!-- Subtle Description -->
                                                    <p class="mb-0 mt-2" style="font-size: 0.9rem; color: #ffffff; opacity: 0.9;">
                                                      Provide your personal information, including full name and date of birth.
                                                    </p>
                                                  </div>
                                                </div>
                                            </div>

                                            <!-- Member Name -->
                                            <div class="mb-3">
                                              <label>Member Name <span style="color: red;">*</span></label>
                                              <div class="row">
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" name="member_first_name" placeholder="First Name" required>
                                                  <div class="invalid-feedback">Please enter your first name.</div>
                                                </div>
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" id="member_middle_name" name="member_middle_name" placeholder="Middle Name">
                                                </div>
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" name="member_last_name" placeholder="Last Name" required>
                                                  <div class="invalid-feedback">Please enter your last name.</div>
                                                </div>
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" name="member_name_extension" placeholder="Name Extension">
                                                </div>
                                              </div>
                                              <!-- No Middle Name Checkbox for Member Name -->
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="member_no_middle_name" onclick="toggleMiddleName(this, 'member_middle_name')">
                                                <label class="form-check-label" for="member_no_middle_name">No Middle Name</label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="member_mononym">
                                                <label class="form-check-label">Mononym</label>
                                              </div>
                                            </div>

                                            <!-- Mother's Maiden Name -->
                                            <div class="mb-3">
                                              <label>Mother's Maiden Name</label>
                                              <div class="row">
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" name="mother_first_name" placeholder="First Name">
                                                  <div class="invalid-feedback">Please enter your mother's first name.</div>
                                                </div>
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" id="mother_middle_name" name="mother_middle_name" placeholder="Middle Name">
                                                </div>
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" name="mother_last_name" placeholder="Last Name">
                                                  <div class="invalid-feedback">Please enter your mother's last name.</div>
                                                </div>
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" name="mother_name_extension" placeholder="Name Extension">
                                                </div>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="mother_no_middle_name" onclick="toggleMiddleName(this, 'mother_middle_name')">
                                                <label class="form-check-label" for="mother_no_middle_name">No Middle Name</label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="mother_mononym">
                                                <label class="form-check-label">Mononym</label>
                                              </div>
                                            </div>

                                            <!-- Spouse Name -->
                                            <div class="mb-3">
                                              <label>Spouse Name (if Married)</label>
                                              <div class="row">
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" name="spouse_first_name" placeholder="First Name">
                                                </div>
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" id="spouse_middle_name" name="spouse_middle_name" placeholder="Middle Name">
                                                </div>
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" name="spouse_last_name" placeholder="Last Name">
                                                </div>
                                                <div class="col-md-3">
                                                  <input type="text" class="form-control" name="spouse_name_extension" placeholder="Name Extension">
                                                </div>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="spouse_no_middle_name" onclick="toggleMiddleName(this, 'spouse_middle_name')">
                                                <label class="form-check-label" for="spouse_no_middle_name">No Middle Name</label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="spouse_mononym">
                                                <label class="form-check-label">Mononym</label>
                                              </div>
                                            </div>

                                            <!-- Date of Birth -->
                                            <div class="mb-3">
                                              <label>Date of Birth <span style="color: red;">*</span></label>
                                              <div class="row">
                                                <div class="col-md-2">
                                                  <input type="date" class="form-control" name="date_of_birth" style="min-width: 200px;"required>
                                                  <div class="invalid-feedback">Please enter the date of birth.</div>
                                                </div>
                                              </div>
                                            </div>

                                            <!-- Place of Birth -->
                                            <div class="mb-3">
                                              <label for="place_of_birth">Place of Birth <span style="color: red;">*</span></label>
                                              <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" required>
                                              <div class="invalid-feedback">Please enter the place of birth.</div>
                                            </div>
                                            
                                            <!-- Sex -->
                                            <div class="mb-3">
                                              <label for="sex">Sex <span style="color: red;">*</span></label>
                                              <select id="sex" name="sex" class="form-control" required>
                                                <option value="" disabled selected>Please select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                              </select>
                                              <div class="invalid-feedback">This is required.</div>
                                            </div>

                                            <!-- Civil Status -->
                                            <div class="mb-3">
                                              <label for="civil_status">Civil Status</label>
                                              <select id="civil_status" name="civil_status" class="form-control" required>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Annulled">Annulled</option>
                                                <option value="Widower">Widower</option>
                                                <option value="Legally Separated">Legally Separated</option>
                                              </select>
                                              <div class="invalid-feedback">Please select your civil status.</div>
                                            </div>

                                            <!-- Citizenship -->
                                            <div class="mb-3">
                                              <label for="citizenship">Citizenship</label>
                                              <select id="citizenship" name="citizenship" class="form-control" required>
                                                <option value="Filipino">Filipino</option>
                                                <option value="Foreign National">Foreign National</option>
                                                <option value="Dual Citizen">Dual Citizen</option>
                                              </select>
                                              <div class="invalid-feedback">Please select your citizenship.</div>
                                            </div>

                                            <!-- Philsys ID Number -->
                                            <div class="mb-3">
                                              <label for="philsys_id">Philsys ID Number (Optional)</label>
                                              <input type="text" class="form-control" id="philsys_id" name="philsys_id">
                                            </div>

                                            <!-- Tax Payer Identification Number -->
                                            <div class="mb-3">
                                              <label for="taxpayer_id">Tax Payer Identification Number (Optional)</label>
                                              <input type="text" class="form-control" id="taxpayer_id" name="taxpayer_id">
                                            </div>

                                            <div class="card-header text-white" style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                  <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                      <!-- Icon and Title -->
                                                      <div class="d-flex align-items-center">
                                                        <span class="me-3" style="font-size: 1.75rem; color: #ffffff;">
                                                          <i class="fas fa-users"></i> <!-- Font Awesome icon for dependents -->
                                                        </span>
                                                        <h5 class="mb-0" style="font-size: 1.5rem; font-weight: 600; color: #ffffff;">
                                                            Address and Contact Information
                                                        </h5>
                                                      </div>
                                                      <!-- Subtle Description -->
                                                      <p class="mb-0 mt-2" style="font-size: 0.9rem; color: #ffffff; opacity: 0.9;">
                                                        Provide accurate address and contact details for communication.
                                                      </p>
                                                    </div>
                                                  </div>
                                                </div>

                                            <!-- Address and Contact Details -->
                                            <div class="mb-3">
                                              <label for="address">Address <span style="color: red;">*</span></label>
                                              <input type="text" class="form-control" id="address" name="address" required>
                                              <div class="invalid-feedback">Please enter your address.</div>
                                            </div>

                                            <div class="mb-3">
                                              <label for="contact_number">Contact Number (Optional)</label>
                                              <input type="text" class="form-control" id="contact_number" name="contact_number" pattern="\d{10,11}">
                                              <div class="invalid-feedback">Please enter a valid contact number (10-11 digits).</div>
                                            </div>

                                            <div class="mb-3">
                                              <label for="home_phone">Home Phone Number (Optional)</label>
                                              <input type="text" class="form-control" id="home_phone" name="home_phone" pattern="\d{7,11}">
                                              <div class="invalid-feedback">Please enter a valid home phone number (7-11 digits).</div>
                                            </div>

                                            <div class="mb-3">
                                              <label for="business_phone">Business (Direct Line) (Optional)</label>
                                              <input type="text" class="form-control" id="business_phone" name="business_phone" pattern="\d{7,11}">
                                              <div class="invalid-feedback">Please enter a valid business phone number (7-11 digits).</div>
                                            </div>

                                            <div class="mb-3">
                                              <label for="email_address">Email Address</label>
                                              <input type="email" class="form-control" id="email_address" name="email_address">
                                            </div>

                                            <div class="mb-3">
                                              <label for="mailing_address">Mailing Address</label>
                                              <div>
                                                <input type="checkbox" id="same_as_above" name="same_as_above" value="yes">
                                                <label for="same_as_above">Same as Above</label>
                                                <input type="text" class="form-control" id="mailing_address" name="mailing_address">
                                              </div>
                                            </div>
                                            <div class="card-header text-white" style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                  <div>
                                                    <!-- Icon and Title -->
                                                    <div class="d-flex align-items-center">
                                                      <span class="me-3" style="font-size: 1.75rem; color: #ffffff;">
                                                        <i class="fas fa-notes-medical"></i> <!-- Font Awesome icon for medical notes -->
                                                      </span>
                                                      <h5 class="mb-0" style="font-size: 1.5rem; font-weight: 600; color: #ffffff;">
                                                        Member as Patient
                                                      </h5>
                                                    </div>
                                                    <!-- Subtle Description -->
                                                    <p class="mb-0 mt-2" style="font-size: 0.9rem; color: #ffffff; opacity: 0.9;">
                                                      If the dependent is the patient, kindly skip this part.
                                                    </p>
                                                  </div>
                                                </div>
                                            </div>

                                            <!-- Admission and Discharge Dates -->
                                            <div class="mb-3" style="max-width: 200px;">
                                              <label>Admission Date <span style="color: red;">*</span></label>
                                              <input type="date" class="form-control" name="admission_date" required>
                                              <div class="invalid-feedback">Please enter the admission date.</div>
                                            </div>

                                            <div class="mb-3" style="max-width: 200px;">
                                              <label>Discharge Date <span style="color: red;">*</span></label>
                                              <input type="date" class="form-control" name="discharge_date" required>
                                              <div class="invalid-feedback">Please enter the discharge date.</div>
                                            </div>

                                            <!-- Attachment Type 1 -->
                                            <div class="mb-3">
                                                <label for="attachment_type_1">Type of Attachment (Member) <span style="color: red;">*</span></label>
                                                <select id="attachment_type_1" name="attachment_type_1" class="form-control" required onchange="validateSelection()">
                                                    <option value="" disabled selected>Please select a type</option>
                                                    <option value="Dependent Birth Cert.">Dependent Birth Cert.</option>
                                                    <option value="Member Birth Cert.">Member Birth Cert.</option>
                                                    <option value="Marriage Cert.">Marriage Cert.</option>
                                                    <option value="Postal ID">Postal ID</option>
                                                    <option value="Senior ID">Senior ID</option>
                                                    <option value="Voter's ID">Voter's ID</option>
                                                    <option value="National ID">National ID</option>
                                                    <option value="Voter's Cert.">Voter's Cert.</option>
                                                    <option value="Baptismal Cert.">Baptismal Cert.</option>
                                                    <option value="TIN ID">TIN ID</option>
                                                    <option value="PWD ID">PWD ID</option>
                                                    <option value="SSS ID">SSS ID</option>
                                                    <option value="UMID">UMID</option>
                                                    <option value="Barangay Cert.">Barangay Cert.</option>
                                                    <option value="PMRF">PMRF</option>
                                                    <option value="Driver's License">Driver's License</option>
                                                    <option value="Passport">Passport</option>
                                                    <option value="Affidavit">Affidavit</option>
                                                </select>
                                                <div class="invalid-feedback">Please select an attachment type.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="attachment_1" class="form-label">
                                                    <p>Attachment <span style="color: red;">*</span></p>
                                                </label>
                                                <input 
                                                    type="file" 
                                                    class="form-control" 
                                                    id="attachment_1" 
                                                    name="attachment_1" 
                                                    accept="image/*" 
                                                    required
                                                    disabled
                                                />
                                                <div class="invalid-feedback">Attachment is Required / File size must not exceed 10MB.</div>
                                            </div>

                                            <script>
                                              function validateSelection() {
                                                  const selectElement = document.getElementById("attachment_type_1");
                                                  const attachmentField = document.getElementById("attachment_1");

                                                  if (selectElement.value !== "") {
                                                      attachmentField.disabled = false; // Enable attachment field
                                                  } else {
                                                      attachmentField.disabled = true; // Keep attachment disabled if no selection
                                                      attachmentField.value = ""; // Clear the file input if disabled
                                                  }
                                              }

                                              function validateSelection2() {
                                                  const selectElement2 = document.getElementById("attachment_type_2");
                                                  const attachmentField2 = document.getElementById("attachment_1");

                                                  if (selectElement2.value !== "") {
                                                      attachmentField2.disabled = false; // Enable attachment field
                                                  } else {
                                                      attachmentField2.disabled = true; // Keep attachment disabled if no selection
                                                      attachmentField2.value = ""; // Clear the file input if disabled
                                                  }
                                              }
                                              </script>
                                              <!-- Reason/Purpose -->
                                              <div class="mb-3">
                                                <label for="reason_or_purpose">Reason/Purpose <span style="color: red;">*</span></label>
                                                <select id="reason_or_purpose" name="reason_or_purpose" class="form-control" required>
                                                  <option value="" disabled selected>Please select a reason</option>
                                                  <option value="Undeclared Dep. Child">Undeclared Dep. Child</option>
                                                  <option value="Undeclared Dep. Spouse">Undeclared Dep. Spouse</option>
                                                  <option value="Mispelled Last name">Mispelled Last name</option>
                                                  <option value="Indigent to POS">Indigent to POS</option>
                                                  <option value="Mispelled First name">Mispelled First name</option>
                                                  <option value="Mispelled Middle name">Mispelled Middle name</option>
                                                  <option value="NO PIN">NO PIN</option>
                                                  <option value="4P'S Renewal">4P'S Renewal</option>
                                                  <option value="Listahanan Renewal">Listahanan Renewal</option>
                                                  <option value="NHTS TO POS">NHTS TO POS</option>
                                                  <option value="NHTS 2024">NHTS 2024</option>
                                                  <option value="NHTS TO SENIOR">NHTS TO SENIOR</option>
                                                  <option value="UMID">UMID</option>
                                                  <option value="Senior Citizen">Senior Citizen</option>
                                                  <option value="Dual Pin">Dual Pin</option>
                                                  <option value="Incorrect date admission">Incorrect date admission</option>
                                                  <option value="Incorrect Birthdate">Incorrect Birthdate</option>
                                                  <option value="Member Category">Member Category</option>
                                                  <option value="FOR REGISTRATION">FOR REGISTRATION</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a reason/purpose.</div>
                                              </div>

                                              <!-- Status -->
                                              <div class="mb-3">
                                                <label for="status">Status<span style="color: red;">*</span></label>
                                                <select id="status" name="status" class="form-control" required>
                                                  <option value="" disabled selected>Please select a status</option>
                                                  <option value="For Update">For Update</option>
                                                  <option value="Already Updated">Already Updated</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a status.</div>
                                              </div>


                                            <!-- Declaration of Dependents Section -->
                                            <div class="mb-3">
                                                <div class="card-header text-white" style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                  <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                      <!-- Icon and Title -->
                                                      <div class="d-flex align-items-center">
                                                        <span class="me-3" style="font-size: 1.75rem; color: #ffffff;">
                                                          <i class="fas fa-users"></i> <!-- Font Awesome icon for dependents -->
                                                        </span>
                                                        <h5 class="mb-0" style="font-size: 1.5rem; font-weight: 600; color: #ffffff;">
                                                          Declaration of Dependents
                                                        </h5>
                                                      </div>
                                                      <!-- Subtle Description -->
                                                      <p class="mb-0 mt-2" style="font-size: 0.9rem; color: #ffffff; opacity: 0.9;">
                                                        Add the details of your dependents here. You can add up to 4 dependents.
                                                      </p>
                                                    </div>
                                                    <!-- Add Dependent Button -->
                                                    <button type="button" class="btn btn-outline-success btn-sm" id="addDependentBtn"  style="font-weight: 500; background-color: green; color: #ffffff; ">
                                                      <i class="fas fa-plus me-1"></i> Add Dependent
                                                    </button>
                                                  </div>
                                                </div>
                                              <div class="dependent-header">
                                                <h5>Dependent 1: Please provide details</h5>
                                                <hr>
                                              </div>
                                              <!-- Wrapper for Dependent Fields -->
                                              <div id="dependents-wrapper">
                                                <!-- Initial Row (Dependent 1) -->
                                                <div class="dependent-entry mb-3">
                                                  <div class="row">
                                                    <!-- Status -->
                                                    <div class="mb-3">
                                                      <label for="status_2">Status<span style="color: red;">*</span></label>
                                                      <select id="status_2" name="status_2[]" class="form-control">
                                                        <option value="" disabled selected>Please select a status</option>
                                                        <option value="For Update">For Update</option>
                                                        <option value="Already Updated">Already Updated</option>
                                                      </select>
                                                      <div class="invalid-feedback">Please select a status.</div>
                                                    </div>
                                                    <!-- Admission and Discharge Dates -->
                                                    <div class="mb-3" style="max-width: 300px;">
                                                      <label>Admission Date <span style="color: red;">*</span></label>
                                                      <input type="date" class="form-control" name="admission_date_2[]" >
                                                      <div class="invalid-feedback">Please enter the admission date.</div>
                                                    </div>

                                                    <div class="mb-3" style="max-width: 300px;">
                                                      <label>Discharge Date <span style="color: red;">*</span></label>
                                                      <input type="date" class="form-control" name="discharge_date_2[]" >
                                                      <div class="invalid-feedback">Please enter the discharge date.</div>
                                                    </div>
                                                    <!-- Reason/Purpose -->
                                                    <div class="mb-3">
                                                      <label for="reason_or_purpose2">Reason/Purpose <span style="color: red;">*</span></label>
                                                      <select id="reason_or_purpose2" name="reason_or_purpose2[]" class="form-control" >
                                                        <option value="" disabled selected>Please select a reason</option>
                                                        <option value="Undeclared Dep. Child">Undeclared Dep. Child</option>
                                                        <option value="Undeclared Dep. Spouse">Undeclared Dep. Spouse</option>
                                                        <option value="Mispelled Last name">Mispelled Last name</option>
                                                        <option value="Indigent to POS">Indigent to POS</option>
                                                        <option value="Mispelled First name">Mispelled First name</option>
                                                        <option value="Mispelled Middle name">Mispelled Middle name</option>
                                                        <option value="NO PIN">NO PIN</option>
                                                        <option value="4P'S Renewal">4P'S Renewal</option>
                                                        <option value="Listahanan Renewal">Listahanan Renewal</option>
                                                        <option value="NHTS TO POS">NHTS TO POS</option>
                                                        <option value="NHTS 2024">NHTS 2024</option>
                                                        <option value="NHTS TO SENIOR">NHTS TO SENIOR</option>
                                                        <option value="UMID">UMID</option>
                                                        <option value="Senior Citizen">Senior Citizen</option>
                                                        <option value="Dual Pin">Dual Pin</option>
                                                        <option value="Incorrect date admission">Incorrect date admission</option>
                                                        <option value="Incorrect Birthdate">Incorrect Birthdate</option>
                                                        <option value="Member Category">Member Category</option>
                                                        <option value="FOR REGISTRATION">FOR REGISTRATION</option>
                                                      </select>
                                                      <div class="invalid-feedback">Please select a reason/purpose.</div>
                                                    </div>

                                                    <div class="col-md-3">
                                                      <label for="dependent_first_name_0">First Name <span style="color: red;">*</span></label>
                                                      <input type="text" class="form-control" id="dependent_first_name_0" name="dependent_first_name[]">
                                                      <div class="invalid-feedback">Please enter the dependent's first name.</div>
                                                    </div>
                                                    <div class="col-md-3">
                                                      <label for="dependent_middle_name_0">Middle Name</label>
                                                      <input type="text" class="form-control" id="dependent_middle_name_0" name="dependent_middle_name[]">
                                                    </div>
                                                    <div class="col-md-3">
                                                      <label for="dependent_last_name_0">Last Name <span style="color: red;">*</span></label>
                                                      <input type="text" class="form-control" id="dependent_last_name_0" name="dependent_last_name[]">
                                                      <div class="invalid-feedback">Please enter the dependent's last name.</div>
                                                    </div>
                                                    <div class="col-md-3">
                                                      <label for="dependent_name_extension_0">Name Extension</label>
                                                      <input type="text" class="form-control" id="dependent_name_extension_0" name="dependent_name_extension[]">
                                                    </div>
                                                  </div>

                                                  <div class="row">
                                                    <div class="mb-3">
                                                      <label for="dependent_citizenship_0">Citizenship <span style="color: red;">*</span></label>
                                                      <select id="dependent_citizenship_0" name="dependent_citizenship[]" class="form-control">
                                                        <option value="Filipino">Filipino</option>
                                                        <option value="Foreign National">Foreign National</option>
                                                        <option value="Dual Citizen">Dual Citizen</option>
                                                      </select>
                                                      <div class="invalid-feedback">Please select your citizenship.</div>
                                                    </div>
                                                    <div class="col-md-3">
                                                      <label for="dependent_relationship_0">Relationship <span style="color: red;">*</span></label>
                                                      <input type="text" class="form-control" id="dependent_relationship_0" name="dependent_relationship[]">
                                                      <div class="invalid-feedback">Please enter the dependent's relationship.</div>
                                                    </div>
                                                    <div class="col-md-3">
                                                      <label for="dependent_dob_0">Date of Birth <span style="color: red;">*</span></label>
                                                      <input type="date" class="form-control" id="dependent_dob_0" name="dependent_dob[]">
                                                      <div class="invalid-feedback">Please enter the dependent's date of birth.</div>
                                                    </div>
                                                  </div>

                                                  <div class="row">
                                                    <div class="col-md-3">
                                                      <label for="dependent_mononym_0">Mononym</label>
                                                      <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="dependent_mononym_0" name="dependent_mononym[]">
                                                        <label class="form-check-label" for="dependent_mononym_0" value="1">Yes</label>
                                                      </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                      <label for="dependent_no_middle_name_0">No Middle Name</label>
                                                      <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="dependent_no_middle_name_0" name="dependent_no_middle_name[]">
                                                        <label class="form-check-label" for="dependent_no_middle_name_0">Yes</label>
                                                      </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                      <label for="dependent_permanent_disability_0">Permanent Disability</label>
                                                      <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="dependent_permanent_disability_0" name="dependent_permanent_disability[]">
                                                        <label class="form-check-label" for="dependent_permanent_disability_0" value="1">Yes</label>
                                                      </div>
                                                    </div>
                                                    <!-- Attachment Type 2 -->
                                                    <div class="mb-3">
                                                        <label for="attachment_type_2">Type of Attachment (Dependent) <span style="color: red;">*</span></label>
                                                        <select id="attachment_type_2" name="attachment_type_2[]" class="form-control"  onchange="validateSelection()">
                                                            <option value="" disabled selected>Please select a type</option>
                                                            <option value="Dependent Birth Cert.">Dependent Birth Cert.</option>
                                                            <option value="Member Birth Cert.">Member Birth Cert.</option>
                                                            <option value="Marriage Cert.">Marriage Cert.</option>
                                                            <option value="Postal ID">Postal ID</option>
                                                            <option value="Senior ID">Senior ID</option>
                                                            <option value="Voter's ID">Voter's ID</option>
                                                            <option value="National ID">National ID</option>
                                                            <option value="Voter's Cert.">Voter's Cert.</option>
                                                            <option value="Baptismal Cert.">Baptismal Cert.</option>
                                                            <option value="TIN ID">TIN ID</option>
                                                            <option value="PWD ID">PWD ID</option>
                                                            <option value="SSS ID">SSS ID</option>
                                                            <option value="UMID">UMID</option>
                                                            <option value="Barangay Cert.">Barangay Cert.</option>
                                                            <option value="PMRF">PMRF</option>
                                                            <option value="Driver's License">Driver's License</option>
                                                            <option value="Passport">Passport</option>
                                                            <option value="Affidavit">Affidavit</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select an attachment type.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="attachment_2" class="form-label">
                                                            <p>Attachment <span style="color: red;">*</span></p>
                                                        </label>
                                                        <input 
                                                            type="file" 
                                                            class="form-control" 
                                                            id="attachment_2" 
                                                            name="attachment_2[]" 
                                                            accept="image/*" 
                                                            
                                                            
                                                        />
                                                        <div class="invalid-feedback">Attachment is Required / File size must not exceed 10MB.</div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </form>

                                          <script>
                                            // JavaScript for Form Validation
                                            (function () {
                                              'use strict';

                                              // Fetch the form and apply validation
                                              const form = document.querySelector('.needs-validation');

                                              form.addEventListener('submit', function (event) {
                                                if (!form.checkValidity()) {
                                                  event.preventDefault();
                                                  event.stopPropagation();
                                                }
                                                form.classList.add('was-validated');
                                              }, false);

                                              // File Size Validation
                                              function validateFileSize(input) {
                                                const maxSize = 10 * 1024 * 1024; // 10MB
                                                if (input.files[0] && input.files[0].size > maxSize) {
                                                  input.setCustomValidity('File size must not exceed 10MB.');
                                                  input.reportValidity();
                                                } else {
                                                  input.setCustomValidity('');
                                                }
                                              }

                                              // Toggle Middle Name Fields
                                              function toggleMiddleName(checkbox, fieldId) {
                                                const field = document.getElementById(fieldId);
                                                if (checkbox.checked) {
                                                  field.disabled = true;
                                                  field.value = '';
                                                } else {
                                                  field.disabled = false;
                                                }
                                              }

                                              // Add Dependent Row
                                              document.getElementById('addDependentBtn').addEventListener('click', function () {
                                                const dependentWrapper = document.getElementById('dependents-wrapper');
                                                const dependentEntries = document.querySelectorAll('.dependent-entry');

                                                if (dependentEntries.length < 4) {
                                                  const newDependentIndex = dependentEntries.length + 1;

                                                  const newDependentHeader = document.createElement('div');
                                                  newDependentHeader.classList.add('dependent-header');
                                                  newDependentHeader.innerHTML = `
                                                    <h5>Dependent ${newDependentIndex}: Please provide details</h5>
                                                    <hr>
                                                  `;

                                                  const newDependentRow = dependentEntries[0].cloneNode(true);

                                                  // Clear input fields
                                                  const inputs = newDependentRow.querySelectorAll('input');
                                                  inputs.forEach(input => {
                                                    input.value = '';
                                                    if (input.type === 'checkbox') {
                                                      input.checked = false;
                                                    }
                                                  });

                                                  // Update IDs and names
                                                  const labels = newDependentRow.querySelectorAll('label');
                                                  labels.forEach(label => {
                                                    const labelFor = label.getAttribute('for');
                                                    if (labelFor) {
                                                      label.setAttribute('for', labelFor.replace(/\d+/, newDependentIndex));
                                                    }
                                                  });

                                                  const inputsInRow = newDependentRow.querySelectorAll('input');
                                                  inputsInRow.forEach(input => {
                                                    const inputId = input.id;
                                                    const inputName = input.name;
                                                    if (inputId) {
                                                      input.id = inputId.replace(/\d+/, newDependentIndex);
                                                    }
                                                    if (inputName) {
                                                      input.name = inputName.replace(/\d+/, newDependentIndex);
                                                    }
                                                  });

                                                  // Add Remove Button
                                                  const removeButton = document.createElement('button');
                                                  removeButton.type = 'button';
                                                  removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-dependent-btn');
                                                  removeButton.textContent = 'Remove Dependent';
                                                  newDependentRow.appendChild(removeButton);

                                                  dependentWrapper.appendChild(newDependentHeader);
                                                  dependentWrapper.appendChild(newDependentRow);
                                                } else {
                                                  alert('You can only add up to 4 dependents.');
                                                }
                                              });

                                              // Remove Dependent Row
                                              document.addEventListener('click', function (event) {
                                                if (event.target.classList.contains('remove-dependent-btn')) {
                                                  const dependentEntry = event.target.closest('.dependent-entry');
                                                  const dependentHeader = dependentEntry.previousElementSibling;

                                                  if (dependentHeader && dependentHeader.classList.contains('dependent-header')) {
                                                    dependentHeader.remove();
                                                  }
                                                  dependentEntry.remove();
                                                }
                                              });

                                              document.getElementById('same_as_above').addEventListener('change', function() {
                                                const mailingAddressField = document.getElementById('mailing_address');
                                                if (this.checked) {
                                                  mailingAddressField.disabled = true;
                                                  mailingAddressField.value = ''; // Clear the content
                                                } else {
                                                  mailingAddressField.disabled = false;
                                                }
                                              });

                                              document.getElementById('member_no_middle_name').addEventListener('change', function() {
                                                const mailingAddressField = document.getElementById('member_middle_name');
                                                if (this.checked) {
                                                  mailingAddressField.disabled = true;
                                                  mailingAddressField.value = ''; // Clear the content
                                                } else {
                                                  mailingAddressField.disabled = false;
                                                }
                                              });

                                              document.getElementById('mother_no_middle_name').addEventListener('change', function() {
                                                const mailingAddressField = document.getElementById('mother_middle_name');
                                                if (this.checked) {
                                                  mailingAddressField.disabled = true;
                                                  mailingAddressField.value = ''; // Clear the content
                                                } else {
                                                  mailingAddressField.disabled = false;
                                                }
                                              });

                                              document.getElementById('spouse_no_middle_name').addEventListener('change', function() {
                                                const mailingAddressField = document.getElementById('spouse_middle_name');
                                                if (this.checked) {
                                                  mailingAddressField.disabled = true;
                                                  mailingAddressField.value = ''; // Clear the content
                                                } else {
                                                  mailingAddressField.disabled = false;
                                                }
                                              });

                                              document.getElementById('dependent_no_middle_name_0').addEventListener('change', function() {
                                                const mailingAddressField = document.getElementById('dependent_middle_name_0');
                                                if (this.checked) {
                                                  mailingAddressField.disabled = true;
                                                  mailingAddressField.value = ''; // Clear the content
                                                } else {
                                                  mailingAddressField.disabled = false;
                                                }
                                              });

                                            })();
                                          </script>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="reset" form="addPatientForm" class="btn btn-danger">Reset</button>
                                          <button type="submit" form="addPatientForm" class="btn btn-primary">Submit</button>
                                        </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <script>
                                          function toggleMiddleName(fieldId, checkbox) {
                                            document.getElementById(fieldId).disabled = checkbox.checked;
                                          }
                                        </script>
                                  </div>
                              <!-- end card -->
              </div>
              <!-- end col -->
            </div>
        </div>
        <!-- end container -->
      </section>
      <!-- ========== section end ========== -->

    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/dynamic-pie-chart.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/polyfill.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.js') }}"></script>

  </body>
</html>
