<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create app database & test data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('storage:link');
        $path = public_path().'/storage/images';
        File::makeDirectory($path, $mode = 0777, true, true);
        
        $this->call('migrate:refresh', ['--seed' => 'default']);
    }
}
