<?php
namespace DrawMyAttention\XeroLaravel\Providers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class XeroServiceProvider extends ServiceProvider
{
    private $config = 'xero/config.php';

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config.php' => config_path($this->config),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Use the published configuration file if it exists.
        if(file_exists(config_path($this->config))) {
            $configPath = config_path($this->config);
            $config = include $configPath;
        } else {
            // Use the default package configuration as a fallback.
            $config = include __DIR__ . '/../config.php';
        }

        $this->app->bind('XeroPrivate', function () use ($config) {
            return new \XeroPHP\Application\PrivateApplication($config);
        });

        $this->app->bind('XeroPublic', function () use ($config) {
            return new \XeroPHP\Application\PublicApplication($config);
        });

        $this->app->bind('XeroPartner', function () use ($config) {
            return new \XeroPHP\Application\PartnerApplication($config);
        });

        $this->app->bind('XeroInvoice', function(){
           return new \XeroPHP\Models\Accounting\Invoice();
        });

        $this->app->bind('XeroInvoiceLine', function(){
            return new \XeroPHP\Models\Accounting\Invoice\LineItem();
        });

        $this->app->bind('XeroContact', function(){
            return new \XeroPHP\Models\Accounting\Contact();
        });

        $this->app->bind('XeroBrandingTheme', function(){
            return new \XeroPHP\Models\Accounting\BrandingTheme();
        });

        $this->app->bind('XeroAttachment', function(){
            return new \XeroPHP\Models\Accounting\Attachment();
        });
    }
}