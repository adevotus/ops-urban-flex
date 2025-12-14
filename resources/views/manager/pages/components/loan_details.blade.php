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
                                    <div class="col-lg-4">
                                        <a href="{{route('manager.loan-list')}}" class="btn btn-primary btn-sm"><i class="ti-arrow-circle-left"></i></a>

                                        <!-- Driver Info -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-body text-center">
                                                <img src="{{ asset('assets/images/faces/face12.jpg') }}" class="img-lg rounded-circle mb-3">

                                                <h5 class="fw-bold mb-1">Driver Number: {{ $loanDetails->driver_number }}</h5>
                                                <p class="text-muted small">Loan Applicant</p>

                                            </div>
                                        </div>

                                        <!-- Vehicle Info -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header fw-bold">Vehicle Details</div>
                                            <div class="card-body">
                                                {{--                                                <img src="{{ asset($loanDetails->vehicle->vehicle_picture) }}" class="w-100 rounded mb-3">--}}

                                                <p><strong>Vehicle No:</strong> {{ $loanDetails->vehicle->vehicle_number }}</p>
                                                <p><strong>Model:</strong> {{ $loanDetails->vehicle->vehicle_model }}</p>
                                                <p><strong>Type:</strong> {{ $loanDetails->vehicle->vehicle_type }}</p>
                                                <p><strong>Color:</strong> {{ $loanDetails->vehicle->vehicle_color }}</p>
                                                <p><strong>Status:</strong>
                                                    <span class="badge bg-warning">{{ $loanDetails->vehicle->status }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Agreement Info -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header fw-bold">Agreement Details</div>
                                            <div class="card-body">
                                                <p><strong>Agreement No:</strong> {{ $loanDetails->agreement->agreement_number }}</p>
                                                <p><strong>Rental Type:</strong> {{ $loanDetails->agreement->rental_type }}</p>
                                                <p><strong>Duration:</strong> {{ $loanDetails->agreement->rental_duration }}</p>
                                                <p><strong>Start:</strong> {{ $loanDetails->agreement->agreement_start_date }}</p>
                                                <p><strong>End:</strong> {{ $loanDetails->agreement->agreement_end_date }}</p>
                                                <p><strong>Initial Deposit:</strong> {{ number_format($loanDetails->agreement->initial_deposit) }} TZS</p>
                                                <p><strong>installment amount:</strong> {{ number_format($loanDetails->agreement->installment_amount) }} TZS <small>/{{ $loanDetails->agreement->rental_type }}</small></p>
                                                <p><strong>Interest Agreed:</strong> {{ number_format($loanDetails->agreement->profit_percentage) }} %</p>
                                                <p><strong>Agreement Status:</strong> {{ ($loanDetails->agreement->status) }} </p>
                                                <p><strong>Payment Mode:</strong> {{ $loanDetails->agreement->payment_mode }}</p>
                                                <p><strong>Lease type</strong> {{ $loanDetails->agreement->lease_type }}</p>
                                                <p><strong>Comments</strong> {{ $loanDetails->agreement->remarks }}</p>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- RIGHT SIDE -->
                                    <div class="col-lg-8">

                                        <!-- Loan Summary -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-body">

                                                <div class="d-flex justify-content-between">
                                                    <h4 class="fw-bold">Loan Summary</h4>
                                                    @php
                                                    $statusClass = match ($loanDetails->status) {
                                                    'ACCEPTED'  => 'bg-success',
                                                    'PROCESSING' => 'bg-warning text-dark',
                                                    'REJECTED'  => 'bg-danger',
                                                    default     => 'bg-info text-dark',
                                                    };
                                                    @endphp

                                                    <span class="badge {{ $statusClass }} px-3 py-2">
                                                        {{ $loanDetails->status }}
                                                    </span>
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><strong>Loan Number:</strong> {{ $loanDetails->loan_number }}</p>
                                                        <p><strong>Final Loan Amount:</strong> {{ number_format($loanDetails->final_loan_amount) }} TZS</p>
                                                        <p><strong>Installment:</strong> {{ number_format($loanDetails->installment_amount) }} TZS<small>/{{ $loanDetails->agreement->rental_type }}</small></p>
                                                        <p><stong>Description:</stong>{{$loanDetails->reason}}</p>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <p><strong>Interest :</strong> {{ $loanDetails->profit_percentage }}%</p>
                                                        <p><strong>Duration:</strong> {{ $loanDetails->rental_duration }}</p>
                                                        <p><strong>Owner Number:</strong> {{ $loanDetails->ownerNumber }}</p>
                                                        <p><stong>Updated Date:</stong>{{$loanDetails->updated_at}}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p><strong>Balance :</strong> {{number_format($loanDetails->balance) }}</p>
                                                        <p><strong>Total Paid:</strong> {{ number_format($loanDetails->paid_amount) }}</p>
                                                        <p><strong>TransactionId:</strong> {{ $loanDetails->transaction_id }}</p>
                                                        <p><stong>Start Date:</stong>{{$loanDetails->startDate}} - <stong>End Date:</stong>{{$loanDetails->endDate}}</p>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <p><strong>Loan Remarks</strong>{{ $loanDetails->loan_remarks }}</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Remarks -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h4 class="fw-bold mb-0">Repayments</h4>
                                            </div>
                                            @if ($loanRepayments->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center text-muted text-center">No Repayments has been made.</td>
                                            </tr>
                                            @else
                                            <table class="table table-hover align-middle text-center">
                                                <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Total Amount</th>
                                                    <th>Transaction ID</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($loanRepayments as $repayment)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($repayment->payment_date)->format('d M Y H:i') }}</td>
                                                    <td>{{ number_format($repayment->total_amount) }} TZS</td>
                                                    <td>{{ $repayment->transaction_id }}</td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @endif

                                        </div>


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
                                <!-- Accept Loan Modal -->
                                <div class="modal fade" id="acceptLoanModal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title">Confirm Loan Acceptance</h5>
                                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form class="loanActionForm" method="POST">
                                                @csrf
                                                <input type="hidden" name="loan_number" value="{{ $loanDetails->loan_number }}">
                                                <input type="hidden" name="status" value="ACCEPTED">

                                                <div class="modal-body">
                                                    <p>Are you sure you want to <strong>ACCEPT</strong> this loan?</p>
                                                    <p class="text-muted small">Once accepted, the repayment schedule will begin immediately.</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                                                    <button type="submit" id="submitButton" class="btn btn-success me-2">
                                                        <span class="btn-text">Yes, Accept</span>
                                                        <span class="spinner-border spinner-border-sm d-none"></span>
                                                    </button>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                                <!-- Reject Loan Modal -->
                                <div class="modal fade" id="rejectLoanModal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Reject Loan</h5>
                                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form class="loanActionForm" method="POST">
                                                @csrf
                                                <input type="hidden" name="loan_number" value="{{ $loanDetails->loan_number }}">
                                                <input type="hidden" name="status" value="REJECTED">

                                                <div class="modal-body">
                                                    <label class="fw-semibold">Reason for rejection:</label>
                                                    <textarea name="reason" class="form-control" rows="4" required placeholder="Explain why you are rejecting the loan..."></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                                                    <button type="submit" id="submitButton" class="btn btn-danger me-2">
                                                        <span class="btn-text">Submit Rejection</span>
                                                        <span class="spinner-border spinner-border-sm d-none"></span>
                                                    </button>
                                                </div>
                                            </form>


                                        </div>
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
    const acceptModal = new bootstrap.Modal(document.getElementById('acceptLoanModal'));
    const rejectModal = new bootstrap.Modal(document.getElementById('rejectLoanModal'));

    document.getElementById('openAcceptModal').addEventListener('click', () => {
        acceptModal.show();
    });

    document.getElementById('openRejectModal').addEventListener('click', () => {
        rejectModal.show();
    });

    const checkbox = document.getElementById("acceptTerms");
    const acceptBtn = document.getElementById("openAcceptModal");
    const rejectBtn = document.getElementById("openRejectModal");

    checkbox.addEventListener("change", function () {
        if (checkbox.checked) {
            acceptBtn.removeAttribute("disabled");
            rejectBtn.removeAttribute("disabled");
        } else {
            acceptBtn.setAttribute("disabled", true);
            rejectBtn.setAttribute("disabled", true);
        }
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


