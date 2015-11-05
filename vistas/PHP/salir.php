<?php
session_start();
unset($_SESSION['Usuario']);
unset($_SESSION['id']);
unset($_SESSION['nombre']);
unset($_SESSION['apellido']);
unset($_SESSION['cargo']);
unset($_SESSION['id_nivel']);
session_destroy();
header("Location: ../panel_de_control.php");
?>