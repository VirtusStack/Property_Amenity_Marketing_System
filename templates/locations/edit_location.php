<?php
// /templates/locations/edit_location.php
// -------------------------
// View file: Displays Edit Location
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
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Edit Location' ?>
                </h1>

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

                <!-- Location Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- ✅ Form submits to admin.php?action=editLocation&id=XX -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=editLocation&id=<?= htmlspecialchars($results['location']['location_id']) ?>">

                            <!-- Company Dropdown -->
                            <div class="form-group mb-3">
                                <label>Company:</label>
                                <select name="company_id" class="form-control" required>
                                    <option value="">-- Select Company --</option>
                                    <?php foreach ($results['companies'] as $company): ?>
                                        <option value="<?= htmlspecialchars($company['company_id']) ?>"
                                            <?= ($company['company_id'] == $results['location']['company_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($company['company_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Location Name -->
                            <div class="form-group mb-3">
                                <label>Location Name:</label>
                                <input type="text" name="location_name" class="form-control" required
                                    value="<?= htmlspecialchars($results['location']['location_name'] ?? '') ?>">
                            </div>

                            <!-- Place -->
                            <div class="form-group mb-3">
                                <label>Place:</label>
                                <input type="text" name="place" class="form-control"
                                    value="<?= htmlspecialchars($results['location']['place'] ?? '') ?>">
                            </div>

                            <!-- Country -->
                            <div class="form-group mb-3">
                                <label>Country:</label>
                                <input type="text" name="country" class="form-control"
                                    value="<?= htmlspecialchars($results['location']['country'] ?? '') ?>">
                            </div>

                            <!-- State -->
                            <div class="form-group mb-3">
                                <label>State:</label>
                                <input type="text" name="state" class="form-control"
                                    value="<?= htmlspecialchars($results['location']['state'] ?? '') ?>">
                            </div>

                            <!-- City -->
                            <div class="form-group mb-3">
                                <label>City:</label>
                                <input type="text" name="city" class="form-control"
                                    value="<?= htmlspecialchars($results['location']['city'] ?? '') ?>">
                            </div>

                            <!-- Contact Number -->
                            <div class="form-group mb-3">
                                <label>Contact Number:</label>
                                <input type="text" name="contact_number" class="form-control"
                                    value="<?= htmlspecialchars($results['location']['contact_number'] ?? '') ?>">
                            </div>

                            <!-- Manager -->
                            <div class="form-group mb-3">
                                <label>Manager:</label>
                                <input type="text" name="manager" class="form-control"
                                    value="<?= htmlspecialchars($results['location']['manager'] ?? '') ?>">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update Location</button>
                            <a href="<?= BASE_URL ?>/admin.php?action=manageLocations" class="btn btn-secondary">Cancel</a>
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
