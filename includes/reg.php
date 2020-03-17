<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
<header>
    <a href="/" class="logo"><img src="images/logo2.png"></a>
<div class="buttonHead">
</div>
</header>
    <form action="../handler/reg.php" method="post">
        <input type="text" name="login" class="inputText" placeholder="Логин">
        <input type="password" name="password" class="inputPass" placeholder="Пароль">
        <input type="text" name="name" placeholder="Имя">
        <input type="text" name="surname" placeholder="Фамилия">
        <input type="submit" name="regUser" class="regUser" value="Регистрация">
    </form>
</body>
</html>