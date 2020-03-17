<?php 
include_once 'includes/header.php'; 
require_once 'bd/conect.php';
require_once 'vendor/autoload.php';
require_once 'handler/content.php';

use app\User;
use app\Photo;

$userInfo = new app\User($pdo);
$userInfo->getUsersInfo();
$UserPhoto = new app\Photo();
$UserPhoto->getInfoPhoto($pdo, $val['id']);

$info = array_merge($userInfo, $UserPhoto);
?>    
    <div class="main-content">
            <?php foreach ($info as $val): ?>
        <div class="content">
                <?php  ?>
           <a href="usphoto.php?id=<?php echo $val['id'] ?>"><img src="<?php echo $val['path']; ?>"></a>
            <a href="usphoto.php?id=<?php echo $val['id'] ?>"><p><?php echo $val['name']; ?></p></a>
        </div>
        <div class="content">
            <a href="#"><img src="images/photo1.jpg"></a>
            <a href="#"><p>nickname</p></a>
        </div>
        <div class="content">
            <a href="#"><img src="images/photo1.jpg"></a>
            <a href="#"><p>nickname</p></a>
        </div>
            <?php endforeach; ?>
    </div>
</body>
</html>