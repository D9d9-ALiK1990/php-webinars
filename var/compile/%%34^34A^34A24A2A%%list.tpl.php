<?php /* Smarty version 2.6.31, created on 2020-08-08 21:32:43
         compiled from queue/list.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Список Задач")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Название задачи</th>
            <th>Статус задачи</th>
             <th>&nbsp;</th>
        </tr>    
        </thead>
        <tbody>
        <?php $_from = $this->_tpl_vars['tasks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['task']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['task']['id_task']; ?>
</td>
            <td><?php echo $this->_tpl_vars['task']['name_task']; ?>
</td>
            <td><?php echo $this->_tpl_vars['task']['status']; ?>
</td>
            <td><a href='/queue/run?id_task=<?php echo $this->_tpl_vars['task']['id_task']; ?>
'>Зап</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <form action="/queue/del" method="post" style="display: inline"><input type="hidden" name="id_task" 
value=<?php echo $this->_tpl_vars['task']['id_task']; ?>
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