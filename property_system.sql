-- Database: `property_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
---

CREATE TABLE `areas` (
  `area_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `area_name` varchar(150) NOT NULL,
  `plugin_type` enum('spa','play_area','gym','banquet_hall','conference_room') NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`area_id`, `location_id`, `area_name`, `plugin_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tranquil Spa', 'spa', 'Relaxing body spa and therapy zone', 'active', '2025-10-25 05:12:05', '2025-10-25 05:28:36'),
(2, 1, 'Infinity Gym', 'gym', 'Fully equipped fitness area with trainer', 'active', '2025-10-25 05:12:05', '2025-10-25 05:12:05'),
(3, 1, 'Banquet Elegance Hall', 'banquet_hall', 'Premium indoor banquet for events', 'active', '2025-10-25 05:12:05', '2025-10-25 05:12:05'),
(4, 2, 'Sunshine Play Area', 'play_area', 'Kids entertainment and fun area', 'active', '2025-10-25 05:12:03', '2025-10-25 05:12:05'),
(5, 2, 'Lotus Conference Room', 'conference_room', 'Corporate meeting and seminar hall', 'active', '2025-10-25 11:32:15', '2025-10-25 11:32:15'),
(6, 2, 'Aqua Spa', 'spa', 'Luxury massage and facial spa', 'active', '2025-10-26 11:40:05', '2025-10-26 11:40:05'),
(7, 3, 'Skyline Gym', 'gym', 'High-rise fitness zone with trainer support', 'active', '2025-10-26 01:21:06', '2025-10-26 01:21:05'),
(8, 3, 'Royal Banquet', 'banquet_hall', 'Elegant banquet hall for functions', 'active', '2025-10-26 05:12:06', '2025-10-26 05:12:05'),
(9, 3, 'Galaxy Play Zone', 'play_area', 'Children-friendly gaming area', 'active', '2025-10-26 06:12:25', '2025-10-26 06:12:25'),
(10, 3, 'Ocean View Conference', 'conference_room', 'Sea-view meeting and presentation room', 'active', '2025-10-27 04:12:55', '2025-10-27 04:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `area_tickets`
--

CREATE TABLE `area_tickets` (
  `ticket_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `member_type` enum('member','non_member') DEFAULT 'non_member',
  `customer_name` varchar(100) NOT NULL,
  `customer_mobile` varchar(15) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `ticket_number` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `status` enum('active','cancelled') DEFAULT 'active',
  `booking_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area_tickets`
--

INSERT INTO `area_tickets` (`ticket_id`, `area_id`, `member_type`, `customer_name`, `customer_mobile`, `customer_email`, `ticket_number`, `price`, `status`, `booking_date`) VALUES
(1, 1, 'member', 'Ravi Sharma', '9876500011', 'ravi@example.com', 'TKT2025-0001', 700.00, 'active', '2025-10-27 10:42:52'),
(2, 2, 'non_member', 'Priya Verma', '9876500012', 'priya@example.com', 'TKT2025-0002', 500.00, 'active', '2025-10-27 10:42:52'),
(3, 3, 'member', 'Amit Singh', '9876500013', 'amit@example.com', 'TKT2025-0003', 1200.00, 'active', '2025-10-27 10:42:52'),
(4, 4, 'non_member', 'Karan Joshi', '9876500014', 'karan@example.com', 'TKT2025-0004', 300.00, 'cancelled', '2025-10-27 10:42:52'),
(5, 5, 'member', 'Divya Kapoor', '9876500015', 'divya@example.com', 'TKT2025-0005', 1000.00, 'active', '2025-10-28 12:22:12'),
(6, 6, 'non_member', 'Sneha Agarwal', '9876500016', 'sneha@example.com', 'TKT2025-0006', 700.00, 'active', '2025-10-28 12:42:32'),
(7, 7, 'member', 'Ankit Patel', '9876500017', 'ankit@example.com', 'TKT2025-0007', 450.00, 'active', '2025-10-28 04:02:12'),
(8, 8, 'non_member', 'Komal Jain', '9876500018', 'komal@example.com', 'TKT2025-0008', 900.00, 'cancelled', '2025-10-28 05:19:52'),
(9, 9, 'member', 'Neha Rana', '9876500019', 'neha@example.com', 'TKT2025-0009', 600.00, 'active', '2025-10-29 10:42:52'),
(10, 10, 'non_member', 'Arjun Desai', '9876500020', 'arjun@example.com', 'TKT2025-0010', 550.00, 'active', '2025-10-29 10:52:22'),
(11, 4, 'non_member', 'Pravin Roy', '5678909032', 'pravin@example.com', 'TKT2025-0011', 250.00, 'active', '2025-10-29 14:46:40');
-

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
(30, 'Atlas Logistics', '2022-10-02 19:25:00', 'Transport & logistics services', 'contact@atlaslogistics.com', '9876543239', 'www.atlaslogistics.com', 0),
(31, 'Sunrise Hospitality', '2025-10-13 10:59:11', 'Hotel & Resorts Management', 'contact@sunrise.com', '9876500010', 'www.sunrise.com', 0),
(32, 'Moonlight Resorts', '2025-10-13 10:59:11', 'Luxury resorts & spa services', 'info@moonlight.com', '9876500020', 'www.moonlight.com', 0);

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
(21, 'Branch', 'MG Road', 'India', 'Karnataka', 'Bangalore', 30, '9876543214', 'Anita Sharma', 1, 0, '2025-10-01 00:50:09'),
(22, 'Head Office', 'MG Road', 'India', 'Maharashtra', 'Mumbai', 29, '9876543214', 'Anita Sharma', 1, 0, '2025-10-10 05:53:43'),
(25, 'Sunrise Beach', 'Goa Beach', 'India', 'Goa', 'Goa', 31, '9876500011', 'John Sunrise', NULL, 0, '2025-10-13 10:59:41'),
(26, 'Moonlight Hills', 'Himalayan Range', 'India', 'Himachal Pradesh', 'Shimla', 32, '9876500021', 'Alice Moon', NULL, 0, '2025-10-13 10:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `location_plugins`
--

CREATE TABLE `location_plugins` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL,
  `is_enabled` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_plugins`
--

INSERT INTO `location_plugins` (`id`, `location_id`, `plugin_id`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-10-18 05:37:15', '2025-10-15 09:38:21'),
(2, 1, 2, 1, '2025-10-18 05:37:15', '2025-10-15 12:06:15'),
(3, 1, 3, 0, '2025-10-18 05:37:15', '2025-10-16 12:49:53'),
(7, 1, 6, 1, '2025-10-25 13:05:29', '2025-10-29 13:05:29'),
(8, 1, 7, 1, '2025-10-27 05:00:19', '2025-10-29 06:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `parking_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `parking_name` varchar(100) NOT NULL,
  `parking_number` varchar(50) DEFAULT NULL,
  `vehicle_number` varchar(50) DEFAULT NULL,
  `type` enum('Car','Bike','Bus','Truck','All') DEFAULT 'All',
  `capacity` int(11) DEFAULT 0,
  `is_covered` tinyint(1) DEFAULT 0,
  `charging_point_available` tinyint(1) DEFAULT 0,
  `status` enum('Available','Full','Maintenance') DEFAULT 'Available',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`parking_id`, `location_id`, `parking_name`, `parking_number`, `vehicle_number`, `type`, `capacity`, `is_covered`, `charging_point_available`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Front Parking', 'P001', 'MH12AB3456', 'Car', 20, 0, 1, 'Available', 'Open car parking near entrance', '2025-10-18 11:15:56', '2025-10-16 11:15:56'),
(2, 1, 'Basement Parking', 'P002', NULL, 'Car', 30, 1, 0, 'Available', 'Covered basement parking area', '2025-10-18 11:15:56', '2025-10-16 11:15:56'),
(3, 2, 'Bike Zone', 'P003', 'MH14XY9876', 'Bike', 15, 0, 0, 'Full', 'Dedicated bike parking area', '2025-10-18 11:15:56', '2025-10-18 11:15:56');
(4, 1, 'Basement Parking', 'P004', 'MH14XY9844', 'Car', 25, 1, 1, 'Available', '', '2025-10-19 07:11:22', '2025-10-19 07:32:31'),
(5, 2, 'Basement Parking', 'P005', 'MH14XY3453', 'Bus', 35, 0, 1, 'Available', '', '2025-10-19 07:28:26', '2025-10-19 07:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `plugin_master`
--

CREATE TABLE `plugin_master` (
  `plugin_id` int(11) NOT NULL,
  `plugin_name` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plugin_master`
--

INSERT INTO `plugin_master` (`plugin_id`, `plugin_name`, `icon`, `description`, `status`, `created_at`) VALUES
(1, 'Restaurant', 'fa-utensils', 'Manage menus, food and buffet options', 'active', '2025-10-15 10:50:24'),
(2, 'Swimming Pool', 'fa-swimmer', 'Manage swimming pool timing and capacity', 'active', '2025-10-16 10:50:24'),
(3, 'Parking', 'fa-parking', 'Manage parking area and vehicle slots', 'active', '2025-10-17 10:50:24'),
(6, 'Area', 'fa-building', 'Manage all areas like Spa, Gym, Banquet Hall, etc.', 'active', '2025-10-25 12:45:33'),
(7, 'Area Ticket', 'fa-ticket-alt', 'Handles ticket booking for areas (Spa, Gym, Banquet Hall, etc.)', 'active', '2025-10-27 10:10:55');


-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `menu_date` date NOT NULL,
  `meal_type` enum('lunch','dinner','buffet') NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `no_of_dishes` int(11) DEFAULT 10,
  `base_price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurant_id`, `location_id`, `restaurant_name`, `menu_date`, `meal_type`, `menu_name`, `no_of_dishes`, `base_price`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 21, 'Sunrise Garden', '2025-10-11', 'lunch', 'Beachside Grill', 10, 599.00, 'Seafood and grills by the beach.', 'active', '2025-10-13 16:31:13', '2025-10-14 10:19:49', 0),
(2, 21, 'Ocean View Dine', '2025-10-11', 'dinner', 'Sunset Buffet', 12, 799.00, 'Buffet with local and international cuisine.', 'active', '2025-10-13 16:31:13', '2025-10-14 10:20:06', 0),
(3, 22, 'Sunrise Garden', '2025-10-12', 'lunch', 'Mountain Feast', 8, 699.00, 'Traditional Himalayan dishes.', 'active', '2025-10-13 16:31:13', '2025-10-14 10:20:20', 0),
(4, 26, 'Ocean View Dine', '2025-10-12', 'dinner', 'Hillside Buffet', 15, 999.00, 'Luxury dinner buffet with desserts.', 'inactive', '2025-10-13 16:31:13', '2025-10-13 19:24:39', 0),
(5, 1, 'Ocean View Dine', '2025-10-13', 'lunch', 'Veg Delight Buffe', 7, 600.00, 'Luxury dinner buffet with desserts.', 'active', '2025-10-13 18:22:55', '2025-10-13 19:26:12', 0);

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
  `max_occupancy` int(11) NOT NULL DEFAULT 1,
  `total_inventory` int(11) NOT NULL DEFAULT 1,
  `booked_count` int(11) NOT NULL DEFAULT 0,
  `available_count` int(11) GENERATED ALWAYS AS (`total_inventory` - `booked_count`) STORED,
  `base_price_per_night` decimal(10,2) NOT NULL,
  `gst_percent` decimal(5,2) NOT NULL DEFAULT 0.00,
  `gst_inclusive` enum('inclusive','exclusive') DEFAULT 'exclusive',
  `final_price` decimal(10,2) GENERATED ALWAYS AS (`base_price_per_night` + `base_price_per_night` * `gst_percent` / 100) STORED,
  `status` enum('active','inactive','maintenance') DEFAULT 'active',
  `notes` text DEFAULT NULL,
  `terms_conditions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `location_id`, `room_name`, `room_type`, `description`, `room_view`, `max_occupancy`, `total_inventory`, `booked_count`, `base_price_per_night`, `gst_percent`, `gst_inclusive`, `status`, `notes`, `terms_conditions`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 26, '101', 'Deluxe', 'Spacious deluxe room with balcony and sea view. Perfect for couples or solo travelers.', 'Sea View', 1, 4, 0, 4500.00, 18.00, 'exclusive', 'active', 'No smoking. Complimentary water bottles included.', 'Check-in after 2 PM, check-out before 11 AM. Breakfast included.', '2025-10-08 05:54:13', '2025-10-13 12:13:55', 1),
(3, 26, '102', 'Deluxe', 'Modern deluxe room with city skyline view. Ideal for business travelers.', 'City View', 1, 5, 0, 4200.00, 18.00, 'exclusive', 'active', 'Smoking allowed in designated area. Complimentary tea/coffee.', 'Check-in after 2 PM, check-out before 11 AM. Breakfast not included.', '2025-10-08 06:17:08', '2025-10-13 12:14:21', 1),
(4, 1, '103', 'Standard', 'Cozy standard room overlooking the garden. Great for short stays.', 'Garden View', 1, 4, 0, 3200.00, 18.00, 'exclusive', 'active', 'No pets allowed. Daily housekeeping included.', 'Check-in after 2 PM, check-out before 11 AM. Breakfast included', '2025-10-08 06:26:54', '2025-10-08 06:26:54', 1),
(5, 1, '104', 'Suite', 'Luxury suite with living area and sea view. Perfect for families or special occasions.', 'Sea View', 1, 2, 0, 7500.00, 18.00, 'exclusive', 'active', 'No smoking. Welcome drink included. Complimentary water bottles.', 'Check-in after 2 PM, check-out before 11 AM. Breakfast included', '2025-10-08 06:29:18', '2025-10-08 06:29:18', 1),
(6, 1, '105', 'Suite', '', 'Sea View', 4, 2, 0, 7500.00, 18.00, 'exclusive', 'active', 'No pets allowed. Daily housekeeping included.', 'Check-in after 2 PM, check-out before 11 AM. Breakfast not included', '2025-10-08 07:31:08', '2025-10-14 04:48:19', 1),
(7, 1, '106', 'Suite', '', 'Sea View', 1, 2, 0, 3500.00, 18.00, 'exclusive', 'active', '', '', '2025-10-08 07:51:23', '2025-10-09 05:20:57', 1),
(8, 21, '107', 'Deluxe', 'Spacious deluxe room with balcony and sea view. Perfect for couples or solo travelers', 'Sea View', 4, 1, 0, 3200.00, 18.00, 'exclusive', 'active', 'No smoking. Welcome drink included. Complimentary water bottles', 'Check-in after 2 PM, check-out before 11 AM. Breakfast not included', '2025-10-09 06:05:32', '2025-10-09 06:05:32', 1),
(9, 21, '101', 'Deluxe', 'Sea view deluxe room with balcony', 'Sea View', 2, 5, 0, 4500.00, 18.00, 'exclusive', 'active', NULL, NULL, '2025-10-13 12:11:29', '2025-10-13 12:11:29', NULL),
(10, 21, '102', 'Suite', 'Luxury suite with ocean view', 'Sea View', 4, 3, 0, 7500.00, 18.00, 'exclusive', 'active', NULL, NULL, '2025-10-13 12:11:29', '2025-10-13 12:11:29', NULL),
(11, 26, '201', 'Standard', 'Cozy mountain view room', 'Mountain View', 2, 4, 0, 3500.00, 18.00, 'exclusive', 'active', '', '', '2025-10-13 12:11:29', '2025-10-13 12:14:37', NULL),
(13, 25, '102', 'Deluxe', '', 'Garden View', 1, 4, 0, 4100.00, 18.00, 'exclusive', 'active', '', '', '2025-10-13 13:29:45', '2025-10-13 13:29:45', 1),
(14, 25, '105', 'Deluxe', '', 'Garden View', 2, 6, 0, 4100.00, 18.00, 'exclusive', 'active', '', '', '2025-10-14 04:05:12', '2025-10-14 04:05:12', 1),
(15, 26, '102', 'Deluxe', '', 'Garden View', 4, 4, 0, 3200.00, 18.00, 'exclusive', 'active', '', '', '2025-10-14 04:40:11', '2025-10-14 04:40:11', 1),
(16, 26, '102', 'Deluxe', '', 'Garden View', 4, 4, 0, 3200.00, 18.00, 'exclusive', 'active', '', 'Check-in after 2 PM, check-out before 11 AM. Breakfast included', '2025-10-14 04:45:09', '2025-10-14 04:46:15', 1),
(17, 25, '204', 'Standard', '', 'Sea View', 3, 4, 0, 5100.00, 18.00, 'exclusive', 'active', '', '', '2025-10-14 06:12:51', '2025-10-14 06:12:51', 1),
(18, 26, '204', 'Suite', '', 'City View', 4, 4, 0, 5600.00, 18.00, 'exclusive', 'active', '', '', '2025-10-14 10:38:44', '2025-10-14 10:49:00', 1);

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
(1, 3),
(1, 12),
(1, 16),
(3, 1),
(3, 3),
(3, 5),
(3, 13),
(3, 16),
(4, 1),
(4, 3),
(4, 16),
(4, 18),
(4, 24),
(4, 27),
(5, 1),
(5, 3),
(5, 16),
(5, 18),
(5, 20),
(5, 24),
(5, 27),
(5, 41),
(6, 1),
(6, 3),
(6, 4),
(6, 14),
(6, 16),
(7, 3),
(7, 8),
(7, 16),
(7, 29),
(8, 1),
(8, 3),
(13, 3),
(13, 23),
(13, 58),
(14, 1),
(14, 3),
(14, 12),
(14, 16),
(14, 28),
(16, 1),
(16, 3),
(16, 14),
(16, 16),
(17, 1),
(17, 3),
(17, 12),
(17, 16),
(18, 1),
(18, 3),
(18, 14),
(18, 16);

-- --------------------------------------------------------

--
-- Table structure for table `swimming_pools`
--

CREATE TABLE `swimming_pools` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `capacity` int(11) DEFAULT NULL,
  `instructor_available` tinyint(1) DEFAULT 0,
  `lifeguard_available` tinyint(1) DEFAULT 0,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `access_type` varchar(50) DEFAULT NULL,
  `max_charge` decimal(10,2) DEFAULT NULL,
  `price_per_hour` decimal(10,2) DEFAULT NULL,
  `price_per_day` decimal(10,2) DEFAULT NULL,
  `safety_rules` text DEFAULT NULL,
  `terms_conditions` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `swimming_pools`
--

INSERT INTO `swimming_pools` (`id`, `location_id`, `name`, `type`, `status`, `capacity`, `instructor_available`, `lifeguard_available`, `opening_time`, `closing_time`, `access_type`, `max_charge`, `price_per_hour`, `price_per_day`, `safety_rules`, `terms_conditions`, `instructions`, `created_at`, `updated_at`) VALUES
(1, 1, 'Blue Lagoon', 'Outdoor', 'active', 40, 1, 1, '06:00:00', '20:00:00', 'Public', 500.00, 50.00, 400.00, 'No running, no diving in shallow end, shower before entering.', 'Children must be supervised, management not responsible for lost items.', 'Use the designated swimming lanes for lap swimming.', '2025-10-16 12:43:14', '2025-10-18 12:47:16'),
(2, 2, 'Aqua Paradise', 'Indoor', 'active', 30, 0, 1, '08:00:00', '22:00:00', 'Guests only', 800.00, 100.00, 700.00, 'No glass bottles, no food in pool area.', 'Booking required for guests, no refund on cancellations.', 'Wear proper swimwear, follow lifeguard instructions.', '2025-10-16 12:43:14', '2025-10-16 12:43:14'),
(3, 3, 'Infinity Splash', 'Infinity / Outdoor', 'inactive', 40, 1, 0, '07:00:00', '19:00:00', 'Private', 1200.00, 150.00, 1000.00, 'No diving near edge, no running.', 'Membership required, no children under 12.', 'Use designated lounge area before entering the pool.', '2025-10-17 12:43:14', '2025-10-17 12:43:14'),
(4, 1, 'Crystal Waters', 'Indoor', 'active', 25, 1, 1, '09:00:00', '21:00:00', 'Public', 600.00, 60.00, 500.00, 'No running, no diving, children must be supervised.', 'No refund on cancellations.', 'Follow lane markings for lap swimming.', '2025-10-18 12:43:14', '2025-10-18 12:43:14'),
(5, 2, 'Sunset Pool', 'Outdoor', 'active', 60, 0, 1, '06:30:00', '19:30:00', 'Public', 700.00, 70.00, 600.00, 'No diving in shallow end, no food in pool area.', 'Children must be accompanied by adults.', 'Follow lifeguard instructions.', '2025-10-18 12:43:14', '2025-10-18 12:43:14'),
(6, 3, 'Aqua Dome', 'Indoor', 'inactive', 35, 1, 0, '07:30:00', '20:30:00', 'Private', 900.00, 90.00, 750.00, 'Proper swimwear required, no running.', 'Membership required.', 'Children under 12 not allowed without adult.', '2025-10-18 12:43:14', '2025-10-18 12:43:14'),
(7, 1, 'Wave Rider', 'Outdoor', 'active', 45, 1, 1, '08:00:00', '18:00:00', 'Public', 550.00, 55.00, 450.00, 'No diving in shallow end.', 'Follow lifeguard instructions.', 'Use lane markings for swimming.', '2025-10-18 12:43:14', '2025-10-18 12:43:14'),
(8, 2, 'Lagoon Retreat', 'Infinity / Outdoor', 'active', 50, 0, 1, '06:00:00', '21:00:00', 'Guests only', 1000.00, 100.00, 850.00, 'No running, no diving near edge.', 'Booking required for guests.', 'Follow lifeguard instructions.', '2025-10-18 12:43:14', '2025-10-18 12:43:14'),
(9, 3, 'Coral Cove', 'Indoor', 'active', 30, 1, 1, '07:00:00', '22:00:00', 'Private', 800.00, 80.00, 700.00, 'Proper swimwear required, no running.', 'Membership required.', 'Children under 12 not allowed without adult.', '2025-10-18 12:43:14', '2025-10-18 12:43:14'),
(10, 1, 'Ocean Breeze', 'Outdoor', 'inactive', 40, 1, 0, '06:30:00', '20:30:00', 'Public', 750.00, 75.00, 600.00, 'No diving, shower before entering.', 'Children must be accompanied by adults.', 'Use lane markings for lap swimming.', '2025-10-18 12:43:14', '2025-10-18 12:43:14');

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
(1, 1, 1, 'Roman Roy', 'roman@example.com', '$2y$10$fHJ0wvrXNLHEfVOT/17qDOyWQ76hDEutVi90zJTly446CMzQsp9zq', 1, NULL, '2025-09-27 03:17:08'),
(2, 1, NULL, 'Roman Roy', 'roman@12.com', '$2y$10$L6QmixQ9KVYVHLx/uDDg0.45JVo/9cPvhlknPbFZpUCC7ewcubpYW', 1, NULL, '2025-09-21 21:47:08');

--
-ALTER TABLE `areas`
  ADD PRIMARY KEY (`area_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `area_tickets`
--
ALTER TABLE `area_tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD UNIQUE KEY `ticket_number` (`ticket_number`),
  ADD KEY `fk_area_id` (`area_id`);

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
-- Indexes for table `location_plugins`
--
ALTER TABLE `location_plugins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `plugin_id` (`plugin_id`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`parking_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `plugin_master`
--
ALTER TABLE `plugin_master`
  ADD PRIMARY KEY (`plugin_id`),
  ADD UNIQUE KEY `plugin_name` (`plugin_name`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurant_id`),
  ADD KEY `location_id` (`location_id`);

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
-- Indexes for table `swimming_pools`
--
ALTER TABLE `swimming_pools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

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
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `area_tickets`
--
ALTER TABLE `area_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `location_plugins`
--
ALTER TABLE `location_plugins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `parking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plugin_master`
--
ALTER TABLE `plugin_master`
  MODIFY `plugin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `swimming_pools`
--
ALTER TABLE `swimming_pools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE;

--
-- Constraints for table `area_tickets`
--
ALTER TABLE `area_tickets`
  ADD CONSTRAINT `fk_area_tickets_area` FOREIGN KEY (`area_id`) REFERENCES `areas` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE;

--
-- Constraints for table `location_plugins`
--
ALTER TABLE `location_plugins`
  ADD CONSTRAINT `location_plugins_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `location_plugins_ibfk_2` FOREIGN KEY (`plugin_id`) REFERENCES `plugin_master` (`plugin_id`) ON DELETE CASCADE;

--
-- Constraints for table `parking`
--
ALTER TABLE `parking`
  ADD CONSTRAINT `parking_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE;

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
-- Constraints for table `swimming_pools`
--
ALTER TABLE `swimming_pools`
  ADD CONSTRAINT `swimming_pools_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;
