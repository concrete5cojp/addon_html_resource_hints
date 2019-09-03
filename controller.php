<?php

/**
 * Class Controller.
 *
 * @author: Biplob Hossain <biplob@concrete5.co.jp>
 *
 * @license MIT
 * Date: 2019/08/30
 */
namespace Concrete\Package\HtmlResourceHints;

use Concrete\Core\Foundation\Service\ProviderList;
use Concrete\Core\Package\Package;
use HtmlResourceHints\Html\HtmlServiceProvider;

class Controller extends Package
{
    protected $pkgHandle = 'html_resource_hints';
    protected $appVersionRequired = '8.5.1';
    protected $pkgVersion = '0.0.1';
    protected $pkgAutoloaderRegistries = [
        'src/Concrete' => '\HtmlResourceHints',
    ];

    public function getPackageDescription()
    {
        return t('Insert HTML resource hints into HEAD tag');
    }

    public function getPackageName()
    {
        return t('HTML Resource Hints');
    }

    public function on_start()
    {
        if ($this->getPackageEntity()->isPackageInstalled()) {
            /** @var ProviderList $providerList */
            $providerList = $this->app->make(ProviderList::class);
            $providerList->registerProvider(HtmlServiceProvider::class);
        }
    }
}
