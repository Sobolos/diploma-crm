<p>Добавить дилера</p>
<form action="/admin/adddealers" method="post">
    <input type="text" name="Name" placeholder="Имя">
    <input type="text" name="Pass" placeholder="Пароль">
    <input type="submit" value="Добавить" name="submit">
</form>
<p>Все дилеры</p>
<? foreach ($data['dealers'] as $dealer):?>
    <div>
        <p>Имя: <?=$dealer['name']?></p>
        <form action="/admin/deletedealers" method="post">
            <input type="hidden" name="Id" value="<?=$dealer['id']?>">
            <input type="submit" value="Удалить" name="submit">
        </form>
        <hr>
    </div>
<? endforeach;?>