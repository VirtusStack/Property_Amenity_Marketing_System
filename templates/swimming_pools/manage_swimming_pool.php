<?php
// -------------------------
// MANAGE SWIMMING POOLS TEMPLATE
// -------------------------
// Displays swimming pools with Edit/Delete actions
// Includes numbered pagination and a dropdown+Go AFTER the Next button
// -------------------------

$results = $results ?? [
    'pageTitle'   => 'Manage Swimming Pools',
    'message'     => '',
    'pools'       => [],
    'currentPage' => 1,
    'totalPages'  => 1,
    'total'       => 0,
    'perPage'     => 25
];

$pools       = $results['pools'];
$currentPage = (int)($results['currentPage'] ?? 1);
$totalPages  = (int)($results['totalPages'] ?? 1);
$total       = (int)($results['total'] ?? count($pools));
$perPage     = (int)($results['perPage'] ?? count($pools));
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

                <!-- Page Heading with Add Swimming Pool Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>
                    <a href="<?= BASE_URL ?>/admin.php?action=newSwimmingPool" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Swimming Pool
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

                <!-- Swimming Pools Table Card -->
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
                                        <th>Pool Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Capacity</th>
                                        <th>Instructor</th>
                                        <th>Lifeguard</th>
                                        <th>Opening Time</th>
                                        <th>Closing Time</th>
					<th>Access Type</th>
					<th>Max Charge</th>
            				<th>Price per Hour</th>
            				<th>Price per Day</th>
            				<th>Safety Rules</th>
            				<th>Terms & Conditions</th>
            				<th>Instructions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pools)): ?>
                                        <?php foreach ($pools as $pool): ?>
                                            <tr>
                                                <td><?= $pool['id'] ?></td>
                                                <td><?= htmlspecialchars($pool['location_name'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($pool['name']) ?></td>
                                                <td><?= htmlspecialchars($pool['type'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($pool['status']) ?></td>
                                                <td><?= htmlspecialchars($pool['capacity'] ?? '-') ?></td>
                                                <td><?= $pool['instructor_available'] ? 'Yes' : 'No' ?></td>
                                                <td><?= $pool['lifeguard_available'] ? 'Yes' : 'No' ?></td>
                                                <td><?= htmlspecialchars($pool['opening_time'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($pool['closing_time'] ?? '-') ?></td>
						<td><?= htmlspecialchars($pool['access_type'] ?? '-') ?></td>
            					<td><?= htmlspecialchars($pool['max_charge'] ?? '-') ?></td>
           					<td><?= htmlspecialchars($pool['price_per_hour'] ?? '-') ?></td>
           					<td><?= htmlspecialchars($pool['price_per_day'] ?? '-') ?></td>
           					<td><?= htmlspecialchars($pool['safety_rules'] ?? '-') ?></td>
           					<td><?= htmlspecialchars($pool['terms_conditions'] ?? '-') ?></td>
            					<td><?= htmlspecialchars($pool['instructions'] ?? '-') ?></td>
                                                <td>
                                                    <!-- Edit button -->
                                                    <a class="btn btn-sm btn-warning" 
                                                       href="<?= BASE_URL ?>/admin.php?action=editSwimmingPool&id=<?= $pool['id'] ?>">
                                                       <i class="bi bi-pencil-square"></i> Edit
                                                    </a>

                                                    <!-- Delete button -->
                                                    <form method="get" action="<?= BASE_URL ?>/admin.php" style="display:inline-block; margin:0 4px;"
                                                          onsubmit="return confirm('Are you sure you want to delete this swimming pool?');">
                                                        <input type="hidden" name="action" value="manageSwimmingPools">
                                                        <input type="hidden" name="delete" value="<?= $pool['id'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="11" class="text-center">No swimming pools found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination controls -->
                        <nav aria-label="Swimming Pool pagination">
                            <ul class="pagination justify-content-center align-items-center">

                                <!-- Previous -->
                                <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                     <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageSwimmingPools&page=<?= max(1, $currentPage - 1) ?>">Previous</a>
                                </li>

                                <!-- Numbers -->
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                     <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                                         <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageSwimmingPools&page=<?= $i ?>"><?= $i ?></a>
                                     </li>
                                <?php endfor; ?>

                                <!-- Next -->
                                <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                     <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageSwimmingPools&page=<?= min($totalPages, $currentPage + 1) ?>">Next</a>
                                </li>

                                <!-- Dropdown + Go button -->
                                <li class="page-item ms-2">
                                    <form method="get" action="<?= BASE_URL ?>/admin.php" class="d-flex">
                                        <input type="hidden" name="action" value="manageSwimmingPools">
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
                <!-- End of Swimming Pools Table Card -->

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
