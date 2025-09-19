<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>/admin.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-building"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Property System</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <!-- Dashboard link points to controller (admin.php) -->
    <a class="nav-link" href="<?= BASE_URL ?>/admin.php">
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
        <!-- ✅ Updated links to go through admin.php controller -->
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageUsers">Manage Users</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newUser">Add User</a>
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
        <!-- ✅ Updated links to go through admin.php controller -->
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageProperties">Manage Properties</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newProperty">Add Property</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->
