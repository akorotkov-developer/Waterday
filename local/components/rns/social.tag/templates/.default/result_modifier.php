<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

foreach($arResult["ITEMS"] as &$arItem) {
    if($arItem["NETWORK"] == "VKONTAKTE")
        $arItem["ICON"] = 'social-vk';
    else if($arItem["NETWORK"] == "ODNOKLASSNIKI")
        $arItem["ICON"] = 'social-ok';
    else if($arItem["NETWORK"] == "INSTAGRAM")
        $arItem["ICON"] = 'social-ig';
    else
        $arItem["ICON"] = '';
}
