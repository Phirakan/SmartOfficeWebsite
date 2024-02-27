<?php
session_start();
session_destroy();
header("Location: ../Page/authentication/Login.php");
exit;
?>
