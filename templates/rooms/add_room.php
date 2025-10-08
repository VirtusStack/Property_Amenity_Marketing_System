<?php
// /templates/rooms/add_room.php
// -------------------------
// Admin Add Room Form
// -------------------------

require_once __DIR__ . '/../../config/config.php';
?>
<?php include __DIR__ . "/../include/header.php"; ?>

<div id="wrapper">
    <?php include __DIR__ . "/../include/sidebar.php"; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include __DIR__ . "/../include/topbar.php"; ?>

            <div class="container-fluid">

                <h1 class="h3 mb-4 text-gray-800"><?= $results['pageTitle'] ?? 'Add Room' ?></h1>

                <!-- Feedback -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= (stripos($results['message'], 'success') !== false)?'alert-success':'alert-danger' ?> alert-dismissible fade show">
                        <?= (stripos($results['message'], 'success') !== false) ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <!-- Room Form -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=newRoom">

                            <!-- Company -->
                            <div class="form-group mb-3">
                                <label>Company:</label>
                                <select name="company_id" id="company_id" class="form-control">
                                    <option value="">Select Company</option>
                                    <?php foreach($results['companies'] as $c): ?>
                                        <option value="<?= $c['company_id'] ?>" <?= (isset($results['company_id']) && $results['company_id']==$c['company_id'])?'selected':'' ?>>
                                            <?= htmlspecialchars($c['company_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Location -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" id="location_id" class="form-control" required>
                                    <option value="">Select Location</option>
                                    <?php foreach($results['locations'] as $l): ?>
                                        <option value="<?= $l['location_id'] ?>" <?= (isset($results['location_id']) && $results['location_id']==$l['location_id'])?'selected':'' ?>>
                                            <?= htmlspecialchars($l['location_name'] . " (" . $l['company_name'] . ")") ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Room Name -->
                            <div class="form-group mb-3">
                                <label>Room Name / Number:</label>
                                <input type="text" name="room_name" class="form-control" required value="<?= htmlspecialchars($results['room_name'] ?? '') ?>">
                            </div>

                            <!-- Room Type -->
                            <div class="form-group mb-3">
                                <label>Room Type:</label>
                                <input type="text" name="room_type" class="form-control" placeholder="Deluxe, Suite..." value="<?= htmlspecialchars($results['room_type'] ?? '') ?>">
                            </div>

                            <!-- Room View -->
                            <div class="form-group mb-3">
                                <label>Room View:</label>
                                <input type="text" name="room_view" class="form-control" placeholder="Sea Facing, Garden..." value="<?= htmlspecialchars($results['room_view'] ?? '') ?>">
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($results['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Price & GST -->
                            <div class="form-group mb-3">
                                <label>Base Price per Night:</label>
                                <input type="number" step="0.01" name="base_price_per_night" class="form-control" required value="<?= htmlspecialchars($results['base_price_per_night'] ?? '') ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label>GST %:</label>
                                <select name="gst_percent" class="form-control">
                                    <?php foreach ([0,5,12,18] as $gst): ?>
                                        <option value="<?= $gst ?>" <?= (isset($results['gst_percent']) && $results['gst_percent']==$gst)?'selected':'' ?>><?= $gst ?>%</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Total Inventory -->
                            <div class="form-group mb-3">
                                <label>Total Inventory:</label>
                                <input type="number" name="total_inventory" class="form-control" required value="<?= htmlspecialchars($results['total_inventory'] ?? 1) ?>">
                            </div>

                            <!-- Notes & Terms -->
                            <div class="form-group mb-3">
                                <label>Notes:</label>
                                <textarea name="notes" class="form-control" rows="2"><?= htmlspecialchars($results['notes'] ?? '') ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Terms & Conditions:</label>
                                <textarea name="terms_conditions" class="form-control" rows="2"><?= htmlspecialchars($results['terms_conditions'] ?? '') ?></textarea>
                            </div>

                           <!-- Facilities -->
			     <div class="form-group mb-4">
    				 <label>Facilities:</label>
   				   <div class="row">
        			   <?php foreach($results['facilities'] as $f): ?>
            			   <div class="col-md-4">
                	  	   <div class="form-check">
                    		   <input type="checkbox" class="form-check-input" name="facilities[]" value="<?= $f['facility_id'] ?>" id="facility<?= $f['facility_id'] ?>">
                    		   <label class="form-check-label" for="facility<?= $f['facility_id'] ?>">
                       		   <?= !empty($f['icon']) ? "<i class='fas " . $f['icon'] . "'></i>" : "🔹" ?>
                       		   <?= htmlspecialchars($f['name']) ?>
                    		     </label>
                	         </div>
           		       </div>
        			<?php endforeach; ?>
    				</div>
				</div>


                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= (isset($results['status']) && $results['status']=='active')?'selected':'' ?>>Active</option>
                                    <option value="inactive" <?= (isset($results['status']) && $results['status']=='inactive')?'selected':'' ?>>Inactive</option>
				    <option value="maintenance" <?= (isset($results['status']) && $results['status']=='maintenance')?'selected':'' ?>>Maintenance</option>

                                </select>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary">Add Room</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <?php include __DIR__ . "/../include/footer.php"; ?>
    </div>
</div>
