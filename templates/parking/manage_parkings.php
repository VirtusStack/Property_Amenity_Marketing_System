<?php
// -------------------------
// MANAGE PARKING TEMPLATE
// -------------------------
// Displays parking areas with Edit/Delete actions
// Includes numbered pagination and a dropdown+Go AFTER the Next button
// -------------------------

$results = $results ?? [
    'pageTitle'   => 'Manage Parking',
    'message'     => '',
    'parkings'    => [],
    'currentPage' => 1,
    'totalPages'  => 1,
    'total'       => 0,
    'perPage'     => 25
];

$parkings    = $results['parkings'];
$currentPage = (int)($results['currentPage'] ?? 1);
$totalPages  = (int)($results['totalPages'] ?? 1);
$total       = (int)($results['total'] ?? count($parkings));
$perPage     = (int)($results['perPage'] ?? count($parkings));
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

                <!-- Page Heading with Add Parking Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>
                    <a href="<?= BASE_URL ?>/admin.php?action=newParking" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Parking
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

                <!-- Parking Table Card -->
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
                                        <th>Location</th>
                                        <th>Parking Name</th>
                                        <th>Parking Number</th>
                                        <th>Vehicle Number</th>
                                        <th>Type</th>
                                        <th>Capacity</th>
                                        <th>Covered</th>
                                        <th>Charging Point</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($parkings)): ?>
                                        <?php foreach ($parkings as $parking): ?>
                                            <tr>
                                                <td><?= $parking['parking_id'] ?></td>
                                                <td><?= htmlspecialchars($parking['location_name'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($parking['parking_name']) ?></td>
                                                <td><?= htmlspecialchars($parking['parking_number'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($parking['vehicle_number'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($parking['type'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($parking['capacity'] ?? '-') ?></td>
                                                <td><?= $parking['is_covered'] ? 'Yes' : 'No' ?></td>
                                                <td><?= $parking['charging_point_available'] ? 'Yes' : 'No' ?></td>
                                                <td><?= htmlspecialchars($parking['status']) ?></td>
                                                <td>
                                                    <!-- Edit button -->
                                                    <a class="btn btn-sm btn-warning" 
                                                       href="<?= BASE_URL ?>/admin.php?action=editParking&id=<?= $parking['parking_id'] ?>">
                                                       <i class="bi bi-pencil-square"></i> Edit
                                                    </a>

                                                    <!-- Delete button -->
                                                    <form method="get" action="<?= BASE_URL ?>/admin.php" style="display:inline-block; margin:0 4px;"
                                                          onsubmit="return confirm('Are you sure you want to delete this parking?');">
                                                        <input type="hidden" name="action" value="manageParking">
                                                        <input type="hidden" name="delete" value="<?= $parking['parking_id'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="11" class="text-center">No parking areas found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination controls -->
                        <nav aria-label="Parking pagination">
                            <ul class="pagination justify-content-center align-items-center">

                                <!-- Previous -->
                                <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                     <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageParking&page=<?= max(1, $currentPage - 1) ?>">Previous</a>
                                </li>

                                <!-- Numbers -->
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                     <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                                         <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageParking&page=<?= $i ?>"><?= $i ?></a>
                                     </li>
                                <?php endfor; ?>

                                <!-- Next -->
                                <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                     <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageParking&page=<?= min($totalPages, $currentPage + 1) ?>">Next</a>
                                </li>

                                <!-- Dropdown + Go button -->
                                <li class="page-item ms-2">
                                    <form method="get" action="<?= BASE_URL ?>/admin.php" class="d-flex">
                                        <input type="hidden" name="action" value="manageParking">
                                        <select name="page" class="form-select form-select-sm me-1" onchange="this.form.submit()">
                                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                <option value="<?= $i ?>" <?= ($i === $currentPage) ? 'selected' : '' ?>>Page <?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Go</button>
                                    </form>
                                </li>

                            </ul>
                        </nav>

                    </div>
                </div>
                <!-- End of Parking Table Card -->

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
