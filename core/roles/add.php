<?php
// /core/roles/add.php
// -------------------
// Purpose: Allow Admin to create (add) new roles

require_once __DIR__ . '/../../config/config.php'; // DB + BASE_URL

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role_name = trim($_POST['role_name']);

    if (!empty($role_name)) {
        try {
            $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insert new role
            $stmt = $pdo->prepare("INSERT INTO roles (role_name) VALUES (:role_name)");
            $stmt->execute(['role_name' => $role_name]);

            $message = "<div class='alert alert-success'>Role added successfully!</div>";
        } catch (PDOException $e) {
            $message = "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Role name cannot be empty.</div>";
    }
}
?>

<?php include_once __DIR__ . '/../../includes/header.php'; ?>
<?php include_once __DIR__ . '/../../includes/sidebar.php'; ?>

<main class="admin-page">
    <h2>Add Role</h2>

    <div class="form-card">
        <?= $message; ?>
        <h3>Create New Role</h3>

        <form method="POST" action="">
            <label for="role_name">Role Name</label>
            <input type="text" id="role_name" name="role_name" placeholder="e.g. Admin, Manager, Customer">

            <button type="submit">Add Role</button>
        </form>
    </div>
</main>

<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
