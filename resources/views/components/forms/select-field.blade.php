{{--@dd($model->$relation()->pluck($name)->toArray())--}}
<div class="fv-row mb-7 {{ $width }}">
    <label class="fs-6 fw-bold mb-2">{{ __($label) }}</label>
    <select class="form-select form-control-solid datatable-input {{ $classes }}" data-control="select2"
            data-placeholder="@lang($placeholder ?: 'Select an option')" name="{{ $isMultiple ? $name.'[]' : $name }}"
            @if($isMultiple) multiple @endif
            id="{{$id}}"
            @if(isset($eventHandler)) onchange="{{$eventHandler}}" @endif>
        <option></option>
        @foreach($options as $option)
            @if(is_array($options))
                <option value="{{ $option['value'] }}"
                        @if($option['selected']) selected @endif> {{ $option['key'] }} </option>
            @else
                <option value="{{ $option->$selectedValue }}"
                        @if($isMultiple)
                            @if(isset($model) && in_array($option->$selectedValue, $model->$relation()->pluck($name)->toArray()))
                                selected
                        @endif
                        @else
                            @if(isset($model) && $model->$name == $option->$selectedValue) selected @endif
                    @endif
                >
                    {{ $option->$selectedLabel }}
                </option>
            @endif
        @endforeach
    </select>
    <div class="invalid-feedback" id="{{ $name }}Message"></div>
</div>
