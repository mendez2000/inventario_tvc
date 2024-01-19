<?php


session_start();
if ($_SESSION['user_session']){
    session_destroy();
    session_unset();
    unset($_SESSION['nombre']);
    unset($_SESSION['user_session']);
    unset($_SESSION['tipo']);
    header("location: ../index.php");

}else{
    header("location: ../index.php");
}