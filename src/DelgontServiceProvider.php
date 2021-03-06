<?php

namespace Delgont\Cms;

use Illuminate\Support\ServiceProvider;

use Illuminate\Routing\Router;
use Delgont\Cms\Concerns\RegistersCommands;



/**
 * Middleware
 */
use Delgont\Cms\Http\Middleware\Permission\Permission;
use Delgont\Cms\Http\Middleware\Permission\PermissionViaRole;
use Delgont\Cms\Http\Middleware\Permission\PermissionOrRole;


class DelgontServiceProvider extends ServiceProvider
{
    use RegistersCommands;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $helpers = glob( __DIR__.'/Helpers'.'/*.php');

        foreach($helpers as $key => $helper){
            require_once($helper);
        }

        $this->registerCommands();

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('permission', Permission::class);
        $router->aliasMiddleware('permissionViaRole', PermissionViaRole::class);
        $router->aliasMiddleware('permissionOrRole', PermissionOrRole::class);


        if ($this->app->runningInConsole()) {
            $this->registerPublishables();
            $this->registerCommands();
        }
        
    }

    private function registerPublishables() : void
    {
        //config file
        $this->publishes([
            __DIR__.'/../config/delgont.php' => config_path('delgont.php')
        ], 'delgont-config');

        $this->publishes([
            __DIR__.'/../config/web.php' => config_path('web.php')
        ], 'delgont-config-web');


        // DB Migrations
        $this->publishes([
            __DIR__.'/../database' => database_path(),
          ], 'delgont-database');
        
        // Overide where the user is redirected when not authenticated
        $this->publishes([
            __DIR__.'/../stubs/middlewares/Authenticate.php.stub' => app_path('Http/Middleware/Authenticate.php'),
          ], 'delgont-overwrite-not-authenticated-redirect');

        // Overide where to redirect users if authenticated
        $this->publishes([
            __DIR__.'/../stubs/middlewares/RedirectIfAuthenticated.php.stub' => app_path('Http/Middleware/RedirectIfAuthenticated.php'),
          ], 'delgont-overwrite-if-authenticated-redirect');
        
        // Overide User Model
        $this->publishes([
            __DIR__.'/../stubs/Models/User.php.stub' => app_path('User.php'),
        ], 'delgont-overwrite-user-model');

    }

  
}
