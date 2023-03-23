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
                @php
                    $photo = explode(',', $product->photo);
                @endphp
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
                        {{-- get data by id --}}
                        <div class="hidden">
                            <?php
                            $brand = \App\Models\Brand::find($product->brand_id);
                            $category = \App\Models\Category::find($product->category_id);
                            $child_category = $product->child_category_id;
                            if ($child_category == null) {
                                $child_category = '';
                            } else {
                                $get_child_category = \App\Models\Category::find($product->child_category_id);
                                $child_category = $get_child_category->title;
                            }
                            $vendor = \App\Models\User::find($product->vendor_id);
                            $price = number_format($product->price, 2);
                            $offer_price = number_format($product->offer_price, 2);
                            $discount = number_format($product->discount, 2);
                            ?>
                        </div>
                        {{-- show --}}
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary float-start me-1" data-bs-toggle="modal"
                            data-bs-target="#showDataModal{{ $product->id }}"><span data-feather="eye"></span></a>
                        {{-- edit --}}
                        <a href="{{ route('product.edit', $product->id) }}"
                            class="btn btn-sm btn-warning float-start"><span data-feather="edit"></span></a>
                        {{-- delete --}}
                        <form class="float-start" action="{{ route('product.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a class="float btn btn-sm btn-danger ms-1 delete" data-id="{{ $product->id }}"><span
                                    data-feather="trash"></span></a>
                        </form>
                    </td>

                    {{-- Modal --}}
                    <div class="modal fade" id="showDataModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="showDataModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            @php
                                $product = \App\Models\Product::where('id', $product->id)->first();
                            @endphp
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="showDataModalLabel">Product Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-center">
                                        <img id="photo" src="{{ $photo[0] }}" alt="category image"
                                            style="max-width:275px; max-height:150px;">
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p>
                                                <b>Title :</b> <span id="title">{{ $product->title }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <b>Slug :</b> <span id="slug">{{ $product->slug }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p>
                                                <b>Stock :</b> <span id="stock">{{ $product->stock }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <b>Brand :</b> <span
                                                    id="brand_id">{{ App\Models\Brand::where('id', $product->brand_id)->value('title') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p>
                                                <b>Category :</b> <span
                                                    id="category_id">{{ App\Models\Category::where('id', $product->category_id)->value('title') }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <b>Child Category :</b> <span
                                                    id="child_category_id">@php
                                                        if ($product->child_category_id == null) {
                                                            echo 'doesnt have child';
                                                        } else {
                                                            echo App\Models\Category::find($product->child_category_id)->title;
                                                        }
                                                    @endphp</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p>
                                                <b>Price :</b> <span
                                                    id="price">${{ number_format($product->price, 2) }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <b>Offer Price :</b> <span
                                                    id="offer_price">${{ number_format($product->offer_price, 2) }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p>
                                                <b>Discount :</b> <span id="discount">{{ $product->discount }}%</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <b>Size :</b> <span id="size">{{ $product->size }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p>
                                                <b>Condition :</b> <span id="conditions">{{ $product->conditions }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <b>Vendor :</b> <span
                                                    id="vendor_id">{{ App\Models\User::find($product->vendor_id)->full_name }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p>
                                                <b>Status :</b> <span id="stat">{{ $product->status }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="mt-3">
                                        <b>Summary :</b> <span id="summary">{!! $product->summary !!}</span>
                                    </p>
                                    <p class="mt-3">
                                        <b>Description :</b> <span id="description">{!! $product->description !!}</span>
                                    </p>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
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
