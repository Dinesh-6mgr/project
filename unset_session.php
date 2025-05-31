<?php
if(isset($_SESSION["username"])) 
{
    if(time()-$_SESSION["login_time_stamp"] >300)  
    {
        session_unset();
        session_destroy();
        header("Location:login.php");
    }
}else
{
    header("Location:login.php");
}

