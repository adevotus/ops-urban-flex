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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-4">
                                    <!-- LEFT SIDE -->

                                    <!-- RIGHT SIDE -->
                                    <div class="col-lg-12">
                                        <a href="{{route('manager.agreement-list')}}" class="btn btn-primary btn-sm"><i class="ti-arrow-circle-left"></i></a>

                                        <!-- Loan Summary -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-body">

                                                <div class="d-flex justify-content-between">
                                                    <div class="card-header fw-bold">Agreement Details</div>
                                                    @php
                                                    $statusClass = match ($agreement->status) {
                                                    'ACCEPTED'  => 'bg-success',
                                                    'PROCESSING' => 'bg-warning text-dark',
                                                    'REJECTED'  => 'bg-danger',
                                                    default     => 'bg-info text-dark',
                                                    };
                                                    @endphp

                                                    <p><strong>Current Status :</strong> <span class="badge {{ $statusClass }} px-3 py-2 text-white">{{ $agreement->status }}</span></p>
                                                </div>
                                                <hr>
                                                <div class="row" id="agreementDetailsCheck">
                                                    <div class="col-md-4">
                                                        <p><strong>Agreement No:</strong> {{ $agreement->agreement_number }}</p>
                                                        <p><strong>Rental Type:</strong> {{ $agreement->rental_type }}</p>
                                                        <p><strong>Duration:</strong> {{ $agreement->rental_duration }}</p>
                                                        <p><strong>Start:</strong> {{ $agreement->agreement_start_date }}</p>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <p><strong>End:</strong> {{ $agreement->agreement_end_date }}</p>
                                                        <p><strong>Initial Deposit:</strong> {{ number_format($agreement->initial_deposit) }} TZS</p>
                                                        <p><strong>installment amount:</strong> {{ number_format($agreement->installment_amount) }} TZS <small>/{{ $agreement->rental_type }}</small></p>
                                                        <p><strong>Interest Agreed:</strong> {{ number_format($agreement->profit_percentage) }} %</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p><strong>Payment Mode:</strong> {{ $agreement->payment_mode }}</p>
                                                        <p><strong>Lease type</strong> {{ $agreement->lease_type }}</p>
                                                        <p><strong>Agreement Status:</strong> {{ ($agreement->status) }} </p>

                                                        <p><strong>Comments</strong> {{ $agreement->remarks }}</p>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                        <!-- to show the edit form after click edit button -->

                                        <!-- JS to enable buttons only if T&C checked -->
                                        <script>
                                            document.getElementById('acceptTerms').addEventListener('change', function () {
                                                let decisionButtons = document.querySelectorAll('.action-btn');
                                                decisionButtons.forEach(btn => {
                                                    btn.disabled = !this.checked;
                                                });
                                            });
                                        </script>

                                    </div>

                                </div>




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
    // Ensure script runs after DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        var editBtn = document.getElementById('editBtn');
        var agreementDetailsCheck = document.getElementById('agreementDetailsCheck');
        var editForm = document.getElementById('editForm');
        var  detailsBtn = document.getElementById('detailsBtn');
        detailsBtn.style.display = 'none'; // Hide details button initially

        editBtn.addEventListener('click', function() {
            editForm.style.display = 'block'; // Show the form
            // Optional: scroll into view
            editForm.scrollIntoView({ behavior: 'smooth' });
            agreementDetailsCheck.style.display = 'none';
            detailsBtn.style.display = 'inline-block';
        });

        detailsBtn.addEventListener('click', function() {
            editForm.style.display = 'none'; // Hide the form
            agreementDetailsCheck.style.display = 'block';
            detailsBtn.style.display = 'none'; // Hide details button again
            // Optional: scroll into view
            agreementDetailsCheck.scrollIntoView({behavior: 'smooth'});
        });
    });
</script>

<script>
    $(document).ready(function () {

        // ACCEPT OR REJECT SUBMISSION (AJAX)
        $(".loanActionForm").submit(function (e) {
            e.preventDefault();

            let form = $(this);
            let submitBtn = form.find("#submitButton");
            let btnText = submitBtn.find(".btn-text");
            let spinner = submitBtn.find(".spinner-border");

            // Show spinner
            btnText.addClass("d-none");
            spinner.removeClass("d-none");
            submitBtn.prop("disabled", true);

            $.ajax({
                url: "#",
                type: "POST",
                data: form.serialize(),
                success: function (response) {
                    let data = response.Data;

                    // If loan accepted → redirect to payment page
                    if (data && data.redirect_url) {
                        window.location.href = data.redirect_url;
                    }
                    // If loan rejected → reload page
                    if (data && data.status === "REJECTED") {
                        window.location.href ='/driver/loan-list'
                    }
                },
                error: function (xhr) {
                    alert("Something went wrong!");
                    btnText.removeClass("d-none");
                    spinner.addClass("d-none");
                    submitBtn.prop("disabled", false);
                }
            });
        });

    });
</script>


