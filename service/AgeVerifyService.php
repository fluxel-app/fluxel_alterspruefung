<?php


namespace Plugin\fluxel_alterspruefung\service;


use JTL\Plugin\PluginInterface;

class AgeVerifyService implements IAgeVerifyService
{

    /**
     * @var PluginInterface
     */
    private $plugin;

    public function __construct(PluginInterface $plugin)
    {
        $this->plugin = $plugin;
    }

    public function isCustomerVerified(): bool
    {
        return false; //TODO Prüfen, ob der Kunde sein Alter Kontoweit bestätigt hat, kommt der Prüfung der Dokumente!
    }
}