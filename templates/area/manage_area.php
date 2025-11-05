<?php
// -------------------------
// MANAGE AREAS TEMPLATE
// -------------------------
// Displays all areas (Spa, Gym, Play Area, Banquet Hall, etc.) 
// with Edit/Delete actions
// Includes numbered pagination and dropdown + Go button after Next
// -------------------------

$results = $results ?? [
    'pageTitle'   => 'Manage Areas',
    'message'     => '',
    'areas'       => [],
    'currentPage' => 1,
    'totalPages'  => 1,
    'total'       => 0,
    'perPage'     => 25
];

$areas       = $results['areas'];
$currentPage = (int)($results['currentPage'] ?? 1);
$totalPages  = (int)($results['totalPages'] ?? 1);
$total       = (int)($results['total'] ?? count($areas));
$perPage     = (int)($results['perPage'] ?? count($areas));
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

                <!-- Page Heading with Add Area Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>
                    <a href="<?= BASE_URL ?>/admin.php?action=newArea" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Area
                    </a>
                </div>

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

                <!-- Areas Table Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Area Name</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($areas)): ?>
                                        <?php foreach ($areas as $area): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($area['area_id']) ?></td>
                                                <td><?= htmlspecialchars($area['company_name'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($area['location_name'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($area['area_name'] ?? '-') ?></td>
                                                <td><?= ucfirst(str_replace('_', ' ', htmlspecialchars($area['plugin_type'] ?? '-'))) ?></td>
                                                <td><?= htmlspecialchars($area['description'] ?? '-') ?></td>
                                                <td>
                                                    <span class="badge <?= ($area['status'] == 'active') ? 'bg-success text-white' : 'bg-secondary text-white' ?>">
                                                        <?= htmlspecialchars($area['status']) ?>
                                                    </span>
                                                </td>
                                                <td><?= htmlspecialchars($area['created_at'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($area['updated_at'] ?? '-') ?></td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <a class="btn btn-sm btn-warning" 
                                                       href="<?= BASE_URL ?>/admin.php?action=editArea&id=<?= $area['area_id'] ?>">
                                                       <i class="bi bi-pencil-square"></i> Edit
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form method="get" action="<?= BASE_URL ?>/admin.php" style="display:inline-block; margin:0 4px;"
                                                          onsubmit="return confirm('Are you sure you want to delete this area?');">
                                                        <input type="hidden" name="action" value="manageAreas">
                                                        <input type="hidden" name="delete" value="<?= $area['area_id'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10" class="text-center">No areas found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?php if ($totalPages >= 1): ?>
                            <nav aria-label="Pagination" class="mt-4">
                                <ul class="pagination justify-content-center align-items-center">

                                    <!-- Prev -->
                                    <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageAreas&page=<?= max(1, $currentPage - 1) ?>">
                                            <i class="fas fa-angle-left"></i> Prev
                                        </a>
                                    </li>

                                    <!-- First + Ellipsis -->
                                    <?php if ($currentPage > 3): ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageAreas&page=1">1</a></li>
                                        <?php if ($currentPage > 4): ?><li class="page-item disabled"><span class="page-link">...</span></li><?php endif; ?>
                                    <?php endif; ?>

                                    <!-- Middle Pages -->
                                    <?php
                                    $start = max(1, $currentPage - 2);
                                    $end   = min($totalPages, $currentPage + 2);
                                    for ($i = $start; $i <= $end; $i++): ?>
                                        <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                                            <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageAreas&page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <!-- Ellipsis + Last -->
                                    <?php if ($currentPage < $totalPages - 2): ?>
                                        <?php if ($currentPage < $totalPages - 3): ?><li class="page-item disabled"><span class="page-link">...</span></li><?php endif; ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageAreas&page=<?= $totalPages ?>"><?= $totalPages ?></a></li>
                                    <?php endif; ?>

                                    <!-- Next -->
                                    <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageAreas&page=<?= min($totalPages, $currentPage + 1) ?>">
                                            Next <i class="fas fa-angle-right"></i>
                                        </a>
                                    </li>

                                    <!-- Go To Page -->
                                    <li class="page-item ms-3">
                                        <form method="get" action="<?= BASE_URL ?>/admin.php" class="form-inline">
                                            <input type="hidden" name="action" value="manageAreas">
                                            <label for="gotoPage" class="mr-2 mb-0">Go to:</label>
                                            <input type="number" min="1" max="<?= $totalPages ?>" name="page" id="gotoPage"
                                                   class="form-control form-control-sm mr-2" style="width:70px" value="<?= $currentPage ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">Go</button>
                                        </form>
                                    </li>
                                </ul>
                            </nav>
                        <?php endif; ?>
                        <!-- End Pagination -->

                    </div>
                </div>
                <!-- End of Areas Table Card -->

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
