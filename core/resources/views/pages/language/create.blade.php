<div class="modal fade" id="dataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" module="dialog"
    aria-labelledby="moduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" module="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moduleLabel">Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dataForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="updateId" value="">
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" />
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" id="code" placeholder="Enter code" />
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">Flag</label>
                        <input type="file" class="form-control" name="flag" id="flag" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="saveBtn">
                    Submit
                </button>
            </div>
        </div>
        </form>
    </div>
</div>