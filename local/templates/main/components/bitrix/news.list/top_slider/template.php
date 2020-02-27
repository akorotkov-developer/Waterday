<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (empty($arResult["ITEMS"])) return;?>
<div class="main-slider js-slider">
<? foreach ($arResult['ITEMS'] as $arItem ) :
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <?if(!empty($arItem['PREVIEW_PICTURE']['SRC'])):?>
        <div class="main-slider__item lazy" data-src="<?= $arItem['PREVIEW_PICTURE']['SRC']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>"></div>
    <?endif;?>
<?endforeach;?>
</div>
