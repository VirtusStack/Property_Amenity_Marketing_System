- -- Database: `property_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `created_at`, `description`, `email`, `phone`, `website`, `is_deleted`) VALUES
(1, 'Apex Solutions', '2023-01-14 18:00:00', 'IT services & consulting', 'contact@apexsolutions.com', '9876543210', 'www.apexsolutions.com', 0),
(2, 'BrightTech', '2022-11-30 16:50:00', 'Software development', 'info@brighttech.com', '9876543211', 'www.brighttech.com', 0),
(3, 'GreenFields Corp', '2021-07-20 19:30:00', 'Agriculture & farming', 'hello@greenfields.com', '9876543212', 'www.greenfields.com', 0),
(4, 'UrbanBuild', '2022-03-04 23:15:00', 'Construction services', 'support@urbanbuild.com', '9876543213', 'www.urbanbuild.com', 0),
(5, 'QuantumSoft', '2023-05-16 15:40:00', 'IT solutions & software', 'contact@quantumsoft.com', '9876543214', 'www.quantumsoft.com', 0),
(6, 'EcoEnergy', '2021-11-29 18:55:00', 'Renewable energy provider', 'info@ecoenergy.com', '9876543215', 'www.ecoenergy.com', 0),
(7, 'Stellar Media', '2022-06-10 00:10:00', 'Digital marketing agency', 'hello@stellarmedia.com', '9876543216', 'www.stellarmedia.com', 0),
(8, 'Horizon Ventures', '2023-02-27 16:30:00', 'Venture capital & finance', 'contact@horizonventures.com', '9876543217', 'www.horizonventures.com', 0),
(9, 'BlueWave Technologies', '2021-09-17 21:45:00', 'Tech solutions provider', 'support@bluewave.com', '9876543218', 'www.bluewave.com', 0),
(10, 'Nova Pharma', '2022-08-04 18:20:00', 'Pharmaceutical company', 'info@novapharma.com', '9876543219', 'www.novapharma.com', 0),
(11, 'Summit Logistics', '2023-04-11 21:00:00', 'Supply chain services', 'contact@summitlogistics.com', '9876543220', 'www.summitlogistics.com', 0),
(12, 'Crystal Interiors', '2021-05-19 17:15:00', 'Interior design firm', 'hello@crystalinteriors.com', '9876543221', 'www.crystalinteriors.com', 0),
(13, 'Prime Foods', '2022-10-10 19:45:00', 'Food & beverage company', 'info@primefoods.com', '9876543222', 'www.primefoods.com', 0),
(14, 'SilverLine Automotives', '2023-01-24 22:50:00', 'Automotive manufacturer', 'contact@silverlineauto.com', '9876543223', 'www.silverlineauto.com', 0),
(15, 'Vertex Analytics', '2021-12-14 16:05:00', 'Data analytics services', 'hello@vertexanalytics.com', '9876543224', 'www.vertexanalytics.com', 0),
(16, 'Infinity Media', '2022-02-17 17:35:00', 'Media & entertainment', 'info@infinitymedia.com', '9876543225', 'www.infinitymedia.com', 0),
(17, 'Alpha Robotics', '2023-03-06 22:20:00', 'Robotics & AI solutions', 'contact@alpharobotics.com', '9876543226', 'www.alpharobotics.com', 0),
(18, 'GreenLeaf Organics', '2021-08-21 19:10:00', 'Organic farming & products', 'hello@greenleaf.com', '9876543227', 'www.greenleaf.com', 0),
(19, 'Titan Security', '2022-09-29 16:45:00', 'Security solutions', 'info@titansecurity.com', '9876543228', 'www.titansecurity.com', 0),
(20, 'Orion Tech Labs', '2023-05-31 23:30:00', 'Technology R&D lab', 'contact@oriontech.com', '9876543229', 'www.oriontech.com', 0),
(21, 'Phoenix IT Solutions', '2023-07-11 18:50:00', 'Custom software solutions', 'contact@phoenixit.com', '9876543230', 'www.phoenixit.com', 0),
(22, 'BlueSky Enterprises', '2022-11-04 21:40:00', 'Business consultancy', 'info@bluesky.com', '9876543231', 'www.bluesky.com', 0),
(23, 'EverGreen Tech', '2023-01-29 17:15:00', 'Sustainable technology', 'hello@evergreentech.com', '9876543232', 'www.evergreentech.com', 0),
(24, 'NextGen Robotics', '2022-08-21 21:05:00', 'AI & robotics solutions', 'contact@nextgenrobotics.com', '9876543233', 'www.nextgenrobotics.com', 0),
(25, 'SilverWave Media', '2021-12-13 18:20:00', 'Media & digital marketing', 'info@silverwavemedia.com', '9876543234', 'www.silverwavemedia.com', 0),
(26, 'Orchid Pharmaceuticals', '2023-03-18 23:35:00', 'Pharmaceutical R&D', 'hello@orchidpharma.com', '9876543235', 'www.orchidpharma.com', 0),
(27, 'Summit Tech Labs', '2022-05-10 20:00:00', 'Technology research lab', 'contact@summittechlabs.com', '9876543236', 'www.summittechlabs.com', 0),
(28, 'UrbanLeaf Organics', '2021-09-27 16:45:00', 'Organic food products', 'info@urbanleaf.com', '9876543237', 'www.urbanleaf.com', 0),
(29, 'Vortex Security', '2023-06-20 23:10:00', 'Cybersecurity solutions', 'hello@vortexsecurity.com', '9876543238', 'www.vortexsecurity.com', 0),
(30, 'Atlas Logistics', '2022-10-02 19:25:00', 'Transport & logistics services', 'contact@atlaslogistics.com', '9876543239', 'www.atlaslogistics.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `facility_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`facility_id`, `name`, `description`, `icon`) VALUES
(1, 'AC', 'Air-conditioned room for comfort', 'fa-snowflake'),
(2, 'Fan', 'Ceiling/stand fan for cooling', 'fa-fan'),
(3, 'Attached Bathroom', 'Private bathroom attached to room', 'fa-bath'),
(4, 'Hot Water / Geyser', '24x7 hot water facility', 'fa-shower'),
(5, 'Toiletries', 'Soap, shampoo, conditioner, etc.', 'fa-pump-soap'),
(6, 'Towels & Bathrobe', 'Clean towels and bathrobe provided', 'fa-bath'),
(7, 'Wardrobe / Closet', 'Wardrobe or closet available', 'fa-archive'),
(8, 'Mirror', 'Full length / dressing mirror', 'fa-user'),
(9, 'Iron', 'Iron available in room', 'fa-tshirt'),
(10, 'Hair Dryer', 'Hair dryer provided', 'fa-wind'),
(11, 'Single Bed', 'Single occupancy bed', 'fa-bed'),
(12, 'Double Bed', 'Double bed for two persons', 'fa-bed'),
(13, 'Queen Bed', 'Queen size bed', 'fa-bed'),
(14, 'King Bed', 'King size bed for extra comfort', 'fa-bed'),
(15, 'Extra Mattress', 'Extra mattress available on request', 'fa-plus'),
(16, 'LED TV', 'Flat screen LED TV', 'fa-tv'),
(17, 'Cable Channels', 'Local + International TV channels', 'fa-satellite-dish'),
(18, 'Smart TV / Netflix', 'Smart TV with OTT apps', 'fa-tv'),
(19, 'Music System', 'Speakers or music dock', 'fa-music'),
(20, 'Mini Fridge', 'Mini refrigerator provided', 'fa-wine-bottle'),
(21, 'Complimentary Water', '2 free water bottles daily', 'fa-tint'),
(22, 'Welcome Drink', 'Welcome drink on arrival', 'fa-coffee'),
(23, 'Breakfast Included', 'Free breakfast provided', 'fa-utensils'),
(24, 'Tea/Coffee Maker', 'Electric kettle or coffee maker', 'fa-mug-hot'),
(25, 'Room Service', '24x7 room service available', 'fa-concierge-bell'),
(26, 'Daily Housekeeping', 'Room cleaned daily', 'fa-broom'),
(27, 'Free Wi-Fi', 'High speed Wi-Fi included', 'fa-wifi'),
(28, 'Intercom', 'Telephone/Intercom available', 'fa-phone'),
(29, 'Work Desk', 'Desk with chair for working', 'fa-chair'),
(30, 'Safe Locker', 'Electronic safe provided', 'fa-lock'),
(31, 'Key Card Access', 'Smart key card door lock', 'fa-key'),
(32, 'CCTV Security', '24x7 security cameras', 'fa-video'),
(33, 'Fire Extinguisher', 'Fire safety equipment', 'fa-fire-extinguisher'),
(34, 'Smoke Detector', 'Smoke alarm in room', 'fa-smog'),
(35, 'Private Balcony', 'Balcony with seating area', 'fa-door-open'),
(36, 'Sea View', 'Room with sea-facing view', 'fa-water'),
(37, 'Pool View', 'View of swimming pool', 'fa-swimmer'),
(38, 'Garden View', 'View of garden/park', 'fa-leaf'),
(39, 'City View', 'View of the city', 'fa-city'),
(40, 'Mountain View', 'View of mountains', 'fa-mountain'),
(41, 'Sofa / Sitting Area', 'Sofa or lounge chair provided', 'fa-couch'),
(42, 'Soundproof Windows', 'Noise-free windows installed', 'fa-volume-mute'),
(43, 'Lift Access', 'Elevator available', 'fa-elevator'),
(44, 'Parking Available', 'Car parking facility', 'fa-parking'),
(45, 'Power Backup', '24x7 electricity backup', 'fa-bolt'),
(46, 'Laundry Service', 'Clothes washing service available', 'fa-soap'),
(47, 'Luggage Storage', 'Storage for extra luggage', 'fa-suitcase-rolling'),
(48, 'Baby Cot / Cradle', 'Baby cot available on request', 'fa-baby'),
(49, 'Extra Bed', 'Extra bed available on request', 'fa-bed'),
(50, 'Pet Friendly', 'Pets allowed in property', 'fa-dog'),
(51, 'Smoking Allowed', 'Smoking permitted in specific area', 'fa-smoking'),
(52, 'Non-Smoking Room', 'Strictly non-smoking room', 'fa-ban-smoking'),
(53, 'Swimming Pool', 'Pool access available', 'fa-swimmer'),
(54, 'Gym / Fitness', 'Fitness center access', 'fa-dumbbell'),
(55, 'Spa & Wellness', 'Spa or massage service', 'fa-spa'),
(56, 'Play Area', 'Children play area available', 'fa-child'),
(57, 'Restaurant', 'In-house restaurant', 'fa-utensils'),
(58, 'Bar', 'In-house bar/lounge', 'fa-glass-martini'),
(59, 'Conference Room', 'Meeting/Conference room available', 'fa-briefcase'),
(60, 'Banquet Hall', 'Hall for parties/events', 'fa-hotel');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(150) NOT NULL,
  `place` varchar(150) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `manager` varchar(150) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `place`, `country`, `state`, `city`, `company_id`, `contact_number`, `manager`, `created_by`, `is_deleted`, `created_at`) VALUES
(1, 'Head Office', 'Downtown', 'India', 'Maharashtra', 'Mumbai', 1, '9876543214', 'Alice Johnson', 1, 0, '2023-01-14 18:00:00'),
(2, 'Branch Office', 'Andheri', 'India', 'Maharashtra', 'Mumbai', 1, '9876543211', 'Bob Smith', 1, 0, '2023-01-14 18:00:00'),
(3, 'Main Campus', 'Sector 21', 'India', 'Delhi', 'New Delhi', 2, '9876543212', 'Carol White', 3, 0, '2022-11-30 16:50:00'),
(4, 'R&D Lab', 'Tech Park', 'India', 'Karnataka', 'Bangalore', 3, '9876543213', 'Eve Green', 5, 0, '2021-07-20 19:30:00'),
(5, 'Corporate HQ', 'Financial District', 'India', 'Maharashtra', 'Mumbai', 4, '9876543214', 'Grace Hill', 7, 0, '2022-03-04 23:15:00'),
(6, 'Site Office', 'Andheri East', 'India', 'Maharashtra', 'Mumbai', 4, '9876543215', 'Hank Adams', 7, 0, '2022-03-04 23:15:00'),
(7, 'Main Office', 'Sector 9', 'India', 'Tamil Nadu', 'Chennai', 5, '9876543216', 'Ivy Scott', 9, 0, '2023-05-16 15:40:00'),
(8, 'Branch Office', 'Guindy', 'India', 'Tamil Nadu', 'Chennai', 5, '9876543217', 'Jack Lee', 9, 0, '2023-05-16 15:40:00'),
(9, 'Headquarters', 'Industrial Area', 'India', 'Karnataka', 'Bangalore', 6, '9876543218', 'Frank Black', 5, 0, '2021-11-29 18:55:00'),
(10, 'Satellite Office', 'Whitefield', 'India', 'Karnataka', 'Bangalore', 6, '9876543219', 'Grace Hill', 5, 0, '2021-11-29 18:55:00'),
(11, 'Main Branch', 'Sector 15', 'India', 'Gujarat', 'Ahmedabad', 7, '9876543220', 'Hank Adams', 7, 0, '2022-06-10 00:10:00'),
(12, 'Annex Office', 'Navrangpura', 'India', 'Gujarat', 'Ahmedabad', 7, '9876543221', 'Ivy Scott', 7, 0, '2022-06-10 00:10:00'),
(13, 'Corporate Office', 'Sector 10', 'India', 'Maharashtra', 'Pune', 8, '9876543222', 'Jack Lee', 9, 0, '2023-02-27 16:30:00'),
(14, 'Development Center', 'Hinjewadi', 'India', 'Maharashtra', 'Pune', 8, '9876543223', 'Alice Johnson', 9, 0, '2023-02-27 16:30:00'),
(15, 'Head Office', 'Sector 5', 'India', 'Delhi', 'New Delhi', 9, '9876543224', 'Bob Smith', 5, 0, '2021-09-17 21:45:00'),
(16, 'Regional Office', 'Connaught Place', 'India', 'Delhi', 'New Delhi', 10, '9876543225', 'Carol White', 3, 0, '2022-08-04 18:20:00'),
(17, 'HQ', 'Sector 12', 'India', 'Maharashtra', 'Mumbai', 11, '9876543226', 'Eve Green', 1, 0, '2023-04-11 21:00:00'),
(18, 'Branch', 'Andheri West', 'India', 'Maharashtra', 'Mumbai', 12, '9876543227', 'Frank Black', 1, 0, '2021-05-19 17:15:00'),
(19, 'Corporate Office', 'Sector 7', 'India', 'Karnataka', 'Bangalore', 13, '9876543228', 'Grace Hill', 3, 0, '2022-10-10 19:45:00'),
(20, 'R&D Center', 'Electronic City', 'India', 'Karnataka', 'Bangalore', 14, '9876543229', 'Hank Adams', 3, 0, '2023-01-24 22:50:00'),
(21, 'Branch', 'MG Road', 'India', 'Karnataka', 'Bangalore', 30, '9876543214', 'Anita Sharma', 1, 0, '2025-10-01 00:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `can_create` tinyint(1) NOT NULL DEFAULT 0,
  `can_read` tinyint(1) NOT NULL DEFAULT 0,
  `can_update` tinyint(1) NOT NULL DEFAULT 0,
  `can_delete` tinyint(1) NOT NULL DEFAULT 0,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `can_create`, `can_read`, `can_update`, `can_delete`, `company_id`, `created_at`) VALUES
(1, 'Admin', 1, 1, 1, 1, 1, '2025-09-22 03:17:08'),
(2, 'Manager', 1, 1, 1, 0, 1, '2025-09-23 03:04:14'),
(3, 'Staff', 0, 1, 0, 0, 1, '2025-09-23 03:04:14'),
(4, 'Accountant', 0, 1, 1, 0, 2, '2025-09-25 22:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_type` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `room_view` varchar(100) DEFAULT NULL,
  `total_inventory` int(11) NOT NULL DEFAULT 1,
  `booked_count` int(11) NOT NULL DEFAULT 0,
  `available_count` int(11) GENERATED ALWAYS AS (`total_inventory` - `booked_count`) STORED,
  `base_price_per_night` decimal(10,2) NOT NULL,
  `gst_percent` decimal(5,2) NOT NULL DEFAULT 0.00,
  `final_price` decimal(10,2) GENERATED ALWAYS AS (`base_price_per_night` + `base_price_per_night` * `gst_percent` / 100) STORED,
  `status` enum('active','inactive') DEFAULT 'active',
  `notes` text DEFAULT NULL,
  `terms_conditions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `location_id`, `room_name`, `room_type`, `description`, `room_view`, `total_inventory`, `booked_count`, `base_price_per_night`, `gst_percent`, `status`, `notes`, `terms_conditions`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 1, '101', 'Deluxe', 'Spacious deluxe room with balcony and sea view. Perfect for couples or solo travelers.', 'Sea View', 5, 0, 4500.00, 18.00, 'active', 'No smoking. Complimentary water bottles included.', 'Check-in after 2 PM, check-out before 11 AM. Breakfast included.', '2025-10-08 05:54:13', '2025-10-08 05:54:13', 1),
(3, 1, '102', 'Deluxe', 'Modern deluxe room with city skyline view. Ideal for business travelers.', 'City View', 5, 0, 4200.00, 18.00, 'active', 'Smoking allowed in designated area. Complimentary tea/coffee.', 'Check-in after 2 PM, check-out before 11 AM. Breakfast not included.', '2025-10-08 06:17:08', '2025-10-08 06:17:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `room_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`room_id`, `facility_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 16),
(1, 22),
(1, 27),
(3, 1),
(3, 3),
(3, 16),
(3, 18),
(3, 27),
(3, 29);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `company_id`, `location_id`, `name`, `email`, `password`, `role_id`, `created_by`, `created_at`) VALUES
(1, 1, NULL, 'Roman Roy', 'roman@example.com', '$2y$10$L6QmixQ9KVYVHLx/uDDg0.45JVo/9cPvhlknPbFZpUCC7ewcubpYW', 1, NULL, '2025-09-22 03:17:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `company_location` (`company_id`,`location_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`room_id`,`facility_id`),
  ADD KEY `facility_id` (`facility_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE;

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `room_facilities_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_facilities_ibfk_2` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`facility_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;
