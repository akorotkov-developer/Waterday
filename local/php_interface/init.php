<?

/**
 * @param $iconPath - ссылка на иконку
 * @return bool|mixed|string
 */
function getIconSvgFromPath($iconPath) {
    $iconSvg = "";

    if (!empty($iconPath))
        $iconSvg = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $iconPath);

    //$iconSvg = clearSvgIcon($iconSvg);

    return $iconSvg;
}

/**
 * @param $icon - html код иконки
 * @return mixed
 */
function clearSvgIcon($icon) {
    if (empty($icon)) return;

    $svgOutput = preg_replace(
        $patterns = array('/#([0-9a-f]{3,6})/i', '/(width|height)="([\s\S]+?)"/i'),
        $replacement = array('currentColor', ''),
        $icon
    );

    return $svgOutput;
}