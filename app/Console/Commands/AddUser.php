<?php

namespace App\Console\Commands;

use App\User;
use Hash;
use Illuminate\Console\Command;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user {email} {name} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds new user to database with specified data';

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
        User::create([
            'email' => $this->argument('email'),
            'name' => $this->argument('name'),
            'password' => Hash::make($this->argument('password'))
        ]);
    }
}
