@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Product Management</h1>
        <a href="{{ route('product.create') }}" class="btn btn-success ms-3"><i class="bi bi-plus-circle"></i>
            Add Product</a>
    </div>

    <x:notify-messages />

    <p class="float-end mb-3">Total Products : {{ \App\Models\Product::count() }}</p>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Title</th>
                <th scope="col">Stock</th>
                <th scope="col">Brand</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col" class="d-flex justify-content-center">Condition</th>
                <th scope="col">Status</th>
                <th scope="col" class="d-flex justify-content-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->brand_id }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>
                        @if ($product->conditions == 'new')
                            <span class="btn btn-success disabled"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">{{ $product->conditions }}</span>
                        @elseif($product->conditions == 'popular')
                            <span class="btn btn-warning disabled"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">{{ $product->conditions }}</span>
                        @else
                            <span class="btn btn-primary disabled"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">{{ $product->conditions }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" role="switch" id="status"
                                value="{{ $product->id }}" {{ $product->status == 'active' ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td class="d-flex justify-content-center">
                        <a class="btn btn-sm btn-primary float-start me-1"
                            onclick="show(`{{ $product->title }}`, `{{ $product->slug }}`, `{{ $product->summary }}`, `{{ $product->description }}`, `{{ $product->stock }}`, `{{ \App\Models\Brand::select('title')->where('id', $product->brand_id)->get() }}`, `{{ $product->category_id }}`, `{{ $product->child_category_id }}`, `{{ $product->photo }}`, `{{ $product->price }}`, `{{ $product->offer_price }}`, `{{ $product->discount }}`, `{{ $product->size }}`, `{{ $product->conditions }}`, `{{ $product->vendor_id }}`, `{{ $product->status }}`,)"><span
                                data-feather="eye"></span></a>
                        <a href="{{ route('product.edit', $product->id) }}"
                            class="btn btn-sm btn-warning float-start"><span data-feather="edit"></span></a>
                        <form class="float-start" action="{{ route('product.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a class="float btn btn-sm btn-danger ms-1 delete" data-id="{{ $product->id }}"><span
                                    data-feather="trash"></span></a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal --}}
    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="label">Product Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="photo" src="" alt="category image" style="max-width:275px; max-height:150px;">
                    <p>
                        <b>Title :</b> <span id="title"></span>
                    </p>
                    <p>
                        <b>Slug :</b> <span id="slug"></span>
                    </p>
                    <p>
                        <b>Summary :</b> <span id="summary"></span>
                    </p>
                    <p>
                        <b>Description :</b> <span id="description"></span>
                    </p>
                    <p>
                        <b>Stock :</b> <span id="stock"></span>
                    </p>
                    <p>
                        <b>Brand :</b> <span id="brand_id"></span>
                    </p>
                    <p>
                        <b>Category :</b> <span id="category_id"></span>
                    </p>
                    <p>
                        <b>Child Category :</b> <span id="child_category_id"></span>
                    </p>
                    <p>
                        <b>Price :</b> <span id="price"></span>
                    </p>
                    <p>
                        <b>Offer Price :</b> <span id="offer_price"></span>
                    </p>
                    <p>
                        <b>Discount :</b> <span id="discount"></span>
                    </p>
                    <p>
                        <b>Size :</b> <span id="size"></span>
                    </p>
                    <p>
                        <b>Condition :</b> <span id="conditions"></span>
                    </p>
                    <p>
                        <b>Vendor :</b> <span id="vendor_id"></span>
                    </p>
                    <p>
                        <b>Status :</b> <span id="stat"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Show Data --}}
    <script>
        let show = (title, slug, summary, description, stock, brand_id, category_id, child_category_id, photo, price,
            offer_price, discount, size, conditions, vendor_id, status) => {
            $('#title').text(title)
            $('#slug').text(slug)
            $('#summary').text(summary)
            $('#description').text(description)
            $('#photo').attr("src", photo)
            $('#stock').text(stock)
            $('#brand_id').text(brand_id)
            $('#category_id').text(category_id)
            $('#child_category_id').text(child_category_id)
            $('#photo').text(photo)
            $('#price').text(price)
            $('#offer_price').text(offer_price)
            $('#discount').text(discount)
            $('#size').text(size)
            $('#conditions').text(conditions)
            $('#vendor_id').text(vendor_id)
            $('#stat').text(status)
            $('#modal').modal('show')
        }
    </script>
    {{-- end show data --}}

    {{-- update status --}}
    <script>
        $('input[name = status]').change(function() {
            var checked = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);
            $.ajax({
                url: "{{ route('product.status') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    checked: checked,
                    id: id,
                },
                success: function(response) {
                    if (response.status) {
                        swal("Data Updated", "Status updated", "success");
                    } else {
                        swal("Something wrong");
                    }
                }
            })
        })
    </script>

    {{-- delete data --}}
    <script>
        // configuration csrf token
        $.ajaxSetup({
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        });
        $('.delete').click(function(e) {
            var form = $(this).closest('form');
            var dataId = $(this).data('id');
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    // swal("Poof! Your imaginary file has been deleted!", {
                    //     icon: "success",
                    // });
                } else {
                    swal("Poof! Your imaginary file has been deleted!");
                }
            });
        });
    </script>

    {{-- data table --}}
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
