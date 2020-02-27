<?php
namespace CSocialTag;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\Context;

if (!\CModule::IncludeModule("rns.social_tag"))
    die();

Loc::loadMessages(__FILE__);

global $APPLICATION;

$request    = Context::getCurrent()->getRequest();
$main       = new CMain();
$networks   = $main->networkLoader(true);

//region Переназначение переменных из ядра
$module_id      = $main->getModuleId();
$MODULE_RIGHT   = $APPLICATION->GetGroupRight($module_id);
//endregion


foreach ($networks as $network) {
    $network->getLangFile();
    $networkName = $network->getNetworkName();

    $tabOptions[] = array(
        "DIV" => $networkName,
        "TAB" => Loc::getMessage("TAB_NAME_" . $networkName),
        "TITLE" => Loc::getMessage("TAB_TITLE_" . $networkName),
        "OPTIONS" => $network->setOptions(array(
                "STATUS" => array("checkbox"),
                "TAGS" => array("text", 30)
            )) + (array)$network->getOptions()
    );
}

//region Таб с доступами
$tabOptions[] = array(
    "DIV" => "ACCESS",
    "TAB" => GetMessage('MAIN_TAB_RIGHTS'),
    "TITLE" => GetMessage('MAIN_TAB_TITLE_RIGHTS'),
    "OPTIONS" => ''
);
//endregion

if ($request->isPost()) {
    foreach($tabOptions as $tab)
        foreach($tab["OPTIONS"] as $option)
            __AdmSettingsSaveOption($module_id, $option);

    global $CACHE_MANAGER;
    $CACHE_MANAGER->ClearByTag($module_id);
}

$tabControl = new \CAdminTabControl("tabControl", $tabOptions, false);
$tabControl->Begin();
?>

<form name="social_tag" action="<?= $APPLICATION->GetCurPage() ?>?mid=<?= $module_id ?>&lang=<?= LANG ?>" method="post">
    <?foreach ($tabOptions as $tab) {

        $tabControl->BeginNextTab();

        if ($tab["OPTIONS"])
            __AdmSettingsDrawList($module_id, $tab["OPTIONS"]);
        else if ($tab["DIV"] === "ACCESS")
            require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/admin/group_rights.php');
    }
    $tabControl->Buttons();
    ?>
    <input type="submit" name="Update" value="<?= Loc::GetMessage("TAB_APPLY") ?>" <? if ($MODULE_RIGHT < "W") echo "disabled" ?> class="adm-btn-save"/>
</form>

<? $tabControl->End(); ?>
