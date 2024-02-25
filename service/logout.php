<?php
session_start();
session_destroy();
header("Location: ../Page/Login.php");
exit;
?>
