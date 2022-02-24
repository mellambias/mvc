<?php
session_start();
function isLoggedIn(){
    return isset($_SESSION['user_id'])?$_SESSION['user_id']:false;
}