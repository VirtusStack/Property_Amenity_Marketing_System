<?php
// /core/users/manage.php
// -----------------------
// Purpose: Show all users and allow Admin to delete them

// 1. Include database connection
require_once __DIR__ . '/../../config/config.php';

// 2. Variable for feedback messages
$message = "";

// 3. Handle delete action
if (isset($_GET['delete'])) {
    $userId = (int) $_GET['delete'];

    try {
        // Prepare delete query
        $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);

        $message = "✅ User deleted successfully!";
    } catch (PDOException $e) {
        $message = "❌ Error: " . $e->getMessage();
    }
}

// 4. Fetch all users with their roles
$users = $pdo->query("
    SELECT u.user_id, u.name, u.email, r.role_name, u.created_at 
    FROM users u 
    JOIN roles r ON u.role_id = r.role_id 
    ORDER BY u.created_at DESC
")->fetchAll();
?>

<!-- 5. Load header and sidebar -->
<?php include_once __DIR__ . '/../../includes/header.php'; ?>
<?php include_once __DIR__ . '/../../includes/sidebar.php'; ?>

<!-- 6. Main content -->
<main class="admin-page">
    <h2>Manage Users</h2>

    <!-- Show message -->
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <!-- 7. Users table -->
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['user_id'] ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role_name']) ?></td>
                <td><?= $user['created_at'] ?></td>
                <td>
                    <!-- Delete link -->
                    <a href="?delete=<?= $user['user_id'] ?>" 
                       onclick="return confirm('Are you sure you want to delete this user?');">
                       ❌ Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<!-- 8. Load footer -->
<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
