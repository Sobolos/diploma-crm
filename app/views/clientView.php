<form action="/admin/updateclient" method="post">
    <label for="name">Имя</label><br>
    <input id="name" name="name" placeholder="Имя" value="<?=$data['clients'][0]['name']?>"><br>

    <label for="surname">Фамилия</label><br>
    <input id="surname" name="surname" placeholder="Фамилия" value="<?=$data['clients'][0]['surname']?>"><br>

    <label for="phone">Телефон</label><br>
    <input id="phone" name="phone" placeholder="Телефон" value="<?=$data['clients'][0]['phone']?>"><br>

    <label for="phone">Email</label><br>
    <input id="Email" name="email" placeholder="Email" value="<?=$data['clients'][0]['email']?>"><br>

    <label for="country">Страна</label><br>
    <input id="country" name="country" placeholder="Страна" value="<?=$data['clients'][0]['country']?>"><br>

    <label for="city">Город</label><br>
    <input id="city" name="city" placeholder="Город" value="<?=$data['clients'][0]['city']?>"><br>

    <label for="street">Улица</label><br>
    <input id="street" name="street" placeholder="Улица" value="<?=$data['clients'][0]['street']?>"><br>

    <label for="house">Дом</label><br>
    <input id="house" name="house" placeholder="Дом" value="<?=$data['clients'][0]['house']?>"><br>

    <label for="entrance">Подъезд</label><br>
    <input id="entrance" name="entrance" placeholder="Подъезд" value="<?=$data['clients'][0]['entrance']?>"><br>

    <label for="apartment">Кварира</label><br>
    <input id="apartment" name="apartment" placeholder="Кварира" value="<?=$data['clients'][0]['apartment']?>"><br>

    <input type="hidden" name="Id" value="<?=$data['clients'][0]['Id']?>">

    <input type="submit" value="Обновить" name="submit">
</form>
<form action="/admin/deleteclient" method="post">
    <input type="hidden" name="Id" value="<?=$data['clients'][0]['Id']?>">
    <input type="submit" value="Удалить" name="submit">
</form>

<p>Заказы клиента</p>
<?php
if(array_key_exists(0, $data['orders'])):
    foreach ($data['orders'] as $order):?>
        <p>
            <a href="/admin/order?id=<?= $order['Id']?>">#<?= $order['Id']?></a>
        </p>
        <p>
            Статус заказа:
            <?php
            switch ($order['Status']){
                case 1:
                    echo "Заказ поступил и ждет обработки";
                    break;
                case 2:
                    echo "Заказ отправлен производителю";
                    break;
                case 3:
                    echo "Заказ принят на производство";
                    break;
                case 4:
                    echo "Заказ произведен";
                    break;
                case 5:
                    echo "Заказ отправлен вам";
                    break;
                case 6:
                    echo "Заказ укомплектован";
                    break;
                case 7:
                    echo "Заказ передан покупателю";
                    break;
                default:
                    echo "Произошла ошибка";
                    break;
            }
            ?>
        </p>
    <?php endforeach; else:?>
    <p> Заказов нет</p>
<?endif;?>

<script src="/resources/js/admin.js"></script>
