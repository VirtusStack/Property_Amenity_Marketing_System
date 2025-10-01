<?php
// -------------------------
// MANAGE COMPANIES TEMPLATE
// -------------------------
// Displays companies with Edit/Delete actions
// Includes numbered pagination and a dropdown+Go AFTER the Next button.
// -------------------------

$results = $results ?? [
    'pageTitle'   => 'Manage Companies',
    'message'     => '',
    'companies'   => [],
    'currentPage' => 1,
    'totalPages'  => 1,
    'total'       => 0,
    'perPage'     => 10
];

$companies   = $results['companies'];
$currentPage = (int)($results['currentPage'] ?? 1);
$totalPages  = (int)($results['totalPages'] ?? 1);
$total       = (int)($results['total'] ?? count($companies));
$perPage     = (int)($results['perPage'] ?? count($companies));
$offset      = ($currentPage - 1) * $perPage;
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
    		<div class="alert <?= (stripos($results['message'], 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
       		 <?= (stripos($results['message'], 'success') !== false)  ? '<i class="fas fa-check-circle"></i>'  : '<i class="fas fa-times-circle"></i>' ?>
      		  <?= htmlspecialchars($results['message']) ?>
       		 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            	<span aria-hidden="true">&times;</span>
       		 </button>
   		 </div>
		<?php endif; ?>


                <!-- Companies Table Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <!-- Keep original color -->
                        <h6 class="m-0 font-weight-bold text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
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
                                                    <!-- Edit link -->
                                                    <a class="btn btn-sm btn-warning" 
                                                       href="<?= BASE_URL ?>/admin.php?action=editCompany&id=<?= $company['company_id'] ?>">
                                                       <i class="bi bi-pencil-square"></i> Edit
                                                    </a>

                                                    <!-- Delete uses a GET form with onsubmit confirm -->
                                                    <form method="get" action="<?= BASE_URL ?>/admin.php" style="display:inline-block; margin:0 4px;"
                                                          onsubmit="return confirm('Are you sure you want to delete this company?');">
                                                        <input type="hidden" name="action" value="manageCompanies">
                                                        <input type="hidden" name="delete" value="<?= $company['company_id'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
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
                        </div>

                        <!-- Pagination controls -->
                        <?php if ($totalPages > 1): ?>
                            <nav aria-label="Company pagination">
                                <ul class="pagination justify-content-center align-items-center">

                                    <!-- Previous button -->
                                    <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageCompanies&page=<?= max(1, $currentPage - 1) ?>">Previous</a>
                                    </li>

                                    <!-- Numbered pages -->
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                                            <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageCompanies&page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <!-- Next button -->
                                    <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                   <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageCompanies&page=<?= min($totalPages, $currentPage + 1) ?>">Next</a>
                                    </li>

                                    <!-- Dropdown + Go (AFTER Next) -->
                                    <li class="page-item ms-2">
                                        <form method="get" action="<?= BASE_URL ?>/admin.php" class="d-flex" style="gap:6px;">
                                            <input type="hidden" name="action" value="manageCompanies">
                                            <select name="page" class="form-select form-select-sm">
                                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                    <option value="<?= $i ?>" <?= ($i === $currentPage) ? 'selected' : '' ?>>Page <?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Go</button>
                                        </form>
                                    </li>
                                </ul>
                            </nav>

                         <?php endif; ?>

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
