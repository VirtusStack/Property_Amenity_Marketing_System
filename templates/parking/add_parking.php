<?php
// /templates/parking/add_parking.php
// -------------------------
// View file: Displays Add Parking form
// -------------------------

require_once __DIR__ . '/../../config/config.php'; // Load global configuration
?>
<?php include __DIR__ . "/../include/header.php"; // Load header ?>

<div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . "/../include/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include __DIR__ . "/../include/topbar.php"; ?>
            <!-- End of Topbar -->

            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Add Parking' ?>
                </h1>

                <!-- Feedback message (Success / Error) -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= (stripos($results['message'], 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= (stripos($results['message'], 'success') !== false) ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Parking Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Form submits to admin.php?action=newParking -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=newParking">

                            <!-- Location Dropdown -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" id="location_id" class="form-control" required>
    				<option value="">Select Location</option>
   				 <?php foreach($results['locations'] as $l): ?>
        			<option value="<?= $l['location_id'] ?>" <?= (isset($results['location_id']) && $results['location_id']==$l['location_id'])?'selected':'' ?>>
            			<?= htmlspecialchars($l['company_name'] . " → " . $l['location_name']) ?>
        			</option>
    				<?php endforeach; ?>
				</select>

                            </div>

                            <!-- Parking Name -->
                            <div class="form-group mb-3">
                                <label>Parking Name:</label>
                                <input type="text" name="parking_name" class="form-control" required
                                       value="<?= htmlspecialchars($results['parking_name'] ?? '') ?>">
                            </div>

                            <!-- Parking Number -->
                            <div class="form-group mb-3">
                                <label>Parking Number:</label>
                                <input type="text" name="parking_number" class="form-control"
                                       value="<?= htmlspecialchars($results['parking_number'] ?? '') ?>" placeholder="e.g. P001, B2-12">
                            </div>

                            <!-- Vehicle Number -->
                            <div class="form-group mb-3">
                                <label>Vehicle Number:</label>
                                <input type="text" name="vehicle_number" class="form-control"
                                       value="<?= htmlspecialchars($results['vehicle_number'] ?? '') ?>" placeholder="e.g. MH12AB3456">
                            </div>

                            <!-- Type -->
                            <div class="form-group mb-3">
                                <label>Type:</label>
                                <select name="type" class="form-control">
                                    <?php
                                    $types = ['Car', 'Bike', 'Bus', 'Truck', 'All'];
                                    foreach ($types as $type): ?>
                                        <option value="<?= $type ?>" <?= (isset($results['type']) && $results['type'] == $type) ? 'selected' : '' ?>>
                                            <?= $type ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Capacity -->
                            <div class="form-group mb-3">
                                <label>Capacity:</label>
                                <input type="number" name="capacity" class="form-control"
                                       value="<?= htmlspecialchars($results['capacity'] ?? '') ?>" placeholder="e.g. 20">
                            </div>

                            <!-- Covered -->
                            <div class="form-group mb-3">
                                <label>Covered:</label>
                                <select name="is_covered" class="form-control">
                                    <option value="1" <?= (isset($results['is_covered']) && $results['is_covered']) ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= (isset($results['is_covered']) && !$results['is_covered']) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <!-- Charging Point Available -->
                            <div class="form-group mb-3">
                                <label>Charging Point Available:</label>
                                <select name="charging_point_available" class="form-control">
                                    <option value="1" <?= (isset($results['charging_point_available']) && $results['charging_point_available']) ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= (isset($results['charging_point_available']) && !$results['charging_point_available']) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="Available" <?= (isset($results['status']) && $results['status'] == 'Available') ? 'selected' : '' ?>>Available</option>
                                    <option value="Full" <?= (isset($results['status']) && $results['status'] == 'Full') ? 'selected' : '' ?>>Full</option>
                                    <option value="Maintenance" <?= (isset($results['status']) && $results['status'] == 'Maintenance') ? 'selected' : '' ?>>Maintenance</option>
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control" rows="3"
                                          placeholder="Short details about parking area"><?= htmlspecialchars($results['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Add Parking</button>

                        </form>
                    </div>
                </div>

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
