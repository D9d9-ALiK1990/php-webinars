<?php /* Smarty version 2.6.31, created on 2020-09-26 23:19:20
         compiled from products/products.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Список Товаров")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <p>
        <a href="/products/add">Добавить</a>
    </p>
    <p>
    <nav>
        <ul class="pagination">
            <?php unset($this->_sections['pagination']);
$this->_sections['pagination']['loop'] = is_array($_loop=$this->_tpl_vars['pages_count']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pagination']['name'] = 'pagination';
$this->_sections['pagination']['show'] = true;
$this->_sections['pagination']['max'] = $this->_sections['pagination']['loop'];
$this->_sections['pagination']['step'] = 1;
$this->_sections['pagination']['start'] = $this->_sections['pagination']['step'] > 0 ? 0 : $this->_sections['pagination']['loop']-1;
if ($this->_sections['pagination']['show']) {
    $this->_sections['pagination']['total'] = $this->_sections['pagination']['loop'];
    if ($this->_sections['pagination']['total'] == 0)
        $this->_sections['pagination']['show'] = false;
} else
    $this->_sections['pagination']['total'] = 0;
if ($this->_sections['pagination']['show']):

            for ($this->_sections['pagination']['index'] = $this->_sections['pagination']['start'], $this->_sections['pagination']['iteration'] = 1;
                 $this->_sections['pagination']['iteration'] <= $this->_sections['pagination']['total'];
                 $this->_sections['pagination']['index'] += $this->_sections['pagination']['step'], $this->_sections['pagination']['iteration']++):
$this->_sections['pagination']['rownum'] = $this->_sections['pagination']['iteration'];
$this->_sections['pagination']['index_prev'] = $this->_sections['pagination']['index'] - $this->_sections['pagination']['step'];
$this->_sections['pagination']['index_next'] = $this->_sections['pagination']['index'] + $this->_sections['pagination']['step'];
$this->_sections['pagination']['first']      = ($this->_sections['pagination']['iteration'] == 1);
$this->_sections['pagination']['last']       = ($this->_sections['pagination']['iteration'] == $this->_sections['pagination']['total']);
?>
                <li class="pagination-item"><a class="page-link <?php if ($_GET['p'] == $this->_sections['pagination']['iteration']): ?>active<?php endif; ?>" href="<?php echo $_SERVER['PATH_INFO']; ?>
?p=<?php echo $this->_sections['pagination']['iteration']; ?>
"><?php echo $this->_sections['pagination']['iteration']; ?>
</a></li>
            <?php endfor; endif; ?>
        </ul>    
    </nav>
    
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
            <td><?php echo $this->_tpl_vars['product']->getId_product(); ?>
</td>
            <td width="200">
                <?php echo $this->_tpl_vars['product']->getName_product(); ?>

                <?php if ($this->_tpl_vars['product']->getImages()): ?>
                <br>
                    <?php $_from = $this->_tpl_vars['product']->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
                        <img width="30" src="<?php echo $this->_tpl_vars['image']->getPath(); ?>
" alt="<?php echo $this->_tpl_vars['image']->getName_image(); ?>
">
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </td>
            <?php $this->assign('productFolder', $this->_tpl_vars['product']->getFolder()); ?>
            <td><?php echo $this->_tpl_vars['productFolder']->getName_folder(); ?>
</td>
            <td><?php echo $this->_tpl_vars['product']->getArticle(); ?>
</td>
            <td><?php echo $this->_tpl_vars['product']->getPrice(); ?>
</td>
            <td><?php echo $this->_tpl_vars['product']->getAmount(); ?>
</td>
            <td><a href='/shop/cart/add?id_product=<?php echo $this->_tpl_vars['product']->getId_product(); ?>
'>Купить</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href='/products/upd?id_product=<?php echo $this->_tpl_vars['product']->getId_product(); ?>
'>Ред</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <form action="/products/del" method="post" style="display: inline"><input type="hidden" name="id_product" 
value=<?php echo $this->_tpl_vars['product']->getId_product(); ?>
><input type="submit" value="Уд"></form>
            </td>
        </tr> 
        <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
        </p>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>