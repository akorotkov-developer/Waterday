<?php
namespace CSocialTag;

class COdnoklassniki extends ANetwork
{
    const NETWORK_NAME = 'ODNOKLASSNIKI';
    const API_URL = 'https://api.ok.ru/fb.do';

    public function setRequest($request) {
        $method             = 'search.tagContents';
        $appPublicKey       = self::getSettingValue("APPLICATION_PUBLIC_KEY");
        $appSecretKey       = self::getSettingValue("APPLICATION_SECRET_KEY");
        $accessToken        = self::getSettingValue("ACCESS_TOKEN");
        $parseCount         = self::getSettingValue("PARSE_COUNT");
        $callBackFormat     = 'json';
        $requestSecretKey   = md5($accessToken.$appSecretKey);
        $sig                = md5('application_key='.$appPublicKey.'count='.$parseCount.'format='.$callBackFormat.'method='.$method.'query='.$request.$requestSecretKey);

        $query = http_build_query(array(
            'application_key'   => $appPublicKey,
            'count'             => $parseCount,
            'format'            => 'json',
            'method'            => $method,
            'query'             => $request,
            'sig'               => $sig,
            'access_token'      => $accessToken
        ));

        $apiRequest = static::API_URL.'?'.$query;

        return $apiRequest;
    }

    public function getRequestData($data) {
        $json = json_decode($data);

        $entity = array();
        foreach ($json->entities->users as $user) {
            $entity['user:'.$user->uid] = array(
                "AUTHOR" => $user->name
            );
        }
        foreach ($json->entities->groups as $groups) {
            $entity['group:'.$groups->uid] = array(
                "AUTHOR" => $groups->name
            );
        }

        $photos = array();
        foreach ($json->entities->user_photos as $photo)
            $photos['photo:'.$photo->id] = $photo->pic1024x768;
        foreach ($json->entities->group_photos as $photo)
            $photos['group_photo:'.$photo->id] = $photo->pic1024x768;

        $posts = array();
        foreach ($json->entities->media_topics as $item) {
            $postArr = array(
                "NETWORK" => static::NETWORK_NAME
            );

            foreach ($item->media as $media)
                if ($media->text)
                    $postArr['TEXT'] = $media->text;
                elseif ($media->photo_refs)
                    $postArr['IMAGE'] = $photos[$media->photo_refs[0]];

            if($entity[$item->owner_ref])
                $postArr = $postArr + $entity[$item->owner_ref];

            $postArr["HASH"] = md5(serialize($postArr));

            $posts[md5($item->id)] = $postArr;
        }

        return $posts;
    }

    public function getOptions() {
        $options = $this->setOptions(array(
            "APPLICATION_PUBLIC_KEY" => array("text", 30),
            "APPLICATION_SECRET_KEY" =>  array("text", 30),
            "ACCESS_TOKEN" =>  array("text", 30),
            "PARSE_COUNT" => array("text", 5),
        ));

        return $options;
    }


}