@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5 text-white">Add Banner</h1>
    </div>
    <div class="container bg-white p-3 rounded shadow-sm">
        <form action="">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Title"
                    value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="filepath" value="{{ old('filepath') }}">
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                    placeholder="Write some text..." value="{{ old('description') }}" required></textarea>
            </div>
            <label for="condition" class="form-label">Condition</label>
            <select name="condition" id="condition" class="form-select">
                <option>--Condition--</option>
                <option value="banner" {{ old('condition') == 'banner' ? 'selected' : '' }}>Banner</option>
                <option value="promo" {{ old('condition' == 'promo' ? 'selected' : '') }}>Promo</option>
            </select>
            <select name="status" id="status" class="form-select mt-3">
                <option>--Status--</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status' == 'inactive' ? 'selected' : '') }}>Inactive</option>
            </select>
            <button class="btn btn-primary mt-3">Submit</button>
            <button class="btn btn-outline-light mt-3 text-dark">Cancel</button>
        </form>
    </div>
@endsection

@section('js')
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
