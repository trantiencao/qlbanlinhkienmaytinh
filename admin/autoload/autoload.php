<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    require_once __DIR__ . "/../../libraries/database.php";
    require_once __DIR__ . "/../../libraries/function.php";
?>