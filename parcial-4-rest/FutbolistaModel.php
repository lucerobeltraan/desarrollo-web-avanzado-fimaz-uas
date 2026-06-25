<?php
class FutbolistaModel {
    private $conn;
    private $table = "futbolistas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        return $this->conn->query($query);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (nombre, posicion, numero, edad, equipo) 
                  VALUES (:nombre, :posicion, :numero, :edad, :equipo)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET nombre=:nombre, posicion=:posicion, numero=:numero, edad=:edad, equipo=:equipo 
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $data["id"] = $id;
        return $stmt->execute($data);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
