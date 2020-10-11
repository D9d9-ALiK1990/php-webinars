{include file="header.tpl" h1="Регистрация"}

<p>
{if $error.message}
<div role="alert">{$error.message}</div><br>
{/if}
<form action="" method="post">
    <div class="form-element">
        <label>
            <span class="label">Имя</span>
            <input name="name" {if $smarty.post.name}value="{$smarty.post.name}"{/if} type="text" id="user-name">
        </label>
    </div>
    <br>
    <div class="form-element">
        <label>
            <span class="label">Email</span>
            <input name="email" {if $smarty.post.email}value="{$smarty.post.email}"{/if}type="email" id="user-email">
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
{*    <div class="form-check">*}
{*        <input class="form-check-input" type="checkbox" id="gridCheck1">*}
{*        <label class="form-check-label" for="gridCheck1">*}
{*            Согласен на обработку персональных данных*}
{*        </label>*}
{*    </div>*}
{*    <br>*}
    <div class="form-element">
        <input type="submit" value="Зарегистрироваться">
    </div>
</form>
</p>


{include file="bottom.tpl"}