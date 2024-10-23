<?php

namespace Modules\Core\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use function view;

class UploadModal extends Component
{

    /**
     * Create the component instance.
     *
     * @param string $route
     * @param string $moduleName
     * @param string|null $id
     * @param string|null $sampleFilePath
     */
    public function __construct(
        public string  $route,
        public string  $moduleName,
        public ?string $id = null,
        public ?string $sampleFilePath = "",
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('core::components.modals.import');
    }
}
