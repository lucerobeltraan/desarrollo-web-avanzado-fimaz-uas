<?php
require_once "clases/Admin.php";
require_once "clases/Alumno.php";
require_once "clases/Invitado.php";

$usuarios = [];

try {
    // Objetos válidos
    $usuarios[] = new Admin("Angel", "angel_ayon@icloud.com");
    $usuarios[] = new Alumno("Lucero", "lucero.beltraan98@outlook.com", "A123");
    $usuarios[] = new Invitado("Alan", "AlanEliel@gmail.com", "Empresa XYZ");

    // Registro inválido (correo mal escrito)
    $usuarios[] = new Alumno("Error", "correo-invalido", "B456");

} catch (Exception $e) {
    echo "<p style='color:red;'>Error controlado: " . $e->getMessage() . "</p>";
}

// Tabla HTML
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Nombre</th><th>Correo</th><th>Rol</th><th>Matrícula</th><th>Empresa</th></tr>";

foreach ($usuarios as $u) {
    echo "<tr>";
    echo "<td>" . $u->getNombre() . "</td>";
    echo "<td>" . $u->getCorreo() . "</td>";
    echo "<td>" . $u->getRol() . "</td>";

    // Matrícula
    if ($u instanceof Alumno) {
        echo "<td>" . $u->getMatricula() . "</td>";
    } else {
        echo "<td>—</td>";
    }

    // Empresa
    if ($u instanceof Invitado) {
        echo "<td>" . $u->getEmpresa() . "</td>";
    } else {
        echo "<td>—</td>";
    }

    echo "</tr>";
}
echo "</table>";
?>
