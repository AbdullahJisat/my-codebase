<div class="modal fade" id="dataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" module="dialog"
    aria-labelledby="moduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" module="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moduleLabel">Add</h5>
                <button type="button" class="btn-close" id="showModal" aria-label="Close"></button>
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
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Enter username" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Mobile</label>
                            <input class="form-control" type="tel"
                                pattern="(^([+]{1}[8]{2}|0088)?(01){1}[3-9]{1}\d{8})$" maxlength="11"
                                onkeypress="return /[0-9]/i.test(event.key)" name="mobile" id="mobile"
                                placeholder="Enter mobile" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" name="password" id="password"
                                placeholder="Enter password" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-select" name="gender" id="gender">
                                <option>Select</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="userStatus">
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