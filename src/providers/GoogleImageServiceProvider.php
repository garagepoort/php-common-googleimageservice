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
        $this->package('bendani/php-common/google-image-service');

        View::addNamespace('bendani/php-common/google-image-service', __DIR__.'/../views');
    }


}