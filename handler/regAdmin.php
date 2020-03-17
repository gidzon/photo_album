<?php

use app\User;

require_once "../vendor/autoload.php";
require_once "../bd/conect.php";

$login = $_POST['login'];
$pass = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];

$admin = new app\User($pdo, $login, $pass, $name, $surname, 10);