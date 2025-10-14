<?php
// /classes/Restaurant.php
// ---------------------------
// Restaurant class for CRUD operations

class Restaurant {

    // CREATE restaurant/menu safely
    public static function register($pdo, $location_id, $restaurant_name, $menu_date, $meal_type, $menu_name = '', $no_of_dishes = 10, $base_price = 0.0, $description = '', $status = 'active') {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO restaurants
                (location_id, restaurant_name, menu_date, meal_type, menu_name, no_of_dishes, base_price, description, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$location_id, $restaurant_name, $menu_date, $meal_type, $menu_name, $no_of_dishes, $base_price, $description, $status]);
        } catch (PDOException $e) {
            error_log("Register restaurant failed: " . $e->getMessage());
            return false;
        }
    }

    // READ all restaurants with location info
    public static function getAll($pdo) {
        $stmt = $pdo->query("
            SELECT r.*, 
                   l.location_name, l.place, l.city, l.state, l.country
            FROM restaurants r
            LEFT JOIN locations l ON r.location_id = l.location_id AND l.is_deleted = 0
            WHERE r.is_deleted = 0
            ORDER BY r.restaurant_name ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ single restaurant/menu by ID
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE restaurant_id = ? AND is_deleted = 0");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE restaurant/menu safely
    public static function update($pdo, $id, $data) {
        try {
            $location_id     = $data['location_id'] ?? null;
            $restaurant_name = $data['restaurant_name'] ?? ''; // Restaurant name must come from form
            $menu_date       = $data['menu_date'] ?? null;
            $meal_type       = $data['meal_type'] ?? '';
            $menu_name       = $data['menu_name'] ?? '';
            $no_of_dishes    = $data['no_of_dishes'] ?? 10;
            $base_price      = $data['base_price'] ?? 0.0;
            $description     = $data['description'] ?? '';
            $status          = $data['status'] ?? 'active';

            $stmt = $pdo->prepare("
                UPDATE restaurants 
                SET location_id=?, restaurant_name=?, menu_date=?, meal_type=?, menu_name=?, no_of_dishes=?, base_price=?, description=?, status=? 
                WHERE restaurant_id=?
            ");
            return $stmt->execute([$location_id, $restaurant_name, $menu_date, $meal_type, $menu_name, $no_of_dishes, $base_price, $description, $status, $id]);
        } catch (PDOException $e) {
            error_log("Update restaurant failed: " . $e->getMessage());
            return false;
        }
    }

    // DELETE (soft delete)
    public static function delete($pdo, $id) {
        try {
            $stmt = $pdo->prepare("UPDATE restaurants SET is_deleted=1 WHERE restaurant_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete restaurant failed: " . $e->getMessage());
            return false;
        }
    }
}
?>
