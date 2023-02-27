@extends('admin.layouts.main')

@section('content')
    <div class="d-flex justify content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Banner</h1>
    </div>
    @include('admin.util.notification')

    <div class="d-flex justify-content-end">
        <a href="{{ route('banner.create') }}" class="btn btn-success">Create</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Photo</th>
                <th scope="col">Status</th>
                <th scope="col">Condition</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Test</td>
                <td>Test 2</td>
                <td>Photo 1</td>
                <td>Bagus</td>
                <td>Bagus</td>
                <td>
                    <button class="btn btn-warning">Edit</button>
                    <button class="btn btn-danger ms-1">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
@endsection