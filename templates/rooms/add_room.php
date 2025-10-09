<?php
// /templates/rooms/add_room.php
// Admin Add Room Form
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

                            <!-- Location Dropdown with Company Info -->
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

                            <!-- Max Occupancy -->
                            <div class="form-group mb-3">
                                <label>Max Occupancy <i class="fas fa-info-circle" title="Maximum number of guests allowed in this room"></i>:</label>
                                <input type="number" name="max_occupancy" class="form-control" min="1" value="<?= htmlspecialchars($results['max_occupancy'] ?? 1) ?>">
				<small class="form-text text-muted">How many people can stay in this room comfortably.</small>
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($results['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Price & GST -->
                            <div class="form-group mb-3">
                                <label>Base Price per Night:</label>
                                <input type="number" step="0.01" name="base_price_per_night" class="form-control" min="0" required value="<?= htmlspecialchars($results['base_price_per_night'] ?? '') ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>GST % <i class="fas fa-info-circle" title="Goods and Services Tax applicable"></i>:</label>
                                <select name="gst_percent" class="form-control">
                                    <?php foreach ([0,5,12,18] as $gst): ?>
                                        <option value="<?= $gst ?>" <?= (isset($results['gst_percent']) && $results['gst_percent']==$gst)?'selected':'' ?>><?= $gst ?>%</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Total Inventory -->
                            <div class="form-group mb-3">
                            <label>Total Inventory:</label>
                           <input type="number" name="total_inventory" class="form-control" min="1" required value="<?= htmlspecialchars($results['total_inventory'] ?? 1) ?>">
			   <small class="form-text text-muted">How many rooms of this type are available.</small>
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
    			    <label>Facilities / Room Features:</label>

    				<?php foreach ($facilityGroups as $group => $items): ?>
        			<h6 class="mt-3"><strong><?= htmlspecialchars($group) ?></strong></h6>
        			<div class="row">
           			 <?php foreach ($items as $facility): ?>
                		<div class="col-md-4">
                    		<div class="form-check">
                        	<input type="checkbox" class="form-check-input" 
                        	name="facilities[]" 
                               value="<?= htmlspecialchars($facility['name']) ?>" 
                                id="facility<?= md5($facility['name']) ?>">
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
