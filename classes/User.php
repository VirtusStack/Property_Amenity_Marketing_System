<?php
// /classes/User.php
// ---------------------------
// User class for handling CRUD operations
// Works with PDO and uses static methods for simplicity
// ---------------------------

class User {

    // CREATE: Register a new user
    public static function register($pdo, $name, $email, $password, $roleId, $propertyId = null) {
        try {
            // Hash password before saving
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert into database
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

    // READ: Get all users with their role name
    public static function getAll($pdo) {
        $stmt = $pdo->query("
            SELECT u.user_id, u.name, u.email, r.role_name, u.created_at
            FROM users u
            JOIN roles r ON u.role_id = r.role_id
            ORDER BY u.created_at DESC
        ");
        return $stmt->fetchAll();
    }

    // READ: Get a single user by ID
    public static function getById($pdo, $userId) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    // UPDATE: Update user details
    // Supports optional password update
    public static function update($pdo, $userId, $data) {
        try {
            if (!empty($data['password'])) {
                // If password provided → hash it
                $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                $sql = "UPDATE users 
                        SET name=?, email=?, password=?, role_id=?, property_id=? 
                        WHERE user_id=?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([
                    $data['name'],
                    $data['email'],
                    $hashedPassword,
                    $data['role_id'],
                    $data['property_id'],
                    $userId
                ]);
            } else {
                // No new password → keep old one
                $sql = "UPDATE users 
                        SET name=?, email=?, role_id=?, property_id=? 
                        WHERE user_id=?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([
                    $data['name'],
                    $data['email'],
                    $data['role_id'],
                    $data['property_id'],
                    $userId
                ]);
            }
        } catch (PDOException $e) {
            error_log("Update user failed: " . $e->getMessage());
            return false;
        }
    }

    // DELETE: Remove a user by ID
    public static function delete($pdo, $userId) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
        return $stmt->execute([$userId]);
    }
}
