<?php
namespace App\Models;
use PDO;
class ContactInfo extends Model {
    protected $table = 'contact_info';
    public function getInfo() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id ASC LIMIT 1";
        $stmt = $this->connexion->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
} 