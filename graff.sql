SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id9874535_graff`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_ID` int(255) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_ID`, `name`) VALUES
(1, 'Bracelets'),
(2, 'Earrings'),
(3, 'Necklaces'),
(4, 'Rings');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_ID` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_ID`, `name`) VALUES
(1, 'home'),
(2, 'about'),
(3, 'shop'),
(4, 'contact');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_ID` int(255) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `price_old` decimal(5,2) DEFAULT NULL,
  `color` varchar(20) COLLATE utf8_bin NOT NULL,
  `image` varchar(100) COLLATE utf8_bin NOT NULL,
  `image_big` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_ID`, `name`, `price`, `price_old`, `color`, `image`, `image_big`, `description`, `category_ID`) VALUES
(1, 'Iconic Swan Double Necklace', 119.00, NULL, 'black', 'images/necklaces/swan.jpg', 'images/necklaces/swan1.jpg', 'An exquisite necklace showing a pair of Graff\'s Iconic Swan symbols, adorned with our exclusive black crystal Pointiage® for maximum sparkle. A must-have for any jewelry box, this rose gold-plated design combines easily with other jewelry pieces.', 3),
(2, 'Lifelong Choker', 105.00, 119.00, 'rose', 'images/necklaces/lifelongChoker.jpg', 'images/necklaces/lifelongChoker1.jpg', 'Gift with romance and glamour by choosing this daring choker necklace. A bestseller this season, it features a knot design to symbolize the unique bond between two people. Combining crystal pavé and rose gold plating, it is a cool accessory full of irresistible Graff sparkle.', 3),
(3, 'Mix Necklace', 85.00, 95.00, 'white', 'images/necklaces/mixNecklace.jpg', 'images/necklaces/mixNecklace1.jpg', 'Sparkle brilliantly from every angle with this stunning statement piece. Full of vintage glamour, the rhodium-plated design demonstrates Graff\'s renowned craftsmanship with delicate fancy-cut crystals and our exclusive crystal Pointiage® technique. You can even choose between two different looks.', 3),
(4, 'No Regrets Y Necklace', 129.00, NULL, 'light multi', 'images/necklaces/NoRegrets.jpg', '	\r\nimages/necklaces/NoRegrets1.jpg', 'Capturing the fun spirit of summer vacations, this glam Y-shaped necklace is embellished with a variety of pastel-colored crystals. The gold-plated design will add a rainbow of color and special Graff sparkle to your new season wardrobe. Matching items are available.', 3),
(5, 'Lucky Goddess Horse Necklace', 79.00, 84.00, 'multi colored', 'images/necklaces/luckyGoddess.jpg', 'images/necklaces/luckyGoddess1.jpg', 'Feel lucky every day in this sumptuous necklace, crafted in gold plated metal, red pavé, and Crystal Pearl embellishment. Dominated by a horseshoe motif, an everlasting symbol of good fortune, it would make a great gift for yourself or a loved one.', 3),
(6, 'Sparkling Dance Round Necklace', 122.00, NULL, 'red', 'images/necklaces/danceAround.jpg', 'images/necklaces/danceAround1_.jpg', 'This timeless necklace is inspired by the idea of a ‘dancing crystal’, and features a round blue stone inside a 3D cage enhanced with crystal pavé. An essential addition to any jewelry box, it will give your daytime style a playful sparkle. ', 3),
(7, 'Tigris Statement Necklace', 155.00, 188.00, 'gray', 'images/necklaces/tigrisStatement.jpg', 'images/necklaces/tigrisStatement1_.jpg\r\n', 'Tigris - or \"fast as an arrow\" as it translates - is a jewelry collection of statement collars, cuffs and rings that take inspiration from the agile, flowing waters of the great Mesopotamian river.', 3),
(8, 'Garnet Drop Earrings  ', 69.00, NULL, 'yellow gold', 'images/earrings/garnetDrop.jpg', 'images/earrings/garnetDrop1.jpg', 'The deep and delicious red-tones of oval-shape rhodolite garnets are enhanced by round-shape light brown and brown diamonds in these chic and stylish stud earrings from Le Vian.', 2),
(9, 'Sapphire Scrolled Earrings  ', 389.00, 489.00, 'yellow gold', 'images/earrings/sapphireScrolled.jpg', 'images/earrings/sapphireScrolled1.jpg', 'Fanciful sapphire earrings grace the ears with precious jewels in an openwork motif. 3.30 ct. t.w. oval sapphires and .40 ct. t.w. sapphire rounds in frames of artistically scrolled 14kt yellow gold. ', 2),
(10, 'Diamond-Cut Hoop Earrings', 153.30, 219.00, 'white gold', 'images/earrings/diamondCut.jpg', '	\r\nimages/earrings/diamondCut1.jpg', 'Frame her face with the exquisite shimmer of these sparkling hoop earrings. Crafted in 14K white gold, each hoop is diamond-cut to catch and reflect light. Polished to a bright shine, these go-with-everything earrings secure with hinged backs.', 2),
(11, 'Gold Paw Print Earrings', 44.99, NULL, 'gold', 'images/earrings/goldRowPaw.jpg', 'images/earrings/goldRowPaw1.jpg', 'Cute as a button, these 14kt yellow gold stud earrings with open-space paw prints are sure to be any child\'s favorite pair. Pierced screw backing, 14kt yellow gold paw print stud earrings.', 2),
(12, 'Black Spinel Tassel Drop Earrings', 126.75, 169.00, 'black', 'images/earrings/blackSpinel.jpg', 'images/earrings/blackSpinel1.jpg', 'These glamorous drop earrings feature a 10-10.5mm cultured freshwater pearl and 35.00 ct. t.w. black spinel tassels separated by a 4mm 14kt yellow gold bead. ', 2),
(13, 'Fairy Angel Gold Earrings', 325.00, NULL, 'yellow', 'images/earrings/fairyAngel.jpg', 'images/earrings/fairyAngel1.jpg', 'The serene, angelic gold earrings designs in yellow gold from Graff are naturally appealing jewellery pieces. Studded with genuine s, earrings design online price suits your budget and helps you get accessorized modishly.', 2),
(14, 'Italian Black Onyx Earrings', 199.00, NULL, 'black', 'images/earrings/blackOnyx.jpg', 'images/earrings/blackOnyx1.jpg', 'Rich and bold black onyx is overlaid with glowing 14kt yellow gold scrollwork designs on this gorgeous pair of drop earrings. Hanging length is 1 1/2\". ', 2),
(15, 'Ross-Simons Pear-Shaped Earrings', 168.75, NULL, 'black', 'images/earrings/pearShapped.jpg', 'images/earrings/pearShapped1.jpg', 'These earrings showcase pear-shaped drops of inky black onyx swathed with a swoosh of 14kt yellow gold for chic, sophisticated contrast! ', 2),
(16, 'Diamond Yellow Gold Bracelet', 299.99, NULL, 'yellow gold', 'images/bracelets/diamondGold.jpg', '	\r\nimages/bracelets/diamondGold1.jpg', 'This perfect Yellow Gold Braceletare made  of 14k solid gold, this handmade bracelet has a pleasant light weight to it. \r\nPretty when worn on it\'s own, flatters every womans hand.', 1),
(17, 'Yellow Gold Over Brass Bangle Bracelet', 105.99, 119.00, 'yellow gold', 'images/bracelets/brassBangle.jpg', 'images/bracelets/brassBangle1_.jpg', 'This perfect Yellow Gold Over Brass Bangle Bracelet are made of 14k solid gold, this handmade bracelet has a pleasant light weight to it. \r\n\r\nPretty when worn on it\'s own and beautiful  next to other bracelets.', 1),
(18, 'Rose Gold Over Brass Bracelet', 105.65, NULL, 'rose gold', 'images/bracelets/roseGold.jpg', 'images/bracelets/roseGold1_.jpg', 'The luxury of gold, the durability of brass, and the sparkle of diamonds-that is what Graff stands for. \r\nThis sleek hinged bangle design is complemented by a striking.', 1),
(19, 'Yellow Gold Over Brass Bracelet', 224.00, NULL, 'yellow', 'images/bracelets/overBrass.jpg', '	\r\nimages/bracelets/overBrass1.jpg', 'It features a blush string band and circular rose quartz charm, which is known to attract love and help you show more compassion. Oh, and each gold quartz charm is unique so no two look alike!', 1),
(20, 'Yellow Gold Over Sterling Silver Bracelet', 79.99, NULL, 'silver gold', 'images/bracelets/overSterling.jpg', 'images/bracelets/overSterling1.jpg', 'This diamond band can be worn alone or interlaced with the other Graff bangles in alternate colourways. Style with a bedazzling interlaced Graff ring stack too.', 1),
(21, 'White Diamond Rhodium Bracelet', 98.99, NULL, 'white', 'images/bracelets/rhodium.jpg', '	\r\nimages/bracelets/rhodium1.jpg', '1.60ctw round and baguette white diamond, rhodium and 14k rose gold over sterling silver bracelet. \r\nMeasures approximately 7 and 1/2\"L x 3/16\"W and has a hidden box clasp closure. ', 1),
(22, 'White Diamond Over Brass Bracelet ', 106.75, NULL, 'white ', 'images/bracelets/whiteDiamond.jpg', 'images/bracelets/whiteDiamond1.jpg\r\n', 'By emulating the lustrous look of yellow, white, and rose gold, these jewelry styles of karat gold and rhodium over brass allow you to have that sophisticated look sure to give you a gold rush! ', 1),
(23, 'Attract Trilogy Round Ring', 89.00, NULL, 'blue', 'images/rings/trilogy.jpg', 'images/rings/trilogy1.jpg', 'Symbolizing the past, the present, and the future of eternal love, this stunning ring is imbued with timeless romance. Two clear crystals surround a centerpiece in our new dark blue crystal color in this rhodium-plated design.', 4),
(24, 'Fluid Azzuro Open Ring', 249.00, NULL, 'gray', 'images/rings/fluidAzzuro.jpg', 'images/rings/fluidAzzuro1.jpg', 'The Graff Azzurro collection features precision-cut baguette stones stacked in clean yet curving lines, enhancing the fascinating play of reflections between crystal and light.\r\n', 4),
(25, 'Fresh Ring', 89.00, 100.00, 'rose gold', 'images/rings/fresh.jpg', 'images/rings/fresh1.jpg', 'A delicate, feminine design with a galactic twist. This rose gold-plated ring features a row of crystals set in pavé and a sparkling prong-set chaton. Perfect for stacking and easy to mix and match with other Graff jewelry pieces.', 4),
(26, 'Mayfly Ring', 129.00, NULL, 'white ', 'images/rings/mayfly.jpg', 'images/rings/mayfly1.jpg', 'Get one of this season’s hottest looks with this on-trend coil ring. Inspired by the delicate leaves and foliage of an enchanted forest, the refined design mixes different techniques and materials, including micro pavé and rose gold plating. Feminine, elegant, and perfect for gifting. ', 4),
(27, 'Medium Bow Ring', 105.00, 178.99, 'white', 'images/rings/mediumBow.jpg', 'images/rings/mediumBow1.jpg', 'Offer a modern and meaningful gift this Valentine\'s Day with the Graff Bow collection, which uses the bow motif as a flirtatious and fun symbol of love. Sophisticated and romantic, yet playful and youthful, this ring exudes cool glamour with its sleek lines, 3D silhouette, and mix of rose gold and rhodium plating. ', 4),
(28, 'Penelope Cruz Moonsun Stacking Ring', 119.00, NULL, 'rose gold', 'images/rings/penelopeCruz.jpg', 'images/rings/penelopeCruz1.jpg\r\n', 'Internationally acclaimed actress Penélope Cruz has extended her collaboration with Atelier Graff with her celestial-inspired MoonSun collection, which celebrates the magic of the night sky.', 4),
(29, 'Iconic Swan Open Ring', 189.99, NULL, 'black', 'images/rings/swanOpen.jpg', 'images/rings/swanOpen1.jpg', 'This breathtaking open ring showcases a shining white Crystal Pearl and Graff\'s Iconic Swan symbol in black crystal Pointiage® for maximum sparkle. A must-have for any jewelry box.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_ID` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_ID`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `e_mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` int(255) NOT NULL,
  `last_visit` datetime NOT NULL,
  `log_error` int(255) NOT NULL,
  `role_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `e_mail`, `password`, `active`, `last_visit`, `log_error`, `role_ID`) VALUES
(10, 'admin_ogi', 'ogi@gmail.com', '', 1, '2019-06-21 09:40:35', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `visit_ID` int(255) NOT NULL,
  `number` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`visit_ID`, `number`) VALUES
(1, 4510);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_ID`),
  ADD KEY `category_ID` (`category_ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `role_ID` (`role_ID`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_ID`) REFERENCES `categories` (`category_ID`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_ID`) REFERENCES `roles` (`role_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
