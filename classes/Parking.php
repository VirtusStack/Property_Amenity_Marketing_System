<?php
// /classes/Parking.php
// ---------------------------
// Parking module class (plugin-ready)
// ---------------------------

class Parking {

    const PLUGIN_NAME = 'Parking';

    // -------------------------
    // Check if Parking plugin is enabled for a location
    // -------------------------
    public static function isEnabled($pdo, $location_id) {
        $stmt = $pdo->prepare("
            SELECT lp.is_enabled
            FROM location_plugins lp
            INNER JOIN plugin_master pm ON lp.plugin_id = pm.plugin_id
            WHERE lp.location_id = ? AND pm.plugin_name = ?
        ");
        $stmt->execute([$location_id, self::PLUGIN_NAME]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row && $row['is_enabled'] == 1;
    }

    // -------------------------
    // CREATE a new parking record
    // -------------------------
    public static function add($pdo, $data) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO parking 
                (location_id, parking_name, parking_number, vehicle_number, type, capacity, is_covered, charging_point_available, status, description)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            return $stmt->execute([
                $data['location_id'] ?? 0,
                $data['parking_name'] ?? '',
                $data['parking_number'] ?? '',
                $data['vehicle_number'] ?? '',
                $data['type'] ?? 'All',
                $data['capacity'] ?? 0,
                $data['is_covered'] ?? 0,
                $data['charging_point_available'] ?? 0,
                $data['status'] ?? 'Available',
                $data['description'] ?? ''
            ]) ? $pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log("Add parking failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // READ: Get all parking areas for a location (only if enabled)
    // -------------------------
    public static function getByLocation($pdo, $location_id) {
        if (!self::isEnabled($pdo, $location_id)) {
            return []; // Plugin disabled for this location
        }
        $stmt = $pdo->prepare("SELECT * FROM parking WHERE location_id=? ORDER BY parking_id DESC");
        $stmt->execute([$location_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ single parking by ID
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM parking WHERE parking_id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // UPDATE parking record
    // -------------------------
    public static function update($pdo, $id, $data) {
        try {
            $stmt = $pdo->prepare("
                UPDATE parking SET 
                    location_id=?, parking_name=?, parking_number=?, vehicle_number=?, type=?, 
                    capacity=?, is_covered=?, charging_point_available=?, status=?, description=?, 
                    updated_at=CURRENT_TIMESTAMP
                WHERE parking_id=?
            ");
            return $stmt->execute([
                $data['location_id'] ?? 0,
                $data['parking_name'] ?? '',
                $data['parking_number'] ?? '',
                $data['vehicle_number'] ?? '',
                $data['type'] ?? 'All',
                $data['capacity'] ?? 0,
                $data['is_covered'] ?? 0,
                $data['charging_point_available'] ?? 0,
                $data['status'] ?? 'Available',
                $data['description'] ?? '',
                $id
            ]);
        } catch (PDOException $e) {
            error_log("Update parking failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // DELETE parking record (hard delete)
    // -------------------------
    public static function delete($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM parking WHERE parking_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete parking failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // GET ALL parking records across locations (admin view)
    // -------------------------
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM parking ORDER BY location_id, parking_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
