<?php 
session_start();

if(isset($_SESSION["u"])){
    session_unset();
    session_destroy();
    
    echo "success";
}

