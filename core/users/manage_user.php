<?php
// /core/users/manage_user.php
// -------------------------
// Purpose: Show all users and allow Admin to edit or delete them

// 1. Include database connection + User class
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../classes/User.php';

// 2. Variable for feedback messages
$message = "";

// 3. Handle delete action (?delete=ID)
if (isset($_GET['delete'])) {
    $userId = (int) $_GET['delete'];

    if (User::delete($pdo, $userId)) {
        $message = "✅ User deleted successfully!";
    } else {
        $message = "❌ Error deleting user.";
    }
}

// 4. Fetch all users
$users = User::getAll($pdo);

// 5. Load header (SB Admin 2 header opens <body>)
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
                <h1 class="h3 mb-4 text-gray-800">Manage Users</h1>

                <!-- Feedback message -->
                <?php if ($message): ?>
                    <div class="alert <?= strpos($message,'✅')!==false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= strpos($message,'✅')!==false ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($message) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Users Table Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if ($users): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?= $user['user_id'] ?></td>
                                            <td><?= htmlspecialchars($user['name']) ?></td>
                                            <td><?= htmlspecialchars($user['email']) ?></td>
                                            <td><?= htmlspecialchars($user['role_name']) ?></td>
                                            <td><?= $user['created_at'] ?></td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="edit_user.php?id=<?= $user['user_id'] ?>">Edit</a>
                                                <a class="btn btn-sm btn-danger" href="?delete=<?= $user['user_id'] ?>"
                                                   onclick="return confirm('Are you sure you want to delete this user?');">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="6">No users found.</td></tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
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
