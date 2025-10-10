<?php
// /templates/rooms/edit_room.php
// Facility Groups with Icons

$facilityGroups = [
    'Climate & Comfort' => [
        ['name' => 'AC', 'icon' => 'fa-snowflake'],
        ['name' => 'Fan', 'icon' => 'fa-fan'],
        ['name' => 'Soundproof Windows', 'icon' => 'fa-window-maximize'],
        ['name' => 'Hot Water / Geyser', 'icon' => 'fa-tint']
    ],
    'Beds & Sleeping' => [
        ['name' => 'Single Bed', 'icon' => 'fa-bed'],
        ['name' => 'Double Bed', 'icon' => 'fa-bed'],
        ['name' => 'Queen Bed', 'icon' => 'fa-bed'],
        ['name' => 'King Bed', 'icon' => 'fa-bed'],
        ['name' => 'Extra Bed', 'icon' => 'fa-plus'],
        ['name' => 'Extra Mattress', 'icon' => 'fa-plus-square'],
        ['name' => 'Baby Cot / Cradle', 'icon' => 'fa-baby']
    ],
    'Bathroom & Toiletries' => [
        ['name' => 'Attached Bathroom', 'icon' => 'fa-bath'],
        ['name' => 'Toiletries', 'icon' => 'fa-pump-soap'],
        ['name' => 'Towels & Bathrobe', 'icon' => 'fa-tshirt'],
        ['name' => 'Hair Dryer', 'icon' => 'fa-wind']
    ],
    'Entertainment & Connectivity' => [
        ['name' => 'LED TV', 'icon' => 'fa-tv'],
        ['name' => 'Cable Channels', 'icon' => 'fa-satellite-dish'],
        ['name' => 'Smart TV / Netflix', 'icon' => 'fa-film'],
        ['name' => 'Music System', 'icon' => 'fa-music'],
        ['name' => 'Free Wi-Fi', 'icon' => 'fa-wifi'],
        ['name' => 'Intercom', 'icon' => 'fa-phone']
    ],
    'Work & Safety' => [
        ['name' => 'Work Desk', 'icon' => 'fa-chair'],
        ['name' => 'Safe Locker', 'icon' => 'fa-lock'],
        ['name' => 'Key Card Access', 'icon' => 'fa-key'],
        ['name' => 'CCTV Security', 'icon' => 'fa-video'],
        ['name' => 'Fire Extinguisher', 'icon' => 'fa-fire-extinguisher'],
        ['name' => 'Smoke Detector', 'icon' => 'fa-smog']
    ],
    'Views & Outdoor' => [
        ['name' => 'Private Balcony', 'icon' => 'fa-umbrella-beach'],
        ['name' => 'Sea View', 'icon' => 'fa-water'],
        ['name' => 'Pool View', 'icon' => 'fa-swimming-pool'],
        ['name' => 'Garden View', 'icon' => 'fa-leaf'],
        ['name' => 'City View', 'icon' => 'fa-city'],
        ['name' => 'Mountain View', 'icon' => 'fa-mountain'],
        ['name' => 'Sofa / Sitting Area', 'icon' => 'fa-couch']
    ],
    'Services & Amenities' => [
        ['name' => 'Lift Access', 'icon' => 'fa-elevator'],
        ['name' => 'Parking Available', 'icon' => 'fa-car'],
        ['name' => 'Power Backup', 'icon' => 'fa-bolt'],
        ['name' => 'Laundry Service', 'icon' => 'fa-soap'],
        ['name' => 'Luggage Storage', 'icon' => 'fa-suitcase'],
        ['name' => 'Room Service', 'icon' => 'fa-bell'],
        ['name' => 'Daily Housekeeping', 'icon' => 'fa-broom'],
        ['name' => 'Tea/Coffee Maker', 'icon' => 'fa-mug-hot'],
        ['name' => 'Welcome Drink', 'icon' => 'fa-glass-cheers'],
        ['name' => 'Breakfast Included', 'icon' => 'fa-bread-slice'],
        ['name' => 'Complimentary Water', 'icon' => 'fa-tint']
    ],
    'Leisure & Extras' => [
        ['name' => 'Swimming Pool', 'icon' => 'fa-swimming-pool'],
        ['name' => 'Gym / Fitness', 'icon' => 'fa-dumbbell'],
        ['name' => 'Spa & Wellness', 'icon' => 'fa-spa'],
        ['name' => 'Play Area', 'icon' => 'fa-child'],
        ['name' => 'Restaurant', 'icon' => 'fa-utensils'],
        ['name' => 'Bar', 'icon' => 'fa-cocktail'],
        ['name' => 'Conference Room', 'icon' => 'fa-users'],
        ['name' => 'Banquet Hall', 'icon' => 'fa-hotel']
    ],
    'Policies' => [
        ['name' => 'Pet Friendly', 'icon' => 'fa-dog'],
        ['name' => 'Smoking Allowed', 'icon' => 'fa-smoking'],
        ['name' => 'Non-Smoking Room', 'icon' => 'fa-ban']
    ]
];

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
            <!-- End Topbar -->

            <div class="container-fluid">

                <h1 class="h3 mb-4 text-gray-800">
                    <?= $results['pageTitle'] ?? 'Edit Room' ?>
                </h1>

                <?php if (!empty($results['message'])): ?>
                    <div class="alert <?= (stripos($results['message'], 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                        <?= (stripos($results['message'], 'success') !== false) ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' ?>
                        <?= htmlspecialchars($results['message']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST" action="<?= BASE_URL ?>/admin.php?action=editRoom&id=<?= htmlspecialchars($results['room']['room_id']) ?>">

                            <!-- Location Dropdown -->
                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <select name="location_id" class="form-control" required>
                                    <option value="">-- Select Location --</option>
                                    <?php foreach ($results['locations'] as $location): ?>
                                        <option value="<?= $location['location_id'] ?>"
                                            <?= ($location['location_id'] == $results['room']['location_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($location['company_name'] . ' → ' . $location['location_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Room Name -->
                            <div class="form-group mb-3">
                                <label>Room Name:</label>
                                <input type="text" name="room_name" class="form-control" required
                                       value="<?= htmlspecialchars($results['room']['room_name'] ?? '') ?>">
                            </div>

                            <!-- Room Type -->
                            <div class="form-group mb-3">
                                <label>Room Type:</label>
                                <input type="text" name="room_type" class="form-control"
                                       value="<?= htmlspecialchars($results['room']['room_type'] ?? '') ?>">
                            </div>

                            <!-- Room View -->
                            <div class="form-group mb-3">
                                <label>Room View:</label>
                                <input type="text" name="room_view" class="form-control"
                                       value="<?= htmlspecialchars($results['room']['room_view'] ?? '') ?>">
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control"><?= htmlspecialchars($results['room']['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Base Price -->
                            <div class="form-group mb-3">
                                <label>Base Price per Night:</label>
                                <input type="number" name="base_price_per_night" class="form-control" step="0.01"
                                       value="<?= htmlspecialchars($results['room']['base_price_per_night'] ?? 0) ?>">
                            </div>

                            <!-- GST Percent -->
                            <div class="form-group mb-3">
                                <label>GST (%):</label>
                                <input type="number" name="gst_percent" class="form-control" step="0.01"
                                       value="<?= htmlspecialchars($results['room']['gst_percent'] ?? 0) ?>">
                            </div>

                            <!-- Total Inventory -->
                            <div class="form-group mb-3">
                                <label>Total Inventory:</label>
                                <input type="number" name="total_inventory" class="form-control"
                                       value="<?= htmlspecialchars($results['room']['total_inventory'] ?? 0) ?>">
                            </div>

                            <!-- Max Occupancy -->
                            <div class="form-group mb-3">
                                <label>Max Occupancy:</label>
                                <input type="number" name="max_occupancy" class="form-control"
                                       value="<?= htmlspecialchars($results['room']['max_occupancy'] ?? 1) ?>">
                            </div>

                            <!-- Notes -->
                            <div class="form-group mb-3">
                                <label>Notes:</label>
                                <textarea name="notes" class="form-control"><?= htmlspecialchars($results['room']['notes'] ?? '') ?></textarea>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="form-group mb-3">
                                <label>Terms & Conditions:</label>
                                <textarea name="terms_conditions" class="form-control"><?= htmlspecialchars($results['room']['terms_conditions'] ?? '') ?></textarea>
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= ($results['room']['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= ($results['room']['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>

                           <!-- Facilities -->
			 <div class="form-group mb-4">
    			<label>Facilities / Room Features:</label>

    			<?php foreach ($facilityGroups as $group => $items): ?>
        		  <h6 class="mt-3"><strong><?= htmlspecialchars($group) ?></strong></h6>
       			 <div class="row">
           		 <?php foreach ($items as $facility): ?>
                	<?php 
                 	// If editing, preselect facility if it exists in $results['facilities_selected']
                	$checked = (isset($results['facilities_selected']) && in_array($facility['name'], $results['facilities_selected'])) 
                    	? 'checked' 
                    	: '';
               		 ?>
                	<div class="col-md-4">
                    	<div class="form-check">
                        <input type="checkbox" class="form-check-input" 
                               name="facilities[]" 
                               value="<?= htmlspecialchars($facility['name']) ?>" 
                               id="facility<?= md5($facility['name']) ?>" 
                               <?= $checked ?>>
                        	<label class="form-check-label" for="facility<?= md5($facility['name']) ?>">
                            	<i class="fas <?= $facility['icon'] ?>"></i>
                            	<?= htmlspecialchars($facility['name']) ?>
                        	</label>
                   	        </div>
                		</div>
            			<?php endforeach; ?>
       			      </div>
   		 	   <?php endforeach; ?>
			</div>

                            <button type="submit" class="btn btn-primary">Update Room</button>
                            <a href="<?= BASE_URL ?>/admin.php?action=manageRooms" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>

            </div>

        </div>
        <!-- End Main Content -->

        <?php include __DIR__ . "/../include/footer.php"; ?>

    </div>
</div>
