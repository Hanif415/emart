@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Add Category</h1>
    </div>
    <div class="container bg-white p-3 rounded shadow-sm">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <p class="text-white">{{ $error }}</p>
                </div>
            @endforeach
        @endif
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Title"
                    value="{{ old('title') }}" required>
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
                <label for="summary" class="form-label">Summary</label>
                <textarea name="summary" id="summary" class="form-control" cols="30" rows="10"
                    placeholder="Write some text...">{{ old('summary') }}</textarea>
            </div>
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option>--Status--</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status' == 'inactive' ? 'selected' : '') }}>Inactive</option>
            </select>
            <div class="form-check mt-3">
                <input id="is_parent" class="form-check-input" type="checkbox" name="is_parent" value="1">
                <label class="form-check-label" for="is_parent">Is Parent</label>
            </div>
            <div id="parent-category" class="mt-3">
                <label for="parent-category" class="form-label">Parent Category</label>
                <select name="parent_id" class="form-select">
                    <option value="">--Parent Category--</option>
                    @foreach ($parent_categories as $parent_category)
                        <option value="{{ $parent_category->id }}"
                            {{ old('parent_id') == $parent_category->id ? 'selected' : '' }}>{{ $parent_category->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary mt-3">Submit</button>
            <a href="{{ route('category.index') }}" class="btn btn-outline-light mt-3 text-dark">Cancel</a>
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
            $('#summary').summernote();
        });
    </script>

    {{-- parent category hide --}}
    {{-- <script>
        $(document).ready(function() {
            var isChecked = $('#is_parent').prop('checked');
            if (isChecked) {
                $('#parent-category').addClass('d-none');
            } else {
                $('#parent-category').removeClass('d-none');
            }
        });
    </script> --}}
    <script>
        $('#is_parent').change(function(e) {
            e.preventDefault();
            var isChecked = $('#is_parent').prop('checked');
            if (isChecked) {
                $('#parent-category').addClass('d-none');
                $('#parent-category').val('');
            } else {
                $('#parent-category').removeClass('d-none');
            }
        });
    </script>

    {{-- terminated checkbox --}}
    {{-- <script>
        document.getElementById("is_parent").indeterminate = true;
    </script> --}}
@endsection
