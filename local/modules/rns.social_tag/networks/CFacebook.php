<?php
namespace CSocialTag;

class CFacebook extends ANetwork
{
    const NETWORK_NAME = 'FACEBOOK';
    const API_URL = 'https://graph.facebook.com';
    const API_VERSION = 'v3.3';

    public function getOptions()
    {
        $options = $this->setOptions(array(
            "APP_ID"            => array("text", 30),
            "APP_SECRET"        => array("text", 30),
            "PAGE_ID"           => array("text", 30),
            "ACCESS_TOKEN"      => array("text", 30),
            "LOGIN_PAGES"       => array("statichtml", static::generateButton("LOGIN_LABEL")),
            "INSTAGRAM_TITLE"   => static::getLangValue("INSTAGRAM_TITLE"),
            "LOGIN_INSTAGRAM"   => array("checkbox"),
            "INSTAGRAM_ID"      => array("text", 30),
            "INCLUDE"           => array("statichtml", static::generateInclude())
        ));

        return $options;
    }

    public function setRequest($tag) {
        $tag = str_replace("#", "", $tag);

        $tagQuery = http_build_query(array(
            "user_id"       => self::getSettingValue("INSTAGRAM_ID"),
            "q"             => $tag,
            "access_token"  => self::getSettingValue("ACCESS_TOKEN")
        ));

        $tagId = json_decode(static::callApi(static::API_URL.'/'.static::API_VERSION.'/ig_hashtag_search?'.$tagQuery), true)["data"][0]["id"];

        $query = http_build_query(array(
            "user_id"       => self::getSettingValue("INSTAGRAM_ID"),
            "fields"        => "caption,id,media_url,media_type,permalink",
            "access_token"  => self::getSettingValue("ACCESS_TOKEN")
        ));

        $apiRequest = static::API_URL.'/'.$tagId.'/top_media?'.$query;

        return $apiRequest;
    }

    public function getRequestData($data)
    {
        $json = json_decode($data);

        $posts = array();
        foreach ($json->data as $item) {

            if($item->media_type !== "IMAGE")
                continue;

            $postArr = array(
                "AUTHOR"  => "INSTAGRAM",
                "NETWORK" => "INSTAGRAM",
                "TEXT"    => $item->caption,
                "IMAGE"   => $item->media_url
            );

            $postArr["HASH"] = md5(serialize($postArr));

            $posts[md5($item->id)] = $postArr;
        }

        return $posts;
    }

    private function generateButton($key) {
        return '<button class="facebook-login-button" type="button">'.static::getLangValue($key).'</button>';
    }

    private function generateInclude() {
        return '
        <script type="application/javascript">
        document.querySelector(".facebook-login-button").addEventListener("click", function(event) {        
            
            var appField    = document.querySelector("input[name=\'APP_ID_FACEBOOK\']");
            
            if(!appField.value) {
                alert("'.static::getLangValue("ID_ERROR_MESSAGE").'");
                return false;
            }
            
//            if(document.querySelector("input[name=\'LOGIN_INSTAGRAM_FACEBOOK\']").checked) {
//                var scopeArray  = scope.split(",").map(item => item.trim());
//                scopeArray.push("instagram_basic", "pages_show_list");
//                scope = scopeArray.join();
//            }
            
            FB.init({
                appId      : appField.value,
                cookie     : true,
                xfbml      : true,
                version    : "'.static::API_VERSION.'"
            });

            FB.login(function(response) {
                
                if (response.status !== "connected")
                    return false;
                    
                FB.api("/me", "GET", {"fields":"accounts{app_id, access_token}"}, function(response) {
                        if(response.accounts.data[0]) {
                            var pagesId     = document.querySelector("input[name=\'PAGE_ID_FACEBOOK\']").value = response.accounts.data[0].id,
                                accessToken = document.querySelector("input[name=\'ACCESS_TOKEN_FACEBOOK\']").value = response.accounts.data[0].access_token;
                         
                            
                            if(pagesId && document.querySelector("input[name=\'LOGIN_INSTAGRAM_FACEBOOK\']").checked) {
                                
                                FB.api("/" + pagesId, "GET", {"fields":"instagram_business_account"},
                                    function(response) {
                                        if(response.instagram_business_account) {
                                            document.querySelector("input[name=\'INSTAGRAM_ID_FACEBOOK\']").value = response.instagram_business_account.id;
                                        }
                                    }
                                );
                            }
                        }
                })
           }, 
           {
               auth_type: "rerequest",
               scope: "public_profile , manage_pages , instagram_basic",
               return_scopes: true
           });
            
        });
        
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, \'script\', \'facebook-jssdk\'));    
        </script>';
    }
}