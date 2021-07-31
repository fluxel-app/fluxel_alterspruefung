<?php


namespace Plugin\fluxel_alterspruefung;


class FluxelAgeCheckStandard
{
    public const FRONTEND_PATH = __DIR__ . "/frontend";
    public const TEMPLATE_PATH = self::FRONTEND_PATH . "/template";

    public const LOCAL_MODAL_HEADER = "fluxel_agecheck_modal_header";
    public const LOCAL_MODAL_CONTENT = "fluxel_agecheck_modal_content";
    public const LOCAL_MODAL_ACCEPT = "fluxel_agecheck_modal_accept";
    public const LOCAL_MODAL_DENY = "fluxel_agecheck_modal_deny";
    public const LOCAL_MODAL_DENY_REDIRECT = "fluxel_agecheck_modal_deny_redirect";

    public const CONF_COOKIE_LIFETIME = "fluxel_agecheck_cookie_lifetime";
    public const CONF_CHECK_ACTIVE = "fluxel_agecheck_active";
}