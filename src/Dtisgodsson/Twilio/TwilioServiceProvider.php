<?php namespace Dtisgodsson\Twilio;

use Illuminate\Support\ServiceProvider;

class TwilioServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('dtisgodsson/twilio');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Twilio', 'Dtisgodsson\Twilio\TwilioFacade');
        });

        $this->app['twilio'] = $this->app->share(function($app)
        {
            $config = \Config::get('twilio::config');

            return new Twilio($config['sid'], $config['auth_token'], $config['default_from_number']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['twilio'];
    }

}
