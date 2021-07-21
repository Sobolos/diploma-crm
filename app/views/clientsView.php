<form action="/admin/searchclients" method="post">
    <input type="number" name="Id" placeholder="id клиента">
    <input type="submit" value="Поиск" name="submit">
</form>
<a href="/admin/addclient">Добавить клиента</a>
<? foreach ($data['clients'] as $client):?>
    <div>
        <a href="/admin/client?id=<?=$client['Id']?>"><?=$client['name']?> <?=$client['surname']?></a>
    </div>
<? endforeach;?>