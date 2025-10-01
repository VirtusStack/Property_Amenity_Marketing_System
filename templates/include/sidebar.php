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
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageUsers">Manage Users</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newUser">Add User</a>
      </div>
    </div>
  </li>

  <!-- Roles Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles" aria-expanded="true" aria-controls="collapseRoles">
      <i class="fas fa-user-tag"></i>
      <span>Roles</span>
    </a>
    <div id="collapseRoles" class="collapse" aria-labelledby="headingRoles" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageRoles">Manage Roles</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newRole">Add Role</a>
      </div>
    </div>
  </li>

  <!-- Companies Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompanies" aria-expanded="true" aria-controls="collapseCompanies">
      <i class="fas fa-city"></i>
      <span>Companies</span>
    </a>
    <div id="collapseCompanies" class="collapse" aria-labelledby="headingCompanies" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageCompanies">Manage Companies</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newCompany">Add Company</a>
      </div>
    </div>
  </li>

  <!-- Locations Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocations" aria-expanded="true" aria-controls="collapseLocations">
      <i class="fas fa-map-marker-alt"></i>
      <span>Locations</span>
    </a>
    <div id="collapseLocations" class="collapse" aria-labelledby="headingLocations" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageLocations">Manage Locations</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newLocation">Add Location</a>
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
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=manageProperties">Manage Properties</a>
        <a class="collapse-item" href="<?= BASE_URL ?>/admin.php?action=newProperty">Add Property</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->
