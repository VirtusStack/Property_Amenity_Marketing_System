<?php
// -------------------------
// MANAGE COMPANIES TEMPLATE
// -------------------------
// This template displays a table of all companies along with their first location.
// It includes Edit and Delete actions for each company.

// Ensure $results array is defined
$results = $results ?? [
    'pageTitle' => 'Manage Companies',
    'message'   => '',
    'companies' => []
];
?>

<?php include __DIR__ . "/../include/header.php"; ?>

<div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . "/../include/sidebar.php"; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Topbar -->
            <?php include __DIR__ . "/../include/topbar.php"; ?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>

                <!-- Feedback message (success/error) -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= strpos($results['message'],'✅')!==false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($results['message']) ?>
                        <!-- Close button for alert -->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Companies Table Card -->
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?= htmlspecialchars($results['pageTitle']) ?></h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>Location</th>
                                        <th>Address</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Check if there are companies -->
                                    <?php if (!empty($results['companies'])): ?>
                                        <?php foreach ($results['companies'] as $company): ?>
                                            <tr>
                                                <!-- Company ID -->
                                                <td><?= $company['company_id'] ?></td>

                                                <!-- Company Name -->
                                                <td><?= htmlspecialchars($company['company_name']) ?></td>

                                                <!-- Location Name (show '-' if not available) -->
                                                <td><?= htmlspecialchars($company['location_name'] ?? '-') ?></td>

                                                <!-- Address (show '-' if not available) -->
                                                <td><?= htmlspecialchars($company['address'] ?? '-') ?></td>

                                                <!-- Created At (show '-' if not available) -->
                                                <td><?= htmlspecialchars($company['created_at'] ?? '-') ?></td>

                                                <!-- Actions: Edit & Delete -->
                                                <td>
                                                    <!-- Edit button -->
                                                    <a class="btn btn-sm btn-warning" 
                                                       href="<?= BASE_URL ?>/admin.php?action=editCompany&id=<?= $company['company_id'] ?>">
                                                       <i class="bi bi-pencil-square"></i> Edit
                                                    </a>

                                                    <!-- Delete button -->
                                                    <a class="btn btn-sm btn-danger" 
                                                       href="<?= BASE_URL ?>/admin.php?action=manageCompanies&delete=<?= $company['company_id'] ?>" 
                                                       onclick="return confirm('Are you sure you want to delete this company?');">
                                                       <i class="bi bi-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <!-- No companies found -->
                                        <tr>
                                            <td colspan="6" class="text-center">No companies found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End of Companies Table Card -->

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
