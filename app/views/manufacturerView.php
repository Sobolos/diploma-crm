<h4>Все заказы</h4>
<div>
    <?php
    if(array_key_exists(0, $data['orders'])):
        foreach ($data['orders'] as $order):?>
            <p>
                <?= $order['name']?> Оставил заказ
                <a href="/admin/order?id=<?= $order['Id']?>">#<?= $order['Id']?></a>
                <?php if($order['ItemCompleted'] === 1):?>
                <p>ЗАВЕРШЕНО</p>
                <?php endif; ?>
            </p>
        <hr>
        <?php endforeach; else:?>
        <p> Заказов нет</p>
    <?endif;?>
</div>