<?php

require_once '../vendor/vendor.php';
require_once '../bd/conect.php';

use app\User;

$user = new app\User($pdo, $_POST['login'], $_POST['password']);
$user->authUser();
header('Location: /index.php');