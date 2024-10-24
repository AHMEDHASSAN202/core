<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Nwidart\Modules\Commands\Make\InterfaceMakeCommand;
use Nwidart\Modules\Support\Stub;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepositoryInterfaceCommand extends InterfaceMakeCommand
{
    /**
     * The name and signature of the console command.
     */
    protected $name = 'intcore:make-repository-interface';

    protected function getTemplateContents(): string
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'CLASS_NAMESPACE' => $this->getClassNamespace($module),
            'CLASS' => class_basename($this->getInterfaceName()),
            "REQUEST_NAMESPACE" => $this->laravel['modules']->config('namespace') . "\\" . $this->getModuleName() . "\Http\Requests\\".$this->getEntityName()
        ]))->render();
    }

    protected function getStubName(): string
    {
        return '/intcore_repository_interface.stub';
    }

    private function getEntityName()
    {
        return Str::replaceEnd("RepositoryInterface", "", $this->argument("name"));
    }
}
