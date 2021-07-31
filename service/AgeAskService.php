<?php


namespace Plugin\fluxel_alterspruefung\service;


use JTL\Plugin\Data\Config;
use JTL\Plugin\PluginInterface;
use JTL\Shop;
use Plugin\fluxel_alterspruefung\FluxelAgeCheckStandard;

class AgeAskService implements IAgeAskService
{

    /**
     * @var PluginInterface
     */
    private $plugin;
    /**
     * @var IAgeVerifyService
     */
    private $ageVerifyService;

    public function __construct(PluginInterface $plugin, IAgeVerifyService $ageVerifyService)
    {
        $this->plugin = $plugin;
        $this->ageVerifyService = $ageVerifyService;
    }

    public function injectModal(\Smarty $smarty) : void
    {
        $configuration = $this->plugin->getConfig();
        if($configuration->getValue(FluxelAgeCheckStandard::CONF_CHECK_ACTIVE) !== "on"
            || $this->checkModalCookie($configuration)
            || $this->ageVerifyService->isCustomerVerified())
        {
            return;
        }

        $template = FluxelAgeCheckStandard::TEMPLATE_PATH . '/popup_confirm_age.tpl';
        $smarty->assign("fluxel_age_modal", $this->buildModalObject($configuration));
        \pq('body')->append($smarty->fetch($template));
    }

    private function buildModalObject(Config $config) : \stdClass
    {
        $cls = new \stdClass();
        $cls->text = $this->buildModalTextObject();
        $cls->cookie = $this->getModalCookieName();
        $cls->cookie_lifetime = $config->getValue(FluxelAgeCheckStandard::CONF_COOKIE_LIFETIME);
        return $cls;
    }

    private function buildModalTextObject() : \stdClass
    {
        $localization = $this->plugin->getLocalization();
        $cls = new \stdClass();
        $cls->header = $localization->getTranslation(FluxelAgeCheckStandard::LOCAL_MODAL_HEADER);
        $cls->content = $localization->getTranslation(FluxelAgeCheckStandard::LOCAL_MODAL_CONTENT);
        $cls->accept = $localization->getTranslation(FluxelAgeCheckStandard::LOCAL_MODAL_ACCEPT);
        $cls->deny = $localization->getTranslation(FluxelAgeCheckStandard::LOCAL_MODAL_DENY);
        $cls->deny_redirect = $localization->getTranslation(FluxelAgeCheckStandard::LOCAL_MODAL_DENY_REDIRECT);
        return $cls;
    }

    private function checkModalCookie(Config $config) : bool
    {
        if(@isset($_COOKIE[$this->getModalCookieName()]) && $_COOKIE[$this->getModalCookieName()] == "1") {
            setcookie($this->getModalCookieName(), "1", time() + $config->getValue(FluxelAgeCheckStandard::CONF_COOKIE_LIFETIME)*24*60*60, "/");
            return true;
        }
        return false;
    }

    private function getModalCookieName() : string
    {
        return base64_decode("Zmx1eGVsX2FnZV9tb2RhbF9jb29raWU=");
    }
}

