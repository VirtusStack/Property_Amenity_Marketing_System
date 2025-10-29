<?php
// /templates/area/edit_area.php
// -------------------------
// View file: Displays Edit Area (Spa, Gym, Play Area, Banquet Hall, etc.)
// -------------------------

require_once __DIR__ . '/../../config/config.php';
?>
<?php include __DIR__ . "/../include/header.php"; ?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . "/../include/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include __DIR__ . "/../include/topbar.php"; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Edit Area' ?>
                </h1>

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

                <!-- Area Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Form submits to admin.php?action=editArea&id=XX -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=editArea&id=<?= htmlspecialchars($results['area']['area_id']) ?>">

                            <!-- Location Dropdown -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" id="location_id" class="form-control" required>
                                    <option value="">Select Location</option>
                                    <?php foreach($results['locations'] as $l): ?>
                                        <option value="<?= $l['location_id'] ?>" <?= ($l['location_id'] == $results['area']['location_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($l['company_name'] . " → " . $l['location_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Area Name -->
                            <div class="form-group mb-3">
                                <label>Area Name:</label>
                                <input type="text" name="area_name" class="form-control" required
                                    value="<?= htmlspecialchars($results['area']['area_name'] ?? '') ?>">
                            </div>

                            <!-- Area Type -->
                            <div class="form-group mb-3">
                                <label>Area Type:</label>
                                <select name="plugin_type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="spa" <?= ($results['area']['plugin_type'] ?? '') == 'spa' ? 'selected' : '' ?>>Spa</option>
                                    <option value="gym" <?= ($results['area']['plugin_type'] ?? '') == 'gym' ? 'selected' : '' ?>>Gym</option>
                                    <option value="play_area" <?= ($results['area']['plugin_type'] ?? '') == 'play_area' ? 'selected' : '' ?>>Play Area</option>
                                    <option value="banquet_hall" <?= ($results['area']['plugin_type'] ?? '') == 'banquet_hall' ? 'selected' : '' ?>>Banquet Hall</option>
                                    <option value="conference_room" <?= ($results['area']['plugin_type'] ?? '') == 'conference_room' ? 'selected' : '' ?>>Conference Room</option>
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($results['area']['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= ($results['area']['status'] ?? '') == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= ($results['area']['status'] ?? '') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>

                            <!-- Submit & Cancel Buttons -->
                            <button type="submit" class="btn btn-primary">Update Area</button>
                            <a href="<?= BASE_URL ?>/admin.php?action=manageAreas" class="btn btn-secondary">Cancel</a>

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
