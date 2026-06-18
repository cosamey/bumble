<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Mey\Spine\Support\ModelMorphMap;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureCommands();
        $this->configureDefaults();
        $this->configureModels();
        $this->configureUrls();
        $this->configureVite();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());
    }

    private function configureDefaults(): void
    {
        Number::useCurrency(config()->string('app.currency', 'EUR'));
        Number::useLocale(config()->string('app.locale', 'en_US'));
    }

    private function configureModels(): void
    {
        Model::automaticallyEagerLoadRelationships();
        Model::shouldBeStrict(app()->isLocal());
        Model::unguard();

        Relation::enforceMorphMap(ModelMorphMap::fromModels());
    }

    private function configureUrls(): void
    {
        URL::forceHttps(app()->isProduction());
    }

    private function configureVite(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
