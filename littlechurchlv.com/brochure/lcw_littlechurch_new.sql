-- MySQL dump 10.11
--
-- Host: localhost    Database: littlechurch_new
-- ------------------------------------------------------
-- Server version	5.0.75-0ubuntu10.5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `config` (
  `sitename` varchar(255) NOT NULL default '',
  `home_seo_title` varchar(255) NOT NULL default '',
  `home_seo_description` text NOT NULL,
  `home_seo_keywords` text NOT NULL,
  `home_tagline` varchar(255) NOT NULL default '',
  `home_text` text NOT NULL,
  `home_slideshow_images` varchar(255) NOT NULL default '',
  `wedding_package_seo_title` varchar(255) NOT NULL default '',
  `wedding_package_seo_description` text NOT NULL,
  `wedding_package_seo_keywords` text NOT NULL,
  `renewal_package_seo_title` varchar(255) NOT NULL default '',
  `renewal_package_seo_description` text NOT NULL,
  `renewal_package_seo_keywords` text NOT NULL,
  `featured_package_seo_title` varchar(255) NOT NULL default '',
  `featured_package_seo_description` text NOT NULL,
  `featured_package_seo_keywords` text NOT NULL,
  `package_intro` text NOT NULL,
  `package_options` text NOT NULL,
  `package_promotions` text NOT NULL,
  `renewal_promotions` text NOT NULL,
  `featured_promotions` text NOT NULL,
  `french_minister_surcharge` decimal(3,2) NOT NULL default '0.00',
  `gallery_grounds_seo_title` varchar(255) NOT NULL default '',
  `gallery_grounds_seo_description` text NOT NULL,
  `gallery_grounds_seo_keywords` text NOT NULL,
  `gallery_grounds_title` varchar(50) NOT NULL default '',
  `gallery_grounds_intro` text NOT NULL,
  `gallery_chapel_seo_title` varchar(255) NOT NULL default '',
  `gallery_chapel_seo_description` text NOT NULL,
  `gallery_chapel_seo_keywords` text NOT NULL,
  `gallery_chapel_title` varchar(50) NOT NULL default '',
  `gallery_chapel_intro` text NOT NULL,
  `gallery_flowers_seo_title` varchar(255) NOT NULL default '',
  `gallery_flowers_seo_description` text NOT NULL,
  `gallery_flowers_seo_keywords` text NOT NULL,
  `gallery_flowers_title` varchar(50) NOT NULL default '',
  `gallery_flowers_intro` text NOT NULL,
  `news_seo_title` varchar(255) NOT NULL default '',
  `news_seo_description` text NOT NULL,
  `news_seo_keywords` text NOT NULL,
  `news_title` varchar(50) NOT NULL default '',
  `news_intro` text NOT NULL,
  `testimonials_seo_title` varchar(255) NOT NULL default '',
  `testimonials_seo_description` text NOT NULL,
  `testimonials_seo_keywords` text NOT NULL,
  `testimonials_title` varchar(50) NOT NULL default '',
  `testimonials_intro` text NOT NULL,
  `history_seo_title` varchar(255) NOT NULL default '',
  `history_seo_description` text NOT NULL,
  `history_seo_keywords` text NOT NULL,
  `limousine_seo_title` varchar(255) NOT NULL default '',
  `limousine_seo_description` text NOT NULL,
  `limousine_seo_keywords` text NOT NULL,
  `limousine_title` varchar(50) NOT NULL default '',
  `limousine_intro` text NOT NULL,
  `photography_seo_title` varchar(255) NOT NULL default '',
  `photography_seo_description` text NOT NULL,
  `photography_seo_keywords` text NOT NULL,
  `photography_title` varchar(50) NOT NULL default '',
  `photography_intro` text NOT NULL,
  `additional_services_seo_title` varchar(255) NOT NULL default '',
  `additional_services_seo_description` text NOT NULL,
  `additional_services_seo_keywords` text NOT NULL,
  `additional_services_title` varchar(50) NOT NULL default '',
  `additional_services_intro` text NOT NULL,
  `webcam_seo_title` varchar(255) NOT NULL default '',
  `webcam_seo_description` text NOT NULL,
  `webcam_seo_keywords` text NOT NULL,
  `webcam_title` varchar(50) NOT NULL default '',
  `webcam_intro` text NOT NULL,
  `webcam_text` text NOT NULL,
  `webcam_notice` text NOT NULL,
  `webcam_notice_show` enum('T','F') NOT NULL default 'F',
  `questions_seo_title` varchar(255) NOT NULL default '',
  `questions_seo_description` text NOT NULL,
  `questions_seo_keywords` text NOT NULL,
  `questions_title` varchar(50) NOT NULL default '',
  `questions_intro` text NOT NULL,
  `reservations_seo_title` varchar(255) NOT NULL default '',
  `reservations_seo_description` text NOT NULL,
  `reservations_seo_keywords` text NOT NULL,
  `feedback_seo_title` varchar(255) NOT NULL default '',
  `feedback_seo_description` text NOT NULL,
  `feedback_seo_keywords` text NOT NULL,
  `message_seo_title` varchar(255) NOT NULL default '',
  `message_seo_description` text NOT NULL,
  `message_seo_keywords` text NOT NULL,
  `privacy_seo_title` varchar(255) NOT NULL default '',
  `privacy_seo_description` text NOT NULL,
  `privacy_seo_keywords` text NOT NULL,
  `terms_seo_title` varchar(255) NOT NULL default '',
  `terms_seo_description` text NOT NULL,
  `terms_seo_keywords` text NOT NULL,
  `sitemap_seo_title` varchar(255) NOT NULL default '',
  `sitemap_seo_description` text NOT NULL,
  `sitemap_seo_keywords` text NOT NULL,
  `sitemap_title` varchar(50) NOT NULL default '',
  `sitemap_intro` text NOT NULL,
  PRIMARY KEY  (`sitename`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Site Configuration Settings';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES ('littlechurchlv.com','Wedding Chapel Las Vegas | Las Vegas Wedding Chapel | Las Vegas Weddings','Little Church of the West is the ideal location to have your Las Vegas wedding.  Located near Mandalay Bay and the famous \"Welcome to Las Vegas Sign\" our Las Vegas wedding chapel will ensure that you have the experience of a lifetime.','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','It\'s about Love ~ It\'s about You at The Little Church of the West','Our quaint, romantic, historical chapel will make the most important day of your lives a stylish and memorable event.  Many couples choose this setting for it\'s unique architecture and it\'s one acre of beautifully landscaped property, not to mention how conveniently located we are between the Mandalay Bay property and the world famous <em>\"Welcome to Las Vegas\"</em> sign.</p><p>Our services, whether civil or religious, are perfectly priced for every style.  Please <a href=\"https://secure.nr.net/littlechurchlv/index/reservations\" class=\"bodyDarkGray\">Click Here</a> or call 702.739.7971 today to reserve your special day!</p>','Home01.jpg,Home02.jpg,Home03.jpg,Home04.jpg,Home05.jpg,Home06.jpg,Home07.jpg,Home08.jpg,Home09.jpg,Home10.jpg','Little Church of the West Wedding Chapel Packages','Little Church of the West is a historic and luxurious wedding chapel in Las Vegas, however, our packages are catered for affordable luxury.','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Whether your wedding is traditional or you are affirming your love by renewing your vows, the Little Church of the West offers Exquisite Wedding or Renewal of Vows Packages that are sure to make your special day memorable.  Our services, whether civil or religious, are perfectly priced for every style.<br><br>Please <a href=\"https://secure.nr.net/littlechurchlv/index/reservations\" class=\"bodyDarkGray\">Click Here</a> or call 702.739.7971 today to reserve your special day!','','<!--<span class=\"xbigBlack\"><div align=\"center\">Additional Services</div></span><br>-->\r\n<div align=\"center\"><img src=\'TextIMG.php?text=Additional Services&font=CACCHAMP.TTF&bold=no&points=25&txtcolor=000000&shadow=C0C0C0&offset=2&width=200&height=50&left=0&top=30&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png\' alt=\"Additional Services\" border=\"0\"></div><br>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bodyDarkGray\">\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>DVD Recordings of your wedding (included with the <em>\"Forever True\"</em>, <em>\"Marry Me\"</em>, and <em>\"Lucky in Love\"</em> packages) are available for $79.00 - additional copies are available for $25.00 each when ordered before the wedding.</li><br><br></td>\r\n</tr>\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>Webcam Recordings (included with the <em>\"Forever True\"</em> package) are available for $50.00 with unlimited viewing for 30 days after the wedding.</li><br><br></td>\r\n</tr>\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>Additonal Photography Services are available for your convenience. <a href=\"index/services/photography\" class=\"bodyDarkGray\">Click Here for Additonal Photography Packages</a>.</li><br><br></td>\r\n</tr>\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>All Floral Arrangements are made in our Full Service Flower Shop. <a href=\"index/services/flowers\" class=\"bodyDarkGray\">Click Here for Flower Gallery</a>.</li></td>\r\n</tr>\r\n</table>','<!--<span class=\"xbigBlack\"><div align=\"center\">Additional Services</div></span><br>-->\r\n<div align=\"center\"><img src=\'TextIMG.php?text=Additional Services&font=CACCHAMP.TTF&bold=no&points=25&txtcolor=000000&shadow=C0C0C0&offset=2&width=200&height=50&left=0&top=30&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png\' alt=\"Additional Services\" border=\"0\"></div><br>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bodyDarkGray\">\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>DVD Recordings of your wedding (included with the <em>\"Still Forever True\"</em>, <em>\"Marry Me Again\"</em>, and <em>\"Still Lucky in Love\"</em> packages) are available for $79.00 - additional copies are available for $25.00 each when ordered before the wedding.</li><br><br></td>\r\n</tr>\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>Webcam Recordings (included with the <em>\"Still Forever True\"</em> package) are available for $50.00 with unlimited viewing for 30 days after the wedding.</li><br><br></td>\r\n</tr>\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>Additonal Photography Services are available for your convenience. <a href=\"index/services/photography\" class=\"bodyDarkGray\">Click Here for Additonal Photography Packages</a>.</li><br><br></td>\r\n</tr>\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>All Floral Arrangements are made in our Full Service Flower Shop. <a href=\"index/services/flowers\" class=\"bodyDarkGray\">Click Here for Flower Gallery</a>.</li></td>\r\n</tr>\r\n</table>','<!--<span class=\"xbigBlack\"><div align=\"center\">Additional Services</div></span><br>-->\r\n<div align=\"center\"><img src=\'TextIMG.php?text=Additional Services&font=CACCHAMP.TTF&bold=no&points=25&txtcolor=000000&shadow=C0C0C0&offset=2&width=200&height=50&left=0&top=30&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png\' alt=\"Additional Services\" border=\"0\"></div><br>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bodyDarkGray\">\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>DVD Recordings of your wedding (not available for <em>\"Garden Ceremony\"</em>) are available for $79.00 - additional copies are available for $25.00 each when ordered before the wedding.</li><br><br></td>\r\n</tr>\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>Webcam Recordings (not available for <em>\"Garden Ceremony\"</em>) are available for $50.00 with unlimited viewing for 30 days after the wedding.</li><br><br></td>\r\n</tr>\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>Additonal Photography Services are available for your convenience. <a href=\"index/services/photography\" class=\"bodyDarkGray\">Click Here for Additonal Photography Packages</a>.</li><br><br></td>\r\n</tr>\r\n<tr>\r\n	<td valign=\"top\"><li></td>\r\n	<td>All Floral Arrangements are made in our Full Service Flower Shop. <a href=\"index/services/flowers\" class=\"bodyDarkGray\">Click Here for Flower Gallery</a>.</li></td>\r\n</tr>\r\n</table>','99.99','Historic Las Vegas Wedding Chapel | Beautiful Las Vegas Wedding Chapel','Little Church of the West is one of the most historic Las Vegas landmarks and is situated on beautifully kept grounds on the Las Vegas Strip.  If you are looking for a quaint wedding chapel in Las Vegas you have come to the right place.','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Chapel Grounds Photo Gallery','We invite you to enjoy a pictorial tour of our beautiful one acre grounds and our historic chapel.<br><br>Located directly on the World Famous Las Vegas \"Strip\", yet worlds away from the neon and plastic, The Little Church of the West is an oasis of love and romance in a setting reminiscent of the Las Vegas of yesteryear.','Las Vegas Weddings  |  Weddings Las Vegas','Little Church Of The West is the most historic and scenic wedding destination in Las Vegas.  Our Chapel in Las Vegas can accommodate any of your desires for the most wonderful Las Vegas Wedding experience.','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','Chapel Photo Gallery','We invite you to enjoy a pictorial tour of our beautiful one acre grounds and our historic chapel.<br><br>Located directly on the World Famous Las Vegas \"Strip\", yet worlds away from the neon and plastic, The Little Church of the West is an oasis of love and romance in a setting reminiscent of the Las Vegas of yesteryear.','Las Vegas Wedding Flowers','Little Church of The West\'s flower collection is the most beautiful selection of flowers in Las Vegas.  If you are looking for a large selection of flowers in Las Vegas, please contact Little Church of The West.','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Gallery of Bouquets','These bouquets are a representation of what our floral designers can create for your special day.<br><br>Please call and speak with one of our wedding consultants about pricing and availability.','Las Vegas Wedding News |  Wedding Chapels Las Vegas','Looking for up to date information on Las Vegas weddings?  The most respected Las Vegas wedding chapel, Little Church of The West\'s blog about the Las Vegas wedding scene.','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','In The News ...','The World Famous Little Church of the West is, well ... <em>World Famous!</em><br><br>This page contains links to news and magazine articles about, or mentioning The Little Church of the West.<br><br>~ Enjoy!','Wedding Testimonials | Little Church of The West Testimonials','At Little Church of the West, our clients experience luxurious services and a dedicated team of wedding consultants to ensure that they have the most wonderful wedding in Las Vegas.','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','Testimonials','Some Kind Words from Happy Couples and their Families...<br><br><div align=\"center\"><a href=javascript:void(0)\" onClick=\"show(\'feedbackLayer\')\" class=\"smallDarkGray\"><strong>Click Here to leave some of your own!</a></div>','Historic Wedding Chapel Las Vegas |  Las Vegas Wedding Chapel','Little Church of The West is located between the \"Welcome to Las Vegas sign\" and Mandalay Bay Hotel.  Our historic wedding chapel in Las Vegas has been the location of movies, reality shows and celebrity weddings for the past 60 years.','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','Little Church of the West Limos','Looking for top of the line Limos for your Las Vegas Wedding.  Little Church of the West has access to the top limos in Las Vegas.','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Limousine Service','The Little Church of the West is proud to offer Executive Style VIP Limousine Service around the Las Vegas area.<br><br>Service is provided by tuxedo & black-tie attired chauffeurs for all occasions, including Airport Pickup service and Tours of the Famous Las Vegas Strip and surrounding areas. Choose from a wide range of vehicles including sedans, SUVs, stretch & super-stretch limos, super stretched Cadillac Escalade limos, super stretched H2 Hummer limos & limo coach buses.<br><br>Whether it\'s cruising the Las Vegas Strip in a Party Limo or a prompt Airport Limo Chauffer Meet & Greet, our limousine service let\'s you do it with style!','Las Vegas Wedding Photography |  Las Vegas Photographers','Our Las Vegas photographers will ensure that you have the most exquisite photos of your special day.  Little Church of the West can promise high definition photography of your special wedding.','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Photography Services','Whether your wedding is traditional or you are affirming your love by renewing your vows, the Little Church of the West offers Weddings that are sure to make your special day memorable.<br><br>These Additional Photography Services are available for your convenience.  If you don\'t see what you are looking for, please call or <a href=\"/index/contact/message/photos\" class=\"bodyBlack\">email</a> the chapel and we\'ll do our best to accommodate your wishes.','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Additional Services','Whether your wedding is traditional or you are affirming your love by renewing your vows, the Little Church of the West offers Weddings that are sure to make your special day memorable.<br><br>These Additional Services are available for your convenience.  If you don\'t see what you are looking for, please call or <a href=\"/index/contact/message\" class=\"bodyBlack\">email</a> the chapel and we\'ll do our best to accommodate your wishes.','Little Church of the West Wedding Chapel - Las Vegas, Nevada','Little Church of the West has top of the line webcams to ensure that our guests will be able to view their weddings from all over the world and allow those unable to attend to feel the joy of a live wedding.','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Chapel Webcam','Welcome to the Little Church of the West Chapel Webcam.<br><br>The Chapel Webcam offers your friends and family who cannot attend in person the ability to share in your big day. If Webcam service was purchased, wedding videos, while not live for security and privacy reasons, are available 20 minutes after the conclusion of your ceremony and are free to view for 30 days after.','<!--<span class=\"xbigBlack\"><div align=\"center\">Select Wedding</div></span><br>--><div align=\"center\"><img src=\'TextIMG.php?text=Select Wedding&font=CACCHAMP.TTF&bold=no&points=25&txtcolor=000000&shadow=C0C0C0&offset=2&width=200&height=50&left=0&top=30&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png\' alt=\"Additional Services\" border=\"0\"></div>If your wedding was recorded on our chapel webcam, please select the wedding date and enter the Groom\'s and the Bride\'s maiden LAST names to retrieve the video you wish to view.<br><br>Remember, all dates and times are <strong>Pacific Time</strong>, so adjust your request accordingly.','Due to an extremely high volume of webcam videos for 10/10/10 ceremonies we have been experiencing occasional video stream capacity issues.  We apologize for any inconvenience and assure you we are working hard to remedy the situation.<br><br>Thank You.','F','Little Church of the West Wedding Chapel - Las Vegas, Nevada','If you have any questions please look at our frequently asked questions section of our Las Vegas wedding website.  Any question about having your Las Vegas wedding at Little Church of The West will be answered here.','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Frequently Asked Questions','Whether your wedding is traditional or you are affirming your love by renewing your vows, the Little Church of the West offers Weddings that are sure to make your special day memorable.<br><br>These are some of the questions we are asked most often, along with the answers.  If you don\'t see an answer for your question or need further information, please call or <a href=\"/index/contact/message\" class=\"bodyBlack\">email</a> the chapel and we\'ll do our best to get you the information you seek.','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','Site Map','');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_bullets`
--

DROP TABLE IF EXISTS `package_bullets`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `package_bullets` (
  `unique_id` int(11) NOT NULL auto_increment,
  `package_number` varchar(20) NOT NULL default '',
  `position` decimal(3,2) NOT NULL default '0.00',
  `text` text NOT NULL,
  `display` enum('T','F') NOT NULL default 'T',
  PRIMARY KEY  (`unique_id`)
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=latin1 COMMENT='Package Bullet Points';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `package_bullets`
--

LOCK TABLES `package_bullets` WRITE;
/*!40000 ALTER TABLE `package_bullets` DISABLE KEYS */;
INSERT INTO `package_bullets` VALUES (1,'Package5','1.00','Exclusive access to our historic chapel.','T'),(2,'Package5','2.00','Floral design for ceremony created during a one-on-one session with our Lead Floral Designer. Choices include; Orchids, Gardenias, Iris\'s, Birds of Paradise, Hydrangeas, or Roses. Together you will design the following:','F'),(3,'Package5','2.10','Bride\'s bouquet;','T'),(4,'Package5','2.20','Groom\'s boutonni&egrave;re;','T'),(5,'Package5','2.30','Best Man & Maid/Matron of Honor flowers;','T'),(6,'Package5','2.40','Up to 2 additional corsage or nosegay & boutonni&egrave;res.','T'),(7,'Package5','3.00','Bridal party permitted.','F'),(8,'Package5','4.00','Aisle runner.','T'),(9,'Package5','5.00','Music of your choice. (<em><a onclick=\"show(\'MusicListDiv\');\" onMouseOver=\"this.style.cursor=\'pointer\';\" style=\"text-decoration:underline;\" class=\"smallDarkGray\">Click Here For Featured Song List</a></em>)','F'),(10,'Package5','6.00','On-line web cast of ceremony for up to 30 days <em>~ perfect for those unable to attend in person</em>.','T'),(11,'Package5','7.00','Two digitally mastered DVD videos of the ceremony.','T'),(12,'Package5','8.00','Professional photography session in the chapel that will capture candid moments during the ceremony as well as cherished group photos following the ceremony.','F'),(13,'Package5','8.10','This includes up to 75 photos presented to you on a Photo CD;','F'),(14,'Package5','8.20','Copyright release given to bride & groom.','F'),(15,'Package5','9.00','Professional photography session continues with the bridal party in our exclusive outdoor setting around the chapel grounds.','F'),(16,'Package5','9.10','This includes up to an additional 20 outside photos presented on a Photo CD with copyright release.','F'),(17,'Package5','10.00','A 25-photo custom wedding album digitally created with the photos of your choice taken on the day of the ceremony.','T'),(18,'Package5','11.00','Personal ceremony consultant to help with all your planning needs.','F'),(19,'Package5','12.00','Ceremony coordinator to assist bridal party and guests on the day of the ceremony.','F'),(20,'Package5','13.00','Exclusive use of bridal suite.','T'),(21,'Package5','14.00','20 personalized \"thank you\" cards.','F'),(22,'Package5','15.00','Custom designed certificate holder.','T'),(23,'Package5','16.00','Complimentary limo service with celebratory champagne for up to 12 adults.','T'),(47,'Package5','2.00','Specially designed bouquet of fresh flowers. Includes Groom\'s boutonni&egrave;re, Best Man & Maid/Matron of Honor flowers, and up to two additional corsage or nosegay & boutonni&egrave;res.','F'),(24,'Renewal5','1.00','Exclusive access to our historic chapel.','T'),(25,'Renewal5','2.00','Floral design for ceremony created during a one-on-one session with our Lead Floral Designer. Choices include; Orchids, Gardenias, Iris\'s, Birds of Paradise, Hydrangeas, or Roses. Together you will design the following:','F'),(26,'Renewal5','2.10','Bride\'s bouquet;','T'),(27,'Renewal5','2.20','Groom\'s boutonni&egrave;re;','T'),(28,'Renewal5','2.30','Best Man & Maid/Matron of Honor flowers;','T'),(29,'Renewal5','2.40','Up to 2 additional corsage or nosegay & boutonni&egrave;res.','T'),(30,'Renewal5','3.00','Bridal party permitted.','F'),(31,'Renewal5','4.00','Aisle runner.','T'),(32,'Renewal5','5.00','Music of your choice. (<em><a onclick=\"show(\'MusicListDiv\');\" onMouseOver=\"this.style.cursor=\'pointer\';\" style=\"text-decoration:underline;\" class=\"smallDarkGray\">Click Here For Featured Song List</a></em>)','F'),(33,'Renewal5','6.00','On-line web cast of ceremony for up to 30 days <em>~ perfect for those unable to attend in person</em>.','T'),(34,'Renewal5','7.00','Two digitally mastered DVD videos of the ceremony.','T'),(35,'Renewal5','8.00','Professional photography session in the chapel that will capture candid moments during the ceremony as well as cherished group photos following the ceremony.','F'),(36,'Renewal5','8.10','This includes up to 75 photos presented to you on a Photo CD;','F'),(37,'Renewal5','8.20','Copyright release given to bride & groom.','F'),(38,'Renewal5','9.00','Professional photography session continues with the bridal party in our exclusive outdoor setting around the chapel grounds.','F'),(39,'Renewal5','9.10','This includes up to an additional 20 outside photos presented on a Photo CD with copyright release.','F'),(40,'Renewal5','10.00','A 25-photo custom wedding album digitally created with the photos of your choice taken on the day of the ceremony.','T'),(41,'Renewal5','11.00','Personal ceremony consultant to help with all your planning needs.','F'),(42,'Renewal5','12.00','Ceremony coordinator to assist bridal party and guests on the day of the ceremony.','F'),(43,'Renewal5','13.00','Exclusive use of bridal suite.','T'),(44,'Renewal5','14.00','20 personalized \"thank you\" cards.','F'),(45,'Renewal5','15.00','Custom designed certificate holder.','T'),(46,'Renewal5','16.00','Complimentary limo service with celebratory champagne for up to 12 adults.','T'),(48,'Renewal5','2.00','Specially designed bouquet of fresh flowers. Includes Groom\'s boutonni&egrave;re, Best Man & Maid/Matron of Honor flowers, and up to two additional corsage or nosegay & boutonni&egrave;res.','F'),(49,'Package4','1.00','Exclusive access to our historic chapel.','T'),(50,'Package4','2.00','Floral bouquet customized by you with choice of calla lilies, gerbera daisies, tulips or roses specially created by our on-site floral design team.','F'),(51,'Package4','3.00','Groom\'s boutonni&egrave;re created to match bride\'s bouquet.','F'),(52,'Package4','4.00','Best Man & Maid/Matron of Honor flowers to match bride\'s bouquet.','F'),(53,'Package4','5.00','Bridal party permitted (Up to 6 Total).','F'),(54,'Package4','6.00','Music of your choice. (<em><a onclick=\"show(\'MusicListDiv\');\" onMouseOver=\"this.style.cursor=\'pointer\';\" style=\"text-decoration:underline;\" class=\"smallDarkGray\">Click Here For Featured Song List</a></em>)','F'),(55,'Package4','7.00','Digitally mastered DVD video of the ceremony.','T'),(56,'Package4','8.00','Professional photography session in the chapel that will capture candid moments during the ceremony as well as cherished group photos following the ceremony.','F'),(57,'Package4','8.10','Includes up to 40 photos presented on a photo CD.','F'),(63,'Package4','8.20','Copyright release given to bride & groom.','F'),(58,'Package4','9.00','Professional photography session continues with the bride & groom in our exclusive outdoor setting.','F'),(59,'Package4','9.10','Up to 16 additional shots of bride and groom presented on a photo CD, with copyright release.','F'),(60,'Package4','10.00','Bridal suite available for bride and attendants to slip into gowns.','T'),(61,'Package4','11.00','Custom designed certificate holder.','T'),(62,'Package4','12.00','Complimentary limousine service for up to 6 adults.','T'),(64,'Renewal4','1.00','Exclusive access to our historic chapel.','T'),(65,'Renewal4','2.00','Floral bouquet customized by you with choice of calla lilies, gerbera daisies, tulips or roses specially created by our on-site floral design team.','F'),(66,'Renewal4','3.00','Groom\'s boutonni&egrave;re created to match bride\'s bouquet.','F'),(67,'Renewal4','4.00','Best Man & Maid/Matron of Honor flowers to match bride\'s bouquet.','F'),(68,'Renewal4','5.00','Bridal party permitted (Up to 6 Total).','F'),(69,'Renewal4','6.00','Music of your choice. (<em><a onclick=\"show(\'MusicListDiv\');\" onMouseOver=\"this.style.cursor=\'pointer\';\" style=\"text-decoration:underline;\" class=\"smallDarkGray\">Click Here For Featured Song List</a></em>)','F'),(70,'Renewal4','7.00','Digitally mastered DVD video of the ceremony.','T'),(71,'Renewal4','8.00','Professional photography session in the chapel that will capture candid moments during the ceremony as well as cherished group photos following the ceremony.','F'),(72,'Renewal4','8.10','Includes up to 40 photos presented on a photo CD.','F'),(73,'Renewal4','8.20','Copyright release given to bride & groom.','F'),(74,'Renewal4','9.00','Professional photography session continues with the bride & groom in our exclusive outdoor setting.','F'),(75,'Renewal4','9.10','Up to 16 additional shots of bride and groom presented on a photo CD, with copyright release.','F'),(76,'Renewal4','10.00','Bridal suite available for bride and attendants to slip into gowns.','T'),(77,'Renewal4','11.00','Custom designed certificate holder.','T'),(78,'Renewal4','12.00','Complimentary limousine service for up to 6 adults.','T'),(79,'Package3','1.00','Exclusive access to our historic chapel.','T'),(80,'Package3','2.00','Bride\'s hand-tied bouquet of fresh roses.','T'),(81,'Package3','3.00','Groom\'s boutonni&egrave;re.','T'),(82,'Package3','4.00','Classic wedding music.','T'),(83,'Package3','5.00','Best Man & Maid/Matron of Honor permitted.','F'),(84,'Package3','6.00','Professional photography session in our chapel following the ceremony.','T'),(85,'Package3','6.10','Includes 4~8x10 & 4~5x7 prints selected from your one favorite image.','T'),(86,'Package3','7.00','Digitally mastered DVD video of the ceremony.','T'),(87,'Package3','8.00','Complimentary limousine service (for up to 6 adults ~ major hotels on \"The Strip\" only).','T'),(88,'Package3','9.00','Custom designed certificate holder.','T'),(89,'Renewal3','1.00','Exclusive access to our historic chapel.','T'),(90,'Renewal3','2.00','Bride\'s hand-tied bouquet of fresh roses.','T'),(91,'Renewal3','3.00','Groom\'s boutonni&egrave;re.','T'),(92,'Renewal3','4.00','Classic wedding music.','T'),(93,'Renewal3','5.00','Best Man & Maid/Matron of Honor permitted.','F'),(94,'Renewal3','6.00','Professional photography session in our chapel following the ceremony.','T'),(95,'Renewal3','6.10','Includes 4~8x10 & 4~5x7 prints selected from your one favorite image.','T'),(96,'Renewal3','7.00','Digitally mastered DVD video of the ceremony.','T'),(97,'Renewal3','8.00','Complimentary limousine service (for up to 6 adults ~ major hotels on \"The Strip\" only).','T'),(98,'Renewal3','9.00','Custom designed certificate holder.','T'),(99,'Package2','1.00','Exclusive access to our historic chapel.','T'),(100,'Package2','2.00','Bride\'s hand-tied bouquet of fresh roses.','T'),(101,'Package2','3.00','Classic wedding music.','T'),(102,'Package2','4.00','Professional photography session in our chapel following the ceremony.','T'),(103,'Package2','4.10','Includes 2~8x10 & 2~5x7 prints selected from your one favorite image.','T'),(104,'Package2','5.00','Custom designed certificate holder.','T'),(105,'Renewal2','1.00','Exclusive access to our historic chapel.','T'),(106,'Renewal2','2.00','Bride\'s hand-tied bouquet of fresh roses.','T'),(107,'Renewal2','3.00','Classic wedding music.','T'),(108,'Renewal2','4.00','Professional photography session in our chapel following the ceremony.','T'),(109,'Renewal2','4.10','Includes 2~8x10 & 2~5x7 prints selected from your one favorite image.','T'),(110,'Renewal2','5.00','Custom designed certificate holder.','T'),(111,'Package1','1.00','Exclusive access to our historic chapel.','T'),(112,'Package1','2.00','One professional 8x10 photo of bride & groom, selected from your favorite image.','T'),(113,'Package1','3.00','Custom designed certificate holder.','T'),(114,'Package1','4.00','Access for up to 10 honored guests.','F'),(115,'Package1','5.00','Available 10am to 3pm ~ 7 days a week.','F'),(116,'Package1','6.00','Not available 2/14, 10/10/2010, 11/11/2011, or 12/12/2012','F'),(117,'Featured1','1.00','Outdoor Gazebo Ceremony.','T'),(118,'Featured1','2.00','Bride\'s Small Hand Tied Bouquet.','T'),(119,'Featured1','3.00','Groom\'s Boutonni&egrave;re.','T'),(120,'Featured1','4.00','19th Century Heirloom Certificate.','T'),(121,'Featured1','5.00','Up to 15 photos of Bride & Groom presented on a Photo CD.<br><br>','T'),(123,'Featured2','1.00','Exclusive access to our historic chapel.','T'),(124,'Featured2','2.00','Bride\'s small hand-tied rose bouquet and Groom\'s boutonni&egrave;re.','T'),(125,'Featured2','3.00','Custom Certificate Holder.','T'),(126,'Featured2','4.00','Professional photography session in our chapel following the ceremony.','T'),(127,'Featured2','4.10','Includes 1~8x10 & 1~5x7 single image prints.','T'),(128,'Featured2','5.00','Digitally mastered DVD video of the ceremony.<br><br>','T'),(129,'Package4','2.00','Specially designed bouquet of fresh roses. Includes Groom\'s boutonni&egrave;re and Maid/Matron of Honor & Best Man flowers.','F'),(130,'Renewal4','2.00','Specially designed bouquet of fresh roses. Includes Groom\'s boutonni&egrave;re and Maid/Matron of Honor & Best Man flowers.','F'),(131,'Renewal1','1.00','Exclusive access to our historic chapel.','T'),(132,'Renewal1','2.00','One professional 8x10 photo of bride & groom, selected from your favorite image.','T'),(133,'Renewal1','3.00','Custom designed certificate holder.','T'),(134,'Renewal1','4.00','Access for up to 10 honored guests.','F'),(135,'Renewal1','5.00','Available 10am to 3pm ~ 7 days a week.','F'),(136,'Renewal1','6.00','Not available 2/14, 10/10/2010, 11/11/2011, or 12/12/2012','F'),(137,'Renewal4','2.00','Flowers include:','T'),(138,'Renewal4','2.10','Bride\'s bouquet;','T'),(139,'Renewal4','2.20','Groom\'s boutonni&egrave;re;','T'),(140,'Renewal4','2.30','Best Man & Maid/Matron of Honor flowers.','T'),(141,'Package4','2.00','Flowers include:','T'),(142,'Package4','2.10','Bride\'s bouquet;','T'),(143,'Package4','2.20','Groom\'s boutonni&egrave;re;','T'),(144,'Package4','2.30','Best Man & Maid/Matron of Honor flowers.','T'),(147,'Renewal4','6.00','Classic Wedding Music.','T'),(148,'Package4','6.00','Classic Wedding Music.','T'),(149,'Renewal4','8.00','Professional photography session will include up to 40 photos inside and up to 16 outdoor photos, all presented to you on a photo CD with copyright release.','T'),(150,'Renewal4','8.10','Candid shots during the ceremony.','T'),(151,'Renewal4','8.20','Bridal party photos in the chapel following the ceremony.','T'),(152,'Renewal4','8.30','Outdoor photos of the Bride and Groom in our exclusive outdoor setting.','T'),(153,'Package4','8.00','Professional photography session will include up to 40 photos inside and up to 16 outdoor photos, all presented to you on a photo CD with copyright release.','T'),(154,'Package4','8.10','Candid shots during the ceremony.','T'),(155,'Package4','8.20','Bridal party photos in the chapel following the ceremony.','T'),(156,'Package4','8.30','Outdoor photos of the Bride and Groom in our exclusive outdoor setting.','T'),(157,'Renewal5','2.00','Flowers include:','T'),(158,'Package5','2.00','Flowers include:','T'),(159,'Renewal5','5.00','Classic Wedding Music.','T'),(160,'Package5','5.00','Classic Wedding Music.','T'),(161,'Package5','8.00','Professional photography session will include up to 75 photos inside and up to 20 outdoor photos, all presented to you on a photo CD with copyright release.','T'),(162,'Package5','8.10','Candid shots during the ceremony.','T'),(163,'Package5','8.20','Bridal party photos in the chapel following the ceremony.','T'),(164,'Package5','8.30','Outdoor photos of the Bride and Groom in our exclusive outdoor setting.','T'),(165,'Renewal5','8.00','Professional photography session will include up to 75 photos inside and up to 20 outdoor photos, all presented to you on a photo CD with copyright release.','T'),(166,'Renewal5','8.10','Candid shots during the ceremony.','T'),(167,'Renewal5','8.20','Bridal party photos in the chapel following the ceremony.','T'),(168,'Renewal5','8.30','Outdoor photos of the Bride and Groom in our exclusive outdoor setting.','T'),(169,'Renewal5','12.00','Ceremony coordinator to assist bride and bridal party.','T'),(170,'Package5','12.00','Ceremony coordinator to assist bride and bridal party.','T');
/*!40000 ALTER TABLE `package_bullets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `packages` (
  `package_number` varchar(20) NOT NULL default '',
  `package_name` varchar(100) NOT NULL default '',
  `package_type` enum('Wedding','Renewal','Featured') NOT NULL default 'Wedding',
  `position` int(11) NOT NULL default '0',
  `image` varchar(100) NOT NULL default '',
  `thumbnail` varchar(100) NOT NULL default '',
  `song_list` varchar(255) NOT NULL default '',
  `price` decimal(5,2) NOT NULL default '0.00',
  `minister_fee` decimal(4,2) NOT NULL default '0.00',
  `package_expires` date NOT NULL default '0000-00-00',
  `description` text NOT NULL,
  `disclaimer` varchar(255) NOT NULL default '',
  `note` text NOT NULL,
  `recommendation` text NOT NULL,
  `special` text NOT NULL,
  `seo_title` varchar(255) NOT NULL default '',
  `seo_description` text NOT NULL,
  `seo_keywords` text NOT NULL,
  `display` enum('T','F') NOT NULL default 'T',
  PRIMARY KEY  (`package_number`),
  UNIQUE KEY `package_number` (`package_number`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='Ceremony Packages';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES ('Package5','Forever True','Wedding',5,'Package5.jpg','Package5_Th.jpg','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','1425.00','100.00','0000-00-00','The <strong><em>Forever True</em></strong> Wedding Package is our most extravagant, elegant, and complete package.  Created for those who desire an unforgettable and once-in-a-lifetime event, the Forever True package provides an endless number of extraordinary details and amenities to ensure that your dream of a fairy-tale wedding truly does come true.','Restrictions may apply. Price includes all applicable sales tax.<br>Photography is permitted by friends and family during the ceremony from their seats only.','','','<span class=\"xbigBlack\"><font color=\"#FF0000\"><div align=\"center\">Web Special!!</div></font></span><br>Reserve a <em>Forever True</em> package online today and receive a Unity Sand Ceremony Set <em>(a $75.00 value)</em> <strong><font color=\"#FF0000\">FREE!</font></strong><br><br>Like the unity candle, sand is used to symbolize the uniting of the bride and groom, it signifies the union of \"two into one\".<br>Unity Sand Ceremony Sets provide a lasting personalized memento of your special day!','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','T'),('Package4','Marry Me','Wedding',4,'Package4.jpg','Package4_Th.jpg','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','975.00','100.00','0000-00-00','Our <strong><em>Marry Me</em></strong> Wedding Package exudes elegant style and charm, providing the most luxurious of amenities for your wedding. Included is an extensive professional photography session, complimentary limousine service, and an elegant floral bouquet with a matching bouquet for your maid of honor.  The Marry Me package is an ideal way to start your lives together in a very romantic and intimate way.','Restrictions may apply. Price includes all applicable sales tax.<br>Photography is permitted by friends and family during the ceremony from their seats only.','','','<span class=\"xbigBlack\"><font color=\"#FF0000\"><div align=\"center\">Web Special!!</div></font></span><br>Reserve a <em>Marry Me</em> package online today and receive 30 days of Webcam Service <em>(a $50.00 value)</em> <strong><font color=\"#FF0000\">FREE!</font></strong>','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','T'),('Package3','Lucky in Love','Wedding',3,'Package3.jpg','Package3_Th.jpg','','625.00','60.00','0000-00-00','The perfect balance between simplicity and extravagance, our <strong><em>Lucky in Love</em></strong> Wedding Package provides all the amenities that ensure a wedding of refined elegance and dazzling style. Along with a hand-tied bouquet of fresh roses and DVD recording of your ceremony, you will enjoy complimentary limousine service. The Lucky in Love package is intended to make your special day perfect in every way.','Restrictions may apply. Price includes all applicable tax.<br>Photography is prohibited in the chapel for this package.','','','','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','T'),('Package2','Tie the Knot','Wedding',2,'Package2.jpg','Package2_Th.jpg','','375.00','60.00','0000-00-00','The <strong><em>Tie the Knot</em></strong> Wedding Package helps you celebrate your special day with elegance and simplicity. It includes a hand-tied bouquet of fresh roses, classic wedding music, and a professional photography session in our chapel following the ceremony.  The Tie the Knot package is the perfect choice for an intimate and memorable occasion for the two of you.','Restrictions may apply. Price includes all applicable tax.<br>Photography is prohibited in the chapel for this package.','','','','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','T'),('Package1','Let\'s Elope','Wedding',1,'Package1.jpg','Package1_Th.jpg','','199.00','60.00','0000-00-00','The <strong><em>Let\'s Elope</em></strong> Wedding Package is geared for the couple who is looking for the quick and simple ceremony, but wants to do it in style. Our historic chapel is the perfect setting to kick off your life together.','Restrictions may apply. Price includes all applicable tax.<br>Photography is prohibited in the chapel for this package.','','','','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','T'),('Featured1','Garden Ceremony','Featured',1,'Gazebo.jpg','Gazebo_Th.jpg','','375.00','60.00','0000-00-00','If you have always envisioned your wedding outdoors, surrounded by a soft breeze, the warmth of the sun, and the beauty of a flower adorned gazebo, then our <strong><em>Garden Ceremony</em></strong> Package is for you.  From an eloquently designed rose hand-tied bouquet created by our on-site floral design team to a complimentary 19th Century Heirloom Certificate, the Garden Ceremony package is sure to make your special day perfect in every way.','Restrictions may apply.<br>Photography is permitted by friends and family during the ceremony from their seats only.','Gazebo ceremonies can only be performed Monday-Thursday 10am-3pm. Each bridal party may not exceed 10 persons, seating is limited.<br><br>Please note: The chapel can not guarantee privacy and is not responsible for noise disturbances or weather conditions.<br>','','','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','T'),('Renewal5','Still Forever True','Renewal',5,'Renewal5.jpg','Renewal5_Th.jpg','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','1425.00','100.00','0000-00-00','The <strong><em>Still Forever True</em></strong> Vow Renewal Package is our most extravagant, elegant, and complete package.  Created for those who desire an unforgettable and once-in-a-lifetime event, the Still Forever True package provides an endless number of extraordinary details and amenities to ensure that your dream of a fairy-tale vow renewal truly does come true.','Restrictions may apply. Price includes all applicable sales tax.<br>Photography is permitted by friends and family during the ceremony from their seats only.','','','<span class=\"xbigBlack\"><font color=\"#FF0000\"><div align=\"center\">Web Special!!</div></font></span><br>Reserve a <em>Still Forever True</em> package online today and receive a Unity Sand Ceremony Set <em>(a $75.00 value)</em> <strong><font color=\"#FF0000\">FREE!</font></strong><br><br>Like the unity candle, sand is used to symbolize the uniting of the bride and groom, it signifies the union of \"two into one\".<br>Unity Sand Ceremony Sets provide a lasting personalized memento of your special day!','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','T'),('Renewal4','Marry Me Again','Renewal',4,'Renewal4.jpg','Renewal4_Th.jpg','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','975.00','100.00','0000-00-00','Our <strong><em>Marry Me Again</em></strong> Vow Renewal Package exudes elegant style and charm, providing the most luxurious of amenities for your ceremony. Included is an extensive professional photography session, complimentary limousine service, and an elegant floral bouquet with a matching bouquet for your maid of honor.  The Marry Me Again package is an ideal way to reaffirm your lives together in a very romantic and intimate way.','Restrictions may apply. Price includes all applicable sales tax.<br>Photography is permitted by friends and family during the ceremony from their seats only.','','','<span class=\"xbigBlack\"><font color=\"#FF0000\"><div align=\"center\">Web Special!!</div></font></span><br>Reserve a <em>Marry Me Again</em> package online today and receive 30 days of Webcam Service <em>(a $50.00 value)</em> <strong><font color=\"#FF0000\">FREE!</font></strong>','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','T'),('Renewal3','Still Lucky in Love','Renewal',3,'Renewal3.jpg','Renewal3_Th.jpg','','625.00','60.00','0000-00-00','The perfect balance between simplicity and extravagance, our <strong><em>Still Lucky in Love</em></strong> Vow Renewal Package provides all the amenities that ensure a ceremony of refined elegance and dazzling style. Along with a hand-tied bouquet of fresh roses and DVD recording of your ceremony, you will enjoy complimentary limousine service. The Still Lucky in Love package is intended to make your special day perfect in every way.','Restrictions may apply. Price includes all applicable tax.<br>Photography is prohibited in the chapel for this package.','','','','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','T'),('Renewal2','Tie the Knot Again','Renewal',2,'Renewal2.jpg','Renewal2_Th.jpg','','375.00','60.00','0000-00-00','The <strong><em>Tie the Knot Again</em></strong> Vow Renewal Package helps you celebrate your special day with elegance and simplicity. It includes a hand-tied bouquet of fresh roses, classic wedding music, and a professional photography session in our chapel following the ceremony.  The Tie the Knot package is the perfect choice for an intimate and memorable occasion for the two of you.','Restrictions may apply. Price includes all applicable tax.<br>Photography is prohibited in the chapel for this package.','','','','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','T'),('Renewal1','Let\'s Elope Again','Renewal',1,'Renewal1.jpg','Renewal1_Th.jpg','','199.00','60.00','0000-00-00','The <strong><em>Let\'s Elope Again</em></strong> Vow Renewal Package is geared for the couple who is looking for the quick and simple ceremony, but wants to do it in style. Our historic chapel is the perfect setting to renew your life together.','Restrictions may apply. Price includes all applicable tax.<br>Photography is prohibited in the chapel for this package.','','','','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding, wedding las vegas, wedding chapel las vegas, las vegas wedding chapel, wedding chapels las vegas, las vegas wedding chapels, elvis wedding las vegas, wedding vegas, vegas wedding, vegas weddings, weddings vegas','T'),('Featured2','&quot;Now or Never&quot; Ceremony','Featured',2,'Elvis.jpg','Elvis_Th.jpg','','575.00','60.00','0000-00-00','Take The Same Journey Elvis Once Did!<br><br>That\'s right; walk down the very same aisle Elvis Presley did with Ann Margret in the classic movie <strong><em>Viva Las Vegas</em></strong>.  Have \"Elvis\" walk you down the aisle, perform your vows, and sing your favorite Elvis songs, all in our world famous historic chapel.','Restrictions may apply.<br>Photography is prohibited in the chapel for this package.','A sample ceremony can be viewed under \"<a href=\"/index/guests/webcam\" class=\"smallDarkGray\">Webcam</a>\".<br><br>Please note: The Elvis impersonator will be scheduled according to availability. The minister fee is required for all ceremonies.','','','Little Church of the West Wedding Chapel - Las Vegas, Nevada','','las vegas wedding chapel, wedding chapel las vegas, historic wedding chapel, wedding chapel in Las Vegas, wedding las vegas, las vegas wedding, las vegas weddings, weddings las vegas','T');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photography`
--

DROP TABLE IF EXISTS `photography`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `photography` (
  `package_number` varchar(20) NOT NULL default '',
  `package_name` varchar(100) NOT NULL default '',
  `position` int(11) NOT NULL default '0',
  `price` decimal(5,2) NOT NULL default '0.00',
  `display` enum('T','F') NOT NULL default 'T',
  PRIMARY KEY  (`package_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Photography Packages';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `photography`
--

LOCK TABLES `photography` WRITE;
/*!40000 ALTER TABLE `photography` DISABLE KEYS */;
INSERT INTO `photography` VALUES ('Photo1','Outdoor Photography',1,'250.00','T'),('Photo2','Famous \"Welcome to Las Vegas\" Sign Photography',2,'325.00','T'),('Photo3','Studio Photography',3,'499.00','T'),('Photo4','On-Location Photography',4,'1250.00','T');
/*!40000 ALTER TABLE `photography` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photography_bullets`
--

DROP TABLE IF EXISTS `photography_bullets`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `photography_bullets` (
  `unique_id` int(11) NOT NULL auto_increment,
  `package_number` varchar(20) NOT NULL default '',
  `position` decimal(3,2) NOT NULL default '0.00',
  `text` text NOT NULL,
  `display` enum('T','F') NOT NULL default 'T',
  PRIMARY KEY  (`unique_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Photography Package Bullet Points';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `photography_bullets`
--

LOCK TABLES `photography_bullets` WRITE;
/*!40000 ALTER TABLE `photography_bullets` DISABLE KEYS */;
INSERT INTO `photography_bullets` VALUES (1,'Photo1','1.00','Up to 16 additional photos taken on the chapel grounds','T'),(2,'Photo2','1.00','Up to 20 additional photos taken at the famous sign','T'),(3,'Photo2','2.00','High-resolution images placed on a photo CD','T'),(4,'Photo3','1.00','Photo session taken in our on-site professional photography studio','T'),(5,'Photo3','2.00','High-resolution images placed on a photo CD','T'),(6,'Photo4','1.00','Up to 2 hours at 3 locations of choice','T'),(7,'Photo4','2.00','High-resolution images placed on a photo CD','T'),(8,'Photo1','2.00','High-resolution images placed on a photo CD','T');
/*!40000 ALTER TABLE `photography_bullets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `quotes` (
  `unique_id` int(11) NOT NULL auto_increment,
  `text` varchar(180) NOT NULL default '',
  `name` varchar(18) NOT NULL default '',
  `display` enum('T','F') NOT NULL default 'T',
  PRIMARY KEY  (`unique_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COMMENT='Testimonial Excerpts';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
INSERT INTO `quotes` VALUES (1,'Memories of that day are still shining brightly in our minds!','Aaron & Christina','T'),(2,'The Little Church of the West made my wedding the best day of my life.','Deborah','T'),(3,'My wedding day is certainly a day I will never forget.','Deborah','T'),(4,'I can\'t thank the Little Church of the West enough for everything they did to make my wedding everything I wanted it to be.','Deborah','T'),(5,'The ceremony was so perfect.','Julie','T'),(6,'The perfect spot for a Vegas wedding ceremony.','Julie','T'),(7,'The church was gorgeous, the ceremony was beautiful, the flowers were stunning, the pictures are fantastic and Elvis, what can I say?','Deb & Dan','T'),(8,'Certainly a day we will remember - perfect!','Deb & Dan','T'),(9,'We honestly believe it must be the most relaxed, yet memorable way to get married...without the tackiness that many think of when you say \'Vegas Wedding\'.','Maxine & Gregg','T'),(10,'Very professional and amazing service.','Gabriella & Aaron','T'),(11,'Your staff was incredibly helpful and friendly.','Gabriella & Aaron','T'),(12,'Everything was exactly as asked for and promised!','Gabriella & Aaron','T'),(13,'Your minister gave a beautiful speech; we felt like he actually knew us!!','Gabriella & Aaron','T'),(14,'Incredibly professional...','Gabriella & Aaron','T'),(15,'Your chapel is a beautiful venue and your professionalism and friendliness made this special day even more awesome.','Gabriella & Aaron','T'),(16,'I want to thank all of you at the Little Church of the West for making our wedding day perfect!!!','Melissa','T'),(17,'Thank you for offering such wonderful choices and alternatives to expensive and gaudy wedding locales. You are a breath of fresh air, bravo!!!','Michelle','T'),(18,'The Chapel is so classy and beautiful; it was the hands down choice.','Susan','T'),(19,'Your chapel was everything we wanted and even more.','Kim & Wayne','T'),(20,'...it did not give you the \'Quicky Vegas\' feel.','Kim & Wayne','T'),(21,'...just a great place on our special day!','Kim & Wayne','T'),(22,'We could not believe how lovely the Little Church was compared to other chapels.','Louise & Graham','T'),(23,'Everyone there was so helpful and nice...','Amber & Eric','T');
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `artist` varchar(100) NOT NULL default '',
  `note` varchar(255) NOT NULL default '',
  `display` enum('T','F') NOT NULL default 'T',
  PRIMARY KEY  (`song_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='Ceremony Music';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `songs`
--

LOCK TABLES `songs` WRITE;
/*!40000 ALTER TABLE `songs` DISABLE KEYS */;
INSERT INTO `songs` VALUES (1,'Cannon in D','Pachelbel','','T'),(2,'Prelude in C Major','Bach','','T'),(3,'Ave Maria','Schubert or Gounod','','T'),(4,'Love Me Tender','Elvis Presely','','T'),(5,'I Left My Heart in San Francisco','Tony Bennett','','T'),(6,'Viva Las Vegas','Elvis Presely','','T'),(7,'Moonlight Serenade','Glenn Miller','','T'),(8,'Aire in G String','Bach','','T'),(9,'Can You Feel The Love Tonight','Elton John & Tim Rice','From the Motion Picture <em>The Lion King</em>','T'),(10,'Beauty and the Beast','Angela Lansbury','From the Motion Picture <em>Beauty and the Beast</em>','T'),(11,'Someday My Prince Will Come','Adriana Caselotti','From the Motion Picture <em>Snow White</em>','T'),(12,'Smoke Gets In Your Eyes','The Platters','','T'),(13,'Pie Jesu','Tommaso da Celano - Requiem Mass','','T'),(14,'Music of the Night','Andrew Lloyd-Webber','From the Stage Show and Motion Picture <em>Phantom of the Opera</em>','T'),(15,'Think of Me','Andrew Lloyd-Webber','From the Stage Show and Motion Picture <em>Phantom of the Opera</em>','T'),(16,'All I Ask of You','Andrew Lloyd-Webber','From the Stage Show and Motion Picture <em>Phantom of the Opera</em>','T'),(17,'The Rose','Bette Midler','From the Motion Picture <em>The Rose</em>','T'),(18,'Wonderful Tonight','Eric Clapton','','T'),(19,'Take My Breath Away','Berlin','From the Motion Picture <em>Top Gun</em>','T');
/*!40000 ALTER TABLE `songs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-06-11  1:33:33
