{include file="header.tpl" h1="Импорт товаров"}
<p>
   <form method="post" class="form f500p" enctype="multipart/form-data" action="/import/upload">
   <div class="form-element">
    <label>
        <span class="label">Файл импорта csv:</span> 
        <input multiple type="file" name="import_file">
    </label>
    </div>
    <input type="submit" value="Запустить импорт">
   </form>    
</p>

{include file="bottom.tpl"}
