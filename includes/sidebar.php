<?php
// includes/sidebar.php
// Sidebar navigation for Admin / Manager / Customer dashboards
$currentUserRole = "Admin";
?>

<aside class="sidebar">
    <!-- Sidebar Title -->
    <h3>Navigation</h3>

    <ul>
        <!-- DASHBOARD -->
        <li><a href="/admin/index.php">Dashboard</a></li>

        <?php if ($currentUserRole === "Admin"): ?>
            <!-- USERS (CRUD) -->
            <li>
                <strong>Users</strong>
                <ul>
                    <li><a href="/core/users/add.php"> Add User</a></li>
                    <li><a href="/core/users/manage.php"> View / Manage Users</a></li>
                </ul>
            </li>

            <!-- PROPERTIES (CRUD) -->
            <li>
                <strong>Properties</strong>
                <ul>
                    <li><a href="/core/properties/add.php">Add Property</a></li>
                    <li><a href="/core/properties/manage.php"> View / Manage Properties</a></li>
                </ul>
            </li>

            <!-- ROLES (CRUD) -->
            <li>
                <strong>Roles</strong>
                <ul>
                    <li><a href="/core/roles/add.php"> Add Role</a></li>
                    <li><a href="/core/roles/manage.php"> View / Manage Roles</a></li>
                </ul>
            </li>
        <?php endif; ?>

        <!-- PLUGINS (visible to all roles for now) -->
        <li><a href="/plugins/spa/views/spa_booking.php">Spa</a></li>
        <li><a href="/plugins/pool/views/pool_booking.php">Pool</a></li>
        <li><a href="/plugins/food/views/food_order.php">Food</a></li>
        <li><a href="/plugins/gym/views/gym_booking.php">Gym</a></li>
        <li><a href="/plugins/salon/views/salon_booking.php">Salon</a></li>
        <li><a href="/plugins/parking/views/parking_manage.php">Parking</a></li>
        <li><a href="/plugins/combo/views/combo_offers.php">Combo Packages</a></li>
        <li><a href="/plugins/notifications/routes.php">Notifications</a></li>
    </ul>
</aside>
