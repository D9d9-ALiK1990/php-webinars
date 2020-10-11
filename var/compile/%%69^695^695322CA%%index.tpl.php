<?php /* Smarty version 2.6.31, created on 2020-10-01 00:22:05
         compiled from cart/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Корзина")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Кол-во</th>
        <th>Сумма</th>
        <th> </th>
    </tr>
    </thead>
    <tbody>
    <?php $_from = $this->_tpl_vars['cart']->getItems(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cartItem']):
?>
        <tr>
            <?php $this->assign('product', $this->_tpl_vars['cartItem']->getProductModel()); ?>
            <td><?php echo $this->_tpl_vars['product']->getId_product(); ?>
</td>
            <td><?php echo $this->_tpl_vars['product']->getName_product(); ?>
</td>
            <td><?php echo $this->_tpl_vars['product']->getPrice(); ?>
</td>
            <td><?php echo $this->_tpl_vars['cartItem']->getAmount(); ?>
</td>
            <td><?php echo $this->_tpl_vars['cartItem']->getTotal(); ?>
</td>
            <td>
                <form action="/shop/cart/remove?id_product=<?php echo $this->_tpl_vars['product']->getId_product(); ?>
" method="post" style="display: inline"><input type="hidden" name="id_product" value="<?php echo $this->_tpl_vars['product']->getId_product(); ?>
"><input type="submit" value="Уд"></form>
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