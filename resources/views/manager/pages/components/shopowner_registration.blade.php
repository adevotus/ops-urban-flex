@include('assets.css')

<div class="container-scroller">
    @include('layout.manager.header')

    <div class="container-fluid page-body-wrapper">

        @include('layout.manager.sidebar')

        <div class="main-panel">
            <div class="content-wrapper p-4">

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title"><a href="{{route('manager.shopOwner_list')}}" class="btn btn-primary btn-sm"><i class="ti-arrow-circle-left"></i></a> Shop Owner Registration</h4>
                                <p class="card-description">Enter shop owner personal & agreement details</p>

                                <form id="ownerForm" class="forms-sample" enctype="multipart/form-data">
                                    @csrf

                                    <!-- ---------------- PERSONAL DETAILS ---------------- -->
                                    <h5 class="mb-3 text-primary">Shop Owner Information</h5>

                                    <div class="row">

                                        <!-- User Type -->
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="userType" class="form-label fw-bold">User Type</label>
                                                <select id="userType" name="userType" class="form-control" required>
                                                    <option value="">-- Select User Type --</option>
                                                    <option value="INDIVIDUAL">Individual</option>
                                                    <option value="COMPANY">Company</option>
                                                    <option value="FAMILY">Family</option>
                                                    <option value="GROUP">Group</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- INDIVIDUAL SECTION -->
                                        <div id="individualSection" class="type-section row" style="display:none;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="individualFirstName">First Name</label>
                                                    <input type="text" class="form-control" id="individualFirstName" name="first_name" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="individualLastName">Last Name</label>
                                                    <input type="text" class="form-control" id="individualLastName" name="last_name" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- COMPANY SECTION -->
                                        <div id="companySection" class="type-section row" style="display:none;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="companyName">Company Name</label>
                                                    <input type="text" class="form-control" id="companyName" name="first_name" disabled >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="companyRegNumber">Registration Number</label>
                                                    <input type="text" class="form-control" id="companyRegNumber" name="last_name" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- FAMILY SECTION -->
                                        <div id="familySection" class="type-section row" style="display:none;">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="familyName">Family Name</label>
                                                    <input type="text" class="form-control" id="familyName" name="first_name" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="firstPerson">First Person</label>
                                                    <input type="text" class="form-control" id="firstPerson" name="last_name" placeholder="full name" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- GROUP SECTION -->
                                        <div id="groupSection" class="type-section row" style="display:none;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="groupName">Group Name</label>
                                                    <input type="text" class="form-control" id="groupName" name="first_name" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="importantPerson">Important Person</label>
                                                    <input type="text" class="form-control" id="importantPerson" name="last_name" placeholder="full name" disabled>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row mt-3">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="number" class="form-control" name="phone" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks" rows="3" placeholder="Optional notes about the landlord"></textarea>
                                    </div>

                                    <!-- ---------------- AGREEMENT DETAILS ---------------- -->
                                    <h5 class="mt-5 text-primary">Landlord Agreement</h5>
                                    <small class="text-muted">Agreement terms between the system and the landlord.</small>

                                    <div class="row mt-3">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Agreement Number</label>
                                                <input type="text" class="form-control" name="agreement_number" id="agreement_number" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Agreement Category</label>
                                                <select class="form-control" name="agreement_type" required>
                                                    <option value="">Select Category</option>
                                                    <option value="profit_sharing">Profit Sharing</option>
                                                    <option value="service_fee">Service Fee Based</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Profit / Interest (%)</label>
                                                <input type="number" class="form-control" name="profit_percentage" placeholder="e.g. 15" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Collection Mode</label>
                                                <select class="form-control" name="payment_mode" required>
                                                    <option value="">Select Mode</option>
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="monthly">Monthly</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Penalty (%)</label>
                                                <input type="number" class="form-control" name="penalty_percentage" placeholder="e.g. 5" value="0">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Agreement Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="ACTIVE">Active</option>
                                                    <option value="SUSPENDED">Suspended</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Agreement Notes</label>
                                        <textarea class="form-control" name="agreements_notes" rows="3"></textarea>
                                    </div>

                                    <!-- ---------------- COLLECTION ACCOUNTS ---------------- -->
                                    <h5 class="mt-5 text-primary">Collection Account</h5>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Collection Method</label>
                                                <select class="form-control" name="collection_method" required>
                                                    <option value="">Select Method</option>
                                                    <option value="bank">Bank</option>
                                                    <option value="mobile_money">Mobile Money</option>
                                                    <option value="cash">Cash</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Account / Wallet Number</label>
                                                <input type="text" class="form-control" name="account_number" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Account Holder Name</label>
                                                <input type="text" class="form-control" name="account_name" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Preferred Collection Day</label>
                                                <input type="text" class="form-control" name="collection_day" placeholder="e.g. Monday / 5th">
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Collection Notes</label>
                                                <textarea class="form-control" name="collection_notes" rows="2"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- ---------------- SUBMIT BTN ---------------- -->
                                    <div class="d-flex justify-content-center mt-4">
                                        <div class="col-md-4">
                                            <button type="submit" id="submitButton" class="btn btn-primary w-100">
                                                <span class="btn-text">Submit</span>
                                                <span class="spinner-border spinner-border-sm d-none"></span>
                                            </button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @include('layout.footer')

        </div>

    </div>

</div>

@include('assets.js')
<script>
    document.getElementById("userType").addEventListener("change", function () {
        let type = this.value;

        // Hide all sections and disable all inputs
        document.querySelectorAll(".type-section").forEach(section => {
            section.style.display = "none";
            section.querySelectorAll("input").forEach(input => {
                input.removeAttribute("required");
                input.disabled = true; // disable hidden inputs
            });
        });

        let section;

        switch(type){
            case "INDIVIDUAL":
                section = document.getElementById("individualSection");
                break;
            case "COMPANY":
                section = document.getElementById("companySection");
                break;
            case "FAMILY":
                section = document.getElementById("familySection");
                break;
            case "GROUP":
                section = document.getElementById("groupSection");
                break;
            default:
                section = null;
        }

        if(section){
            section.style.display = "flex";
            section.querySelectorAll("input").forEach(input => {
                input.disabled = false; // enable visible inputs
                input.setAttribute("required", true);
            });
        }
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const random = Math.floor(1000 + Math.random() * 9000);
        const date = new Date().toISOString().slice(0,10).replace(/-/g,'');
        document.getElementById('agreement_number').value = `AG-${date}-${random}`;
    });
</script>

<script>
    $(document).ready(function () {

        $("#ownerForm").on("submit", function (e) {
            e.preventDefault();

           // let formData = new FormData(this);
            var form = document.getElementById("ownerForm");
            var formData = new FormData(form); // Only enabled inputs will be included
            startLoader();
             console.log("th daa sss",formData);
            $.ajax({
                url: "{{route('manager.shopowner_registration',['type'=>'shopowner'])}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function (response) {
                    stopLoader();

                    if (response.status === 200) {
                        toastr.success("Landlord registered successfully!");
                        $("#ownerForm")[0].reset();
                        window.location.href = "/manager/landlord-list?refresh=1";
                    } else {
                        toastr.info(response.Message);
                    }
                },

                error: function () {
                    stopLoader();
                    toastr.error("Submission failed. Check your inputs.");
                }
            });
        });

        function startLoader() {
            $("#submitButton .btn-text").addClass("d-none");
            $("#submitButton .spinner-border").removeClass("d-none");
            $("#submitButton").prop("disabled", true);
        }

        function stopLoader() {
            $("#submitButton .btn-text").removeClass("d-none");
            $("#submitButton .spinner-border").addClass("d-none");
            $("#submitButton").prop("disabled", false);
        }

    });
</script>

