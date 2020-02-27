<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); $this->setFrameMode(true);

$module_id = "rns.social_tag";

if (!\CModule::IncludeModule($module_id))
    return false;

$moduleRight = $APPLICATION->GetGroupRight($module_id);

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$cashDir = $module_id;

global $USER, $CACHE_MANAGER;

$arResult["ITEMS"] = array();

if($moduleRight === 'W') {
    $main = new CSocialTag\CMain();
    $networks = $main->networkLoader();

    foreach($networks as $network)
        $arResult["ITEMS"] = $arResult["ITEMS"] + (array) $network->getDataByTags();

    if($request->getPost('SAVE_TABS')) {
        $hashes = $request->getPostList()->toArray();
        unset($hashes['SAVE_TABS']);

        $main->saveApproved(array_keys($hashes));

        $CACHE_MANAGER->ClearByTag($cashDir);
    }
    $arResult["MODULE_RIGHT"] = $moduleRight;
    $arResult["APPROVED"] = $main->loadApproved();

    $this->IncludeComponentTemplate();
} else {

    if($this->startResultCache(false, $module_id, $cashDir)) {
        if(defined('BX_COMP_MANAGED_CACHE'))
            $CACHE_MANAGER->StartTagCache($cashDir);
        $main = new CSocialTag\CMain();
        $networks = $main->networkLoader();

        $tabs = array();
        foreach($networks as $network)
            $tabs = $tabs + (array) $network->getDataByTags();

        if($arResult["APPROVED"] = $main->loadApproved())
            foreach($tabs as &$tab)
                if(in_array($tab["HASH"], $arResult["APPROVED"]))
                    $arResult["ITEMS"][] = $tab;

        if($arResult["ITEMS"]) {
            shuffle($arResult["ITEMS"]);
            $CACHE_MANAGER->RegisterTag($cashDir);
        }

        if(defined('BX_COMP_MANAGED_CACHE'))
            $CACHE_MANAGER->EndTagCache();

        $this->IncludeComponentTemplate();
    }
}

