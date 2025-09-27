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
            $results['message'] = "✅ User added successfully!";
        } else {
            $results['message'] = "❌ Error adding user!";
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
            $results['message'] = "✅ User deleted!";
        } else {
            $results['message'] = "❌ Error deleting user!";
        }
    }

    $results['users'] = User::getAll($pdo);
    require(TEMPLATE_PATH . "/users/manage_user.php");
}

function editUser() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Edit User'];

    if (!isset($_GET['id'])) die("❌ No user ID given.");
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
            $results['message'] = "✅ User updated!";
            $user = User::getById($pdo, $userId);
        } else {
            $results['message'] = "❌ Error updating user!";
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

        // ✅ Collect location fields safely
        $location_name = trim($_POST['location_name'] ?? '');
        $address       = trim($_POST['address']       ?? '');
        $loc_phone     = trim($_POST['loc_phone']     ?? '');
        $manager_name  = trim($_POST['manager_name']  ?? '');

        if (empty($company_name)) {
            $results['message'] = "❌ Company name is required!";
        } else {
            // First insert company
            $companyId = Company::register($pdo, $company_name, $description, $email, $phone, $website);
            if ($companyId) {
                // Then insert location (only if provided)
                if (!empty($location_name)) {
                    Location::register($pdo, $companyId, $location_name, $address, $loc_phone, $manager_name);
                }
                $results['message'] = "✅ Company and location added successfully!";
                // Clear fields
                $company_name = $description = $email = $phone = $website = $location_name = $address = $loc_phone = $manager_name = '';
            } else {
                $results['message'] = "❌ Error adding company!";
            }
        }
    }

    require(TEMPLATE_PATH . "/companies/add_company.php");
}

function manageCompanies() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Manage Companies'];

    // Handle delete request
    if (isset($_GET['delete'])) {
        $companyId = (int)$_GET['delete'];
        if (Company::delete($pdo, $companyId)) {
            $results['message'] = "✅ Company deleted!";
        } else {
            $results['message'] = "❌ Error deleting company!";
        }
    }

    // ✅ Fetch companies with first location using LEFT JOIN
    $stmt = $pdo->query("
        SELECT 
            c.company_id, c.company_name, c.description, c.email, c.phone, c.website,
            c.created_at,
            l.location_name, l.address
        FROM companies c
        LEFT JOIN locations l 
            ON c.company_id = l.company_id AND l.is_deleted = 0
        WHERE c.is_deleted = 0
        ORDER BY c.company_id DESC
    ");
    $results['companies'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require(TEMPLATE_PATH . "/companies/manage_company.php");
}


function editCompany() {
    global $pdo;
    $results = ['message' => '', 'pageTitle' => 'Edit Company'];

    // Ensure we have a company ID to edit
    if (!isset($_GET['id'])) die("❌ No company ID given.");
    $companyId = (int)$_GET['id'];

    // Fetch company and first location (if any)
    $company  = Company::getById($pdo, $companyId);
    $location = Location::getByCompany($pdo, $companyId)[0] ?? null;

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
            $results['message'] = "✅ Company updated!";
        } else {
            $results['message'] = "❌ Error updating company!";
        }

        // --- Collect location data safely ---
        $locationData = [
            'location_name' => trim($_POST['location_name'] ?? ''),
            'address'       => trim($_POST['address'] ?? ''),
            'phone'         => trim($_POST['loc_phone'] ?? ''),
            'manager_name'  => trim($_POST['manager_name'] ?? ''),
        ];

        // Update existing location or create new if none exists
        if ($location) {
            Location::update($pdo, $location['location_id'], $locationData);
        } elseif (!empty($locationData['location_name'])) {
            Location::register(
                $pdo,
                $companyId,
                $locationData['location_name'],
                $locationData['address'],
                $locationData['phone'],
                $locationData['manager_name']
            );
        }

        // Reload updated company and location for pre-fill
        $company  = Company::getById($pdo, $companyId);
        $location = Location::getByCompany($pdo, $companyId)[0] ?? null;
    }

    // Pass data to the template
    $results['company']  = $company;
    $results['location'] = $location;

    require(TEMPLATE_PATH . "/companies/edit_company.php");
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
            $results['message'] = "✅ Role added successfully!";
        } else {
            $results['message'] = "❌ Error adding role!";
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
            $results['message'] = "✅ Role deleted!";
        } else {
            $results['message'] = "❌ Error deleting role!";
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
                $results['message'] = "✅ Role updated successfully!";
                $role = Role::getById($pdo, $roleId); // refresh data
            } else {
                $results['message'] = "❌ Error updating role!";
            }
        }
    }

    $results['role']      = $role;
    $results['companies'] = Company::getAll($pdo);

    require(TEMPLATE_PATH . "/roles/edit_role.php");
}
