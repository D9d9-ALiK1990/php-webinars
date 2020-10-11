<?php /* Smarty version 2.6.31, created on 2020-10-03 09:27:37
         compiled from shop/order/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Список Заказов")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<p>
    <a href="/order/create">Создать заказ</a>
</p>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Дата создания</th>
        <th>Сумма заказа</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['order']['id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['order']['createdAt']; ?>
</td>
            <td><?php echo $this->_tpl_vars['order']['totalSum']; ?>
</td>
            <td><a href='/order/view?id_task=<?php echo $this->_tpl_vars['order']['id']; ?>
'>Подробнее</a>
                <form action="/order/delete" method="post" style="display: inline"><input type="hidden" name="id_task"
                                                                                       value=<?php echo $this->_tpl_vars['order']['id']; ?>
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