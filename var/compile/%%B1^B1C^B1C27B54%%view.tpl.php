<?php /* Smarty version 2.6.31, created on 2020-07-31 10:03:46
         compiled from folders/view.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => $this->_tpl_vars['folder_activ']['name_folder'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
        <?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['product']['id_product']; ?>
</td>
            <td width="200"><?php echo $this->_tpl_vars['product']['name_product']; ?>
</td>
            <td><?php echo $this->_tpl_vars['product']['name_folder']; ?>
</td>
            <td><?php echo $this->_tpl_vars['product']['article']; ?>
</td>
            <td><?php echo $this->_tpl_vars['product']['price']; ?>
</td>
            <td><?php echo $this->_tpl_vars['product']['amount']; ?>
</td>
            <td><a href='/products/upd?id_product=<?php echo $this->_tpl_vars['product']['id_product']; ?>
'>Ред</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <form action="/products/del" method="post" style="display: inline"><input type="hidden" name="id_product" 
value=<?php echo $this->_tpl_vars['product']['id_product']; ?>
><input type="submit" value="Уд"></form>
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