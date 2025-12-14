@include('assets.css')
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layout.manager.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        @include('layout.manager.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper p-4">
                <!-- Greeting -->
                <div class="row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Owner  Particular</h4>
                                <p class="card-description">Basic Owner Information</p>

                                <form id="ownerForm" class="forms-sample" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputName1">First Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputName1">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="last Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">Email address</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword4">Contact</label>
                                                <input type="number" class="form-control" id="phone" name="phone" placeholder="phone number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">Address</label>
                                                <input type="text" class="form-control" id="address" name="address" placeholder="address" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleSelectGender">Gender</label>
                                                <select class="form-select form-control" id="gender" name="gender">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleTextarea1">Remarks</label>
                                        <textarea class="form-control" id="remarks" name="remarks" rows="4"></textarea>
                                    </div>

                                    <h4 class="card-description">Owner Agreements</h4>
                                    <h4 class="card-description">Collection Accounts</h4>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-4">
                                            <button type="submit" id="submitButton" class="btn btn-primary btn-block me-2">
                                                <span class="btn-text">Submit</span>
                                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('layout.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->


@include('assets.js')

<script>
    $(document).ready(function () {

        // When form is submitted
        $("#ownerForm").on("submit", function (e) {
            e.preventDefault();  // prevent default form submit

            let formData = new FormData(this);
            startLoader();
            $.ajax({
                url: "{{route('manager.owner_registration_store')}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function (response) {
                    if(response.status === 200){
                        stopLoader(); // reset button
                        console.log('the response is', response);
                        toastr.success(response.Message);
                        // Optional: clear form
                        $("#ownerForm")[0].reset();
                        // redirect to
                        window.location.href = "/manager/owner-list?refresh=1";
                    }else {
                        stopLoader(); // reset button
                        toastr.info(response.Message);
                        // Optional: clear form
                        $("#ownerForm")[0].reset();
                    }

                },

                error: function (xhr) {
                    stopLoader(); // reset button

                    toastr.error("Failed! Please check your inputs.");
                }
            });

        });

        // ------------------------- FUNCTIONS -------------------------

        function startLoader() {
            $("#submitButton .btn-text").addClass("d-none");     // hide text
            $("#submitButton .spinner-border").removeClass("d-none"); // show spinner
            $("#submitButton").prop("disabled", true);
        }

        function stopLoader() {
            $("#submitButton .btn-text").removeClass("d-none");  // show text
            $("#submitButton .spinner-border").addClass("d-none"); // hide spinner
            $("#submitButton").prop("disabled", false);          // enable button
        }

    });
</script>



