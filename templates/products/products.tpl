{include file="header.tpl" h1="Список Товаров"}
    <p>
        <a href="/products/add">Добавить</a>
    </p>
    <p>
    <nav>
        <ul class="pagination">
            {section loop=$pages_count name=pagination}
                <li class="pagination-item"><a class="page-link {if $smarty.get.p == $smarty.section.pagination.iteration}active{/if}" href="{$smarty.server.PATH_INFO}?p={$smarty.section.pagination.iteration}">{$smarty.section.pagination.iteration}</a></li>
            {/section}
        </ul>    
    </nav>
    
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
            <td>{$product->getId_product()}</td>
            <td width="200">
                {$product->getName_product()}
                {if $product->getImages()}
                <br>
                    {foreach from=$product->getImages() item=image}
                        <img width="30" src="{$image->getPath()}" alt="{$image->getName_image()}">
                    {/foreach}
                {/if}
            </td>
            {assign var=productFolder value=$product->getFolder()}
            <td>{$productFolder->getName_folder()}</td>
            <td>{$product->getArticle()}</td>
            <td>{$product->getPrice()}</td>
            <td>{$product->getAmount()}</td>
            <td><a href='/shop/cart/add?id_product={$product->getId_product()}'>Купить</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href='/products/upd?id_product={$product->getId_product()}'>Ред</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <form action="/products/del" method="post" style="display: inline"><input type="hidden" name="id_product" 
value={$product->getId_product()}><input type="submit" value="Уд"></form>
            </td>
        </tr> 
        {/foreach}
        </tbody>
    </table>
        </p>
{include file="bottom.tpl"}
