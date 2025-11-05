<?php
// /templates/roles/add_role.php
// -------------------------
// View file: Displays Add Role form
require_once __DIR__ . '/../../config/config.php';   // Load config + BASE_URL + DB
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
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Add Role' ?>
                </h1>

               <!-- Feedback message -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= (stripos($results['message'], 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= (stripos($results['message'], 'success') !== false) ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>


                <!-- Role Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Form submits to admin.php -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=newRole">

                            <!-- Role Name -->
                            <div class="form-group mb-3">
                                <label>Role Name:</label>
                                <input type="text" name="role_name" class="form-control" required>
                            </div>

                            <!-- Permissions -->
                            <div class="form-group mb-3">
                                <label>Permissions:</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_create" value="1" id="permCreate">
                                    <label class="form-check-label" for="permCreate">Create</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_read" value="1" id="permRead" checked>
                                    <label class="form-check-label" for="permRead">Read</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_update" value="1" id="permUpdate">
                                    <label class="form-check-label" for="permUpdate">Update</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_delete" value="1" id="permDelete">
                                    <label class="form-check-label" for="permDelete">Delete</label>
                                </div>
                            </div>

                            <!-- Company Dropdown -->
                            <div class="form-group mb-3">
                                <label>Company:</label>
                                <select name="company_id" class="form-control" required>
                                    <?php
                                    $companies = $pdo->query("SELECT * FROM companies")->fetchAll();
                                    foreach ($companies as $company) {
                                        echo "<option value='{$company['company_id']}'>{$company['company_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary">Add Role</button>
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
