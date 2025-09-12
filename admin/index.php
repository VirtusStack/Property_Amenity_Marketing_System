<?php
// ----------------------------
// ADMIN DASHBOARD MAIN PAGE
// ----------------------------
// Loads header, sidebar, and dashboard cards
// Currently simulating admin login (no authentication yet)

require_once __DIR__ . '/../config/config.php'; // load config and BASE_URL

$currentUserName = "Super Admin";
$currentUserRole = "Admin";
?>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container">
<main class="admin-page">
    
    <div class="admin-panel">

        <!-- Greeting Section -->
        <h2>Welcome, <?= htmlspecialchars($currentUserName) ?> </h2>
        <p>You are logged in as <strong><?= $currentUserRole ?></strong>.</p>

        <!-- Dashboard Cards Section -->
        <section class="dashboard-cards">

            <!-- Users Card -->
            <div class="card">
                <h3>👥 Users</h3>
                <p><a href="<?= BASE_URL ?>/core/users/manage.php">Manage Users</a></p>
                <p><a href="<?= BASE_URL ?>/core/users/add.php">Add User</a></p>
            </div>

            <!-- Roles Card -->
            <div class="card">
                <h3>🔑 Roles</h3>
                <p><a href="<?= BASE_URL ?>/core/roles/manage.php">Manage Roles</a></p>
                <p><a href="<?= BASE_URL ?>/core/roles/add.php">Add Role</a></p>
            </div>

            <!-- Properties Card -->
            <div class="card">
                <h3>🏨 Properties</h3>
                <p><a href="<?= BASE_URL ?>/core/properties/manage.php">Manage Properties</a></p>
                <p><a href="<?= BASE_URL ?>/core/properties/add.php">Add Property</a></p>
            </div>

            <!-- Plugins Card -->
            <div class="card">
                <h3>⚙️ Plugins</h3>
                <p><a href="<?= BASE_URL ?>/plugins/spa/views/spa_booking.php">Spa</a></p>
                <p><a href="<?= BASE_URL ?>/plugins/pool/views/pool_booking.php">Pool</a></p>
                <p><a href="<?= BASE_URL ?>/plugins/food/views/food_order.php">Food</a></p>
            </div>

        </section>

        <!-- Admin panel messages or notifications -->
        <div class="admin-messages">
            <!-- Example message -->
            <p class="form-message success">You have successfully logged in!</p>
        </div>

    </div> <!-- /.admin-panel -->
<?php include_once __DIR__ . '/../includes/sidebar.php'; ?>
</main>

</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
