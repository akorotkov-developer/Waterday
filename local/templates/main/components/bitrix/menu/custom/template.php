<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav class="main-menu">
    <ul>
        <li class="first-navigation-element">
            <a class="logo_menu" href="/">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-header.png" alt="">
            </a>
        </li>
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;?>
		<li><a href="<?=$arItem["LINK"]?>" <?if($arItem["SELECTED"]):?>class="selected"<?endif;?>><?=$arItem["TEXT"]?></a></li>
<?endforeach?>
    </ul>
</nav>
<?endif?>