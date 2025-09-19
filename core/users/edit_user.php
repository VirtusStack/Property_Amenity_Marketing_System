<?php
// /core/users/edit_user.php
// -------------------------
// Purpose: Allows admin to update an existing user
// Uses User::update() method from User.php

// 1. Include database connection + User class
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../classes/User.php';

// 2. Feedback message
$message = "";

// 3. Get user ID from URL (e.g., edit_user.php?id=2)
if (!isset($_GET['id'])) {
    die("❌ No user ID provided.");
}
$userId = (int) $_GET['id'];

// 4. Fetch existing user details from DB
$user = User::getById($pdo, $userId);
if (!$user) {
    die("❌ User not found!");
}

// 5. Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name'        => trim($_POST['name']),
        'email'       => trim($_POST['email']),
        'password'    => $_POST['password'], // optional
        'role_id'     => $_POST['role_id'],
        'property_id' => !empty($_POST['property_id']) ? $_POST['property_id'] : null
    ];

    if (User::update($pdo, $userId, $data)) {
        $message = "✅ User updated successfully!";
        $user = User::getById($pdo, $userId); // refresh user info
    } else {
        $message = "❌ Error updating user!";
    }
}

// 6. Load header
include_once __DIR__ . '/../../templates/include/header.php';
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include_once __DIR__ . '/../../templates/include/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include_once __DIR__ . '/../../templates/include/topbar.php'; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

                <!-- Feedback message -->
                <?php if ($message): ?>
                    <div class="alert <?= strpos($message,'✅')!==false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= strpos($message,'✅')!==false ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($message) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- User Edit Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST">

                            <!-- Name input -->
                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                            </div>

                            <!-- Email input -->
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                            </div>

                            <!-- Password input -->
                            <div class="mb-3">
                                <label class="form-label">New Password (leave blank to keep old):</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <!-- Role dropdown -->
                            <div class="mb-3">
                                <label class="form-label">Role:</label>
                                <select name="role_id" class="form-select" required>
                                    <?php
                                    $roles = $pdo->query("SELECT * FROM roles")->fetchAll();
                                    foreach ($roles as $role) {
                                        $selected = ($role['role_id'] == $user['role_id']) ? "selected" : "";
                                        echo "<option value='{$role['role_id']}' $selected>{$role['role_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Property (optional) -->
                            <div class="mb-3">
                                <label class="form-label">Property ID (optional):</label>
                                <input type="number" name="property_id" class="form-control" value="<?= htmlspecialchars($user['property_id']) ?>">
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once __DIR__ . '/../../templates/include/footer.php'; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
