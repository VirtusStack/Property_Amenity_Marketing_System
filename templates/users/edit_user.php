<?php
// /templates/users/edit_user.php

// View file: Edit User form

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
                <h1 class="h3 mb-4 text-gray-800"><?= $results['pageTitle'] ?></h1>

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


                <!-- User Edit Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST">

                            <!-- Name input -->
                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" name="name" class="form-control"
                                    value="<?= htmlspecialchars($results['user']['name']) ?>" required>
                            </div>

                            <!-- Email input -->
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control"
                                    value="<?= htmlspecialchars($results['user']['email']) ?>" required>
                            </div>

                            <!-- Password input -->
                            <div class="mb-3">
                                <label class="form-label">New Password :</label>
                                <input type="password" name="password" class="form-control">
				<small class="text-muted">Leave blank to keep existing password.</small>
                            </div>

                            <!-- Role dropdown -->
                            <div class="mb-3">
                                <label class="form-label">Role:</label>
                                <select name="role_id" class="form-select" required>
                                    <?php
                                    $roles = $pdo->query("SELECT * FROM roles")->fetchAll();
                                    foreach ($roles as $role) {
                                        $selected = ($role['role_id'] == $results['user']['role_id']) ? "selected" : "";
                                        echo "<option value='{$role['role_id']}' $selected>{$role['role_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Company dropdown -->
                            <div class="mb-3">
                                <label class="form-label">Company:</label>
                                <select name="company_id" class="form-select" required>
                                    <?php
                                    $companies = $pdo->query("SELECT * FROM companies")->fetchAll();
                                    foreach ($companies as $company) {
                                        $selected = ($company['company_id'] == $results['user']['company_id']) ? "selected" : "";
                                        echo "<option value='{$company['company_id']}' $selected>{$company['company_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Location dropdown -->
                            <div class="mb-3">
                                <label class="form-label">Location (optional):</label>
                                <select name="location_id" class="form-select">
                                    <option value="">-- Select Location --</option>
                                    <?php
                                    $locations = $pdo->query("SELECT * FROM locations")->fetchAll();
                                    foreach ($locations as $location) {
                                        $selected = ($location['location_id'] == $results['user']['location_id']) ? "selected" : "";
                                        echo "<option value='{$location['location_id']}' $selected>{$location['location_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary">Update User</button>
			    <a href="<?= BASE_URL ?>/admin.php?action=manageUsers" class="btn btn-secondary">Cancel</a>
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
