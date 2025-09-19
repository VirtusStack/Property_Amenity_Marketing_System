<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>/templates/admin/index.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-building"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Property System</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?= BASE_URL ?>/templates/admin/index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Management
  </div>

  <!-- Users Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
      <i class="fas fa-users"></i>
      <span>Users</span>
    </a>
    <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/core/users/manage_user.php">Manage Users</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/core/users/add_user.php">Add User</a>
      </div>
    </div>
  </li>

  <!-- Properties Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProperties" aria-expanded="true" aria-controls="collapseProperties">
      <i class="fas fa-home"></i>
      <span>Properties</span>
    </a>
    <div id="collapseProperties" class="collapse" aria-labelledby="headingProperties" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/templates/admin/manage_property.php">Manage Properties</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/templates/admin/add_property.php">Add Property</a>
      </div>
    </div>
  </li>

   <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->
