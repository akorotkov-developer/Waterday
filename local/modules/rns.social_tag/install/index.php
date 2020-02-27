<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

class rns_social_tag extends CModule
{
    public $MODULE_ID;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_GROUP_RIGHTS;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    public function __construct()
    {
        $this->MODULE_VERSION = '1.0.0';
        $this->MODULE_VERSION_DATE = '2019-03-19 10:00:00';
        $this->MODULE_ID = 'rns.social_tag';
        $this->MODULE_NAME = Loc::getMessage("MOD_NAME_I");
        $this->MODULE_DESCRIPTION = Loc::getMessage("MOD_DESCRIPTION");
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = "RuNetSoft";
        $this->PARTNER_URI = "http://www.rns-soft.ru";
    }
    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }
    public function doUninstall()
    {
         ModuleManager::unregisterModule($this->MODULE_ID);
    }
}
