<form action="{{ Route('branch.update',$branch->id) }}" method="POST">
    @method("PUT")
    @csrf
    <div class="row">
        <div class="col-6 my-2">
            <label for="number">Number:</label>
            <input type="text" name="number" id="number" placeholder="Number" value="{{$branch->number}}"
                class="form-control">
        </div>
        <div class="col-6 my-2">
            <label for="street">Street:</label>
            <input type="text" name="street" value="{{$branch->street}}" id="street" placeholder="Street"
                class="form-control">
        </div>
        <div class="col-6 my-2">
            <label for="village">Village:</label>
            <input type="text" name="village" value="{{$branch->village}}" id="village" placeholder="Village"
                class="form-control">
        </div>
        <div class="col-6 my-2">
            <label for="commune">Commune:</label>
            <input type="text" name="commune" value="{{$branch->commune}}" id="commune" placeholder="Commune"
                class="form-control">
        </div>
        <div class="col-6 my-2">
            <label for="district">District:</label>
            <input type="text" name="district" value="{{$branch->district}}" id="district" placeholder="District"
                class="form-control">
        </div>
        <div class="col-12 my-2">
            <label for="province">Province:</label>
            <select name="province" class="form-control" id="province">
                <option value="">--- Select Province ----</option>
                @forelse ($provinces as $province)
                    @if ($province == $branch->province)
                        <option value="{{$province}}" selected>{{$province}}</option>
                    @else
                        <option value="{{$province}}">{{$province}}</option>
                    @endif
                @empty
                    <option value="">No province</option>
                @endforelse
            </select>
        </div>
        <div class="col-12 my-2">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" data-url="{{route('upload-branch-image')}}" placeholder="Image"
                class="form-control d-none">
            <input type="hidden" name="imageName" id="imageName" value="{{asset('Store/'.$branch->image)}}">
            <div class="p-2 border border-1 mt-2" style="width: fit-content !important;cursor: pointer;">
                <img src="{{asset('assets/Images/upload.jpg')}}" alt="" id="chooseImage" style="background-color: blue" width="100px" height="80px">
            </div>
            <div class="col-12 p-0" id="preview">
                <img src="{{asset('Store/'.$branch->image)}}" alt="">
            </div>
        </div>
        <div class="col-12 my-2 d-flex justify-content-end">
            <button class="btn btn-success mx-2">Update</button>
            <button type="button" class="btn btn-danger mx-2" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</form>
