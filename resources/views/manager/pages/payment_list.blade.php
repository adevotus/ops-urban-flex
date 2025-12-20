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
                                        <i class="mdi mdi-account-tie"></i> Payments
                                    </h4>
                                </div>

                                <div class="table-responsive mt-4">
                                    <table id="paymentTable" class="table table-hover align-middle text-center">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Agreement No.</th>
                                            <th>Loan No.</th>
                                            <th>Driver Name</th>
                                            <th>Driver No.</th>
                                            <th>Vehicle</th>
                                            <th>Total Loan (TZS)</th>
                                            <th>Weekly Payment (TZS)</th>
                                            <th>Weeks Paid</th>
                                            <th>Remaining Balance (TZS)</th>
                                            <th>Next Due Date</th>
                                            <th>Owner Number</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                       @forelse($paymentList as $index => $payment)
                                       <tr>
                                           <td>{{ $index + 1 }}</td>

                                           <td>{{ $payment['agreement_number'] }}</td>

                                           <td>{{ $payment['loan_number'] }}</td>


                                           <td>{{ $payment['driver_name'] ?? 'N/A' }}</td>

                                           <td>{{ $payment['driver_number'] }}</td>

                                           <td>{{ $payment['vehicle'] }}</td>

                                           <td>{{ number_format($payment['total_loan'], 0) }}</td>

                                           <td>{{ number_format($payment['payment_rental'], 0) }}</td>

                                           <td>{{ $payment['weeks_paid'] }}</td>

                                           <td>{{ number_format($payment['remaining_balance'], 0) }}</td>

<!--                                            {{-- Handle empty next_due_date --}}-->
                                           <td>
                                               @if($payment['next_due_date'])
                                               {{ \Carbon\Carbon::parse($payment['next_due_date'])->format('d M Y') }}
                                               @else
                                               <span class="badge bg-secondary">Completed</span>
                                               @endif
                                           </td>
                                           <td>{{$payment['owner_number']}}</td>

<!--                                            {{-- Status --}}-->
                                           <td>
                                               @if($payment['status'] === 'ACCEPTED')
                                               <span class="badge bg-success">On Track</span>
                                               @else
                                               <span class="badge bg-warning">{{ $payment['status'] }}</span>
                                               @endif
                                           </td>

                                           <td>
                                               <a href="{{ route('manager.payment_transactions_driver_list', ['loanNumber' => $payment['loan_number'], 'driverNumber' => $payment['driver_number']]) }}" class="btn btn-primary btn-sm me-1" title="View Details">
                                                   <i class="mdi mdi-eye"></i>
                                                   view
                                               </a>

                                           </td>
                                       </tr>
                                       @empty
                                       <tr>
                                           <td colspan="14" class="text-center text-muted">
                                               No payment records found
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
        $('#paymentTable').DataTable({
            pageLength: 5,
            order: [[0, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search drivers..."
            }
        });
    });
</script>
