<?php
// /classes/Plugin.php
// -------------------------
// Plugin class: handles plugin master and location plugin enable/disable
// -------------------------

class Plugin {

    // -------------------------
    // Get all available plugins (from plugin_master)
    // -------------------------
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM plugin_master ORDER BY plugin_id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // Get enabled plugins for a specific location
    // -------------------------
    public static function getEnabled($pdo, $location_id) {
        $stmt = $pdo->prepare("
            SELECT p.plugin_id, p.plugin_name AS name
            FROM plugin_master p
            INNER JOIN location_plugins lp ON lp.plugin_id = p.plugin_id
            WHERE lp.location_id = ? AND lp.is_enabled = 1
        ");
        $stmt->execute([$location_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // Get All Plugins with Locations
    // -------------------------
    public static function getAllWithLocations($pdo) {
        $stmt = $pdo->query("
            SELECT 
                lp.id AS location_plugin_id,
                pm.plugin_id,
                pm.plugin_name,
                pm.description,
                l.location_id,
                l.location_name,
                c.company_name,
                lp.is_enabled
            FROM location_plugins lp
            INNER JOIN plugin_master pm ON lp.plugin_id = pm.plugin_id
            INNER JOIN locations l ON lp.location_id = l.location_id
            INNER JOIN companies c ON l.company_id = c.company_id
            WHERE l.is_deleted = 0
            ORDER BY c.company_name, l.location_name, pm.plugin_name
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // Add default plugin entries when a new location is created
    // -------------------------
    public static function addDefaultsForLocation($pdo, $location_id) {
        try {
            // Fetch all plugins from master
            $plugins = $pdo->query("SELECT plugin_id FROM plugin_master")->fetchAll(PDO::FETCH_COLUMN);

            // Add default entries (disabled initially)
            $stmt = $pdo->prepare("INSERT INTO location_plugins (location_id, plugin_id, is_enabled) VALUES (?, ?, 0)");
            foreach ($plugins as $pid) {
                $stmt->execute([$location_id, $pid]);
            }
        } catch (PDOException $e) {
            error_log("Add default plugins failed: " . $e->getMessage());
        }
    }

    // -------------------------
    // Get all plugin statuses for a location (enabled/disabled)
    // -------------------------
    public static function getByLocation($pdo, $location_id) {
        $stmt = $pdo->prepare("
            SELECT p.plugin_id, p.plugin_name, lp.is_enabled
            FROM plugin_master p
            LEFT JOIN location_plugins lp 
                ON lp.plugin_id = p.plugin_id AND lp.location_id = ?
            ORDER BY p.plugin_id ASC
        ");
        $stmt->execute([$location_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // Update plugin enable/disable for a specific location
    // -------------------------
    public static function updateForLocation($pdo, $location_id, $plugin_id, $enabled) {
        $stmt = $pdo->prepare("
            UPDATE location_plugins 
            SET is_enabled = ? 
            WHERE location_id = ? AND plugin_id = ?
        ");
        return $stmt->execute([$enabled ? 1 : 0, $location_id, $plugin_id]);
    }

    // -------------------------
    //  Check if plugin is enabled for a given location
    // -------------------------
    public static function hasAccess($pdo, $location_id, $plugin_name) {
        $stmt = $pdo->prepare("
            SELECT lp.is_enabled
            FROM location_plugins lp
            INNER JOIN plugin_master pm ON lp.plugin_id = pm.plugin_id
            WHERE lp.location_id = ? AND pm.plugin_name = ?
            LIMIT 1
        ");
        $stmt->execute([$location_id, $plugin_name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row && $row['is_enabled'] == 1;
    }
}
?>

