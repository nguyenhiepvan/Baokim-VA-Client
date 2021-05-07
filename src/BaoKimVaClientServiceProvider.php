<?php
/**
 * @Created by : PhpStorm
 * @Author : Hiệp Nguyễn
 * @At : 07/05/2021, Friday
 * @Filename : BaoKimVaClientServiceProvider.php
 **/

namespace Nguyenhiep\BaoKimVaClient;


use Spatie\LaravelPackageTools\Package;
use \Spatie\LaravelPackageTools\PackageServiceProvider;

class BaoKimVaClientServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package->name("baokim-va-client")
            ->hasConfigFile();
    }
}