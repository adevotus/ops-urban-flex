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
                                    
                                    <!-- RIGHT SIDE -->
                                    <div class="col-lg-12">
                                       <a href="{{route('manager.owner_transactions_list')}}" class="btn btn-primary btn-sm"><i class="ti-arrow-circle-left"></i></a>
                                        <h4 class="mb-4 mt-3">Payment History List</h4>

                                        <!-- Remarks -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                            </div>
                                          @if (empty($transactionList))
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">
                                                        No repayments have been made.
                                                    </td>
                                                </tr>
                                            @else
                                                <table class="table table-hover align-middle text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>Transaction Date</th>
                                                        <th>Loan Number</th>
                                                        <th>Type</th>
                                                        <th>Total Amount</th>
                                                        <th>Transaction ID</th>
                                                        <th>Vehicle Owner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                   @foreach ($transactionList['transactions'] as $repayment)
                                                    <tr>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($repayment['created_at'])->format('d M Y H:i') }}
                                                        </td>
                                                        <td>{{ $repayment['loan_number'] }}</td>
                                                        <td>{{ $repayment['type'] }}</td>
                                                        <td>{{ number_format($repayment['amount']) }} TZS</td>
                                                        <td>{{ $repayment['transaction_id'] }}</td>
                                                        <td>{{ $repayment['vehicle_owner'] }}</td>
                                                    </tr>
                                                @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr class="fw-bold">
                                                        <td colspan="3" style="font-weight: bold;">TOTAL</td>
                                                        <td style="font-weight: bold;">{{ number_format($totalPaidAmount) }} TZS</td>
                                                        <td colspan="2"></td>
                                                    </tr>
                                                    </tfoot>
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


