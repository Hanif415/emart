@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Add Banner</h1>
    </div>
    <div class="container bg-white p-3 rounded shadow-sm">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <p class="text-white">{{ $error }}</p>
                </div>
            @endforeach
        @endif
        <form action="{{ route('banner.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Title"
                    value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <textarea name="summary" id="summary" class="form-control" placeholder="Some Text...">{{ old('summary') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                    placeholder="Write some text...">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <select name="brand" id="brand" class="form-select">
                    <option value="">--Brand--</option>
                    @foreach (App\Models\Brand::get() as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="vendor" class="form-label">Vendor</label>
                <select name="vendor" id="vendor" class="form-select">
                    <option value="">--Vendor--</option>
                    @foreach (App\Models\User::where('role', 'vendor')->get() as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select">
                    <option value="">--Category--</option>
                    @foreach (App\Models\Category::where('is_parent', 1)->get() as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 d-none" id="child_category_div">
                <label for="child_category" class="form-label">Child Category</label>
                <select name="child_category" id="child_category" class="form-select">
                    <option value="">--Child Category--</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" name="stock" id="stock" class="form-control" placeholder="Stock"
                    value="{{ old('stock') }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Price"
                    value="{{ old('price') }}" step="any" placeholder="Price">
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount') }}"
                    step="any" placeholder="Discount">
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <select name="size" id="size" class="form-select">
                    <option value="">--Size--</option>
                    <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>Small</option>
                    <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>Medium</option>
                    <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>Large</option>
                    <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>Extra Large</option>
                </select>
            </div>
            <label for="conditions" class="form-label">Condition</label>
            <select name="conditions" id="conditions" class="form-select">
                <option>--Condition--</option>
                <option value="new" {{ old('conditions') == 'new' ? 'selected' : '' }}>New</option>
                <option value="popular" {{ old('conditions' == 'popular' ? 'selected' : '') }}>Popular</option>
                <option value="winter" {{ old('conditions' == 'winter' ? 'selected' : '') }}>Winter</option>
            </select>
            <label for="status" class="form-label mt-3">Status</label>
            <select name="status" id="status" class="form-select">
                <option>--Status--</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status' == 'inactive' ? 'selected' : '') }}>Inactive</option>
            </select>
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Photo</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="photo"
                        value="{{ old('photo') }}">
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
            </div>
            <button class="btn btn-primary mt-3">Submit</button>
            <a href="{{ route('banner.index') }}" class="btn btn-outline-light mt-3 text-dark">Cancel</a>
        </form>
    </div>
@endsection

@section('scripts')
    {{-- category --}}
    <script>
        $('#category').change(function() {
            var category_id = $(this).val();
            // alert(category_id);

            if (category_id != null) {
                $.ajax({
                    url: "/category/" + category_id + "/child",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        category_id: category_id
                    },
                    success: function(response) {
                        console.log(response);
                    }
                })
            }
        });
    </script>

    {{-- file manager --}}
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>

    {{-- summary --}}
    <script>
        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>

    {{-- summernote --}}
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
