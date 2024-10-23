<a href="{{ $url }}"
   class="{{ $class }}"

   @if($actionType == 'popup')
       data-bs-toggle="modal"
   data-bs-target="#edit_modal"
   @endif
   title="{{ $title }}">
    <i class="{{ $icon }}"></i>
</a>


