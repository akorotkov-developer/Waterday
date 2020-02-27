<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(empty($arResult['ITEMS'])) return;?>

<ul class="nav nav-tabs sdfgsdfgfdg" role="tablist">
<? $countStart = $count = 5;
foreach ($arResult['ITEMS'] as $arItem) :?>
    <li class="nav-item"><a class="nav-link <?if($count == $countStart):?>active<?endif;?>" id="tab-<?=$count?>" data-toggle="tab" href="#tab-pane-<?=$count?>" role="tab" aria-controls="home" aria-selected="true"><span class="icon">
                <?if(!empty($iconPath = $arItem['DISPLAY_PROPERTIES']['ICON']['FILE_VALUE']['SRC'])): echo getIconSvgFromPath($iconPath); endif;?>
            </span>
            <span><?if(!empty($arItem['NAME'])) : echo $arItem['NAME']; endif;?></span></a></li>
<?$count++;
endforeach;?>
</ul>

<div class="tab-content">
<? $count = $countStart;
foreach ($arResult['ITEMS'] as $arItem) :
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
    <div class="tab-pane fade <?if($count == $countStart):?>show active<?endif;?>" id="tab-pane-<?=$count?>" role="tabpanel" aria-labelledby="tab-<?=$count?>">
        <div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?if(!empty($arItem['PREVIEW_TEXT'])): echo htmlspecialcharsback($arItem['PREVIEW_TEXT']); endif;?>
        <?if(!empty($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'])):?>
            <div class="btn-more"><a href="<?= $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>" target="_blank">
                    <?= !empty($arItem['DISPLAY_PROPERTIES']['LINK']['DESCRIPTION'])?
                        $arItem['DISPLAY_PROPERTIES']['LINK']['DESCRIPTION'] : $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>
                </a></div>
        <?endif;?>
        <?if(!empty($arItem['DISPLAY_PROPERTIES']['GALLERY'])) :?>
            <div class="tabs-img-list js-lightgallery">
                <?if(count($arItem['DISPLAY_PROPERTIES']['GALLERY']['VALUE']) > 1):
                    foreach ($arItem['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] as $arFile) :?>
                        <?$file = CFile::GetFileArray($arFile["ID"]);
                        $resizeFile = CFile::ResizeImageGet($file, array("width" => 240, "height" => 160));?>
                        <a class="tabs-img" href="<?= $arFile['SRC']?>"><img src="<?= $resizeFile['src']?>" alt=""></a>
                    <?endforeach;
                    else:?>
                        <?$file = CFile::GetFileArray($arItem['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE']["ID"]);
                        $resizeFile = CFile::ResizeImageGet($file, array("width" => 1180, "height" => 1010));?>
                        <a class="tabs-img-big" href="<?= $arItem['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE']['SRC']?>"><img src="<?= $resizeFile['src']?>" alt=""></a>
                <?endif;?>
            </div>
        <?endif;?>
        </div>
    </div>
    <script>
        /*
        * Подключаем слик слайдер для Уроки воды
        * */
/*        $('.slick-slider-block').slick({
            slidesToShow: 3,
            slidesToScroll: 4,
            dots: true,
            infinite: true,
            cssEase: 'linear'
        });*/
    </script>
<?$count++;
endforeach;?>
</div>
