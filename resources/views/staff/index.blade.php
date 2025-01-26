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
        <div class="card-header p-3">
            <div class="card-title">Staff</div>
        </div>
        <div class="card-body">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Phone number</th>
                        <th>Join Date</th>
                        <th>Branch</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
