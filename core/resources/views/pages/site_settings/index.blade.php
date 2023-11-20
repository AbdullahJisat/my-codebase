@extends('admin.layouts.app')
@section('content')
<div class="checkout-tabs">
  <div class="row">
    <div class="col-lg-2">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques" role="tab"
          aria-controls="v-pills-gen-ques" aria-selected="true">
          <i class="bx bx-question-mark d-block check-nav-icon mt-4 mb-2"></i>
          <p class="fw-bold mb-4">Logo Icon</p>
        </a>
        <a class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy" role="tab"
          aria-controls="v-pills-privacy" aria-selected="false">
          <i class="bx bx-check-shield d-block check-nav-icon mt-4 mb-2"></i>
          <p class="fw-bold mb-4">Server and Application</p>
        </a>
        <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support" role="tab"
          aria-controls="v-pills-support" aria-selected="false">
          <i class="bx bx-support d-block check-nav-icon mt-4 mb-2"></i>
          <p class="fw-bold mb-4">Cache </p>
        </a>
      </div>
    </div>
    <div class="col-lg-10">
      <div class="card">
        <div class="card-body">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade active show" id="v-pills-gen-ques" role="tabpanel"
              aria-labelledby="v-pills-gen-ques-tab">
              <h4 class="card-title mb-5">General Questions</h4>
              @include('pages.site_settings.logo_icon')
            </div>
            <div class="tab-pane fade" id="v-pills-privacy" role="tabpanel" aria-labelledby="v-pills-privacy-tab">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <h4 class="card-title mb-5">Server Information</h4>
                  @include('pages.site_settings.server')
                </div>
                <div class="col-md-6 col-sm-12">

                  <h4 class="card-title mt-3 mb-5">Server Information</h4>
                  @include('pages.site_settings.application')
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-support" role="tabpanel" aria-labelledby="v-pills-support-tab">
              <h4 class="card-title mb-5">Support</h4>
              @include('pages.site_settings.optimize')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection