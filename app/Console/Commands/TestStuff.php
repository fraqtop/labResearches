<?php

namespace App\Console\Commands;

use App\Helpers\Filter;
use App\Models\Analysis;
use Illuminate\Console\Command;

class TestStuff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:stuff';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $anal = new Analysis;
        print_r($anal->getFillable());
    }
}
