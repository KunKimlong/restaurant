@extends('master-dashboard')

@section('page-title')
    <div class="card card-rounded">
        <div class="card-header p-3">
            <h5 class="m-0">Update staff</h5>
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
            <div class="card-title">Updating Staff</div>
        </div>
        <div class="card-body">
            <form action="{{ Route('staff.update',$staff->id) }}" class="col-11 mx-auto" method="POST">
                @method("PUT")
                @csrf
                <div class="row">
                    <div class="col-6 my-1">
                        <label for="first_name">First name:</label>
                        <input type="text" name="first_name" id="first_name" value="{{$staff->first_name}}" placeholder="First Name"
                            class="form-control">
                    </div>
                    <div class="col-6 my-1">
                        <label for="last_name">Last name:</label>
                        <input type="text" name="last_name" id="last_name" value="{{$staff->last_name}}" placeholder="Last Name"
                            class="form-control">
                    </div>
                    <div class="col-6 my-1">
                        <label for="gender">Gender:</label>
                        <div class="form-group p-0">
                            <input type="radio" name="gender" id="male" {{$staff->gender=="Male"?"checked":""}} class="" value="Male"> <label
                                for="male">Male</label>
                            <input type="radio" name="gender" id="female" {{$staff->gender=="Female"?"checked":""}} class="mx-2" value="Female"> <label
                                for="female">Female</label>
                        </div>
                    </div>
                    <div class="col-6 my-1">
                        <label for="phone_number">Phone number:</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{$staff->phone_number}}" placeholder="Phone Number"
                            class="form-control">
                    </div>
                    <div class="col-6 my-1">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Email" value="{{$staff->email}}" class="form-control">
                    </div>
                    <div class="col-6 my-1">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="col-6 my-1">
                        <label for="position">Position:</label>
                        <select name="position" id="position" class="form-control">
                            <option value="" selected disabled>--- Select Position ---</option>
                            @forelse ($positions as $position => $value)
                                <option value="{{ $position }}" {{($staff->position_id == $position) ? "selected":""}}>{{ $value }}</option>
                            @empty
                                <option value="">--- No position ---</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-6 my-1">
                        <label for="branch">Branch:</label>
                        <select name="branch" id="branch" class="form-control">
                            <option value="" selected disabled>--- Select Branch ---</option>
                            @forelse ($branches as $branch => $value)
                                <option value="{{ $branch }}" {{($staff->branch_id == $branch) ? "selected":""}}>Resturant {{ convertToRoman($value) }}</option>
                            @empty
                                <option value="">--- No branch ---</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-6 my-1">
                        <label for="join_date">Join Date:</label>
                        <input type="date" name="join_date" id="join_date" value="{{$staff->join_date}}" placeholder="Join Date" class="form-control">
                    </div>
                    <div class="col-6 my-1">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" value="{{$staff->date_of_birth}}"
                            class="form-control">
                    </div>
                    <div class="col-6 my-1">
                        <label for="salary">Salary:</label>
                        <input type="text" name="salary" id="salary" placeholder="Salary" class="form-control"  value="{{$staff->salary}}">
                    </div>
                    <div class="col-6 my-1">
                        <label for="role">Role:</label>
                        <select name="role" id="role" class="form-control">
                            <option value="" selected disabled>--- Select Role ---</option>
                            <option value="Manager" {{($staff->role == "Manager") ? "selected":""}}>Manager</option>
                            <option value="employee" {{($staff->role == "employee") ? "selected":""}}>Employee</option>
                        </select>
                    </div>
                    <div class="col-12 my-1">
                        <label for="address">Address:</label>
                        <textarea name="address" id="" rows="5" style="resize: none" class="form-control">{{$staff->address}}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="image">Profile:</label>
                        <input type="file" name="image" id="image"
                            data-url="{{ route('upload-branch-image') }}" placeholder="Image"
                            class="form-control d-none">
                        <input type="hidden" name="imageName" id="imageName" value="{{$staff->profile}}">
                        <div class="p-2 border border-1 mt-2" style="width: fit-content !important;cursor: pointer;">
                            <img src="{{ asset('assets/Images/upload.jpg') }}" alt="" id="chooseImage"
                                style="background-color: blue" width="100px" height="80px">
                        </div>
                        <div class="col-12 p-0" id="preview">
                            <img src="{{asset('store/'.$staff->profile)}}" alt="">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-success mx-2">Update</button>
                        <a href="{{route('staff.index')}}" class="btn btn-danger mx-2">Cancel</a>
                    </div>
                </div>
            </form>
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
