<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Nwidart\Modules\Commands\Make\ControllerMakeCommand;
use Nwidart\Modules\Support\Stub;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeControllerCommand extends ControllerMakeCommand
{
    protected $name = 'intcore:make-controller';

    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());
        return (new Stub($this->getStubName(), [
            'MODULENAME' => $module->getStudlyName(),
            'CONTROLLERNAME' => $this->getControllerName(),
            'NAMESPACE' => $module->getStudlyName(),
            'CLASS_NAMESPACE' => $this->getClassNamespace($module),
            'CLASS' => class_basename($this->getControllerName()),
            'LOWER_NAME' => $module->getLowerName(),
            'MODULE' => $this->getModuleName(),
            'NAME' => $this->getModuleName(),
            'STUDLY_NAME' => $module->getStudlyName(),
            'MODULE_NAMESPACE' => $this->laravel['modules']->config('namespace'),
            "REQUEST_NAMESPACE" => $this->laravel['modules']->config('namespace') . "\\" . $this->getModuleName() . "\Http\Requests\\".$this->getControllerNameWithoutController(),
            "SERVICES_NAMESPACE" => $this->laravel['modules']->config('namespace') . "\\" . $this->getModuleName() . "\Services\\".$this->getControllerNameWithoutController(),
            "_NAME" => $this->getControllerNameWithoutController(),
            "_LOWER_NAME_NAME" => strtolower($this->getControllerNameWithoutController()),
        ]))->render();
    }

    private function getControllerNameWithoutController()
    {
        return Str::replaceEnd("Controller", "", $this->argument('controller'));
    }

    protected function getStubName()
    {
        return "/intcore_controller.stub";
    }
}
