<!DOCTYPE html>

        <form name="loginForma" method="POST" action="<?php echo site_url('Login/logovanje')?>">
            Username: <input type="text" name="username">
            <br/>
            Password: <input type="password" name="pass">
            <br/>
            <input type="submit" name="log" value="Login">
        </form>  
        
        <a href="<?php echo site_url('Registracija')?>">Registracija</a>
        <?php
        // put your code here
        ?>
    </body>

