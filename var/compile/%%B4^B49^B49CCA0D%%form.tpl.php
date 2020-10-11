<?php /* Smarty version 2.6.31, created on 2020-08-25 20:44:15
         compiled from products/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'products/form.tpl', 111, false),)), $this); ?>
<form method="post" class="form f500p" enctype="multipart/form-data">
    <input type="hidden" name="id_product" value="<?php echo $this->_tpl_vars['product']->getId_product(); ?>
">
    
    <div class="form-element">
    <label>
        <span class="label">Название товара:</span> 
        <input type="text" name="name_product" required value="<?php echo $this->_tpl_vars['product']->getName_product(); ?>
">
    </label>
    </div>
    <br>
    
    <div class="form-element">
    <label>
        <span class="label">Категория:</span>
        <select name="id_folder">
            
            <?php $this->assign('productFolder', $this->_tpl_vars['product']->getFolder()); ?>
            <?php $_from = $this->_tpl_vars['folders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['folder']):
?>
                <option <?php if ($this->_tpl_vars['productFolder']->getId_folder == $this->_tpl_vars['folder']['id_folder']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['folder']['id_folder']; ?>
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
    <?php if ($this->_tpl_vars['product']->getImages()): ?>
        <div class="form-element">
            <?php $_from = $this->_tpl_vars['product']->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
            <div class="card" style="width: 45px;">
                <img src="<?php echo $this->_tpl_vars['image']->getPath(); ?>
" class="card-img" alt="<?php echo $this->_tpl_vars['image']->getName_image(); ?>
">
                <div class="card-body">
                    <button data-image-id="<?php echo $this->_tpl_vars['image']->getId_image(); ?>
" onclick="return deleteImage(this)">X</button>
                                    </div>
            </div>
            <?php endforeach; endif; unset($_from); ?>
        </div>
    <?php echo '
        <script>
            function deleteImage(button) {
                let imageId = $(button).attr(\'data-image-id\');
                imageId = parseInt(imageId);
                
                if (!imageId) {
                    allert(\'Проблема с id_image\');
                    return false;
                }
                
                let url = \'/products/del_image\'
                
                const formData = new FormData();
                formData.append(\'id_image\', imageId);
                
                fetch(url, {
                    method: \'POST\',
                    body: formData
                })
                        .then(() => {
                            document.location.reload();
                        });
                
                return false;        
            }
        </script>    
    '; ?>
    
    <?php endif; ?>    
    <br>
    <div class="form-element">
    <label>
        <span class="label">Количество:</span>  
        <input type="number" name="amount" required value="<?php echo $this->_tpl_vars['product']->getAmount(); ?>
">
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Артикул:</span>  
        <input type="text" name="article" required value="<?php echo $this->_tpl_vars['product']->getArticle(); ?>
">
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Цена:</span>  
        <input type="number" name="price" required value="<?php echo $this->_tpl_vars['product']->getPrice(); ?>
">
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Описание:</span>  
        <textarea name="description" rows="6"><?php echo $this->_tpl_vars['product']->getDescription(); ?>
</textarea>
    </label>
    </div>    
    <br>
    <input type="submit" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['submit_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Сохранить') : smarty_modifier_default($_tmp, 'Сохранить')); ?>
">
</form>
