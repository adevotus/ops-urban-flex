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
                                        <h4 class="card-title mt-3">Owner Agreement</h4>
                                        <small class="text-muted"> This agreement defines profit sharing and payment responsibilities between the system provider and the vehicle owner. </small>

                                        <div class="row mt-3">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Agreement Reference</label>
                                                    <input type="text" class="form-control" id="agreement_number" name="agreement_number" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Agreement Category</label>
                                                    <select class="form-control" name="agreement_type" id="agreement_type" required>
                                                        <option value="">Select Category</option>
                                                        <option value="profit_sharing">Profit Sharing</option>
                                                        <option value="service_fee">Service Fee Based</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Profit / Interest (%)</label>
                                                    <input type="number" class="form-control" id="profit_percentage" name="profit_percentage"  placeholder="e.g. 15"  required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Payment Collection Mode</label>
                                                    <select class="form-control" name="payment_mode" id="payment_mode" required>
                                                        <option value="">Select Mode</option>
                                                        <option value="daily">Daily Collections</option>
                                                        <option value="weekly">Weekly Collections</option>
                                                        <option value="monthly">Monthly Collections</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Default Penalty (%)</label>
                                                    <input type="number" class="form-control" name="penalty_percentage" id ="penalty_percentage" placeholder="e.g. 5">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Agreement Status</label>
                                                    <select class="form-control" name="status" id="status" required>
                                                        <option value="ACTIVE">Active</option>
                                                        <option value="SUSPENDED">Suspended</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label>Agreement Notes</label>
                                            <textarea class="form-control" id="agreements_notes" name="agreements_notes" rows="3"  placeholder="Any special conditions, responsibilities, or notes"></textarea>
                                        </div>

                                    

                                    <h4 class="card-title mt-3">Collection Accounts</h4>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Collection Method</label>
                                                <select class="form-control" name="collection_method" id="collection_method" required>
                                                    <option value="">Select Method</option>
                                                    <option value="bank">Bank Account</option>
                                                    <option value="mobile_money">Mobile Money</option>
                                                    <option value="cash">Cash</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Account / Wallet Number</label>
                                                <input type="text" class="form-control" name="account_number" id="account_number" placeholder="Bank or Mobile Money Number" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Account Holder Name</label>
                                                <input type="text" class="form-control" name="account_name" id="account_name"  placeholder="Owner or Company Name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Preferred Collection Day</label>
                                                <input type="text" class="form-control" name="collection_day" id="collection_day" placeholder="e.g. Monday or 5th of every month">
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Collection Notes</label>
                                                <textarea class="form-control" name="collection_notes" rows="2" id="collection_notes"   placeholder="Any special collection instructions"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mt-4">
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
document.addEventListener('DOMContentLoaded', function () {
    const random = Math.floor(1000 + Math.random() * 9000);
    const date = new Date().toISOString().slice(0,10).replace(/-/g,'');
    document.getElementById('agreement_number').value = `AG-${date}-${random}`;
});
</script>


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



