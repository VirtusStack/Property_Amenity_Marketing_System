<?php
// /classes/SwimmingPool.php
// ---------------------------
// SwimmingPool module class (plugin-ready)
// ---------------------------

class SwimmingPool {

    const PLUGIN_NAME = 'Swimming Pool';

    // -------------------------
    // Check if Swimming Pool plugin is enabled for a location
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
    // CREATE a new swimming pool
    // -------------------------
    public static function add($pdo, $data) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO swimming_pools 
                (location_id, name, type, status, capacity, instructor_available, lifeguard_available, opening_time, closing_time, access_type, max_charge, price_per_hour, price_per_day, safety_rules, terms_conditions, instructions)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            return $stmt->execute([
                $data['location_id'] ?? 0,
                $data['name'] ?? '',
                $data['type'] ?? '',
                $data['status'] ?? 'active',
                $data['capacity'] ?? 0,
                $data['instructor_available'] ?? 0,
                $data['lifeguard_available'] ?? 0,
                $data['opening_time'] ?? null,
                $data['closing_time'] ?? null,
                $data['access_type'] ?? '',
                $data['max_charge'] ?? 0,
                $data['price_per_hour'] ?? 0,
                $data['price_per_day'] ?? 0,
                $data['safety_rules'] ?? '',
                $data['terms_conditions'] ?? '',
                $data['instructions'] ?? ''
            ]) ? $pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log("Add swimming pool failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // READ: Get all pools for a location (only if enabled)
    // -------------------------
    public static function getByLocation($pdo, $location_id) {
        if (!self::isEnabled($pdo, $location_id)) {
            return []; // Plugin disabled, return empty
        }
        $stmt = $pdo->prepare("SELECT * FROM swimming_pools WHERE location_id=? ORDER BY id DESC");
        $stmt->execute([$location_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ pool by ID (no plugin check)
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM swimming_pools WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // UPDATE a swimming pool
    // -------------------------
    public static function update($pdo, $id, $data) {
        try {
            $stmt = $pdo->prepare("
                UPDATE swimming_pools SET 
                    location_id=?, name=?, type=?, status=?, capacity=?, instructor_available=?, lifeguard_available=?, 
                    opening_time=?, closing_time=?, access_type=?, max_charge=?, price_per_hour=?, price_per_day=?, 
                    safety_rules=?, terms_conditions=?, instructions=?, updated_at=CURRENT_TIMESTAMP
                WHERE id=?
            ");
            return $stmt->execute([
                $data['location_id'] ?? 0,
                $data['name'] ?? '',
                $data['type'] ?? '',
                $data['status'] ?? 'active',
                $data['capacity'] ?? 0,
                $data['instructor_available'] ?? 0,
                $data['lifeguard_available'] ?? 0,
                $data['opening_time'] ?? null,
                $data['closing_time'] ?? null,
                $data['access_type'] ?? '',
                $data['max_charge'] ?? 0,
                $data['price_per_hour'] ?? 0,
                $data['price_per_day'] ?? 0,
                $data['safety_rules'] ?? '',
                $data['terms_conditions'] ?? '',
                $data['instructions'] ?? '',
                $id
            ]);
        } catch (PDOException $e) {
            error_log("Update swimming pool failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // DELETE swimming pool 
    // -------------------------
    public static function delete($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM swimming_pools WHERE id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete swimming pool failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // GET ALL pools across locations (admin view)
    // -------------------------
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM swimming_pools ORDER BY location_id, id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
