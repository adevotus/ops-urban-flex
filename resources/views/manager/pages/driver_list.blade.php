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
                                        <i class="mdi mdi-account-tie"></i> Vehicle Driver  List
                                    </h4>
<!--                                    <a href="{{route('manager.owner-registration')}}" class="btn btn-primary btn-sm">-->
<!--                                        <i class="mdi mdi-account-plus"></i> Register  Driver-->
<!--                                    </a>-->
                                </div>

                                <div class="table-responsive">
                                    <table id="driverTable" class="table table-hover align-middle text-center">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Driver Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Owner Number</th>
                                            <th>License Number</th>
                                            <th>License Status</th>
<!--                                            <th>License Expire Date</th>-->
                                            <th>NIDA Number</th>
                                            <th>Current Status</th>
<!--                                            <th>Remarks</th>-->
<!--                                            <th>Registered On</th>-->
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @forelse($driverList as $index => $driver)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>


                                            <td>
                                                {{ $driver['additional_info']['first_name'] ?? '' }}
                                                {{ $driver['additional_info']['last_name'] ?? '' }}
                                            </td>

                                            <td>{{ $driver['additional_info']['email'] ?? '-' }}</td>

                                            <td>{{ $driver['additional_info']['phone'] ?? '-' }}</td>

                                            <td>{{ $driver['additional_info']['gender'] ?? '-' }}</td>

                                            <td>{{ $driver['additional_info']['address'] ?? '-' }}</td>

                                            <td>{{ $driver['additional_info']['userNumber'] ?? '-' }}</td>

                                            <td>{{ $driver['license_number'] ?? '-' }}</td>

                                            <td>{{ $driver['license_status'] ?? '-' }}</td>

                                            <td>{{ $driver['nida_number'] ?? '-' }}</td>

                                            <td>{{ $driver['current_status'] ?? '-' }}</td>


                                            {{-- Actions --}}
                                            <td>
                                                <button class="btn btn-primary btn-sm">View</button>
                                            </td>
                                        </tr>

                                        @empty
                                        <tr>
                                            <td colspan="15" class="text-center text-muted py-3">
                                                No Driver Found.
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
