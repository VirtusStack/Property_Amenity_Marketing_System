<?php
// /templates/restaurants/edit_restaurant.php
// -------------------------
// View file: Displays Edit Restaurant/Menu form

require_once __DIR__ . '/../../config/config.php';
?>
<?php include __DIR__ . "/../include/header.php"; ?>

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
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Edit Restaurant/Menu' ?>
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

                <!-- Restaurant Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- ✅ Form submits to admin.php?action=editRestaurant&id= -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=editRestaurant&id=<?= $results['restaurant']['restaurant_id'] ?>">

                            <!-- Location Dropdown -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" class="form-control" required>
                                    <option value="">Select Location</option>
                                    <?php foreach ($results['locations'] as $loc): ?>
					  <?php if (empty($loc['location_name'])) continue; ?> 
                                        <option value="<?= $loc['location_id'] ?>" <?= (isset($results['restaurant']['location_id']) && $results['restaurant']['location_id'] == $loc['location_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($loc['location_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Restaurant Name -->
                            <div class="form-group mb-3">
                                <label>Restaurant Name:</label>
                                <input type="text" name="restaurant_name" class="form-control" required
                                       value="<?= htmlspecialchars($results['restaurant']['restaurant_name'] ?? '') ?>">
                            </div>

                            <!-- Menu Date -->
                            <div class="form-group mb-3">
                                <label>Menu Date:</label>
                                <input type="date" name="menu_date" class="form-control" required
                                       value="<?= htmlspecialchars($results['restaurant']['menu_date'] ?? '') ?>">
                            </div>

                            <!-- Meal Type -->
                            <div class="form-group mb-3">
                                <label>Meal Type:</label>
                                <select name="meal_type" class="form-control" required>
                                    <option value="">Select Meal Type</option>
                                    <option value="lunch" <?= (isset($results['restaurant']['meal_type']) && $results['restaurant']['meal_type']=='lunch') ? 'selected' : '' ?>>Lunch</option>
                                    <option value="dinner" <?= (isset($results['restaurant']['meal_type']) && $results['restaurant']['meal_type']=='dinner') ? 'selected' : '' ?>>Dinner</option>
                                    <option value="buffet" <?= (isset($results['restaurant']['meal_type']) && $results['restaurant']['meal_type']=='buffet') ? 'selected' : '' ?>>Buffet</option>
                                </select>
                            </div>

                            <!-- Menu Name -->
                            <div class="form-group mb-3">
                                <label>Menu Name:</label>
                                <input type="text" name="menu_name" class="form-control"
                                       value="<?= htmlspecialchars($results['restaurant']['menu_name'] ?? '') ?>">
                            </div>

                            <!-- Number of Dishes -->
                            <div class="form-group mb-3">
                                <label>No. of Dishes:</label>
                                <input type="number" name="no_of_dishes" class="form-control"
                                       value="<?= htmlspecialchars($results['restaurant']['no_of_dishes'] ?? 10) ?>">
                            </div>

                            <!-- Base Price -->
                            <div class="form-group mb-3">
                                <label>Base Price:</label>
                                <input type="number" step="0.01" name="base_price" class="form-control"
                                       value="<?= htmlspecialchars($results['restaurant']['base_price'] ?? 0.0) ?>">
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control"><?= htmlspecialchars($results['restaurant']['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= (isset($results['restaurant']['status']) && $results['restaurant']['status']=='active') ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= (isset($results['restaurant']['status']) && $results['restaurant']['status']=='inactive') ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                           <button type="submit" class="btn btn-primary">Update Restaurant/Menu</button>
                            <a href="<?= BASE_URL ?>/admin.php?action=manageRestaurant" class="btn btn-secondary">Cancel</a>
                        </form>

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
