<?php /* Smarty version 2.6.31, created on 2020-09-24 01:35:13
         compiled from header.tpl */ ?>
<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Список товаров</title>
    <?php echo '
    <style>
        html, body {
        margin: 0;
        padding: 0;
        font: normal 13px Arial, Helvetika, sans-serif;
        background: #2f4538;
        }
        
        .site-wrapper {
            background: #fff;
            width: 1000px;
            height:1000px;
            margin: 0 auto;
            padding: 20px 40px;
        }
        
        .table {
            border-spacing: 0;
            border-collapse: collapse;
            
            
        }
        .table th {
            border: 1px solid #333;
            padding: 5px 5px;
            background: rgba(0, 0, 0, 0.1);
        }
        .table td {
            border: 1px solid #333;
            padding: 3px 5px;
            &:last-child {
                white-spice: nowrap;
            }
        }
        
        .form {
            
        }
        
        .form.f500p {
            width: 500px;
        }
        
        .form-element {
           padding: 5px 10px 15px 10px; 
        }
        
        .label {
            display: block;
            font-weight: bold;
            font-size: 14 px;
        }
        input[type="text"], [type="number"], textarea {
            
        }
        .top-menu {
            list-style: none;
            margin: 0 0 20px 0;
            padding: 0;
            
            display: flex;
            
            background: rgba(47, 69, 56, 0.15);
            border-bottom: 1px solid #333;
            
        }
        .vertical-menu {
             width: 200px;
             height:1000px;
             float: left;
             margin-right: 10px;
             }

        .vertical-menu a {
            background-color: #eee;
            color: black;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .vertical-menu a:hover {
            background-color: #ccc;
        }

        .vertical-menu a.active {
            background-color: #2f4538;
            color: white;
        }
        .pagination {
            display: flex;
        }
        .pagination-item {
            margin-right: 10px;
            border-radius: 10px;
            border: solid 1px #ececec;
            background-color: #eee;
        }
        .pagination a {
            padding: 11px 16px 11px 16px;
            display: flex;
        }
        .pagination a.active {
            border-radius: 10px;
            border: solid 1px #2f4538;
            background-color: #2f4538;
            color: white;
        }
        .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-clip: border-box;

        > hr {
          margin-right: 0;
          margin-left: 0;
        }

        > .list-group:first-child {
          .list-group-item:first-child {
                   }
        }

        > .list-group:last-child {
          .list-group-item:last-child {
         
          }
        }
      }

      .card-body {
       
        flex: 1 1 auto;
      }

      .card-subtitle {
        margin-bottom: 0;
      }

      .card-text:last-child {
        margin-bottom: 0;
      }

      .card-link {
          text-decoration: none;
        }
     .card-header {
                

                &:first-child {
                                 }

                + .list-group {
                  .list-group-item:first-child {
                    border-top: 0;
                  }
                }
              }

              .card-header-tabs {
    
                border-bottom: 0;
              }
              .card-img-overlay {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
           
              }

              .card-img {
                width: 100%; 
                
              }

              .card-img-top {
                width: 100%; 
              }

        .login-page {
            width: 200px;
            height:200px;
            float: left;
            margin-right: 10px;
        }
        /*.form {*/
        /*    position: relative;*/
        /*    z-index: 1;*/
        /*    background: #FFFFFF;*/
        /*    max-width: 360px;*/
        /*    margin: 0 auto 100px;*/
        /*    text-align: center;*/
        /*    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);*/
        /*}*/
        /*.form input {*/
        /*    font-family: "Roboto", sans-serif;*/
        /*    outline: 0;*/
        /*    background: #f2f2f2;*/
        /*    width: 100%;*/
        /*    border: 0;*/
        /*    margin: 0 0 15px;*/
        /*    padding: 15px;*/
        /*    box-sizing: border-box;*/
        /*    font-size: 14px;*/
        /*}*/
        /*.form button {*/
        /*    font-family: "Roboto", sans-serif;*/
        /*    text-transform: uppercase;*/
        /*    outline: 0;*/
        /*    background: #2f4538;*/
        /*    width: 100%;*/
        /*    border: 0;*/
        /*    padding: 15px;*/
        /*    color: #FFFFFF;*/
        /*    font-size: 14px;*/
        /*    -webkit-transition: all 0.3 ease;*/
        /*    transition: all 0.3 ease;*/
        /*    cursor: pointer;*/
        /*}*/

              
              
              
              
    </style>
    '; ?>
    
</head>
<body>
<div class="site-wrapper">
    <ul class="top-menu">
        <li><a href="/products">Товары</a>&emsp;</li>
        <li><a href="/folders">Категории</a>&emsp;</li>
        <li><a href="/import">Импорт</a>&emsp;</li>

        <?php if ($this->_tpl_vars['user']): ?>
            <li><span><?php echo $this->_tpl_vars['user']->getName(); ?>
</span>&emsp;</li>
            <?php else: ?>
            <li><a href="/user/register">Регистрация</a>&emsp;</li>
        <?php endif; ?>
    </ul>
<?php if ($this->_tpl_vars['h1']): ?><h1><?php echo $this->_tpl_vars['h1']; ?>
</h1><?php endif; ?>



    <div class="vertical-menu">
        <div class="login-page">
            <div class="form">
                <form class="login-form" method="post">
                    <input type="email" name="email" id="userEmail" placeholder="Email"/>
                    <input type="password" name="password" id="userPassword" placeholder="Пароль"/>
                    <button type="submit" >Войти</button>
                </form>
            </div>
        </div>
        <?php $_from = $this->_tpl_vars['folders_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['folder']):
?>
         <a <?php if ($this->_tpl_vars['folder_activ']['id_folder'] == $this->_tpl_vars['folder']['id_folder']): ?> class="active"<?php endif; ?>href="/folders/view?id_folder=<?php echo $this->_tpl_vars['folder']['id_folder']; ?>
"><?php echo $this->_tpl_vars['folder']['name_folder']; ?>
</a>
         <?php endforeach; endif; unset($_from); ?>
    </div>
    
    
    