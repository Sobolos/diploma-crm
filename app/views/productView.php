<h1><?=$data['good']['Name']?></h1>
<p>Цена:
        <?=$data['good']['Price']?>
</p>
<p>Описание: <?=$data['good']['Description']?></p>
<label for="ItemsCount_inp">Количество</label>
<input id="ItemsCount_inp" type="text" name="ItemsCount" placeholder="Количество" value="1">

<a data-id="<?=$data['good']['Id']?>" id="ItemAddToCart_lnk">Добавить в корзину</a>
<script src="/resources/js/cart.js"></script>