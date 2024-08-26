@extends("admin.template")
@section("content")
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Data Table
                </li>
            </ol>
        </nav>
        <div
            class="d-flex justify-content-between align-items-center grid-margin flex-wrap"
        >
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a
                href="{{ route("data-admin.create") }}"
                class="d-flex btn btn-primary btn-icon-text mb-md-0 mb-2"
            >
                <i class="btn-icon-prepend" data-feather="plus"></i>
                Add Admin
            </a>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Admin</h6>
                        <div class="table-responsive tw-h-[100vh]">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Admin ID</th>
                                        <th>Nama Admin</th>
                                        <th>Email</th>
                                        <th>Role</th> 
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td> <!-- Add this line -->
                                            <td>{{ $admin->role }}</td>
                                            <td>
                                                <div class="d-flex tw-gap-4">
                                                    <a href="{{ route('data-admin.edit', $admin->id) }}" class="btn btn-lg btn-info">Edit</a>
                                                    <form action="{{ route('data-admin.destroy', $admin->id) }}" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Popups for Success Messages --}}
    @if(session('edit_success'))
        <div id="editSuccessModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
            <div class="bg-white p-6 rounded shadow-md text-center">
                <h2 class="text-xl font-bold text-primary">{{ session('edit_success') }}</h2>
            </div>
        </div>
    @endif

    @if(session('delete_success'))
        <div id="deleteSuccessModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
            <div class="bg-white p-6 rounded shadow-md text-center">
                <h2 class="text-xl font-bold text-primary">{{ session('delete_success') }}</h2>
            </div>
        </div>
    @endif

    @if(session('create_success'))
        <div id="createSuccessModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
            <div class="bg-white p-6 rounded shadow-md text-center">
                <h2 class="text-xl font-bold text-primary">{{ session('create_success') }}</h2>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check for session messages and display modals
            @if(session('edit_success'))
                showModal('editSuccessModal');
            @endif

            @if(session('delete_success'))
                showModal('deleteSuccessModal');
            @endif

            @if(session('create_success'))
                showModal('createSuccessModal');
            @endif
        });

        function showModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = 'flex';
            setTimeout(function() {
                modal.style.display = 'none';
            }, 3000); // Hide after 3 seconds
        }
    </script>
@endsection