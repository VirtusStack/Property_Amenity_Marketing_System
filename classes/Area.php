<?php
// /classes/Area.php
// ---------------------------
// Area module class (unified plugin for Spa, Gym, Play Area, Banquet Hall, Conference Room, etc.)
// ---------------------------

class Area {

    const PLUGIN_NAME = 'Area';

    // -------------------------
    // Check if Area plugin is enabled for a location
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
    // CREATE a new Area (Spa, Gym, Play Area, etc.)
    // -------------------------
    public static function add($pdo, $data) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO areas 
                (location_id, area_name, plugin_type, description, status)
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([
                $data['location_id'] ?? 0,
                $data['area_name'] ?? '',
                $data['plugin_type'] ?? '',
                $data['description'] ?? '',
                $data['status'] ?? 'active'
            ]) ? $pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log('Add Area failed: ' . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // READ: Get all areas for a location (only if plugin enabled)
    // -------------------------
    public static function getByLocation($pdo, $location_id) {
        if (!self::isEnabled($pdo, $location_id)) {
            return []; // Plugin disabled
        }
        $stmt = $pdo->prepare("SELECT * FROM areas WHERE location_id = ? ORDER BY area_id DESC");
        $stmt->execute([$location_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // READ: Get single Area by ID
    // -------------------------
    public static function getById($pdo, $area_id) {
        $stmt = $pdo->prepare("SELECT * FROM areas WHERE area_id = ?");
        $stmt->execute([$area_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // UPDATE an Area
    // -------------------------
    public static function update($pdo, $area_id, $data) {
        try {
            $stmt = $pdo->prepare("
                UPDATE areas SET 
                    location_id = ?, 
                    area_name = ?, 
                    plugin_type = ?, 
                    description = ?, 
                    status = ?, 
                    updated_at = CURRENT_TIMESTAMP
                WHERE area_id = ?
            ");
            return $stmt->execute([
                $data['location_id'] ?? 0,
                $data['area_name'] ?? '',
                $data['plugin_type'] ?? '',
                $data['description'] ?? '',
                $data['status'] ?? 'active',
                $area_id
            ]);
        } catch (PDOException $e) {
            error_log('Update Area failed: ' . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // DELETE an Area
    // -------------------------
    public static function delete($pdo, $area_id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM areas WHERE area_id = ?");
            return $stmt->execute([$area_id]);
        } catch (PDOException $e) {
            error_log('Delete Area failed: ' . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // GET ALL areas across all locations (for admin view)
    // -------------------------
    public static function getAll($pdo) {
        $stmt = $pdo->query("
            SELECT a.*, l.location_name, c.company_name 
            FROM areas a
            INNER JOIN locations l ON a.location_id = l.location_id
            INNER JOIN companies c ON l.company_id = c.company_id
            ORDER BY c.company_name, l.location_name, a.area_name
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
