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
    <!-- LEFT SIDE: Owner Info -->
    <div class="col-lg-4">
        <a href="{{ route('manager.owner-list') }}" class="btn btn-primary btn-sm mb-3">
            <i class="ti-arrow-circle-left"></i> Owner List
        </a>

        <!-- Owner Info -->
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('assets/images/faces/face12.jpg') }}" class="img-lg rounded-circle mb-3">
                <h4 class="text-muted text-center">Owner Number: {{ $ownerData['userNumber'] }}</h4>
                 <p class="text-center">Vehicle Owner</p>
            
              
            </div>
        </div>
         <!-- Vehicle Info -->
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">Owner Details</div>
            <div class="card-body">

                <p><strong>name No:</strong> {{ $ownerData['first_name'] }} {{ $ownerData['last_name'] }}</p>
                <p><strong>Phone:</strong> {{ $ownerData['phone'] }}</p>
                <p><strong>Email:</strong> {{ $ownerData['email'] }}</p>
                <p><strong>Address:</strong>  {{ $ownerData['address'] }}</p>
                <p><strong>Status:</strong><span class="badge {{ $ownerData['status'] === 'ACTIVE' ? 'bg-success' : 'bg-secondary' }}">      {{ $ownerData['status'] }} </span>                                                </p>
            </div>
        </div>

        <!-- Collection Info -->
        @if($collectionData->isNotEmpty())
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">Collection Account</div>
            <div class="card-body">
                @foreach($collectionData as $collection)
                    <p><strong>Method:</strong> {{ $collection->collection_method }}</p>
                    <p><strong>Account Number:</strong> {{ $collection->account_number }}</p>
                    <p><strong>Account Name:</strong> {{ $collection->account_name }}</p>
                    <p><strong>Collection Day:</strong> {{ $collection->collection_day }}</p>
                    <p><strong>Notes:</strong> {{ $collection->collection_notes }}</p>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- RIGHT SIDE: Agreements -->
                <div class="col-lg-8">
                    @if($agreementData->isNotEmpty())
                        @foreach($agreementData as $agreement)
                            <div class="card shadow-sm mb-4">
                                <div class="card-header fw-bold">Agreement Details</div>
                                <div class="card-body">
                                  <div class=row>
                                  <div class="col-md-4">
                                    <p><strong>Agreement Number:</strong> {{ $agreement->agreement_number }}</p>
                                    <p><strong>Type:</strong> {{ ucfirst($agreement->agreement_type) }}</p>
                                    <p><strong>Profit Percentage:</strong> {{ $agreement->profit_percentage }}%</p>
                                  </div>
                                 <div class="col-md-4">
                                    <p><strong>Payment Mode:</strong> {{ ucfirst($agreement->payment_mode) }}</p>
                                    <p><strong>Penalty Percentage:</strong> {{ $agreement->penalty_percentage }}%</p>
                                    <p><strong>Status:</strong> <span class="badge {{ $agreement->status === 'ACTIVE' ? 'bg-success' : 'bg-secondary' }}"> {{ $agreement->status }} </span>
                                    </p>

                                 </div>
                                  <div class="col-md-4">
                                     <p><strong>Notes:</strong> {{ $agreement->agreements_notes }}</p>
                                    <p><strong>Start Date:</strong> {{ $agreement->created_at->format('d M Y') }}</p>
                                    <p><strong>Updated:</strong> {{ $agreement->updated_at->format('d M Y') }}</p>
                                  </div>
                                   
                                  </div>
    
                                   
                           
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">No agreements found for this owner.</div>
                    @endif
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


