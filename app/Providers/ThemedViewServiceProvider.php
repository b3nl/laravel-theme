<?php
namespace b3nl\Theme\Providers;

use b3nl\Theme\Theme as ThemeModel;
use b3nl\Theme\Theme\FileViewFinder;
use Illuminate\View\ViewServiceProvider;

/**
 * Loads a new view file loader which uses a theme model.
 * @author b3nl <code@b3nl.de>
 * @category Providers
 * @package b3nl\Theme
 * @subpackage Providers
 * @version $id$
 */
class ThemedViewServiceProvider extends ViewServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->app->singleton('theme', function () {
            $theme = new ThemeModel();

            return $theme;
        });

        return parent::register();
    } // function

    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    public function registerViewFinder()
    {
        $this->app->singleton('view.finder', function ($app) {
            return new FileViewFinder($app['files']);
        });
    }
}
