<?php

use app\User;

require_once '../vendor/vendor.php';
require_once '../bd/conect.php';

$user = new app\User($pdo, $_POST['login'], $_POST['password'], 
$_POST['name'], $_POST['surname'], 1);
$user->regUser();

$user->authUser();

header('Location: /index.php');