<?php
// /templates/plugins/manage_plugins.php
// -------------------------
// View file: Manage Plugins (Enable/Disable per Location)

require_once __DIR__ . '/../../config/config.php';
include __DIR__ . "/../include/header.php";
?>

<div id="wrapper">
    <?php include __DIR__ . "/../include/sidebar.php"; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include __DIR__ . "/../include/topbar.php"; ?>

            <div class="container-fluid">

                <h1 class="h3 mb-4 text-gray-800"><?= htmlspecialchars($results['pageTitle']) ?></h1>

                <!-- Feedback message -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <!-- Plugins Table -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Plugin</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($results['plugins'])): ?>
                                        <?php foreach ($results['plugins'] as $p): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($p['company_name']) ?></td>
                                                <td><?= htmlspecialchars($p['location_name']) ?></td>
                                                <td><?= htmlspecialchars($p['plugin_name']) ?></td>
                                                <td><?= htmlspecialchars($p['description'] ?? '-') ?></td>
                                                <td>
                                                    <?php if ($p['is_enabled']): ?>
                                                        <span class="badge badge-success">Enabled</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary">Disabled</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <form method="POST" action="<?= BASE_URL ?>/admin.php?action=togglePlugin" class="d-inline">
                                                        <input type="hidden" name="location_plugin_id" value="<?= (int)$p['location_plugin_id'] ?>">
                                                        <input type="hidden" name="is_enabled" value="<?= $p['is_enabled'] ? 0 : 1 ?>">
                                                        <button type="submit" class="btn btn-sm <?= $p['is_enabled'] ? 'btn-danger' : 'btn-success' ?>">
                                                            <?= $p['is_enabled'] ? 'Disable' : 'Enable' ?>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="6" class="text-center">No plugin data found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include __DIR__ . "/../include/footer.php"; ?>
    </div>
</div>
