<?php
// /templates/users/manage_user.php
// View file: Displays all users in the admin panel
// Includes Company & Location info

// Ensure $results array exists and has required keys
$results = $results ?? [];
$results['pageTitle'] = $results['pageTitle'] ?? 'Manage Users';
$results['message']   = $results['message'] ?? '';
$results['users']     = $results['users'] ?? [];
?>

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
                <h1 class="h3 mb-4 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>

           <!-- Feedback message (success or error) -->
          <?php if (!empty($results['message'])): ?>
       <div class="alert <?= strpos($results['message'],'✅')!==false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                     <?= strpos($results['message'],'✅')!==false ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Users Table Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Check if users array is not empty -->
                                    <?php if (!empty($results['users'])): ?>
                                        <?php foreach ($results['users'] as $user): ?>
                                            <tr>
                                                <!-- Display user details safely -->
                                                <td><?= $user['user_id'] ?></td>
                                                <td><?= htmlspecialchars($user['name']) ?></td>
                                                <td><?= htmlspecialchars($user['email']) ?></td>
                                                <td><?= htmlspecialchars($user['role_name'] ?? 'No role assigned') ?></td>
                                                <td>
                                                    <?php
                                                    $companyName = $pdo->prepare("SELECT company_name FROM companies WHERE company_id=?");
                                                    $companyName->execute([$user['company_id']]);
                                                    echo htmlspecialchars($companyName->fetchColumn() ?? 'N/A');
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($user['location_id'])) {
                                                        $locationName = $pdo->prepare("SELECT location_name FROM locations WHERE location_id=?");
                                                        $locationName->execute([$user['location_id']]);
                                                        echo htmlspecialchars($locationName->fetchColumn() ?? 'N/A');
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $user['created_at'] ?></td>
                                                <td>
                             <!-- Edit button -->
                             <a class="btn btn-sm btn-primary" href="<?= BASE_URL ?>/admin.php?action=editUser&id=<?= $user['user_id'] ?>">Edit</a>
                             <!-- Delete button with confirmation -->
                             <a class="btn btn-sm btn-danger" href="<?= BASE_URL ?>/admin.php?action=manageUsers&delete=<?= $user['user_id'] ?>"
                                                       onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <!-- No users found -->
                                        <tr><td colspan="8">No users found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div> <!-- End table-responsive -->
                    </div> <!-- End card-body -->
                </div> <!-- End card -->

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
