@extends('master-dashboard')

@section('page-title')
    <div class="card card-rounded">
        <div class="card-header p-3">
            <h5 class="m-0">Position Management</h5>
        </div>
    </div>
@endsection

@section('content')
    <div class="card rounded rounded-5">
        <div class="card-header d-flex justify-between p-3">
            <div class="card-title">Position</div>
            <div class="right">
                <a class="btn btn-primary text-light" href="#" data-toggle="modal" data-target="#createPosition">+ Create
                    new Position</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created Date</th>
                        <th>Modify Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($positions as $position)
                        <tr>
                            <td>{{ $position->id }}</td>
                            <td>{{ $position->name }}</td>
                            <td>{{ $position->created_at }}</td>
                            <td>{{ $position->updated_at }}</td>
                            <td>
                                <button class="btn btn-warning" id="btn-update" data-toggle="modal" data-target="#updatePosition" update_id="{{$position->id}}">{!! iconEdit() !!} Edit</button>
                                <button class="btn btn-danger">{!! iconRemove() !!}Delete</button>
                            </td>
                        </tr>
                    @empty
                        No position avaliable
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createPosition" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title">Creating Position Form</h6>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ Route('position.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 my-2">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                            </div>
                            <div class="col-12 my-2 d-flex justify-content-end">
                                <button class="btn btn-success mx-2">Create</button>
                                <button type="button" class="btn btn-danger mx-2" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="updatePosition" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title">Updating Position Form</h6>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ Route('position') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 my-2">
                                <label for="update_id">Name:</label>
                                <input type="hidden" name="id" id="update_id" class="form-control">
                            </div>
                            <div class="col-12 my-2">
                                <label for="update_name">Name:</label>
                                <input type="text" name="name" id="update_name" placeholder="Name" class="form-control">
                            </div>
                            <div class="col-12 my-2 d-flex justify-content-end">
                                <button class="btn btn-success mx-2">Create</button>
                                <button type="button" class="btn btn-danger mx-2" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <script>
            $(document).ready(function() {
                var message = {!! json_encode(Session::get('success')) !!}
                console.log(message);
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
                    type: 'error',
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
