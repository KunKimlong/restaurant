<!-- Modal -->
<div class="modal fade" id="createPosition" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title"><i class="la la-frown-o"></i> Creating Position Form</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('position.store')}}" method="POST">
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
            </div>
        </div>
    </div>
</div>
