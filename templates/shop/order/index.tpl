{include file="header.tpl" h1="Список Заказов"}
<p>
    <a href="/order/create">Создать заказ</a>
</p>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Дата создания</th>
        <th>Сумма заказа</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$orders item=order}
        <tr>
            <td>{$order.id}</td>
            <td>{$order.createdAt}</td>
            <td>{$order.totalSum}</td>
            <td><a href='/order/view?id_task={$order.id}'>Подробнее</a>
                <form action="/order/delete" method="post" style="display: inline"><input type="hidden" name="id_task"
                                                                                       value={$order.id}><input type="submit" value="Уд"></form>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
{include file="bottom.tpl"}
