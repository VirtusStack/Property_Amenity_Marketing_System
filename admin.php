<?php
// admin.php → Central Admin Controller
// ---------------------------
// Handles Dashboard, Users, Login/Logout
// ---------------------------

// 1. Load config and required classes
require("config/config.php");
require_once __DIR__ . "/classes/User.php";
require_once __DIR__ . "/classes/Role.php";
require_once __DIR__ . "/classes/Company.php";
require_once __DIR__ . "/classes/Location.php";
require_once __DIR__ . "/classes/Room.php";

session_start(); // Start PHP session
 
//  Auto-login using Remember Me cookie

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    $user_id = $_COOKIE['remember_user'];
    $user = User::getById($pdo, $user_id);
    if ($user) {
        $_SESSION['user_id']     = $user['user_id'];
        $_SESSION['company_id']  = $user['company_id'];
        $_SESSION['role_id']     = $user['role_id'];
        $_SESSION['location_id'] = $user['location_id'] ?? null;
        $_SESSION['user_name']   = $user['name'];
        $_SESSION['login_time']  = time();
    }
}

// 2. Get action from URL
$action = $_GET['action'] ?? "";

// 3. Force login if not logged in
if (!isset($_SESSION['user_id']) && $action !== "login") {
    $action = "login";
}

// 4. Routing
switch ($action) {


   // Authentication
    case 'login':
        login();
        break;

    case 'logout':
        logout();
        break;

 // Dashboard
    case 'dashboard':
    default:
        dashboard();
        break;

// User management
    case 'newUser':
        newUser();
        break;

    case 'manageUsers':
        manageUsers();
        break;

    case 'editUser':
        editUser();
        break;

 // Company management
    case 'newCompany':
        newCompany();
        break;

    case 'manageCompanies':
        manageCompanies();
        break;

    case 'editCompany':
        editCompany();
        break;

// Location management
case 'newLocation':
    newLocation();
    break;

case 'manageLocations':
    manageLocations();
    break;

case 'editLocation':
    editLocation();
    break;

// Room management
case 'newRoom':
    newRoom();
    break;

case 'manageRooms':
    manageRooms();
    break;

case 'editRoom':
    editRoom();
    break;


// Role management
    case 'newRole':
    newRole(); 
    break;

    case 'manageRoles':
    manageRoles();
    break;

    case 'editRole':
    editRole(); 
    break;
}

// FUNCTIONS

// LOGIN & LOGOUT

function login() {
    global $pdo;
    $results = ['errorMessage' => '', 'pageTitle' => 'Login'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email    = trim($_POST['email']);
        $password = $_POST['password'];

        $user = User::authenticate($pdo, $email, $password);

        if ($user) {
            // Set session
            $_SESSION['user_id']     = $user['user_id'];
            $_SESSION['company_id']  = $user['company_id'];
            $_SESSION['role_id']     = $user['role_id'];
            $_SESSION['location_id'] = $user['location_id'] ?? null;
            $_SESSION['user_name']   = $user['name'];
            $_SESSION['login_time']  = time();

            // Set Remember Me cookie
            if (!empty($_POST['remember_me'])) {
                setcookie('remember_user', $user['user_id'], time() + 86400, "/", "", false, true);
            }

            header("Location: admin.php?action=dashboard");
            exit;
        } else {
            $results['errorMessage'] = "❌ Invalid email or password!";
        }
    }

    require(TEMPLATE_PATH . "/common/login_form.php");
}

function logout() {
    if (isset($_COOKIE['remember_user'])) {
        setcookie('remember_user', '', time() - 3600, '/');
    }
    session_destroy();
    header("Location: admin.php?action=login");
    exit;
}

// -------------------------
// DASHBOARD
// -------------------------
function dashboard() {
    $results = [
        'pageTitle' => 'Dashboard',
        'userName'  => $_SESSION['user_name'] ?? 'Unknown'
    ];
    require(TEMPLATE_PATH . "/common/index.php");
}

// -------------------------
// USER MANAGEMENT
// -------------------------
function newUser() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Add New User'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name        = trim($_POST['name']);
        $email       = trim($_POST['email']);
        $password    = $_POST['password'];
        $role_id     = $_POST['role_id'];
        $company_id  = $_POST['company_id'];
        $location_id = $_POST['location_id'] ?? null;

        if (User::register($pdo, $name, $email, $password, $role_id, $company_id, $location_id)) {
            $results['message'] = " User added successfully!";
        } else {
            $results['message'] = " Error adding user!";
        }
    }

    $companies = Company::getAll($pdo);
    $roles     = Role::getAll($pdo);
    $locations = Location::getAll($pdo);

    require(TEMPLATE_PATH . "/users/add_user.php");
}

function manageUsers() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Manage Users'];

    if (isset($_GET['delete'])) {
        $userId = (int)$_GET['delete'];
        if (User::delete($pdo, $userId)) {
            $results['message'] = " User deleted!";
        } else {
            $results['message'] = " Error deleting user!";
        }
    }

    $results['users'] = User::getAll($pdo);
    require(TEMPLATE_PATH . "/users/manage_user.php");
}

function editUser() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Edit User'];

    if (!isset($_GET['id'])) die(" No user ID given.");
    $userId = (int)$_GET['id'];
    $user   = User::getById($pdo, $userId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name'       => trim($_POST['name']),
            'email'      => trim($_POST['email']),
            'password'   => !empty($_POST['password']) ? $_POST['password'] : $user['password'],
            'role_id'    => $_POST['role_id'],
            'company_id' => $_POST['company_id'],
            'location_id'=> $_POST['location_id'] ?? null
        ];

        if (User::update($pdo, $userId, $data)) {
            $results['message'] = " User updated!";
            $user = User::getById($pdo, $userId);
        } else {
            $results['message'] = " Error updating user!";
        }
    }

    $companies = Company::getAll($pdo);
    $roles     = Role::getAll($pdo);
    $locations = Location::getAll($pdo);

    $results['user'] = $user;
    require(TEMPLATE_PATH . "/users/edit_user.php");
}

// -------------------------
// COMPANY MANAGEMENT
// -------------------------
function newCompany() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Add New Company'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ✅ Collect company fields safely
        $company_name  = trim($_POST['company_name']  ?? '');
        $description   = trim($_POST['description']   ?? '');
        $email         = trim($_POST['email']         ?? '');
        $phone         = trim($_POST['phone']         ?? '');
        $website       = trim($_POST['website']       ?? '');

        if (empty($company_name)) {
            $results['message'] = " Company name is required!";
        } else {
            // Insert company 
            $companyId = Company::register($pdo, $company_name, $description, $email, $phone, $website);
            if ($companyId) {
                $results['message'] = " Company added successfully !";
                // Clear fields
                $company_name = $description = $email = $phone = $website = '';
            } else {
                $results['message'] = " Error adding company!";
            }
        }
    }

    require(TEMPLATE_PATH . "/companies/add_company.php");
}

function manageCompanies() {
    global $pdo;
    $results = [
        'message'   => '',
        'pageTitle' => 'Manage Companies',
        'companies' => []
    ];

    // Handle delete request
    if (isset($_GET['delete'])) {
        $companyId = (int)$_GET['delete'];
        if (Company::delete($pdo, $companyId)) {
            $results['message'] = " Company deleted!";
        } else {
            $results['message'] = " Error deleting company!";
        }
    }

    // --- Pagination Settings ---
    $perPage = 25; // companies per page
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $offset = ($page - 1) * $perPage;

    // Fetch total number of companies
    $stmtTotal = $pdo->query("SELECT COUNT(*) FROM companies WHERE is_deleted = 0");
    $total = (int)$stmtTotal->fetchColumn();
    $totalPages = ceil($total / $perPage);

    // Fetch companies for current page, **oldest first** (ID 1–10 on page 1)
    $stmt = $pdo->prepare("
        SELECT company_id, company_name, description, email, phone, website, created_at
        FROM companies
        WHERE is_deleted = 0
        ORDER BY company_id ASC    -- ASC ensures 1–10 on first page
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results['companies'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Pass pagination info to template
    $results['currentPage'] = $page;
    $results['totalPages']  = $totalPages;

    require(TEMPLATE_PATH . "/companies/manage_company.php");
}

function editCompany() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Edit Company'];

    if (!isset($_GET['id'])) die(" No company ID given.");
    $companyId = (int)$_GET['id'];

    // Fetch company
    $company = Company::getById($pdo, $companyId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // --- Collect company data safely ---
        $companyData = [
            'company_name' => trim($_POST['company_name'] ?? ''),
            'description'  => trim($_POST['description'] ?? ''),
            'email'        => trim($_POST['email'] ?? ''),
            'phone'        => trim($_POST['phone'] ?? ''),
            'website'      => trim($_POST['website'] ?? ''),
        ];

        // Update company
        if (Company::update($pdo, $companyId, $companyData)) {
            $results['message'] = " Company updated successfully!";
        } else {
            $results['message'] = " Error updating company!";
        }

        // Reload updated company for pre-fill
        $company = Company::getById($pdo, $companyId);
    }

    $results['company'] = $company;

    require(TEMPLATE_PATH . "/companies/edit_company.php");
}

// -------------------------
// LOCATION MANAGEMENT
// -------------------------
function newLocation() {
    global $pdo;

    $results = [
        'message' => '',
        'pageTitle' => 'Add New Location',
        'companies' => [],   // This will hold companies for dropdown
    ];

    // Fetch all companies (not deleted) for the dropdown
    $results['companies'] = Company::getAll($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect POST data
        $company_id       = $_POST['company_id'] ?? '';
        $location_name    = trim($_POST['location_name'] ?? '');
        $place            = trim($_POST['place'] ?? '');
        $country          = trim($_POST['country'] ?? '');
        $state            = trim($_POST['state'] ?? '');
        $city             = trim($_POST['city'] ?? '');
        $contact_number   = trim($_POST['contact_number'] ?? '');
        $manager          = trim($_POST['manager'] ?? '');
        $created_by       = $_SESSION['user_id'] ?? null;

        // Validation
        if (empty($company_id) || empty($location_name)) {
            $results['message'] = " Please select company and enter location name!";
        } else {
            if (Location::register($pdo, $company_id, $location_name, $place, $country, $state, $city, $contact_number, $manager, $created_by)) {
                $results['message'] = " Location added successfully!";
                // Clear form values
                foreach(['company_id','location_name','place','country','state','city','contact_number','manager'] as $f) {
                    $results[$f] = '';
                }
            } else {
                $results['message'] = " Error adding location!";
            }
        }
    }

    require(TEMPLATE_PATH . "/locations/add_location.php");
}

// -------------------------
// MANAGE LOCATIONS
// -------------------------
function manageLocations() {
    global $pdo;

    $results = [
        'message'   => '',
        'pageTitle' => 'Manage Locations',
        'locations' => []
    ];

    // Handle delete request
    if (isset($_GET['delete'])) {
        $locationId = (int)$_GET['delete'];
        if (Location::delete($pdo, $locationId)) {
            $results['message'] = " Location deleted!";
        } else {
            $results['message'] = " Error deleting location!";
        }
    }

    // --- Pagination Settings ---
    $perPage = 25; // locations per page
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $offset = ($page - 1) * $perPage;

    // Fetch total number of locations (only non-deleted)
    $stmtTotal = $pdo->query("SELECT COUNT(*) FROM locations WHERE is_deleted = 0");
    $total = (int)$stmtTotal->fetchColumn();
    $totalPages = ceil($total / $perPage);

    // Fetch locations for current page with company info
    $stmt = $pdo->prepare("
        SELECT l.location_id, l.location_name, l.place, l.country, l.state, l.city, l.contact_number, l.manager, l.created_at AS location_created_at,
               c.company_id, c.company_name
        FROM locations l
        LEFT JOIN companies c ON l.company_id = c.company_id
        WHERE l.is_deleted = 0
        ORDER BY l.location_id ASC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results['locations'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Pass pagination info to template
    $results['currentPage'] = $page;
    $results['totalPages']  = $totalPages;
    $results['total']       = $total;
    $results['perPage']     = $perPage;

    require(TEMPLATE_PATH . "/locations/manage_location.php");
}

function editLocation() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Edit Location'];

    if (!isset($_GET['id'])) die(" No location ID given.");
    $locationId = (int)$_GET['id'];

    // Get location
    $location = Location::getById($pdo, $locationId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $locationData = [
            'location_name'  => trim($_POST['location_name'] ?? ''),
            'place'          => trim($_POST['place'] ?? ''),
            'country'        => trim($_POST['country'] ?? ''),
            'state'          => trim($_POST['state'] ?? ''),
            'city'           => trim($_POST['city'] ?? ''),
            'contact_number' => trim($_POST['contact_number'] ?? ''),
            'manager'        => trim($_POST['manager'] ?? ''),
        ];

        if (Location::update($pdo, $locationId, $locationData)) {
            $results['message'] = " Location updated successfully!";
            $location = Location::getById($pdo, $locationId); // refresh
        } else {
            $results['message'] = " Error updating location!";
        }
    }

    $results['location']  = $location;
    $results['companies'] = Company::getAll($pdo);

    require(TEMPLATE_PATH . "/locations/edit_location.php");
}

// -------------------------
// ROOM MANAGEMENT
// -------------------------

// ADD NEW ROOM
function newRoom() {
    global $pdo;

    $results = [
        'message' => '',
        'pageTitle' => 'Add New Room',
        'locations' => Location::getAll($pdo),    // Locations include company info
        'facilities' => Room::getAllFacilities($pdo)
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect POST data
        $data = [
            'location_id'         => $_POST['location_id'] ?? null,
            'room_name'           => trim($_POST['room_name'] ?? ''),
            'room_type'           => trim($_POST['room_type'] ?? ''),
            'room_view'           => trim($_POST['room_view'] ?? ''),
            'description'         => trim($_POST['description'] ?? ''),
            'base_price_per_night'=> floatval($_POST['base_price_per_night'] ?? 0),
            'gst_percent'         => floatval($_POST['gst_percent'] ?? 0),
            'total_inventory'     => intval($_POST['total_inventory'] ?? 0),
            'notes'               => trim($_POST['notes'] ?? ''),
            'terms_conditions'    => trim($_POST['terms_conditions'] ?? ''),
            'status'              => $_POST['status'] ?? 'active',
            'created_by'          => $_SESSION['user_id'] ?? null,
            'max_occupancy'       => intval($_POST['max_occupancy'] ?? 1)
        ];

        // Basic validation
        if (empty($data['location_id']) || empty($data['room_name']) || $data['base_price_per_night'] <= 0 || $data['total_inventory'] <= 0) {
            $results['message'] = "Please fill all required fields with valid values!";
            $results = array_merge($results, $_POST);
        } else {
            try {
                $pdo->beginTransaction();

                // Insert room
                $stmt = $pdo->prepare("
                    INSERT INTO rooms 
                    (location_id, room_name, room_type, room_view, description, base_price_per_night, gst_percent, total_inventory, notes, terms_conditions, status, created_by, max_occupancy) 
                    VALUES 
                    (:location_id, :room_name, :room_type, :room_view, :description, :base_price_per_night, :gst_percent, :total_inventory, :notes, :terms_conditions, :status, :created_by, :max_occupancy)
                ");
                $stmt->execute($data);
                $room_id = $pdo->lastInsertId();

                // Map facilities
                if (!empty($_POST['facilities'])) {
                    $stmtFacility = $pdo->prepare("INSERT INTO room_facilities (room_id, facility_id) VALUES (:room_id, :facility_id)");
                    foreach ($_POST['facilities'] as $facility_id) {
                        $stmtFacility->execute([
                            ':room_id' => $room_id,
                            ':facility_id' => $facility_id
                        ]);
                    }
                }

                $pdo->commit();
                $results['message'] = "Room added successfully!";
                foreach(['location_id','room_name','room_type','room_view','description','base_price_per_night','gst_percent','total_inventory','notes','terms_conditions','status','max_occupancy'] as $f) {
                    $results[$f] = '';
                }

            } catch (PDOException $e) {
                $pdo->rollBack();
                $results['message'] = "Error adding room: " . $e->getMessage();
                $results = array_merge($results, $_POST);
            }
        }
    }

    require(TEMPLATE_PATH . "/rooms/add_room.php");
}

// MANAGE ROOMS
function manageRooms() {
    global $pdo;

    $results = [
        'message'   => '',
        'pageTitle' => 'Manage Rooms',
        'rooms'     => []
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        $roomId = (int)$_POST['delete'];
        if (Room::delete($pdo, $roomId)) {
            $results['message'] = "Room deleted successfully!";
        } else {
            $results['message'] = "Error deleting room!";
        }
    }

    // Pagination
    $perPage = 25;
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $offset = ($page - 1) * $perPage;

    // Fetch rooms with location & company info
    $stmt = $pdo->prepare("
        SELECT r.*, l.location_name, c.company_name
        FROM rooms r
        LEFT JOIN locations l ON r.location_id = l.location_id
        LEFT JOIN companies c ON l.company_id = c.company_id
        ORDER BY r.room_id ASC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rooms as &$room) {
        $gst = $room['gst_percent'] ?? 0;
        $room['final_price'] = $room['base_price_per_night'] * (1 + $gst / 100);
    }
    unset($room);

    $results['rooms']       = $rooms;
    $results['currentPage'] = $page;
    $results['totalPages']  = ceil((int)$pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn() / $perPage);
    $results['total']       = (int)$pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn();
    $results['perPage']     = $perPage;

    require(TEMPLATE_PATH . "/rooms/manage_room.php");
}

// EDIT ROOM
function editRoom() {
    global $pdo;

    $results = [
        'message' => '',
        'pageTitle' => 'Edit Room',
        'locations' => Location::getAll($pdo),   // Locations include company info
        'facilities' => Room::getAllFacilities($pdo)
    ];

    if (!isset($_GET['id'])) die("No room ID given.");
    $roomId = (int)$_GET['id'];

    // Load room data
    $roomStmt = $pdo->prepare("SELECT * FROM rooms WHERE room_id = :room_id");
    $roomStmt->execute([':room_id' => $roomId]);
    $room = $roomStmt->fetch(PDO::FETCH_ASSOC);
    if (!$room) die("Room not found.");

    $results['room'] = $room;

    // Load selected facilities
    $facStmt = $pdo->prepare("SELECT facility_id FROM room_facilities WHERE room_id = :room_id");
    $facStmt->execute([':room_id' => $roomId]);
    $results['room']['facilities'] = $facStmt->fetchAll(PDO::FETCH_COLUMN);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'location_id'         => $_POST['location_id'] ?? null,
            'room_name'           => trim($_POST['room_name'] ?? ''),
            'room_type'           => trim($_POST['room_type'] ?? ''),
            'room_view'           => trim($_POST['room_view'] ?? ''),
            'description'         => trim($_POST['description'] ?? ''),
            'base_price_per_night'=> floatval($_POST['base_price_per_night'] ?? 0),
            'gst_percent'         => floatval($_POST['gst_percent'] ?? 0),
            'total_inventory'     => intval($_POST['total_inventory'] ?? 0),
            'notes'               => trim($_POST['notes'] ?? ''),
            'terms_conditions'    => trim($_POST['terms_conditions'] ?? ''),
            'status'              => $_POST['status'] ?? 'active',
            'max_occupancy'       => intval($_POST['max_occupancy'] ?? 1)
        ];

        if (empty($data['location_id']) || empty($data['room_name']) || $data['base_price_per_night'] <= 0 || $data['total_inventory'] <= 0) {
            $results['message'] = "Please fill all required fields with valid values!";
            $results['room'] = array_merge($results['room'], $_POST);
        } else {
            try {
                $pdo->beginTransaction();

                // Update room
                $stmt = $pdo->prepare("
                    UPDATE rooms SET
                        location_id = :location_id,
                        room_name = :room_name,
                        room_type = :room_type,
                        room_view = :room_view,
                        description = :description,
                        base_price_per_night = :base_price_per_night,
                        gst_percent = :gst_percent,
                        total_inventory = :total_inventory,
                        notes = :notes,
                        terms_conditions = :terms_conditions,
                        status = :status,
                        max_occupancy = :max_occupancy
                    WHERE room_id = :room_id
                ");
                $stmt->execute(array_merge($data, [':room_id' => $roomId]));

                // Update facilities
                $pdo->prepare("DELETE FROM room_facilities WHERE room_id = :room_id")->execute([':room_id' => $roomId]);
                if (!empty($_POST['facilities'])) {
                    $stmtFacility = $pdo->prepare("INSERT INTO room_facilities (room_id, facility_id) VALUES (:room_id, :facility_id)");
                    foreach ($_POST['facilities'] as $facility_id) {
                        $stmtFacility->execute([
                            ':room_id' => $roomId,
                            ':facility_id' => $facility_id
                        ]);
                    }
                }

                $pdo->commit();
                $results['message'] = "Room updated successfully!";

                // Refresh room data
                $roomStmt->execute([':room_id' => $roomId]);
                $results['room'] = $roomStmt->fetch(PDO::FETCH_ASSOC);
                $facStmt->execute([':room_id' => $roomId]);
                $results['room']['facilities'] = $facStmt->fetchAll(PDO::FETCH_COLUMN);

            } catch (PDOException $e) {
                $pdo->rollBack();
                $results['message'] = "Error updating room: " . $e->getMessage();
                $results['room'] = array_merge($results['room'], $_POST);
            }
        }
    }

    require(TEMPLATE_PATH . "/rooms/edit_room.php");
}

// -------------------------
// ROLE MANAGEMENT
// -------------------------
function newRole() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Add New Role'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $role_name  = trim($_POST['role_name']);
        $company_id = $_POST['company_id'];
        $permissions = [
            'can_create' => isset($_POST['can_create']) ? 1 : 0,
            'can_read'   => isset($_POST['can_read']) ? 1 : 0,
            'can_update' => isset($_POST['can_update']) ? 1 : 0,
            'can_delete' => isset($_POST['can_delete']) ? 1 : 0,
        ];

        if (Role::create($pdo, $role_name, $company_id, $permissions)) {
            $results['message'] = " Role added successfully!";
        } else {
            $results['message'] = " Error adding role!";
        }
    }

    $companies = Company::getAll($pdo);
    require(TEMPLATE_PATH . "/roles/add_role.php");
}

function manageRoles() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Manage Roles'];

    if (isset($_GET['delete'])) {
        $roleId = (int)$_GET['delete'];
        if (Role::delete($pdo, $roleId)) {
            $results['message'] = " Role deleted!";
        } else {
            $results['message'] = " Error deleting role!";
        }
    }

    $results['roles'] = Role::getAll($pdo);
    require(TEMPLATE_PATH . "/roles/manage_roles.php");
}

function editRole() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Edit Role'];

    if (!isset($_GET['id'])) die("❌ No role ID given.");
    $roleId = (int)$_GET['id'];
    $role   = Role::getById($pdo, $roleId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Make sure role_name is string
        $roleName = trim($_POST['role_name'] ?? '');

        // Build permissions array
        $permissions = [
            'can_create' => isset($_POST['can_create']) ? 1 : 0,
            'can_read'   => isset($_POST['can_read']) ? 1 : 0,
            'can_update' => isset($_POST['can_update']) ? 1 : 0,
            'can_delete' => isset($_POST['can_delete']) ? 1 : 0,
        ];

        // Company ID
        $companyId = $_POST['company_id'] ?? null;

        if ($roleName === '') {
            $results['message'] = "❌ Role name is required!";
        } else {
            if (Role::update($pdo, $roleId, $roleName, $permissions)) {
                $results['message'] = " Role updated successfully!";
                $role = Role::getById($pdo, $roleId); // refresh data
            } else {
                $results['message'] = " Error updating role!";
            }
        }
    }

    $results['role']      = $role;
    $results['companies'] = Company::getAll($pdo);

    require(TEMPLATE_PATH . "/roles/edit_role.php");
}
