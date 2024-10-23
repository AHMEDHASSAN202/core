<div>
    <form wire:submit.prevent="import" enctype="multipart/form-data">
        @csrf
        <input type="file" class="btn btn-dark btn-sm" wire:model="importFile">
        <button class="btn btn-outline-secondary" >Import</button>
        @error('import_file')
            <span class="invalid-feedback" role="alert">{{$message}}</span>
        @enderror
    </form>
    @if($importing)
        <div class="d-inline" wire:poll="updateImportProgress">Importing... Please Wait</div>
    @endif
    @if($importStatus == 'success')
        Importing Finished
    @endif
</div>
