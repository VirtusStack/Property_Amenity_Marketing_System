<?php
// ----------------------------
// EDIT USER PAGE
// ----------------------------
// Allows admin to update an existing user
// Uses updateUser() function from UserFunctions.php

require_once __DIR__ . '/../../config/config.php';   // load DB + BASE_URL
require_once __DIR__ . '/UserFunctions.php';         // include functions

$message = ""; // feedback message

// Get user ID from URL (e.g., edit.php?id=2)
if (!isset($_GET['id'])) {
    die("❌ No user ID provided.");
}
$userId = (int) $_GET['id'];

// Fetch existing user details from DB
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    die("❌ User not found!");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $data = [
        'name'        => trim($_POST['name']),
        'email'       => trim($_POST['email']),
        'password'    => $_POST['password'], // optional (leave blank = no change)
        'role_id'     => $_POST['role_id'],
        'property_id' => !empty($_POST['property_id']) ? $_POST['property_id'] : null
    ];

    // Call updateUser() with $pdo, $userId, and $data array
    if (updateUser($pdo, $userId, $data)) {
        $message = "✅ User updated successfully!";

        // Refresh user details after update
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
    } else {
        $message = "❌ Error updating user!";
    }
}

// Load header
include_once __DIR__ . '/../../includes/header.php';
?>

<!--  Main Flex Container -->
<div class="main-content">

    <!--  Admin Panel -->
    <main class="admin-page">
        <h2>Edit User</h2>

        <!--  Show success/error message-->
        <?php if ($message): ?>
        <div class="form-message <?= strpos($message,'✅')!==false ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
        <?php endif; ?>

        <!-- User Form -->
        <div class="card">
            <form method="POST">
                <!-- Name input -->
                <label>Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

                <!-- Email input -->
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

                <!-- Password input -->
                <label>New Password (leave blank to keep old):</label>
                <input type="password" name="password">

                <!-- Role dropdown -->
                <label>Role:</label>
                <select name="role_id" required>
                    <?php
                    $roles = $pdo->query("SELECT * FROM roles")->fetchAll();
                    foreach ($roles as $role) {
                        $selected = ($role['role_id'] == $user['role_id']) ? "selected" : "";
                        echo "<option value='{$role['role_id']}' $selected>{$role['role_name']}</option>";
                    }
                    ?>
                </select>

                <!-- Property (optional) -->
                <label>Property ID (optional):</label>
                <input type="number" name="property_id" value="<?= htmlspecialchars($user['property_id']) ?>">

                <!-- Submit button -->
                <button type="submit">Update User</button>
            </form>
        </div>

    <!-- Sidebar -->
    <?php include_once __DIR__ . '/../../includes/sidebar.php'; ?>
</main>

</div>

<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
