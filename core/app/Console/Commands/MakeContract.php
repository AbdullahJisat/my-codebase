<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeContract extends GeneratorCommand
{
    // /**
    //  * The name and signature of the console command.
    //  *
    //  * @var string
    //  */
    // protected $signature = 'make:contract';

    // /**
    //  * The console command description.
    //  *
    //  * @var string
    //  */
    // protected $description = 'Create a new contract interface';

    // /**
    //  * The type of class being generated.
    //  *
    //  * @var string
    //  */
    // protected $type = 'Contract';

    // /**
    //  * The name of class being generated.
    //  *
    //  * @var string
    //  */
    // private $contract;

    // /**
    //  * The name of class being generated.
    //  *
    //  * @var string
    //  */
    // private $model;


    // /**
    //  * Execute the console command.
    //  *
    //  * @return bool|null
    //  */
    // public function fire()
    // {

    //     $this->setContractClass();

    //     $path = $this->getPath($this->contract);

    //     if ($this->alreadyExists($this->getNameInput())) {
    //         $this->error($this->type . ' already exists!');

    //         return false;
    //     }

    //     $this->makeDirectory($path);

    //     $this->files->put($path, $this->buildClass($this->contract));

    //     $this->info($this->type . ' created successfully.');

    //     $this->line("<info>Created Repository :</info> $this->contract");
    // }

    // /**
    //  * Set repository class name
    //  *
    //  * @return  void
    //  */
    // private function setContractClass()
    // {
    //     $name = ucwords(strtolower($this->argument('name')));

    //     $this->model = $name;

    //     $modelClass = $this->parseName($name);

    //     $this->contract = $modelClass . 'Contract';

    //     return $this;
    // }

    // /**
    //  * Replace the class name for the given stub.
    //  *
    //  * @param  string  $stub
    //  * @param  string  $name
    //  * @return string
    //  */
    // protected function replaceClass($stub, $name)
    // {
    //     $stub = parent::replaceClass($stub, $name);

    //     return str_replace('DummyContract', $this->argument('name'), $stub);
    // }

    // /**
    //  * Get the stub file for the generator.
    //  *
    //  * @return string
    //  */
    // protected function getStub()
    // {
    //     return  app_path() . '/Console/Commands/Stubs/contract.stub';
    // }

    // /**
    //  * Get the console command arguments.
    //  *
    //  * @return array
    //  */
    // protected function getArguments()
    // {
    //     return [
    //         ['name', InputArgument::REQUIRED, 'The name of the contract.'],
    //     ];
    // }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:contract {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new contract interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Contract';

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    // protected function replaceClass($stub, $name)
    // {
    //     $stub = parent::replaceClass($stub, $name);

    //     return str_replace('Dummy', $this->argument('name'), $stub);
    // }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  app_path() . '/Console/Commands/Stubs/contract.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Contracts';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the contract.'],
        ];
    }
}
