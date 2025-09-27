<?php
// /templates/admin/index.php

// ADMIN DASHBOARD MAIN PAGE
require_once __DIR__ . '/../../config/config.php';

// Simulated logged-in admin
$currentUserName = "Super Admin";
$currentUserRole = "Admin";
?>

<!-- Load Header -->
<?php include_once __DIR__ . '/../../templates/include/header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include_once __DIR__ . '/../../templates/include/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include_once __DIR__ . '/../../templates/include/topbar.php'; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Greeting -->
                <div class="mb-4">
                    <h1 class="h3 text-gray-800">Welcome, <?= htmlspecialchars($currentUserName) ?></h1>
                    <p>You are logged in as <strong><?= htmlspecialchars($currentUserRole) ?></strong>.</p>
                </div>

                <!-- Dashboard Cards -->
                <div class="row">

                    <!-- Users Card -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="card-title"><i class="fas fa-users"></i> Users</div>
                                <div class="card-text">
                                    <!-- ✅ Controller-based links -->
                                    <p><a href="<?= BASE_URL ?>/admin.php?action=manageUsers">Manage Users</a></p>
                                    <p><a href="<?= BASE_URL ?>/admin.php?action=newUser">Add User</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Companies Card -->
    		     <div class="col-xl-4 col-md-6 mb-4">
        	        <div class="card border-left-warning shadow h-100 py-2">
            		   <div class="card-body">
                	     <div class="card-title"><i class="fas fa-city"></i> Companies</div>
                	     <div class="card-text">
                    		<!-- ✅ Controller-based links -->
                   	        <p><a href="<?= BASE_URL ?>/admin.php?action=manageCompanies">Manage Companies</a></p>
                    		<p><a href="<?= BASE_URL ?>/admin.php?action=newCompany">Add Company</a></p>
                	    </div>
           	        </div>
       	            </div>
                </div>


                    <!-- Roles Card -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="card-title"><i class="fas fa-key"></i> Roles</div>
                                <div class="card-text">
                                    <p><a href="<?= BASE_URL ?>/admin.php?action=manageRoles">Manage Roles</a></p>
                                    <p><a href="<?= BASE_URL ?>/admin.php?action=newRole">Add Role</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                    <!-- Properties Card -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="card-title"><i class="fas fa-building"></i> Properties</div>
                                <div class="card-text">
                                    <p><a href="<?= BASE_URL ?>/admin.php?action=manageProperties">Manage Properties</a></p>
                                    <p><a href="<?= BASE_URL ?>/admin.php?action=newProperty">Add Property</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Dashboard Cards -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once __DIR__ . '/../../templates/include/footer.php'; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
