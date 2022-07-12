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
use Delgont\Cms\Console\Commands\OptionSyncCommand;
use Delgont\Cms\Console\Commands\OptionListCommand;
use Delgont\Cms\Console\Commands\OptionCreateCommand;
use Delgont\Cms\Console\Commands\OptionUpdateCommand;
use Delgont\Cms\Console\Commands\OptionDeleteCommand;
use Delgont\Cms\Console\Commands\PageSyncCommand;

trait RegistersCommands
{
    private function registerCommands() : void
    {
        $this->commands([
            InstallCommand::class,
            UserCreateCommand::class,
            UserListCommand::class,
            CategorySyncCommand::class,
            OptionSyncCommand::class,
            OptionListCommand::class,
            OptionCreateCommand::class,
            OptionUpdateCommand::class,
            OptionDeleteCommand::class,
            PageSyncCommand::class
        ]);
    }
}