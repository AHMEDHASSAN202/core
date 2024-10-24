<?php

namespace Modules\Core\Providers;

use Modules\Core\Console\MakeViewCommand;
use Modules\Core\View\Composers\SidebarLinksComposer;
use Modules\Core\Console\CRUDCommand;
use Modules\Core\Console\MakeControllerCommand;
use Modules\Core\Console\MakeRepositoryCommand;
use Modules\Core\Console\MakeRepositoryInterfaceCommand;
use Modules\Core\Console\MakeServiceCommand;
use Modules\Core\Console\MakeSidebarLinkCommand;
use Modules\Core\View\Components\Actions\DeleteButton;
use Modules\Core\View\Components\Actions\EditButton;
use Modules\Core\View\Components\Actions\SubmitButton;
use Modules\Core\View\Components\Forms\DateTimeField;
use Modules\Core\View\Components\Forms\EmailField;
use Modules\Core\View\Components\Forms\ExportModal;
use Modules\Core\View\Components\Forms\NumberField;
use Modules\Core\View\Components\Forms\PasswordField;
use Modules\Core\View\Components\Forms\SelectField;
use Modules\Core\View\Components\Forms\TextField;
use Modules\Core\View\Components\Forms\UploadField;
use Modules\Core\View\Components\Forms\UploadModal;
use Modules\Core\View\Components\Layouts\Footer;
use Modules\Core\View\Components\Layouts\Header;
use Modules\Core\View\Components\Layouts\Sidebar;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Traits\PathNamespace;

class CoreServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Core';

    protected string $nameLower = 'core';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerComposers();
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
        $this->registerViewComponents();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
         $this->commands([
             MakeViewCommand::class,
             MakeSidebarLinkCommand::class,
             MakeControllerCommand::class,
             MakeServiceCommand::class,
             MakeRepositoryInterfaceCommand::class,
             MakeRepositoryCommand::class,
             CRUDCommand::class
         ]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->nameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->nameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->name, 'lang'), $this->nameLower);
            $this->loadJsonTranslationsFrom(module_path($this->name, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->name, 'config/config.php') => config_path($this->nameLower.'.php')], 'config');
        $this->mergeConfigFrom(module_path($this->name, 'config/config.php'), $this->nameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->nameLower);
        $sourcePath = module_path($this->name, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->nameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->nameLower);

        $componentNamespace = $this->module_namespace($this->name, $this->app_path(config('modules.paths.generator.component-class.path')));
        Blade::componentNamespace($componentNamespace, $this->nameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->nameLower)) {
                $paths[] = $path.'/modules/'.$this->nameLower;
            }
        }

        return $paths;
    }

    private function registerViewComponents()
    {
        Blade::component('layouts.sidebar', Sidebar::class);
        Blade::component('layouts.header', Header::class);
        Blade::component('layouts.footer', Footer::class);

        Blade::component('actions.submit-button', SubmitButton::class);
        Blade::component('actions.edit-button', EditButton::class);
        Blade::component('actions.delete-button', DeleteButton::class);

        Blade::component('forms.text-field', TextField::class);
        Blade::component('forms.number-field', NumberField::class);
        Blade::component('forms.date-time-field', DateTimeField::class);
        Blade::component('forms.email-field', EmailField::class);
        Blade::component('forms.select-field', SelectField::class);
        Blade::component('forms.upload-field', UploadField::class);
        Blade::component('forms.password-field', PasswordField::class);

        Blade::component('modals.import', UploadModal::class);
        Blade::component('modals.export', ExportModal::class);

//        // TODO; remove it
//        Livewire::component('export-component', Export::class);
//        Livewire::component('import-component', Import::class);
    }

    private function registerComposers()
    {
        \view()->composer("core::components.layouts.sidebar", SidebarLinksComposer::class);
    }
}
