<?php

namespace Modules\Core\Http\Jobs;

use App\Jobs\SendEmailExport;
use App\Modules\Area\Exports\AreasExport;
use App\Modules\Attendance\Exports\AttendanceExport;
use App\Modules\ChannelType\Exports\ChannelTypesExport;
use App\Modules\Display\Exports\DisplayExport;
use App\Modules\Model\Exports\ModelExport;
use App\Modules\ProductCategory\Exports\ProductCategoriesExport;
use App\Modules\ProductGroup\Exports\ProductGroupsExport;
use App\Modules\Promoter\Exports\PromoterExport;
use App\Modules\Promoter\Exports\PromoterSuspendedExport;
use App\Modules\Region\Exports\RegionsExport;
use App\Modules\Sellout\Exports\SelloutExport;
use App\Modules\Shop\Exports\ShopExport;
use App\Modules\Spec\Exports\SpecsExport;
use App\Modules\Team\Exports\TeamsExport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected       $moduleName,
        protected       $admin,
        protected array $request,
    )
    {
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $filePath = 'exports/' . $this->moduleName . '_' . date('d-m-Y') . '.xlsx';
        $fullFilePath = public_path().'/uploads/exports/' . $this->moduleName . '_' . date('d-m-Y') . '.xlsx';

        $excel = match ($this->moduleName) {
            'ProductCategory' => new ProductCategoriesExport($this->request, admin: $this->admin),
            'ProductGroup' => new ProductGroupsExport($this->request, admin: $this->admin),
            'Region' => new RegionsExport($this->request, admin: $this->admin),
            'Area' => new AreasExport($this->request, admin: $this->admin),
            'Promoter' => new PromoterExport($this->request, admin: $this->admin),
            'PromoterSuspended' => new PromoterSuspendedExport($this->request, admin: $this->admin),
            'Shop' => new ShopExport($this->request, admin: $this->admin),
            'Attendance' => (new AttendanceExport($this->request, admin: $this->admin)),
            'Model' => new ModelExport($this->request, admin: $this->admin),
            'Sellout' => new SelloutExport($this->request,admin: $this->admin),
            'Display' => new DisplayExport($this->request, admin: $this->admin),
            'ChannelType' => new ChannelTypesExport($this->request, admin: $this->admin),
            'Spec' => new SpecsExport($this->request, admin: $this->admin),
            'Team' => new TeamsExport($this->request, admin: $this->admin),
            default => 'unknown status code',
        };

        $excel->queue($filePath, env('FILESYSTEM_DRIVER'))
            ->chain([
                new SendEmailExport($this->admin, $fullFilePath),
            ]);



    }
}
