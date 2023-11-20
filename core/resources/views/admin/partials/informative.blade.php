<div class="dropdown d-inline-block">
  <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown"
    aria-haspopup="true" aria-expanded="false">
    <img class="rounded-circle header-profile-user"
      src="{{ !empty(auth('admin')->user()->profile) ? asset('assets/images/admin/profile/'.auth('admin')->user()->profile) : asset('assets/images/noImage.png') }}"
      alt="Header Avatar">
    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ auth('admin')->user()->name }}</span>
    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
  </button>
  <div class="dropdown-menu dropdown-menu-end">
    <!-- item-->
    <a class="dropdown-item" href="{{ route('admin.admins.show', auth('admin')->user()->id) }}"><i
        class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
    <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span
        key="t-my-wallet">My Wallet</span></a>
    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i
        class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
    <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i>
      <span key="t-lock-screen">Lock screen</span></a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"
      onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
        class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">{{ __('Logout')
        }}</span></a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </div>
</div>