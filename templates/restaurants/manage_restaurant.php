<?php
// -------------------------
// MANAGE RESTAURANTS TEMPLATE
// -------------------------

$results = $results ?? [
    'pageTitle'   => 'Manage Restaurants / Menus',
    'message'     => '',
    'restaurants' => [],
    'currentPage' => 1,
    'totalPages'  => 1,
    'total'       => 0,
    'perPage'     => 25
];

$restaurants = $results['restaurants'];
$currentPage = (int)($results['currentPage'] ?? 1);
$totalPages  = (int)($results['totalPages'] ?? 1);
$total       = (int)($results['total'] ?? count($restaurants));
$perPage     = (int)($results['perPage'] ?? count($restaurants));
?>

<?php include __DIR__ . "/../include/header.php"; ?>

<div id="wrapper">

    <?php include __DIR__ . "/../include/sidebar.php"; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <?php include __DIR__ . "/../include/topbar.php"; ?>

            <div class="container-fluid">

                <!-- Page Heading + Add Restaurant Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>
                    <a href="<?= BASE_URL ?>/admin.php?action=newRestaurant" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Restaurant
                    </a>
                </div>

                <!-- Feedback Message -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= (stripos($results['message'], 'deleted') === false && stripos($results['message'], 'error') === false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <!-- Restaurants Table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Location</th>
                                        <th>Restaurant Name</th> <!-- Added -->
                                        <th>Menu Date</th>
                                        <th>Meal Type</th>
                                        <th>Menu Name</th>
                                        <th>No. of Dishes</th>
                                        <th>Base Price</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php if (!empty($restaurants)): ?>
                                    <?php foreach ($restaurants as $r): ?>
                                        <tr>
                                            <td><?= (int)$r['restaurant_id'] ?></td>
                                            <td><?= htmlspecialchars($r['location_name'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($r['restaurant_name'] ?? '-') ?></td> <!-- Display -->
                                            <td><?= htmlspecialchars($r['menu_date'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars(ucfirst($r['meal_type'] ?? '-')) ?></td>
                                            <td><?= htmlspecialchars($r['menu_name'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($r['no_of_dishes'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($r['base_price'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($r['description'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars(ucfirst($r['status'] ?? 'Inactive')) ?></td>
                                            <td>
                                                <a class="btn btn-sm btn-warning" href="<?= BASE_URL ?>/admin.php?action=editRestaurant&id=<?= $r['restaurant_id'] ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form method="get" action="<?= BASE_URL ?>/admin.php" style="display:inline-block; margin:0 4px;"
                                                      onsubmit="return confirm('Are you sure you want to delete this restaurant?');">
                                                    <input type="hidden" name="action" value="manageRestaurants">
                                                    <input type="hidden" name="delete" value="<?= $r['restaurant_id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="11" class="text-center">No restaurants found.</td></tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Section -->
                        <nav aria-label="Restaurant pagination">
                            <ul class="pagination justify-content-center align-items-center">
                                <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRestaurants&page=<?= max(1, $currentPage - 1) ?>">Previous</a>
                                </li>

                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRestaurants&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRestaurants&page=<?= min($totalPages, $currentPage + 1) ?>">Next</a>
                                </li>

                                <li class="page-item ms-2">
                                    <form method="get" action="<?= BASE_URL ?>/admin.php" class="d-flex">
                                        <input type="hidden" name="action" value="manageRestaurants">
                                        <select name="page" class="form-select form-select-sm me-1">
                                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                <option value="<?= $i ?>" <?= ($i === $currentPage) ? 'selected' : '' ?>>Page <?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">Go</button>
                                    </form>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>

            </div>
        </div>
        <?php include __DIR__ . "/../include/footer.php"; ?>
    </div>
</div>
