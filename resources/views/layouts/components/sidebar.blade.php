<div data-kt-menu-trigger="click"
     class="menu-item menu-accordion hover"
     id="promoters-dropdown">
                        <span class="menu-link">
                            <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                        fill="white"/>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="white"/>
                                </svg>
                            </span>
                        </span>
                            <span class="menu-title">Core</span>
                            <span class="menu-arrow"></span>
                        </span>
    <div
        class="menu-sub menu-sub-accordion"
        style="" kt-hidden-height="80">
        @foreach($links ?? [] as $link)
            <div class="menu-item">
                <a class="menu-link"
                   href="{{ $link["url"] }}">
                    <span class="menu-bullet">{!! $link["icon"] !!}</span>
                    <span class="menu-title"> {{ $link["title"] }} </span>
                </a>
            </div>
        @endforeach
    </div>
</div>
