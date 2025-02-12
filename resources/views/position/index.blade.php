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
                <button class="btn btn-primary text-light" data-url="{{ route('position.create') }}" data-action="show">+ Create
                    new Position</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>N<sup>o</sup></th>
                        <th>Name</th>
                        <th>Created Date</th>
                        <th>Modify Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($positions as $index => $position)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $position->name }}</td>
                            <td>{{ $position->created_at }}</td>
                            <td>{{ $position->updated_at }}</td>
                            <td>
                                <button class="btn btn-warning" id="btn-update" data-url="{{ route('position.edit',$position->id) }}" data-action="show">{!! iconEdit() !!} Edit</button>
                                <button class="btn btn-danger" id="btn-remove">{!! iconRemove() !!}Delete</button>
                            </td>
                        </tr>
                    @empty
                        No position avaliable
                    @endforelse
                </tbody>
            </table>
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
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btn-remove', function() {
                Swal.fire({
                    title: "Are you sure to remove?",
                    text: "You will be remove it and cannot get it back.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#1d62f0",
                    cancelButtonColor: "#ff646d ",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data('remove-id');
                        var url = "{{ route('branch.destroy', ':id') }}".replace(':id', id)
                        $.ajax({
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id
                            },
                            url,
                            success: function(res, textStatus, xhr) {
                                var table = $('#table-show');
                                var tbdoy = table.find('tbody');
                                var branches = res.branches;
                                table.empty(); //clear table
                                branches.forEach((branch, i) => {
                                    var updateUrl =
                                        '{{ route('branch.edit', ':id') }}'
                                        .replace(':id', branch.id);
                                    var romanNumber = convertToRoman(branch
                                        .number);
                                    console.log(romanNumber);
                                    var txt = `
                                        <tr>
                                            <td>${i+1}</td>
                                            <td><img src="{{ asset('Store/${branch.image}') }}" alt="" class="show-image-table">
                                            </td>
                                            <td>Resturant ${romanNumber}</td>
                                            <td>${branch.number}</td>
                                            <td>${branch.street}</td>
                                            <td>${branch.village}</td>
                                            <td>${branch.commune}</td>
                                            <td>${branch.district}</td>
                                            <td>${branch.province}</td>
                                            <td>${branch.created_at}</td>
                                            <td>${branch.updated_at}</td>
                                            <td>
                                                <button class="btn btn-warning" data-url="${updateUrl}"
                                                    data-action="show" update_id="${branch.id}">{!! iconEdit() !!}
                                                    Edit</button>
                                                <button class="btn btn-danger" id="btn-remove"
                                                    data-remove-id="${branch.id}">{!! iconRemove() !!}Delete</button>
                                            </td>
                                        </tr>
                                    `;
                                    table.append(txt);
                                });
                                if (xhr.status === 200) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: res.responseText,
                                        icon: "success"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: res.responseText,
                                        icon: "error"
                                    });
                                }
                            }
                        })
                    }
                });
            })
        })
    </script>
@endpush
