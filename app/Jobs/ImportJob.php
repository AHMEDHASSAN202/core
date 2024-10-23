<?php

namespace Modules\Core\Http\Jobs;

use App\Modules\Model\Imports\ModelImport;
use App\Modules\ProductCategory\Imports\ProductCategoriesImport;
use App\Modules\ProductGroup\Imports\ProductGroupsImport;
use App\Modules\Promoter\Imports\PromoterImport;
use App\Modules\Shop\Imports\ShopImport;
use App\Modules\Spec\Imports\SpecImport;
use App\Modules\Team\Imports\TeamImport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected $moduleName,
        protected $uploadFile,
        protected $user,
    ) {
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $excel = match ($this->moduleName) {
            'ProductCategory' => new ProductCategoriesImport($this->user, $this->moduleName),
            'ProductGroup' => new ProductGroupsImport($this->user, $this->moduleName),
            'Model' => new ModelImport($this->user, $this->moduleName),
            'Shop' => new ShopImport($this->user, $this->moduleName),
            'Spec' => new SpecImport($this->user, $this->moduleName),
            'Team' => new TeamImport($this->user, $this->moduleName),
            'Promoter' => new PromoterImport($this->user, $this->moduleName),
            default => 'unknown status code',
        };
        Excel::import($excel, $this->uploadFile);
    }
}
