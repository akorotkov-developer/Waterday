<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); $this->setFrameMode(true);
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

global $USER;

$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/css/libs/jquery.jscrollpane.css');
$this->addExternalJs(SITE_TEMPLATE_PATH . '/assets/js/libs/jquery.jscrollpane.min.js');
$this->addExternalJs(SITE_TEMPLATE_PATH . '/assets/js/libs/jquery.mousewheel.js');
?>
<?php if($arResult["ITEMS"]) {?>
    <?if($arResult["MODULE_RIGHT"] === "W"):?>
    <form action="" name="socialWallByTags" method="post">
    <?endif;?>
        <div class="row">
            <div class="<?if($arResult["MODULE_RIGHT"] !== "W"):?>scroll-pane js-scroll-pane<?endif;?>">
                <div class="social-posts-list">
                <?foreach($arResult["ITEMS"] as $arItem): ?>
                    <div class="col-4">
                        <div class="social-post-sm">
                            <?if($arResult["MODULE_RIGHT"] === "W"):?>
                                <div>
                                    <input name="<?=$arItem["HASH"]?>" type="checkbox" <?=in_array($arItem["HASH"], $arResult["APPROVED"]) ? 'checked' : ''?>>
                                    <label for="<?=$arItem["HASH"]?>">Показать</label>
                                </div>
                            <?endif;?>
                            <div class="social-post-sm__img <?if($arItem["IMAGE"]):?>lazy<?endif;?>" <?if($arItem["IMAGE"]):?>data-src="<?=$arItem["IMAGE"]?>"<?endif;?> ></div>
                            <div class="social-post-sm__text">
                                <p><?=$arItem["TEXT"]?></p>
                            </div>
                            <div class="social-post-sm__source">
                                <div class="social-icon <?=$arItem["ICON"]?>"></div>
                                <span><?=$arItem["AUTHOR"]?></span>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
                </div>
            </div>
        </div>
        <input type="hidden" value="Y" name="SAVE_TABS" />
    <?if($arResult["MODULE_RIGHT"] === "W"):?>
        <input class="social-save" type="submit" value="Сохранить">
    </form>
    <?endif;?>

<?}?>
