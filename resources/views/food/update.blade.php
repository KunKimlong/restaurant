<form action="{{ Route('food.update',$food->id) }}" method="POST">
    @method("PUT")
    @csrf
    <div class="row">
        <div class="col-6 my-2">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{$food->name}}" placeholder="Name"
                class="form-control">
        </div>
        <div class="col-6 my-2">
            <label for="type">Type:</label>
            <select name="type" id="" class="form-control">
                <option value="Khmer Food" {{$food->type == "Khmer Food"?"selected":""}}>Khmer Food</option>
                <option value="Western Food" {{$food->type == "Western Food"?"selected":""}}>Western Food</option>
                <option value="Korean Food" {{$food->type == "Korean Food"?"selected":""}}>Korean Food</option>
                <option value="Japanese Food" {{$food->type == "Japanese Food"?"selected":""}}>Japanese Food</option>
            </select>
        </div>
        <div class="col-6 my-2">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value="{{$food->price}}" placeholder="Price"
                class="form-control">
        </div>
        <div class="col-6 my-2">
            <label for="discount">Discount:</label>
            <select name="discount" id="discount" class="form-control">
                <option value="0" {{$food->discount == "0"?"selected":""}}>0%</option>
                <option value="10" {{$food->discount == "10"?"selected":""}}>10%</option>
                <option value="20" {{$food->discount == "20"?"selected":""}}>20%</option>
                <option value="30" {{$food->discount == "30"?"selected":""}}>30%</option>
                <option value="40" {{$food->discount == "40"?"selected":""}}>40%</option>
                <option value="50" {{$food->discount == "50"?"selected":""}}>50%</option>
            </select>
        </div>
        <div class="col-12 my-2">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" data-url="{{route('upload-branch-image')}}" placeholder="Image"
                class="form-control d-none">
            <input type="hidden" name="imageName" value="{{$food->image}}" id="imageName">
            <div class="p-2 border border-1 mt-2" style="width: fit-content !important;cursor: pointer;">
                <img src="{{asset('assets/Images/upload.jpg')}}" alt="" id="chooseImage" style="background-color: blue" width="100px" height="80px">
            </div>
            <div class="col-12 p-0" id="preview">
                <img src="{{asset('Store/'.$food->image)}}" alt="">
            </div>
        </div>
        <div class="col-12 my-2 d-flex justify-content-end">
            <button class="btn btn-success mx-2">Update</button>
            <button type="button" class="btn btn-danger mx-2" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</form>
