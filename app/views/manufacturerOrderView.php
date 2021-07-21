<h1>Просмотр заказа #<?=$data['order'][0]['manufacturingId']?></h1>
<h2>Информация о клиенте</h2>
<p><?= $data['order'][0]['name']?></p>
<h2>Информация о заказе</h2>
<table>
    <thead>
    <td>
        <p>Наименование</p>
    </td>
    <td>
        <p>Количество</p>
    </td>
    <?php if($data['order'][0]['manufacturer'] !== null):?>
        <td>
            <p>Сформировать</p>
        </td>
    <?php endif;?>
    </thead>
    <tbody>
    <?
    $completed = true;
    foreach ($data['order'] as $order):
        ?>
        <tr>
            <td><a href="/product?id=<?=$order['itemId']?>"><?=$order['Name']?></a></td>
            <td><?=$order['count']?></td>
            <?php if($data['order'][0]['manufacturer'] !== null):?>
                <td>
                    <? if($order['ItemCompleted'] === 0):
                        $completed = $completed * false;?>
                        <input type="button" id="completeManufacturingItem_btn" value="Произведено"
                           data-orderid="<?=$order['manufacturingId']?>"
                           data-itemCount="<?=$order['count']?>"
                           data-itemid="<?=$order['ItemId']?>"
                           onclick="completeManufacturingItem(this)">
                    <? else:
                        $completed = $completed * true; ?>
                        <p id="manufacturing_status">Укомплектовано</p>
                    <?endif;?>
                </td>
            <?endif;?>
        </tr>
    <? endforeach;?>
    <tr>
        <td colspan="4">
            <?php if($data['order'][0]['manufacturer'] === null):?>
                <button id="TakeInWork_btn" data-orderid="<?=$order['manufacturingId']?>" onclick="takeInWork(this)">Взять в работу</button>
            <? elseif($completed === 1):?>
                <button id="FinishOrder_btn"
                        data-orderid="<?=$order['orderId']?>"
                        data-dealerid="<?=$order['dealerId']?>"
                        onclick="finishManufacturingOrder(this)">
                    Отправить дилеру
                </button>
            <?endif;?>
        </td>
    </tr>
    </tbody>
</table>
<script src="/resources/js/completeOrder.js"></script>