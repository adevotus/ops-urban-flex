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
                                        <i class="mdi mdi-account-tie"></i> Agreement  List
                                    </h4>
                                </div>

                                <div class="table-responsive">
                                    <table id="driverTable" class="table table-hover align-middle text-center">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Agreement No</th>
                                            <th>Rental Type</th>
                                            <th>Lease Type</th>
                                            <th>Vehicle Price (TZS)</th>
                                            <th>Deposit (TZS)</th>
                                            <th>Final Loan (TZS)</th>
                                            <th>Installment (TZS)</th>
                                            <th>Profit %</th>
                                            <th>Duration</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Payment Mode</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @forelse($agreementList as $index => $agreement)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>

                                            <td>{{ $agreement['agreement_number'] ?? '-' }}</td>

                                            <td>{{ ucfirst($agreement['rental_type'] ?? '-') }}</td>

                                            <td>{{ ucfirst(str_replace('_', ' ', $agreement['lease_type'] ?? '-')) }}</td>

                                            <td>{{ number_format($agreement['vehicle_price'] ?? 0) }}</td>

                                            <td>{{ number_format($agreement['initial_deposit'] ?? 0) }}</td>

                                            <td>{{ number_format($agreement['final_loan_amount'] ?? 0) }}</td>

                                            <td>{{ number_format($agreement['installment_amount'] ?? 0) }}</td>

                                            <td>{{ $agreement['profit_percentage'] ?? '-' }}%</td>

                                            <td>{{ $agreement['rental_duration'] ?? '-' }}</td>

                                            <td>{{ $agreement['agreement_start_date'] ?? '-' }}</td>

                                            <td>{{ $agreement['agreement_end_date'] ?? '-' }}</td>

                                            <td>{{ ucfirst(str_replace('_', ' ', $agreement['payment_mode'] ?? '-')) }}</td>

                                            {{-- Status --}}
                                            <td>
                                                @if(($agreement['status'] ?? '') === 'ACTIVE')
                                                <span class="badge bg-success">Active</span>
                                                @else
                                                <span class="badge bg-secondary">{{ $agreement['status'] }}</span>
                                                @endif
                                            </td>

                                            {{-- Actions --}}
                                            <td>
                                                <a href="{{url('/manager/client-agreement-details/'.$agreement['agreement_number'].'/'.$agreement['owner_number']) }}" class="btn btn-primary btn-sm">View</a>
                                            </td>

                                        </tr>

                                        @empty
                                        <tr>
                                            <td colspan="15" class="text-center text-muted py-3">
                                                No Agreements Found.
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
