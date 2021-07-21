<? foreach ($data['items'] as $good):?>
    <div>
        <a href="/admin/item?id=<?=$good['Id']?>"><?=$good['Name']?></a>
        <p>Цена: <?=$good['Price']?></p>
        <p>Количество: <?=$good['Count']?></p>
    </div>
<? endforeach;?>