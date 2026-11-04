<?php

namespace spkm\Topdesk;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TopdeskServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('topdesk')
            ->hasConfigFile('topdesk')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command->publishConfigFile();
            });

        $this->app->singleton('topdesk', fn ($app) => new TopdeskService);
    }
}
