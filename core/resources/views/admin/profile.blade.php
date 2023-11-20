@extends('admin.layouts.app')
{{-- @section('cost_active', 'active pcoded-trigger')
@section('view_cost_active', 'active') --}}
@section('title', 'Admin')
@section('content')
<div class="row">
  <div class="col-xl-4">
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <div class="d-flex">
          <span class="pt-1 p-2">
            <i class="kt-font-brand fa fa-align-left"></i>
          </span>
          <h3>
            Admin </h3>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-sm-4 profile-photo">
            <form action="{{ route('admin.admins.update_profile', $admin->id) }}" method="post"
              enctype="multipart/form-data">
              @csrf
              <label for="profileSelect" class="edit-avatar"><i class="fas fa-pencil"></i>
                <input type="file" name="profile" id="profileSelect" hidden
                  onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('imageSubmit').style.display = 'block';"></label>
              {{-- <div class="avatar-md profile-admin-wid mb-4"> --}}
                <img id="imagePreview"
                  src="{{ !empty($admin->profile) ? asset('assets/images/admin/profile/'. @$admin->profile) : asset('assets/images/noImage.png') }}"
                  alt="" class="img-thumbnail rounded-circle">
                {{--
              </div> --}}
              <button id="imageSubmit" type="submit" style="display: none;" class="btn btn-sm btn-info">save</button>
            </form>
            {{-- <h5 class="text-center font-size-15 text-truncate">Cynthia Price</h5>
            <p class="text-center text-muted mb-0 text-truncate">UI/UX Designer</p> --}}
          </div>
        </div>
      </div>
    </div>
    <!-- end card -->

    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-4">Personal Information</h4>
        <div class="table-responsive">
          <table class="table table-nowrap mb-0">
            <tbody>
              <tr>
                <th scope="row">Full Name :</th>
                <td>{{ $admin->name }}</td>
              </tr>
              <tr>
                <th scope="row">Confirm_password :</th>
                <td>{{ $admin->mobile }}</td>
              </tr>
              <tr>
                <th scope="row">E-mail :</th>
                <td>{{ $admin->email }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end card -->
  </div>

  <div class="col-xl-8">
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <div class="d-flex">
          <span class="pt-1 p-2">
            <i class="kt-font-brand fa fa-align-left"></i>
          </span>
          <h3>
            Edit Profile </h3>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#profileEdit" role="tab" aria-selected="true">
              <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
              <span class="d-none d-sm-block">Profile Edit</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#passwordChange" role="tab" aria-selected="false">
              <span class="d-block d-sm-none"><i class="far fa-admin"></i></span>
              <span class="d-none d-sm-block">Password Change</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#addressChange" role="tab" aria-selected="false">
              <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
              <span class="d-none d-sm-block">Address Change</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#permissionChange" role="tab" aria-selected="false">
              <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
              <span class="d-none d-sm-block">Permission Change</span>
            </a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content p-3 text-muted">
          <div class="tab-pane active" id="profileEdit" role="tabpanel">
            <form>
              <div class="row mb-4">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="name" name="name" value="{{ @$admin->name }}"
                    placeholder="Enter Your Name">
                </div>
              </div>
              <div class="row mb-4">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" id="email" name="email" value="{{ @$admin->email }}"
                    placeholder="Enter Your Email ID">
                </div>
              </div>

              <div class="row mb-4">
                <label for="mobile" class="col-sm-3 col-form-label">Mobile NO.</label>
                <div class="col-sm-9">
                  <input type="mobile" class="form-control" id="mobile" name="mobile" value="{{ @$admin->mobile }}"
                    placeholder="Enter Your Mobile Number">
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-9">
                  <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="passwordChange" role="tabpanel">
            <form>
              <div class="row mb-4">
                <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="current_password" name="current_password"
                    placeholder="Enter Your Current_password">
                </div>
              </div>
              <div class="row mb-4">
                <label for="new_password" class="col-sm-3 col-form-label">New Password</label>
                <div class="col-sm-9">
                  <input type="new_password" class="form-control" id="new_password" name="new_password"
                    placeholder="Enter Your Email ID">
                </div>
              </div>

              <div class="row mb-4">
                <label for="confirm_password" class="col-sm-3 col-form-label">Confirm Password</label>
                <div class="col-sm-9">
                  <input type="confirm_password" class="form-control" id="confirm_password" name="confirm_password"
                    placeholder="Enter Your Confirm Password">
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-9">
                  <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="addressChange" role="tabpanel">
            <form>
              <div class="row mb-4">
                <label for="address" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="address" name="address"
                    placeholder="Enter Your Address">{{ @$admin->address }}</textarea>
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-9">
                  <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="permissionChange" role="tabpanel">
            <form method="post" id="dataForm">
              @csrf
              <div class="row mb-4">
                @include('admin.permissions')
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-9">
                  <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
@push('script')
<script>
  $(document).ready(function() {
            getPermissions({{ $admin->id }});
            $('#dataForm').on('submit', function(event) {
            event.preventDefault();
            var data = new FormData(this);
            data.append('adminId', {{ $admin->id }});
            var url = `{{ route('admin.admin_permissions_store') }}`;
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
                          getPermissions({{ $admin->id }})
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

        function getPermissions(adminId) {
            var url = `{{ route('admin.admin_permissions') }}`;
            if (adminId) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        adminId: adminId,
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