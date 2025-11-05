<?php
// -------------------------
// MANAGE ROLES TEMPLATE
// -------------------------
// Displays all roles with Edit/Delete actions
// Uses same format & pagination style as Manage Users
// -------------------------

$results = $results ?? [
    'pageTitle'   => 'Manage Roles',
    'message'     => '',
    'roles'       => [],
    'currentPage' => 1,
    'totalPages'  => 1,
    'total'       => 0,
    'perPage'     => 25
];

$roles        = $results['roles'];
$currentPage  = (int)($results['currentPage'] ?? 1);
$totalPages   = (int)($results['totalPages'] ?? 1);
$total        = (int)($results['total'] ?? count($roles));
$perPage      = (int)($results['perPage'] ?? count($roles));
$offset       = ($currentPage - 1) * $perPage;
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

                <!-- Page Heading with Add Role Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>
                    <a href="<?= BASE_URL ?>/admin.php?action=newRole" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Role
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

                <!-- Roles Table Card -->
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
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                        <th>Company</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($roles)): ?>
                                        <?php foreach ($roles as $role): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($role['role_id']) ?></td>
                                                <td><?= htmlspecialchars($role['role_name']) ?></td>
                                                <td>
                                                    <?= $role['can_create'] ? 'C ' : '' ?>
                                                    <?= $role['can_read'] ? 'R ' : '' ?>
                                                    <?= $role['can_update'] ? 'U ' : '' ?>
                                                    <?= $role['can_delete'] ? 'D ' : '' ?>
                                                </td>
                                                <td><?= htmlspecialchars($role['company_name'] ?? 'N/A') ?></td>
                                                <td>
                                                    <!-- Edit button -->
                                                    <a class="btn btn-sm btn-warning" href="<?= BASE_URL ?>/admin.php?action=editRole&id=<?= $role['role_id'] ?>">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </a>

                                                    <!-- Delete button -->
                                                    <form method="get" action="<?= BASE_URL ?>/admin.php" style="display:inline-block; margin:0 4px;"
                                                          onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                        <input type="hidden" name="action" value="manageRoles">
                                                        <input type="hidden" name="delete" value="<?= $role['role_id'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="5" class="text-center">No roles found.</td></tr>
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
                                        <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRoles&page=<?= max(1, $currentPage - 1) ?>">
                                            <i class="fas fa-angle-left"></i> Prev
                                        </a>
                                    </li>

                                    <!-- First + Ellipsis -->
                                    <?php if ($currentPage > 3): ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRoles&page=1">1</a></li>
                                        <?php if ($currentPage > 4): ?><li class="page-item disabled"><span class="page-link">...</span></li><?php endif; ?>
                                    <?php endif; ?>

                                    <!-- Middle Pages -->
                                    <?php
                                    $start = max(1, $currentPage - 2);
                                    $end   = min($totalPages, $currentPage + 2);
                                    for ($i = $start; $i <= $end; $i++): ?>
                                        <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                                            <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRoles&page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <!-- Ellipsis + Last -->
                                    <?php if ($currentPage < $totalPages - 2): ?>
                                        <?php if ($currentPage < $totalPages - 3): ?><li class="page-item disabled"><span class="page-link">...</span></li><?php endif; ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRoles&page=<?= $totalPages ?>"><?= $totalPages ?></a></li>
                                    <?php endif; ?>

                                    <!-- Next -->
                                    <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRoles&page=<?= min($totalPages, $currentPage + 1) ?>">
                                            Next <i class="fas fa-angle-right"></i>
                                        </a>
                                    </li>

                                    <!-- Go To Page -->
                                    <li class="page-item ms-3">
                                        <form method="get" action="<?= BASE_URL ?>/admin.php" class="form-inline">
                                            <input type="hidden" name="action" value="manageRoles">
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

            </div> <!-- /.container-fluid -->
        </div> <!-- End of Main Content -->

        <!-- Footer -->
        <?php include __DIR__ . "/../include/footer.php"; ?>
    </div> <!-- End of Content Wrapper -->

</div> <!-- End of Page Wrapper -->
