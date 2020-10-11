<?php /* Smarty version 2.6.31, created on 2020-07-30 10:35:25
         compiled from folders/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'folders/form.tpl', 10, false),)), $this); ?>
<form method="post" class="form f500p">
    <input type="hidden" name="id_folder" value="<?php echo $this->_tpl_vars['folder']['id_folder']; ?>
">
    <div class="form-element">
    <label>
        <span class="label">Название категории:</span> 
        <input type="text" name="name_folder" required value="<?php echo $this->_tpl_vars['folder']['name_folder']; ?>
">
    </label>
    </div>
    <br>
    <input type="submit"  value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['submit_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Сохранить') : smarty_modifier_default($_tmp, 'Сохранить')); ?>
">
</form>  