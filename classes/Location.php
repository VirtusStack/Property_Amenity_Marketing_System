<?php
// /classes/Location.php
// ---------------------------
// Location class for CRUD operations
// Matches MySQL table: locations
// ---------------------------

class Location {

    // CREATE location safely
    public static function register($pdo, $company_id, $location_name = '', $place = '', $country = '', $state = '', $city = '', $contact_number = '', $manager = '', $created_by = null) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO locations 
                (company_id, location_name, place, country, state, city, contact_number, manager, created_by) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$company_id, $location_name, $place, $country, $state, $city, $contact_number, $manager, $created_by]);
        } catch (PDOException $e) {
            error_log("Register location failed: " . $e->getMessage());
            return false;
        }
    }

    // READ all locations with company info
    public static function getAll($pdo) {
        $stmt = $pdo->query("
            SELECT c.company_id, c.company_name, c.created_at AS company_created_at,
                   l.location_id, l.location_name, l.place, l.country, l.state, l.city, l.contact_number, l.manager, l.created_at AS location_created_at
            FROM companies c
            LEFT JOIN locations l ON c.company_id = l.company_id AND l.is_deleted = 0
            WHERE c.is_deleted = 0
            ORDER BY c.company_id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ all locations by company
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
            $location_name   = $data['location_name'] ?? '';
            $place           = $data['place'] ?? '';
            $country         = $data['country'] ?? '';
            $state           = $data['state'] ?? '';
            $city            = $data['city'] ?? '';
            $contact_number  = $data['contact_number'] ?? '';
            $manager         = $data['manager'] ?? '';

            $stmt = $pdo->prepare("
                UPDATE locations SET location_name=?, place=?, country=?, state=?, city=?, contact_number=?, manager=? 
                WHERE location_id=?
            ");
            return $stmt->execute([$location_name, $place, $country, $state, $city, $contact_number, $manager, $id]);
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
