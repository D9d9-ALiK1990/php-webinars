{include file="header.tpl" h1="Список Заказов"}
<h1>Заказ #{$order.id}</h1>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Цена товара</th>
{*        <th>Сумма заказа</th>*}
{*        <th>&nbsp;</th>*}
    </tr>
    </thead>
    <tbody>
    {foreach from=$order.items  item=item}
        <tr>
            <td>{$item.product_id}</td>
            <td>{$item.totalSum}</td>
{*            <td>{$item.totalSum}</td>*}
{*            <td><a href='/order/view?id_task={$order.id}'>Подробнее</a>*}
{*                <form action="/order/delete" method="post" style="display: inline"><input type="hidden" name="id_task"*}
{*                                                                                          value={$order.id}><input type="submit" value="Уд"></form>*}
{*            </td>*}
        </tr>
    {/foreach}
    </tbody>
</table>
{include file="bottom.tpl"}
