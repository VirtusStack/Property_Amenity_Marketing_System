<?php
// /templates/area_tickets/edit_area_ticket.php
// EDIT AREA TICKET TEMPLATE
// Displays editable ticket form with same layout as add page

require_once __DIR__ . '/../../config/config.php';
?>
<?php include __DIR__ . "/../include/header.php"; ?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . "/../include/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Topbar -->
            <?php include __DIR__ . "/../include/topbar.php"; ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">
                    <?= isset($results['pageTitle']) ? $results['pageTitle'] : 'Edit Area Ticket' ?>
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

                <!-- Edit Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Form submits to admin.php?action=editAreaTicket&id=XX -->
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=editAreaTicket&id=<?= htmlspecialchars($results['ticket']['ticket_id']) ?>">

                            <!-- Location -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" id="location_id" class="form-control" disabled>
                                    <option value="">Select Location</option>
                                    <?php foreach($results['locations'] as $l): ?>
                                        <option value="<?= $l['location_id'] ?>"
                                            <?= ($l['location_name'] == $results['ticket']['location_name']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($l['company_name'] . " → " . $l['location_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Area -->
                            <div class="form-group mb-3">
                                <label>Area:</label>
                                <select name="area_id" class="form-control" required>
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
                                <select name="member_type" class="form-control" required>
                                    <option value="member" <?= ($results['ticket']['member_type'] == 'member') ? 'selected' : '' ?>>Member</option>
                                    <option value="non_member" <?= ($results['ticket']['member_type'] == 'non_member') ? 'selected' : '' ?>>Non-Member</option>
                                </select>
                            </div>

                            <!-- Customer Name -->
                            <div class="form-group mb-3">
                                <label>Customer Name:</label>
                                <input type="text" name="customer_name" class="form-control" required
                                    value="<?= htmlspecialchars($results['ticket']['customer_name'] ?? '') ?>">
                            </div>

                            <!-- Customer Mobile -->
                            <div class="form-group mb-3">
                                <label>Customer Mobile:</label>
                                <input type="tel" name="customer_mobile" class="form-control" required
                                    value="<?= htmlspecialchars($results['ticket']['customer_mobile'] ?? '') ?>">
                            </div>

                            <!-- Customer Email -->
                            <div class="form-group mb-3">
                                <label>Customer Email:</label>
                                <input type="email" name="customer_email" class="form-control"
                                    value="<?= htmlspecialchars($results['ticket']['customer_email'] ?? '') ?>">
                            </div>

                            <!-- Price -->
                            <div class="form-group mb-3">
                                <label>Price:</label>
                                <input type="number" step="0.01" name="price" class="form-control"
                                    value="<?= htmlspecialchars($results['ticket']['price'] ?? '0.00') ?>">
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= ($results['ticket']['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                                    <option value="cancelled" <?= ($results['ticket']['status'] == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                            </div>

                            <!-- Submit & Cancel Buttons -->
                            <button type="submit" class="btn btn-primary">Update Ticket</button>
                            <a href="<?= BASE_URL ?>/admin.php?action=manageAreaTickets" class="btn btn-secondary">Cancel</a>
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
