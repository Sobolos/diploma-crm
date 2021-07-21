<h1>Добро пожаловать!</h1>
<p>
    Главная страница
</p>
<? foreach ($data['goods'] as $good):?>
    <div>
        <a href="/product?id=<?=$good['Id']?>"><?=$good['Name']?></a>
        <p>Цена: <?=$good['Price']?></p>
        <p>Количество: <?=$good['Count']?></p>
    </div>
<? endforeach;?>