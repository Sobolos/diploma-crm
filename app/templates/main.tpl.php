<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title><?=$data['title']?></title>
</head>
<body>
    <header>
        <menu>
            <a href="/">Все товары</a>
            <a href="/cart">Корзина (<span id="ItemsCount_spn"><?=\app\models\cartModel::countItems()?></span>)</a>
            <a href="/admin/login">Вход в админку</a>
        </menu>
    </header>
	<?php include 'app/views/'.$content_view; ?>
</body>
</html>