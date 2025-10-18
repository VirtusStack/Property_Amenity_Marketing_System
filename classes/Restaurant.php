<?php
// /classes/Restaurant.php
// ---------------------------
// Restaurant module class (plugin-ready)
// ---------------------------

class Restaurant {

    const PLUGIN_NAME = 'Restaurant';

    // -------------------------
    // Check if Restaurant plugin is enabled for a location
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
    // CREATE restaurant/menu safely
    // -------------------------
    public static function add($pdo, $data) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO restaurants
                (location_id, restaurant_name, menu_date, meal_type, menu_name, no_of_dishes, base_price, description, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $ok = $stmt->execute([
                $data['location_id'] ?? 0,
                $data['restaurant_name'] ?? '',
                $data['menu_date'] ?? '',
                $data['meal_type'] ?? '',
                $data['menu_name'] ?? '',
                $data['no_of_dishes'] ?? 10,
                $data['base_price'] ?? 0.0,
                $data['description'] ?? '',
                $data['status'] ?? 'active'
            ]);
            return $ok ? $pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log("Add restaurant failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // READ: Get all restaurants for a location (only if plugin enabled)
    // -------------------------
    public static function getByLocation($pdo, $location_id) {
        if (!self::isEnabled($pdo, $location_id)) {
            return []; // Plugin disabled for this location
        }
        $stmt = $pdo->prepare("
            SELECT r.*, l.location_name, l.place, l.city, l.state, l.country
            FROM restaurants r
            LEFT JOIN locations l ON r.location_id = l.location_id AND l.is_deleted = 0
            WHERE r.is_deleted = 0 AND r.location_id=?
            ORDER BY r.menu_date DESC, r.restaurant_name ASC
        ");
        $stmt->execute([$location_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ single restaurant/menu by ID
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE restaurant_id=? AND is_deleted=0");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // UPDATE restaurant/menu
    // -------------------------
    public static function update($pdo, $id, $data) {
        try {
            $stmt = $pdo->prepare("
                UPDATE restaurants
                SET location_id=?, restaurant_name=?, menu_date=?, meal_type=?, menu_name=?, no_of_dishes=?, base_price=?, description=?, status=?
                WHERE restaurant_id=?
            ");
            return $stmt->execute([
                $data['location_id'] ?? 0,
                $data['restaurant_name'] ?? '',
                $data['menu_date'] ?? '',
                $data['meal_type'] ?? '',
                $data['menu_name'] ?? '',
                $data['no_of_dishes'] ?? 10,
                $data['base_price'] ?? 0.0,
                $data['description'] ?? '',
                $data['status'] ?? 'active',
                $id
            ]);
        } catch (PDOException $e) {
            error_log("Update restaurant failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // DELETE restaurant/menu
    // -------------------------
    public static function delete($pdo, $id) {
        try {
            $stmt = $pdo->prepare("UPDATE restaurants SET is_deleted=1 WHERE restaurant_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete restaurant failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // GET ALL restaurants across locations (admin view)
    // -------------------------
    public static function getAll($pdo) {
        $stmt = $pdo->query("
            SELECT r.*, l.location_name, l.place, l.city, l.state, l.country
            FROM restaurants r
            LEFT JOIN locations l ON r.location_id = l.location_id AND l.is_deleted=0
            WHERE r.is_deleted=0
            ORDER BY r.menu_date DESC, r.restaurant_name ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
