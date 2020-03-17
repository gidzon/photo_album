<?php require_once "bd/conect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
<header>
    <a href="/" class="logo"><img src="images/logo2.png"></a>
<div class="buttonHead">
    <?php if(empty($_COOKIE['auth'])): ?>
        <a href="includes/reg.php">Регистрация</a>
        <a href="includes/auth.php">Авторизация</a>
    <?php else: ?>
        <?php $userInfo = new app\User($pdo); ?>
        <?php foreach ($userInfo as $val): ?>
            <a href="profile.php?id="<?php echo "$val->id"; ?>><?php echo "$val->name"; ?></a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</header>