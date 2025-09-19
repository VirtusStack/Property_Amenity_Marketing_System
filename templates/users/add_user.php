<?php
// /templates/users/add_user.php
// -------------------------
// View file: Displays Add User form
require_once __DIR__ . '/../../config/config.php';   // load config + BASE_URL + DB
?>
<?php include __DIR__ . "/../include/header.php"; ?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . "/../include/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include __DIR__ . "/../include/topbar.php"; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Add User' ?>
                </h1>

                <!-- Feedback message -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= strpos($results['message'],'✅')!==false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= strpos($results['message'],'✅')!==false ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- User Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- ✅ Make sure form submits to admin.php -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=newUser">
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
        <?php include __DIR__ . "/../include/footer.php"; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
