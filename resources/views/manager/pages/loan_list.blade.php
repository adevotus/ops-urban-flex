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
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title text-primary mb-0">
                                        <i class="mdi mdi-account-tie"></i> Loan   List
                                    </h4>
                                    <!--                                    <a href="{{route('manager.owner-registration')}}" class="btn btn-primary btn-sm">-->
                                    <!--                                        <i class="mdi mdi-account-plus"></i> Create  Vehicle Owner-->
                                    <!--                                    </a>-->
                                </div>

                                <div class="table-responsive">
                                    <table id="driverTable" class="table table-hover align-middle text-center">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Loan Number</th>
                                            <th>Agreement No</th>
                                            <th>Driver Number</th>
                                            <th>Final Amount (TZS)</th>
                                            <th>Installment (TZS)</th>
                                            <th>Paid Amount (TZS)</th>
                                            <th>Balance (TZS)</th>
                                            <th>Profit %</th>
                                            <th>Rental Duration</th>
                                            <th>Status</th>
<!--                                            <th>State</th>-->
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @forelse($loanList as $index => $loan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>

                                            <td>{{ $loan['loan_number'] ?? '-' }}</td>

                                            <td>{{ $loan['agreement_number'] ?? '-' }}</td>

                                            <td>{{ $loan['driver_number'] ?? '-' }}</td>

                                            <td>{{ number_format($loan['final_loan_amount'] ?? 0, 2) }}</td>

                                            <td>{{ number_format($loan['installment_amount'] ?? 0, 2) }}</td>

                                            <td>{{ number_format($loan['paid_amount'] ?? 0, 2) }}</td>

                                            <td>{{ number_format($loan['balance'] ?? 0, 2) }}</td>

                                            <td>{{ $loan['profit_percentage'] ?? '-' }}%</td>

                                            <td>{{ $loan['rental_duration'] ?? '-' }}</td>

                                            {{-- Status --}}
                                            <td>
                                                @if(($loan['status'] ?? '') === 'ACCEPTED')
                                                <span class="badge bg-success">Accepted</span>
                                                @else
                                                <span class="badge bg-warning">{{ $loan['status'] ?? '-' }}</span>
                                                @endif
                                            </td>

                                            {{-- State --}}
<!--                                            <td>-->
<!--                                                @if(($loan['state'] ?? '') === 'ACTIVE')-->
<!--                                                <span class="badge bg-primary">Active</span>-->
<!--                                                @else-->
<!--                                                <span class="badge bg-secondary">{{ $loan['state'] ?? '-' }}</span>-->
<!--                                                @endif-->
<!--                                            </td>-->

                                            <td>{{ $loan['startDate'] ?? '-' }}</td>
                                            <td>{{ $loan['endDate'] ?? '-' }}</td>

                                            {{-- Actions --}}
                                            <td>
                                                <a href="{{ url('/manager/client-driver-loan-details/'.$loan['loan_number'].'/'.$loan['driver_number']) }}"
                                                   class="btn btn-primary btn-sm">
                                                    View
                                                </a>
                                            </td>
                                        </tr>

                                        @empty
                                        <tr>
                                            <td colspan="15" class="text-center text-muted py-3">
                                                No Loan Records Found.
                                            </td>
                                        </tr>
                                        @endforelse
                                        </tbody>



                                    </table>
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
    $(document).ready(function() {
        $('#driverTable').DataTable({
            pageLength: 5,
            order: [[0, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search drivers..."
            }
        });
    });
</script>
