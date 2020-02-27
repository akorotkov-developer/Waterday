<?php
namespace CSocialTag;

use Bitrix\Main\Config\Option,
    Bitrix\Main\Localization\Loc;

class CMain
{
    const MODULE_ID = 'rns.social_tag';

    public function getModuleId() {
        return static::MODULE_ID;
    }

    public function getModuleSettings() {
        return Option::getForModule(static::MODULE_ID);
    }

    public function getModuleDir() {
        return dirname(__DIR__, 1);
    }

    public function callApi($request) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
        curl_setopt($curl, CURLOPT_URL, $request);
        curl_setopt($curl, CURLOPT_HEADER, 0);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result ? $result : "API Connection Failure";
    }

    public function networkLoader($all = false) {
        $settings = self::getModuleSettings();

        $networksFiles = new \DirectoryIterator(self::getModuleDir().'/networks');
        $networkClasses = array();
        foreach($networksFiles as $file)
            if ($file->isFile())
                $networkClasses[] = $file->getBasename('.php');

        $networks = array();
        foreach($networkClasses as $class) {
            $classCall = __NAMESPACE__ . '\\' . $class;
            $instance = new $classCall;
            $networkName = $instance->getNetworkName();

            if($instance instanceof ANetwork)
                if($all && $settings['STATUS_'.$networkName] !== 'Y')
                    continue;
                $networks[$networkName] = $instance;
        }

        return $networks;
    }

    public function saveApproved($data) {
        $file = fopen(self::getModuleDir().'/approved.json', "w");
        fwrite($file, json_encode($data));

        global $CACHE_MANAGER;
        $CACHE_MANAGER->ClearByTag(static::getModuleId());

        return fclose($file);
    }

    public function loadApproved() {
        if(!$json = file_get_contents(self::getModuleDir().'/approved.json'))
            return false;
        return json_decode($json);
    }

    public function getLangFile() {
        $basePath = new \ReflectionObject($this);
        Loc::loadMessages($basePath->getFileName());
    }
}