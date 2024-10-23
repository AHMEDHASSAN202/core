<div class="fv-row mb-7 {{ $width }}">
    <label class="fs-6 fw-bold mb-2">{{ __($label) }}</label>
    <input type="{{ $type }}" class="form-control form-control-solid {{ $classes }}"
           id="{{$id}}"
           name="{{ $name }}"
           value="{{ $value }}"
           @if(isset($eventHandler)) onchange="{{$eventHandler}}" @endif/>
    <div class="invalid-feedback" id="{{ $name }}Message"></div>
</div>

