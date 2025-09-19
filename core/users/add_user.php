<?php
// /core/users/add_user.php
// -------------------------
// Purpose: Allow Admin to create a new user

// 1. Include database connection + User class
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../classes/User.php';

$message = ""; // feedback message

// 2. Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $role_id  = $_POST['role_id'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword, $role_id]);
        $message = "✅ User added successfully!";
    } catch (PDOException $e) {
        $message = "❌ Error: " . $e->getMessage();
    }
}

// 3. Load header (SB Admin 2 header opens <body>)
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
                <h1 class="h3 mb-4 text-gray-800">Add User</h1>

                <!-- Feedback message -->
                <?php if ($message): ?>
                    <div class="alert <?= strpos($message,'✅')!==false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= strpos($message,'✅')!==false ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($message) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- User Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group mb-3">
                                <label>Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Role:</label>
                                <select name="role_id" class="form-control" required>
                                    <?php
                                    $roles = $pdo->query("SELECT * FROM roles")->fetchAll();
                                    foreach ($roles as $role) {
                                        echo "<option value='{$role['role_id']}'>{$role['role_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Add User</button>
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
