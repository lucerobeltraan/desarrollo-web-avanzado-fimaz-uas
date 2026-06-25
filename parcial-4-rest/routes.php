<?php
require_once "Database.php";
require_once "FutbolistaModel.php";
require_once "FutbolistaController.php";
require_once "utils/Response.php";

$db = (new Database())->getConnection();
$model = new FutbolistaModel($db);
$controller = new FutbolistaController($model);

$method = $_SERVER["REQUEST_METHOD"];
$uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));

// 🔎 Limpieza de segmentos innecesarios
// Si el primer segmento es el nombre de la carpeta del proyecto, lo eliminamos
if ($uri[0] === "practica-4-rest") {
    array_shift($uri);
}

// Si el primer segmento es "index.php", lo eliminamos
if ($uri[0] === "index.php") {
    array_shift($uri);
}

// 🚀 Ruteo principal
if (isset($uri[0]) && $uri[0] === "futbolistas") {
    switch ($method) {
        case "GET":
            if (isset($uri[1])) {
                $controller->getById($uri[1]);
            } else {
                $controller->getAll();
            }
            break;

        case "POST":
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->create($data);
            break;

        case "PUT":
            if (isset($uri[1])) {
                $id = $uri[1];
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->update($id, $data);
            } else {
                Response::json(["error" => "ID requerido para actualizar"], 400);
            }
            break;

        case "DELETE":
            if (isset($uri[1])) {
                $controller->delete($uri[1]);
            } else {
                Response::json(["error" => "ID requerido para eliminar"], 400);
            }
            break;

        default:
            Response::json(["error" => "Método no permitido"], 405);
    }
} else {
    Response::json(["error" => "Ruta no encontrada"], 404);
}
