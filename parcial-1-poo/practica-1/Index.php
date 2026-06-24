<?php
require_once "Usuario.php";

$usuario = new Usuario("Lucero", "Lucero.beltraan98@outlook.com");

echo "<h2>Datos Iniciales </h2>";
echo "Nombre: " . $usuario->getNombre() . "<br>";
echo "Correo: " . $usuario->getCorreo() . "<br>";

$usuario->setNombre("Lucero Beltran");
$usuario->setCorreo("correo_invalido");

echo "<h2>Datos después de modificar</h2>";
echo "Nombre: " . $usuario->getNombre() . "<br>";
echo "Correo: " . $usuario->getCorreo() . "<br>";
?>


