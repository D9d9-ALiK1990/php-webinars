{include file="header.tpl" h1="Список Категорий"}
    <p>
        <a href="/folders/add">Добавить</a>
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Название категории</th>
             <th>&nbsp;</th>
        </tr>    
        </thead>
        <tbody>
        {foreach from=$folders item=folder}
        <tr>
            <td>{$folder.id_folder}</td>
            <td>{$folder.name_folder}</td>
            <td><a href='/folders/upd?id_folder={$folder.id_folder}'>Редактировать</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <form action="/folders/del" method="post" style="display: inline"><input type="hidden" name="id_folder" 
value={$folder.id_folder}><input type="submit" value="Удалить"></form>
            </td>
        </tr> 
        {/foreach}
        </tbody>
    </table>
{include file="bottom.tpl"}
