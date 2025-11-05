<?php
// /classes/User.php
// ---------------------------
// User class for CRUD, authentication, and company/location support
// ---------------------------

class User {

    // CREATE: Add a new user
    public static function register($pdo, $name, $email, $password, $roleId, $companyId, $locationId = null) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO users (name, email, password, role_id, company_id, location_id) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$name, $email, $hashedPassword, $roleId, $companyId, $locationId]);
        } catch (PDOException $e) {
            error_log("Register user failed: " . $e->getMessage());
            return false;
        }
    }

    // AUTHENTICATE: Check email/password
    public static function authenticate($pdo, $email, $password) {
        try {
            // Explicitly select needed columns including location_id
            $stmt = $pdo->prepare("
                SELECT user_id, name, email, role_id, company_id, location_id, password 
                FROM users 
                WHERE email = ?
            ");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Remove password before returning
                unset($user['password']);
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Authentication failed: " . $e->getMessage());
            return false;
        }
    }

    // READ: Get all users with role name, company, and location
    public static function getAll($pdo) {
        try {
            $stmt = $pdo->query("
                SELECT u.user_id, u.name, u.email, r.role_name, u.company_id, u.location_id, u.created_at
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
            // Explicitly select needed columns including location_id
            $stmt = $pdo->prepare("
                SELECT user_id, name, email, password, role_id, company_id, location_id 
                FROM users 
                WHERE user_id = ?
            ");
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
                $sql = "UPDATE users SET name=?, email=?, password=?, role_id=?, company_id=?, location_id=? WHERE user_id=?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([
                    $data['name'], $data['email'], $hashedPassword, 
                    $data['role_id'], $data['company_id'], $data['location_id'], $userId
                ]);
            } else {
                $sql = "UPDATE users SET name=?, email=?, role_id=?, company_id=?, location_id=? WHERE user_id=?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([
                    $data['name'], $data['email'], 
                    $data['role_id'], $data['company_id'], $data['location_id'], $userId
                ]);
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

    // READ: Get user by email
    public static function getByEmail($pdo, $email) {
        try {
            // Explicitly select needed columns including location_id
            $stmt = $pdo->prepare("
                SELECT user_id, name, email, role_id, company_id, location_id 
                FROM users 
                WHERE email = ?
            ");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get user by email failed: " . $e->getMessage());
            return false;
        }
    }
}

