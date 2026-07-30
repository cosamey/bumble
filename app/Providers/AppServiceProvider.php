<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Laravel\Head\Enums\ImageType;
use Laravel\Head\Enums\OgType;
use Laravel\Head\Facades\Head;
use Laravel\Head\HeadBuilder;
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
        Head::defaults(function (HeadBuilder $head): void {
            $head
                ->title('Bumble', suffix: ' | Bumble')
                ->canonical(forceHttps: app()->isProduction())
                ->robots(app()->isProduction() ? 'index,follow' : 'noindex,nofollow')
                ->viewport('width=device-width, initial-scale=1')
                ->meta('author', 'Cosa Mey')
                ->colorScheme('only light')
                ->themeColor('#ffffff')
                ->og(
                    type: OgType::Website,
                    siteName: 'Bumble',
                    image: asset('assets/img/open-graph.jpg'),
                    locale: app()->getLocale(),
                )
                ->icon(
                    asset('assets/img/icons/icon-512.svg'),
                    type: ImageType::Svg,
                )
                ->icon(
                    asset('assets/img/icons/icon-32.png'),
                    type: ImageType::Png,
                    sizes: '32x32',
                )
                ->appleTouchIcon(asset('assets/img/icons/icon-180.png'))
                ->manifest(asset('manifest.json'));
        });

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
