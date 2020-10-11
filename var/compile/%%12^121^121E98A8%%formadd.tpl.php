<?php /* Smarty version 2.6.31, created on 2020-08-16 21:12:52
         compiled from products/formadd.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'products/formadd.tpl', 111, false),)), $this); ?>
<form method="post" class="form f500p" enctype="multipart/form-data">
    <input type="hidden" name="id_product" ">
    
    <div class="form-element">
    <label>
        <span class="label">Название товара:</span> 
        <input type="text" name="name_product" required >
    </label>
    </div>
    <br>
    
    <div class="form-element">
    <label>
        <span class="label">Категория:</span>
        <select name="id_folder">
            
            
            <?php $_from = $this->_tpl_vars['folders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['folder']):
?>
                <option value="<?php echo $this->_tpl_vars['folder']['id_folder']; ?>
"><?php echo $this->_tpl_vars['folder']['name_folder']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Ссылка на изображение:</span> 
        <input multiple type="text" name="image_url">
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Фото товара:</span> 
        <input multiple type="file" name="images[]">
    </label>
    </div>
        
    <br>
    <div class="form-element">
    <label>
        <span class="label">Количество:</span>  
        <input type="number" name="amount" required >
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Артикул:</span>  
        <input type="text" name="article" required >
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Цена:</span>  
        <input type="number" name="price" required >
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Описание:</span>  
        <textarea name="description" rows="6"></textarea>
    </label>
    </div>    
    <br>
    <input type="submit" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['submit_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Сохранить') : smarty_modifier_default($_tmp, 'Сохранить')); ?>
">
</form>
