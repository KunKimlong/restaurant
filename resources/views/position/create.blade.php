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
