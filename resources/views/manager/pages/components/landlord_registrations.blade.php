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

                                <h4 class="card-title"><a href="{{route('manager.landLord_list')}}" class="btn btn-primary btn-sm"><i class="ti-arrow-circle-left"></i></a> Landlord Registration</h4>
                                <p class="card-description">Enter landlord personal & agreement details</p>

                                <form id="ownerForm" class="forms-sample" enctype="multipart/form-data">
                                    @csrf

                                    <!-- ---------------- PERSONAL DETAILS ---------------- -->
                                    <h5 class="mb-3 text-primary">Landlord Information</h5>

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
                                        <div id="individualSection" class="type-section" style="display:none;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" name="first_name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" name="last_name">
                                                </div>
                                            </div>

                                        </div>

                                        <!-- COMPANY SECTION -->
                                        <div id="companySection" class="row type-section" style="display:none;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input type="text" class="form-control" name="company_name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Registration Number</label>
                                                    <input type="text" class="form-control" name="registration_no">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- FAMILY SECTION -->
                                        <div id="familySection" class="row type-section" style="display:none;">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Family Name</label>
                                                    <input type="text" class="form-control" name="family_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>First Person</label>
                                                    <input type="text" class="form-control" name="fu" placeholder="full name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Secont Person</label>
                                                    <input type="text" class="form-control" name="family_name" placeholder=" full name">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- GROUP SECTION -->
                                        <div id="groupSection" class="row type-section" style="display:none;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Group Name</label>
                                                    <input type="text" class="form-control" name="group_name">
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
                                                <input type="number" class="form-control" name="penalty_percentage" placeholder="e.g. 5">
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

        // Hide all type sections
        document.querySelectorAll(".type-section").forEach(el => {
            el.style.display = "none";
            el.querySelectorAll("input").forEach(i => i.removeAttribute("required"));
        });

        // Show based on selection
        if (type === "INDIVIDUAL") {
            document.getElementById("individualSection").style.display = "flex";
            document.querySelector("input[name='first_name']").setAttribute("required", true);
            document.querySelector("input[name='last_name']").setAttribute("required", true);

        } else if (type === "COMPANY") {
            document.getElementById("companySection").style.display = "flex";
            document.querySelector("input[name='company_name']").setAttribute("required", true);
            document.querySelector("input[name='registration_no']").setAttribute("required", true);

        } else if (type === "FAMILY") {
            document.getElementById("familySection").style.display = "flex";
            document.querySelector("input[name='family_name']").setAttribute("required", true);

        } else if (type === "GROUP") {
            document.getElementById("groupSection").style.display = "flex";
            document.querySelector("input[name='group_name']").setAttribute("required", true);
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

            let formData = new FormData(this);
            startLoader();

            $.ajax({
                url: "",
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

