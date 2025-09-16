<?php
// /core/roles/RoleFunctions.php
// -----------------------------
// Functions for managing roles

// Add a new role (CREATE)
function addRole($pdo, $roleName) {
    try {
        $stmt = $pdo->prepare("INSERT INTO roles (role_name) VALUES (?)");
        return $stmt->execute([$roleName]);
    } catch (PDOException $e) {
        return false;
    }
}

// Get all roles (READ)
function getRoles($pdo) {
    $stmt = $pdo->query("SELECT * FROM roles ORDER BY created_at DESC");
    return $stmt->fetchAll();
}

// Get single role by ID
function getRole($pdo, $roleId) {
    $stmt = $pdo->prepare("SELECT * FROM roles WHERE role_id = ?");
    $stmt->execute([$roleId]);
    return $stmt->fetch();
}

// Update role (UPDATE)
function updateRole($pdo, $roleId, $roleName) {
    $stmt = $pdo->prepare("UPDATE roles SET role_name=? WHERE role_id=?");
    return $stmt->execute([$roleName, $roleId]);
}

// Delete role (DELETE)
function deleteRole($pdo, $roleId) {
    $stmt = $pdo->prepare("DELETE FROM roles WHERE role_id = ?");
    return $stmt->execute([$roleId]);
}
