<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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
        $path = public_path().'/storage/images';
        
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        $this->call('storage:link');
        
        File::makeDirectory($path, $mode = 0777, true, true);
        
        $this->call('migrate:refresh', ['--seed' => 'default']);
    }
}
