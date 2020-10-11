<form method="post" class="form f500p">
    <input type="hidden" name="id_folder" value="{$folder.id_folder}">
    <div class="form-element">
    <label>
        <span class="label">Название категории:</span> 
        <input type="text" name="name_folder" required value="{$folder.name_folder}">
    </label>
    </div>
    <br>
    <input type="submit"  value="{$submit_name|default:'Сохранить'}">
</form>  