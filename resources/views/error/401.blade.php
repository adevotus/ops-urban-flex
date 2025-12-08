@include('assets.css')
<body class="sidebar-fixed">
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">

                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent text-start p-3">

                        <div class="brand-logo">
                            {{--                            <img src="{{asset('assets/images/tsa-week-logo.png')}}" alt="logo" style="border-radius: 10px">--}}
                            <h3 style="font-weight: bold;font-size: 35px;font-family: Pappin,sans-serif"> Urban<b class="text-primary" style="font-weight: bold">Flex</b></h3>
                        </div>
                        <h4 style="font-weight: bold;color: black;font-family: Pappin,sans-serif">Login here</h4>
                        <h6 class="fw-light text-dark" style="font-weight: 300;color: black;font-family: Pappin,sans-serif" >Explore the features today! by login few steps</h6>
                        <div class="mt-3 d-grid gap-2">
                            {{--                                                            <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit" style="background-color: #263e8a">Login</button>--}}
                            <button id="loginBtn" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit" style="background-color: #263e8a">
                                <span class="btn-text">Back Home</span>
                                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 register-half-bg d-flex flex-row" style="background-image: url('{{asset('assets/images/401.png')}}'); background-size: cover; background-position: center;">

                    <p class="text-white fw-medium text-center flex-grow align-self-end">Copyright &copy; 2024 All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('assets.js')

<script>
    document.getElementById("loginForm").addEventListener("submit", function() {
        const btn = document.getElementById("loginBtn");
        const text = btn.querySelector(".btn-text");
        const spinner = btn.querySelector(".spinner-border");

        btn.disabled = true;
        spinner.classList.remove("d-none");
        text.textContent = "Logging in...";
    });
</script>

<script>
    @if(session('error'))
    toastr.error("{{ session('error') }}");
    @endif

</script>
