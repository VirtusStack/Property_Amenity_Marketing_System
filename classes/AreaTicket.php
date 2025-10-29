<?php
// /classes/AreaTicket.php
// -------------------------
// AreaTicket class: handles ticket booking for members and non-members
// Used for areas like Spa, Gym, Banquet Hall, Conference Room, etc.
// -------------------------

class AreaTicket
{
    const PLUGIN_NAME = 'Area Ticket';

    // -------------------------
    // Check if Area Ticket plugin is enabled for a location
    // -------------------------
    public static function isEnabled($pdo, $location_id)
    {
        $stmt = $pdo->prepare("
            SELECT lp.is_enabled
            FROM location_plugins lp
            INNER JOIN plugin_master pm ON lp.plugin_id = pm.plugin_id
            WHERE lp.location_id = ? AND pm.plugin_name = ?
        ");
        $stmt->execute([$location_id, self::PLUGIN_NAME]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row && $row['is_enabled'] == 1;
    }

    // -------------------------
    // Generate unique ticket number (TKT2025-XXXX)
    // -------------------------
    private static function generateTicketNumber($pdo)
    {
        $prefix = 'TKT' . date('Y');
        $stmt = $pdo->query("SELECT COUNT(*) FROM area_tickets");
        $count = (int)$stmt->fetchColumn() + 1;
        return sprintf("%s-%04d", $prefix, $count);
    }

    // -------------------------
    // CREATE: Add new area ticket
    // -------------------------
    public static function add($pdo, $data)
    {
        try {
            $ticket_number = self::generateTicketNumber($pdo);
            $stmt = $pdo->prepare("
                INSERT INTO area_tickets 
                (area_id, member_type, customer_name, customer_mobile, customer_email, ticket_number, price, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $data['area_id'] ?? 0,
                $data['member_type'] ?? 'non_member',
                $data['customer_name'] ?? '',
                $data['customer_mobile'] ?? '',
                $data['customer_email'] ?? '',
                $ticket_number,
                $data['price'] ?? 0.00,
                $data['status'] ?? 'active'
            ]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Add area ticket failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // READ: Get all tickets (Admin or by Location)
    // -------------------------
    public static function getAll($pdo, $location_id = null)
    {
        $sql = "
            SELECT 
                t.*, 
                a.area_name, 
                a.plugin_type AS area_type, 
                l.location_name
            FROM area_tickets t
            LEFT JOIN areas a ON t.area_id = a.area_id
            LEFT JOIN locations l ON a.location_id = l.location_id
        ";

        if ($location_id) {
            $sql .= " WHERE l.location_id = ? ORDER BY t.ticket_id ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$location_id]);
        } else {
            $sql .= " ORDER BY t.ticket_id ASC";
            $stmt = $pdo->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // READ: Get ticket by ID
    // -------------------------
    public static function getById($pdo, $ticket_id)
    {
        $stmt = $pdo->prepare("
            SELECT 
                t.*, 
                a.area_name, 
                a.plugin_type AS area_type, 
                l.location_name
            FROM area_tickets t
            LEFT JOIN areas a ON t.area_id = a.area_id
            LEFT JOIN locations l ON a.location_id = l.location_id
            WHERE t.ticket_id = ?
        ");
        $stmt->execute([$ticket_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // -------------------------
    // UPDATE ticket details
    // -------------------------
    public static function update($pdo, $ticket_id, $data)
    {
        try {
            $stmt = $pdo->prepare("
                UPDATE area_tickets
                SET area_id = ?, member_type = ?, customer_name = ?, customer_mobile = ?, 
                    customer_email = ?, price = ?, status = ?, booking_date = booking_date
                WHERE ticket_id = ?
            ");
            return $stmt->execute([
                $data['area_id'] ?? 0,
                $data['member_type'] ?? 'non_member',
                $data['customer_name'] ?? '',
                $data['customer_mobile'] ?? '',
                $data['customer_email'] ?? '',
                $data['price'] ?? 0.00,
                $data['status'] ?? 'active',
                $ticket_id
            ]);
        } catch (PDOException $e) {
            error_log("Update area ticket failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // DELETE a ticket
    // -------------------------
    public static function delete($pdo, $ticket_id)
    {
        try {
            $stmt = $pdo->prepare("DELETE FROM area_tickets WHERE ticket_id = ?");
            return $stmt->execute([$ticket_id]);
        } catch (PDOException $e) {
            error_log("Delete area ticket failed: " . $e->getMessage());
            return false;
        }
    }

    // -------------------------
    // Check if user already has an active ticket (non-member duplicate prevention)
    // -------------------------
    public static function hasActiveTicket($pdo, $mobile)
    {
        $stmt = $pdo->prepare("
            SELECT COUNT(*) FROM area_tickets 
            WHERE customer_mobile = ? AND status = 'active'
        ");
        $stmt->execute([$mobile]);
        return $stmt->fetchColumn() > 0;
    }

    // -------------------------
    // Get ticket details by ticket number (for download/validation)
    // -------------------------
    public static function getByNumber($pdo, $ticket_number)
    {
        $stmt = $pdo->prepare("
            SELECT 
                t.*, 
                a.area_name, 
                a.plugin_type AS area_type, 
                l.location_name
            FROM area_tickets t
            LEFT JOIN areas a ON t.area_id = a.area_id
            LEFT JOIN locations l ON a.location_id = l.location_id
            WHERE t.ticket_number = ?
        ");
        $stmt->execute([$ticket_number]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
