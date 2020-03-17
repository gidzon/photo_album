<?php

require_once '../bd/conect.php';
require_once '../vendor/autoload.php';

use app\Photo;

$uploadPhoto = new app\Photo();
$path = $uploadPhoto->uploadFile($_POST['userfile']['name'], 
$_POST['userfile']['tmp_name'], '../images');

$addBdPhoto = new app\Photo();
$addBdPhoto->addBdPhoto($pdo, $_POST['userfile']['name'],
$path);