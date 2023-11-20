<div class="modal fade" id="dataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" module="dialog"
    aria-labelledby="moduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" module="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moduleLabel">Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dataForm" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="updateId" value="">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Link</label>
                            <input type="text" class="form-control" name="link" id="link" placeholder="Enter link" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Icon</label>
                            <input type="text" class="form-control" name="icon" id="icon" placeholder="Enter icon" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Sequence</label>
                            <input type="text" class="form-control" name="sequence" id="sequence"
                                placeholder="Enter sequence" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">ParentModule</label>
                            <select class="form-control select2" name="parent_id" id="parent_id">
                                <option value="0">Select</option>
                                @forelse (moduleList() as $module)
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @if (!empty($module->child) && count($module->child) > 0)
                                @foreach ($module->child as $child)
                                <option value="{{ $child->id }}">--> {{ $child->name }}</option>
                                @endforeach
                                @endif
                                @empty
                                <option disabled>No modules found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="moduleStatus">
                                <option>Select</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
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
