{include file="header.tpl" h1="Корзина"}
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Кол-во</th>
        <th>Сумма</th>
        <th> </th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$cart->getItems() item=cartItem}
        <tr>
            {assign var=product value=$cartItem->getProductModel()}
            <td>{$product->getId_product()}</td>
            <td>{$product->getName_product()}</td>
            <td>{$product->getPrice()}</td>
            <td>{$cartItem->getAmount()}</td>
            <td>{$cartItem->getTotal()}</td>
            <td>
                <form action="/shop/cart/remove?id_product={$product->getId_product()}" method="post" style="display: inline"><input type="hidden" name="id_product" value="{$product->getId_product()}"><input type="submit" value="Уд"></form>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
{include file="bottom.tpl"}
