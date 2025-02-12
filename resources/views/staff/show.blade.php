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
                <a class="btn btn-primary text-light" href="{{route('staff.edit',$id)}}">+ update Staff
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-2">
                        <img src="{{asset('Store/'.$staff->profile)}}" alt="" style="max-width: 100%;">
                    </div>
                    <div class="col-8">
                        <div class="row mb-2">
                            <div class="col-4">
                                <h6>Name: {{fullName($staff->first_name, $staff->last_name, $staff->gender)}}</h6>
                            </div>
                            <div class="col-4">
                                <h6>Gender: {{$staff->gender}}</h6>
                            </div>
                            <div class="col-4">
                                <h6>Phone Number: {{$staff->phone_number}}</h6>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h6>Email: {{$staff->email}}</h6>
                            </div>
                            <div class="col-4">
                                <h6>Position: {{$staff->position->name}}</h6>
                            </div>
                            <div class="col-4">
                                <h6>Branch: Resturant {{convertToRoman($staff->branch->number)}}</h6>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h6>Birth Date: {{$staff->date_of_birth}}</h6>
                            </div>
                            <div class="col-4">
                                <h6>Join Date: {{$staff->join_date}}</h6>
                            </div>
                            <div class="col-4">
                                <h6>Role: {{$staff->role}}</h6>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <h6>
                                    Address: {{$staff->address}}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{route('staff.index')}}" class="btn btn-primary mx-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

