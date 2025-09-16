<?php
// /core/users/UserFunctions.php

// Contains reusable functions for managing users


//  CREATE: Register a new user
function registerUser($pdo, $name, $email, $password, $roleId, $propertyId = null) {
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
function getUsers($pdo) {
    $stmt = $pdo->query("
        SELECT u.user_id, u.name, u.email, r.role_name, u.created_at
        FROM users u
        JOIN roles r ON u.role_id = r.role_id
        ORDER BY u.created_at DESC
    ");
    return $stmt->fetchAll();
}

// READ: Get a single user by ID
function getUser($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

// DELETE: Remove a user by ID
function deleteUser($pdo, $userId) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    return $stmt->execute([$userId]);
}

// UPDATE: Update user details
// Supports optional password and property update
function updateUser($pdo, $userId, $data) {
    try {
        // If password is provided → hash it and update
        if (!empty($data['password'])) {
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
            // If no new password → keep old one
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
