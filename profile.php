<?php include_once 'includes/header.html'; ?>
<div class="form">
    Загрузить фото
    <form id="upload" action="" method="post" enctype="multipart/form-data">
    Отправить этот файл: <input name="userfile" type="file" />
    </form>
</div>
<div class="form">
    Изменить учетные данные
    <form id="usdata" action="" method="post">
        <input type="text" placeholder="Новый логин">
        <input type="password" placeholder="Новый пароль">
        <input type="submit">
    </form>
</div>
<div class="top">
    <img src="images/photo2.jpg" alt="">
    <form action="" method="post">
        <input type="image" src="images/delete.jpg">
    </form>
</div>
</body>
</html>