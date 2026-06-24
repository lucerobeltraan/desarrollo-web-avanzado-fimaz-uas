<?php
require_once "Admin.php";

$admin = new Admin("Lucero Beltran", "Lucero.beltraan98@outlook.com");

echo "Nombre: "  . $admin->getNombre()  . "<br>";
echo "Correo: "  . $admin->getCorreo()  . "<br>";
echo "Rol: "  . $admin->getRol()  . "<br>";

