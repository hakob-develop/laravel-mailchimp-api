<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libs\Mailchimp\Mailchimp;

class MailchimpServiceProvider extends ServiceProvider {

    /**
     * Set up the publishing of configuration
     */
    public function boot()
    {
        //
    }

    /**
     * Register the Mailchimp Instance to be set up with the API-key.
     * Then, the IoC-container can be used to get a Mailchimp instance ready for use.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Mailchimp::class, function($app) {
            $config = $app['config']['mailchimp'];
            return new Mailchimp($config['apikey']);
        });
    }
}
