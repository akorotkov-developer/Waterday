<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$assets = \Bitrix\Main\Page\Asset::getInstance();
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID?>">
<head>
    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?
    $assets->addString('<meta name="format-detection" content=telephone=no">', true);
    $assets->addString('<meta http-equiv="x-ua-compatible" content="ie=edge">', true);
    $assets->addCss("https://fonts.googleapis.com/css?family=Ubuntu:400,500,700&amp;amp;subset=cyrillic");
    $assets->addCss(SITE_TEMPLATE_PATH . '/assets/css/libs/slick.css');
    $assets->addCss(SITE_TEMPLATE_PATH . '/assets/css/libs/lightgallery.min.css');
    $assets->addCss(SITE_TEMPLATE_PATH . '/assets/css/main-style.css');
    $assets->addJs(SITE_TEMPLATE_PATH . '/assets/js/libs/jquery-2.3.1.min.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/assets/js/libs/popper.min.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/assets/js/libs/bootstrap.min.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/assets/js/libs/lightgallery-all.min.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/assets/js/libs/slick.min.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/assets/js/libs/jquery.lazy.min.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/assets/js/main.js');
    ?>
</head>
<body>
<? if ($USER->IsAuthorized()) { ?>
    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<? } ?>
<header class="main-header">
    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"custom", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "top",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "0",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "custom",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
    <!--<div class="main-header__logo"><a class="logo" href=""><img src="<?= SITE_TEMPLATE_PATH?>/assets/images/logo-header.png" alt=""></a></div>-->
    <div class="main-header__content">
        <h2><?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "local/include/header_title.php"
                )
            );?></h2>

        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "local/include/header_text.php"
            )
        );?>
    </div>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "top_slider",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "N",
            "DISPLAY_PICTURE" => "N",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("PREVIEW_PICTURE",""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "header_slider",
            "IBLOCK_TYPE" => "news",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("",""),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>
    <div class="btn-more"><a href="#about-info">Узнать больше</a>
        <div class="btn-more__img"></div>
    </div>

</header>