<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.site_settings.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="mb-3 row">
          <label for="siteName" class="col-md-2 col-form-label">Site Name</label>
          <div class="col-md-10">
            <input class="form-control" type="text" id="siteName" value="{{ getSiteName() }}" name="site_name">
          </div>
        </div>
        <div class="form-group col-xl-4">
          <div class="image-upload">
            <div class="thumb">
              <div class="avatar-preview">
                <div class="profilePicPreview logoPicPrev"
                  style="background-color: #495057;background-image: url({{ asset('assets/images/logo/logo-dark.png') }}">
                  <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="avatar-edit">
                <input type="file" class="profilePicUpload" hidden id="logoDark" accept=".png, .jpg, .jpeg"
                  name="logoDark">
                <label for="logoDark" class="mt-3 btn btn-primary">@lang('Select Dark Logo')</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group col-xl-4">
          <div class="image-upload">
            <div class="thumb">
              <div class="avatar-preview">
                <div class="profilePicPreview logoPicPrev"
                  style="background-image: url({{ asset('assets/images/logo/logo-light.png') }}">
                  <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="avatar-edit">
                <input type="file" class="profilePicUpload" hidden id="logoLight" accept=".png, .jpg, .jpeg"
                  name="logoLight">
                <label for="logoLight" class="mt-3 btn btn-primary">@lang('Select Light Logo')</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group col-xl-4">
          <div class="image-upload">
            <div class="thumb">
              <div class="avatar-preview">

                <div class="profilePicPreview logoPicPrev"
                  style="background-image: url({{ asset('assets/images/logo/favicon.ico') }}">
                  <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="avatar-edit">
                <input type="file" class="profilePicUpload" hidden name="favicon" id="favIcon"
                  accept=".png, .jpg, .jpeg">
                <label for="favIcon" class="mt-3 btn btn-primary">@lang('Select Favicon')</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-md">{{ __('Submit') }}</button>
    </form>
  </div>
</div>