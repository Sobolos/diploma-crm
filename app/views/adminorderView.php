<h1>Просмотр заказа #<?=$data['order'][0]['Id']?></h1>
<h2>Информация о клиенте</h2>
<ul>
    <li>Имя/Фамилия: <?=$data['order'][0]['name']?> <?=$data['order'][0]['surname']?></li>
    <li>телефон: <?=$data['order'][0]['phone']?></li>
    <li>Email: <?=$data['order'][0]['email']?></li>
    <li>Адрес доставки:
        <ul>
            <li>Страна: <?=$data['order'][0]['country']?></li>
            <li>Город: <?=$data['order'][0]['city']?></li>
            <li>Улица: <?=$data['order'][0]['street']?></li>
            <li>Дом: <?=$data['order'][0]['house']?></li>
            <li>Подъезд: <?=$data['order'][0]['entrance']?></li>
            <li>Квартира: <?=$data['order'][0]['apartment']?></li>
        </ul>
    </li>
</ul>
<h2>Информация о заказе</h2>
<h3>Добавить товар в заказ</h3>
<form action="/admin/addorderitem" method="post">
    <input type="text" name="itemId" placeholder="id товара">
    <input type="text" name="count" placeholder="количетсво">
    <input type="hidden" name="orderId" value="<?=$data['order'][0]['OrderId']?>">
    <input type="submit" value="Добавить" name="submit">
</form>
<table>
    <thead>
    <td>
        <p>Наименование</p>
    </td>
    <td>
        <p>Количество</p>
    </td>
    <td>
        <p>Остаток на складе</p>
    </td>
    <?php if($data['order'][0]['responsible'] !== null):?>
        <td>
            <p>Сформировать</p>
        </td>
    <?php endif;?>
    <td>
        Удалить
    </td>
    </thead>
    <tbody>
    <?
    $completed = true;
    foreach ($data['order'] as $order):
        ?>
        <tr>
            <td><a href="/product?id=<?=$order['Id']?>"><?=$order['Name']?></a></td>
            <td><?=$order['ItemCount']?></td>
            <td><?=$order['Count']?></td>
            <?php if($data['order'][0]['responsible'] !== null):?>
                <td>
                    <p id="manufacturing_status"></p>
                    <? if($order['Completed'] === 0):
                        $completed = $completed * false;?>
                        <? if($order['ItemCount'] < $order['Count']):?>
                            <input type="button" id="completeOrderItem_btn" value="Укомплектовать"
                                   data-orderid="<?=$order['Id']?>"
                                   data-itemCount="<?=$order['ItemCount']?>"
                                   data-itemid="<?=$order['ItemId']?>"
                                   onclick="completeOrderItem(this)">

                        <? elseif($order['ItemCount'] > $order['Count']):?>
                            <input type="button" id="makeOrderItem_btn" value="Добавить в заказ на производстве <?=$order['ItemCount'] - $order['Count']?> едениц"
                                   data-itemid="<?=$order['ItemId']?>"
                                   data-orderid="<?=$order['Id']?>"
                                   data-itemcount="<?=$order['ItemCount'] - $order['Count']?>"
                                   onclick="makeOrderItem(this)">

                        <? else:?>
                            <input type="button" id="completeOrderItem_btn" value="Укомплектовать"
                                   data-orderid="<?=$order['Id']?>"
                                   data-itemCount="<?=$order['ItemCount']?>"
                                   data-itemid="<?=$order['ItemId']?>"
                                   onclick="completeOrderItem(this)">
                        <? endif;?>
                    <? else:
                        $completed = $completed * true;?>
                        <p id="manufacturing_status">Укомплектовано</p>
                    <?endif;?>
                </td>
            <?endif;?>
            <td>
                <form action="/admin/deleteorderitem" method="post">
                    <input type="hidden" name="Id" value="<?=$order['OrderId']?>">
                    <input type="hidden" name="ItemId" value="<?=$order['ItemId']?>">
                    <input type="submit" value="Удалить" name="submit">
                </form>
            </td>
        </tr>
    <? endforeach;?>
    <tr>
        <td colspan="4">
            <?php if($data['order'][0]['responsible'] !== $_SESSION['user']['id']):?>
                <button id="TakeInWork_btn" data-orderid="<?=$order['Id']?>" onclick="takeInWork(this)">Взять в работу</button>
            <?endif;?>
            <?php if($completed === 1):?>
                <button id="CompleteOrder_btn"
                        data-orderid="<?=$order['Id']?>"
                        onclick="CompleteOrder(this)">
                    Укомплектовать
                </button>
            <?endif;?>
            <?php if($data['order'][0]['Status'] === 6):?>
                <button id="FinishOrder_btn"
                        data-orderid="<?=$order['Id']?>"
                        onclick="FinishOrder(this)">
                    Завершено
                </button>
            <?endif;?>
            <?php if($data['order'][0]['Status'] === 7):?>
                <p>Заказ завершен</p>
            <?endif;?>
        </td>
    </tr>
    </tbody>
</table>
<script src="/resources/js/completeOrder.js"></script>
