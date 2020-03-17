<?php

require_once '../vendor/vendor.php';
require_once '../bd/conect.php';

use app\Photo;
use app\User;

$userInfo = new app\User($pdo);
$userInfo->getUsersInfo();
$UserPhoto = new app\Photo();

foreach ($userInfo as $val) {
    $UserPhoto->getInfoPhoto($pdo, $val['id']);
}
