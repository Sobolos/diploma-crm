<h4>Недавно поступившие заказы</h4>
<div>
    <?php
    if(array_key_exists(0, $data['newOrders'])):
    foreach ($data['newOrders'] as $order):?>
    <p><?= $order['DateCreated']?> <?= $order['client_name']?> <?= $order['client_surname']?> Оставил заказ
        <a href="/admin/order?id=<?= $order['Id']?>">#<?= $order['Id']?></a></p>
    <?php endforeach; else:?>
        <p>Отправленных заказов нет</p>
    <?endif;?>
</div>
<h4>Последние отправленные производителю заказы</h4>
<div>
    <?php
    if(array_key_exists(0, $data['sentOrders'])):
    foreach ($data['sentOrders'] as $order):?>
        <p><?= $order['DateCreated']?> <?= $order['name']?> Оставил заказ
            <a href="/admin/order?id=<?= $order['Id']?>">#<?= $order['Id']?></a></p>
    <?php endforeach; else:?>
        <p>Отправленных заказов нет</p>
    <?endif;?>
</div>
<h4>Последние полученные от производителля заказы</h4>
<div>
    <?php
    if(array_key_exists(0, $data['gottenOrders'])):
    foreach ($data['gottenOrders'] as $order):?>
        <p><?= $order['DateCreated']?> <?= $order['name']?> Выполнил заказ
            <a href="/admin/order?id=<?= $order['Id']?>">#<?= $order['Id']?></a></p>
    <?php endforeach; else:?>
    <p>Отправленных заказов нет</p>
    <?endif;?>
</div>