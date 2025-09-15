<?php
// includes/sidebar.php
if (!isset($currentUserRole)) {
    $currentUserRole = "Guest";
}
?>
<aside class="col-md-3 col-lg-2 bg-light sidebar p-3">
    <h5>Navigation</h5>
    <ul class="nav flex-column">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/admin/index.php">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>

        <?php if ($currentUserRole === "Admin"): ?>
            <!-- Users -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#usersMenu" role="button" aria-expanded="false">
                    <i class="fas fa-users"></i> Users
                </a>
                <div class="collapse" id="usersMenu">
                    <ul class="nav flex-column ms-3">
                        <li><a class="nav-link" href="<?= BASE_URL ?>/core/users/add.php">Add User</a></li>
                        <li><a class="nav-link" href="<?= BASE_URL ?>/core/users/manage.php">Manage Users</a></li>
                    </ul>
                </div>
            </li>

            <!-- Properties -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#propertiesMenu" role="button" aria-expanded="false">
                    <i class="fas fa-building"></i> Properties
                </a>
                <div class="collapse" id="propertiesMenu">
                    <ul class="nav flex-column ms-3">
                        <li><a class="nav-link" href="<?= BASE_URL ?>/core/properties/add.php">Add Property</a></li>
                        <li><a class="nav-link" href="<?= BASE_URL ?>/core/properties/manage.php">Manage Properties</a></li>
                    </ul>
                </div>
            </li>

            <!-- Roles -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#rolesMenu" role="button" aria-expanded="false">
                    <i class="fas fa-id-badge"></i> Roles
                </a>
                <div class="collapse" id="rolesMenu">
                    <ul class="nav flex-column ms-3">
                        <li><a class="nav-link" href="<?= BASE_URL ?>/core/roles/add.php">Add Role</a></li>
                        <li><a class="nav-link" href="<?= BASE_URL ?>/core/roles/manage.php">Manage Roles</a></li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <!-- Plugins -->
        <li><a class="nav-link" href="<?= BASE_URL ?>/plugins/spa/views/spa_booking.php"><i class="fas fa-spa"></i> Spa</a></li>
        <li><a class="nav-link" href="<?= BASE_URL ?>/plugins/pool/views/pool_booking.php"><i class="fas fa-swimming-pool"></i> Pool</a></li>
        <li><a class="nav-link" href="<?= BASE_URL ?>/plugins/food/views/food_order.php"><i class="fas fa-utensils"></i> Food</a></li>
        <li><a class="nav-link" href="<?= BASE_URL ?>/plugins/gym/views/gym_booking.php"><i class="fas fa-dumbbell"></i> Gym</a></li>
        <li><a class="nav-link" href="<?= BASE_URL ?>/plugins/salon/views/salon_booking.php"><i class="fas fa-cut"></i> Salon</a></li>
        <li><a class="nav-link" href="<?= BASE_URL ?>/plugins/parking/views/parking_manage.php"><i class="fas fa-parking"></i> Parking</a></li>
        <li><a class="nav-link" href="<?= BASE_URL ?>/plugins/combo/views/combo_offers.php"><i class="fas fa-gift"></i> Combo Packages</a></li>
        <li><a class="nav-link" href="<?= BASE_URL ?>/plugins/notifications/routes.php"><i class="fas fa-bell"></i> Notifications</a></li>
    </ul>
</aside>
<div class="col-md-9 col-lg-10 p-4">
