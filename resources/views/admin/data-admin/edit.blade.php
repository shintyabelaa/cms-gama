@extends('admin.template')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/easymde/easymde.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center grid-margin flex-wrap">
            <div>
                <h4 class="mb-md-0 mb-3">Tambah Admin</h4>
            </div>
        </div>
        <div class="row w-100 mx-0 auth-page">
            <div class="mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="ps-md-0">
                            <div class="auth-form-wrapper px-4 pt-2 pb-5">
                                <form action="{{ route('data-admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $admin->name }}" placeholder="Nama">
                                        @error('name')
                                        <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $admin->email }}" placeholder="Email">
                                        @error('email')
                                        <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Leave blank if not changing">
                                        @error('password')
                                        <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                    <label class="form-label">Role</label>
                                    <select name="role" class="select2 form-select @error('role') is-invalid @enderror" data-width="100%">
                                        <option disabled>Pilih Role</option>
                                        <option value="owner" {{ $admin->role == 'owner' ? 'selected' : '' }}>Owner</option>
                                        <option value="kasir" {{ $admin->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                        <option value="dapur" {{ $admin->role == 'dapur' ? 'selected' : '' }}>Dapur</option>
                                    </select>
                                    @error('role')
                                    <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                                    
                                    <button class="btn btn-primary" type="submit">Edit Admin</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendors/easymde/easymde.min.js') }}"></script>
    <script src="{{ asset('assets/js/easymde.js') }}"></script>
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endsection
