@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Brand Management</h1>
        <a href="{{ route('brand.create') }}" class="btn btn-success ms-3"><i class="bi bi-plus-circle"></i>
            Add Brand</a>
    </div>

    <x:notify-messages />

    <p class="float-end mb-3">Total Brands : {{ \App\Models\Brand::count() }}</p>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Title</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $brand->title }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" role="switch" id="status"
                                value="{{ $brand->id }}" {{ $brand->status == 'active' ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary float-start me-1"
                            onclick="show(`{{ $brand->title }}`, `{{ $brand->slug }}`, `{{ $brand->photo }}`, `{{ $brand->status }}`)"><span
                                data-feather="eye"></span></a>
                        <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-sm btn-warning float-start"><span
                                data-feather="edit"></span></a>
                        <form class="float-start" action="{{ route('brand.destroy', $brand->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a class="float btn btn-sm btn-danger ms-1 delete" data-id="{{ $brand->id }}"><span
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
                    <h1 class="modal-title fs-5" id="label">Brand Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="photo" src="" alt="brand image" class="mb-3"
                        style="max-width:275px; max-height:150px;">
                    <p id="title"></p>
                    <p id="slug"></p>
                    <p id="stat"></p>
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
        let show = (title, slug, photo, status) => {
            $('#title').text('Title : ' + title)
            $('#slug').text('Slug : ' + slug)
            $('#photo').attr("src", photo)
            $('#stat').text('Status : ' + status)
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
                url: "{{ route('brand.status') }}",
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
