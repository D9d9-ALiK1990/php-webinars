{include file="header.tpl" h1="Список Задач"}
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Название задачи</th>
            <th>Статус задачи</th>
             <th>&nbsp;</th>
        </tr>    
        </thead>
        <tbody>
        {foreach from=$tasks item=task}
        <tr>
            <td>{$task.id_task}</td>
            <td>{$task.name_task}</td>
            <td>{$task.status}</td>
            <td><a href='/queue/run?id_task={$task.id_task}'>Зап</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <form action="/queue/del" method="post" style="display: inline"><input type="hidden" name="id_task" 
value={$task.id_task}><input type="submit" value="Уд"></form>
            </td>
        </tr> 
        {/foreach}
        </tbody>
    </table>
{include file="bottom.tpl"}
