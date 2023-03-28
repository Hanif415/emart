@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">User Management</h1>
        <a href="{{ route('user.create') }}" class="btn btn-success ms-3"><i class="bi bi-plus-circle"></i>
            Add User</a>
    </div>

    <x:notify-messages />

    <p class="float-end mb-3">Total Users : {{ \App\Models\User::count() }}</p>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Username</th>
                <th scope="col">Full Name</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @php
                    $photo = explode(',', $user->photo);
                @endphp
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" role="switch" id="status"
                                value="{{ $user->id }}" {{ $user->status == 'active' ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary float-start me-1" data-bs-toggle="modal"
                            data-bs-target="#showDataModal{{ $user->id }}"><span class="bi bi-eye"></span></a>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning float-start"><span
                                class="bi bi-pencil"></span></a>
                        <form class="float-start" action="{{ route('user.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a class="float btn btn-sm btn-danger ms-1 delete" data-id="{{ $user->id }}"><span
                                    class="bi bi-trash"></span></a>
                        </form>
                    </td>

                    {{-- Modal --}}
                    <div class="modal modal-lg fade" id="showDataModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="showDataModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            @php
                                $user = \App\Models\User::where('id', $user->id)->first();
                            @endphp
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="showDataModalLabel">User Details</h1>
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
                                                <b>Full Name :</b> <span
                                                    id="title">{{ \Illuminate\Support\Str::upper($user->full_name) }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <b>Username :</b> <span id="slug">{{ $user->username }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p>
                                                <b>Email :</b> <span id="stock">{{ $user->email }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <b>Phone :</b> <span id="stock">{{ $user->phone }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p>
                                                <b>Role :</b> <span id="conditions">{{ $user->role }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <b>Status :</b> <span id="stat">{{ $user->status }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="mt-3">
                                        <b>Address :</b> <span id="summary">{{ $user->address }}</span>
                                    </p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
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
                url: "{{ route('user.status') }}",
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
