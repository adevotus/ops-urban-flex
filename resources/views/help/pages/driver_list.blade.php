@include('assets.css')
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    @include('layout.help.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_settings-panel.html -->

        <!-- partial -->
        <!-- partial:../../partials/_sidebar.html -->
        @include('layout.help.sidebar')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-0">Driver  List</h4>
                                    <!-- Button to open modal -->
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

                    <!-- Add Staff Modal -->
                    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <form id="addStaffForm">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="addStaffModalLabel">Add New Operation Staff</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6 mt-2">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control form-control-sm" name="first_name" placeholder="Enter full name" required>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control form-control-sm" name="last_name" placeholder="Enter full name" required>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control form-control-sm" name="email" placeholder="Enter email address" required>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control form-control-sm" name="phone" placeholder="Enter phone number" required>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label">Role</label>
                                                <select class="form-select form-select-sm" name="role_id" required>
                                                    <option value="2">Manager</option>
                                                    <option value="3">Help Desk</option>
                                                    <option value="4">Owner</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" placeholder="Enter address">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Create Staff</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            @include('layout.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('assets.js')
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>--}}

<script>
    $(document).ready(function () {
        $('#staffTable').DataTable({
            pageLength: 5,
            lengthMenu: [5, 10, 20],
        });

        //
        // Handle Add Staff submission
        $('#addStaffForm').on('submit', function (e) {
            e.preventDefault();
            // Here, you can use AJAX to send the form data to your Laravel route
            alert('Staff saved successfully!');
            $('#addStaffModal').modal('hide');
            this.reset();
        });
    });
</script>
