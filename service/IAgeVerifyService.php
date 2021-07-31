<?php


namespace Plugin\fluxel_alterspruefung\service;


interface IAgeVerifyService
{
    public function isCustomerVerified() : bool;
}