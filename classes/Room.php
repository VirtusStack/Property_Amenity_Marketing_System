<?php
// /classes/Room.php
// Room class for CRUD + Facilities

class Room {

    // CREATE room
    public static function register($pdo, $data) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO rooms (
                    location_id, room_name, room_type, description, room_view,
                    total_inventory, base_price_per_night, gst_percent, notes, terms_conditions, status, created_by
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $data['location_id'] ?? null,
                $data['room_name'] ?? '',
                $data['room_type'] ?? '',
                $data['description'] ?? '',
                $data['room_view'] ?? '',
                $data['total_inventory'] ?? 0,
                $data['base_price_per_night'] ?? 0.00,
                $data['gst_percent'] ?? 0.00,
                $data['notes'] ?? '',
                $data['terms_conditions'] ?? '',
                $data['status'] ?? 'active',
                $data['created_by'] ?? null
            ]);

            // Return the new room ID as integer
            return (int)$pdo->lastInsertId();

        } catch (PDOException $e) {
            error_log("Register room failed: " . $e->getMessage());
            return false;
        }
    }

    // READ ALL rooms
    public static function getAll($pdo) {
        try {
            $sql = "SELECT r.*, l.location_name, c.company_name
                    FROM rooms r
                    JOIN locations l ON r.location_id = l.location_id
                    JOIN companies c ON l.company_id = c.company_id
                    ORDER BY r.room_id DESC";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get all rooms failed: " . $e->getMessage());
            return [];
        }
    }

    // READ room by ID
    public static function getById($pdo, $id) {
        try {
            $sql = "SELECT r.*, l.location_name, c.company_name
                    FROM rooms r
                    JOIN locations l ON r.location_id = l.location_id
                    JOIN companies c ON l.company_id = c.company_id
                    WHERE r.room_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get room by ID failed: " . $e->getMessage());
            return false;
        }
    }

    // UPDATE room
    public static function update($pdo, $id, $data) {
        try {
            $stmt = $pdo->prepare("
                UPDATE rooms 
                SET location_id=?, room_name=?, room_type=?, description=?, room_view=?,
                    total_inventory=?, base_price_per_night=?, gst_percent=?, 
                    notes=?, terms_conditions=?, status=?, updated_at=NOW()
                WHERE room_id=?
            ");
            return $stmt->execute([
                $data['location_id'] ?? null,
                $data['room_name'] ?? '',
                $data['room_type'] ?? '',
                $data['description'] ?? '',
                $data['room_view'] ?? '',
                $data['total_inventory'] ?? 0,
                $data['base_price_per_night'] ?? 0.00,
                $data['gst_percent'] ?? 0.00,
                $data['notes'] ?? '',
                $data['terms_conditions'] ?? '',
                $data['status'] ?? 'active',
                $id
            ]);
        } catch (PDOException $e) {
            error_log("Update room failed: " . $e->getMessage());
            return false;
        }
    }

    // DELETE room
    public static function delete($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM rooms WHERE room_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete room failed: " . $e->getMessage());
            return false;
        }
    }

    // GET Facilities for a Room
    public static function getFacilities($pdo, $room_id) {
        try {
            $sql = "SELECT f.name AS facility_name, f.icon
                    FROM room_facilities rf
                    JOIN facilities f ON rf.facility_id = f.facility_id
                    WHERE rf.room_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$room_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get room facilities failed: " . $e->getMessage());
            return [];
        }
    }

    // GET ALL Facilities (for form checkboxes)
    public static function getAllFacilities($pdo) {
        try {
            $stmt = $pdo->query("SELECT facility_id, name, icon FROM facilities ORDER BY name ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get all facilities failed: " . $e->getMessage());
            return [];
        }
    }

    // MAP facilities to a room (used after creating room)
    public static function mapFacilities($pdo, $room_id, $facility_ids = []) {
        try {
            // Clear existing mapping first
            $stmt = $pdo->prepare("DELETE FROM room_facilities WHERE room_id = ?");
            $stmt->execute([$room_id]);

            // Insert new mappings
            $stmt = $pdo->prepare("INSERT INTO room_facilities (room_id, facility_id) VALUES (?, ?)");
            foreach ($facility_ids as $fid) {
                $stmt->execute([$room_id, $fid]);
            }
            return true;
        } catch (PDOException $e) {
            error_log("Map facilities failed: " . $e->getMessage());
            return false;
        }
    }

}
