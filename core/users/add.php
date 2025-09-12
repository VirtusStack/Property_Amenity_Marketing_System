<?php
// ----------------------------
// ADD USER PAGE
// ----------------------------
// Allows admin to create a new user
// Uses PDO and password hashing

require_once __DIR__ . '/../../config/config.php'; // load DB connection and BASE_URL

$message = ""; // feedback message

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);       // User full name
    $email    = trim($_POST['email']);      // User email
    $password = $_POST['password'];         // Plain password
    $role_id  = $_POST['role_id'];          // Role ID

    // Hash password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Insert user into database using prepared statement
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword, $role_id]);

        $message = "✅ User added successfully!";
    } catch (PDOException $e) {
        $message = "❌ Error: " . $e->getMessage();
    }
}

// Load header
include_once __DIR__ . '/../../includes/header.php';
?>

<!-- -------------------- Main Flex Container -------------------- -->
<div class="main-content">

    <!-- -------------------- Admin Panel -------------------- -->
    <div class="admin-panel">
        <h2>Add User</h2>

        <!-- -------------------- Show success/error message -------------------- -->
        <?php if ($message): ?>
        <div class="form-message <?= strpos($message,'✅')!==false ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
        <?php endif; ?>

        <!-- -------------------- User Form -------------------- -->
        <div class="card">
            <form method="POST">
                <!-- Name input -->
                <label>Name:</label>
                <input type="text" name="name" required>

                <!-- Email input -->
                <label>Email:</label>
                <input type="email" name="email" required>

                <!-- Password input -->
                <label>Password:</label>
                <input type="password" name="password" required>

                <!-- Role dropdown -->
                <label>Role:</label>
                <select name="role_id" required>
                    <?php
                    // Fetch roles dynamically from DB
                    $roles = $pdo->query("SELECT * FROM roles")->fetchAll();
                    foreach ($roles as $role) {
                        echo "<option value='{$role['role_id']}'>{$role['role_name']}</option>";
                    }
                    ?>
                </select>

                <!-- Submit button -->
                <button type="submit">Add User</button>
            </form>
        </div>
    </div>

    <!-- -------------------- Sidebar -------------------- -->
    <?php include_once __DIR__ . '/../../includes/sidebar.php'; ?>

</div>

<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
