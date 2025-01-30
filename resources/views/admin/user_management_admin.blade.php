<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets/custom_assets/Picture/sign-in-pic.png')}}" type="image/x-icon" />
    <title>User Management | CMS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <!-- Datatables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-2.2.1/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/dt/dt-2.2.1/datatables.min.js"></script>

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
              </div>
              <!-- end col -->

              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
          <div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30">
                <div class="title">
                  <h2>User Management</h2>
                </div>
                  <p class="text-sm mb-20">
                    List of registered users.
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
                  <div class="table-wrapper table-responsive">
                    <table id="example" class="table table-striped cell-border table-hover dataTable">
                    <thead>
                      <tr>
                      <th>Action</th>
                        <th style="min-width: 100px;">User ID</th>
                        <th>Previllage</th>
                        <th>Username</th>
                        <th style="min-width: 250px;">Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Date Created</th>
                        <th>Credential Update</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="action">
                                    <!-- Password Reset Button -->
                                    <form action="{{ route('admin.user-management.reset-password', $user->id) }}" class="needs-validation" method="POST">
                                        @csrf
                                        <button type="submit" class="text-secondary" title="Reset Password" onclick="return confirm('Are you sure you want to reset the password?')">
                                            <i class="lni lni-key"></i>
                                        </button>
                                    </form>
                                    <!-- Delete User -->
                                    <form action="{{ route('admin.user-management.delete', $user->id) }}" method="POST" onsubmit="return confirmDeletion(event);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger" title="Delete User">
                                        <i class="lni lni-trash-can"></i>
                                        </button>
                                    </form>

                                    <script>
                                        function confirmDeletion(event) {
                                            // Show a prompt asking the user to type CONFIRM
                                            const userInput = prompt("To confirm deletion, please type 'CONFIRM':");
                                            
                                            // Check if the user typed CONFIRM
                                            if (userInput === "CONFIRM") {
                                                return true; // Allow the form submission
                                            }

                                            // Prevent form submission if the input is incorrect
                                            alert("Deletion canceled. You must type 'CONFIRM' to delete the user.");
                                            event.preventDefault();
                                            return false;
                                        }
                                    </script>
                                </div>
                            </td>
                            <td><a href="#0">Number: {{ $user->id }}</a></td>
                            <td><a href="#0">{{ $user->user_type }}</a></td>
                            <td>{{ $user->username }}</td>
                            <td>
                            <div class="lead">
                                <div class="lead-image">
                                    <img src="{{ $user->profile_picture_base64 }}" alt="Profile Picture" class="img-fluid rounded-circle" width="20" height="20">
                                </div>
                              <div>
                                <p>{{ $user->first_name }}
                                  @if ($user->middle_name) {{ $user->middle_name }} @endif
                                  {{ $user->last_name }}
                                  @if ($user->suffix) {{ $user->suffix }} @endif
                                </p>
                              </div>
                            </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->number }}</td>
                            <td>{{ $user->created_at->format('F j, Y') }}</td>
                            <td>{{ $user->updated_at->format('F j, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <!-- end table -->
                  </div>
                    <!-- Add User -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal" style="margin-top: 20px;">
                      Add User
                    </button>
                      <!-- Modal Structure -->
                      <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <!-- Form Starts Here -->
                              <form id="addUserForm" action="{{ route('store.user') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Username -->
                                @if(session('debug'))
                                  <div class="alert alert-info">
                                    <strong>Debug Information:</strong>
                                    <pre>{{ print_r(session('debug'), true) }}</pre>
                                  </div>
                                @endif
                                <div class="mb-3">
                                  <label for="username" class="form-label">
                                    <p>Username <span style="color: red;">*</span></p>
                                  </label>
                                  <input 
                                    type="text" 
                                    class="form-control" 
                                    id="username" 
                                    name="username" 
                                    placeholder="Enter username" 
                                    pattern="^[a-zA-Z0-9]{1,20}$" 
                                    maxlength="20" 
                                    required 
                                  />
                                  <div class="invalid-feedback">
                                    Username must not exceed 20 characters and contain only letters or numbers.
                                  </div>
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                  <label for="password" class="form-label">
                                    <p>Password <span style="color: red;">*</span></p>
                                  </label>
                                  <input 
                                    type="password" 
                                    class="form-control" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Enter password" 
                                    pattern="^(?=.*[a-z])(?=.*[A-Z]).{8,}$" 
                                    minlength="8" 
                                    required 
                                  />
                                  <div class="invalid-feedback">
                                    Password must be at least 8 characters long, with at least one uppercase and one lowercase letter.
                                  </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                  <label for="email" class="form-label">
                                    <p>Email <span style="color: red;">*</span></p>
                                  </label>
                                  <input 
                                    type="email" 
                                    class="form-control" 
                                    id="email" 
                                    name="email" 
                                    placeholder="Enter email" 
                                    required 
                                  />
                                  <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <!-- Number -->
                                <div class="mb-3">
                                  <label for="number" class="form-label">
                                    <p>Contact Number <span style="color: red;">*</span></p>
                                  </label>
                                  <input 
                                    type="tel" 
                                    class="form-control" 
                                    id="number" 
                                    name="number" 
                                    placeholder="Enter contact number" 
                                    pattern="^\d{11}$" 
                                    required 
                                  />
                                  <div class="invalid-feedback">Enter a valid contact number (10–15 digits).</div>
                                </div>

                                <!-- First Name -->
                                <div class="mb-3">
                                  <label for="first_name" class="form-label">
                                    <p>First/Given Name <span style="color: red;">*</span></p>
                                  </label>
                                  <input 
                                    type="text" 
                                    class="form-control" 
                                    id="firstName" 
                                    name="first_name" 
                                    placeholder="Enter first name" 
                                    pattern="^[a-zA-Z.\- ]+$" 
                                    required 
                                  />
                                  <div class="invalid-feedback">
                                    First name must not contain numbers or special characters, except `-` and `.`.
                                  </div>
                                </div>

                                <!-- Last Name -->
                                <div class="mb-3">
                                  <label for="last_name" class="form-label">
                                    <p>Last Name / Surname <span style="color: red;">*</span></p>
                                  </label>
                                  <input 
                                    type="text" 
                                    class="form-control" 
                                    id="last_name" 
                                    name="last_name" 
                                    placeholder="Enter last name" 
                                    pattern="^[a-zA-Z.\- ]+$" 
                                    required 
                                  />
                                  <div class="invalid-feedback">
                                    Last name must not contain numbers or special characters, except `-` and `.`.
                                  </div>
                                </div>

                                <!-- Profile Picture -->
                                <div class="mb-3">
                                  <label for="profile_picture" class="form-label">
                                    <p>Profile Picture <span style="color: red;">*</span></p>
                                  </label>
                                  <input 
                                    type="file" 
                                    class="form-control" 
                                    id="profile_picture" 
                                    name="profile_picture" 
                                    accept="image/*" 
                                    onchange="validateFileSize(this)"
                                    required
                                  />
                                  <div class="invalid-feedback">Profile Picture is Required / File size must not exceed 10MB.</div>
                                </div>

                                <!-- User Type -->
                                <div class="mb-3">
                                  <label for="user_type" class="form-label">
                                    <p>User Type <span style="color: red;">*</span></p>
                                  </label>
                                  <select class="form-select" id="user_type" name="user_type" required>
                                    <option value="" selected>Select user type</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                  </select>
                                  <div class="invalid-feedback">Please select a user type.</div>
                                </div>
                              </form>
                              <!-- Form Ends Here -->
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" form="addUserForm" class="btn btn-primary">Add User</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Front-End Validation Script -->
                       
                      <script>
                        (function () {
                          'use strict';
                          const forms = document.querySelectorAll('.needs-validation');

                          Array.from(forms).forEach(function (form) {
                            form.addEventListener('submit', function (event) {
                              // Prevent the form from submitting if it's invalid
                              if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                              } else {
                                event.preventDefault();
                                // Alerting form data before submitting
                                alertFormData(form);  // Alert all details before proceeding
                                submitFormViaAjax(form); // Proceed with the AJAX submission
                              }

                              form.classList.add('was-validated');
                            }, false);
                          });
                        })();

                        // Alert the form data before submission
                        function alertFormData(form) {
                          const formData = new FormData(form);
                          let formDetails = '';
                          formData.forEach((value, key) => {
                            formDetails += `${key}: ${value}\n`;
                          });
                          alert('Form Data: \n' + formDetails); // Display form data as an alert
                        }

                        // Handle form submission via AJAX
                        function submitFormViaAjax(form) {
                          const formData = new FormData(form); // Create a FormData object to handle form data

                          // Perform the AJAX request to submit the form
                          performAjaxRequest(formData, form.action);
                        }

                        // Function to perform the AJAX request
                        function performAjaxRequest(formData, actionUrl) {
                          fetch(actionUrl, {
                            method: 'POST',
                            body: formData,
                          })
                          .then(response => {
                            // If the response is JSON, process it
                            return response.json();
                          })
                          .then(data => {
                            if (data.status === 'success') {
                              // Process the JSON response (e.g., show success message)
                              console.log(data);
                              alert(data.message);

                              // Optionally update the UI, such as refreshing the user list
                              updateUserList(data.user); // Update user list with new user

                              // Close the modal (if applicable)
                              $('#addUserModal').modal('hide');
                            } else {
                              // Handle validation errors
                              alert('Validation failed: ' + data.errors.join(', '));
                            }
                          })
                          .catch(error => {
                            // Handle errors (e.g., network or AJAX issues)
                            console.error(error);
                            alert('An error occurred: ' + error.message);
                          });
                        }

                        // Function to update or populate the user list after successful submission
                        function updateUserList(user) {
                          const userListContainer = document.getElementById('user-list'); // Example ID for the user list container

                          if (userListContainer) {
                            const newUserElement = document.createElement('li');
                            newUserElement.textContent = `Username: ${user.username}, Name: ${user.first_name} ${user.last_name}`;

                            // You can modify this based on the structure of your user list
                            userListContainer.appendChild(newUserElement);
                          }
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
    <script src="{{ asset('assets\js\datatables.js') }}"></script>
    <script>
      // ======== jvectormap activation
      var markers = [
        { name: "Egypt", coords: [26.8206, 30.8025] },
        { name: "Russia", coords: [61.524, 105.3188] },
        { name: "Canada", coords: [56.1304, -106.3468] },
        { name: "Greenland", coords: [71.7069, -42.6043] },
        { name: "Brazil", coords: [-14.235, -51.9253] },
      ];

      var jvm = new jsVectorMap({
        map: "world_merc",
        selector: "#map",
        zoomButtons: true,

        regionStyle: {
          initial: {
            fill: "#d1d5db",
          },
        },

        labels: {
          markers: {
            render: (marker) => marker.name,
          },
        },

        markersSelectable: true,
        selectedMarkers: markers.map((marker, index) => {
          var name = marker.name;

          if (name === "Russia" || name === "Brazil") {
            return index;
          }
        }),
        markers: markers,
        markerStyle: {
          initial: { fill: "#4A6CF7" },
          selected: { fill: "#ff5050" },
        },
        markerLabelStyle: {
          initial: {
            fontWeight: 400,
            fontSize: 14,
          },
        },
      });
      // ====== calendar activation
      document.addEventListener("DOMContentLoaded", function () {
        var calendarMiniEl = document.getElementById("calendar-mini");
        var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
          initialView: "dayGridMonth",
          headerToolbar: {
            end: "today prev,next",
          },
        });
        calendarMini.render();
      });

      // =========== chart one start
      const ctx1 = document.getElementById("Chart1").getContext("2d");
      const chart1 = new Chart(ctx1, {
        type: "line",
        data: {
          labels: [
            "Jan",
            "Fab",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "",
              backgroundColor: "transparent",
              borderColor: "#365CF5",
              data: [
                600, 800, 750, 880, 940, 880, 900, 770, 920, 890, 976, 1100,
              ],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#365CF5",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 5,
              borderWidth: 5,
              pointRadius: 8,
              pointHoverRadius: 8,
              cubicInterpolationMode: "monotone", // Add this line for curved line
            },
          ],
        },
        options: {
          plugins: {
            tooltip: {
              callbacks: {
                labelColor: function (context) {
                  return {
                    backgroundColor: "#ffffff",
                    color: "#171717"
                  };
                },
              },
              intersect: false,
              backgroundColor: "#f9f9f9",
              title: {
                fontFamily: "Plus Jakarta Sans",
                color: "#8F92A1",
                fontSize: 12,
              },
              body: {
                fontFamily: "Plus Jakarta Sans",
                color: "#171717",
                fontStyle: "bold",
                fontSize: 16,
              },
              multiKeyBackground: "transparent",
              displayColors: false,
              padding: {
                x: 30,
                y: 10,
              },
              bodyAlign: "center",
              titleAlign: "center",
              titleColor: "#8F92A1",
              bodyColor: "#171717",
              bodyFont: {
                family: "Plus Jakarta Sans",
                size: "16",
                weight: "bold",
              },
            },
            legend: {
              display: false,
            },
          },
          responsive: true,
          maintainAspectRatio: false,
          title: {
            display: false,
          },
          scales: {
            y: {
              grid: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 1200,
                min: 500,
              },
            },
            x: {
              grid: {
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            },
          },
        },
      });
      // =========== chart one end

      // =========== chart two start
      const ctx2 = document.getElementById("Chart2").getContext("2d");
      const chart2 = new Chart(ctx2, {
        type: "bar",
        data: {
          labels: [
            "Jan",
            "Fab",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "",
              backgroundColor: "#365CF5",
              borderRadius: 30,
              barThickness: 6,
              maxBarThickness: 8,
              data: [
                600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
              ],
            },
          ],
        },
        options: {
          plugins: {
            tooltip: {
              callbacks: {
                titleColor: function (context) {
                  return "#8F92A1";
                },
                label: function (context) {
                  let label = context.dataset.label || "";

                  if (label) {
                    label += ": ";
                  }
                  label += context.parsed.y;
                  return label;
                },
              },
              backgroundColor: "#F3F6F8",
              titleAlign: "center",
              bodyAlign: "center",
              titleFont: {
                size: 12,
                weight: "bold",
                color: "#8F92A1",
              },
              bodyFont: {
                size: 16,
                weight: "bold",
                color: "#171717",
              },
              displayColors: false,
              padding: {
                x: 30,
                y: 10,
              },
          },
          },
          legend: {
            display: false,
            },
          legend: {
            display: false,
          },
          layout: {
            padding: {
              top: 15,
              right: 15,
              bottom: 15,
              left: 15,
            },
          },
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              grid: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 1200,
                min: 0,
              },
            },
            x: {
              grid: {
                display: false,
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                drawTicks: false,
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            },
          },
          plugins: {
            legend: {
              display: false,
            },
            title: {
              display: false,
            },
          },
        },
      });
      // =========== chart two end

      // =========== chart three start
      const ctx3 = document.getElementById("Chart3").getContext("2d");
      const chart3 = new Chart(ctx3, {
        type: "line",
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "Revenue",
              backgroundColor: "transparent",
              borderColor: "#365CF5",
              data: [80, 120, 110, 100, 130, 150, 115, 145, 140, 130, 160, 210],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#365CF5",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#365CF5",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
              fill: false,
              tension: 0.4,
            },
            {
              label: "Profit",
              backgroundColor: "transparent",
              borderColor: "#9b51e0",
              data: [
                120, 160, 150, 140, 165, 210, 135, 155, 170, 140, 130, 200,
              ],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#9b51e0",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#9b51e0",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
              fill: false,
              tension: 0.4,
            },
            {
              label: "Order",
              backgroundColor: "transparent",
              borderColor: "#f2994a",
              data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#f2994a",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#f2994a",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
              fill: false,
              tension: 0.4,
            },
          ],
        },
        options: {
          plugins: {
            tooltip: {
              intersect: false,
              backgroundColor: "#fbfbfb",
              titleColor: "#8F92A1",
              bodyColor: "#272727",
              titleFont: {
                size: 16,
                family: "Plus Jakarta Sans",
                weight: "400",
              },
              bodyFont: {
                family: "Plus Jakarta Sans",
                size: 16,
              },
              multiKeyBackground: "transparent",
              displayColors: false,
              padding: {
                x: 30,
                y: 15,
              },
              borderColor: "rgba(143, 146, 161, .1)",
              borderWidth: 1,
              enabled: true,
            },
            title: {
              display: false,
            },
            legend: {
              display: false,
            },
          },
          layout: {
            padding: {
              top: 0,
            },
          },
          responsive: true,
          // maintainAspectRatio: false,
          legend: {
            display: false,
          },
          scales: {
            y: {
              grid: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
              },
              max: 350,
              min: 50,
            },
            x: {
              grid: {
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                drawTicks: false,
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            },
          },
        },
      });
      // =========== chart three end

      // ================== chart four start
      const ctx4 = document.getElementById("Chart4").getContext("2d");
      const chart4 = new Chart(ctx4, {
        type: "bar",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
          datasets: [
            {
              label: "",
              backgroundColor: "#365CF5",
              borderColor: "transparent",
              borderRadius: 20,
              borderWidth: 5,
              barThickness: 20,
              maxBarThickness: 20,
              data: [600, 700, 1000, 700, 650, 800],
            },
            {
              label: "",
              backgroundColor: "#d50100",
              borderColor: "transparent",
              borderRadius: 20,
              borderWidth: 5,
              barThickness: 20,
              maxBarThickness: 20,
              data: [690, 740, 720, 1120, 876, 900],
            },
          ],
        },
        options: {
          plugins: {
            tooltip: {
              backgroundColor: "#F3F6F8",
              titleColor: "#8F92A1",
              titleFontSize: 12,
              bodyColor: "#171717",
              bodyFont: {
                weight: "bold",
                size: 16,
              },
              multiKeyBackground: "transparent",
              displayColors: false,
              padding: {
                x: 30,
                y: 10,
              },
              bodyAlign: "center",
              titleAlign: "center",
              enabled: true,
            },
            legend: {
              display: false,
            },
          },
          layout: {
            padding: {
              top: 0,
            },
          },
          responsive: true,
          // maintainAspectRatio: false,
          title: {
            display: false,
          },
          scales: {
            y: {
              grid: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 1200,
                min: 0,
              },
            },
            x: {
              grid: {
                display: false,
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            },
          },
        },
      });
        // =========== chart four end
    </script>
  </body>
</html>
