<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Str;
use Nwidart\Modules\Commands\Make\ViewMakeCommand;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Support\Stub;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeViewCommand extends ViewMakeCommand
{
    /**
     * The name and signature of the console command.
     */
    protected $name = 'intcore:make-view';

    protected function getTemplateContents(): string
    {
        return (new Stub('/intcore_view.stub', ['QUOTE' => Inspiring::quotes()->random(), "NAME" => ucfirst($this->argument("name"))]))->render();
    }

    private function getFileName(): string
    {
        return Str::lower($this->argument('name')) . DIRECTORY_SEPARATOR .'index.blade.php';
    }

    protected function getDestinationFilePath(): string
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());
        $factoryPath = GenerateConfigReader::read('views');

        return $path.$factoryPath->getPath().'/'.$this->getFileName();
    }
}
