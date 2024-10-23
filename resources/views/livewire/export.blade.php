    <div>
    <a wire:click="export" class="btn btn-dark btn-sm">Export</a>
    @if($exporting)
        <div class="d-inline" wire:poll="updateExportProgress">Exporting...</div>
    @endif
    @if($exportStatus == 'success')
        Done. download <a class="stretched-link" wire:click="downloadExport">here</a>
    @endif
</div>
