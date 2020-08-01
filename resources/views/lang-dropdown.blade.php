<div class="dropdown">
  <button class="btn btn-outline text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{__('messages.textLangDropdown')}}
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    @if(!App::isLocale('en'))
        <a class="dropdown-item" href="/lang/en">English</a>
    @endif
    @if(!App::isLocale('vi'))
        <a class="dropdown-item" href="/lang/vi">tiếng Việt</a>
    @endif
    @if(!App::isLocale('de'))
        <a class="dropdown-item" href="/lang/de">Deutsche</a>
    @endif
  </div>
</div>