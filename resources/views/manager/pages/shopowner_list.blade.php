@include('assets.css')

<div class="container-scroller">

    @include('layout.manager.header')

    <div class="container-fluid page-body-wrapper">

        @include('layout.manager.sidebar')

        <div class="main-panel">
            <div class="content-wrapper p-4">

                <div class="row">
                    <div class="col-12">

                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title text-primary mb-0">
                                        <i class="mdi mdi-account-tie"></i> Shop Owner List
                                    </h4>

                                    <a href="{{ route('manager.shopOwner_register') }}" class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-account-plus"></i> Add New Shop Owner
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table id="landlordTable" class="table table-hover align-middle text-center">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Landlord Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>User Number</th>
                                            <th>Status</th>
                                            <th>Joined On</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @forelse($shopOwner as $index => $shop)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>

                                                <td>{{ $shop['first_name'] }} {{ $shop['last_name'] }}</td>

                                                <td>{{ $shop['email'] ?? '-' }}</td>

                                                <td>{{ $shop['phone'] ?? '-' }}</td>

                                                <td>{{ $shop['address'] ?? '-' }}</td>

                                                <td>{{ $shop['userNumber'] ?? '-' }}</td>

                                                <td>
                                                    @if(($shop['status'] ?? '') === 'ACTIVE')
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                <td>{{ \Carbon\Carbon::parse($shop['created_at'])->format('Y-m-d') }}</td>

                                                <td><a class="btn btn-primary btn-sm" href="">View</a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-3">
                                                    No landlords found.
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

            @include('layout.footer')

        </div>

    </div>
</div>

@include('assets.js')

<script>
    $(document).ready(function() {
        $('#landlordTable').DataTable({
            pageLength: 10,
            order: [[0, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search landlords..."
            }
        });
    });
</script>
