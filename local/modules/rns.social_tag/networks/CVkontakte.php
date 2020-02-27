<?php
namespace CSocialTag;

class CVkontakte extends ANetwork
{
    const NETWORK_NAME = 'VKONTAKTE';
    const API_URL = 'https://api.vk.com/method/';
    const API_VERSION = '5.92';

    public function getOptions() {

        $options = $this->setOptions(array(
            "ACCESS_TOKEN" => array("text", 30),
            "PARSE_COUNT"  => array("text", 5)
        ));

        return $options;
    }

    public function setRequest($request) {
        $method         = 'newsfeed.search';
        $accessToken    = self::getSettingValue("ACCESS_TOKEN");
        $parseCount     = self::getSettingValue("PARSE_COUNT");

        $query = http_build_query(array(
            'q' => $request,
            'extended' => '1',
            'count' => $parseCount,
            'access_token' => $accessToken,
            'v' => static::API_VERSION
        ));

        $apiRequest = static::API_URL.$method.'?'.$query;

        return $apiRequest;
    }

    public function getRequestData($data) {
        $json = json_decode($data);

        $entity = array();
        foreach ($json->response->profiles as $profile) {
            $entity[$profile->id] = array(
                "AUTHOR" => $profile->first_name.' '.$profile->last_name
            );
        }
        foreach ($json->response->groups as $groups) {
            $entity['-'.$groups->id] = array(
                "AUTHOR" => $groups->name
            );
        }

        $posts = array();
        foreach ($json->response->items as $item) {
            $postArr = array(
                "NETWORK" => static::NETWORK_NAME,
                "TEXT"    => $item->text,
            );

            if($entity[$item->from_id])
                $postArr = $postArr + $entity[$item->from_id];

            foreach($item->attachments as $attachment)
                if($attachment->type == "photo")
                    $postArr["IMAGE"] = end($attachment->photo->sizes)->url;

            $postArr["HASH"] = md5(serialize($postArr));

            $posts[md5($item->owner_id.$item->id)] = $postArr;
        }
        return $posts;
    }

}