<?php /* Smarty version 2.6.31, created on 2020-07-30 09:47:55
         compiled from folders/folders.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Список Категорий")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
        <?php $_from = $this->_tpl_vars['folders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['folder']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['folder']['id_folder']; ?>
</td>
            <td><?php echo $this->_tpl_vars['folder']['name_folder']; ?>
</td>
            <td><a href='/folders/upd?id_folder=<?php echo $this->_tpl_vars['folder']['id_folder']; ?>
'>Редактировать</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <form action="/folders/del" method="post" style="display: inline"><input type="hidden" name="id_folder" 
value=<?php echo $this->_tpl_vars['folder']['id_folder']; ?>
><input type="submit" value="Удалить"></form>
            </td>
        </tr> 
        <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>