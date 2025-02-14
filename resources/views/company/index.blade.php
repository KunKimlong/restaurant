@extends('master-dashboard')

@section('page-title')
    <div class="card card-rounded">
        <div class="card-header p-3">
            <h5 class="m-0">Setting Management</h5>
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
            <div class="card-title">Setting</div>
        </div>
        <div class="card-body">
            <form action="{{route('create.company')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$company->id}}">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="name">Name</label>
                            <input type="text" placeholder="Name" value="{{ $company->name }}" name="name"
                                class="form-control" id="name">
                        </div>
                        <div class="mb-2">
                            <label for="name">Address</label>
                            <textarea name="address" placeholder="Address" id="" class="form-control" rows="10" style="resize: none">{{ $company->address }}</textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image" data-url="{{ route('upload-branch-image') }}"
                            placeholder="Image" class="form-control d-none">
                        <input type="hidden" name="imageName" id="imageName" value="{{$company->logo}}">
                        <div class="p-2 border border-1 mt-2" style="width: fit-content !important;cursor: pointer;">
                            <img src="{{ asset('assets/Images/upload.jpg') }}" alt="" id="chooseImage"
                                style="background-color: blue" width="100px" height="80px">
                        </div>
                        <div class="col-12 p-0" id="preview">
                            <img src="{{asset('Store/'.$company->logo)}}" alt="">
                        </div>
                    </div>
                    <div class="col-12 card-footer d-flex justify-content-end">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
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
