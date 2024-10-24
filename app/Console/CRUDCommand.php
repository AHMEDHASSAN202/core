<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Modules\Core\Providers\InstallServiceProvider;
use Modules\Core\Providers\CoreServiceProvider;
use Nwidart\Modules\Laravel\LaravelFileRepository;
use Nwidart\Modules\Support\Stub;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use function Laravel\Prompts\progress;
use function Laravel\Prompts\text;
use function Laravel\Prompts\info;

class CRUDCommand extends Command
{
    protected $signature = 'intcore:make-crud {module} {entity}';

    protected $description = 'Generate CRUD Command';

    public function __construct()
    {
        parent::__construct();
        Stub::setBasePath(config("core.stubs.path"));
    }

    public function handle()
    {
        $module = $this->argument("module");
        $entity = $this->argument("entity");

        // Model
        $this->call('module:make-model', [
            'model' => ucfirst($entity),
            'module' => $module,
            "-m"     => true,
        ]);

        // Controller
        $this->call('intcore:make-controller', [
            'controller' => ucfirst($entity) . 'Controller',
            'module' => $module,
        ]);

        // Requests
        $this->call('module:make-request', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR . 'CreateRequest',
            'module' => $module,
        ]);

        $this->call('module:make-request', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR . 'UpdateRequest',
            'module' => $module,
        ]);

        $this->call('module:make-request', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR . 'IndexRequest',
            'module' => $module,
        ]);

        $this->call('module:make-request', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR . 'DeleteRequest',
            'module' => $module,
        ]);

        // Listener
        $this->call('module:make-listener', [
            'name' => ucfirst($entity) . 'Listener',
            'module' => $module,
        ]);

        // Jobs
        $this->call('module:make-job', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR . 'AfterCreateJob',
            'module' => $module,
        ]);

        $this->call('module:make-job', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR . 'AfterUpdateJob',
            'module' => $module,
        ]);

        $this->call('module:make-job', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR .  'AfterDeleteJob',
            'module' => $module,
        ]);

        // Policy
        $this->call('module:make-policy', [
            'name' => ucfirst($entity) . 'Policy',
            'module' => $module,
        ]);

        // Resources
        $this->call('module:make-resource', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR . 'ListResource',
            'module' => $module,
            '--collection' => true,
        ]);

        // Resources
        $this->call('module:make-resource', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR .  'FindResource',
            'module' => $module,
        ]);

        // Repository
        $this->call('intcore:make-repository', [
            'name' => ucfirst($entity)."Repository",
            'module' => $module,
        ]);

        // RepositoryInterface
        $this->call('intcore:make-repository-interface', [
            'name' => ucfirst($entity)."RepositoryInterface",
            'module' => $module,
        ]);

        // Service
        $this->call('intcore:make-service', [
            'name' => ucfirst($entity) . DIRECTORY_SEPARATOR . ucfirst($entity) . 'Service',
            'module' => $module,
        ]);

        // Add Sidebar Links
        $this->call('intcore:make-sidebar-link', [
            'entity' => $entity,
            'icon' => null,
            'module' => $module,
        ]);

        // Add View Links
        $this->call('intcore:make-view', [
            'name' => $entity,
            'module' => $module,
        ]);
    }
}
