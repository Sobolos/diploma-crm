<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?=$data['title']?></title>
</head>
<body>
<header>
    <?php \app\core\libs\menu\menu::render();?>
</header>
<?php include 'app/views/'.$content_view; ?>
</body>
</html>