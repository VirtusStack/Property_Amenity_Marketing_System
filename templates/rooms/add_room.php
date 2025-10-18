<?php
// /templates/rooms/add_room.php

require_once __DIR__ . '/../../config/config.php';
include __DIR__ . "/../include/header.php";
?>

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

                <!-- Add Room Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=newRoom">

                            <!-- Location -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" id="location_id" class="form-control" required>
                                    <option value="">Select Location</option>
                                    <?php foreach($results['locations'] as $l): ?>
                                        <option value="<?= $l['location_id'] ?>" <?= (isset($results['location_id']) && $results['location_id']==$l['location_id'])?'selected':'' ?>>
                                            <?= htmlspecialchars($l['company_name'] . " → " . $l['location_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Room Info -->
                            <div class="form-group mb-3">
                                <label>Room Name / Number:</label>
                                <input type="text" name="room_name" class="form-control" required value="<?= htmlspecialchars($results['room_name'] ?? '') ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Room Type:</label>
                                <input type="text" name="room_type" class="form-control" placeholder="Deluxe, Suite..." value="<?= htmlspecialchars($results['room_type'] ?? '') ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Room View:</label>
                                <input type="text" name="room_view" class="form-control" placeholder="Sea View, Garden View..." value="<?= htmlspecialchars($results['room_view'] ?? '') ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Max Occupancy:</label>
                                <input type="number" name="max_occupancy" class="form-control" min="1" value="<?= htmlspecialchars($results['max_occupancy'] ?? 1) ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($results['description'] ?? '') ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Base Price per Night:</label>
                                <input type="number" step="0.01" name="base_price_per_night" class="form-control" min="0" required value="<?= htmlspecialchars($results['base_price_per_night'] ?? '') ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>GST %:</label>
                                <select name="gst_percent" class="form-control">
                                    <?php foreach ([0,5,12,18] as $gst): ?>
                                        <option value="<?= $gst ?>" <?= (isset($results['gst_percent']) && $results['gst_percent']==$gst)?'selected':'' ?>><?= $gst ?>%</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

			   <!-- GST Inclusive / Exclusive -->
				<div class="form-group mb-3">
    				<label>GST Type</label>
    				<select name="gst_inclusive" class="form-control">
        			<option value="exclusive" <?= (($_POST['gst_inclusive'] ?? ($results['gst_inclusive'] ?? 'exclusive')) === 'exclusive') ? 'selected' : ''; ?>>Exclusive</option>
        			<option value="inclusive" <?= (($_POST['gst_inclusive'] ?? ($results['gst_inclusive'] ?? 'exclusive')) === 'inclusive') ? 'selected' : ''; ?>>Inclusive</option>
    				</select>
				</div>


                            <div class="form-group mb-3">
                                <label>Total Inventory:</label>
                                <input type="number" name="total_inventory" class="form-control" min="1" required value="<?= htmlspecialchars($results['total_inventory'] ?? 1) ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Notes:</label>
                                <textarea name="notes" class="form-control" rows="2"><?= htmlspecialchars($results['notes'] ?? '') ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Terms & Conditions:</label>
                                <textarea name="terms_conditions" class="form-control" rows="2"><?= htmlspecialchars($results['terms_conditions'] ?? '') ?></textarea>
                            </div>

                            <!-- Facilities (Dynamic from DB, Grouped by Name) -->
                            <div class="form-group mb-4">
                                <label>Facilities / Room Features:</label>

                                <?php
                                // Group names (no DB schema change)
                                $facilityGroups = [
                                    'Climate & Comfort' => ['AC','Fan','Hot Water / Geyser','Soundproof Windows'],
                                    'Beds & Sleeping' => ['Single Bed','Double Bed','Queen Bed','King Bed','Extra Bed','Extra Mattress','Baby Cot / Cradle'],
                                    'Bathroom & Toiletries' => ['Attached Bathroom','Toiletries','Towels & Bathrobe','Hair Dryer'],
                                    'Entertainment & Connectivity' => ['LED TV','Cable Channels','Smart TV / Netflix','Music System','Free Wi-Fi','Intercom'],
                                    'Work & Safety' => ['Work Desk','Safe Locker','Key Card Access','CCTV Security','Fire Extinguisher','Smoke Detector'],
                                    'Views & Outdoor' => ['Private Balcony','Sea View','Pool View','Garden View','City View','Mountain View','Sofa / Sitting Area'],
                                    'Services & Amenities' => ['Lift Access','Parking Available','Power Backup','Laundry Service','Luggage Storage','Room Service','Daily Housekeeping','Tea/Coffee Maker','Welcome Drink','Breakfast Included','Complimentary Water'],
                                    'Leisure & Extras' => ['Swimming Pool','Gym / Fitness','Spa & Wellness','Play Area','Restaurant','Bar','Conference Room','Banquet Hall'],
                                    'Policies' => ['Pet Friendly','Smoking Allowed','Non-Smoking Room']
                                ];

                                // Create name-based lookup
                                $facilityByName = [];
                                foreach ($results['facilities'] as $f) {
                                    $facilityByName[$f['name']] = $f;
                                }

                                foreach ($facilityGroups as $group => $names):
                                    echo "<h6 class='mt-3'><strong>" . htmlspecialchars($group) . "</strong></h6><div class='row'>";
                                    foreach ($names as $fname):
                                        if (isset($facilityByName[$fname])) {
                                            $f = $facilityByName[$fname];
                                            ?>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        name="facilities[]"
                                                        value="<?= (int)$f['facility_id'] ?>"
                                                        id="facility<?= (int)$f['facility_id'] ?>">
                                                    <label class="form-check-label" for="facility<?= (int)$f['facility_id'] ?>">
                                                        <i class="fas <?= htmlspecialchars($f['icon']) ?>"></i>
                                                        <?= htmlspecialchars($f['name']) ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    endforeach;
                                    echo "</div>";
                                endforeach;
                                ?>
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

                            <button type="submit" class="btn btn-primary">Add Room</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <?php include __DIR__ . "/../include/footer.php"; ?>
    </div>
</div>

