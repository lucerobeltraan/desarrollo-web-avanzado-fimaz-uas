<?php
require_once "Admin.php";
require_once "Alumno.php";

try {

    $admin = new Admin("Lucero Beltran", "lucero.beltraan98@outlook.com");
    $alumno = new Alumno("Angel Ayon", "angen_1997@hotmail.com", "A001");

    echo "<h3>Datos válidos</h3>";
    echo "Admin: " . $admin->getNombre() . " - " . $admin->getRol() . "<br>";
    echo "Alumno: " . $alumno->getNombre() . " - " . $alumno->getRol() . "<br>";

    
    $usuarioError = new Admin("Pedro", "correo-malo");

} catch (Exception $e) {
    echo "<h2>Error controlado:</h2>";
    echo $e->getMessage();
}