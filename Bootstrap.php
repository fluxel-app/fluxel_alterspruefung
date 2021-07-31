<?php


namespace Plugin\fluxel_alterspruefung;


use JTL\Events\Dispatcher;
use JTL\Plugin\Bootstrapper;
use JTL\Services\Container;
use JTL\Shop;
use Plugin\fluxel_alterspruefung\service\AgeAskService;
use Plugin\fluxel_alterspruefung\service\AgeVerifyService;
use Plugin\fluxel_alterspruefung\service\IAgeAskService;
use Plugin\fluxel_alterspruefung\service\IAgeVerifyService;

class Bootstrap extends Bootstrapper
{
    public function boot(Dispatcher $dispatcher) : void
    {
        parent::boot($dispatcher);
        $this->registerServices();
        
        if(Shop::isFrontend() !== true)
        {
            return;
        }

        $dispatcher->listen('shop.hook.' . \HOOK_SMARTY_OUTPUTFILTER, function ($args) {
            Shop::Container()->get(IAgeAskService::class)->injectModal($args["smarty"]);
        });
    }

    private function registerServices()
    {
        $container = Shop::Container();
        if(!$container->has(IAgeAskService::class)) {
            $container->setFactory(IAgeAskService::class, function(Container $container) {
                return new AgeAskService($this->getPlugin(), $container->get(IAgeVerifyService::class));
            });
        }
        if(!$container->has(IAgeVerifyService::class)) {
            $container->setFactory(IAgeVerifyService::class, function(Container $container) {
                return new AgeVerifyService($this->getPlugin());
            });
        }
    }

}