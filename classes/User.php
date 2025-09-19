<?php
// /classes/User.php
// ---------------------------
// User class for CRUD
// ---------------------------

class User {

    // CREATE: Add a new user
    public static function register($pdo, $name, $email, $password, $roleId, $propertyId = null) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO users (name, email, password, role_id, property_id) 
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$name, $email, $hashedPassword, $roleId, $propertyId]);
        } catch (PDOException $e) {
            error_log("Register user failed: " . $e->getMessage());
            return false;
        }
    }

    // READ: Get all users with role name
    public static function getAll($pdo) {
        try {
            $stmt = $pdo->query("
                SELECT u.user_id, u.name, u.email, r.role_name, u.created_at
                FROM users u
                LEFT JOIN roles r ON u.role_id = r.role_id
                ORDER BY u.created_at DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Fetching all users failed: " . $e->getMessage());
            return [];
        }
    }

    // READ: Single user
    public static function getById($pdo, $userId) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get user by ID failed: " . $e->getMessage());
            return false;
        }
    }

    // UPDATE: User details
    public static function update($pdo, $userId, $data) {
        try {
            if (!empty($data['password'])) {
                $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                $sql = "UPDATE users SET name=?, email=?, password=?, role_id=?, property_id=? WHERE user_id=?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([$data['name'], $data['email'], $hashedPassword, $data['role_id'], $data['property_id'], $userId]);
            } else {
                $sql = "UPDATE users SET name=?, email=?, role_id=?, property_id=? WHERE user_id=?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([$data['name'], $data['email'], $data['role_id'], $data['property_id'], $userId]);
            }
        } catch (PDOException $e) {
            error_log("Update user failed: " . $e->getMessage());
            return false;
        }
    }

    // DELETE: Remove user
    public static function delete($pdo, $userId) {
        try {
            $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
            return $stmt->execute([$userId]);
        } catch (PDOException $e) {
            error_log("Delete user failed: " . $e->getMessage());
            return false;
        }
    }
}
