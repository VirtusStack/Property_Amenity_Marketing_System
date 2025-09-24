<?php
// /classes/Location.php
// ---------------------------
// Location model - handles location data from DB
// ---------------------------

class Location {

    // Get all locations
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM locations ORDER BY location_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get location by ID
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM locations WHERE location_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


