<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeSidebarLinkCommand extends Command
{
    use ModuleCommandTrait;

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'intcore:make-sidebar-link {module} {entity} {icon?}';

    // Command description
    protected $description = 'Add a new sidebar link to the configuration and append resource routes to web.php';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get input arguments
        $entity = $this->argument('entity');
        $icon = $this->argument('icon') ?? '<span class="bullet bullet-dot"></span>';

        // Add link to config file
        $this->addLinkToConfig($entity, $icon);

        // Append resource routes to web.php
        $this->appendRoutesToWeb($entity);

        $this->info("Sidebar link and routes have been added successfully.");
    }

    protected function addLinkToConfig($entity, $icon)
    {
        $configPath = $this->laravel['modules']->getModulePath($this->getModuleName()) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";

        if (!File::exists($configPath)) {
            $this->error('Config file not found.');
            return;
        }

        // Load existing config content
        $configContent = File::get($configPath);

        $title = ucfirst($entity);
        $routeName = "dashboard.".$this->getRouteName($entity).".index";

        // Prepare the new link array entry
        $newLink = <<<EOD
        [
            "title"     => "$title",
            "url"       => route('$routeName'),
            "icon"      => '$icon'
        ],
        //%APPEND_LINKS_HERE%
EOD;

        // Replace the placeholder //$APPEND_LINKS_HERE$ with the new link
        $configContent = str_replace('//%APPEND_LINKS_HERE%', $newLink, $configContent);

        // Write the updated config content back to the file
        File::put($configPath, $configContent);
    }

    protected function appendRoutesToWeb($entity)
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());
        $url = strtolower($this->getModuleName()) . "/" . strtolower($entity);
        $routeName = $this->getRouteName($entity);
        $controller = $this->laravel['modules']->config('namespace') . "\\" . $module->getStudlyName() .  "\Http\Controllers\\" . ucfirst($entity)."Controller::class";
        $routePath = $this->laravel['modules']->getModulePath($this->getModuleName()) . DIRECTORY_SEPARATOR . "routes" . DIRECTORY_SEPARATOR . "web.php";
        $routeDefinition = <<<EOD

// Resource route added by command
Route::resource('dashboard/$url', $controller)->names('dashboard.$routeName');

EOD;

        // Append the route definition to web.php
        File::append($routePath, $routeDefinition);
    }

    private function getRouteName($entity)
    {
        return strtolower($this->getModuleName()) . "." . strtolower($entity);
    }
}
