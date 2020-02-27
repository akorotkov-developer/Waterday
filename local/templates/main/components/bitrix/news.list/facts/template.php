<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (empty($arResult["ITEMS"])) return;?>

<div class="js-content-slider">
    <? foreach ($arResult['ITEMS'] as $arItem) :
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
        <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="content-slider__item lazy" <?if(!empty($arItem['PREVIEW_PICTURE']['SRC'])):?> data-src="<?= $arItem['PREVIEW_PICTURE']['SRC']?>" <?endif;?>>
            <div class="content-slider__text">
                <?if(!empty($arItem['NAME'])):?>
                    <h2><?= $arItem['NAME']?></h2>
                <?endif;?>
                <?if(!empty($arItem['PREVIEW_TEXT'])): echo htmlspecialcharsback($arItem['PREVIEW_TEXT']); endif;?>
            </div>
        </div>
    <?endforeach;?>
</div>
