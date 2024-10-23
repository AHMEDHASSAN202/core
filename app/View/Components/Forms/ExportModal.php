<?php

namespace Modules\Core\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use function view;

class ExportModal extends Component
{

    /**
     * Create the component instance.
     *
     * @param string $route
     * @param string $moduleName
     */
    public function __construct(
        public string $route,
        public string $moduleName,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('core::components.modals.export');
    }
}
