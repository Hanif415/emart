@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Banner</h1>
    </div>
    @include('admin.util.notification')
    <div class="d-flex justify-content-end">
        <a href="{{ route('banner.create') }}" class="btn btn-success">Create</a>
    </div>
    <table id="myTable" class=" display">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Title</th>
                {{-- <th scope="col">Description</th> --}}
                <th scope="col">Photo</th>
                <th scope="col">Condition</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $banner->title }}</td>
                    {{-- <td>{!! $banner->description !!}</td> --}}
                    <td><img src="{{ $banner->photo }}" alt="benner image" style="max-height:98px; max-width:128px;"></td>
                    <td>
                        @if ($banner->condition == 'banner')
                            <span class="badge text-bg-warning">{{ $banner->condition }}</span>
                        @else
                            <span class="badge text-bg-primary">{{ $banner->condition }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" role="switch" id="status"
                                value="{{ $banner->id }}" {{ $banner->status == 'active' ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-sm btn-warning"><span
                                data-feather="edit"></span></a>
                        <a href="{{ route('banner.destroy', $banner->id) }}" class="btn btn-sm btn-danger ms-1"><span
                                data-feather="trash"></span></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    {{-- update status using ajax --}}
    <script>
        $('input[name = status]').change(function() {
            var checked = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);
            $.ajax({
                url: "{{ route('banner.status') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    checked: checked,
                    id: id,
                },
                success: function(response) {
                    if (response.status) {
                        alert(response.msg);
                    } else {
                        alert('something wrong');
                    }
                }
            })
        })
    </script>

    {{-- data table --}}
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
