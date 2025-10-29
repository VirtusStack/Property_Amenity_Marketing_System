<?php
// /templates/area_tickets/add_area_ticket.php
// -------------------------
// View file: Displays Add Area Ticket form
// Handles both member and non-member booking
// -------------------------

require_once __DIR__ . '/../../config/config.php'; // Load global config
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
                <h1 class="h3 mb-4 text-gray-800">
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Add Area Ticket' ?>
                </h1>

                <!-- Feedback message -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= (stripos($results['message'], 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= (stripos($results['message'], 'success') !== false)
                            ? '<i class="fas fa-check-circle"></i>'
                            : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Area Ticket Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Form submits to admin.php?action=newAreaTicket -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=newAreaTicket" id="ticketForm">

                            <!-- Location -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" id="location_id" class="form-control" required>
                                    <option value="">Select Location</option>
                                    <?php foreach($results['locations'] as $l): ?>
                                        <option value="<?= $l['location_id'] ?>"
                                            <?= (isset($results['location_id']) && $results['location_id']==$l['location_id'])?'selected':'' ?>>
                                            <?= htmlspecialchars($l['company_name'] . " → " . $l['location_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <!-- Area Dropdown -->
                            <div class="form-group mb-3">
                                <label>Area:</label>
                                <select name="area_id" id="area_id" class="form-control" required>
                                    <option value="">Select Area</option>
                                    <?php foreach($results['areas'] as $a): ?>
                                       <option value="<?= $a['area_id'] ?>" <?= ($results['ticket']['area_id'] ?? '') == $a['area_id'] ? 'selected' : '' ?>>
               				 <?= htmlspecialchars($a['area_name'] . " (" . ($a['plugin_type'] ?? 'N/A') . ")") ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Member Type -->
                            <div class="form-group mb-3">
                                <label>Member Type:</label>
                                <select name="member_type" id="member_type" class="form-control" required>
                                    <option value="non_member" <?= ($results['member_type'] ?? '') == 'non_member' ? 'selected' : '' ?>>Non-Member</option>
                                    <option value="member" <?= ($results['member_type'] ?? '') == 'member' ? 'selected' : '' ?>>Member</option>
                                </select>
                            </div>

                            <!-- Customer Name -->
                            <div class="form-group mb-3">
                                <label>Customer Name:</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control"
                                       value="<?= htmlspecialchars($results['customer_name'] ?? '') ?>"
                                       placeholder="Enter full name" required>
                            </div>

                            <!-- Customer Mobile -->
                            <div class="form-group mb-3">
                                <label>Customer Mobile:</label>
                                <input type="tel" name="customer_mobile" id="customer_mobile" class="form-control"
                                       value="<?= htmlspecialchars($results['customer_mobile'] ?? '') ?>"
                                       placeholder="Enter mobile number" required>
                            </div>

                            <!-- Customer Email -->
                            <div class="form-group mb-3">
                                <label>Customer Email:</label>
                                <input type="email" name="customer_email" id="customer_email" class="form-control"
                                       value="<?= htmlspecialchars($results['customer_email'] ?? '') ?>"
                                       placeholder="Enter email (optional)">
                            </div>

                            <!-- Price -->
                            <div class="form-group mb-3">
                                <label>Ticket Price:</label>
                                <input type="number" step="0.01" name="price" id="price" class="form-control"
                                       value="<?= htmlspecialchars($results['price'] ?? '') ?>"
                                       placeholder="Enter price">
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active" <?= ($results['status'] ?? '') == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="cancelled" <?= ($results['status'] ?? '') == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Create Ticket</button>
                        </form>
                    </div>
                </div>

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

<!--  AJAX Auto-fill for Member -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const memberSelect = document.getElementById("member_type");
    const nameInput = document.getElementById("customer_name");
    const mobileInput = document.getElementById("customer_mobile");
    const emailInput = document.getElementById("customer_email");

    memberSelect.addEventListener("change", function() {
        if (this.value === "member") {
            // Example: auto-fill from existing room booking (you’ll connect to your DB via AJAX)
            fetch("<?= BASE_URL ?>/ajax/get_member_details.php")
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        nameInput.value = data.name;
                        mobileInput.value = data.mobile;
                        emailInput.value = data.email;
                    }
                });
        } else {
            // Clear for non-member
            nameInput.value = '';
            mobileInput.value = '';
            emailInput.value = '';
        }
    });
});
</script>
