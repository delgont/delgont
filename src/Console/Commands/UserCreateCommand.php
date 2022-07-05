<?php

namespace Delgont\Cms\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Str;


class UserCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create
                            {--default : If to create default user or not}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';


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
        if($this->option('default')){
            $this->createDefaultUser();
            return;
        }

        $this->createUser();
       
    }

    private function createDefaultUser() : void 
    {
        User::create([
            'name' => 'stephen.okello',
            'email' => 'stephen.okello@gmail.com',
            'password' => bcrypt('secret'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);
        $this->info('User created sussfully');
        $this->info('To login use Email: stephen.okello@gmail.com & Password: secret');

        
        
    }

    private function createUser() : void 
    {
        $username = $this->ask('username');
        $email = $this->ask('Enter Email Address?');
        $password = $this->ask('Enter Password?');

        User::create([
            'name' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);
    }
    
}
