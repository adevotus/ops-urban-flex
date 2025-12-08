<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 | Forbidden</title>
    <link rel="stylesheet" href="{{asset('assets/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Poppins', sans-serif;
        }
        .content-wrapper {
            min-height: 100vh;
        }
        .brand-logo h3 {
            font-weight: bold;
            font-size: 35px;
        }
        .auth-form-transparent h4 {
            font-weight: 700;
            color: #000;
        }
        .auth-form-transparent h6 {
            font-weight: 300;
            color: #444;
        }
        .auth-form-btn {
            background-color: #263e8a !important;
            border: none;
            transition: background-color 0.3s ease;
        }
        .auth-form-btn:hover {
            background-color: #1e326e !important;
        }
        .right-panel {
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .right-panel p {
            position: absolute;
            bottom: 15px;
            width: 100%;
            color: #fff;
            text-align: center;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
    <div class="row flex-grow w-100 m-0">
        <!-- Left Section -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white">
            <div class="auth-form-transparent text-start p-5">
                <div class="brand-logo mb-4">
                    <h3>Urban<b class="text-primary">Flex</b></h3>
                </div>
                <h4>Forbidden</h4>
                <h6 class="fw-light mb-4">Explore the features today by logging in — just a few steps away.</h6>

                <div class="mt-3 d-grid gap-2">
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">
                            Back Home
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="col-lg-6 right-panel d-none d-lg-flex"
             style="background-image: url('{{ asset('assets/images/403.png') }}');">
            <p>Copyright &copy; {{ date('Y') }} All rights reserved.</p>
        </div>
    </div>
</div>

</body>
</html>
