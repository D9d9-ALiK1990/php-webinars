{include file="header.tpl" h1=$folder_activ.name_folder}
   {* <p>
        <a href="/products/add">Добавить</a>
    </p>*}
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Название товара</th>
            <th>Категория</th>
            <th>Артикул</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>&nbsp;</th>
        </tr>    
        </thead>
        <tbody>
        {foreach from=$products item=product}
        <tr>
            <td>{$product.id_product}</td>
            <td width="200">{$product.name_product}</td>
            <td>{$product.name_folder}</td>
            <td>{$product.article}</td>
            <td>{$product.price}</td>
            <td>{$product.amount}</td>
            <td><a href='/products/upd?id_product={$product.id_product}'>Ред</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <form action="/products/del" method="post" style="display: inline"><input type="hidden" name="id_product" 
value={$product.id_product}><input type="submit" value="Уд"></form>
            </td>
        </tr> 
        {/foreach}
        </tbody>
    </table>
{include file="bottom.tpl"}
