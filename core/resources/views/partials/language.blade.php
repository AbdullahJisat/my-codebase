<div class="dropdown d-inline-block">
  <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    <img id="header-lang-img" src="{{ getImage(imagePath()['flags']['path'].defaultLanguage()->flag) }}"
      alt="{{ defaultLanguage()->code }}" height="16">
  </button>
  <div class="dropdown-menu dropdown-menu-end">
    @foreach (languages() as $language)
    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="{{ $language->code }}">
      <img
        src="{{ @!empty($language->flag) ? asset('assets/images/flags/'.$language->flag) : asset('assets/images/noImage.png') }}"
        alt="user-image" class="me-1" height="12">
      <span class="align-middle">{{ $language->name }}</span>
    </a>
    @endforeach
  </div>
</div>