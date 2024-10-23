<?php

namespace Modules\Core\View\Components\Layouts;

use Modules\Core\Services\General\Auth\GetAuthAdminService;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use function view;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
//        $user = (new GetAuthAdminService())->get();

        return view('core::components.layouts.sidebar', ['user' => null]);
    }
}
