<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form name="loginForma" method="POST" action="<?php echo site_url('Login/logovanje')?>">
            Username: <input type="text" name="username">
            <br/>
            Password: <input type="password" name="pass">
            <br/>
            <input type="submit" name="log" value="Login">
        </form>  
        
        <a href="<?php echo 'Registracija'?>">Registracija</a>
        <?php
        // put your code here
        ?>
    </body>
</html>
