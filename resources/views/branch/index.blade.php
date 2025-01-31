@extends('master-dashboard')

@section('page-title')
    <div class="card card-rounded">
        <div class="card-header p-3">
            <h5 class="m-0">Branch Management</h5>
        </div>
    </div>
@endsection

@section('content')
@if ($errors->any())
    <div class="text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card rounded rounded-5">
        <div class="card-header d-flex justify-between p-3">
            <div class="card-title">Branch</div>
            <div class="right">
                <button class="btn btn-primary text-light" data-url="{{route('branch.create')}}" data-action="show">+ Create
                    new branch</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Street</th>
                        <th>Village</th>
                        <th>Commune</th>
                        <th>District</th>
                        <th>Province</th>
                        <th>Created Date</th>
                        <th>Modify Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($branches as $branch)
                        <tr>
                            <td>{{ $branch->id }}</td>
                            <td>{{ $branch->name }}</td>
                            <td>{{ $branch->number }}</td>
                            <td>{{ $branch->street }}</td>
                            <td>{{ $branch->village }}</td>
                            <td>{{ $branch->commune }}</td>
                            <td>{{ $branch->district }}</td>
                            <td>{{ $branch->province }}</td>
                            <td>{{ $branch->created_at }}</td>
                            <td>{{ $branch->updated_at }}</td>
                            <td>
                                <button class="btn btn-warning" data-url="{{route('branch.edit',$branch->id)}}" data-action="show" update_id="{{ $branch->id }}">{!! iconEdit() !!}
                                    Edit</button>
                                <button class="btn btn-danger">{!! iconRemove() !!}Delete</button>
                            </td>
                        </tr>
                    @empty
                        No branch avaliable
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if (Session::has('success'))
        <script>
            $(document).ready(function() {
                var message = {!! json_encode(Session::get('success')) !!}
                $.notify({
                    icon: 'la la-bell',
                    title: 'Success',
                    message,
                }, {
                    type: 'success',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 2000,
                });
            })
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                var message = {!! json_encode(Session::get('error')) !!}
                console.error(message);
                $.notify({
                    icon: 'la la-bell',
                    title: 'Error',
                    message,
                }, {
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 2000,
                });
            })
        </script>
    @endif
@endsection
