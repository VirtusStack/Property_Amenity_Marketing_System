<?php
// classes/Company.php
// Handles company CRUD

class Company {

    // Get all companies
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM companies ORDER BY company_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get company by ID
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM companies WHERE company_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add new company
    public static function add($pdo, $company_name, $address = null, $phone = null, $email = null) {
        $stmt = $pdo->prepare("INSERT INTO companies (company_name, address, phone, email, created_at)
                               VALUES (:company_name, :address, :phone, :email, NOW())");
        return $stmt->execute([
            ':company_name' => $company_name,
            ':address'      => $address,
            ':phone'        => $phone,
            ':email'        => $email
        ]);
    }

    // Update company
    public static function update($pdo, $id, $data) {
        $stmt = $pdo->prepare("UPDATE companies 
                               SET company_name = :company_name, address = :address, phone = :phone, email = :email
                               WHERE company_id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete company
    public static function delete($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM companies WHERE company_id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
