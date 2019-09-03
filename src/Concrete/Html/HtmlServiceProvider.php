<?php
namespace HtmlResourceHints\Html;

use Concrete\Core\Foundation\Service\Provider as ServiceProvider;
use HtmlResourceHints\Html\Service\Resource;

class HtmlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('html/resource', Resource::class);
    }
}
