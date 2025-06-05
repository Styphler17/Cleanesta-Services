<?php

namespace App\Models;

use PDO;
use Core\Database;

abstract class Model {
    protected $connexion;
    protected $table;

    public function __construct() {
        $this->connexion = Database::getConnection();
    }

    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $query = $this->connexion->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
} 