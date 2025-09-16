<?php
// /core/roles/manage.php
// ----------------------
// Purpose: Show all roles and allow Admin to edit/delete them

require_once __DIR__ . '/../../config/config.php'; // DB connection

$message = "";

// Handle delete action
if (isset($_GET['delete'])) {
    $roleId = intval($_GET['delete']);
    try {
        $stmt = $pdo->prepare("DELETE FROM roles WHERE role_id = ?");
        $stmt->execute([$roleId]);
        $message = "Role deleted successfully!";
    } catch (PDOException $e) {
        $message = "Error deleting role: " . $e->getMessage();
    }
}

// Fetch all roles
try {
    $stmt = $pdo->query("SELECT * FROM roles ORDER BY role_id DESC");
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching roles: " . $e->getMessage());
}
?>

<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/sidebar.php'; ?>

<main class="admin-page">
    <h2>Manage Roles</h2>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Role ID</th>
                <th>Role Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($roles): ?>
            <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?= htmlspecialchars($role['role_id']) ?></td>
                    <td><?= htmlspecialchars($role['role_name']) ?></td>
                    <td><?= htmlspecialchars($role['created_at']) ?></td>
                    <td>
                        <!-- Edit Button -->
                        <a href="edit.php?id=<?= $role['role_id'] ?>" 
                           class="btn btn-sm btn-primary">
                           Edit
                        </a>
                        
                        <!-- Delete Button -->
                        <a href="manage.php?delete=<?= $role['role_id'] ?>"
                           onclick="return confirm('Are you sure you want to delete this role?');"
                           class="btn btn-sm btn-danger">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No roles found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
