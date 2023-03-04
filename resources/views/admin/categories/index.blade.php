@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">category</h1>
        <a href="{{ route('category.create') }}" class="btn btn-outline-success ms-3"><span data-feather="plus-circle"></span>
            Create</a>
    </div>

    <x:notify-messages />

    <p class="float-end mb-3">Total categorys : {{ \App\Models\category::count() }}</p>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Title</th>
                <th scope="col">Photo</th>
                <th scope="col">Is Parent</th>
                <th scope="col">Parents</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $category->title }}</td>
                    <td><img src="{{ $category->photo }}" alt="benner image" style="max-height:98px; max-width:128px;"></td>
                    <td>
                        @if ($category->condition == 'category')
                            <span class="btn btn-success disabled">{{ $category->condition }}</span>
                        @else
                            <span class="btn btn-primary disabled">{{ $category->condition }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" role="switch" id="status"
                                value="{{ $category->id }}" {{ $category->status == 'active' ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-outline-primary float-start me-1"
                            onclick="show(`{{ $category->title }}`, `{{ $category->slug }}`, `{{ $category->description }}`, `{{ $category->photo }}`, `{{ $category->status }}`, `{{ $category->condition }}`)"><span
                                data-feather="eye"></span></a>
                        <a href="{{ route('category.edit', $category->id) }}"
                            class="btn btn-sm btn-outline-warning float-start"><span data-feather="edit"></span></a>
                        <form class="float-start" action="{{ route('category.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a class="float btn btn-sm btn-outline-danger ms-1 delete" data-id="{{ $category->id }}"><span
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
                    <h1 class="modal-title fs-5" id="label">category Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="photo" src="" alt="category image" style="max-width:275px; max-height:150px;">
                    <p id="title">Title :</p>
                    <p id="slug"></p>
                    <p id="description"></p>
                    <p id="stat"></p>
                    <p id="condition"></p>
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
        let show = (title, slug, description, photo, status, condition) => {
            $('#title').text('Title : ' + title)
            $('#slug').text('slug : ' + slug)
            $('#description').text('Description: ' + description)
            $('#photo').attr("src", photo)
            $('#stat').text('Status : ' + status)
            $('#condition').text('Condition : ' + condition)
            $('#modal').modal('show')
        }
    </script>
    {{-- end show data --}}

    {{-- update status using ajax --}}
    <script>
        $('input[name = status]').change(function() {
            var checked = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);
            $.ajax({
                url: "{{ route('category.status') }}",
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
