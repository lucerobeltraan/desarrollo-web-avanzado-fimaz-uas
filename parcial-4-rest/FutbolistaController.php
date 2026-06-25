<?php
require_once "utils/Response.php";
require_once "utils/Validator.php";

class FutbolistaController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getAll() {
        $stmt = $this->model->getAll();
        Response::json($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getById($id) {
        $stmt = $this->model->getById($id);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $data ? Response::json($data) : Response::json(["error" => "No encontrado"], 404);
    }

    public function create($data) {
        if (!Validator::validarEdad($data["edad"])) {
            Response::json(["error" => "Edad inválida"], 400);
            return;
        }
        $this->model->create($data);
        Response::json(["message" => "Futbolista creado"]);
    }

    public function update($id, $data) {
        $this->model->update($id, $data);
        Response::json(["message" => "Futbolista actualizado"]);
    }

    public function delete($id) {
        $this->model->delete($id);
        Response::json(["message" => "Futbolista eliminado"]);
    }
}
