<h1>Главная страница</h1>
<h3>Последние опреации</h3>
<table>
    <thead>
        <td>
            id опреации
        </td>
        <td>
            Дата
        </td>
        <td>
            Сообщение
        </td>
        <td>
            Инициатор
        </td>
    </thead>
    <tbody>
        <?php foreach ($data['log'] as $log):?>
            <tr>
                <td>
                    <?=$log['Id']?>
                </td>
                <td>
                    <?=$log['Date']?>
                </td>
                <td>
                    <?=$log['message']?>
                </td>
                <td>
                    <?=$log['name']?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php ?>
<script src="/resources/js/admin.js"></script>