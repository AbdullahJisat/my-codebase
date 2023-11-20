@extends('admin.layouts.app')
{{-- @section('cost_active', 'active pcoded-trigger')
@section('view_cost_active', 'active') --}}
@section('title', 'Role')
@section('content')
<div class="col-md-12" style="position:relative; column-count: 2;column-gap: 30px;">
  <ul id="permission" class="text-left tree">
    <li><input type="checkbox" name="module[]" value="29">User Dashboard<ul></ul>
    </li>
    <li class="branch"><i class="indicator fas fa-plus-square"></i><input type="checkbox" name="module[]"
        value="28">Manage Customer<ul>
        <li style="display: none;"><input type="checkbox" name="method[]" value="110">Manage</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="111">Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="112">Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="113">Delete</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="114">Bulk Action</li>
      </ul>
    </li>
    <li class="branch"><i class="indicator fas fa-plus-square"></i><input type="checkbox" name="module[]"
        value="32">Manage Invoice<ul>
        <li style="display: none;"><input type="checkbox" name="method[]" value="127">Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="128">Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="129">View</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="130">Delete</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="131">Bulk Action</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="132">Manage</li>
      </ul>
    </li>
    <li class="branch"><i class="indicator fas fa-plus-square"></i><input type="checkbox" name="module[]"
        value="33">Manage Quotation<ul>
        <li style="display: none;"><input type="checkbox" name="method[]" value="133">Manage</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="134">Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="135">Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="136">View</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="137">Delete</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="138">Bulk Action</li>
      </ul>
    </li>
    <li class="branch"><i class="indicator fas fa-plus-square"></i><input type="checkbox" name="module[]"
        value="36">Manage Project<ul>
        <li style="display: none;"><input type="checkbox" name="method[]" value="150">Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="151">Manage</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="152">Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="153">View</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="154">Project Has Step Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="155">Project Document Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="156">Project Feedback Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="157">Project Feedback Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="158">Project Feedback Delete</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="183">Project Progress Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="184">Project Progress Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="185">Project Progress Delete</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="192">Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="193">Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="194">Delete</li>
      </ul>
    </li>
    <li class="branch"><i class="indicator fas fa-plus-square"></i><input type="checkbox" name="module[]"
        value="41">Manage Customer Visit<ul>
        <li style="display: none;"><input type="checkbox" name="method[]" value="177">Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="178">View</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="179">Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="181">Bulk Action</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="182">Manage</li>
      </ul>
    </li>
    <li class="branch"><i class="indicator fas fa-plus-square"></i><input type="checkbox" name="module[]"
        value="34">Customer Query<ul>
        <li style="display: none;"><input type="checkbox" name="method[]" value="139">Manage</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="140">Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="141">Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="142">Delete</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="143">Bulk Action</li>
      </ul>
    </li>
    <li class="branch"><i class="indicator fas fa-plus-square"></i><input type="checkbox" name="module[]"
        value="46">Manage Upazila<ul>
        <li style="display: none;"><input type="checkbox" name="method[]" value="195">Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="196">Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="197">Delete</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="198">View</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="199">Manage</li>
        <li style="display: none;"><input type="checkbox" name="method[]" value="200">Bulk Action</li>
      </ul>
    </li>
    <li class="branch"><i class="indicator fas fa-plus-square"></i><input type="checkbox" name="module[]" checked=""
        value="48">Manage Payment Voucher<ul>
        <li style="display: none;"><input type="checkbox" name="method[]" checked="" value="201">Add</li>
        <li style="display: none;"><input type="checkbox" name="method[]" checked="" value="202">Edit</li>
        <li style="display: none;"><input type="checkbox" name="method[]" checked="" value="203">Delete</li>
        <li style="display: none;"><input type="checkbox" name="method[]" checked="" value="204">View</li>
        <li style="display: none;"><input type="checkbox" name="method[]" checked="" value="205">Manage</li>
        <li style="display: none;"><input type="checkbox" name="method[]" checked="" value="206">Bulk Action</li>
      </ul>
    </li>
  </ul>
  <div class="col-md-12 text-center content-loading" style="display: none;">
    <img class="loading-image" src="{{ asset('backend/images/table-loading.svg') }}">
  </div>
</div>
@endsection
@push('script')
<script>
  $(document).ready(function() {
            getPermissions({{ $user->id }});
            $('#dataForm').on('submit', function(event) {
            event.preventDefault();
            var data = new FormData(this);
            data.append('userId', {{ $user->id }});
            var url = `{{ route('admin.roles.permissions_store') }}`;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    beforeSend: function() {
                        $('#save-btn').addClass('kt-spinner kt-spinner--md kt-spinner--light');
                    },
                    complete: function() {
                        $('#save-btn').removeClass(
                            'kt-spinner kt-spinner--md kt-spinner--light');
                    },
                    success: function(data) {
                      if (data.status) {
                          toastMessage(data.message);
                          getPermissions({{ $user->id }})
                        } else {
                          toastMessage(data.message);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr
                            .responseText);
                    }
                });
            });
        });

        function getPermissions(userId) {
            var url = `{{ route('admin.roles.get_permissions') }}`;
            if (userId) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        roleId: roleId,
                    },
                    beforeSend: function() {
                        $('.content-loading').show();
                    },
                    complete: function() {
                        $('.content-loading').hide();
                    },
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            $('#permission').html(data);
                            $('#permission').treed();
                            $('.btn-section').show();
                            $('input[type=checkbox]').click(function() {
                                $(this).next().find('input[type=checkbox]').prop('checked', this.checked);
                                $(this).parents('ul').prev('input[type=checkbox]').prop('checked',
                                    function() {
                                        return $(this).next().find(':checked').length;
                                    });
                            });

                        } else {
                            $('#permission').html('');
                            $('.btn-section').hide();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            } else {
                toastMessage(error = "error", message = "Please select role");
            }

        }
</script>
@endpush