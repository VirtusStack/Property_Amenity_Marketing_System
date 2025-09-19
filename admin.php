<?php
// admin.php

// Central admin controller  
// Handles Add, Manage, and Edit User actions
require("config/config.php");
require_once __DIR__ . "/classes/User.php";
session_start();

// Get action from URL, default is dashboard
$action   = isset($_GET['action']) ? $_GET['action'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

// Action routing

switch ($action) {
    case 'newUser':
        newUser();
        break;
    case 'manageUsers':
        manageUsers();
        break;
    case 'editUser':
        editUser();
        break;
    default:
        dashboard();
}


// Function: Add new user

function newUser() {
    global $pdo;

    $results = ['pageTitle' => "Add User", 'message' => ""];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name     = trim($_POST['name']);
        $email    = trim($_POST['email']);
        $password = $_POST['password'];
        $role_id  = $_POST['role_id'];

        if (User::register($pdo, $name, $email, $password, $role_id)) {
            $results['message'] = "✅ User added successfully!";
        } else {
            $results['message'] = "❌ Error adding user!";
        }
    }

    require(TEMPLATE_PATH . "/users/add_user.php");
}


// Function: Manage users

function manageUsers() {
    global $pdo;

    $results = ['pageTitle' => "Manage Users", 'message' => ""];

    // Delete user if requested
    if (isset($_GET['delete'])) {
        if (User::delete($pdo, (int) $_GET['delete'])) {
            $results['message'] = "✅ User deleted successfully!";
        } else {
            $results['message'] = "❌ Error deleting user!";
        }
    }

    // Fetch all users from database
    $results['users'] = User::getAll($pdo);

    // Ensure $results['users'] is always an array
    if (!is_array($results['users'])) {
        $results['users'] = [];
        $results['message'] .= " ❌ Failed to fetch users from database.";
    }

    require(TEMPLATE_PATH . "/users/manage_user.php");
}


// Function: Edit user

function editUser() {
    global $pdo;
    $results = ['pageTitle' => "Edit User", 'message' => ""];

    if (!isset($_GET['id'])) {
        die("❌ No user ID provided.");
    }
    $userId = (int) $_GET['id'];

    $user = User::getById($pdo, $userId);
    if (!$user) {
        die("❌ User not found!");
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name'        => trim($_POST['name']),
            'email'       => trim($_POST['email']),
            'password'    => $_POST['password'], // optional
            'role_id'     => $_POST['role_id'],
            'property_id' => !empty($_POST['property_id']) ? $_POST['property_id'] : null
        ];

        if (User::update($pdo, $userId, $data)) {
            $results['message'] = "✅ User updated successfully!";
            $user = User::getById($pdo, $userId); // refresh user info
        } else {
            $results['message'] = "❌ Error updating user!";
        }
    }

    $results['user'] = $user;
    require(TEMPLATE_PATH . "/users/edit_user.php");
}


// Function: Dashboard placeholder

function dashboard() {
    // Prepare any data needed
    $currentUserName = isset($_SESSION['username']) ? $_SESSION['username'] : "Super Admin";
    $currentUserRole = "Admin"; // or fetch from DB/session

    // Include full dashboard template
    require(TEMPLATE_PATH . "/admin/index.php");
}
