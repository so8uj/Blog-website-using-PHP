<?php 
session_start();
// erase session and erase cookie
session_destroy();
setcookie("login_id", "", time() - (86400 * 35));
header('Location: signin.php');
?>