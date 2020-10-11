<?php /* Smarty version 2.6.31, created on 2020-09-19 22:30:36
         compiled from user/register.form.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Регистрация")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p>
<?php if ($this->_tpl_vars['error']['message']): ?>
<div role="alert"><?php echo $this->_tpl_vars['error']['message']; ?>
</div><br>
<?php endif; ?>
<form action="" method="post">
    <div class="form-element">
        <label>
            <span class="label">Имя</span>
            <input name="name" <?php if ($_POST['name']): ?>value="<?php echo $_POST['name']; ?>
"<?php endif; ?> type="text" id="user-name">
        </label>
    </div>
    <br>
    <div class="form-element">
        <label>
            <span class="label">Email</span>
            <input name="email" <?php if ($_POST['email']): ?>value="<?php echo $_POST['email']; ?>
"<?php endif; ?>type="email" id="user-email">
        </label>
    </div>
    <br>
    <div class="form-element">
        <label>
            <span class="label">Пароль</span>
            <input name="password" type="password" id="user-password">
    </div>
    <br>
    <div class="form-element">
        <label>
            <span class="label">Повторите пароль</span>
            <input name="passwordRepeat" type="password" id="user-passwordRepeat">
    </div>
    <br>
    <div class="form-element">
        <input type="submit" value="Зарегистрироваться">
    </div>
</form>
</p>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>