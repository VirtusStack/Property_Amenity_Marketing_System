<?php
// /templates/roles/manage_roles.php
// -------------------------
// View file: Displays Manage Roles table
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
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Manage Roles' ?>
                </h1>

                <!-- Feedback message -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= strpos($results['message'],'✅')!==false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= strpos($results['message'],'✅')!==false ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Roles Table -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th>Company</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($results['roles'])): ?>
                                    <?php foreach ($results['roles'] as $role): ?>
                                        <tr>
                                            <td><?= $role['role_id'] ?></td>
                                            <td><?= htmlspecialchars($role['role_name']) ?></td>
                                            <td>
                                                <?= $role['can_create'] ? 'C ' : '' ?>
                                                <?= $role['can_read'] ? 'R ' : '' ?>
                                                <?= $role['can_update'] ? 'U ' : '' ?>
                                                <?= $role['can_delete'] ? 'D ' : '' ?>
                                            </td>
                                            <td>
                                                <?php
                                                $companyStmt = $pdo->prepare("SELECT company_name FROM companies WHERE company_id = ?");
                                                $companyStmt->execute([$role['company_id']]);
                                                $company = $companyStmt->fetch();
                                                echo $company ? htmlspecialchars($company['company_name']) : '';
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL ?>/admin.php?action=editRole&id=<?= $role['role_id'] ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="<?= BASE_URL ?>/admin.php?action=manageRoles&delete=<?= $role['role_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this role?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No roles found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
