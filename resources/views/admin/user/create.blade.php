@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Add User</h1>
    </div>
    <div class="container bg-white p-3 rounded shadow-sm">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <p class="text-white">{{ $error }}</p>
                </div>
            @endforeach
        @endif
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input name="full_name" type="text" class="form-control" id="full_name" placeholder="Full Name"
                    value="{{ old('full_name') }}" required>
            </div>
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Photo</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ old('photo') }}">
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="text" class="form-control" id="email" placeholder="Email"
                    value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="text" class="form-control" id="password" placeholder="Password"
                    value="{{ old('password') }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone"
                    value="{{ old('phone') }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input name="address" type="text" class="form-control" id="address" placeholder="Address"
                    value="{{ old('address') }}" required>
            </div>
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select">
                <option>--Role--</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ old('role' == 'customer' ? 'selected' : '') }}>Customer</option>
                <option value="vendor" {{ old('role' == 'vendor' ? 'selected' : '') }}>Vendor</option>
            </select>
            <label for="status" class="form-label mt-3">Status</label>
            <select name="status" id="status" class="form-select">
                <option>--Status--</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status' == 'inactive' ? 'selected' : '') }}>Inactive</option>
            </select>
            <button class="btn btn-primary mt-3">Submit</button>
            <a href="{{ route('user.index') }}" class="btn btn-outline-light mt-3 text-dark">Cancel</a>
        </form>
    </div>
@endsection

@section('scripts')
    {{-- file manager --}}
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>

    {{-- summernote --}}
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
