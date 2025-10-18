<?php
// /templates/swimming_pools/add_swimming_pool.php
// -------------------------
// View file: Displays Add Swimming Pool form
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
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Add Swimming Pool' ?>
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

                <!-- Swimming Pool Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Form submits to admin.php?action=newSwimmingPool -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=newSwimmingPool">

                            <!-- Location Dropdown -->
                            <!-- Location -->
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

                            <!-- Pool Name -->
                            <div class="form-group mb-3">
                                <label>Pool Name:</label>
                                <input type="text" name="name" class="form-control" required
                                       value="<?= htmlspecialchars($results['name'] ?? '') ?>">
                            </div>

                            <!-- Pool Type -->
                            <div class="form-group mb-3">
                                <label>Type:</label>
                                <input type="text" name="type" class="form-control"
                                       value="<?= htmlspecialchars($results['type'] ?? '') ?>" placeholder="Indoor, Outdoor, Heated, Infinity">
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= (isset($results['status']) && $results['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= (isset($results['status']) && $results['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>

                            <!-- Capacity -->
                            <div class="form-group mb-3">
                                <label>Capacity:</label>
                                <input type="number" name="capacity" class="form-control"
                                       value="<?= htmlspecialchars($results['capacity'] ?? '') ?>">
                            </div>

                            <!-- Instructor Available -->
                            <div class="form-group mb-3">
                                <label>Instructor Available:</label>
                                <select name="instructor_available" class="form-control">
                                    <option value="1" <?= (isset($results['instructor_available']) && $results['instructor_available']) ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= (isset($results['instructor_available']) && !$results['instructor_available']) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <!-- Lifeguard Available -->
                            <div class="form-group mb-3">
                                <label>Lifeguard Available:</label>
                                <select name="lifeguard_available" class="form-control">
                                    <option value="1" <?= (isset($results['lifeguard_available']) && $results['lifeguard_available']) ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= (isset($results['lifeguard_available']) && !$results['lifeguard_available']) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <!-- Opening Time -->
                            <div class="form-group mb-3">
                                <label>Opening Time:</label>
                                <input type="time" name="opening_time" class="form-control"
                                       value="<?= htmlspecialchars($results['opening_time'] ?? '') ?>">
                            </div>

                            <!-- Closing Time -->
                            <div class="form-group mb-3">
                                <label>Closing Time:</label>
                                <input type="time" name="closing_time" class="form-control"
                                       value="<?= htmlspecialchars($results['closing_time'] ?? '') ?>">
                            </div>

                            <!-- Access Type -->
                            <div class="form-group mb-3">
                                <label>Access Type:</label>
                                <input type="text" name="access_type" class="form-control"
                                       value="<?= htmlspecialchars($results['access_type'] ?? '') ?>" placeholder="Public, Private, Guests only">
                            </div>

                            <!-- Maximum Charge -->
                            <div class="form-group mb-3">
                                <label>Maximum Charge:</label>
                                <input type="number" step="0.01" name="max_charge" class="form-control"
                                       value="<?= htmlspecialchars($results['max_charge'] ?? '') ?>">
                            </div>

                            <!-- Price per Hour -->
                            <div class="form-group mb-3">
                                <label>Price per Hour:</label>
                                <input type="number" step="0.01" name="price_per_hour" class="form-control"
                                       value="<?= htmlspecialchars($results['price_per_hour'] ?? '') ?>">
                            </div>

                            <!-- Price per Day -->
                            <div class="form-group mb-3">
                                <label>Price per Day:</label>
                                <input type="number" step="0.01" name="price_per_day" class="form-control"
                                       value="<?= htmlspecialchars($results['price_per_day'] ?? '') ?>">
                            </div>

                            <!-- Safety Rules -->
                            <div class="form-group mb-3">
                                <label>Safety Rules:</label>
                                <textarea name="safety_rules" class="form-control" rows="3"><?= htmlspecialchars($results['safety_rules'] ?? '') ?></textarea>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="form-group mb-3">
                                <label>Terms & Conditions:</label>
                                <textarea name="terms_conditions" class="form-control" rows="3"><?= htmlspecialchars($results['terms_conditions'] ?? '') ?></textarea>
                            </div>

                            <!-- Instructions -->
                            <div class="form-group mb-3">
                                <label>Instructions:</label>
                                <textarea name="instructions" class="form-control" rows="3"><?= htmlspecialchars($results['instructions'] ?? '') ?></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Add Swimming Pool</button>

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
