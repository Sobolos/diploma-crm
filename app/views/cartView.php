<h1>Корзина</h1>
<?php if(!empty($data['goods'])):?>
<p>
    Вы выбрали товары
</p>
<table>
    <thead>
        <td>
            <p>Номер</p>
        </td>
        <td>
            <p>Наименование</p>
        </td>
        <td>
            <p>Цена</p>
        </td>
        <td>
            <p>Количество</p>
        </td>
        <td>
            <p>Сумма</p>
        </td>
    </thead>
    <tbody>
    <? $totalPrice = 0;
    foreach ($data['goods'] as $good):
        $totalPrice = $totalPrice + $good['Price'];
        ?>
    <tr>
        <td>#<?=$good['Id']?></td>
        <td><a href="/product?id=<?=$good['Id']?>"><?=$good['Name']?></a></td>
        <td>Цена: <?=$good['Price']?></td>
        <td><?=$_SESSION['cart'][$good['Id']]?></td>
        <td><?=$_SESSION['cart'][$good['Id']] * $good['Price']?></td>
    </tr>
    <? endforeach;?>
    <tr>
        <td colspan="2"><p>Общая цена: <?=$data['totalPrice']?></p></td>
        <td colspan="2"><a href="/cart/checkout">Оформить заказ</a></td>
    </tr>
    </tbody>
</table>
<?php else:?>
<p>Корзина пуста</p>
<?php endif;?>