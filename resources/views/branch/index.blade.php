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
                <button class="btn btn-primary text-light" data-url="{{ route('branch.create') }}" data-action="show">+ Create
                    new branch</button>
            </div>
        </div>
        <div class="card-body" style="overflow-x: scroll">
            <table class="table text-center" id="table-show">
                <thead>
                    <tr>
                        <th>N<sup>o</sup></th>
                        <th>Image</th>
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
                    @forelse ($branches as $index => $branch)
                        <tr>
                            <td>{{ $total + $index + 1 }}</td>
                            <td><img src="{{ asset('Store/' . $branch->image) }}" alt="" class="show-image-table">
                            </td>
                            <td>{{$company_name}} {{ convertToRoman($branch->number) }}</td>
                            <td>{{ $branch->number }}</td>
                            <td>{{ $branch->street }}</td>
                            <td>{{ $branch->village }}</td>
                            <td>{{ $branch->commune }}</td>
                            <td>{{ $branch->district }}</td>
                            <td>{{ $branch->province }}</td>
                            <td>{{ $branch->created_at_date }}</td>
                            <td>{{ $branch->updated_at_date }}</td>
                            <td>
                                <button class="btn btn-warning" data-url="{{ route('branch.edit', $branch->id) }}"
                                    data-action="show" update_id="{{ $branch->id }}">{!! iconEdit() !!}
                                    Edit</button>
                                <button class="btn btn-danger" id="btn-remove"
                                    data-remove-id="{{ $branch->id }}">{!! iconRemove() !!}Delete</button>
                            </td>
                        </tr>
                    @empty
                        No branch avaliable
                    @endforelse
                </tbody>
            </table>
            <ul class="page">
                @for ($i=1;$i<=$pages;$i++)
                    <li><a href="?page={{$i}}">{{$i}}</a></li>
                @endfor
            </ul>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            function convertToRoman(num) {
                const map = [{
                        symbol: 'M',
                        value: 1000
                    },
                    {
                        symbol: 'CM',
                        value: 900
                    },
                    {
                        symbol: 'D',
                        value: 500
                    },
                    {
                        symbol: 'CD',
                        value: 400
                    },
                    {
                        symbol: 'C',
                        value: 100
                    },
                    {
                        symbol: 'XC',
                        value: 90
                    },
                    {
                        symbol: 'L',
                        value: 50
                    },
                    {
                        symbol: 'XL',
                        value: 40
                    },
                    {
                        symbol: 'X',
                        value: 10
                    },
                    {
                        symbol: 'IX',
                        value: 9
                    },
                    {
                        symbol: 'V',
                        value: 5
                    },
                    {
                        symbol: 'IV',
                        value: 4
                    },
                    {
                        symbol: 'I',
                        value: 1
                    }
                ];

                num = parseInt(num);
                let roman = '';

                map.forEach(item => {
                    while (num >= item.value) {
                        roman += item.symbol;
                        num -= item.value;
                    }
                });

                return roman;
            }
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
                                tbdoy .empty(); //clear table
                                branches.forEach((branch, i) => {
                                    var updateUrl =
                                        '{{ route('branch.edit', ':id') }}'
                                        .replace(':id', branch.id);
                                    var romanNumber = convertToRoman(branch
                                        .number);
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
