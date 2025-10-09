<?php
// /templates/rooms/edit_room.php

require_once __DIR__ . '/../../config/config.php';
?>
<?php include __DIR__ . "/../include/header.php"; ?>

<div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . "/../include/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Topbar -->
            <?php include __DIR__ . "/../include/topbar.php"; ?>
            <!-- End Topbar -->

            <div class="container-fluid">

                <h1 class="h3 mb-4 text-gray-800">
                    <?= $results['pageTitle'] ?? 'Edit Room' ?>
                </h1>

                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= (stripos($results['message'], 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= (stripos($results['message'], 'success') !== false) ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=editRoom&id=<?= htmlspecialchars($results['room']['room_id']) ?>">

                            <!-- Location Dropdown -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" class="form-control" required>
                                    <option value="">-- Select Location --</option>
                                    <?php foreach ($results['locations'] as $location): ?>
                                        <option value="<?= $location['location_id'] ?>"
                                            <?= ($location['location_id'] == $results['room']['location_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($location['company_name'] . ' → ' . $location['location_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Room Name -->
                            <div class="form-group mb-3">
                                <label>Room Name:</label>
                                <input type="text" name="room_name" class="form-control" required
                                       value="<?= htmlspecialchars($results['room']['room_name'] ?? '') ?>">
                            </div>

                            <!-- Room Type -->
                            <div class="form-group mb-3">
                                <label>Room Type:</label>
                                <input type="text" name="room_type" class="form-control"
                                       value="<?= htmlspecialchars($results['room']['room_type'] ?? '') ?>">
                            </div>

                            <!-- Room View -->
                            <div class="form-group mb-3">
                                <label>Room View:</label>
                                <input type="text" name="room_view" class="form-control"
                                       value="<?= htmlspecialchars($results['room']['room_view'] ?? '') ?>">
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control"><?= htmlspecialchars($results['room']['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Base Price -->
                            <div class="form-group mb-3">
                                <label>Base Price per Night:</label>
                                <input type="number" name="base_price_per_night" class="form-control" step="0.01"
                                       value="<?= htmlspecialchars($results['room']['base_price_per_night'] ?? 0) ?>">
                            </div>

                            <!-- GST Percent -->
                            <div class="form-group mb-3">
                                <label>GST (%):</label>
                                <input type="number" name="gst_percent" class="form-control" step="0.01"
                                       value="<?= htmlspecialchars($results['room']['gst_percent'] ?? 0) ?>">
                            </div>

                            <!-- Total Inventory -->
                            <div class="form-group mb-3">
                                <label>Total Inventory:</label>
                                <input type="number" name="total_inventory" class="form-control"
                                       value="<?= htmlspecialchars($results['room']['total_inventory'] ?? 0) ?>">
                            </div>

                            <!-- Max Occupancy -->
                            <div class="form-group mb-3">
                                <label>Max Occupancy:</label>
                                <input type="number" name="max_occupancy" class="form-control"
                                       value="<?= htmlspecialchars($results['room']['max_occupancy'] ?? 1) ?>">
                            </div>

                            <!-- Notes -->
                            <div class="form-group mb-3">
                                <label>Notes:</label>
                                <textarea name="notes" class="form-control"><?= htmlspecialchars($results['room']['notes'] ?? '') ?></textarea>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="form-group mb-3">
                                <label>Terms & Conditions:</label>
                                <textarea name="terms_conditions" class="form-control"><?= htmlspecialchars($results['room']['terms_conditions'] ?? '') ?></textarea>
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= ($results['room']['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= ($results['room']['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>

                            <!-- Facilities -->
                            <div class="form-group mb-3">
                                <label>Facilities:</label>
                                <div class="row">
                                    <?php foreach ($results['facilities'] as $facility): ?>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" name="facilities[]" value="<?= $facility['facility_id'] ?>"
                                                    class="form-check-input"
                                                    <?= in_array($facility['facility_id'], $results['room']['facilities']) ? 'checked' : '' ?>>
                                                <label class="form-check-label"><?= htmlspecialchars($facility['name']) ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Room</button>
                            <a href="<?= BASE_URL ?>/admin.php?action=manageRooms" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>

            </div>

        </div>
        <!-- End Main Content -->

        <?php include __DIR__ . "/../include/footer.php"; ?>

    </div>
</div>
