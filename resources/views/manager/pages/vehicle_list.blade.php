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
                                        <i class="mdi mdi-account-tie"></i> Vehicle   List
                                    </h4>
                                </div>

                                <div class="table-responsive">
                                    <table id="driverTable" class="table table-hover align-middle text-center">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Vehicle No</th>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Color</th>
                                            <th>Condition</th>
                                            <th>Capacity</th>
                                            <th>Reg Number</th>
                                            <th>Owner Name</th>
                                            <th>Owner Number</th>
                                            <th>Registration Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @forelse($vehicleList as $index => $vehicle)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>

                                            <td>{{ $vehicle['vehicle_number'] ?? '-' }}</td>

                                            <td>{{ $vehicle['vehicle_model'] ?? '-' }}</td>

                                            <td>{{ $vehicle['vehicle_type'] ?? '-' }}</td>

                                            <td>{{ $vehicle['vehicle_color'] ?? '-' }}</td>

                                            <td>{{ $vehicle['vehicle_condition'] ?? '-' }}</td>

                                            <td>{{ $vehicle['capacity'] ?? '-' }}</td>

                                            <td>{{ $vehicle['vehicle_reg_number'] ?? '-' }}</td>

                                            <td>{{ ucfirst($vehicle['owner_name'] ?? '-') }}</td>

                                            <td>{{ $vehicle['owner_number'] ?? '-' }}</td>

                                            <td>{{ $vehicle['registration_date'] ?? '-' }}</td>

                                            {{-- Status --}}
                                            <td>
                                                @if(($vehicle['status'] ?? '') === 'LOANED')
                                                <span class="badge bg-warning">Loaned</span>
                                                @else
                                                <span class="badge bg-success">{{ $vehicle['status'] ?? '-' }}</span>
                                                @endif
                                            </td>

                                            {{-- Actions --}}
                                            <td>
                                                <button class="btn btn-primary btn-sm">View</button>
                                            </td>
                                        </tr>

                                        @empty
                                        <tr>
                                            <td colspan="13" class="text-center text-muted py-3">
                                                No Vehicles Found.
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
