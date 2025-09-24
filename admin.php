<?php
// admin.php → Central Admin Controller
// ---------------------------
// Handles Dashboard, Users, Login/Logout
// ---------------------------

// 1. Load config and required classes
require("config/config.php");
require_once __DIR__ . "/classes/User.php";
require_once __DIR__ . "/classes/Company.php";
require_once __DIR__ . "/classes/Location.php";

session_start(); // Start PHP session

// 2. Get action from URL
$action = $_GET['action'] ?? "";

// 3. Force login if not logged in
if (!isset($_SESSION['user_id']) && $action !== "login") {
    $action = "login";
}

// 4. Routing
switch ($action) {

    case 'login':
        login();
        break;

    case 'logout':
        logout();
        break;

    case 'dashboard':
    default:
        dashboard();
        break;

    case 'newUser':
        newUser();
        break;

    case 'manageUsers':
        manageUsers();
        break;

    case 'editUser':
        editUser();
        break;
}

// -------------------------
// FUNCTIONS
// -------------------------

function login() {
    global $pdo;
    $results = [
        'errorMessage' => '',
        'pageTitle' => 'Login'
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email    = trim($_POST['email']);
        $password = $_POST['password'];

        $user = User::authenticate($pdo, $email, $password);

        if ($user) {
            $_SESSION['user_id']     = $user['user_id'];
            $_SESSION['company_id']  = $user['company_id'];
            $_SESSION['role_id']     = $user['role_id'];
            $_SESSION['location_id'] = $user['location_id'] ?? null;
            $_SESSION['user_name']   = $user['name'];
            $_SESSION['login_time']  = time();

            ini_set('session.cookie_lifetime', 86400);
            ini_set('session.gc_maxlifetime', 86400);

            header("Location: admin.php?action=dashboard");
            exit;
        } else {
            $results['errorMessage'] = "❌ Invalid email or password!";
        }
    }

    require(TEMPLATE_PATH . "/common/login_form.php");
}

function logout() {
    session_destroy();
    header("Location: admin.php?action=login");
    exit;
}

function dashboard() {
    $results = [
        'pageTitle' => 'Dashboard',
        'userName' => $_SESSION['user_name'] ?? 'Unknown'
    ];
    require(TEMPLATE_PATH . "/common/index.php");
}

function newUser() {
    global $pdo;
    $results = [
        'message' => '',
        'pageTitle' => 'Add New User'
    ];

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
    $roles     = []; // TODO: add Role::getAll($pdo)
    $locations = Location::getAll($pdo);

    require(TEMPLATE_PATH . "/users/add_user.php");
}

function manageUsers() {
    global $pdo;
    $results = [
        'message' => '',
        'pageTitle' => 'Manage Users'
    ];

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
    $results = [
        'message' => '',
        'pageTitle' => 'Edit User'
    ];

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
    $roles     = []; // TODO: add Role::getAll($pdo)
    $locations = Location::getAll($pdo);

    // pass $user so edit_user.php won't throw undefined error
    $results['user'] = $user;

    require(TEMPLATE_PATH . "/users/edit_user.php");
}
