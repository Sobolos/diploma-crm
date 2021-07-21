<p>Добавить производителя</p>
<form action="/admin/addmanufacturer" method="post">
    <input type="text" name="Name" placeholder="Имя">
    <input type="text" name="Pass" placeholder="Пароль" id="password">
    <input type="submit" value="Добавить" name="submit">
</form>
<p>Все производиели</p>
<? foreach ($data['manufacturers'] as $manufacturer):?>
    <div>
        <p>Имя: <?=$manufacturer['name']?></p>
        <form action="/admin/deletemanufacturer" method="post">
            <input type="hidden" name="Id" value="<?=$manufacturer['id']?>">
            <input type="submit" value="Удалить" name="submit">
        </form>
        <hr>
    </div>
<? endforeach;?>
<script src="/resources/js/password_generator.js"></script>
