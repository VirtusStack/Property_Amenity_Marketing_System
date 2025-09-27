<?php
// -------------------------
// MANAGE COMPANIES TEMPLATE
// -------------------------
// This template displays a table of all companies.
// It includes Edit and Delete actions for each company.
// Pagination is handled via SQL LIMIT/OFFSET.

// Ensure $results array is defined
$results = $results ?? [
    'pageTitle'   => 'Manage Companies',
    'message'     => '',
    'companies'   => [],
    'currentPage' => 1,
    'totalPages'  => 1
];

$companies   = $results['companies'];
$currentPage = $results['currentPage'];
$totalPages  = $results['totalPages'];
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

                <!-- Page Heading with Add Company Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>
                    <a href="<?= BASE_URL ?>/admin.php?action=newCompany" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Company
                    </a>
                </div>

                <!-- Feedback message -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= strpos($results['message'],'✅')!==false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Companies Table Card -->
                <div class="card shadow mb-4">
                                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered ">
                                <!-- Use light header instead of black -->
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>Description</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Website</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($companies)): ?>
                                        <?php foreach ($companies as $company): ?>
                                            <tr>
                                                <td><?= $company['company_id'] ?></td>
                                                <td><?= htmlspecialchars($company['company_name']) ?></td>
                                                <td><?= htmlspecialchars($company['description'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($company['email'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($company['phone'] ?? '-') ?></td>
                                                <td>
                                                    <?php if (!empty($company['website'])): ?>
                                                        <a href="<?= htmlspecialchars($company['website']) ?>" target="_blank"><?= htmlspecialchars($company['website']) ?></a>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($company['created_at'] ?? '-') ?></td>
                                                <td>
                                                    <!-- Original button colors -->
                                                    <a class="btn btn-sm btn-warning" 
                                                       href="<?= BASE_URL ?>/admin.php?action=editCompany&id=<?= $company['company_id'] ?>">
                                                       <i class="bi bi-pencil-square"></i> Edit
                                                    </a>
                                                    <a class="btn btn-sm btn-danger" 
                                                       href="<?= BASE_URL ?>/admin.php?action=manageCompanies&delete=<?= $company['company_id'] ?>" 
                                                       onclick="return confirm('Are you sure you want to delete this company?');">
                                                       <i class="bi bi-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No companies found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Pagination Links with Next/Previous -->
                            <?php if ($totalPages > 1): ?>
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <!-- Previous Button -->
                                        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" 
                                               href="<?= BASE_URL ?>/admin.php?action=manageCompanies&page=<?= max(1, $currentPage-1) ?>" 
                                               tabindex="-1">Previous</a>
                                        </li>

                                        <!-- Numbered Pages -->
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                                <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageCompanies&page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <!-- Next Button -->
                                        <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                            <a class="page-link" 
                                               href="<?= BASE_URL ?>/admin.php?action=manageCompanies&page=<?= min($totalPages, $currentPage+1) ?>">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            <?php endif; ?>

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
