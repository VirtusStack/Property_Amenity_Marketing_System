<?php
// /core/users/manage.php
// -----------------------
// Purpose: Show all users and allow Admin to edit or delete them

// 1. Include database connection + functions
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/UserFunctions.php'; 

// 2. Variable for feedback messages
$message = "";

// 3. Handle delete action
// If ?delete=ID is in URL → remove that user
if (isset($_GET['delete'])) {
    $userId = (int) $_GET['delete'];

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);

        $message = "✅ User deleted successfully!";
    } catch (PDOException $e) {
        $message = "❌ Error: " . $e->getMessage();
    }
}

// 4. Fetch all users with their roles
// Join with roles table so we can show role_name instead of just ID
$users = $pdo->query("
    SELECT u.user_id, u.name, u.email, r.role_name, u.created_at 
    FROM users u 
    JOIN roles r ON u.role_id = r.role_id 
    ORDER BY u.created_at DESC
")->fetchAll();
?>

<!-- 5. Load header -->
<?php include_once __DIR__ . '/../../includes/header.php'; ?>

<!-- 6. Main content area -->
<main class="admin-page">
    <h2>Manage Users</h2>

    <!-- Show success/error messages -->
    <?php if ($message): ?>
        <div class="form-message <?= strpos($message,'✅')!==false ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <!-- 7. Users table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>

        <!-- Loop through each user -->
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['user_id'] ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role_name']) ?></td>
                <td><?= $user['created_at'] ?></td>
                <td>
                    <!-- Edit link (goes to edit.php?id=xxx) -->
                    <a href="edit.php?id=<?= $user['user_id'] ?>">Edit</a> | 

                    <!-- Delete link -->
                    <a href="?delete=<?= $user['user_id'] ?>" 
                       onclick="return confirm('Are you sure you want to delete this user?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Sidebar -->
    <?php include_once __DIR__ . '/../../includes/sidebar.php'; ?>
</main>

<!-- 8. Load footer -->
<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
