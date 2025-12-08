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
                                        <i class="mdi mdi-account-tie"></i> Vehicle Owner  List
                                    </h4>
                                    <a href="{{route('manager.owner-registration')}}" class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-account-plus"></i> Create  Vehicle Owner
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table id="driverTable" class="table table-hover align-middle text-center">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Driver Name</th>
                                            <th>Address</th>
                                            <th>License No.</th>
                                            <th>Nida No.</th>
                                            <th>Phone</th>
                                            <th>Assigned Vehicle</th>
                                            <th>Status</th>
                                            <th>Registered On</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Sample Data -->

{{--                                        @foreach($driverList as $driver)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{ $loop->iteration }}</td>--}}

{{--                                                --}}{{-- DRIVER NAME FROM additional_info --}}
{{--                                                <td>--}}
{{--                                                    {{ $driver->additional_info['first_name'] ?? '' }}--}}
{{--                                                    {{ $driver->additional_info['last_name'] ?? '' }}--}}
{{--                                                </td>--}}

{{--                                                <td>{{ $driver->additional_info['address'] ?? '—' }}</td>--}}

{{--                                                <td>{{ $driver->license_number }}</td>--}}
{{--                                                <td>{{ $driver->nida_number }}</td>--}}

{{--                                                <td>{{ $driver->additional_info['phone'] ?? '' }}</td>--}}

{{--                                                <td>--}}
{{--                                                    --}}{{-- Example vehicle placeholder (update later if available) --}}
{{--                                                    {{ $driver->vehicle ?? '—' }}--}}
{{--                                                </td>--}}

{{--                                                <td>--}}
{{--                                                    <span class="badge bg-success">{{ $driver->license_status }}</span>--}}
{{--                                                </td>--}}

{{--                                                <td>{{ \Carbon\Carbon::parse($driver->created_at)->format('d M Y') }}</td>--}}

{{--                                                <td>--}}
{{--                                                    <button class="btn btn-outline-success btn-sm me-1">--}}
{{--                                                        <i class="icon-eye menu-icon text-center"></i>--}}
{{--                                                    </button>--}}
{{--                                                    <button class="btn btn-outline-danger btn-sm">--}}
{{--                                                        <i class="icon-trash menu-icon"></i>--}}
{{--                                                    </button>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}

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
