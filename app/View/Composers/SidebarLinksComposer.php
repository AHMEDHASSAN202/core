<?php

namespace Modules\Core\View\Composers;
use Illuminate\View\View;

class SidebarLinksComposer
{

    /**
     * Create a new profile composer.
     *
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->getFactory()->startPush("sidebar_links", \view("core::layouts.components.sidebar", ["links" => config("core.sidebar_links")])->render());
    }
}
