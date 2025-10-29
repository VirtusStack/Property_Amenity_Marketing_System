<?php
// /templates/include/sidebar.php
// -------------------------
// Sidebar template with dynamic plugin integration

global $pdo;

$location_id = $_SESSION['location_id'] ?? null;

//  Auto-pick first location if none selected (for admin)
if (!$location_id && isset($pdo)) {
    $stmt = $pdo->query("SELECT location_id FROM locations WHERE is_deleted = 0 LIMIT 1");
    $location_id = $stmt->fetchColumn();
    $_SESSION['location_id'] = $location_id;
}

$enabledPlugins = [];

if ($location_id && isset($pdo)) {
    $enabledPlugins = Plugin::getEnabled($pdo, $location_id);
}


?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>/admin.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-building"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Property System</div>
  </a>

  <hr class="sidebar-divider my-0">

  <!-- Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?= BASE_URL ?>/admin.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">Management</div>

  <!-- Users -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers">
      <i class="fas fa-users"></i>
      <span>Users</span>
    </a>
    <div id="collapseUsers" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageUsers">Manage Users</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newUser">Add User</a>
      </div>
    </div>
  </li>

  <!-- Roles -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles">
      <i class="fas fa-user-tag"></i>
      <span>Roles</span>
    </a>
    <div id="collapseRoles" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageRoles">Manage Roles</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newRole">Add Role</a>
      </div>
    </div>
  </li>

  <!-- Companies -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompanies">
      <i class="fas fa-city"></i>
      <span>Companies</span>
    </a>
    <div id="collapseCompanies" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageCompanies">Manage Companies</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newCompany">Add Company</a>
      </div>
    </div>
  </li>

  <!-- Locations -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocations">
      <i class="fas fa-map-marker-alt"></i>
      <span>Locations</span>
    </a>
    <div id="collapseLocations" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageLocations">Manage Locations</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newLocation">Add Location</a>
      </div>
    </div>
  </li>

  <!-- Rooms -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRooms">
      <i class="fas fa-door-open"></i>
      <span>Rooms</span>
    </a>
    <div id="collapseRooms" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageRooms">Manage Rooms</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newRoom">Add Room</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- Dynamic Plugin Menus -->
  <?php if (!empty($enabledPlugins)): ?>
      <div class="sidebar-heading">Enabled Features</div>
      <?php 
      $icons = [
          'Restaurant' => 'fa-utensils',
          'Swimming Pool' => 'fa-swimmer',
          'Parking' => 'fa-parking',
          'Spa' => 'fa-spa',
          'Area' => 'fa-building',
	  'Area Ticket' => 'fa-ticket-alt' 
      ];
      ?>
      <?php foreach ($enabledPlugins as $plugin): ?>
          <?php 
          $pluginName = htmlspecialchars($plugin['name']);
          $pluginKey  = str_replace(' ', '', ucwords(strtolower($plugin['name'])));
          $icon = $icons[$plugin['name']] ?? 'fa-plug';
          ?>
          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?= $pluginKey ?>">
                  <i class="fas <?= $icon ?>"></i>
                  <span><?= $pluginName ?></span>
              </a>
              <div id="collapse<?= $pluginKey ?>" class="collapse" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manage<?= ucfirst($pluginKey) ?>s">
                          Manage <?= $pluginName ?>s
                      </a>
                      <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=new<?= ucfirst($pluginKey) ?>">
                          Add <?= $pluginName ?>
                      </a>
                  </div>
              </div>
          </li>
      <?php endforeach; ?>
  <?php endif; ?>

  <!-- Plugins Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePlugins">
      <i class="fas fa-plug"></i>
      <span>Plugins</span>
    </a>
    <div id="collapsePlugins" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=managePlugins">Manage Plugins</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider d-none d-md-block">
</ul>
<!-- End of Sidebar -->
