<?php
// /templates/rooms/edit_room.php
// Edit Room Form with dynamic grouped facilities (no DB change)

require_once __DIR__ . '/../../config/config.php';
?>
<?php include __DIR__ . "/../include/header.php"; ?>

<div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . "/../include/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <!-- Topbar -->
            <?php include __DIR__ . "/../include/topbar.php"; ?>
            <!-- End of Topbar -->

            <div class="container-fluid">

                <!-- Page Title -->
                <h1 class="h3 mb-4 text-gray-800"><?= $results['pageTitle'] ?? 'Edit Room' ?></h1>

                <!-- Feedback Message -->
                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= (stripos($results['message'], 'success') !== false)?'alert-success':'alert-danger' ?> alert-dismissible fade show">
                        <?= (stripos($results['message'], 'success') !== false) ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <!-- Room Edit Form -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=editRoom&id=<?= htmlspecialchars($results['room']['room_id']) ?>">

                            <!-- Location Dropdown -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" id="location_id" class="form-control" required>
                                    <option value="">Select Location</option>
                                    <?php foreach($results['locations'] as $l): ?>
                                        <option value="<?= $l['location_id'] ?>" <?= ($l['location_id']==$results['room']['location_id'])?'selected':'' ?>>
                                            <?= htmlspecialchars($l['company_name'] . " → " . $l['location_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Room Name -->
                            <div class="form-group mb-3">
                                <label>Room Name / Number:</label>
                                <input type="text" name="room_name" class="form-control" required value="<?= htmlspecialchars($results['room']['room_name'] ?? '') ?>">
                            </div>

                            <!-- Room Type -->
                            <div class="form-group mb-3">
                                <label>Room Type:</label>
                                <input type="text" name="room_type" class="form-control" placeholder="Deluxe, Suite..." value="<?= htmlspecialchars($results['room']['room_type'] ?? '') ?>">
                            </div>

                            <!-- Room View -->
                            <div class="form-group mb-3">
                                <label>Room View:</label>
                                <input type="text" name="room_view" class="form-control" placeholder="Sea Facing, Garden..." value="<?= htmlspecialchars($results['room']['room_view'] ?? '') ?>">
                            </div>

                            <!-- Max Occupancy -->
                            <div class="form-group mb-3">
                                <label>Max Occupancy <i class="fas fa-info-circle" title="Maximum number of guests allowed in this room"></i>:</label>
                                <input type="number" name="max_occupancy" class="form-control" min="1" value="<?= htmlspecialchars($results['room']['max_occupancy'] ?? 1) ?>">
                                <small class="form-text text-muted">How many people can stay in this room comfortably.</small>
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($results['room']['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Price -->
                            <div class="form-group mb-3">
                                <label>Base Price per Night:</label>
                                <input type="number" step="0.01" name="base_price_per_night" class="form-control" min="0" required value="<?= htmlspecialchars($results['room']['base_price_per_night'] ?? '') ?>">
                            </div>

                            <!-- GST -->
                            <div class="form-group mb-3">
                                <label>GST %:</label>
                                <select name="gst_percent" class="form-control">
                                    <?php foreach ([0,5,12,18] as $gst): ?>
                                        <option value="<?= $gst ?>" <?= ($results['room']['gst_percent']==$gst)?'selected':'' ?>><?= $gst ?>%</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

			    <!-- GST Inclusive / Exclusive -->
			    <div class="form-group mb-3">
   				<label>GST Type</label>
    				<select name="gst_inclusive" class="form-control">
        			<option value="exclusive" <?= (($results['room']['gst_inclusive'] ?? 'exclusive') === 'exclusive') ? 'selected' : ''; ?>>Exclusive</option>
        			<option value="inclusive" <?= (($results['room']['gst_inclusive'] ?? 'exclusive') === 'inclusive') ? 'selected' : ''; ?>>Inclusive</option>
    				</select>
				</div>

                            <!-- Total Inventory -->
                            <div class="form-group mb-3">
                                <label>Total Inventory:</label>
                                <input type="number" name="total_inventory" class="form-control" min="1" required value="<?= htmlspecialchars($results['room']['total_inventory'] ?? 1) ?>">
                                <small class="form-text text-muted">How many rooms of this type are available.</small>
                            </div>

                            <!-- Notes -->
                            <div class="form-group mb-3">
                                <label>Notes:</label>
                                <textarea name="notes" class="form-control" rows="2"><?= htmlspecialchars($results['room']['notes'] ?? '') ?></textarea>
                            </div>

                            <!-- Terms -->
                            <div class="form-group mb-3">
                                <label>Terms & Conditions:</label>
                                <textarea name="terms_conditions" class="form-control" rows="2"><?= htmlspecialchars($results['room']['terms_conditions'] ?? '') ?></textarea>
                            </div>

                            <!-- Facilities Section -->
                            <?php
                            // -------------------------
                            // FACILITIES FROM DATABASE (EDIT)
                            // -------------------------

                            // Facility grouping by category
                            $facilityGroups = [
                                'Climate & Comfort' => ['AC','Fan','Soundproof Windows','Hot Water / Geyser'],
                                'Beds & Sleeping' => ['Single Bed','Double Bed','Queen Bed','King Bed','Extra Bed','Extra Mattress','Baby Cot / Cradle'],
                                'Bathroom & Toiletries' => ['Attached Bathroom','Toiletries','Towels & Bathrobe','Hair Dryer'],
                                'Entertainment & Connectivity' => ['LED TV','Cable Channels','Smart TV / Netflix','Music System','Free Wi-Fi','Intercom'],
                                'Work & Safety' => ['Work Desk','Safe Locker','Key Card Access','CCTV Security','Fire Extinguisher','Smoke Detector'],
                                'Views & Outdoor' => ['Private Balcony','Sea View','Pool View','Garden View','City View','Mountain View','Sofa / Sitting Area'],
                                'Services & Amenities' => ['Lift Access','Parking Available','Power Backup','Laundry Service','Luggage Storage','Room Service','Daily Housekeeping','Tea/Coffee Maker','Welcome Drink','Breakfast Included','Complimentary Water'],
                                'Leisure & Extras' => ['Swimming Pool','Gym / Fitness','Spa & Wellness','Play Area','Restaurant','Bar','Conference Room','Banquet Hall'],
                                'Policies' => ['Pet Friendly','Smoking Allowed','Non-Smoking Room']
                            ];

                            // Load all facilities from DB
                            $stmt = $pdo->query("SELECT facility_id, name, icon FROM facilities ORDER BY name ASC");
                            $facilityMap = [];
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $facilityMap[$row['name']] = [
                                    'id' => $row['facility_id'],
                                    'icon' => $row['icon']
                                ];
                            }

                            // Preselected facilities for this room
                            $selectedFacilities = $results['facilities_selected'] ?? [];
                            ?>

                            <div class="form-group mb-4">
                                <label>Facilities / Room Features:</label>
                                <?php foreach ($facilityGroups as $group => $items): ?>
                                    <h6 class="mt-3"><strong><?= htmlspecialchars($group) ?></strong></h6>
                                    <div class="row">
                                        <?php foreach ($items as $facilityName): ?>
                                            <?php
                                            $fid = $facilityMap[$facilityName]['id'] ?? null;
                                            $icon = $facilityMap[$facilityName]['icon'] ?? 'fa-circle';
                                            if (!$fid) continue;
                                            $checked = in_array($fid, $selectedFacilities) ? 'checked' : '';
                                            ?>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        name="facilities[]" value="<?= $fid ?>"
                                                        id="facility<?= $fid ?>" <?= $checked ?>>
                                                    <label class="form-check-label" for="facility<?= $fid ?>">
                                                        <i class="fas <?= htmlspecialchars($icon) ?>"></i>
                                                        <?= htmlspecialchars($facilityName) ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Room Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= ($results['room']['status']=='active')?'selected':'' ?>>Active</option>
                                    <option value="inactive" <?= ($results['room']['status']=='inactive')?'selected':'' ?>>Inactive</option>
                                    <option value="maintenance" <?= ($results['room']['status']=='maintenance')?'selected':'' ?>>Maintenance</option>
                                </select>
                            </div>

                            <!-- Submit Buttons -->
                            <button type="submit" class="btn btn-primary">Update Room</button>
                            <a href="<?= BASE_URL ?>/admin.php?action=manageRooms" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <?php include __DIR__ . "/../include/footer.php"; ?>
        <!-- End Footer -->

    </div>  
</div>
