<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (empty($arResult["ITEMS"])) return;?>
    <div class="about-slider js-facts-slider">
<?foreach ($arResult['ITEMS'] as $arItem):
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
    <?if(!empty($arItem['NAME'])):?>
        <div class="about-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <p><?=$arItem['NAME']?></p>
        </div>
    <?endif;?>
<?endforeach;?>
    </div>
