<?php

namespace Modules\Core\Http\Livewire;

use Modules\Core\Http\Jobs\ImportJob;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Import extends Component
{
    use WithFileUploads;

    public string $batchId;
    public $importFile;
    public bool $importing = false;
    public string $importStatus = 'pending';
    public string $importFilePath;
    public string $moduleName;

    public function import(): void
    {
        $this->validate([
            'importFile' => 'required'
        ]);
        $this->importing = true;
        $this->importFilePath = $this->importFile->store('imports');
        $this->importStatus = 'pending';
        $batch = Bus::batch([
            new ImportJob($this->moduleName, $this->importFilePath),
        ])->dispatch();
        $this->batchId = $batch->id;
    }

    /**
     * @return Batch|null
     */
    public function getImportBatchProperty(): ?Batch
    {
        if (!$this->batchId) {
            return null;
        }
        return Bus::findBatch($this->batchId);
    }

    /**
     * @return void
     */
    public function updateImportProgress(): void
    {
        if ($this->importBatch->hasFailures()) {
            $this->importStatus = 'fail';
        } else {
            if ($this->importBatch->finished() && !$this->importBatch->hasFailures()) {
                $this->importStatus = 'success';
            } else {
                $this->importStatus = 'pending';
            }
        }

        if ($this->importStatus != 'pending') {
            $this->importing = false;
            Storage::delete($this->importFilePath);
        }
    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('Core::livewire.import');
    }

    public function mount($moduleName = null)
    {
        $this->moduleName = $moduleName;
    }
}
