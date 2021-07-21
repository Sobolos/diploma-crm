<h4>Все заказы</h4>
<form action="/admin/searchorders" method="post">
    <input type="number" name="Id" placeholder="id заказа">
    <input type="submit" value="Поиск" name="submit">
</form>
<div>
    <?php
    if(array_key_exists(0, $data['orders'])):
        foreach ($data['orders'] as $order):?>
            <p>
                <?= $order['DateCreated']?> <?= $order['client_name']?> <?= $order['client_surname']?> Оставил заказ
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
                        echo "Заказ взят в работу";
                        break;
                    case 3:
                        echo "Заказ отправлен производителю";
                        break;
                    case 4:
                        echo "Заказ принят на производство";
                        break;
                    case 5:
                        echo "Заказ отправлен дилеру";
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
            <?php if($_SESSION['user']['role'] === 1):?>
                <form action="/admin/deleteorder" method="post">
                    <input type="hidden" name="Id" value="<?=$order['Id']?>">
                    <input type="submit" value="Удалить" name="submit">
                </form>
            <?endif;?>
            <hr>
        <?php endforeach; else:?>
        <p> Заказов нет</p>
    <?endif;?>
</div>