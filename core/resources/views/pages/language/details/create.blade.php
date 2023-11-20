<div class="modal fade" id="dataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" module="dialog"
    aria-labelledby="moduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" module="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moduleLabel">Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dataForm" method="POST">
                    @csrf
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="value" id="value" placeholder="Enter value"
                            value="" />
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">Key</label>
                        <input type="text" class="form-control" name="key" id="key" placeholder="Enter key" value="" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="saveBtn" value="add">
                    Submit
                </button>
            </div>
        </div>
        </form>
    </div>
</div>