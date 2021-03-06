<?php

namespace Bendani\PhpCommon\GoogleImageService\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class GoogleImageServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('bendani/php-common/google-image-service', 'GIS', __DIR__.'/../');

        View::addNamespace('GIS', __DIR__.'/../views');
    }


}