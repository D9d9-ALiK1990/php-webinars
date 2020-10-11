{include file="header.tpl" h1="Авторизация на сайте"}

<p>
{if $error.message}
<div role="alert">{$error.message}</div><br>
{/if}
<form action="" method="post">
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
        <input type="submit" value="Авторизоваться">
    </div>
</form>
</p>


{include file="bottom.tpl"}