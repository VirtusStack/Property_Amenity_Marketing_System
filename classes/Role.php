<?php
// classes/Role.php
class Role {

    // CREATE
    public static function create($pdo, $role_name, $company_id, $permissions = []) {
        $stmt = $pdo->prepare("
            INSERT INTO roles (role_name, can_create, can_read, can_update, can_delete, company_id) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $role_name,
            $permissions['can_create'] ?? 0,
            $permissions['can_read'] ?? 0,
            $permissions['can_update'] ?? 0,
            $permissions['can_delete'] ?? 0,
            $company_id
        ]);
    }

    // READ ALL
    public static function getAll($pdo, $company_id = null) {
        if ($company_id) {
            $stmt = $pdo->prepare("SELECT * FROM roles WHERE company_id = ? ORDER BY created_at DESC");
            $stmt->execute([$company_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = $pdo->query("SELECT * FROM roles ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // READ ONE
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM roles WHERE role_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public static function update($pdo, $id, $role_name, $permissions = []) {
        $stmt = $pdo->prepare("
            UPDATE roles 
            SET role_name=?, can_create=?, can_read=?, can_update=?, can_delete=? 
            WHERE role_id=?
        ");
        return $stmt->execute([
            $role_name,
            $permissions['can_create'] ?? 0,
            $permissions['can_read'] ?? 0,
            $permissions['can_update'] ?? 0,
            $permissions['can_delete'] ?? 0,
            $id
        ]);
    }

    // DELETE
    public static function delete($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM roles WHERE role_id = ?");
        return $stmt->execute([$id]);
    }
}
