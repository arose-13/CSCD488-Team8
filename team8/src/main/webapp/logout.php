<?php

session_start();

echo "Logging you out...";
if (session_destroy()) {
    header("Location: login.php");
}


?>