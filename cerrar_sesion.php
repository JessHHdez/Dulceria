<?php
session_start();
session_unset();
session_destroy();

// Redireccionar a la página de inicio
header("Location: index.php");
exit();
?>
