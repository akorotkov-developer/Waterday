<?php
namespace CSocialTag;

class CTwitter extends ANetwork
{
    const NETWORK_NAME = 'TWITTER';

    public function setRequest($request) {}

    public function getRequestData($json) {
        return array();
    }
}