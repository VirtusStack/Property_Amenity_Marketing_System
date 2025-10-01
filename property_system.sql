- Database: `property_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
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
(1, 'Apex Solutions', '2023-01-14 23:30:00', 'IT services & consulting', 'contact@apexsolutions.com', '9876543210', 'www.apexsolutions.com', 0),
(2, 'BrightTech', '2022-11-30 22:20:00', 'Software development', 'info@brighttech.com', '9876543211', 'www.brighttech.com', 0),
(3, 'GreenFields Corp', '2021-07-21 01:00:00', 'Agriculture & farming', 'hello@greenfields.com', '9876543212', 'www.greenfields.com', 0),
(4, 'UrbanBuild', '2022-03-05 04:45:00', 'Construction services', 'support@urbanbuild.com', '9876543213', 'www.urbanbuild.com', 0),
(5, 'QuantumSoft', '2023-05-16 21:10:00', 'IT solutions & software', 'contact@quantumsoft.com', '9876543214', 'www.quantumsoft.com', 0),
(6, 'EcoEnergy', '2021-11-30 00:25:00', 'Renewable energy provider', 'info@ecoenergy.com', '9876543215', 'www.ecoenergy.com', 0),
(7, 'Stellar Media', '2022-06-10 05:40:00', 'Digital marketing agency', 'hello@stellarmedia.com', '9876543216', 'www.stellarmedia.com', 0),
(8, 'Horizon Ventures', '2023-02-27 22:00:00', 'Venture capital & finance', 'contact@horizonventures.com', '9876543217', 'www.horizonventures.com', 0),
(9, 'BlueWave Technologies', '2021-09-18 03:15:00', 'Tech solutions provider', 'support@bluewave.com', '9876543218', 'www.bluewave.com', 0),
(10, 'Nova Pharma', '2022-08-04 23:50:00', 'Pharmaceutical company', 'info@novapharma.com', '9876543219', 'www.novapharma.com', 0),
(11, 'Summit Logistics', '2023-04-12 02:30:00', 'Supply chain services', 'contact@summitlogistics.com', '9876543220', 'www.summitlogistics.com', 0),
(12, 'Crystal Interiors', '2021-05-19 22:45:00', 'Interior design firm', 'hello@crystalinteriors.com', '9876543221', 'www.crystalinteriors.com', 0),
(13, 'Prime Foods', '2022-10-11 01:15:00', 'Food & beverage company', 'info@primefoods.com', '9876543222', 'www.primefoods.com', 0),
(14, 'SilverLine Automotives', '2023-01-25 04:20:00', 'Automotive manufacturer', 'contact@silverlineauto.com', '9876543223', 'www.silverlineauto.com', 0),
(15, 'Vertex Analytics', '2021-12-14 21:35:00', 'Data analytics services', 'hello@vertexanalytics.com', '9876543224', 'www.vertexanalytics.com', 0),
(16, 'Infinity Media', '2022-02-17 23:05:00', 'Media & entertainment', 'info@infinitymedia.com', '9876543225', 'www.infinitymedia.com', 0),
(17, 'Alpha Robotics', '2023-03-07 03:50:00', 'Robotics & AI solutions', 'contact@alpharobotics.com', '9876543226', 'www.alpharobotics.com', 0),
(18, 'GreenLeaf Organics', '2021-08-22 00:40:00', 'Organic farming & products', 'hello@greenleaf.com', '9876543227', 'www.greenleaf.com', 0),
(19, 'Titan Security', '2022-09-29 22:15:00', 'Security solutions', 'info@titansecurity.com', '9876543228', 'www.titansecurity.com', 0),
(20, 'Orion Tech Labs', '2023-06-01 05:00:00', 'Technology R&D lab', 'contact@oriontech.com', '9876543229', 'www.oriontech.com', 0),
(21, 'Phoenix IT Solutions', '2023-07-12 00:20:00', 'Custom software solutions', 'contact@phoenixit.com', '9876543230', 'www.phoenixit.com', 0),
(22, 'BlueSky Enterprises', '2022-11-05 03:10:00', 'Business consultancy', 'info@bluesky.com', '9876543231', 'www.bluesky.com', 0),
(23, 'EverGreen Tech', '2023-01-29 22:45:00', 'Sustainable technology', 'hello@evergreentech.com', '9876543232', 'www.evergreentech.com', 0),
(24, 'NextGen Robotics', '2022-08-22 02:35:00', 'AI & robotics solutions', 'contact@nextgenrobotics.com', '9876543233', 'www.nextgenrobotics.com', 0),
(25, 'SilverWave Media', '2021-12-13 23:50:00', 'Media & digital marketing', 'info@silverwavemedia.com', '9876543234', 'www.silverwavemedia.com', 0),
(26, 'Orchid Pharmaceuticals', '2023-03-19 05:05:00', 'Pharmaceutical R&D', 'hello@orchidpharma.com', '9876543235', 'www.orchidpharma.com', 0),
(27, 'Summit Tech Labs', '2022-05-11 01:30:00', 'Technology research lab', 'contact@summittechlabs.com', '9876543236', 'www.summittechlabs.com', 0),
(28, 'UrbanLeaf Organics', '2021-09-27 22:15:00', 'Organic food products', 'info@urbanleaf.com', '9876543237', 'www.urbanleaf.com', 0),
(29, 'Vortex Security', '2023-06-21 04:40:00', 'Cybersecurity solutions', 'hello@vortexsecurity.com', '9876543238', 'www.vortexsecurity.com', 0),
(30, 'Atlas Logistics', '2022-10-03 00:55:00', 'Transport & logistics services', 'contact@atlaslogistics.com', '9876543239', 'www.atlaslogistics.com', 0);

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
(1, 'Head Office', 'Downtown', 'India', 'Maharashtra', 'Mumbai', 1, '9876543214', 'Alice Johnson', 1, 0, '2023-01-14 23:30:00'),
(2, 'Branch Office', 'Andheri', 'India', 'Maharashtra', 'Mumbai', 1, '9876543211', 'Bob Smith', 1, 0, '2023-01-14 23:30:00'),
(3, 'Main Campus', 'Sector 21', 'India', 'Delhi', 'New Delhi', 2, '9876543212', 'Carol White', 3, 0, '2022-11-30 22:20:00'),
(4, 'R&D Lab', 'Tech Park', 'India', 'Karnataka', 'Bangalore', 3, '9876543213', 'Eve Green', 5, 0, '2021-07-21 01:00:00'),
(5, 'Corporate HQ', 'Financial District', 'India', 'Maharashtra', 'Mumbai', 4, '9876543214', 'Grace Hill', 7, 0, '2022-03-05 04:45:00'),
(6, 'Site Office', 'Andheri East', 'India', 'Maharashtra', 'Mumbai', 4, '9876543215', 'Hank Adams', 7, 0, '2022-03-05 04:45:00'),
(7, 'Main Office', 'Sector 9', 'India', 'Tamil Nadu', 'Chennai', 5, '9876543216', 'Ivy Scott', 9, 0, '2023-05-16 21:10:00'),
(8, 'Branch Office', 'Guindy', 'India', 'Tamil Nadu', 'Chennai', 5, '9876543217', 'Jack Lee', 9, 0, '2023-05-16 21:10:00'),
(9, 'Headquarters', 'Industrial Area', 'India', 'Karnataka', 'Bangalore', 6, '9876543218', 'Frank Black', 5, 0, '2021-11-30 00:25:00'),
(10, 'Satellite Office', 'Whitefield', 'India', 'Karnataka', 'Bangalore', 6, '9876543219', 'Grace Hill', 5, 0, '2021-11-30 00:25:00'),
(11, 'Main Branch', 'Sector 15', 'India', 'Gujarat', 'Ahmedabad', 7, '9876543220', 'Hank Adams', 7, 0, '2022-06-10 05:40:00'),
(12, 'Annex Office', 'Navrangpura', 'India', 'Gujarat', 'Ahmedabad', 7, '9876543221', 'Ivy Scott', 7, 0, '2022-06-10 05:40:00'),
(13, 'Corporate Office', 'Sector 10', 'India', 'Maharashtra', 'Pune', 8, '9876543222', 'Jack Lee', 9, 0, '2023-02-27 22:00:00'),
(14, 'Development Center', 'Hinjewadi', 'India', 'Maharashtra', 'Pune', 8, '9876543223', 'Alice Johnson', 9, 0, '2023-02-27 22:00:00'),
(15, 'Head Office', 'Sector 5', 'India', 'Delhi', 'New Delhi', 9, '9876543224', 'Bob Smith', 5, 0, '2021-09-18 03:15:00'),
(16, 'Regional Office', 'Connaught Place', 'India', 'Delhi', 'New Delhi', 10, '9876543225', 'Carol White', 3, 0, '2022-08-04 23:50:00'),
(17, 'HQ', 'Sector 12', 'India', 'Maharashtra', 'Mumbai', 11, '9876543226', 'Eve Green', 1, 0, '2023-04-12 02:30:00'),
(18, 'Branch', 'Andheri West', 'India', 'Maharashtra', 'Mumbai', 12, '9876543227', 'Frank Black', 1, 0, '2021-05-19 22:45:00'),
(19, 'Corporate Office', 'Sector 7', 'India', 'Karnataka', 'Bangalore', 13, '9876543228', 'Grace Hill', 3, 0, '2022-10-11 01:15:00'),
(20, 'R&D Center', 'Electronic City', 'India', 'Karnataka', 'Bangalore', 14, '9876543229', 'Hank Adams', 3, 0, '2023-01-25 04:20:00');


-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `property_name` varchar(150) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Admin', 1, 1, 1, 1, 1, '2025-09-22 14:17:08'),
(2, 'Manager', 1, 1, 1, 0, 1, '2025-09-23 14:04:14'),
(3, 'Staff', 0, 1, 0, 0, 1, '2025-09-24 14:04:14'),
(4, 'Accountant', 0, 1, 1, 0, 2, '2025-09-25 09:44:38');

--

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `company_id`, `location_id`, `name`, `email`, `password`, `role_id`, `created_at`) VALUES
(1, 1, NULL, 'Roman Roy', 'roman@example.com', '$2y$10$L6QmixQ9KVYVHLx/uDDg0.45JVo/9cPvhlknPbFZpUCC7ewcubpYW', 1, '2025-09-20 14:17:08'),
(4, 1, NULL, 'Manager User', 'manager@example.com', '$2y$10$CwTycUXWue0Thq9StjUM0uJ8G0u7d0Q4Z5HzZRMEpGQlQxk6h8Jm', 2, '2025-09-22 14:04:57'),
(5, 1, NULL, 'Staff User', 'staff@example.com', '$2y$10$CwTycUXWue0Thq9StjUM0uJ8G0u7d0Q4Z5HzZRMEpGQlQxk6h8Jm', 3, '2025-09-23 14:04:57'),
(10, 1, 2, 'Daniel Walkar', 'walkar@gmail.com', '$2y$10$8YrZCdUFIXJ2LEtvuvFAteOlBObKYIL7hVMrbOjlTAbvAfiO3Ua/S', 3, '2025-09-23 05:15:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `company_id` (`company_id`);

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
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE;

--

--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE SET NULL;

ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE;


ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;
