<div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <a class="btn btn-sm btn-outline-secondary py-2 dropdown-toggle d-flex align-items-center"
            id="bd-theme"
            type="button"
            aria-expanded="false"
            data-bs-toggle="dropdown"
            aria-label="Set language (auto)">{{ strtoupper(app()->getLocale()) }}
        <span class="visually-hidden" id="bd-theme-text">{{ trans('frontend.lang') }}</span>
    </a>

    @if(count(config('setting.available_languages', [])) > 1)
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            @foreach(config('setting.available_languages') as $langLocale => $langName)
                <li>
                    <a href="{{ url()->current() }}?change_language={{ $langLocale }}" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                        {{ strtoupper($langLocale) }} ({{ $langName }})
                        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>

