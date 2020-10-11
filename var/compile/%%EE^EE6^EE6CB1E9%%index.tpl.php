<?php /* Smarty version 2.6.31, created on 2020-08-06 00:19:44
         compiled from import/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Импорт товаров")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>