<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Modules\Core\Providers\InstallServiceProvider;
use Modules\Core\Providers\CoreServiceProvider;
use Nwidart\Modules\Laravel\LaravelFileRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use function Laravel\Prompts\progress;
use function Laravel\Prompts\text;
use function Laravel\Prompts\info;

class InstallCommand extends Command
{
    protected string $moduleName = 'Core'; // Name of the module being installed
    private string $mainProvider = CoreServiceProvider::class; // Main provider class for the module

    // Command signature and description
    protected $signature = 'intcore-core:install';
    protected $description = 'Install Package Command';

    public function __construct()
    {
        parent::__construct(); // Call the parent constructor
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Prompt for the modules directory
        $directory = text('What is your modules directory?', "modules", "modules");

        // Setup progress display for installation steps
        $progress = progress(label: 'Install Package...', steps: 4);
        $progress->start();

        // Perform installation steps
        $this->copyModuleFiles($directory);
        $progress->advance();
        $this->updateModuleFile($directory);
        $progress->advance();
        $this->updateComposerFile($directory);
        $progress->advance();
        $this->updateGlobalComposerFile($directory);
        $progress->advance();

        // Enable the module after installation
        app(LaravelFileRepository::class)->resetModules();
        $this->call("module:enable", ["module" => $this->moduleName]);
        $progress->finish();

        // Notify user of successful installation
        info('Package installed successfully.');
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

    /**
     * Get the base path for the module.
     */
    private function getModulePath()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
    }

    /**
     * Copy module files to the specified directory.
     */
    private function copyModuleFiles($directory)
    {
        $toPath = $this->toModulePath($directory); // Destination path for module files

        // Create the directory if it does not exist
        if (!file_exists($toPath)) {
            mkdir($toPath, 0777, true);
        }

        // Copy directory contents
        $success = File::copyDirectory($this->getModulePath(), $toPath);
        if (!$success) {
            $this->fail("Can't Install Package"); // Handle failure
            return;
        }
    }

    /**
     * Get the full path to the module.
     */
    private function toModulePath($directory)
    {
        return app()->basePath() . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $this->moduleName . DIRECTORY_SEPARATOR;
    }

    /**
     * Update the module.json file with the main provider.
     */
    private function updateModuleFile($directory)
    {
        $modulePath = $this->toModulePath($directory) . "module.json";
        $moduleData = json_decode(file_get_contents($modulePath), true);

        // Ensure providers is an array
        $moduleData["providers"] = is_array($moduleData["providers"]) ? $moduleData["providers"] : [];

        // Remove the install provider if it exists
        $this->removeInstallProvider($moduleData["providers"]);

        // Add the main provider
        $moduleData["providers"][] = $this->mainProvider;
        $moduleData["providers"] = array_values($moduleData["providers"]); // Reindex the array

        // Save the updated module data back to the file
        file_put_contents($modulePath, json_encode($moduleData));
    }

    /**
     * Update the composer.json file with the main provider.
     */
    private function updateComposerFile($directory)
    {
        $composerPath = $this->toModulePath($directory) . "composer.json";
        $composerData = json_decode(file_get_contents($composerPath), true);

        // Ensure providers array exists
        $composerData["extra"]["laravel"]["providers"] = $composerData["extra"]["laravel"]["providers"] ?? [];

        // Remove the install provider if it exists
        $this->removeInstallProvider($composerData["extra"]["laravel"]["providers"]);

        // Add the main provider
        $composerData["extra"]["laravel"]["providers"][] = $this->mainProvider;
        $composerData["extra"]["laravel"]["providers"] = array_values($composerData["extra"]["laravel"]["providers"]); // Reindex the array

        // Save the updated composer data back to the file
        file_put_contents($composerPath, json_encode($composerData));
    }

    /**
     * Remove the InstallServiceProvider from the providers array.
     */
    private function removeInstallProvider(&$providers)
    {
        foreach ($providers as $key => $provider) {
            if ($provider === InstallServiceProvider::class) {
                unset($providers[$key]); // Remove the provider
            }
        }
    }

    private function updateGlobalComposerFile($directory)
    {
        $composerFilePath = base_path('composer.json');

        // Check if composer.json exists
        if (!File::exists($composerFilePath)) {
            $this->fail("composer.json not found");
            return;
        }

        // Get the content of composer.json
        $composerContent = File::get($composerFilePath);

        // Decode the JSON
        $composerJson = json_decode($composerContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->fail("Invalid JSON in composer.json");
            return;
        }

        // Modify the content (example: add a package)
        $jsonFilePath = $directory . DIRECTORY_SEPARATOR . $this->moduleName . DIRECTORY_SEPARATOR . "composer.json";
        $composerJson['extra']['merge-plugin']["include"] = $composerJson['extra']['merge-plugin']["include"] ?? [];
        $composerJson['extra']['merge-plugin']["include"][] = $jsonFilePath;

        // Encode the updated array back to JSON
        $newComposerContent = json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        // Write it back to composer.json
        $updated = File::put($composerFilePath, $newComposerContent);
        if (!$updated) {
            $this->fail("Can't update composer.json. Please add this file '".$jsonFilePath."' to extra['merge-plugin']['include'] array");
        }

        return;
    }
}
