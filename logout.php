<?php

session_start();

session_unset();

session_destroy(); //destroy the sesstion

header('location:index.php');

exit();
?>