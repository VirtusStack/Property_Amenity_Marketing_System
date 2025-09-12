<?php
// ----------------------------
// includes/sidebar.php
// ----------------------------
// Sidebar navigation for Admin / Manager / Customer dashboards
// Uses BASE_URL from config.php to make all links absolute and reliable

// Make sure BASE_URL is defined
if (!defined('BASE_URL')) {
    // fallback if config.php not included
    define('BASE_URL', '/Property_Amenity_Marketing_System');
}

// Check if $currentUserRole is set, else default to "Guest"
if (!isset($currentUserRole)) {
    $currentUserRole = "Guest";
}
?>

<aside class="sidebar">
    <!-- Sidebar Title -->
    <h3>Navigation</h3>

    <ul>
        <!-- DASHBOARD -->
        <li><a href="<?= BASE_URL ?>/admin/index.php">Dashboard</a></li>

        <?php if ($currentUserRole === "Admin"): ?>
            <!-- USERS (CRUD) -->
            <li>
                <strong>Users</strong>
                <ul>
                    <li><a href="<?= BASE_URL ?>/core/users/add.php">Add User</a></li>
                    <li><a href="<?= BASE_URL ?>/core/users/manage.php">View / Manage Users</a></li>
                </ul>
            </li>

            <!-- PROPERTIES (CRUD) -->
            <li>
                <strong>Properties</strong>
                <ul>
                    <li><a href="<?= BASE_URL ?>/core/properties/add.php">Add Property</a></li>
                    <li><a href="<?= BASE_URL ?>/core/properties/manage.php">View / Manage Properties</a></li>
                </ul>
            </li>

            <!-- ROLES (CRUD) -->
            <li>
                <strong>Roles</strong>
                <ul>
                    <li><a href="<?= BASE_URL ?>/core/roles/add.php">Add Role</a></li>
                    <li><a href="<?= BASE_URL ?>/core/roles/manage.php">View / Manage Roles</a></li>
                </ul>
            </li>
        <?php endif; ?>

        <!-- PLUGINS (visible to all roles for now) -->
        <li><a href="<?= BASE_URL ?>/plugins/spa/views/spa_booking.php">Spa</a></li>
        <li><a href="<?= BASE_URL ?>/plugins/pool/views/pool_booking.php">Pool</a></li>
        <li><a href="<?= BASE_URL ?>/plugins/food/views/food_order.php">Food</a></li>
        <li><a href="<?= BASE_URL ?>/plugins/gym/views/gym_booking.php">Gym</a></li>
        <li><a href="<?= BASE_URL ?>/plugins/salon/views/salon_booking.php">Salon</a></li>
        <li><a href="<?= BASE_URL ?>/plugins/parking/views/parking_manage.php">Parking</a></li>
        <li><a href="<?= BASE_URL ?>/plugins/combo/views/combo_offers.php">Combo Packages</a></li>
        <li><a href="<?= BASE_URL ?>/plugins/notifications/routes.php">Notifications</a></li>
    </ul>
</aside>
