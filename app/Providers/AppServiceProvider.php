<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;

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
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());
    }

    private function configureDefaults(): void
    {
        Number::useCurrency(config()->string('app.currency'));
        Number::useLocale(config()->string('app.locale'));
    }

    private function configureModels(): void
    {
        Model::automaticallyEagerLoadRelationships();
        Model::shouldBeStrict(app()->isLocal());

        /** @var array<string, class-string<Model>> $morphMap */
        $morphMap = collect(File::files(app_path('Models')))
            ->mapWithKeys(function (\SplFileInfo $file): array {
                $fileName = $file->getBasename('.php');
                $namespace = 'App\\Models\\'.$fileName;

                return is_subclass_of($namespace, Model::class)
                    ? [str($fileName)->snake()->toString() => $namespace]
                    : [];
            })
            ->toArray();

        Relation::enforceMorphMap($morphMap);
    }

    private function configureUrls(): void
    {
        URL::forceHttps(app()->isProduction());
    }
}
