@extends('master-dashboard')

@section('page-title')
    <div class="card card-rounded">
        <div class="card-header p-3">
            <h5 class="m-0">Staff Management</h5>
        </div>
    </div>
@endsection

@section('content')
    <div class="card rounded rounded-5">
        <div class="card-header d-flex justify-between p-3">
            <div class="card-title">Staff</div>
            <div class="right">
                <a class="btn btn-primary text-light" href="{{route('staff.create')}}">+ Create
                    new staff
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table text-center" id="table-show">
                <thead>
                    <tr>
                        <th>N<sup>o </sup></th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Phone number</th>
                        <th>Join Date</th>
                        <th>Position</th>
                        <th>Branch</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($staffs as $index => $staff)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>
                                <img src="{{asset('Store/'.$staff->profile)}}" alt="" class="show-image-table">
                            </td>
                            <td>{{fullName($staff->first_name, $staff->last_name, $staff->gender)}}</td>
                            <td>{{$staff->phone_number}}</td>
                            <td>{{$staff->join_date_date}}</td>
                            <td>{{$staff->position->name}}</td>
                            <td>Resturant {{convertToRoman($staff->branch->number)}}</td>
                            <td>
                                <a href="{{route('staff.show',$staff->id)}}" class="btn btn-primary">View</a>
                                <a href="{{route('staff.edit',$staff->id)}}" class="btn btn-warning">Update</a>
                                <button class="btn btn-danger" id="btn-remove"
                                    data-remove-id="{{ $staff->id }}">{!! iconRemove() !!}Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>

                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
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
                        var url = "{{ route('staff.destroy', ':id') }}".replace(':id', id)
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
                                var staffs = res.staffs;
                                console.log(res);

                                tbdoy .empty(); //clear table
                                staffs.forEach((staff, i) => {
                                    var updateUrl =
                                        '{{ route('staff.edit', ':id') }}'
                                        .replace(':id', staff.id);
                                    var fullName = (staff.gender == "Male"?"Mr. ":"Ms. ") + staff.first_name+" "+staff.last_name;
                                    var txt = `
                                        <tr>
                                            <td>${i+1}</td>
                                            <td><img src="{{ asset('Store/${staff.profile}') }}" alt="" class="show-image-table">
                                            </td>
                                            <td>${fullName}</td>
                                            <td>${staff.phone_number}</td>
                                            <td>${staff.join_date}</td>
                                            <td>${staff.position_name}</td>
                                            <td>${staff.branch_name}</td>
                                            <td>
                                                <button class="btn btn-warning" data-url="${updateUrl}"
                                                    data-action="show" update_id="${staff.id}">{!! iconEdit() !!}
                                                    Edit</button>
                                                <button class="btn btn-danger" id="btn-remove"
                                                    data-remove-id="${staff.id}">{!! iconRemove() !!}Delete</button>
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

