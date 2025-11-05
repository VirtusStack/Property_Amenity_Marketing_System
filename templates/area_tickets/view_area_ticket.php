<?php
// /templates/area_tickets/view_area_ticket.php
// Compact black & white ticket - professional receipt style

require_once __DIR__ . '/../../config/config.php';
?>
<?php include __DIR__ . "/../include/header.php"; ?>

<div id="wrapper">
    <?php include __DIR__ . "/../include/sidebar.php"; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include __DIR__ . "/../include/topbar.php"; ?>

            <div class="container-fluid text-center">

                <!-- Header + Print Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-dark">View Area Ticket</h1>
                    <button onclick="window.print()" class="btn btn-dark">
                        <i class="fas fa-print"></i> Print / Save as PDF
                    </button>
                </div>

                <?php if (!empty($results['ticket'])): ?>
                    <?php $t = $results['ticket']; ?>

                    <div id="ticketCard" class="mx-auto ticket-box">
                        <div class="ticket-header">
                            <h5>AREA ENTRY TICKET</h5>
                            <p class="ticket-no">Ticket No: <?= htmlspecialchars($t['ticket_number']) ?></p>
                        </div>

                        <div class="ticket-body">
                            <table class="ticket-table">
                                <tr><th>Area</th><td><?= htmlspecialchars($t['area_name']) ?></td></tr>
                                <tr><th>Type</th><td><?= htmlspecialchars(ucfirst($t['plugin_type'])) ?></td></tr>
                                <tr><th>Location</th><td><?= htmlspecialchars($t['location_name']) ?></td></tr>
                                <tr><th>Customer</th><td><?= htmlspecialchars($t['customer_name']) ?></td></tr>
                                <tr><th>Mobile</th><td><?= htmlspecialchars($t['customer_mobile']) ?></td></tr>
                                <?php if (!empty($t['customer_email'])): ?>
                                <tr><th>Email</th><td><?= htmlspecialchars($t['customer_email']) ?></td></tr>
                                <?php endif; ?>
                                <tr><th>Member Type</th><td><?= ucfirst($t['member_type']) ?></td></tr>
                                <tr><th>Price</th><td>₹<?= number_format($t['price'], 2) ?></td></tr>
                                <tr><th>Status</th><td><?= ucfirst($t['status']) ?></td></tr>
                                <tr><th>Date</th><td><?= htmlspecialchars($t['booking_date']) ?></td></tr>
                            </table>
                        </div>

                        <div class="ticket-footer">
                            <p>Valid for one-time entry only.</p>
                            <p class="small">Please show this ticket at the entrance.</p>
                            <hr>
                            <p class="tiny">Generated on <?= date("d M Y, h:i A") ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">Ticket not found.</div>
                <?php endif; ?>
            </div>

        </div>
        <?php include __DIR__ . "/../include/footer.php"; ?>
    </div>
</div>

<!-- ================== PRINT STYLE ================== -->
<style>
/* Compact layout */
.ticket-box {
    width: 80mm;
    margin-top: 20px;
    padding: 10px 15px;
    border: 1px dashed #000;
    background: #fff;
    color: #000;
    text-align: left;
    font-family: "Courier New", monospace;
}

.ticket-header {
    text-align: center;
    border-bottom: 1px solid #000;
    margin-bottom: 10px;
}

.ticket-header h5 {
    font-weight: bold;
    letter-spacing: 1px;
    margin-bottom: 5px;
}

.ticket-no {
    font-size: 12px;
    margin: 0;
}

.ticket-table {
    width: 100%;
    font-size: 13px;
    border-collapse: collapse;
}

.ticket-table th {
    text-align: left;
    width: 45%;
    font-weight: 600;
    padding: 2px 0;
}

.ticket-table td {
    text-align: right;
    padding: 2px 0;
}

.ticket-footer {
    text-align: center;
    margin-top: 10px;
    font-size: 12px;
}

.ticket-footer hr {
    border: none;
    border-top: 1px dashed #000;
    margin: 5px 0;
}

.ticket-footer .tiny {
    font-size: 10px;
    color: #555;
}

/* Print-only adjustments */
@media print {
    body {
        visibility: hidden;
        background: #fff;
    }
    #ticketCard, #ticketCard * {
        visibility: visible;
    }
    #ticketCard {
        position: absolute;
        left: 0;
        top: 0;
    }
    button, .sidebar, .topbar, .footer, h1 {
        display: none;
    }
}
</style>
