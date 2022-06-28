<?php

namespace Delgont\Cms\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delgont:install
                            {--user : Overwrite Default User Model}
                            {--auth : Overwrite authentication middlewares}';

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
        $this->info('Hello there how are you doing');

        if($this->option('auth')){
            $this->overWriteAuthMiddlewares();
            return;
        }

        if($this->option('user')){
            $this->overWriteUserModel();
            return;
        }

        $this->overWriteAuthMiddlewares();
        $this->overWriteUserModel();
    }

    private function overWriteAuthMiddlewares() : void
    {
        $this->call('vendor:publish', ['--tag' => 'delgont-overwrite-if-authenticated-redirect', '--force' => true]);
        $this->info('RedirectIfAuthenticated Middleware has been overwritten by delgont logic');
        $this->call('vendor:publish', ['--tag' => 'delgont-overwrite-not-authenticated-redirect', '--force' => true]);
        $this->info('Authenticated Middleware has been overwritten by delgont logic');
    }

    private function overWriteUserModel() : void
    {
        $this->call('vendor:publish', ['--tag' => 'delgont-overwrite-user-model', '--force' => true]);
        $this->info('User model has been overwritten');
    }
}
