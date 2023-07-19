<?php

namespace MiniBlog\Shared\Infrastructure\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SourceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom($this->basePath('Resources/views/'), 'views');
    }

    public function boot()
    {
        $migrationPath = $this->basePath('Database/migrations/');
        $seederPath = $this->basePath('Database/seeders/DatabaseSeeder.php');
        $configPath = $this->basePath('Config/setting.php');
        $assetsPath = $this->basePath('Resources/assets');
        $languagePath = $this->basePath('Resources/lang');

        $this->publishes([$seederPath => database_path('seeders/DatabaseSeeder.php')], 'miniblog.seeders');
        $this->publishes([$assetsPath => base_path('public/assets')], 'miniblog.assets');
        $this->publishes([$languagePath => base_path('resources/lang')], 'miniblog.lang');
        $this->publishes([$configPath => config_path('setting.php')], 'miniblog.config');

        $this->loadMigrationsFrom($migrationPath);
        $this->mergeConfigFrom($configPath, 'miniblog');

        $this->commands([]);
    }

    protected function basePath($path = ''): string
    {
        return base_path(sprintf('src/Shared/Infrastructure/%s', $path));
    }
}
