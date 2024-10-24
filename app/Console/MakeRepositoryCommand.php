<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Nwidart\Modules\Commands\Make\RepositoryMakeCommand;
use Nwidart\Modules\Support\Stub;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepositoryCommand extends RepositoryMakeCommand
{

    protected $name = 'intcore:make-repository';

    public function __construct()
    {
        parent::__construct();
    }

    protected function getTemplateContents(): string
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'CLASS_NAMESPACE' => $this->getClassNamespace($module),
            'CLASS' => class_basename($this->getRepositoryName()),
            "REPOSITORY_INTERFACE_NAMESPACE" => $this->laravel['modules']->config('namespace') . "\\" . $this->getModuleName() . "\Interfaces",
            "MODEL_NAMESPACE" => $this->laravel['modules']->config('namespace') . "\\" . $this->getModuleName() . "\Models",
            "MODEL" => $this->getModelName()
        ]))->render();
    }

    protected function getStubName(): string
    {
        return "/intcore_repository.stub";
    }

    private function getModelName()
    {
        return Str::replaceEnd("Repository", "", class_basename($this->getRepositoryName()));
    }
}
