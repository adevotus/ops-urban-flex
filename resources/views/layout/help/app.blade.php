@include('assets.css')
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layout.help.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        @include('layout.help.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper p-4">
                <!-- Greeting -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        @if(session('user'))
                            @php $user = session('user'); @endphp
                            <h3 class="font-weight-bold text-primary mb-1">
                                Good
                                @php
                                    $hour = now()->hour;
                                    if ($hour < 12) echo 'Morning';
                                    elseif ($hour < 16) echo 'Afternoon';else echo 'Evening';
                                @endphp,
                                {{ $user['first_name'] ?? $user['name'] ?? 'manager' }} 👋
                            </h3>
                            <p class="text-muted mb-0">Welcome back! Here’s a summary of your vehicle and payment progress.</p>
                        @endif
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 bg-primary text-white">
                            <div class="card-body">
                                <h6 class="mb-2">Total Vehicles Registered</h6>
                                <h3 class="fw-bold">8</h3>
                                <small>Across all categories</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 bg-success text-white">
                            <div class="card-body">
                                <h6 class="mb-2">Active Drivers</h6>
                                <h3 class="fw-bold">6</h3>
                                <small>Currently assigned drivers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 bg-warning text-dark">
                            <div class="card-body">
                                <h6 class="mb-2">Total Owner</h6>
                                <h3 class="fw-bold">40</h3>
                                <small>Registered Vehicle Owner</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card card-tale shadow-sm border-0 rounded-3 text-white">
                            <div class="card-body">
                                <h6 class="mb-2">Active Agreements</h6>
                                <h3 class="fw-bold">5</h3>
                                <small>Currently valid rental agreements</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tables Section -->
                <div class="row">
                    <!-- Recent Payments -->
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">💳 Recent Payments</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Driver</th>
                                            <th>Vehicle</th>
                                            <th>Amount (TZS)</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Peter Mwangi</td>
                                            <td>T 234 DFG</td>
                                            <td>75,000</td>
                                            <td>03 Nov 2025</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                        </tr>
                                        <tr>
                                            <td>Grace Mutua</td>
                                            <td>T 451 ABC</td>
                                            <td>60,000</td>
                                            <td>02 Nov 2025</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td>James Njoroge</td>
                                            <td>T 982 KLM</td>
                                            <td>85,000</td>
                                            <td>01 Nov 2025</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                        </tr>
                                        <tr>
                                            <td>Brian Otieno</td>
                                            <td>T 111 JKL</td>
                                            <td>40,000</td>
                                            <td>31 Oct 2025</td>
                                            <td><span class="badge bg-danger">Overdue</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expiring Agreements -->
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">📑 Expiring Agreements</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Driver</th>
                                            <th>Vehicle</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Peter Mwangi</td>
                                            <td>T 234 DFG</td>
                                            <td>01 Jan 2025</td>
                                            <td>31 Dec 2025</td>
                                            <td><span class="badge bg-warning">Expiring Soon</span></td>
                                        </tr>
                                        <tr>
                                            <td>Grace Mutua</td>
                                            <td>T 451 ABC</td>
                                            <td>15 Feb 2025</td>
                                            <td>14 Feb 2026</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>James Njoroge</td>
                                            <td>T 982 KLM</td>
                                            <td>20 Apr 2025</td>
                                            <td>19 Apr 2026</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Brian Otieno</td>
                                            <td>T 111 JKL</td>
                                            <td>10 Mar 2025</td>
                                            <td>09 Mar 2026</td>
                                            <td><span class="badge bg-warning">Expiring Soon</span></td>
                                        </tr>
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
    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @endif
</script>
