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
                                            <th>Vehicle Owner</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Owner Number</th>
                                            <th>Status</th>
                                            <th>Registered On</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @forelse($ownerList as $index => $owner)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $owner['first_name'] ?? '' }} {{ $owner['last_name'] ?? '' }}</td>
                                                <td>{{ $owner['email'] ?? '-' }}</td>
                                                <td>{{ $owner['phone'] ?? '-' }}</td>
                                                <td>{{ $owner['address'] ?? '-' }}</td>
                                                <td>{{ $owner['userNumber'] ?? '-' }}</td>
                                                <td>
                                                    @if(($owner['status'] ?? '') === 'ACTIVE')
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $owner['created_at'] ?? '-' }}</td>

                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="{{ route('manager.owner_details', ['ownerNumber' => $owner['userNumber']]) }}">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-3">
                                                    No owners found.
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
