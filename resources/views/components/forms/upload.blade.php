<div class="fv-row mb-7 {{ $width }}">
    @isset($model)
        <label>Edit Attachments:</label>
        @foreach($model->media as $media)
            <div>
                <div class="media-container">
                    <a class="form-control " href="{{ $media->getUrl() }}" target="_blank">
                        {{ $media->name }}</a>
                    <a class="btn btn-icon btn-light-danger mr-3 btn-sm delete-attachment"
                       data-action="{{ route('admin.media.delete' , [$media->id,$model]) }}"
                       onclick="deleteMedia(this);" title="Delete Media">
                        <i class="fas fs-4 fa-trash"></i>
                    </a>
                </div>
            </div>
        @endforeach
    @endisset
    <label class="fs-6 fw-bold mb-2">{{ __($label) }}</label>
    <input type="file" class="form-control form-control-solid"
           @isset($isMultiple)
               multiple
           @endisset
           name="{{ $name }}"/>
    <div class="invalid-feedback" id="{{ $name }}Message"></div>
</div>

<style>
    .media-container {
        position: relative;
        display: inline-block;
    }

    .delete-attachment {
        position: absolute;
        top: 0;
        right: 0;
        margin-top: 5px;
        margin-right: 5px;
    }
</style>


