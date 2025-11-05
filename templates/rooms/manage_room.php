<?php
// MANAGE ROOMS TEMPLATE

$results = $results ?? [
    'pageTitle'   => 'Manage Rooms',
    'message'     => '',
    'rooms'       => [],
    'currentPage' => 1,
    'totalPages'  => 1,
    'total'       => 0,
    'perPage'     => 25
];

$rooms       = $results['rooms'];
$currentPage = (int)($results['currentPage'] ?? 1);
$totalPages  = (int)($results['totalPages'] ?? 1);
$total       = (int)($results['total'] ?? count($rooms));
$perPage     = (int)($results['perPage'] ?? count($rooms));
?>

<?php include __DIR__ . "/../include/header.php"; ?>

<div id="wrapper">

    <?php include __DIR__ . "/../include/sidebar.php"; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <?php include __DIR__ . "/../include/topbar.php"; ?>

            <div class="container-fluid">

                <!-- Page Heading + Add Room Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>
                    <a href="<?= BASE_URL ?>/admin.php?action=newRoom" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Room
                    </a>
                </div>

                <!-- Feedback -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= (stripos($results['message'], 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= (stripos($results['message'], 'success') !== false) ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <!-- Rooms Table -->
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
                                        <th>Room Name</th>
                                        <th>Type</th>
                                        <th>View</th>
                                        <th>Max Occ.</th>
                                        <th>Inventory</th>
                                        <th>Base Price</th>
                                        <th>GST %</th>
                                        <th>Final Price</th>
                                        <th>Notes</th>
                                        <th>Terms & Conditions</th>
                                        <th>Facilities</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($rooms)): ?>
                                    <?php foreach ($rooms as $room): ?>
                                        <?php
                                            $base = floatval($room['base_price_per_night'] ?? 0);
                                            $gstPercent = floatval($room['gst_percent'] ?? 0);
                                            $gstType = $room['gst_inclusive'] ?? 'exclusive';

                                            // Calculate final price
                                            if ($gstType === 'inclusive') {
                                                $final = $base;
                                                $gstLabel = '<span class="badge bg-success">Incl. GST</span>';
                                            } else {
                                                $final = $base + ($base * $gstPercent / 100);
                                                $gstLabel = '<span class="badge bg-info">+ GST</span>';
                                            }
                                        ?>
                                        <tr>
                                            <td><?= $room['room_id'] ?></td>
                                            <td><?= htmlspecialchars($room['company_name'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($room['location_name'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($room['room_name']) ?></td>
                                            <td><?= htmlspecialchars($room['room_type'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($room['room_view'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($room['max_occupancy'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($room['total_inventory'] ?? '-') ?></td>

                                            <!-- Base Price -->
                                            <td>
                                                ₹<?= number_format($base, 2) ?><br>
                                                <?= $gstLabel ?>
                                            </td>

                                            <!-- GST % -->
                                            <td><?= htmlspecialchars($gstPercent) ?>%</td>

                                            <!-- Final Price -->
                                            <td>
                                                <strong>₹<?= number_format($final, 2) ?></strong>
                                            </td>

                                            <td><?= htmlspecialchars($room['notes'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($room['terms_conditions'] ?? '-') ?></td>

                                            <!-- Facilities -->
                                            <td>
                                                <?php
                                                    $facilities = Room::getFacilities($pdo, $room['room_id']);
                                                    if ($facilities) {
                                                        $names = array_map(fn($f) => htmlspecialchars($f['facility_name']), $facilities);
                                                        echo implode(', ', $names);
                                                    } else {
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>

                                            <!-- Status -->
                                            <td>
                                                <?php if ($room['status'] === 'active'): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php elseif ($room['status'] === 'inactive'): ?>
                                                    <span class="badge bg-secondary">Inactive</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">Maintenance</span>
                                                <?php endif; ?>
                                            </td>

                                            <!-- Actions -->
                                            <td>
                                                <a class="btn btn-sm btn-warning" href="<?= BASE_URL ?>/admin.php?action=editRoom&id=<?= $room['room_id'] ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form method="get" action="<?= BASE_URL ?>/admin.php" style="display:inline-block; margin:0 4px;"
                                                      onsubmit="return confirm('Are you sure you want to delete this room?');">
                                                    <input type="hidden" name="action" value="manageRooms">
                                                    <input type="hidden" name="delete" value="<?= $room['room_id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="15" class="text-center">No rooms found.</td></tr>
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
                                        <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRooms&page=<?= max(1, $currentPage - 1) ?>">
                                            <i class="fas fa-angle-left"></i> Prev
                                        </a>
                                    </li>

                                    <!-- First + Ellipsis -->
                                    <?php if ($currentPage > 3): ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRooms&page=1">1</a></li>
                                        <?php if ($currentPage > 4): ?><li class="page-item disabled"><span class="page-link">...</span></li><?php endif; ?>
                                    <?php endif; ?>

                                    <!-- Middle Pages -->
                                    <?php
                                    $start = max(1, $currentPage - 2);
                                    $end   = min($totalPages, $currentPage + 2);
                                    for ($i = $start; $i <= $end; $i++): ?>
                                        <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                                            <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRooms&page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <!-- Ellipsis + Last -->
                                    <?php if ($currentPage < $totalPages - 2): ?>
                                        <?php if ($currentPage < $totalPages - 3): ?><li class="page-item disabled"><span class="page-link">...</span></li><?php endif; ?>
                                        <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRooms&page=<?= $totalPages ?>"><?= $totalPages ?></a></li>
                                    <?php endif; ?>

                                    <!-- Next -->
                                    <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/admin.php?action=manageRooms&page=<?= min($totalPages, $currentPage + 1) ?>">
                                            Next <i class="fas fa-angle-right"></i>
                                        </a>
                                    </li>

                                    <!-- Go To Page -->
                                    <li class="page-item ms-3">
                                        <form method="get" action="<?= BASE_URL ?>/admin.php" class="form-inline">
                                            <input type="hidden" name="action" value="manageRooms">
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

            </div>
        </div>

        <?php include __DIR__ . "/../include/footer.php"; ?>
    </div>
</div>
