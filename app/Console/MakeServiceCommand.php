<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Nwidart\Modules\Commands\Make\ServiceMakeCommand;
use Nwidart\Modules\Support\Stub;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeServiceCommand extends ServiceMakeCommand
{
    /**
     * The name and signature of the console command.
     */
    protected $name = 'intcore:make-service';

    protected function getTemplateContents(): string
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'CLASS_NAMESPACE' => $this->getClassNamespace($module),
            'CLASS' => class_basename($this->getServiceName()),
            "_CLASS" => $this->getServiceNameWithoutService(),
            "LOWER_CLASS" => strtolower($this->getServiceNameWithoutService()),
            "REQUEST_NAMESPACE" => $this->laravel['modules']->config('namespace') . "\\" . $this->getModuleName() . "\Http\Requests\\".$this->getServiceNameWithoutService(),
            "REPOSITORY_NAMESPACE" => $this->laravel['modules']->config('namespace') . "\\" . $this->getModuleName() . "\Interfaces"
        ]))->render();
    }

    private function getServiceNameWithoutService()
    {
        return Str::replaceEnd("Service", "", class_basename($this->getServiceName()));
    }

    protected function getStubName(): string
    {
        return '/intcore_service.stub';
    }
}
