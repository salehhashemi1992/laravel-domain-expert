<?php

namespace Salehhashemi\LaravelDomainExpert\Console\Custom;

use Illuminate\Routing\Console\ControllerMakeCommand;

class CustomMakeControllerCommand extends ControllerMakeCommand
{
    protected $signature = 'custom:make:controller {name : The name of the class} {--model= : The name of the model} {--resource : Indicate it should create a resource controller} {--invokable : Indicate it should create a single action controller} {--api : Exclude the create and edit methods from the controller} {--parent : Indicate it should create a nested resource controller} {--path= : The path where the controller should be created}';

    protected function getPath($name): string
    {
        $name = str_replace(['//', 'Controller'], ['/', ''], $name);

        $customPath = $this->option('path');
        if (!empty($customPath)) {
            return $customPath . '/' . $name . '.php';
        }

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }
}