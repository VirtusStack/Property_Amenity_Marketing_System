<?php
// /templates/companies/edit_company.php
// -------------------------
// View file: Displays Edit Company

require_once __DIR__ . '/../../config/config.php';
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
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Edit Company' ?>
                </h1>

                <!-- Feedback message -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= strpos($results['message'],'✅')!==false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= strpos($results['message'],'✅')!==false ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Company Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- ✅ Form submits to admin.php?action=editCompany&id=XX -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=editCompany&id=<?= htmlspecialchars($results['company']['company_id']) ?>">

                            <!-- Company Name -->
                            <div class="form-group mb-3">
                                <label>Company Name:</label>
                                <input type="text" name="company_name" class="form-control" required
                                    value="<?= htmlspecialchars($results['company']['company_name'] ?? '') ?>">
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($results['company']['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control"
                                    value="<?= htmlspecialchars($results['company']['email'] ?? '') ?>">
                            </div>

                            <!-- Phone -->
                            <div class="form-group mb-3">
                                <label>Phone:</label>
                                <input type="text" name="phone" class="form-control"
                                    value="<?= htmlspecialchars($results['company']['phone'] ?? '') ?>">
                            </div>

                            <!-- Website -->
                            <div class="form-group mb-3">
                                <label>Website:</label>
                                <input type="url" name="website" class="form-control"
                                    value="<?= htmlspecialchars($results['company']['website'] ?? '') ?>">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update Company</button>
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
