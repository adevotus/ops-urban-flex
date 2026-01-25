@include('assets.css')
<div class="container-scroller">
    @include('layout.manager.header')

    <div class="container-fluid page-body-wrapper">
        @include('layout.manager.sidebar')

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
                                    echo $hour < 12 ? 'Morning' : ($hour < 16 ? 'Afternoon' : 'Evening');
                                @endphp,
                                {{ $user['first_name'] ?? $user['name'] ?? 'Manager' }} 👋
                            </h3>
                            <p class="text-muted mb-0">Welcome back! Here’s your Property Management overview.</p>
                        @endif
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 bg-primary text-white">
                            <div class="card-body">
                                <h6>Total Landlords</h6>
                                <h3 class="fw-bold">42</h3>
                                <small>Registered landlords</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 bg-success text-white">
                            <div class="card-body">
                                <h6>Total Tenants</h6>
                                <h3 class="fw-bold">168</h3>
                                <small>Active tenants</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 bg-warning text-dark">
                            <div class="card-body">
                                <h6>Total Properties</h6>
                                <h3 class="fw-bold">73</h3>
                                <small>Houses & Apartments</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 bg-info text-white">
                            <div class="card-body">
                                <h6>Active Agreements</h6>
                                <h3 class="fw-bold">58</h3>
                                <small>Valid rental contracts</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row mb-4">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">📈 Monthly Rent Collection</h5>
                                <canvas id="rentChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">💰 Payment Status</h5>
                                <canvas id="paymentChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">🏘 Occupancy Rate</h5>
                                <canvas id="occupancyChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tables -->
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
                                            <th>Tenant</th>
                                            <th>Property</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>Unit 12A</td>
                                            <td>350,000</td>
                                            <td>02 Jan 2026</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                        </tr>
                                        <tr>
                                            <td>Mary Grace</td>
                                            <td>Unit 5C</td>
                                            <td>420,000</td>
                                            <td>01 Jan 2026</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td>Anthony Musa</td>
                                            <td>Unit 3B</td>
                                            <td>300,000</td>
                                            <td>30 Dec 2025</td>
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
                                            <th>Tenant</th>
                                            <th>Property</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>Unit 12A</td>
                                            <td>01 Jan 2025</td>
                                            <td>31 Dec 2025</td>
                                            <td><span class="badge bg-warning">Expiring Soon</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lilian Francis</td>
                                            <td>Unit 9C</td>
                                            <td>15 Feb 2025</td>
                                            <td>14 Feb 2026</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Michael Kim</td>
                                            <td>Unit 2A</td>
                                            <td>10 Apr 2025</td>
                                            <td>09 Apr 2026</td>
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

            @include('layout.footer')
        </div>

    </div>
</div>

@include('assets.js')

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Rent Chart
    new Chart(document.getElementById('rentChart'), {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov'],
            datasets: [{
                label: 'Rent Collected (TZS)',
                data: [9000000,8500000,9100000,9800000,10000000,11000000,11500000,12000000,12500000,13000000,14000000],
                backgroundColor: '#4b7bec'
            }]
        }
    });

    // Payment Status Chart
    new Chart(document.getElementById('paymentChart'), {
        type: 'pie',
        data: {
            labels: ['Paid', 'Pending', 'Overdue'],
            datasets: [{
                data: [70, 20, 10],
                backgroundColor: ['#00b894','#fdcb6e','#d63031']
            }]
        }
    });

    // Occupancy Chart
    new Chart(document.getElementById('occupancyChart'), {
        type: 'doughnut',
        data: {
            labels: ['Occupied', 'Vacant'],
            datasets: [{
                data: [85, 15],
                backgroundColor: ['#0984e3', '#b2bec3']
            }]
        }
    });
</script>
