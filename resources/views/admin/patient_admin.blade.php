<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets/custom_assets/Picture/sign-in-pic.png') }}" type="image/x-icon" />
    <title>Patient | POS</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        #patientModal .btn-primary i {
            font-size: 1.25rem !important;
            color: #fff !important;
            display: inline-block !important;
        }
    </style>

    <style>
        /* Default checkbox styling */
        .rowCheckbox {
            appearance: none;
            /* Remove default styling */
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: white;
            transition: background-color 0.2s, border-color 0.2s;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Custom checkmark */
        .rowCheckbox::before {
            content: "✔";
            /* Checkmark */
            font-size: 16px;
            color: white;
            display: none;
            position: absolute;
        }

        /* When checked, change background to green and show checkmark */
        .rowCheckbox:checked {
            background-color: green;
            border-color: green;
        }

        .rowCheckbox:checked::before {
            display: block;
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
              <a href="{{ route('admin.dashboard') }}" class="nav-link">
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
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFFFFF" xmlns="http://www.w3.org/2000/svg">
                  <path d="M22 5V7C22 8.83 21.17 9.82 19.5 9.97C19.34 9.99 19.17 10 19 10H5C4.83 10 4.66 9.99 4.5 9.97C2.83 9.82 2 8.83 2 7V5C2 3 3 2 5 2H19C21 2 22 3 22 5Z" fill="#FFFFFF"/>
                  <path d="M5.5 11.25C4.95 11.25 4.5 11.7 4.5 12.25V19C4.5 21 5 22 7.5 22H16.5C19 22 19.5 21 19.5 19V12.25C19.5 11.7 19.05 11.25 18.5 11.25H5.5ZM13.82 15.75H10.18C9.77 15.75 9.43 15.41 9.43 15C9.43 14.59 9.77 14.25 10.18 14.25H13.82C14.23 14.25 14.57 14.59 14.57 15C14.57 15.41 14.23 15.75 13.82 15.75Z" fill="#FFFFFF"/>
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
            <li class="nav-item">
              <a
                href="{{ route('admin.reports') }}"
              >
                <span class="icon">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Bar graph columns -->
                    <rect x="4" y="12" width="2" height="5" fill="currentColor"/>
                    <rect x="8" y="8" width="2" height="9" fill="currentColor"/>
                    <rect x="12" y="4" width="2" height="13" fill="currentColor"/>
                    <rect x="16" y="10" width="2" height="7" fill="currentColor"/>
                    
                    <!-- Trend arrow on the tallest column -->
                    <path d="M13 4V2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M12.5 1.5L13 2L13.5 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                  </svg>
                </span>
                <span class="text">Reports</span>
              </a>
            </li>
            <span class="divider"><hr /></span>
            <li class="nav-item">
              <a
                href="{{ route('admin.audit-trails') }}"
              >
                <span class="icon">
                  <svg fill="#000000" height="20" width="20" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                  viewBox="0 0 476.267 476.267" xml:space="preserve">
               <g>
                 <path d="M287.039,244.883l-48.63-14.498c-12.919,15.373-29.208,25.976-47.615,25.976c-18.407,0-34.696-10.603-47.614-25.976
                   l-48.631,14.498c-9.266,2.768-15.584,11.197-15.811,20.822c4.825,7.218,10.385,14.084,16.75,20.449
                   c25.453,25.454,59.305,39.474,95.306,39.474c36.003,0,69.853-14.02,95.315-39.474c6.364-6.366,11.917-13.232,16.742-20.441
                   C302.631,256.08,296.305,247.65,287.039,244.883z"/>
                 <path d="M469.183,435.26L341.534,307.611c58.015-74.796,52.854-183.074-15.795-251.715C289.697,19.854,241.77,0,190.793,0
                   C139.817,0,91.89,19.854,55.849,55.896c-74.404,74.413-74.404,195.476,0,269.889c36.041,36.049,83.968,55.895,134.944,55.895
                   c42.868,0,83.483-14.192,116.78-40.091l127.641,127.641c4.692,4.692,10.839,7.039,16.985,7.039c6.147,0,12.291-2.346,16.983-7.039
                   C478.567,459.853,478.567,444.637,469.183,435.26z M78.495,303.138c-61.909-61.924-61.909-162.673,0-224.597
                   c29.997-29.988,69.877-46.512,112.298-46.512s82.303,16.524,112.299,46.512c61.916,61.924,61.916,162.673,0,224.597
                   c-29.996,29.997-69.877,46.512-112.299,46.512S108.492,333.135,78.495,303.138z"/>
                 <path d="M118.846,185.922c4.338,5.463,9.861,8.751,15.138,8.653c11.915,27.326,32.92,50.789,56.913,50.789
                   c23.993,0,44.998-23.464,56.913-50.789c5.278,0.098,10.8-3.19,15.138-8.653c2.294-2.885,4.284-6.31,5.66-10.266
                   c2.579-7.401,2.54-14.738,0.508-20.371c-1.595-4.414-4.393-7.806-8.315-9.183c-0.639,0.208-1.278,0.437-1.971,0.491
                   c-0.214,0.017-0.426,0.022-0.64,0.022c-1.273,0-2.453-0.389-3.562-0.923c-2.108-1.022-3.824-2.814-4.523-5.163
                   c-0.169-0.563-4.442-13.837-29.68-13.837c-2.426,0-4.993,0.125-7.698,0.371c0,0-2.639,0.235-6.708,0.235
                   c-13.462,0-31.593-2.327-41.519-13.396c-2.099-2.343-3.715-4.965-4.835-7.822c-9.331,5.927-22.748,17.126-27.91,34.722
                   c-0.656,2.224-2.207,3.901-4.13,4.933c-1.196,0.645-2.502,1.093-3.917,1.093c-0.328,0-0.655-0.017-0.989-0.061
                   c-0.677-0.081-1.283-0.344-1.9-0.579c-3.825,1.42-6.567,4.747-8.14,9.096c-2.032,5.632-2.071,12.969,0.508,20.371
                   C114.563,179.612,116.552,183.037,118.846,185.922z"/>
                 <path d="M166.331,93.063c-2.551,23.293,26.725,25.844,39.688,25.844c3.639,0,5.993-0.202,5.993-0.202
                   c2.988-0.279,5.79-0.404,8.413-0.404c32.826,0,37.776,20.032,37.776,20.032l2.033-15.083c4.277-31.702-17.777-60.935-49.429-65.529
                   c-1.847-0.268-3.699-0.399-5.539-0.399c-10.576,0-20.781,4.349-28.124,12.183l-0.557,0.595c-4.857-2.218-10.042-3.311-15.203-3.311
                   c-7.43,0-14.811,2.262-21.088,6.687c-11.947,8.419-18.737,22.377-18,36.969l1.409,27.992
                   C133.247,105.923,166.331,93.063,166.331,93.063z"/>
               </g>
               </svg>
                  
                </span>
                <span class="text">Audit Trail</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="{{ route('admin.user-management') }}"
              >
                <span class="icon">
                  <svg fill="#000000" height="20" width="20" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                  viewBox="0 0 474.565 474.565" xml:space="preserve">
               <g>
                 <path d="M255.204,102.3c-0.606-11.321-12.176-9.395-23.465-9.395C240.078,95.126,247.967,98.216,255.204,102.3z"/>
                 <path d="M134.524,73.928c-43.825,0-63.997,55.471-28.963,83.37c11.943-31.89,35.718-54.788,66.886-63.826
                   C163.921,81.685,150.146,73.928,134.524,73.928z"/>
                 <path d="M43.987,148.617c1.786,5.731,4.1,11.229,6.849,16.438L36.44,179.459c-3.866,3.866-3.866,10.141,0,14.015l25.375,25.383
                   c1.848,1.848,4.38,2.888,7.019,2.888c2.61,0,5.125-1.04,7.005-2.888l14.38-14.404c2.158,1.142,4.55,1.842,6.785,2.827
                   c0-0.164-0.016-0.334-0.016-0.498c0-11.771,1.352-22.875,3.759-33.302c-17.362-11.174-28.947-30.57-28.947-52.715
                   c0-34.592,28.139-62.739,62.723-62.739c23.418,0,43.637,13.037,54.43,32.084c11.523-1.429,22.347-1.429,35.376,1.033
                   c-1.676-5.07-3.648-10.032-6.118-14.683l14.396-14.411c1.878-1.856,2.918-4.38,2.918-7.004c0-2.625-1.04-5.148-2.918-7.004
                   l-25.361-25.367c-1.94-1.941-4.472-2.904-7.003-2.904c-2.532,0-5.063,0.963-6.989,2.904l-14.442,14.411
                   c-5.217-2.764-10.699-5.078-16.444-6.825V9.9c0-5.466-4.411-9.9-9.893-9.9h-35.888c-5.451,0-9.909,4.434-9.909,9.9v20.359
                   c-5.73,1.747-11.213,4.061-16.446,6.825L75.839,22.689c-1.942-1.941-4.473-2.904-7.005-2.904c-2.531,0-5.077,0.963-7.003,2.896
                   L36.44,48.048c-1.848,1.864-2.888,4.379-2.888,7.012c0,2.632,1.04,5.148,2.888,7.004l14.396,14.403
                   c-2.75,5.218-5.063,10.708-6.817,16.438H23.675c-5.482,0-9.909,4.441-9.909,9.915v35.889c0,5.458,4.427,9.908,9.909,9.908H43.987z"
                   />
                 <path d="M354.871,340.654c15.872-8.705,26.773-25.367,26.773-44.703c0-28.217-22.967-51.168-51.184-51.168
                   c-9.923,0-19.118,2.966-26.975,7.873c-4.705,18.728-12.113,36.642-21.803,52.202C309.152,310.022,334.357,322.531,354.871,340.654z
                   "/>
                 <path d="M460.782,276.588c0-5.909-4.799-10.693-10.685-10.693H428.14c-1.896-6.189-4.411-12.121-7.393-17.75l15.544-15.544
                   c2.02-2.004,3.137-4.721,3.137-7.555c0-2.835-1.118-5.553-3.137-7.563l-27.363-27.371c-2.08-2.09-4.829-3.138-7.561-3.138
                   c-2.734,0-5.467,1.048-7.547,3.138l-15.576,15.552c-5.623-2.982-11.539-5.481-17.751-7.369v-21.958
                   c0-5.901-4.768-10.685-10.669-10.685H311.11c-2.594,0-4.877,1.04-6.739,2.578c3.26,11.895,5.046,24.793,5.046,38.552
                   c0,8.735-0.682,17.604-1.956,26.423c7.205-2.656,14.876-4.324,22.999-4.324c36.99,0,67.086,30.089,67.086,67.07
                   c0,23.637-12.345,44.353-30.872,56.303c13.48,14.784,24.195,32.324,31.168,51.976c1.148,0.396,2.344,0.684,3.54,0.684
                   c2.733,0,5.467-1.04,7.563-3.13l27.379-27.371c2.004-2.004,3.106-4.721,3.106-7.555s-1.102-5.551-3.106-7.563l-15.576-15.552
                   c2.982-5.621,5.497-11.555,7.393-17.75h21.957c2.826,0,5.575-1.118,7.563-3.138c2.004-1.996,3.138-4.72,3.138-7.555
                   L460.782,276.588z"/>
                 <path d="M376.038,413.906c-16.602-48.848-60.471-82.445-111.113-87.018c-16.958,17.958-37.954,29.351-61.731,29.351
                   c-23.759,0-44.771-11.392-61.713-29.351c-50.672,4.573-94.543,38.17-111.145,87.026l-9.177,27.013
                   c-2.625,7.773-1.368,16.338,3.416,23.007c4.783,6.671,12.486,10.631,20.685,10.631h315.853c8.215,0,15.918-3.96,20.702-10.631
                   c4.767-6.669,6.041-15.234,3.4-23.007L376.038,413.906z"/>
                 <path d="M120.842,206.782c0,60.589,36.883,125.603,82.352,125.603c45.487,0,82.368-65.014,82.368-125.603
                   C285.563,81.188,120.842,80.939,120.842,206.782z"/>
               </g>
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
                                <button class="dropdown-toggle" type="button" id="notification"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
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
                                                @if (session('profile_picture'))
                                                    <img src="{{ session('profile_picture') }}" alt="Profile Picture"
                                                        class="img-fluid rounded-circle"
                                                        style="width: 90px; height: 50px; object-fit: cover;">
                                                @else
                                                    <!-- Default Profile Picture if none is stored -->
                                                    <img src="{{ asset('assets/images/profile/profile-image.png') }}"
                                                        alt="Default Profile Picture" class="img-fluid rounded-circle"
                                                        width="150">
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
                                                <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                                                    href="#">{{ session('email') ? session('email') : 'Email not available' }}</a>
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
                                        <form action="{{ route('logout') }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0;">
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
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                            <div class="modal fade" id="previewModal" tabindex="-1">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Preview & Transmittal Form</h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Transmittal Form -->
                                            <form id="transmittalForm">
                                                <div class="mb-3" style="display:block;">
                                                    <label for="transmittal_id">Transmittal ID</label>
                                                    <div class="d-flex align-items-center">
                                                        <input type="text" value=""
                                                            class="form-control me-2 border border-danger"
                                                            id="transmittal_id" name="transmittal_id" required
                                                            readonly>
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
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to override the Transmittal ID?
                                                                This may affect record tracking.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    id="cancelEdit">Cancel</button>
                                                                <button type="button" class="btn btn-success"
                                                                    id="confirmEdit">Yes, Override</button>
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
                                                                transmittalInput.removeClass('border-success').addClass(
                                                                    'border-danger'); // Red border when read-only
                                                            } else {
                                                                transmittalInput.removeClass('border-danger').addClass(
                                                                    'border-success'); // Green border when editable
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
                                                    <input type="text" class="form-control" id="prepared_by"
                                                        name="prepared_by" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="position">Position</label>
                                                    <input type="text" class="form-control" id="position"
                                                        name="position">
                                                </div>
                                                <button type="submit" class="btn btn-success"
                                                    id="exportBtn">Submit</button>
                                            </form>
                                            <hr>
                                            <div class="table-wrapper table-responsive">
                                                <!-- Selected Data Table -->
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <!-- Category as first column -->
                                                            <th style="min-width: 150px;">Category</th>
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
                                    // 1. Initialize DataTable
                                    var dataTable = $('#selectable').DataTable({
                                        // Your DataTable options here
                                    });
                                
                                    // Live counter update function: counts checkboxes across all pages.
                                    function updateSelectedCounter() {
                                        // Use rows({ page: 'all' }) to count selections on all pages.
                                        var count = dataTable.rows({ page: 'all' }).nodes().to$().find('.rowCheckbox:checked').length;
                                        $('#previewBtn').text("Preview Selected: " + count);
                                    }
                                
                                    // Update the counter every second (for continuous live updates)
                                    setInterval(updateSelectedCounter, 50);
                                
                                    // Also update counter when DataTable is redrawn (e.g., pagination, filtering)
                                    dataTable.on('draw.dt', function() {
                                        updateSelectedCounter();
                                    });
                                
                                    // 2. Handle Preview Button Click
                                    $('#previewBtn').on('click', function() {
                                        let selectedRows = [];
                                
                                        // Loop through all rows in the DataTable (across all pages)
                                        dataTable.rows({ page: 'all' }).nodes().to$().each(function() {
                                            var $row = $(this);
                                            if ($row.find('.rowCheckbox').prop('checked')) {
                                                var healthRecordId = $row.data('id');
                                                var dependentId = $row.find('input[name="dependent_id"]').val();
                                                var rowData = {
                                                    health_record_id: healthRecordId,
                                                    dependent_hospital_id: dependentId,
                                                    cells: []
                                                };
                                                // Skip the first two cells (as per original logic)
                                                $row.find('td:not(:first-child, :nth-child(2))').each(function() {
                                                    rowData.cells.push($(this).text().trim());
                                                });
                                                selectedRows.push(rowData);
                                            }
                                        });
                                
                                        // Clear the preview table body
                                        $('#previewTableBody').empty();
                                
                                        // Populate the preview table with selected rows
                                        selectedRows.forEach((row) => {
                                            let rowHtml = `<tr data-health-record-id="${row.health_record_id}" data-dependent-id="${row.dependent_hospital_id}">`;
                                            rowHtml += `<td class="category-cell" data-index="0" style="cursor:pointer;">POS</td>`;
                                            row.cells.forEach(cell => {
                                                rowHtml += `<td>${cell}</td>`;
                                            });
                                            rowHtml += '</tr>';
                                            $('#previewTableBody').append(rowHtml);
                                        });
                                
                                        // Update the number of claims
                                        $('#numClaims').val(selectedRows.length);
                                
                                        // Optionally, update the transmittal ID (if fetched from server)
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
                                
                                    // 3. Delegate click event for category cell cycling in preview table
                                    $('#previewTableBody').on('click', '.category-cell', function() {
                                        let currentIndex = parseInt($(this).attr('data-index'));
                                        let currentYear = new Date().getFullYear();
                                        let categories = [
                                            "POS",
                                            "SENIOR",
                                            "NTHS " + currentYear,
                                            "LISTAHAN " + currentYear,
                                            "4P'S " + currentYear
                                        ];
                                        // Cycle to next category
                                        let nextIndex = (currentIndex + 1) % categories.length;
                                        $(this).attr('data-index', nextIndex);
                                        $(this).text(categories[nextIndex]);
                                    });
                                
                                    // 4. Handle "Select All" Checkbox for all pages
                                    $('#selectAll').on('change', function() {
                                        dataTable.rows({ page: 'all' }).nodes().to$().find('.rowCheckbox').prop('checked', this.checked);
                                        // updateSelectedCounter will update automatically via setInterval/draw event.
                                    });
                                
                                    // 5. Handle Export to Excel Button Click (existing logic)
                                    $('#exportBtn').on('click', function(e) {
                                        e.preventDefault(); // Prevent normal form submission
                                
                                        // Collect form data
                                        var transmittalId = $('#transmittal_id').val();
                                        var preparedBy = $('#prepared_by').val();
                                        var position = $('#position').val();
                                
                                        // Collect table data from the preview table
                                        var tableData = [];
                                        $('#previewTableBody tr').each(function() {
                                            var $tr = $(this);
                                            tableData.push({
                                                health_record_id: $tr.data('health-record-id'),
                                                dependent_hospital_id: $tr.data('dependent-id'),
                                                cells: $tr.find('td').map(function() {
                                                    return $(this).text().trim();
                                                }).get()
                                            });
                                        });
                                
                                        // Validate required fields and table data
                                        if (!transmittalId || !preparedBy || !position) {
                                            alert("Please provide Transmittal ID, Prepared By, and its position details.");
                                            return;
                                        }
                                        if (tableData.length === 0) {
                                            alert('No data available in the table!');
                                            return;
                                        }
                                
                                        // Prepare form data for the AJAX request
                                        var formData = {
                                            transmittal_id: transmittalId,
                                            prepared_by: preparedBy,
                                            position: position,
                                            tableData: JSON.stringify(tableData),
                                            _token: '{{ csrf_token() }}'
                                        };
                                
                                        // Show the loading modal and start a countdown
                                        $('#loadingModal').modal('show');
                                        let countdown = 3;
                                        $('#countdownTimer').text(countdown);
                                        let countdownInterval = setInterval(function() {
                                            countdown--;
                                            $('#countdownTimer').text(countdown);
                                            if (countdown <= 0) {
                                                clearInterval(countdownInterval);
                                                $('#loadingText').hide();
                                                $('#modalFooter').show();
                                            }
                                        }, 1000);
                                
                                        // Debug logs
                                        console.log("Transmittal ID:", transmittalId);
                                        console.log("Prepared By:", preparedBy);
                                        console.log("Position:", position);
                                        console.log("Table Data:", tableData);
                                
                                        // Send the data via AJAX to the server
                                        $.ajax({
                                            url: '{{ route('patients.store.transmittal') }}', // Update to your route
                                            type: 'POST',
                                            data: formData,
                                            success: function(response) {
                                                // Assuming the controller returns the file path for download
                                                window.location.href = response;
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("Error:", error);
                                            }
                                        });
                                    });
                                
                                    // 6. (Optional) Form Submission Handler if needed
                                    $('#transmittalForm').on('submit', function(e) {
                                        e.preventDefault(); // Prevent normal submission
                                
                                        var tableData = [];
                                        $('#previewTableBody tr').each(function() {
                                            var rowData = {};
                                            $(this).find('td').each(function(index) {
                                                rowData[index] = $(this).text().trim();
                                            });
                                            tableData.push(rowData);
                                        });
                                
                                        var transmittalId = $('#transmittal_id').val();
                                        var preparedBy = $('#prepared_by').val();
                                        var position = $('#position').val();
                                
                                        if (!transmittalId || !preparedBy || !position) {
                                            alert("Please provide Transmittal ID and Prepared By details.");
                                            return;
                                        }
                                        if (tableData.length === 0) {
                                            alert('No data available in the table!');
                                            return;
                                        }
                                
                                        var formData = new FormData(this);
                                        formData.append('tableData', JSON.stringify(tableData));
                                        formData.append('transmittal_id', transmittalId);
                                        formData.append('prepared_by', preparedBy);
                                        formData.append('position', position);
                                
                                        $.ajax({
                                            url: '{{ route('patients.store.transmittal') }}',
                                            type: 'POST',
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            success: function(response) {
                                                console.log("Success Response:", response);
                                            },
                                            error: function(xhr) {
                                                console.error("AJAX Error:", xhr.responseText);
                                                alert("Error: " + (xhr.responseJSON?.error || 'Something went wrong.'));
                                            }
                                        });
                                    });
                                
                                    // Initial counter update on page load
                                    updateSelectedCounter();
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
                                                <a id="visitArchiveBtn"
                                                    href="{{ route('admin.archive.transmittal_archive_admin') }}"
                                                    class="btn btn-success">Visit Archive</a>
                                                <button type="button" href="{{ route('admin.patient_admin') }}"
                                                    class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-wrapper table-responsive">
                                <table id="selectable"
                                    class="display table table-striped cell-border table-hover dataTable">
                                    <!-- Top Section: Preview Button + Selection Buttons -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                            <button id="previewBtn" class="btn btn-primary">Preview Selected: 0</button>
                                        </div>
                                        

                                        <div style="position: relative; display: inline-block;">
                                            <label class="checkbox-button btn btn-success">
                                                <input type="checkbox" id="selectAll"> Select All
                                            </label>
                                            <button id="selectAbove51Days" class="btn" style="background-color: lightgreen; color: black;">
                                                Select Above 51 Days
                                            </button>
                                            <!-- Dropdown that appears when the button is clicked -->
                                            <div id="statusDropdown" style="display: none; position: absolute; top: 100%; left: 0; background-color: white; border: 1px solid #ccc; z-index: 1000; min-width: 150px;">
                                                <div class="dropdown-item" data-status="all" style="padding: 5px; cursor: pointer;">All Status</div>
                                                <div class="dropdown-item" data-status="For Update" style="padding: 5px; cursor: pointer;">For Update</div>
                                                <div class="dropdown-item" data-status="Already Updated" style="padding: 5px; cursor: pointer;">Already Updated</div>
                                            </div>
                                        </div>
                                        
                                    </div>



                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>Preview</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                            <th style="min-width: 130px;">
                                                <h6>Date of Expiry (60 days)</h6>
                                            </th>
                                            <th style="min-width: 50px;">
                                                <h6>Discharge for counting for 60 days</h6>
                                            </th>
                                            <th style="min-width: 100px;">
                                                <h6>Admitted</h6>
                                            </th>
                                            <th style="min-width: 100px;">
                                                <h6>Discharge</h6>
                                            </th>
                                            <th style="min-width: 250px;">
                                                <h6>MEMBER (Name of Member)</h6>
                                            </th>
                                            <th style="min-width: 130px;">
                                                <h6>MEMBER - BIRTHDAY</h6>
                                            </th>
                                            <th style="min-width: 250px;">
                                                <h6>DEPENDENT - PATIENT</h6>
                                            </th>
                                            <th style="min-width: 130px;">
                                                <h6>DEPENDENT - BIRTHDAY</h6>
                                            </th>
                                            <th style="min-width: 100px;">
                                                <h6>PIN</h6>
                                            </th>
                                            <th style="min-width: 150px;">
                                                <h6>ATTACHMENT (Member)</h6>
                                            </th>
                                            <th style="min-width: 150px;">
                                                <h6>ATTACHMENT (Dependent)</h6>
                                            </th>
                                            <th style="min-width: 250px;">
                                                <h6>REASON / PURPOSE</h6>
                                            </th>
                                            <th style="min-width: 200px;">
                                                <h6>STATUS</h6>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $patient)
                                            @foreach ($patient->dependents as $dependent)
                                                <tr data-id="{{ $patient->health_record_id }}">
                                                    <!-- Checkbox -->
                                                    <td
                                                        style="text-align: center; vertical-align: middle; cursor: pointer; padding: 0;">
                                                        <div
                                                            style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                                            <input type="checkbox" class="rowCheckbox">
                                                        </div>
                                                    </td>


                                                    <!-- Action -->
                                                    <td>
                                                        <div class="action">
                                                            <!-- View Details Button for Enrolled POS Patient -->
                                                            <button type="button" class="text-secondary"
                                                                title="View Details" data-bs-toggle="modal"
                                                                data-bs-target="#patientModal"
                                                                data-patient-id="{{ $patient->health_record_id }}">
                                                                <i class="lni lni-eye"></i>
                                                            </button>
                                                            <!-- Patient Details Modal -->
                                                            <div class="modal fade" id="patientModal" tabindex="-1"
                                                                aria-labelledby="patientModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="patientModalLabel">Patient Details
                                                                            </h5>
                                                                            <!-- Button to open the Edit modal -->
                                                                            <div
                                                                                class="d-inline-flex align-items-center">
                                                                                <button style="color:black;"
                                                                                    type="button"
                                                                                    class="btn btn-primary"
                                                                                    id="openEditModalBtn"
                                                                                    title="Edit Details">
                                                                                    <i style="color:black;"
                                                                                        class="lni lni-pencil-alt"></i>
                                                                                    Edit
                                                                                </button>
                                                                                <button style="color:black;"
                                                                                    type="button"
                                                                                    class="btn-close ms-2"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Patient details will be dynamically injected here -->
                                                                            <div id="patientDetailsContent"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal fade" id="editPatientModal"
                                                                tabindex="-1" aria-labelledby="editPatientModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editPatientModalLabel">Edit Patient
                                                                                Details</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Edit form will be dynamically injected here -->
                                                                            <div id="editPatientContent"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!-- Delete User -->
                                                            <form
                                                                action="{{ route('patients.delete', $patient->health_record_id) }}"
                                                                method="POST"
                                                                onsubmit="return confirmDeletion(event, {{ $patient->dependents->count() }});">
                                                                @csrf
                                                                @method('DELETE')
                                                                <!-- Hidden dependent ID for deletion -->
                                                                <input type="hidden" name="dependent_id"
                                                                    value="{{ $dependent->dependent_hospital_id }}">
                                                                <button type="submit" class="text-danger"
                                                                    title="Delete Dependent">
                                                                    <i class="lni lni-trash-can"></i>
                                                                </button>
                                                            </form>

                                                            <!-- Add Dependent Button -->
                                                            <button type="button" class="text-success"
                                                                title="Add Dependent" data-bs-toggle="modal"
                                                                data-bs-target="#addDependentModalization"
                                                                data-patient-id="{{ $patient->health_record_id }}">
                                                                <i class="lni lni-plus"></i>
                                                            </button>

                                                            <form action="{{ route('patients.pmrf', $patient->health_record_id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-link text-primary p-0" title="Export PMRF">
                                                                    <i class="fa-solid fa-file-word"></i>
                                                                </button>
                                                            </form>
                                                            
                                                             
                                                            <!-- Modal HTML -->
                                                            <div class="modal fade" id="addDependentModalization"
                                                                tabindex="-1"
                                                                aria-labelledby="addDependentModalizationLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="addDependentModalizationLabel">Add
                                                                                Dependent</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="addDependentForm"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden"
                                                                                    id="health_record_id_relation_2"
                                                                                    name="health_record_id_relation_2">
                                                                                <div class="alert alert-info">
                                                                                    <div id="memberDetails">
                                                                                        <h3>Member Information</h3>
                                                                                        <div id="memberName">
                                                                                            <!-- Member's name will be displayed here -->
                                                                                        </div>

                                                                                        <h4>Dependents</h4>
                                                                                        <ul id="dependentsList">
                                                                                            <!-- Dependents will be listed here -->
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Dependent Details -->
                                                                                <div id="dependents-wrapper">
                                                                                    <div class="dependent-entry mb-3">
                                                                                        <div class="row">
                                                                                            <!-- Status -->
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="status_2">Status<span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <select id="status_2"
                                                                                                    name="status_2"
                                                                                                    class="form-control"
                                                                                                    required>
                                                                                                    <option
                                                                                                        value=""
                                                                                                        disabled
                                                                                                        selected>Please
                                                                                                        select a status
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="For Update">
                                                                                                        For Update
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Already Updated">
                                                                                                        Already Updated
                                                                                                    </option>
                                                                                                </select>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please select a
                                                                                                    status.</div>
                                                                                            </div>
                                                                                            <!-- Admission Date -->
                                                                                            <div class="mb-3"
                                                                                                style="max-width: 300px;">
                                                                                                <label>Admission Date
                                                                                                    <span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <input type="date"
                                                                                                    class="form-control"
                                                                                                    name="admission_date_2"
                                                                                                    required>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please enter the
                                                                                                    admission date.
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- Discharge Date -->
                                                                                            <div class="mb-3"
                                                                                                style="max-width: 300px;">
                                                                                                <label>Discharge Date
                                                                                                    <span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <input type="date"
                                                                                                    class="form-control"
                                                                                                    name="discharge_date_2"
                                                                                                    required>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please enter the
                                                                                                    discharge date.
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- Reason/Purpose -->
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="reason_or_purpose2">Reason/Purpose
                                                                                                    <span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <select
                                                                                                    id="reason_or_purpose2"
                                                                                                    name="reason_or_purpose2"
                                                                                                    class="form-control"
                                                                                                    required>
                                                                                                    <option
                                                                                                        value=""
                                                                                                        disabled
                                                                                                        selected>Please
                                                                                                        select a reason
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Undeclared Dep. Child">
                                                                                                        Undeclared Dep.
                                                                                                        Child</option>
                                                                                                    <option
                                                                                                        value="Undeclared Dep. Spouse">
                                                                                                        Undeclared Dep.
                                                                                                        Spouse</option>
                                                                                                    <option
                                                                                                        value="Mispelled Last name">
                                                                                                        Mispelled Last
                                                                                                        name</option>
                                                                                                    <option
                                                                                                        value="Indigent to POS">
                                                                                                        Indigent to POS
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Mispelled First name">
                                                                                                        Mispelled First
                                                                                                        name</option>
                                                                                                    <option
                                                                                                        value="Mispelled Middle name">
                                                                                                        Mispelled Middle
                                                                                                        name</option>
                                                                                                    <option
                                                                                                        value="NO PIN">
                                                                                                        NO PIN</option>
                                                                                                    <option
                                                                                                        value="4P'S Renewal">
                                                                                                        4P'S Renewal
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Listahanan Renewal">
                                                                                                        Listahanan
                                                                                                        Renewal</option>
                                                                                                    <option
                                                                                                        value="NHTS TO POS">
                                                                                                        NHTS TO POS
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="NHTS 2024">
                                                                                                        NHTS 2024
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="NHTS TO SENIOR">
                                                                                                        NHTS TO SENIOR
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="UMID">
                                                                                                        UMID</option>
                                                                                                    <option
                                                                                                        value="Senior Citizen">
                                                                                                        Senior Citizen
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Dual Pin">
                                                                                                        Dual Pin
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Incorrect date admission">
                                                                                                        Incorrect date
                                                                                                        admission
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Incorrect Birthdate">
                                                                                                        Incorrect
                                                                                                        Birthdate
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Member Category">
                                                                                                        Member Category
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="FOR REGISTRATION">
                                                                                                        FOR REGISTRATION
                                                                                                    </option>
                                                                                                </select>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please select a
                                                                                                    reason/purpose.
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                                <label
                                                                                                    for="dependent_first_name">First
                                                                                                    Name <span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="dependent_first_name"
                                                                                                    name="dependent_first_name"
                                                                                                    required>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please enter the
                                                                                                    dependent's first
                                                                                                    name.</div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <label
                                                                                                    for="dependent_middle_name">Middle
                                                                                                    Name</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="dependent_middle_name"
                                                                                                    name="dependent_middle_name">
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <label
                                                                                                    for="dependent_last_name">Last
                                                                                                    Name <span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="dependent_last_name"
                                                                                                    name="dependent_last_name"
                                                                                                    required>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please enter the
                                                                                                    dependent's last
                                                                                                    name.</div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <label
                                                                                                    for="dependent_name_extension">Name
                                                                                                    Extension</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="dependent_name_extension"
                                                                                                    name="dependent_name_extension">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="dependent_citizenship">Citizenship
                                                                                                    <span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <select
                                                                                                    id="dependent_citizenship"
                                                                                                    name="dependent_citizenship"
                                                                                                    class="form-control"
                                                                                                    required>
                                                                                                    <option
                                                                                                        value="Filipino">
                                                                                                        Filipino
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Foreign National">
                                                                                                        Foreign National
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Dual Citizen">
                                                                                                        Dual Citizen
                                                                                                    </option>
                                                                                                </select>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please select your
                                                                                                    citizenship.</div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <label
                                                                                                    for="dependent_relationship">Relationship
                                                                                                    <span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="dependent_relationship"
                                                                                                    name="dependent_relationship"
                                                                                                    required>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please enter the
                                                                                                    dependent's
                                                                                                    relationship.</div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <label
                                                                                                    for="dependent_date_of_birth">Date
                                                                                                    of Birth <span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <input type="date"
                                                                                                    class="form-control"
                                                                                                    id="dependent_date_of_birth"
                                                                                                    name="dependent_date_of_birth"
                                                                                                    required>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please enter the
                                                                                                    dependent's date of
                                                                                                    birth.</div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-3">
                                                                                                <label
                                                                                                    for="dependent_mononym">Mononym</label>
                                                                                                <div
                                                                                                    class="form-check">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="form-check-input"
                                                                                                        id="dependent_mononym"
                                                                                                        name="dependent_mononym"
                                                                                                        value="1">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="dependent_mononym">Yes</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <label
                                                                                                    for="dependent_no_middle_name">No
                                                                                                    Middle Name</label>
                                                                                                <div
                                                                                                    class="form-check">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="form-check-input"
                                                                                                        id="dependent_no_middle_name"
                                                                                                        name="dependent_no_middle_name"
                                                                                                        value="1">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="dependent_no_middle_name">Yes</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <label
                                                                                                    for="dependent_permanent_disability">Permanent
                                                                                                    Disability</label>
                                                                                                <div
                                                                                                    class="form-check">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="form-check-input"
                                                                                                        id="dependent_permanent_disability"
                                                                                                        name="dependent_permanent_disability"
                                                                                                        value="1">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="dependent_permanent_disability">Yes</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- Attachment Type 2 -->
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="attachment_type_2">Type
                                                                                                    of Attachment
                                                                                                    (Dependent)
                                                                                                    <span
                                                                                                        style="color: red;">*</span></label>
                                                                                                <select
                                                                                                    id="attachment_type_2"
                                                                                                    name="attachment_type_2"
                                                                                                    class="form-control"
                                                                                                    required>
                                                                                                    <option
                                                                                                        value=""
                                                                                                        disabled
                                                                                                        selected>Please
                                                                                                        select a type
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Dependent Birth Cert.">
                                                                                                        Dependent Birth
                                                                                                        Cert.</option>
                                                                                                    <option
                                                                                                        value="Member Birth Cert.">
                                                                                                        Member Birth
                                                                                                        Cert.</option>
                                                                                                    <option
                                                                                                        value="Marriage Cert.">
                                                                                                        Marriage Cert.
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Postal ID">
                                                                                                        Postal ID
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Senior ID">
                                                                                                        Senior ID
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Voter's ID">
                                                                                                        Voter's ID
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="National ID">
                                                                                                        National ID
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Voter's Cert.">
                                                                                                        Voter's Cert.
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Baptismal Cert.">
                                                                                                        Baptismal Cert.
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="TIN ID">
                                                                                                        TIN ID</option>
                                                                                                    <option
                                                                                                        value="PWD ID">
                                                                                                        PWD ID</option>
                                                                                                    <option
                                                                                                        value="SSS ID">
                                                                                                        SSS ID</option>
                                                                                                    <option
                                                                                                        value="UMID">
                                                                                                        UMID</option>
                                                                                                    <option
                                                                                                        value="Barangay Cert.">
                                                                                                        Barangay Cert.
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="PMRF">
                                                                                                        PMRF</option>
                                                                                                    <option
                                                                                                        value="Driver's License">
                                                                                                        Driver's License
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Passport">
                                                                                                        Passport
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Affidavit">
                                                                                                        Affidavit
                                                                                                    </option>
                                                                                                </select>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Please select an
                                                                                                    attachment type.
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="attachment_2"
                                                                                                    class="form-label">
                                                                                                    <p>Attachment <span
                                                                                                            style="color: red;">*</span>
                                                                                                    </p>
                                                                                                </label>
                                                                                                <input type="file"
                                                                                                    class="form-control"
                                                                                                    id="attachment_2"
                                                                                                    name="attachment_2"
                                                                                                    accept="image/*"
                                                                                                    required />
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Attachment is
                                                                                                    required and file
                                                                                                    size must not exceed
                                                                                                    10MB.</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Save
                                                                                        Dependent</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- JavaScript Section -->
                                                            <script>
                                                                $(document).ready(function() {
                                                                    let isSubmitting = false; // Prevent multiple submissions

                                                                    // Ensure the correct modal ID
                                                                    $('#addDependentModalization').off('show.bs.modal').on('show.bs.modal', function(event) {
                                                                        var button = $(event.relatedTarget); // Button that triggered the modal
                                                                        var patientId = button.data('patient-id'); // Extract patient ID from data-* attribute
                                                                        $('#health_record_id_relation_2').val(patientId);
                                                                        console.log("Modal shown. health_record_id and health_record_id_relation_2 set to:",
                                                                            patientId);

                                                                        // Fetch and display the member's name and dependents for this patient
                                                                        fetchDependents(patientId);
                                                                    });

                                                                    // CSRF Token Setup
                                                                    $.ajaxSetup({
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                        }
                                                                    });

                                                                    // Prevent multiple submit bindings
                                                                    $('#addDependentForm').off('submit').on('submit', function(e) {
                                                                        e.preventDefault();

                                                                        if (isSubmitting) {
                                                                            console.log("Form already submitting...");
                                                                            return;
                                                                        }
                                                                        isSubmitting = true; // Lock submission

                                                                        var formData = new FormData(this);
                                                                        console.log("FormData created.");

                                                                        $.ajax({
                                                                            url: '{{ route('patients.add_dependent') }}',
                                                                            method: 'POST',
                                                                            data: formData,
                                                                            processData: false,
                                                                            contentType: false,
                                                                            beforeSend: function() {
                                                                                console.log("AJAX request is being sent...");
                                                                                $('#addDependentForm button[type="submit"]').prop('disabled', true)
                                                                                    .text('Submitting...');
                                                                            },
                                                                            success: function(response) {
                                                                                console.log('Dependent added successfully:', response);
                                                                                $('#addDependentModalization').modal('hide');
                                                                                location.reload();
                                                                            },
                                                                            error: function(jqXHR, textStatus, errorThrown) {
                                                                                console.error('Failed to add dependent:', textStatus, errorThrown);
                                                                                alert('Failed to add dependent. Please try again.');
                                                                            },
                                                                            complete: function() {
                                                                                isSubmitting = false; // Unlock submission
                                                                                $('#addDependentForm button[type="submit"]').prop('disabled', false)
                                                                                    .text('Add Dependent');
                                                                            }
                                                                        });
                                                                    });

                                                                    // Function to Fetch Member's Name and Dependents
                                                                    function fetchDependents(patientId) {
                                                                        $.ajax({
                                                                            url: '{{ route('patients.get_dependents') }}', // Update with actual route
                                                                            method: 'GET',
                                                                            data: {
                                                                                patient_id: patientId
                                                                            },
                                                                            success: function(response) {
                                                                                console.log('Fetched response:',
                                                                                    response); // Debugging the full response object

                                                                                let dependentsList = $('#dependentsList');
                                                                                let memberName = $('#memberName');

                                                                                dependentsList.empty();
                                                                                memberName.empty();

                                                                                // Check if the member data exists and log it
                                                                                if (response.member) {
                                                                                    // Check for undefined or empty values
                                                                                    let firstName = response.member.member_first_name || '';
                                                                                    let middleName = response.member.member_middle_name || '';
                                                                                    let lastName = response.member.member_last_name || '';
                                                                                    let extensionName = response.member.member_extension_name || '';

                                                                                    // Display Member's Name
                                                                                    memberName.append(
                                                                                        `<strong>${firstName} ${middleName} ${lastName} ${extensionName}</strong>`
                                                                                    );
                                                                                } else {
                                                                                    memberName.append('<strong>Member not found.</strong>');
                                                                                }

                                                                                // Check if dependents data exists
                                                                                if (response.dependents && response.dependents.length > 0) {
                                                                                    response.dependents.forEach(function(dependent, index) {
                                                                                        let dependentFirstName = dependent.dependent_first_name || '';
                                                                                        let dependentMiddleName = dependent.dependent_middle_name || '';
                                                                                        let dependentLastName = dependent.dependent_last_name || '';
                                                                                        let dependentExtensionName = dependent
                                                                                            .dependent_extension_name || '';

                                                                                        // Incremental numbering for dependents
                                                                                        dependentsList.append(
                                                                                            `<li>${index + 1}. ${dependentFirstName} ${dependentMiddleName} ${dependentLastName} ${dependentExtensionName}</li>`
                                                                                        );
                                                                                    });
                                                                                } else {
                                                                                    dependentsList.append('<li>No dependents found.</li>');
                                                                                }
                                                                            },
                                                                            error: function(jqXHR, textStatus, errorThrown) {
                                                                                console.error('Error fetching dependents:', textStatus, errorThrown);
                                                                                $('#dependentsList').html('<li>Error loading dependents.</li>');
                                                                            }
                                                                        });
                                                                    }



                                                                });
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
                                                            $dischargeDate =
                                                                $patient->discharge_date ??
                                                                $dependent->discharge_date_2;
                                                            $dischargeDays = (int) ($dischargeDate
                                                                ? \Carbon\Carbon::parse($dischargeDate)
                                                                    ->addDays(61)
                                                                    ->diffInDays(now(), false)
                                                                : 0);
                                                        @endphp
                                                        {{ max(0, $dischargeDays) }} days
                                                    </td>



                                                    <!-- Admitted -->
                                                    <td>{{ optional($dependent->admission_date_2)->format('Y/m/d') ?? (optional($patient->admission_date)->format('Y/m/d') ?? '') }}
                                                    </td>

                                                    <!-- Discharge -->
                                                    <td>
                                                        {{ optional($dependent->discharge_date_2)->format('Y/m/d') ?? (optional($patient->discharge_date)->format('Y/m/d') ?? '') }}
                                                    </td>

                                                    <!-- MEMBER (Name of Member) -->
                                                    <td>
                                                        {{ strtoupper($patient->member_last_name) }},
                                                        {{ strtoupper($patient->member_first_name) }}
                                                        @if ($patient->member_middle_name)
                                                            {{ strtoupper($patient->member_middle_name) }}
                                                        @endif
                                                        @if ($patient->member_extension_name)
                                                            {{ strtoupper($patient->member_extension_name) }}
                                                        @endif
                                                    </td>

                                                    <!-- MEMBER - BIRTHDAY -->
                                                    <td>{{ optional($patient->date_of_birth)->format('Y/m/d') ?? '' }}
                                                    </td>

                                                    <!-- DEPENDENT - PATIENT -->
                                                    <td>
                                                        @if (!empty($dependent->dependent_last_name) || !empty($dependent->dependent_first_name))
                                                            {{-- If last name exists, display it with a trailing comma --}}
                                                            {{ !empty($dependent->dependent_last_name) ? strtoupper($dependent->dependent_last_name) . ',' : '' }}
                                                            {{-- Display first name with a leading space if present --}}
                                                            {{ !empty($dependent->dependent_first_name) ? ' ' . strtoupper($dependent->dependent_first_name) : '' }}
                                                            {{-- Optionally display middle name --}}
                                                            @if (!empty($dependent->dependent_middle_name))
                                                                {{ ' ' . strtoupper($dependent->dependent_middle_name) }}
                                                            @endif
                                                            {{-- Optionally display extension --}}
                                                            @if (!empty($dependent->dependent_extension_name))
                                                                {{ ' ' . strtoupper($dependent->dependent_extension_name) }}
                                                            @endif
                                                        @endif
                                                    </td>


                                                    <!-- DEPENDENT - BIRTHDAY -->
                                                    <td>{{ $dependent->dependent_date_of_birth ? \Carbon\Carbon::parse($dependent->dependent_date_of_birth)->format('Y/m/d') : '' }}
                                                    </td>


                                                    <!-- PIN -->
                                                    <td>{{ $patient->pin }}</td>

                                                    <!-- ATTACHMENT (Member) -->
                                                    <td>
                                                        @if ($patient->attachment_1)
                                                            <a
                                                                href="{{ route('patients.download', ['id' => $patient->health_record_id, 'attachment' => 1]) }}">
                                                                {{ $patient->attachment_type_1 }}
                                                            </a>
                                                        @else
                                                        @endif
                                                    </td>

                                                    <!-- ATTACHMENT (Dependent) -->
                                                    <td>
                                                        @if ($dependent->attachment_2)
                                                            <a
                                                                href="{{ route('patients.download_2', ['id' => $dependent->dependent_hospital_id, 'attachment' => 2]) }}">
                                                                {{ $dependent->attachment_type_2 }}
                                                            </a>
                                                        @else
                                                        @endif
                                                    </td>

                                                    <!-- REASON / PURPOSE -->
                                                    <td>{{ $dependent->reason_or_purpose2 ?? ($patient->reason_or_purpose ?? '') }}
                                                    </td>

                                                    <!-- STATUS -->
                                                    <td
                                                        style="
                                                    {{ $patient->status === 'Already Updated'
                                                        ? 'background: linear-gradient(to right, #006400, rgb(125, 210, 159)); color: white; font-size: 20px;'
                                                        : ($patient->status === 'For Update'
                                                            ? 'background: linear-gradient(to right, #8B0000, rgb(224, 133, 133)); color: white; font-size: 20px;'
                                                            : ($dependent->status_2 === 'Already Updated'
                                                                ? 'background: linear-gradient(to right, #006400, rgb(125, 210, 159)); color: white; font-size: 20px;'
                                                                : ($dependent->status_2 === 'For Update'
                                                                    ? 'background: linear-gradient(to right, #8B0000, rgb(224, 133, 133)); color: white; font-size: 20px;'
                                                                    : ''))) }}
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addPatientModal" style="margin-top: 20px;">
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
                            <div class="modal fade" id="addPatientModal" tabindex="-1"
                                aria-labelledby="addPatientModal" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPatientModal">Add Patient</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addPatientForm" action="{{ route('patients.store') }}"
                                                class="needs-validation" method="POST" enctype="multipart/form-data"
                                                novalidate>
                                                @csrf
                                                <div class="card-header text-white"
                                                    style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <!-- Icon and Title -->
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-3"
                                                                    style="font-size: 1.75rem; color: #ffffff;">
                                                                    <i class="fas fa-id-card"></i>
                                                                    <!-- Font Awesome icon for personal details -->
                                                                </span>
                                                                <h5 class="mb-0"
                                                                    style="font-size: 1.5rem; font-weight: 600; color: #ffffff; text-align:center;">
                                                                    Form Details
                                                                </h5>
                                                            </div>
                                                            <!-- Subtle Description -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- PhilHealth Identification Number -->
                                                <div class="mb-3">
                                                    <label for="philhealth_id">PhilHealth Identification Number (PIN)
                                                        <span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" id="philhealth_id"
                                                        name="philhealth_id" required>
                                                    <div class="invalid-feedback">Please enter your PhilHealth PIN.
                                                    </div>
                                                </div>

                                                <!-- Purpose -->
                                                <div class="mb-3">
                                                    <label for="purpose">Purpose <span
                                                            style="color: red;">*</span></label>
                                                    <select id="purpose" name="purpose" class="form-control"
                                                        required>
                                                        <option value="" disabled selected>Please select</option>
                                                        <option value="Registration">Registration</option>
                                                        <option value="Updating/Amendment">Updating/Amendment</option>
                                                    </select>
                                                    <div class="invalid-feedback">This is requirede.</div>
                                                </div>


                                                <!-- Preferred KonSulta Provider -->
                                                <div class="mb-3">
                                                    <label for="provider">Preferred KonSulta Provider</label>
                                                    <input type="text" class="form-control" id="provider"
                                                        name="provider">
                                                </div>
                                                <div class="card-header text-white"
                                                    style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <!-- Icon and Title -->
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-3"
                                                                    style="font-size: 1.75rem; color: #ffffff;">
                                                                    <i class="fas fa-id-card"></i>
                                                                    <!-- Font Awesome icon for personal details -->
                                                                </span>
                                                                <h5 class="mb-0"
                                                                    style="font-size: 1.5rem; font-weight: 600; color: #ffffff;">
                                                                    Personal Details
                                                                </h5>
                                                            </div>
                                                            <!-- Subtle Description -->
                                                            <p class="mb-0 mt-2"
                                                                style="font-size: 0.9rem; color: #ffffff; opacity: 0.9;">
                                                                Provide your personal information, including full name
                                                                and date of birth.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Member Name -->
                                                <div class="mb-3">
                                                    <label>Member Name <span style="color: red;">*</span></label>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="member_first_name" placeholder="First Name"
                                                                required>
                                                            <div class="invalid-feedback">Please enter your first name.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                id="member_middle_name" name="member_middle_name"
                                                                placeholder="Middle Name">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="member_last_name" placeholder="Last Name"
                                                                required>
                                                            <div class="invalid-feedback">Please enter your last name.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="member_name_extension"
                                                                placeholder="Name Extension">
                                                        </div>
                                                    </div>
                                                    <!-- No Middle Name Checkbox for Member Name -->
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="member_no_middle_name"
                                                            onclick="toggleMiddleName(this, 'member_middle_name')">
                                                        <label class="form-check-label" for="member_no_middle_name">No
                                                            Middle Name</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="member_mononym">
                                                        <label class="form-check-label">Mononym</label>
                                                    </div>
                                                </div>

                                                <!-- Mother's Maiden Name -->
                                                <div class="mb-3">
                                                    <label>Mother's Maiden Name</label>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="mother_first_name" placeholder="First Name">
                                                            <div class="invalid-feedback">Please enter your mother's
                                                                first name.</div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                id="mother_middle_name" name="mother_middle_name"
                                                                placeholder="Middle Name">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="mother_last_name" placeholder="Last Name">
                                                            <div class="invalid-feedback">Please enter your mother's
                                                                last name.</div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="mother_name_extension"
                                                                placeholder="Name Extension">
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="mother_no_middle_name"
                                                            onclick="toggleMiddleName(this, 'mother_middle_name')">
                                                        <label class="form-check-label" for="mother_no_middle_name">No
                                                            Middle Name</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="mother_mononym">
                                                        <label class="form-check-label">Mononym</label>
                                                    </div>
                                                </div>

                                                <!-- Spouse Name -->
                                                <div class="mb-3">
                                                    <label>Spouse Name (if Married)</label>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="spouse_first_name" placeholder="First Name">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                id="spouse_middle_name" name="spouse_middle_name"
                                                                placeholder="Middle Name">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="spouse_last_name" placeholder="Last Name">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="spouse_name_extension"
                                                                placeholder="Name Extension">
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="spouse_no_middle_name"
                                                            onclick="toggleMiddleName(this, 'spouse_middle_name')">
                                                        <label class="form-check-label" for="spouse_no_middle_name">No
                                                            Middle Name</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="spouse_mononym">
                                                        <label class="form-check-label">Mononym</label>
                                                    </div>
                                                </div>

                                                <!-- Date of Birth -->
                                                <div class="mb-3">
                                                    <label>Date of Birth <span style="color: red;">*</span></label>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <input type="date" class="form-control"
                                                                name="date_of_birth"
                                                                style="min-width: 200px;"required>
                                                            <div class="invalid-feedback">Please enter the date of
                                                                birth.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Place of Birth -->
                                                <div class="mb-3">
                                                    <label for="place_of_birth">Place of Birth <span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="place_of_birth"
                                                        name="place_of_birth" required>
                                                    <div class="invalid-feedback">Please enter the place of birth.
                                                    </div>
                                                </div>

                                                <!-- Sex -->
                                                <div class="mb-3">
                                                    <label for="sex">Sex <span
                                                            style="color: red;">*</span></label>
                                                    <select id="sex" name="sex" class="form-control"
                                                        required>
                                                        <option value="" disabled selected>Please select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                    <div class="invalid-feedback">This is required.</div>
                                                </div>

                                                <!-- Civil Status -->
                                                <div class="mb-3">
                                                    <label for="civil_status">Civil Status</label>
                                                    <select id="civil_status" name="civil_status"
                                                        class="form-control" required>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Annulled">Annulled</option>
                                                        <option value="Widower">Widower</option>
                                                        <option value="Legally Separated">Legally Separated</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select your civil status.
                                                    </div>
                                                </div>

                                                <!-- Citizenship -->
                                                <div class="mb-3">
                                                    <label for="citizenship">Citizenship</label>
                                                    <select id="citizenship" name="citizenship" class="form-control"
                                                        required>
                                                        <option value="Filipino">Filipino</option>
                                                        <option value="Foreign National">Foreign National</option>
                                                        <option value="Dual Citizen">Dual Citizen</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select your citizenship.</div>
                                                </div>

                                                <!-- Philsys ID Number -->
                                                <div class="mb-3">
                                                    <label for="philsys_id">Philsys ID Number (Optional)</label>
                                                    <input type="text" class="form-control" id="philsys_id"
                                                        name="philsys_id">
                                                </div>

                                                <!-- Tax Payer Identification Number -->
                                                <div class="mb-3">
                                                    <label for="taxpayer_id">Tax Payer Identification Number
                                                        (Optional)</label>
                                                    <input type="text" class="form-control" id="taxpayer_id"
                                                        name="taxpayer_id">
                                                </div>

                                                <div class="card-header text-white"
                                                    style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <!-- Icon and Title -->
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-3"
                                                                    style="font-size: 1.75rem; color: #ffffff;">
                                                                    <i class="fas fa-users"></i>
                                                                    <!-- Font Awesome icon for dependents -->
                                                                </span>
                                                                <h5 class="mb-0"
                                                                    style="font-size: 1.5rem; font-weight: 600; color: #ffffff;">
                                                                    Address and Contact Information
                                                                </h5>
                                                            </div>
                                                            <!-- Subtle Description -->
                                                            <p class="mb-0 mt-2"
                                                                style="font-size: 0.9rem; color: #ffffff; opacity: 0.9;">
                                                                Provide accurate address and contact details for
                                                                communication.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Address and Contact Details -->
                                                <div class="mb-3">
                                                    <label for="address">Address <span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="address"
                                                        name="address" required>
                                                    <div class="invalid-feedback">Please enter your address.</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="contact_number">Contact Number (Optional)</label>
                                                    <input type="text" class="form-control" id="contact_number"
                                                        name="contact_number" pattern="\d{10,11}">
                                                    <div class="invalid-feedback">Please enter a valid contact number
                                                        (10-11 digits).</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="home_phone">Home Phone Number (Optional)</label>
                                                    <input type="text" class="form-control" id="home_phone"
                                                        name="home_phone" pattern="\d{7,11}">
                                                    <div class="invalid-feedback">Please enter a valid home phone
                                                        number (7-11 digits).</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="business_phone">Business (Direct Line)
                                                        (Optional)</label>
                                                    <input type="text" class="form-control" id="business_phone"
                                                        name="business_phone" pattern="\d{7,11}">
                                                    <div class="invalid-feedback">Please enter a valid business phone
                                                        number (7-11 digits).</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email_address">Email Address</label>
                                                    <input type="email" class="form-control" id="email_address"
                                                        name="email_address">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="mailing_address">Mailing Address</label>
                                                    <div>
                                                        <input type="checkbox" id="same_as_above"
                                                            name="same_as_above" value="yes">
                                                        <label for="same_as_above">Same as Above</label>
                                                        <input type="text" class="form-control"
                                                            id="mailing_address" name="mailing_address">
                                                    </div>
                                                </div>
                                                <div class="card-header text-white"
                                                    style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <!-- Icon and Title -->
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-3"
                                                                    style="font-size: 1.75rem; color: #ffffff;">
                                                                    <i class="fas fa-notes-medical"></i>
                                                                    <!-- Font Awesome icon for medical notes -->
                                                                </span>
                                                                <h5 class="mb-0"
                                                                    style="font-size: 1.5rem; font-weight: 600; color: #ffffff;">
                                                                    Member as Patient
                                                                </h5>
                                                            </div>
                                                            <!-- Subtle Description -->
                                                            <p class="mb-0 mt-2"
                                                                style="font-size: 0.9rem; color: #ffffff; opacity: 0.9;">
                                                                If the dependent is the patient, kindly skip this part.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Admission and Discharge Dates -->
                                                <div class="mb-3" style="max-width: 200px;">
                                                    <label>Admission Date <span style="color: red;">*</span></label>
                                                    <input type="date" class="form-control" name="admission_date"
                                                        required>
                                                    <div class="invalid-feedback">Please enter the admission date.
                                                    </div>
                                                </div>

                                                <div class="mb-3" style="max-width: 200px;">
                                                    <label>Discharge Date <span style="color: red;">*</span></label>
                                                    <input type="date" class="form-control" name="discharge_date"
                                                        required>
                                                    <div class="invalid-feedback">Please enter the discharge date.
                                                    </div>
                                                </div>

                                                <!-- Attachment Type 1 -->
                                                <div class="mb-3">
                                                    <label for="attachment_type_1">Type of Attachment (Member) <span
                                                            style="color: red;">*</span></label>
                                                    <select id="attachment_type_1" name="attachment_type_1"
                                                        class="form-control" required onchange="validateSelection()">
                                                        <option value="" disabled selected>Please select a type
                                                        </option>
                                                        <option value="Dependent Birth Cert.">Dependent Birth Cert.
                                                        </option>
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
                                                    <div class="invalid-feedback">Please select an attachment type.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="attachment_1" class="form-label">
                                                        <p>Attachment <span style="color: red;">*</span></p>
                                                    </label>
                                                    <input type="file" class="form-control" id="attachment_1"
                                                        name="attachment_1" accept="image/*" required disabled />
                                                    <div class="invalid-feedback">Attachment is Required / File size
                                                        must not exceed 10MB.</div>
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
                                                    <label for="reason_or_purpose">Reason/Purpose <span
                                                            style="color: red;">*</span></label>
                                                    <select id="reason_or_purpose" name="reason_or_purpose"
                                                        class="form-control" required>
                                                        <option value="" disabled selected>Please select a reason
                                                        </option>
                                                        <option value="Undeclared Dep. Child">Undeclared Dep. Child
                                                        </option>
                                                        <option value="Undeclared Dep. Spouse">Undeclared Dep. Spouse
                                                        </option>
                                                        <option value="Mispelled Last name">Mispelled Last name
                                                        </option>
                                                        <option value="Indigent to POS">Indigent to POS</option>
                                                        <option value="Mispelled First name">Mispelled First name
                                                        </option>
                                                        <option value="Mispelled Middle name">Mispelled Middle name
                                                        </option>
                                                        <option value="NO PIN">NO PIN</option>
                                                        <option value="4P'S Renewal">4P'S Renewal</option>
                                                        <option value="Listahanan Renewal">Listahanan Renewal</option>
                                                        <option value="NHTS TO POS">NHTS TO POS</option>
                                                        <option value="NHTS 2024">NHTS 2024</option>
                                                        <option value="NHTS TO SENIOR">NHTS TO SENIOR</option>
                                                        <option value="UMID">UMID</option>
                                                        <option value="Senior Citizen">Senior Citizen</option>
                                                        <option value="Dual Pin">Dual Pin</option>
                                                        <option value="Incorrect date admission">Incorrect date
                                                            admission</option>
                                                        <option value="Incorrect Birthdate">Incorrect Birthdate
                                                        </option>
                                                        <option value="Member Category">Member Category</option>
                                                        <option value="FOR REGISTRATION">FOR REGISTRATION</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a reason/purpose.
                                                    </div>
                                                </div>

                                                <!-- Status -->
                                                <div class="mb-3">
                                                    <label for="status">Status<span
                                                            style="color: red;">*</span></label>
                                                    <select id="status" name="status" class="form-control"
                                                        required>
                                                        <option value="" disabled selected>Please select a
                                                            status</option>
                                                        <option value="For Update">For Update</option>
                                                        <option value="Already Updated">Already Updated</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a status.</div>
                                                </div>


                                                <!-- Declaration of Dependents Section -->
                                                <div class="mb-3">
                                                    <div class="card-header text-white"
                                                        style="
                                                  background: linear-gradient(135deg,rgb(7, 118, 33),rgb(181, 202, 179));
                                                  border-bottom: none;
                                                  padding: 1.0rem;
                                                  border-radius: 20px 20px 0 0; /* Curved top edges */
                                                  ">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <!-- Icon and Title -->
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-3"
                                                                        style="font-size: 1.75rem; color: #ffffff;">
                                                                        <i class="fas fa-users"></i>
                                                                        <!-- Font Awesome icon for dependents -->
                                                                    </span>
                                                                    <h5 class="mb-0"
                                                                        style="font-size: 1.5rem; font-weight: 600; color: #ffffff;">
                                                                        Declaration of Dependents
                                                                    </h5>
                                                                </div>
                                                                <!-- Subtle Description -->
                                                                <p class="mb-0 mt-2"
                                                                    style="font-size: 0.9rem; color: #ffffff; opacity: 0.9;">
                                                                    Add the details of your dependents here. You can add
                                                                    up to 4 dependents.
                                                                </p>
                                                            </div>
                                                            <!-- Add Dependent Button -->
                                                            <button type="button"
                                                                class="btn btn-outline-success btn-sm"
                                                                id="addDependentBtn"
                                                                style="font-weight: 500; background-color: green; color: #ffffff; ">
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
                                                                    <label for="status_2">Status<span
                                                                            style="color: red;">*</span></label>
                                                                    <select id="status_2" name="status_2[]"
                                                                        class="form-control">
                                                                        <option value="" disabled selected>
                                                                            Please select a status</option>
                                                                        <option value="For Update">For Update</option>
                                                                        <option value="Already Updated">Already
                                                                            Updated</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">Please select a
                                                                        status.</div>
                                                                </div>
                                                                <!-- Admission and Discharge Dates -->
                                                                <div class="mb-3" style="max-width: 300px;">
                                                                    <label>Admission Date <span
                                                                            style="color: red;">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        name="admission_date_2[]">
                                                                    <div class="invalid-feedback">Please enter the
                                                                        admission date.</div>
                                                                </div>

                                                                <div class="mb-3" style="max-width: 300px;">
                                                                    <label>Discharge Date <span
                                                                            style="color: red;">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        name="discharge_date_2[]">
                                                                    <div class="invalid-feedback">Please enter the
                                                                        discharge date.</div>
                                                                </div>
                                                                <!-- Reason/Purpose -->
                                                                <div class="mb-3">
                                                                    <label for="reason_or_purpose2">Reason/Purpose
                                                                        <span style="color: red;">*</span></label>
                                                                    <select id="reason_or_purpose2"
                                                                        name="reason_or_purpose2[]"
                                                                        class="form-control">
                                                                        <option value="" disabled selected>
                                                                            Please select a reason</option>
                                                                        <option value="Undeclared Dep. Child">
                                                                            Undeclared Dep. Child</option>
                                                                        <option value="Undeclared Dep. Spouse">
                                                                            Undeclared Dep. Spouse</option>
                                                                        <option value="Mispelled Last name">Mispelled
                                                                            Last name</option>
                                                                        <option value="Indigent to POS">Indigent to
                                                                            POS</option>
                                                                        <option value="Mispelled First name">Mispelled
                                                                            First name</option>
                                                                        <option value="Mispelled Middle name">
                                                                            Mispelled Middle name</option>
                                                                        <option value="NO PIN">NO PIN</option>
                                                                        <option value="4P'S Renewal">4P'S Renewal
                                                                        </option>
                                                                        <option value="Listahanan Renewal">Listahanan
                                                                            Renewal</option>
                                                                        <option value="NHTS TO POS">NHTS TO POS
                                                                        </option>
                                                                        <option value="NHTS 2024">NHTS 2024</option>
                                                                        <option value="NHTS TO SENIOR">NHTS TO SENIOR
                                                                        </option>
                                                                        <option value="UMID">UMID</option>
                                                                        <option value="Senior Citizen">Senior Citizen
                                                                        </option>
                                                                        <option value="Dual Pin">Dual Pin</option>
                                                                        <option value="Incorrect date admission">
                                                                            Incorrect date admission</option>
                                                                        <option value="Incorrect Birthdate">Incorrect
                                                                            Birthdate</option>
                                                                        <option value="Member Category">Member
                                                                            Category</option>
                                                                        <option value="FOR REGISTRATION">FOR
                                                                            REGISTRATION</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">Please select a
                                                                        reason/purpose.</div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="dependent_first_name_0">First Name
                                                                        <span style="color: red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="dependent_first_name_0"
                                                                        name="dependent_first_name[]">
                                                                    <div class="invalid-feedback">Please enter the
                                                                        dependent's first name.</div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="dependent_middle_name_0">Middle
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="dependent_middle_name_0"
                                                                        name="dependent_middle_name[]">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="dependent_last_name_0">Last Name <span
                                                                            style="color: red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="dependent_last_name_0"
                                                                        name="dependent_last_name[]">
                                                                    <div class="invalid-feedback">Please enter the
                                                                        dependent's last name.</div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="dependent_name_extension_0">Name
                                                                        Extension</label>
                                                                    <input type="text" class="form-control"
                                                                        id="dependent_name_extension_0"
                                                                        name="dependent_name_extension[]">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="mb-3">
                                                                    <label for="dependent_citizenship_0">Citizenship
                                                                        <span style="color: red;">*</span></label>
                                                                    <select id="dependent_citizenship_0"
                                                                        name="dependent_citizenship[]"
                                                                        class="form-control">
                                                                        <option value="Filipino">Filipino</option>
                                                                        <option value="Foreign National">Foreign
                                                                            National</option>
                                                                        <option value="Dual Citizen">Dual Citizen
                                                                        </option>
                                                                    </select>
                                                                    <div class="invalid-feedback">Please select your
                                                                        citizenship.</div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="dependent_relationship_0">Relationship
                                                                        <span style="color: red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="dependent_relationship_0"
                                                                        name="dependent_relationship[]">
                                                                    <div class="invalid-feedback">Please enter the
                                                                        dependent's relationship.</div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="dependent_date_of_birth_0">Date of
                                                                        Birth <span
                                                                            style="color: red;">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        id="dependent_date_of_birth_0"
                                                                        name="dependent_date_of_birth[]">
                                                                    <div class="invalid-feedback">Please enter the
                                                                        dependent's date of birth.</div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label for="dependent_mononym_0">Mononym</label>
                                                                    <div class="form-check">
                                                                        <input type="checkbox"
                                                                            class="form-check-input"
                                                                            id="dependent_mononym_0"
                                                                            name="dependent_mononym[]">
                                                                        <label class="form-check-label"
                                                                            for="dependent_mononym_0"
                                                                            value="1">Yes</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="dependent_no_middle_name_0">No Middle
                                                                        Name</label>
                                                                    <div class="form-check">
                                                                        <input type="checkbox"
                                                                            class="form-check-input"
                                                                            id="dependent_no_middle_name_0"
                                                                            name="dependent_no_middle_name[]">
                                                                        <label class="form-check-label"
                                                                            for="dependent_no_middle_name_0">Yes</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label
                                                                        for="dependent_permanent_disability_0">Permanent
                                                                        Disability</label>
                                                                    <div class="form-check">
                                                                        <input type="checkbox"
                                                                            class="form-check-input"
                                                                            id="dependent_permanent_disability_0"
                                                                            name="dependent_permanent_disability[]">
                                                                        <label class="form-check-label"
                                                                            for="dependent_permanent_disability_0"
                                                                            value="1">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <!-- Attachment Type 2 -->
                                                                <div class="mb-3">
                                                                    <label for="attachment_type_2">Type of Attachment
                                                                        (Dependent) <span
                                                                            style="color: red;">*</span></label>
                                                                    <select id="attachment_type_2"
                                                                        name="attachment_type_2[]"
                                                                        class="form-control"
                                                                        onchange="validateSelection()">
                                                                        <option value="" disabled selected>
                                                                            Please select a type</option>
                                                                        <option value="Dependent Birth Cert.">
                                                                            Dependent Birth Cert.</option>
                                                                        <option value="Member Birth Cert.">Member
                                                                            Birth Cert.</option>
                                                                        <option value="Marriage Cert.">Marriage Cert.
                                                                        </option>
                                                                        <option value="Postal ID">Postal ID</option>
                                                                        <option value="Senior ID">Senior ID</option>
                                                                        <option value="Voter's ID">Voter's ID</option>
                                                                        <option value="National ID">National ID
                                                                        </option>
                                                                        <option value="Voter's Cert.">Voter's Cert.
                                                                        </option>
                                                                        <option value="Baptismal Cert.">Baptismal
                                                                            Cert.</option>
                                                                        <option value="TIN ID">TIN ID</option>
                                                                        <option value="PWD ID">PWD ID</option>
                                                                        <option value="SSS ID">SSS ID</option>
                                                                        <option value="UMID">UMID</option>
                                                                        <option value="Barangay Cert.">Barangay Cert.
                                                                        </option>
                                                                        <option value="PMRF">PMRF</option>
                                                                        <option value="Driver's License">Driver's
                                                                            License</option>
                                                                        <option value="Passport">Passport</option>
                                                                        <option value="Affidavit">Affidavit</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">Please select an
                                                                        attachment type.</div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="attachment_2" class="form-label">
                                                                        <p>Attachment <span
                                                                                style="color: red;">*</span></p>
                                                                    </label>
                                                                    <input type="file" class="form-control"
                                                                        id="attachment_2" name="attachment_2[]"
                                                                        accept="image/*" />
                                                                    <div class="invalid-feedback">Attachment is
                                                                        Required / File size must not exceed 10MB.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <script>
                                                // JavaScript for Form Validation
                                                (function() {
                                                    'use strict';

                                                    // Fetch the form and apply validation
                                                    const form = document.querySelector('.needs-validation');

                                                    form.addEventListener('submit', function(event) {
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
                                                    document.getElementById('addDependentBtn').addEventListener('click', function() {
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
                                                    document.addEventListener('click', function(event) {
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
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="reset" form="addPatientForm"
                                                    class="btn btn-danger">Reset</button>
                                                <button type="submit" form="addPatientForm"
                                                    class="btn btn-primary">Submit</button>
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
    {{-- <script src="{{ asset('assets/js/security.js') }}"></script>  --}}
    <!-- JavaScript -->
    <script>
        // Toggle a single row checkbox when clicking the <td>
        function toggleCheckbox(td) {
            let checkbox = td.querySelector(".rowCheckbox");
            if (checkbox) {
                checkbox.checked = !checkbox.checked;
            }
        }

// Track whether the above-51-days selection is active.
var isAbove51DaysActive = false;
// Store the currently selected status from the dropdown.
var selectedStatus = "all";

document.getElementById("selectAbove51Days").addEventListener("click", function(event) {
    // If filter is active, then a click will deactivate it immediately.
    if (isAbove51DaysActive) {
        // Deactivate: uncheck all filtered checkboxes.
        isAbove51DaysActive = false;
        var table = $('#selectable').DataTable();
        table.rows().every(function() {
            var row = this.node();
            var checkbox = row.querySelector(".rowCheckbox");
            if (checkbox) {
                checkbox.checked = false;
            }
        });
        // Update button text and styling.
        this.textContent = "Select Above 51 Days";
        this.style.backgroundColor = "lightgreen";
        this.style.color = "black";
        // Re-enable "Select All" checkbox.
        document.getElementById("selectAll").disabled = false;
        // Hide dropdown if visible.
        document.getElementById("statusDropdown").style.display = "none";
    } else {
        // If filter is not active, show the dropdown.
        var dropdown = document.getElementById("statusDropdown");
        dropdown.style.display = (dropdown.style.display === "none" || dropdown.style.display === "") ? "block" : "none";
    }
});


// Add click listeners to each dropdown item.
var dropdownItems = document.querySelectorAll("#statusDropdown .dropdown-item");
dropdownItems.forEach(function(item) {
    item.addEventListener("click", function() {
        // Set the selected status based on the clicked item.
        selectedStatus = this.getAttribute("data-status");
        // Hide the dropdown.
        document.getElementById("statusDropdown").style.display = "none";

        // Force activation (set to true) rather than toggling.
        isAbove51DaysActive = true;

        // Get the DataTable instance (assumes your table has the id "selectable").
        var table = $('#selectable').DataTable();

        // Iterate over each row in the DataTable.
        table.rows().every(function() {
            var row = this.node();
            // Get the days count cell (index 3).
            var daysLeftCell = row.cells[3];
            // Get the status cell (index 14).
            var statusCell = row.cells[14];
            var checkbox = row.querySelector(".rowCheckbox");

            if (daysLeftCell && checkbox) {
                // Parse the days count.
                var daysText = daysLeftCell.textContent.trim();
                var daysLeft = parseInt(daysText.replace(/\D/g, ""), 10);
                var meetsDaysCriteria = daysLeft >= 51;

                // Only check the status if a specific one is selected.
                var meetsStatusCriteria = true;
                if (selectedStatus !== "all" && statusCell) {
                    var rowStatus = statusCell.textContent.trim();
                    meetsStatusCriteria = (rowStatus === selectedStatus);
                }
                // Check or uncheck the row's checkbox.
                checkbox.checked = isAbove51DaysActive ? (meetsDaysCriteria && meetsStatusCriteria) : false;
            }
        });

        // Update the button text and style based on active state.
        var btn = document.getElementById("selectAbove51Days");
        if (isAbove51DaysActive) {
            btn.textContent = "Deselect (" + selectedStatus + ", 51+ Days)";
            btn.style.backgroundColor = "green";
            btn.style.color = "white";
            // Disable "Select All" when above 51 days filter is active.
            document.getElementById("selectAll").disabled = true;
        }
    });
});


// "Select All" functionality remains unchanged.
document.getElementById("selectAll").addEventListener("click", function() {
    var checkboxes = document.querySelectorAll(".rowCheckbox");
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById("selectAll").checked;
    });
});

// Optionally, disable the "Select Above 51 Days" button when "Select All" is active.
document.addEventListener("DOMContentLoaded", function() {
    var selectAllBtn = document.getElementById("selectAll");
    var selectAbove51DaysBtn = document.getElementById("selectAbove51Days");

    selectAllBtn.addEventListener("change", function() {
        if (selectAllBtn.checked) {
            selectAbove51DaysBtn.disabled = true;
        } else {
            selectAbove51DaysBtn.disabled = false;
        }
    });
});


    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Attach event listener to the entire table
            document.getElementById("selectable").addEventListener("click", function(event) {
                let target = event.target;

                // If the clicked element is a <td> and has a checkbox inside
                if (target.tagName === "TD" && target.querySelector(".rowCheckbox")) {
                    let checkbox = target.querySelector(".rowCheckbox");
                    checkbox.checked = !checkbox.checked;
                }
            });

            // Ensure direct clicks on the checkbox don't propagate
            document.querySelectorAll(".rowCheckbox").forEach(checkbox => {
                checkbox.addEventListener("click", function(event) {
                    event.stopPropagation();
                });
            });
        });
    </script>
    <script>
        function confirmDeletion(event, dependentCount) {
            // Get the form element from the event target
            let form = event.target;

            if (dependentCount >= 2) {
                // For members with 2 or more dependents, retrieve the dependent ID from a hidden input
                let depInput = form.querySelector('input[name="dependent_id"]');
                let depId = depInput ? depInput.value.trim() : "";

                if (!depId) {
                    alert("Deletion canceled: Dependent ID not found.");
                    event.preventDefault();
                    return false;
                }

                // Ask for confirmation using the collected dependent ID
                let confirmation = prompt("Type CONFIRM to delete the dependent with ID " + depId + ":");
                if (confirmation !== "CONFIRM") {
                    alert("Deletion canceled. You did not type CONFIRM.");
                    event.preventDefault();
                    return false;
                }
                return true;
            } else {
                // For members with 0 or 1 dependent, confirm deletion of the member and any dependents.
                let confirmation = prompt("Type CONFIRM to delete this member and their dependents (if any):");
                if (confirmation !== "CONFIRM") {
                    alert("Deletion canceled. You did not type CONFIRM.");
                    event.preventDefault();
                    return false;
                }
                return true;
            }
        }
    </script>
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
                                                                    <li>
                                                                      <strong>Attachment 1:</strong>
                                                                      ${dependent.attachment_1 
                                                                        ? `<a href="data:application/octet-stream;base64,${btoa(dependent.attachment_1)}" target="_blank">${dependent.attachment_type_1 || 'View Attachment 1'} </a>` 
                                                                        : 'No attachment uploaded.'}
                                                                      <br/><input type="file" name="dependents[${index}][attachment_1]">
                                                                    </li>
                                                                    
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
                                                                    <li><strong>Mother's Name:</strong> ${data.mother_first_name || ''} ${data.mother_middle_name || ''} ${data.mother_last_name || ''} ${data.mother_extension_name || ''}</li>
                                                                    <li><strong>Mother's Mononym:</strong> ${data.mother_mononym ? 'Yes' : 'No'}</li>
                                                                    <li><strong>Spouse's Name:</strong> ${data.spouse_first_name || ''} ${data.spouse_middle_name || ''} ${data.spouse_last_name || ''} ${data.spouse_extension_name || ''}</li>
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
                                                                      <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Contact & Address Information</h5>
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
                                                                    ${data.dependents && data.dependents.length > 0 ? data.dependents.map((dependent, index) => `
                                                                              <ul>
                                                                                <li><strong>Dependent Name:</strong> ${dependent.dependent_first_name} ${dependent.dependent_middle_name || ''} ${dependent.dependent_last_name} ${dependent.dependent_extension_name || ''}</li>
                                                                                <li><strong>Relationship:</strong> ${dependent.dependent_relationship || ''}</li>
                                                                                <li><strong>Date of Birth:</strong> ${dependent.dependent_date_of_birth ? new Date(dependent.dependent_date_of_birth).toLocaleDateString('en-US') : ''}</li>
                                                                                <li><strong>Mononym:</strong> ${dependent.dependent_mononym ? 'Yes' : 'No'}</li>
                                                                                <li><strong>Permanent Disability:</strong> ${dependent.permanent_disability ? 'Yes' : 'No'}</li>
                                                                                <li>
                                                                                  <strong>Attachment 2:</strong>
                                                                                  ${dependent.attachment_2 
                                                                                    ? `<a href="data:application/octet-stream;base64,${btoa(dependent.attachment_2)}"  target="_blank">${dependent.attachment_type_2 || 'View Attachment 2'}</a>` 
                                                                                    : 'No attachment uploaded.'}
                                                                                  <br/><input type="file" name="dependents[${index}][attachment_2]">
                                                                                </li>
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
        function renderPatientEditForm(data) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            return `
                                                                  <form id="editPatientForm" enctype="multipart/form-data">
                                                                    <input type="hidden" name="_token" value="${csrfToken}">
                                                                    <input type="hidden" name="_method" value="PUT"> <!-- Use PUT for updates -->
                                                                    
                                                                    <!-- Patient Details Edit Section -->
                                                                    <fieldset class="border p-3 mb-3">
                                                                      <legend class="w-auto px-2" style="font-size:1.5rem; font-weight:600;">Form Details</legend>
                                                                      
                                                                      <div class="mb-3">
                                                                        <label for="health_record_id" class="form-label">Health Record ID</label>
                                                                        <input type="text" class="form-control" id="health_record_id" name="health_record_id" value="${data.health_record_id || ''}" readonly>
                                                                      </div>
                                                                      
                                                                      <div class="mb-3">
                                                                        <label for="philhealth_id" class="form-label">PhilHealth ID</label>
                                                                        <input type="text" class="form-control" id="philhealth_id" name="philhealth_id" placeholder="Enter PhilHealth ID" value="${data.philhealth_id || ''}" readonly>
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
                                                                        <label for="attachment_type_1" class="form-label">Type of Attachment (Member) <span style="color: red;">*</span></label>
                                                                        <select id="attachment_type_1" name="attachment_type_1" class="form-control" required onchange="validateSelection()">
                                                                          <option value="" disabled ${!data.attachment_type_1 ? 'selected' : ''}>Please select a type</option>
                                                                          <option value="Dependent Birth Cert." ${data.attachment_type_1 === 'Dependent Birth Cert.' ? 'selected' : ''}>Dependent Birth Cert.</option>
                                                                          <option value="Member Birth Cert." ${data.attachment_type_1 === 'Member Birth Cert.' ? 'selected' : ''}>Member Birth Cert.</option>
                                                                          <option value="Marriage Cert." ${data.attachment_type_1 === 'Marriage Cert.' ? 'selected' : ''}>Marriage Cert.</option>
                                                                          <option value="Postal ID" ${data.attachment_type_1 === 'Postal ID' ? 'selected' : ''}>Postal ID</option>
                                                                          <option value="Senior ID" ${data.attachment_type_1 === 'Senior ID' ? 'selected' : ''}>Senior ID</option>
                                                                          <option value="Voter's ID" ${data.attachment_type_1 === "Voter's ID" ? 'selected' : ''}>Voter's ID</option>
                                                                          <option value="National ID" ${data.attachment_type_1 === 'National ID' ? 'selected' : ''}>National ID</option>
                                                                          <option value="Voter's Cert." ${data.attachment_type_1 === "Voter's Cert." ? 'selected' : ''}>Voter's Cert.</option>
                                                                          <option value="Baptismal Cert." ${data.attachment_type_1 === 'Baptismal Cert.' ? 'selected' : ''}>Baptismal Cert.</option>
                                                                          <option value="TIN ID" ${data.attachment_type_1 === 'TIN ID' ? 'selected' : ''}>TIN ID</option>
                                                                          <option value="PWD ID" ${data.attachment_type_1 === 'PWD ID' ? 'selected' : ''}>PWD ID</option>
                                                                          <option value="SSS ID" ${data.attachment_type_1 === 'SSS ID' ? 'selected' : ''}>SSS ID</option>
                                                                          <option value="UMID" ${data.attachment_type_1 === 'UMID' ? 'selected' : ''}>UMID</option>
                                                                          <option value="Barangay Cert." ${data.attachment_type_1 === 'Barangay Cert.' ? 'selected' : ''}>Barangay Cert.</option>
                                                                          <option value="PMRF" ${data.attachment_type_1 === 'PMRF' ? 'selected' : ''}>PMRF</option>
                                                                          <option value="Driver's License" ${data.attachment_type_1 === "Driver's License" ? 'selected' : ''}>Driver's License</option>
                                                                          <option value="Passport" ${data.attachment_type_1 === 'Passport' ? 'selected' : ''}>Passport</option>
                                                                          <option value="Affidavit" ${data.attachment_type_1 === 'Affidavit' ? 'selected' : ''}>Affidavit</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">Please select an attachment type.</div>
                                                                      </div>


                                                                      <div class="mb-3">
                                                                        <label for="attachment_1" class="form-label">Attachment 1</label>
                                                                        <!-- Display the current attachment if it exists -->
                                                                        <div>
                                                                          ${data.attachment_1 
                                                                            ? `<a href="${data.attachment_1}" target="_blank" download="${data.philhealth_id}-${data.attachment_type_1}-Member.png">Download Current Attachment</a>` 
                                                                            : '<span>No attachment uploaded.</span>'}
                                                                        </div>
                                                                        <!-- File input for uploading a new attachment -->
                                                                        <input type="file" class="form-control" id="attachment_1" name="attachment_1" accept=".jpg,.jpeg,.png,.pdf">
                                                                        <small class="form-text text-muted">
                                                                          If you do not choose a new file, the current attachment will remain unchanged.
                                                                        </small>
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
                                                                                      <label for="attachment_type_2_${index}" class="form-label">Type of Attachment (Dependent) <span style="color: red;">*</span></label>
                                                                                      <select id="attachment_type_2_${index}" name="dependents[${index}][attachment_type_2]" class="form-control" onchange="validateSelection()">
                                                                                        <option value="" disabled ${!dependent.attachment_type_2 ? 'selected' : ''}>Please select a type</option>
                                                                                        <option value="Dependent Birth Cert." ${dependent.attachment_type_2 === 'Dependent Birth Cert.' ? 'selected' : ''}>Dependent Birth Cert.</option>
                                                                                        <option value="Member Birth Cert." ${dependent.attachment_type_2 === 'Member Birth Cert.' ? 'selected' : ''}>Member Birth Cert.</option>
                                                                                        <option value="Marriage Cert." ${dependent.attachment_type_2 === 'Marriage Cert.' ? 'selected' : ''}>Marriage Cert.</option>
                                                                                        <option value="Postal ID" ${dependent.attachment_type_2 === 'Postal ID' ? 'selected' : ''}>Postal ID</option>
                                                                                        <option value="Senior ID" ${dependent.attachment_type_2 === 'Senior ID' ? 'selected' : ''}>Senior ID</option>
                                                                                        <option value="Voter's ID" ${dependent.attachment_type_2 === "Voter's ID" ? 'selected' : ''}>Voter's ID</option>
                                                                                        <option value="National ID" ${dependent.attachment_type_2 === 'National ID' ? 'selected' : ''}>National ID</option>
                                                                                        <option value="Voter's Cert." ${dependent.attachment_type_2 === "Voter's Cert." ? 'selected' : ''}>Voter's Cert.</option>
                                                                                        <option value="Baptismal Cert." ${dependent.attachment_type_2 === 'Baptismal Cert.' ? 'selected' : ''}>Baptismal Cert.</option>
                                                                                        <option value="TIN ID" ${dependent.attachment_type_2 === 'TIN ID' ? 'selected' : ''}>TIN ID</option>
                                                                                        <option value="PWD ID" ${dependent.attachment_type_2 === 'PWD ID' ? 'selected' : ''}>PWD ID</option>
                                                                                        <option value="SSS ID" ${dependent.attachment_type_2 === 'SSS ID' ? 'selected' : ''}>SSS ID</option>
                                                                                        <option value="UMID" ${dependent.attachment_type_2 === 'UMID' ? 'selected' : ''}>UMID</option>
                                                                                        <option value="Barangay Cert." ${dependent.attachment_type_2 === 'Barangay Cert.' ? 'selected' : ''}>Barangay Cert.</option>
                                                                                        <option value="PMRF" ${dependent.attachment_type_2 === 'PMRF' ? 'selected' : ''}>PMRF</option>
                                                                                        <option value="Driver's License" ${dependent.attachment_type_2 === "Driver's License" ? 'selected' : ''}>Driver's License</option>
                                                                                        <option value="Passport" ${dependent.attachment_type_2 === 'Passport' ? 'selected' : ''}>Passport</option>
                                                                                        <option value="Affidavit" ${dependent.attachment_type_2 === 'Affidavit' ? 'selected' : ''}>Affidavit</option>
                                                                                      </select>
                                                                                      <div class="invalid-feedback">Please select an attachment type.</div>
                                                                                    </div>

                                                                                    <!-- Attachment 2 (Binary File) -->
                                                                                    <div class="mb-3">
                                                                                      <label for="attachment_2_${index}" class="form-label">Attachment 2</label>
                                                                                      <div>
                                                                                        ${dependent.attachment_2
                                                                                          ? `<a href="${dependent.attachment_2}" target="_blank" download="${dependent.dependent_hospital_id}-${dependent.attachment_type_2 || 'attachment'}">Download Current Attachment</a>`
                                                                                          : '<span>No attachment uploaded.</span>'}
                                                                                      </div>
                                                                                      <input
                                                                                        type="file"
                                                                                        class="form-control"
                                                                                        id="attachment_2_${index}"
                                                                                        name="dependents[${index}][attachment_2]"
                                                                                        accept=".jpg,.jpeg,.png,.pdf">
                                                                                      <small class="form-text text-muted">
                                                                                        If you do not choose a new file, the current attachment will remain unchanged.
                                                                                      </small>
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
        // When the view modal is shown, load the patient details
        $('#patientModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var patientId = button.data('patient-id'); // Extract patient ID from data-* attributes

            // Show loading spinner and set initial content
            $('#patientDetailsContent').html(`
                                                                  <div class="text-center">
                                                                    <div class="spinner-border text-primary" role="status">
                                                                      <span class="visually-hidden">Loading...</span>
                                                                    </div>
                                                                    <p class="mt-2">Loading patient details...</p>
                                                                  </div>
                                                                `);

            // Set a placeholder title
            $('#patientModalLabel').text('Patient Details');

            // Fetch patient details via AJAX
            $.ajax({
                url: '{{ route('admin.view_details', ':patientId') }}'.replace(':patientId', patientId),
                method: 'GET',
                success: function(response) {
                    console.log('Patient details fetched successfully:',
                        response); // Log response for debugging
                    patientData = response;

                    // Update modal title with patient name or ID
                    var patientName = response.member_first_name + ' ' + response.member_last_name;
                    $('#patientModalLabel').text(`Patient Details: ${patientName}`);

                    // Render the patient view
                    $('#patientDetailsContent').html(renderPatientView(response));
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching patient details:', error); // Log error for debugging

                    // Show error message with a retry button
                    $('#patientDetailsContent').html(`
                                                                      <div class="alert alert-danger" role="alert">
                                                                        <h4 class="alert-heading">Error!</h4>
                                                                        <p>Failed to fetch patient details. Please try again.</p>
                                                                        <hr>
                                                                        <button class="btn btn-warning" id="retryFetchBtn">Retry</button>
                                                                      </div>
                                                                    `);

                    // Add click event listener for the retry button
                    $('#retryFetchBtn').on('click', function() {
                        $('#patientModal').modal('hide'); // Close the modal
                        $('#patientModal').modal(
                            'show'); // Reopen the modal to trigger the fetch again
                    });
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
            e.preventDefault(); // Prevent the default form submission

            // Create a FormData object to handle file uploads
            var formData = new FormData(this);

            // Append additional data if needed
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('_method', 'PUT'); // Use PUT for updates

            // Log the FormData for debugging
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ', pair[1]);
            }

            // Send the AJAX request
            $.ajax({
                url: '{{ route('admin.update_details', ':patientId') }}'.replace(':patientId', patientData
                    .health_record_id),
                method: 'POST', // Use POST with _method=PUT for Laravel
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content type
                success: function(response) {
                    console.log('Patient details updated successfully:', response);
                    patientData = response;

                    // Hide the edit modal and refresh the view modal with updated data
                    $('#editPatientModal').modal('hide');
                    $('#patientDetailsContent').html(renderPatientView(response));
                    $('#patientModal').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Failed to update patient details:', textStatus, errorThrown);
                    alert('Failed to update patient details. Please try again.');
                }
            });
        });
    </script>
    <script>
        $('#patientModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var patientId = button.data('patient-id'); // Extract the patient ID
            console.log("Patient ID:", patientId);

            // Generate the URL by replacing the placeholder with the actual ID
            var url = '{{ route('admin.view_details', ':patientId') }}'.replace(':patientId', patientId);
            console.log("AJAX URL:", url);

            // Use AJAX to fetch the patient details
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    console.log("AJAX response:", response);
                    var content = `
                                                                            <ul>
                                                                                <!-- Patient Details -->
                                                                                <div class="card-header text-white" style="
                                                                                    background: linear-gradient(135deg, rgb(7,118,33), rgb(181,202,179));
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
                                                                                
                                                                                <!-- Attachment for Patient -->
                                                                                <li>
                                                                                  <strong>Attachment Member:</strong>
                                                                                  ${response.attachment_1 
                                                                                    ? `<a href="data:application/octet-stream;base64,${btoa(response.attachment_1)}" target="_blank" download="${response.philhealth_id}-${response.attachment_type_1 || 'Attachment'}-Member.png">${response.attachment_type_1 || 'View Attachment'}</a>` 
                                                                                    : 'No attachment uploaded.'}
                                                                                </li>

                                                                                
                                                                                <!-- Newly Added Fields -->
                                                                                <li><strong>Reason/Purpose:</strong> ${response.reason_or_purpose || ''}</li>
                                                                                <li><strong>Status:</strong> ${response.status || ''}</li>
                                                                                
                                                                                <!-- Personal Information -->
                                                                                <div class="card-header text-white" style="
                                                                                    background: linear-gradient(135deg, rgb(7,118,33), rgb(181,202,179));
                                                                                    border-bottom: none;
                                                                                    padding: 1rem;
                                                                                    border-radius: 20px 20px 0 0;
                                                                                ">
                                                                                    <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Personal Information</h5>
                                                                                </div>
                                                                                <li><strong>Member Name:</strong> ${response.member_first_name} ${response.member_middle_name || ''} ${response.member_last_name} ${response.member_extension_name || ''}</li>
                                                                                <li><strong>Member Mononym:</strong> ${response.member_mononym ? 'Yes' : 'No'}</li>
                                                                                <li><strong>Mother's Name:</strong> ${response.mother_first_name || ''} ${response.mother_middle_name || ''} ${response.mother_last_name || ''} ${response.mother_extension_name || ''}</li>
                                                                                <li><strong>Mother's Mononym:</strong> ${response.mother_mononym ? 'Yes' : 'No'}</li>
                                                                                <li><strong>Spouse's Name:</strong> ${response.spouse_first_name || ''} ${response.spouse_middle_name || ''} ${response.spouse_last_name || ''} ${response.spouse_extension_name || ''}</li>
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
                                                                                    background: linear-gradient(135deg, rgb(7,118,33), rgb(181,202,179));
                                                                                    border-bottom: none;
                                                                                    padding: 1rem;
                                                                                    border-radius: 20px 20px 0 0;
                                                                                ">
                                                                                    <h5 style="font-size: 1.5rem; font-weight: 600; text-align:center;">Contact & Address Information</h5>
                                                                                </div>
                                                                                <li><strong>Address:</strong> ${response.address || ''}</li>
                                                                                <li><strong>Contact Number:</strong> ${response.contact_number || ''}</li>
                                                                                <li><strong>Home Phone Number:</strong> ${response.home_phone_number || ''}</li>
                                                                                <li><strong>Business Direct Line:</strong> ${response.business_direct_line || ''}</li>
                                                                                <li><strong>Email Address:</strong> ${response.email_address || ''}</li>
                                                                                <li><strong>Mailing Address:</strong> ${response.mailing_address || ''}</li>
                                                                                
                                                                                <!-- Dependent Details -->
                                                                                <div class="card-header text-white" style="
                                                                                    background: linear-gradient(135deg, rgb(7,118,33), rgb(181,202,179));
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

                                                                                                <li>
                                                                                                  <strong>Attachment Dependent:</strong>
                                                                                                  ${dependent.attachment_2
                                                                                                    ? `<a href="data:application/octet-stream;base64,${btoa(dependent.attachment_2)}" target="_blank" download="${response.philhealth_id}-${dependent.attachment_type_2 || 'Attachment'}-Dependent.png">${dependent.attachment_type_2 || 'View Attachment'}</a>` 
                                                                                                    : 'No attachment uploaded.'}
                                                                                                </li>

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
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX error:", textStatus, errorThrown);
                    $('#patientDetailsContent').html(
                        '<p>Error fetching patient details. Please try again later.</p>');
                }
            });
        });
    </script>

</body>

</html>
