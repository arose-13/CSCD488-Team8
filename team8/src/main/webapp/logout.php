<?php

echo "Logging you out...";
session_destroy();
header("Location: login.php");

?>