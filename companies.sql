--
-- Database: `property_system`
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
(1, 'Apex Solutions', '2023-01-15 05:00:00', 'IT services & consulting', 'contact@apexsolutions.com', '9876543210', 'www.apexsolutions.com', 0),
(2, 'BrightTech', '2022-12-01 03:50:00', 'Software development', 'info@brighttech.com', '9876543211', 'www.brighttech.com', 0),
(3, 'GreenFields Corp', '2021-07-21 06:30:00', 'Agriculture & farming', 'hello@greenfields.com', '9876543212', 'www.greenfields.com', 0),
(4, 'UrbanBuild', '2022-03-05 10:15:00', 'Construction services', 'support@urbanbuild.com', '9876543213', 'www.urbanbuild.com', 0),
(5, 'QuantumSoft', '2023-05-17 02:40:00', 'IT solutions & software', 'contact@quantumsoft.com', '9876543214', 'www.quantumsoft.com', 0),
(6, 'EcoEnergy', '2021-11-30 05:55:00', 'Renewable energy provider', 'info@ecoenergy.com', '9876543215', 'www.ecoenergy.com', 0),
(7, 'Stellar Media', '2022-06-10 11:10:00', 'Digital marketing agency', 'hello@stellarmedia.com', '9876543216', 'www.stellarmedia.com', 0),
(8, 'Horizon Ventures', '2023-02-28 03:30:00', 'Venture capital & finance', 'contact@horizonventures.com', '9876543217', 'www.horizonventures.com', 0),
(9, 'BlueWave Technologies', '2021-09-18 08:45:00', 'Tech solutions provider', 'support@bluewave.com', '9876543218', 'www.bluewave.com', 0),
(10, 'Nova Pharma', '2022-08-05 05:20:00', 'Pharmaceutical company', 'info@novapharma.com', '9876543219', 'www.novapharma.com', 0),
(11, 'Summit Logistics', '2023-04-12 08:00:00', 'Supply chain services', 'contact@summitlogistics.com', '9876543220', 'www.summitlogistics.com', 0),
(12, 'Crystal Interiors', '2021-05-20 04:15:00', 'Interior design firm', 'hello@crystalinteriors.com', '9876543221', 'www.crystalinteriors.com', 0),
(13, 'Prime Foods', '2022-10-11 06:45:00', 'Food & beverage company', 'info@primefoods.com', '9876543222', 'www.primefoods.com', 0),
(14, 'SilverLine Automotives', '2023-01-25 09:50:00', 'Automotive manufacturer', 'contact@silverlineauto.com', '9876543223', 'www.silverlineauto.com', 0),
(15, 'Vertex Analytics', '2021-12-15 03:05:00', 'Data analytics services', 'hello@vertexanalytics.com', '9876543224', 'www.vertexanalytics.com', 0),
(16, 'Infinity Media', '2022-02-18 04:35:00', 'Media & entertainment', 'info@infinitymedia.com', '9876543225', 'www.infinitymedia.com', 0),
(17, 'Alpha Robotics', '2023-03-07 09:20:00', 'Robotics & AI solutions', 'contact@alpharobotics.com', '9876543226', 'www.alpharobotics.com', 0),
(18, 'GreenLeaf Organics', '2021-08-22 06:10:00', 'Organic farming & products', 'hello@greenleaf.com', '9876543227', 'www.greenleaf.com', 0),
(19, 'Titan Security', '2022-09-30 03:45:00', 'Security solutions', 'info@titansecurity.com', '9876543228', 'www.titansecurity.com', 0),
(20, 'Orion Tech Labs', '2023-06-01 10:30:00', 'Technology R&D lab', 'contact@oriontech.com', '9876543229', 'www.oriontech.com', 0),
(21, 'Phoenix IT Solutions', '2023-07-12 05:50:00', 'Custom software solutions', 'contact@phoenixit.com', '9876543230', 'www.phoenixit.com', 0),
(22, 'BlueSky Enterprises', '2022-11-05 08:40:00', 'Business consultancy', 'info@bluesky.com', '9876543231', 'www.bluesky.com', 0),
(23, 'EverGreen Tech', '2023-01-30 04:15:00', 'Sustainable technology', 'hello@evergreentech.com', '9876543232', 'www.evergreentech.com', 0),
(24, 'NextGen Robotics', '2022-08-22 08:05:00', 'AI & robotics solutions', 'contact@nextgenrobotics.com', '9876543233', 'www.nextgenrobotics.com', 0),
(25, 'SilverWave Media', '2021-12-14 05:20:00', 'Media & digital marketing', 'info@silverwavemedia.com', '9876543234', 'www.silverwavemedia.com', 0),
(26, 'Orchid Pharmaceuticals', '2023-03-19 10:35:00', 'Pharmaceutical R&D', 'hello@orchidpharma.com', '9876543235', 'www.orchidpharma.com', 0),
(27, 'Summit Tech Labs', '2022-05-11 07:00:00', 'Technology research lab', 'contact@summittechlabs.com', '9876543236', 'www.summittechlabs.com', 0),
(28, 'UrbanLeaf Organics', '2021-09-28 03:45:00', 'Organic food products', 'info@urbanleaf.com', '9876543237', 'www.urbanleaf.com', 0),
(29, 'Vortex Security', '2023-06-21 10:10:00', 'Cybersecurity solutions', 'hello@vortexsecurity.com', '9876543238', 'www.vortexsecurity.com', 0),
(30, 'Atlas Logistics', '2022-10-03 06:25:00', 'Transport & logistics services', 'contact@atlaslogistics.com', '9876543239', 'www.atlaslogistics.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;


