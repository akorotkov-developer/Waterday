<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === TRUE) or die();

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses('rns.social_tag', array(
    'CSocialTag\CMain'          => 'lib/CMain.php',
    'CSocialTag\ANetwork'       => 'lib/ANetwork.php',
    'CSocialTag\COdnoklassniki' => 'networks/COdnoklassniki.php',
    'CSocialTag\CTwitter'       => 'networks/CTwitter.php',
    'CSocialTag\CVkontakte'     => 'networks/CVkontakte.php',
    'CSocialTag\CFacebook'     => 'networks/CFacebook.php',
));

