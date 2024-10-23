<?php

namespace Modules\Core\Http\Livewire;

use Modules\Core\Http\Jobs\ExportJob;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Export extends Component
{
    public string $batchId;
    public bool $exporting = false;
    public string $exportStatus = 'pending';
    public string $moduleName;

    public function export(): void
    {
        $this->exporting = true;
        $this->exportStatus = 'pending';
        $batch = Bus::batch([
            new ExportJob($this->moduleName),
        ])->dispatch();
        $this->batchId = $batch->id;
    }

    /**
     * @return Batch|null
     */
    public function getExportBatchProperty(): ?Batch
    {
        if (!$this->batchId) {
            return null;
        }
        return Bus::findBatch($this->batchId);
    }

    /**
     * @return void
     */
    public function updateExportProgress(): void
    {
        if ($this->exportBatch->hasFailures()) {
            $this->exportStatus = 'fail';
        } else {
            if ($this->exportBatch->finished() && !$this->exportBatch->hasFailures()) {
                $this->exportStatus = 'success';
            } else {
                $this->exportStatus = 'pending';
            }
        }

        if ($this->exportStatus != 'pending') {
            $this->exporting = false;
        }
    }

    /**
     * @return StreamedResponse
     */
    public function downloadExport(): StreamedResponse
    {
        return Storage::download('public/transactions.csv');
    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('Core::livewire.export');
    }

    public function mount($moduleName = null)
    {
        $this->moduleName = $moduleName;
    }
}
