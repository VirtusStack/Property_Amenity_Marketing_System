
<?php
// /classes/Location.php
// ---------------------------
// Location class for CRUD (without latitude/longitude)
// ---------------------------

class Location {

    // CREATE location safely
    public static function register($pdo, $company_id, $location_name = '', $address = '', $phone = '', $manager_name = '') {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO locations (company_id, location_name, address, phone, manager_name) 
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$company_id, $location_name, $address, $phone, $manager_name]);
        } catch (PDOException $e) {
            error_log("Register location failed: " . $e->getMessage());
            return false;
        }
    }

    // READ ALL companies with one location
    public static function getAll($pdo) {
        $stmt = $pdo->query("
            SELECT c.company_id, c.company_name, c.created_at,
                   l.location_name, l.address
            FROM companies c
            LEFT JOIN locations l ON c.company_id = l.company_id
            WHERE c.is_deleted = 0
            ORDER BY c.company_id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ ALL locations by company
    public static function getByCompany($pdo, $company_id) {
        $stmt = $pdo->prepare("SELECT * FROM locations WHERE company_id = ? AND is_deleted = 0");
        $stmt->execute([$company_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ single location
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM locations WHERE location_id = ? AND is_deleted = 0");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE location safely
    public static function update($pdo, $id, $data) {
        try {
            $location_name = $data['location_name'] ?? '';
            $address       = $data['address'] ?? '';
            $phone         = $data['phone'] ?? '';
            $manager_name  = $data['manager_name'] ?? '';

            $stmt = $pdo->prepare("
                UPDATE locations SET location_name=?, address=?, phone=?, manager_name=? 
                WHERE location_id=?
            ");
            return $stmt->execute([$location_name, $address, $phone, $manager_name, $id]);
        } catch (PDOException $e) {
            error_log("Update location failed: " . $e->getMessage());
            return false;
        }
    }

    // DELETE (soft delete)
    public static function delete($pdo, $id) {
        try {
            $stmt = $pdo->prepare("UPDATE locations SET is_deleted=1 WHERE location_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete location failed: " . $e->getMessage());
            return false;
        }
    }
}
