<form action="/admin/updateitem" method="post">
    <label for="itemPrice">Название</label><br>
    <input id="itemPrice" name="Name" placeholder="Цена" value="<?=$data['item']['Name']?>"><br>
    <label for="itemPrice">Цена</label><br>
    <input id="itemPrice" name="Price" placeholder="Цена" value="<?=$data['item']['Price']?>"><br>
    <label for="itemSale">Скидка (%)</label><br>
    <input id="itemSale" name="SalePercent" placeholder="Скидка (%)" value="<?=$data['item']['SalePercent']?>"><br>
    <label for="itemDesc">Описание</label><br>
    <textarea id="itemDesc" name="Description"><?=$data['item']['Description']?></textarea><br>
    <label for="OnSale">По скидке</label>
    <input id="OnSale" name="OnSale" type="checkbox" value="1"><br>
    <input type="hidden" name="Id" value="<?=$data['item']['Id']?>">
    <input type="submit" value="Обновить" name="submit">
</form>
<form action="/admin/deleteitem" method="post">
    <input type="hidden" name="Id" value="<?=$data['item']['Id']?>">
    <input type="submit" value="Удалить" name="submit">
</form>
<script src="/resources/js/admin.js"></script>