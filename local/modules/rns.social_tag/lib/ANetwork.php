<?php
namespace CSocialTag;

use Bitrix\Main\Config\Option,
    Bitrix\Main\Localization\Loc;

abstract class ANetwork extends CMain
{
    const NETWORK_NAME = '';

    public function getNetworkName() {
        return static::NETWORK_NAME;
    }

    public function getDataByTags() {
        $tags = preg_split('/[\s,]+/', static::getSettingValue("TAGS"));

        $output = array();
        foreach($tags as $tag) {
            $request  = static::setRequest($tag);
            $json     = static::callApi($request);
            $output   = static::getRequestData($json) + $output;
        }

        return $output;
    }

    public function setOptions($fields) {
        $options = array();

        foreach ($fields as $fieldKey => $fieldValue) {
            $optionKey = $fieldKey.'_'.static::NETWORK_NAME;

            if(!is_array($fieldValue)) {
                $options[$optionKey] = $fieldValue;
                continue;
            }

            $isStatic = array_intersect($fieldValue, array("statichtml", "statictext")) ? true : false;

            $options[$optionKey] = array(
                $optionKey,
                Loc::getMessage($optionKey),
                $isStatic ? $fieldValue[1] : Option::get(static::MODULE_ID, $optionKey),
                $fieldValue
            );
        }

        return $options;
    }

    public function getSettingValue($settingName) {
        return Option::get(static::MODULE_ID, $settingName.'_'.static::getNetworkName());
    }

    public function getLangValue($settingName) {
        return Loc::getMessage($settingName.'_'.static::getNetworkName());
    }

    public function getOptions() {
        return array();
    }

    abstract public function setRequest($tag);

    abstract public function getRequestData($data);

}