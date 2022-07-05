<?php

namespace Delgont\Cms\Concerns;

/**
 * Commands
 */
use Delgont\Cms\Console\Commands\InstallCommand;
use Delgont\Cms\Console\Commands\UserCommand;
use Delgont\Cms\Console\Commands\UserCreateCommand;
use Delgont\Cms\Console\Commands\UserListCommand;
use Delgont\Cms\Console\Commands\CategorySyncCommand;

trait RegistersCommands
{
    private function registerCommands() : void
    {
        $this->commands([
            InstallCommand::class,
            UserCreateCommand::class,
            UserListCommand::class,
            CategorySyncCommand::class
        ]);
    }
}