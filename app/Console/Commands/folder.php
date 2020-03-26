<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class folder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'folder {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Folder';

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
        // $bar = $this->output->createProgressBar(count());
        // $bar->finish();

        mkdir($this->argument('name'));
        $this->info("New Folder '".$this->argument('name')."' has created!");
    }
}
