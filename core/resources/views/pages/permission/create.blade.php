<div class="modal fade" id="dataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" module="dialog"
    aria-labelledby="moduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" module="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moduleLabel"><i class="fas fa-plus-square"></i> Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dataForm" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="updateId" value="">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Module</label>
                            <select class="form-control" name="module_id" id="module_id">
                                <option selected value="0">Select</option>
                                @forelse (moduleChildList() as $module)
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @empty
                                <option disabled>No modules found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter link" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="saveBtn">
                    Save
                </button>
            </div>
        </div>
        </form>
    </div>
</div>