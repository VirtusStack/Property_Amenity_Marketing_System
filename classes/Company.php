<?php
// /classes/Company.php
// ---------------------------
// Company class for CRUD
// ---------------------------

class Company {

    // CREATE company
    public static function register($pdo, $company_name, $description = '', $email = '', $phone = '', $website = '') {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO companies (company_name, description, email, phone, website) 
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$company_name, $description, $email, $phone, $website]);
            return $pdo->lastInsertId(); // return new company ID
        } catch (PDOException $e) {
            error_log("Register company failed: " . $e->getMessage());
            return false;
        }
    }

    // READ ALL
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM companies WHERE is_deleted = 0 ORDER BY company_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ BY ID
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM companies WHERE company_id = ? AND is_deleted = 0");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE company safely with defaults
    public static function update($pdo, $id, $data) {
        try {
            // Use null coalescing to provide default values if keys are missing
            $company_name = $data['company_name'] ?? '';
            $description  = $data['description']  ?? '';
            $email        = $data['email']        ?? '';
            $phone        = $data['phone']        ?? '';
            $website      = $data['website']      ?? '';

            $stmt = $pdo->prepare("
                UPDATE companies SET company_name=?, description=?, email=?, phone=?, website=? 
                WHERE company_id=?
            ");
            return $stmt->execute([$company_name, $description, $email, $phone, $website, $id]);
        } catch (PDOException $e) {
            error_log("Update company failed: " . $e->getMessage());
            return false;
        }
    }

    // DELETE (soft delete)
    public static function delete($pdo, $id) {
        try {
            $stmt = $pdo->prepare("UPDATE companies SET is_deleted=1 WHERE company_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete company failed: " . $e->getMessage());
            return false;
        }
    }
}
