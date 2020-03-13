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

if (!function_exists("cmp2")) {
    function cmp2($a, $b)
    {
        return strcmp($a["DATE"], $b["DATE"]);
    }
}
usort($arResult["ITEMS"], "cmp2");

$arResult["ITEMS"] = array_reverse($arResult["ITEMS"]);

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
