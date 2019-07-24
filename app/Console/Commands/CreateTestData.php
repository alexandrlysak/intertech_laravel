<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:data {--refresh}';

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
        $path = public_path().'/storage';
        
        if ($this->option('refresh')) {

            if (!File::exists($path)) {
                $this->call('storage:link');
            }

            if (File::exists($path.'/images')) {
                File::deleteDirectory($path.'/images');
                File::makeDirectory($path.'/images', $mode = 0777, true, true);
            }

            $columnName = 'Tables_in_' . env('DB_DATABASE');
            $tables = DB::select('SHOW TABLES');

            DB::statement("SET foreign_key_checks=0");
            foreach ($tables as $table) {
                if ($table->$columnName == 'migrations' || $table->$columnName == 'users') {
                    continue;
                }
                DB::table($table->$columnName)->truncate();
            }
            DB::statement("SET foreign_key_checks=1");
        }

        $this->call('db:seed');
    }
}
