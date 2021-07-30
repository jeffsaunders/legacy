-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2013 at 06:42 PM
-- Server version: 5.0.91
-- PHP Version: 5.3.6-pl0-gentoo

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `swbh`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE IF NOT EXISTS `about_us` (
  `id` int(20) NOT NULL auto_increment,
  `timestamp` int(20) NOT NULL,
  `edit_by` longtext NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_subtitle` longtext NOT NULL,
  `page_content` longtext NOT NULL,
  `about_owner` longtext NOT NULL,
  `page_extra` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `timestamp`, `edit_by`, `page_id`, `title`, `page_title`, `page_subtitle`, `page_content`, `about_owner`, `page_extra`) VALUES
(1, 0, 'bmccarthy', 'about', 'About Us', 'About Smart Women Buy Homes', '<h3>You''re invited to join the millions of single women who are discovering the joy of home ownership.</h3>\r\n            \r\n<p>We make it easy, exciting and fun!</p>', '<h4>It''s All About You...</h4>\r\n            \r\n            	<p>When it comes to buying a home, many single women feel overwhelmed, anxious or intimidated by the process. With a Smart Women Buy Homes&trade; advisor you can rest assured that you have someone by your side that listens, understands, and responds to your needs. Every step of the way, we''re there to guide you toward making one of the most important, smartest, and fulfilling investments in your life and yourself.</p>\r\n            \r\n            <h4>It''s a Process...</h4>\r\n            \r\n            	<p>Our Six Steps To The Nest&copy; simplifies a complex process, making home buying easy to understand so that smart women like you can enjoy the accomplishment and joy of being a home owner. We can help you decide if it is the right time to buy and why a Smart Women Buy Homes&trade; advisor makes a difference for single women home buyers. We help you through the process of financing your home and navigating credit and mortgage matters, plus we tap our extensive network of resources to help you find the perfect place. When you''re ready to make an offer and close the deal, we''re there right beside you.</p>\r\n            \r\n            	<p>There''s nothing quite like the feeling of owning your own home. It''s where you hang your hat. Kick off your shoes. And know you really could&ndash;and did&ndash;make it happen!</p>\r\n            \r\n            	<p><img src="images/assets/sixStepsToNest.jpg" alt="Six Steps To Nest" border="0" /></p>', '<h3 id="jeanie"><img src="images/assets/Jeanie01.png" alt="Jeanie" border="0" align="right" style="padding:0 0 10px 20px;" />Hi! My name is Jeanie Douthitt, and I am the founder of Smart Women Buy Homes&trade;</h3>\r\n            \r\n            	<p>Single women are often afraid to purchase a home by themselves. First-time home buyers may think they can''t afford their own home, or don''t know where to start. I can relate. When I purchased my first home, I didn''t have any idea where to start.</p>\r\n            \r\n            	<p>Women shouldn''t feel fear and anxiety when buying a home, like I did. Instead, buying a home should be an exciting time, a high point in your single life, when you experience the empowerment and freedom of making one of the most important investments in yourself and your life.</p>\r\n            \r\n            	<p>Working with a Smart Women Buy Homes&trade; advisor assures you that you will be listened to, treated with respect, and receive trustworthy advice and information, while we expertly manage ALL the details for you. We make your home buying experience simple, easy and a joy using my Smart Women Buy Homes&trade; Six Steps to The Nest&copy; process!</p>\r\n            \r\n            	<p>We look forward to serving you!</p>\r\n            \r\n            	<p>Warmest regards,</p>\r\n                <p><img src="images/assets/JeanieSig.jpg" alt="Signature" border="0" /></p>\r\n                \r\n                <p class="indent"><i>Jeanie Douthitt founded Smart Women Buy Homes&trade; after a successful 20-year career in information technology to pursue her passion to help single women achieve their dream of homeownership. Her Smart Women Buy Homes&trade; program focuses on the unique challenges and barriers single women experience in the process of purchasing a home. Your Smart Women Buy Homes&trade; advisor is dedicated to those same values, professionalism, and commitment to serving single women as its founder, Jeanie Douthitt.</i></p>', '<h4>It''s Smart to Buy...</h4>\r\n            \r\n            	<ul class="indent">\r\n                	<li>Single women made up 20% of all home buyers</li>\r\n                    <li>More than 1 million homes a year are purchased by single women</li>\r\n                    <li>21% of first-time home buyers are single women</li>\r\n                    <li>The average age of single women home buyers is 47</li>\r\n                    <li>The average age of first-time single women home buyers is 34</li>\r\n                    <li>The No.1 reason single women are buying homes is their strong desire to nest<br /><br /><span>Source: National Assoc. of Realtors 2011 Buyers & Sellers Survey<br />and The Joint Center for Housing Studies</span></li>\r\n                </ul>\r\n                \r\n                <p>Many single women started out just like you. Not sure if buying was right for them. If they were too young to take the leap. Or if divorced or widowed, how they would manage to go through the home buying process alone. They''ve overcome the challenges, faced their fears, and have discovered the joy of buying and owning their own home with the help of a Smart Women Buy Homes&trade; advisor.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(20) NOT NULL auto_increment,
  `timestamp` int(20) NOT NULL,
  `edit_by` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_subtitle` longtext NOT NULL,
  `page_content` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `timestamp`, `edit_by`, `page_id`, `title`, `page_title`, `page_subtitle`, `page_content`) VALUES
(1, 1, 'bmccarthy', 'contact', 'Contact Us', 'Contact Us', '', '<p>Call Jeanie Douthitt at <strong>214-908-2156</strong> to learn more about how Smart Women Buy Homes helps single women easily overcome obstacles to home ownership.</p>\r\n            \r\n            <p>You may also contact Jeanie by emailing her at <a href="mailto:jeanie.douthitt@gmail.com">jeanie.douthitt@gmail.com</a> or by completing our <strong>Quick Contact</strong> form on the right.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(20) NOT NULL auto_increment,
  `timestamp` int(20) NOT NULL,
  `edit_by` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_subtitle` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `timestamp`, `edit_by`, `page_id`, `title`, `page_title`, `page_subtitle`) VALUES
(1, 1, 'bmccarthy', 'faq', 'FAQ', 'Frequently Asked Questions', '<p><span>Click a question to reveal the answer.</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `faq_entry`
--

CREATE TABLE IF NOT EXISTS `faq_entry` (
  `q_id` int(20) NOT NULL auto_increment,
  `timestamp` int(20) NOT NULL,
  `edit_by` varchar(255) NOT NULL,
  `faq_question` longtext NOT NULL,
  `faq_answer` longtext NOT NULL,
  PRIMARY KEY  (`q_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `faq_entry`
--

INSERT INTO `faq_entry` (`q_id`, `timestamp`, `edit_by`, `faq_question`, `faq_answer`) VALUES
(1, 1, 'bmccarthy', 'How much house should I buy? How much can I afford?', 'The answer to this has a lot to do with your income and the amount of your debt load. Not sure what you can afford? That''s a common concern for most single women. While I advise my clients that their mortgage lender is their best source for exactly what they can afford, a rough rule of thumb is your total debt should not be more than 50 percent of your before-tax monthly income. These ratios will depend on the type of mortgage for which you are applying.</p>\r\n                            \r\n                            <p>With extraordinarily low interest rates, there are a variety of affordable mortgage options, making it easier than ever to own a home. You don''t need perfect credit, long-term employment, or a large down payment. In fact, more single women than ever before are taking advantage of down-payment assistance or subsidized loan programs. Your mortgage lender can provide more information on these programs, as well as other types of mortgages including Fixed Rate Mortgages, Federal Housing Administration (FHA), Veteran''s Administration (VA) and new construction loans. And thankfully, the mortgage process has become more streamlined and convenient, as well.</p>'),
(2, 1, 'bmccarthy', 'Do I really need to use an Agent to buy a house?', 'Since the commission for the sale of a house is almost always paid for by the seller, buyers are able to get assistance and information from Real Estate Agents, usually at no cost to them. It is for this reason that the vast majority of home buyers employ the services of an Agent for their purchase. In addition, since most houses are listed by Real Estate Agencies, it gives them the maximum number of available properties to consider. Without an Agent, you may be missing valuable representation of your interests. (See Information About Brokerage Services)</p>'),
(3, 1, 'bmccarthy', 'How much will my closing costs be?', 'The amount of closing costs will depend on what items are customary for buyers and sellers to pay for in your area. Traditions vary greatly from one area of the country to another. In some areas, for example, the buyer pays for title insurance. In other areas, it is the responsibility of the seller. Your agent can give you specific information on the items that are customarily paid for by buyers in your area. In addition, the amount of closing costs will depend on the amount of points you will be paying with your mortgage loan. Your loan officer will give you a Good Faith Estimates when you find a property. This will cover charges charged by the Mortgage Company, Title Company, etc. </p>'),
(4, 1, 'bmccarthy', 'What First Time Buyer Programs are available?', 'There are literally hundreds of different programs available, depending on your location (city, state,) and the mortgage source that you use. The requirements and benefits vary greatly from program to program. Consult your mortgage lender or your local housing authority for more information.</p>'),
(5, 1, 'bmccarthy', 'Should I spend the money to have a home inspection?', 'Inspection costs could be the best money you ever spend on your house. Not only does the home inspection seek out any defects (and gives you some peace of mind), the home inspector will often give you tips on maintaining and repairing your house.</p>'),
(6, 1, 'bmccarthy', 'What is an appraisal?', 'Will I need one? An appraisal is an opinion of value of the home you want to purchase. Virtually every lender will require some sort of appraisal before the loan is approved. </p>'),
(7, 1, 'bmccarthy', 'Can I use my IRA retirement funds for a down payment on a house?', 'For most first time buyers, you can use the funds in these retirement accounts without penalty.</p>\r\n                            <p>According to the IRS, if both husband and wife are first-time home buyers, they each can withdraw up to $10,000 for qualified acquisition costs penalty-free for a first home.</p>'),
(8, 1, 'bmccarthy', 'What is a Home Warranty?', 'A home warranty is a service contract, normally for one year, which helps protect home owners against the cost of unexpected covered repairs or replacement on their major systems and appliances that break down due to normal wear and tear. Coverage is for systems and appliances in good working order at the start of the contract.</p>'),
(9, 1, 'bmccarthy', 'What factors affect my credit score?', 'Credit scores range between 200 and 800, with scores 620 or above is considered desirable for obtaining a mortgage. This can change depending on the financial market. The following factors affect your score:</p>\r\n                            \r\n                            <ol>\r\n                            	<li>Your payment history. Did you pay your credit card obligations on time? If they were late, then how late? Bankruptcy filing, liens, and collection activity also impact your history.</li>\r\n                                <li>Do you owe a great deal of money on numerous accounts, it can indicate that you are overextended. However, it''s a good thing if you have a good proportion of balances to total credit limits.</li>\r\n                                <li>The length of your credit history. In general, the longer you have had accounts opened, the better. The average consumer''s oldest obligation is 14 years old, indicating that he or she has been managing credit for some time, according to Fair Isaac Corp., and only one in 20 consumers have credit histories shorter than 2 years.</li>\r\n                                \r\n                                <li>How much new credit you have. New credit, either installment payments or new credit cards, are considered more risky, even if you pay them promptly.</li>\r\n                                \r\n                                <li>The types of credit you use. Generally, it''s desirable to have more than one type of credit&ndash;installment loans, credit cards, and a mortgage, for example..</li>\r\n                            </ol>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `happy_news`
--

CREATE TABLE IF NOT EXISTS `happy_news` (
  `id` int(20) NOT NULL auto_increment,
  `timestamp` int(20) NOT NULL,
  `edit_by` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_subtitle` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `happy_news`
--

INSERT INTO `happy_news` (`id`, `timestamp`, `edit_by`, `page_id`, `title`, `page_title`, `page_subtitle`) VALUES
(1, 1, 'bmccarthy', 'happyNews', 'Happy News', 'Happy News', '');

-- --------------------------------------------------------

--
-- Table structure for table `happy_news_testimonial`
--

CREATE TABLE IF NOT EXISTS `happy_news_testimonial` (
  `id` int(20) NOT NULL auto_increment,
  `timestamp` int(20) NOT NULL,
  `test_author` varchar(255) NOT NULL,
  `test_email` varchar(255) NOT NULL,
  `test_content` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `happy_news_testimonial`
--

INSERT INTO `happy_news_testimonial` (`id`, `timestamp`, `test_author`, `test_email`, `test_content`) VALUES
(1, 1, '', '', '"I''d been renting for seven years and decided to buy a townhouse, but I had to overcome that fear factor. My Smart Women Buy Homes&trade; advisor was so helpful and walked me through the entire process. Buying my townhouse was a huge, huge accomplishment for me."'),
(2, 1, '', '', '"It was interesting getting to know you while you were helping me find one of my dreams&ndash;a home of my own. I admire your passion for helping out single women. You are capable of making a difference in our lives, and I want to thank you for that."'),
(3, 1, '', '', '"I want to thank you for your help. I feel great about being a homeowner, and had it not been for you, I don''t think I would have been able to try again. Words can''t express how much a difference the Smart Women Buy Homes&trade; program has made to me."'),
(4, 1, '', '', '"As a single 31-year-old school teacher, I didn''t think I could afford my own home. My Smart Women Buy Homes&trade; advisor showed me how, starting by helping me check my credit scores, and getting pre-qualified for a mortgage. Now I have a place of my own in a secure, gated community. Every time I look around my home, I think, ''Wow, I did this''!"'),
(5, 1, '', '', 'I''ve enjoyed working with you, and your great ''We can find it'' attitude, despite all my doubts that I could find an affordable house in the Plano area, and find the type of home I wished to own. Thanks to your great knowledge of the residential real estate business, I now own my perfect-for-me home."'),
(6, 1, '', '', '"My Smart Women Buy Homes&trade; advisor was so helpful in my search for a home. She quickly assessed what style of home I was looking for and researched the properties before I visited so I didn''t have to waste time viewing homes that did not suit my budget or my needs. I was involved in a very complex situation, and she handled all of the snags, relieving me of worry."'),
(7, 1, '', '', '"I saw a special on television about Smart Women Buy Homes&trade;, and after seeing that show, I want to thank you on behalf of all women who never thought they could make it out there in this big scary world on their own, for leading them, and teaching them, and showing them the path. Just knowing that there are Smart Women Buy Homes&trade; advisors makes me feel a little less fearful of the unknown. I have been married for nearly 28 year and am now going through a divorce. I feel better just knowing that when the time comes for me to buy my home, on my own, you will be there to help me."'),
(8, 1, '', '', '"My Smart Women Buy Homes&trade; advisor was very patient with me. This was my first time buying a home on my own and I was nervous, clueless and needed guidance. She was there all the way."');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL auto_increment,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(10) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL,
  `referral` varchar(255) NOT NULL,
  `apply_date` int(11) NOT NULL,
  `confirm_date` int(11) NOT NULL,
  `join_date` int(11) NOT NULL,
  `renewal_date` int(11) NOT NULL,
  PRIMARY KEY  (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Membership Information' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `first_name`, `last_name`, `company_name`, `city`, `state`, `zipcode`, `phone`, `email`, `website`, `role`, `referral`, `apply_date`, `confirm_date`, `join_date`, `renewal_date`) VALUES
(1, 'Jeff', 'Saunders', 'Network Resources', 'Murphy', 'TX', '75094', '(972) 333-5615', 'jeff@nr.net', 'nr.net', 'I''m a lurker!', 'Website|Women''s Network TV|Women''s Network Radio|Real Estate Agent: John Smith|Other: Through eWomenNetwork', 1364363542, 0, 0, 0),
(2, 'Jeff', 'Saunders', 'Network Resources', 'Murphy', 'TX', '75094', '(972) 333-5615', 'jeff@nr.net', 'http://nr.net', 'I am a Broker', 'Website', 1364446975, 1364452551, 0, 0),
(3, 'Jeff', 'Saunders', 'Network Resources', 'Murphy', 'TX', '75094', '(972) 333-5615', 'jeff@nr.net', 'http://nr.net', 'I am a Broker', 'Website', 1365481386, 1365481893, 0, 0),
(4, 'Jeff', 'Saunders', 'Network Resources', 'Murphy', 'TX', '75094', '(972) 333-5615', 'jeff@nr.net', 'http://nr.net', 'I am a Broker', 'Website', 1365481959, 1365482279, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(20) NOT NULL auto_increment,
  `timestamp` int(20) NOT NULL,
  `edit_by` varchar(255) NOT NULL,
  `page_header` longtext NOT NULL,
  `page_content` longtext NOT NULL,
  `page_java` longtext NOT NULL,
  `page_title` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `timestamp`, `edit_by`, `page_header`, `page_content`, `page_java`, `page_title`) VALUES
(1, 1, 'bmccarthy', '$result = mysql_query("SELECT * FROM about_us ORDER BY id DESC LIMIT 1") or die(mysql_error());\r\n\r\n	while($row = mysql_fetch_array($result)) {\r\n		$id = $row[''id''];\r\n		$pageID = stripslashes($row[''page_id'']);\r\n		$title = stripslashes($row[''title'']);\r\n		$pageTitle = stripslashes($row[''page_title'']);\r\n		$pageSubtitle = stripslashes($row[''page_subtitle'']);\r\n		$pageContent = stripslashes($row[''page_content'']);\r\n		$aboutOwner = stripslashes($row[''about_owner'']);\r\n		$pageExtra = stripslashes($row[''page_extra'']);\r\n	}\r\n	', 'print("<h2>");echo $pageTitle;print("</h2>"); \r\n            \r\n             echo $pageSubtitle; \r\n            \r\n             echo $pageContent; \r\n            \r\n             echo $aboutOwner; \r\n                \r\n             echo $pageExtra; ', '', 'about'),
(2, 1, 'bmccarthy', '$result = mysql_query("SELECT * FROM happy_news ORDER BY id DESC LIMIT 1") or die(mysql_error());\r\n\r\n	while($row = mysql_fetch_array($result)) {\r\n		$id = $row[''id''];\r\n		$pageID = stripslashes($row[''page_id'']);\r\n		$title = stripslashes($row[''title'']);\r\n		$pageTitle = stripslashes($row[''page_title'']);\r\n		$pageSubtitle = stripslashes($row[''page_subtitle'']);\r\n	}\r\n', 'print("<h2>"); echo $pageTitle; print("</h2>");\r\nprint("<ol>");\r\n			$result2 = mysql_query("SELECT id, test_content, test_author, test_email FROM happy_news_testimonial ORDER BY id") or die(mysql_erroor());\r\n			\r\n			while($row = mysql_fetch_array($result2)) {\r\n				$id = $row[''id''];\r\n				$testAuthor = stripslashes($row[''test_author'']);\r\n				$testEmail = stripslashes($row[''test_email'']);\r\n				$testContent = stripslashes($row[''test_content'']);\r\n				\r\n				print ("<li>". $testContent ."</li>");\r\n			}\r\nprint("</ol>");', '', 'happy-news'),
(3, 1, 'bmccarthy', '$result = mysql_query("SELECT * FROM realtorapp ORDER BY id DESC LIMIT 1") or die(mysql_error());\r\n\r\n	while($row = mysql_fetch_array($result)) {\r\n		$id = $row[''id''];\r\n		$pageID = stripslashes($row[''page_id'']);\r\n		$title = stripslashes($row[''title'']);\r\n		$pageTitle = stripslashes($row[''page_title'']);\r\n		$pageSubtitle = stripslashes($row[''page_subtitle'']);\r\n		$pageContent = stripslashes($row[''page_content'']);\r\n		$pageExtra = stripslashes($row[''page_extra'']);\r\n	}', 'print("<h2>"); echo $pageTitle; print("</h2>");\r\n            \r\n             echo $pageSubtitle; \r\n            \r\n             echo $pageContent; \r\n            \r\n             echo $pageExtra; ', '', 'realtors'),
(4, 1, 'bmccarthy', '$result = mysql_query("SELECT * FROM faq ORDER BY id DESC LIMIT 1") or die(mysql_error());\r\n\r\n	while($row = mysql_fetch_array($result)) {\r\n		$id = $row[''id''];\r\n		$pageID = stripslashes($row[''page_id'']);\r\n		$title = stripslashes($row[''title'']);\r\n		$pageTitle = stripslashes($row[''page_title'']);\r\n		$pageSubtitle = stripslashes($row[''page_subtitle'']);\r\n	}', 'print("<h2>"); echo $pageTitle; print("</h2>");\r\n             echo $pageSubtitle; \r\n\r\nprint("<div class=\\"faq-wrap\\">");\r\n					\r\n					$result2 = mysql_query("SELECT q_id, faq_question, faq_answer FROM faq_entry ORDER BY q_id") or die(mysql_error());\r\n					\r\n					while($row = mysql_fetch_array($result2)) {\r\n						$qID = $row[''q_id''];\r\n						$faqQuestion = stripslashes($row[''faq_question'']);\r\n						$faqAnswer = stripslashes($row[''faq_answer'']);\r\n					\r\n					   \r\n                    	print ("\r\n						<div class=\\"faq-sec\\">\r\n                    	\r\n						<div class=\\"faq-question\\">\r\n							<h4><a href=\\"javascript:InsertContent(''faq-".$qID."'');\\"><strong>Q.</strong>&nbsp;".$faqQuestion."</h4></a>\r\n						</div><!--faq-question-->\r\n                        \r\n                        \r\n						<div id=\\"faq-".$qID."\\" class=\\"faq-answer\\" style=\\"display:none;\\">\r\n							<p><strong>A.</strong>&nbsp;".$faqAnswer."\r\n                             \r\n							<div class=\\"clear\\"></div><!--clear-->\r\n						</div><!--faq-answer-->\r\n                        \r\n						</div><!--faq-sec-->");\r\n					}\r\n					\r\n					print("</div><!--faq-wrap-->");', '<script type="text/javascript" language="JavaScript">\r\n					function InsertContent(tid) {\r\n						if(document.getElementById(tid).style.display == "none") {\r\n							document.getElementById(tid).style.display = "";\r\n						}\r\n						else {\r\n							document.getElementById(tid).style.display = "none";	\r\n						}\r\n					}\r\n				</script>', 'faq'),
(5, 1, 'bmccarthy', '$result = mysql_query("SELECT * FROM contact ORDER BY id DESC LIMIT 1") or die(mysql_error());\r\n\r\n	while($row = mysql_fetch_array($result)) {\r\n		$id = $row[''id''];\r\n		$pageID = stripslashes($row[''page_id'']);\r\n		$title = stripslashes($row[''title'']);\r\n		$pageTitle = stripslashes($row[''page_title'']);\r\n		$pageSubtitle = stripslashes($row[''page_subtitle'']);\r\n		$pageContent = stripslashes($row[''page_content'']);\r\n	}', '        	print("<h2>"); echo $pageTitle; print("</h2>");\r\n            \r\n             echo $pageSubtitle; \r\n            \r\n             echo $pageContent; ', '', 'contact');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE IF NOT EXISTS `payment_methods` (
  `method_id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `add_date` int(11) NOT NULL,
  `billing_first_name` varchar(50) NOT NULL,
  `billing_middle_initial` varchar(10) NOT NULL,
  `billing_last_name` varchar(50) NOT NULL,
  `billing_address_1` varchar(100) NOT NULL,
  `billing_address_2` varchar(100) NOT NULL,
  `billing_city` varchar(50) NOT NULL,
  `billing_state` varchar(10) NOT NULL,
  `billing_zipcode` varchar(10) NOT NULL,
  `billing_phone` varchar(25) NOT NULL,
  `credit_card_number` varchar(50) NOT NULL,
  `credit_card_last_four` varchar(10) NOT NULL,
  `credit_card_security_code` varchar(50) NOT NULL,
  `credit_card_exp_month` varchar(50) NOT NULL,
  `credit_card_exp_year` varchar(50) NOT NULL,
  `credit_card_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`method_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Payment Methods' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `payment_methods`
--


-- --------------------------------------------------------

--
-- Table structure for table `quick_contact`
--

CREATE TABLE IF NOT EXISTS `quick_contact` (
  `qc_id` int(10) NOT NULL auto_increment,
  `timestamp` int(15) NOT NULL,
  `qc_name` varchar(255) NOT NULL,
  `qc_email` varchar(255) NOT NULL,
  `qc_phone` varchar(200) NOT NULL,
  `qc_timeCall` text NOT NULL,
  `qc_questions` text NOT NULL,
  UNIQUE KEY `qc_id` (`qc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `quick_contact`
--

INSERT INTO `quick_contact` (`qc_id`, `timestamp`, `qc_name`, `qc_email`, `qc_phone`, `qc_timeCall`, `qc_questions`) VALUES
(8, 1362161880, 'Brandon McCarthy', 'brandon.gooch@gmail.com', '817-233-1299', 'Morning', 'I have a question.'),
(9, 1362162060, 'Brandon McCarthy', 'brandon.gooch@gmail.com', '817-223-1299', 'Morning', 'Questions Comments'),
(10, 1362162840, 'Brandon McCarthy', 'brandon.gooch@gmail.com', '817-233-1299', 'Evening', 'I would like to get more information on Smart Women Buy Homes. Thanks.'),
(11, 1362163320, 'Alex Dillhoff', 'media.mccarthy@gmail.com', '817-918-6576', 'Afternoon', 'This is my final question.'),
(12, 1362163920, 'Brandon McCarthy', 'brandon.mccarthy@ewomennetwork.net', '817-946-3659', 'Never', 'This contact form emails to a desired address and stores the information in a database table. About to hear back from Gordon on the design. And Kym is getting me the info for the online payment processor. I''ll of course call you later about this but I wanted you to see this test.\r\n\r\nBy the way this form is located here:\r\n\r\nhttp://www.smartwomenbuyhomes.com/index2.php?page=form\r\n\r\nI Still need to style it but at least the functionality works. I''m sure you might want to make a few tweaks, like putting the process code in a process.php file.'),
(13, 1362168180, 'Brandon McCarthy', 'media.mccarthy@gmail.com', '817-946-3659', 'Never', 'This contact form emails to a desired address and stores the information in a database table. About to hear back from Gordon on the design. And Kym is getting me the info for the online payment processor. I''ll of course call you later about this but I wanted you to see this test.\r\n\r\nBy the way this form is located here:\r\n\r\nhttp://www.smartwomenbuyhomes.com/index2.php?page=form\r\n\r\nI Still need to style it but at least the functionality works. I''m sure you might want to make a few tweaks, like putting the process code in a process.php file.');

-- --------------------------------------------------------

--
-- Table structure for table `realtorapp`
--

CREATE TABLE IF NOT EXISTS `realtorapp` (
  `id` int(20) NOT NULL auto_increment,
  `timestamp` int(20) NOT NULL,
  `edit_by` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_subtitle` longtext NOT NULL,
  `page_content` longtext NOT NULL,
  `page_extra` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `realtorapp`
--

INSERT INTO `realtorapp` (`id`, `timestamp`, `edit_by`, `page_id`, `title`, `page_title`, `page_subtitle`, `page_content`, `page_extra`) VALUES
(1, 1, 'bmccarthy', 'realtor', 'Realtor Application', 'Realtor Application', '<h3>Realtor&reg;, please consider:</h3>\r\n            \r\n            <h3>Millions of single women bought homes last year. They made up 20 percent of all buyers.</h3>', '<p>Single women world-wide are on a fast pace towards home ownership. Times have drastically changed in just 30 years. Women now make up over 50% of the workforce and also earn 58% of all college degrees. A study done by Harvard University''s Joint Center for housing found that single women buy approximately one million homes per year.</p>\r\n            \r\n            <p>So why are so many women buying homes now? More and more women are waiting longer to get married and have a family. Plus, women now have greater financial independence due to the economic gains in the workforce. Single women are now building their own nest eggs with home equity. Young women globally are becoming more independent and the dream of owning one''s own home will be realized in other countries besides the United States as well.</p>\r\n            \r\n            <p>With the number of women purchasing homes increasing, there is a need for help navigating the world of real estate.</p>\r\n            \r\n            <ul>\r\n            	<li>Single women made up 20% of all home buyers.</li>\r\n                <li>More than one million homes a year are purchased by single women.</li>\r\n                <li>21% of first-time buyers are single women.</li>\r\n                <li>The average age of single women homebuyers is 47.</li>\r\n                <li>The average age of first-time single women home buyers is 34.</li>\r\n                <li>The No.1 reason single women are buying homes is their strong desire to nest.</li>\r\n            </ul>\r\n            \r\n            <p><span>Source: National Assoc. of Realtors 2011 Buyers & Sellers Survey and The Joint Center for Housing Studies</span></p>\r\n            \r\n            <p>One of the biggest obstacles to single women is the lack of information about the home purchasing process, and understanding the dynamics of credit issues. This leaves many women feeling intimidated by the whole buying process. Because the real estate market offers many challenges for a novice home buyer it is essential to find a real estate professional who understands the wants and needs of single women home buyers. Single women can realize their dreams of home ownership through "Smart Women Buy Homes", a program specifically designed to help single women through the home buying process. This program offers one stop shopping.</p>\r\n            \r\n            <p>I have worked with the "Single Women" market for over seven years and have developed a comprehensive turnkey program. You will have all the tools you need to market to this demographic. It has increased my business year after year.</p>\r\n            \r\n            <p>Here is a sample list of what you will receive to get your "Smart Women Buy Homes" program started. You can customize with your brand and for your area.</p>', '<h4>Smart Women Buy Homes - Marketing Materials</h4>\r\n            \r\n            <ol class="o-list">\r\n            	<li>"Smart Women Buy Homes - Discover the joy of home ownership!"&ndash;An informational booklet is a valuable tool that can be used as a free offer to generate leads, a takeaway from seminars, etc.</li>\r\n                \r\n                <li>"Smart Women Buyer: Financing Process"&ndash;An easy way to understand the financial process</li>\r\n                \r\n                <li>Brochure Tri-Fold, "Smart Women Buy Homes"&ndash;Customize for your brand</li>\r\n                \r\n                <li>Print Ads & Postcards&ndash;These ads will focus on three different stages: First-time single homebuyers, single mothers and Boomers or widowed.</li>\r\n                \r\n                <li>Two-Pocket Folder&ndash;Folder to package materials</li>\r\n                \r\n                <li>Single Women Buyer Presentation&ndash;Presentation to be used for seminars or webinars that can be customized for your brand &ndash; Power Point</li>\r\n                \r\n                <li>Sample Press Release&ndash;Customize for local market</li>\r\n                \r\n                <li>e-Greeting Card&ndash;Use as introduction or follow-up</li>\r\n                \r\n                <li>Brochure, "Divorce and Your Home"</li>\r\n                \r\n                <li>Business Card Template</li>\r\n                \r\n                <li>Letter Head Template</li>\r\n                \r\n                <li>Thank You Card Template</li>\r\n                \r\n                <li>Social Media Strategy for Facebook, Twitter, LinkedIn, &amp; YouTube</li>\r\n            </ol>\r\n            \r\n            <p>Smart Women Buy Homes&trade; advisors are professional real estate agents who have a passion and commitment to serving the unique needs of single women home buyers. We are dedicated to making it easy, exciting and a joy for the single woman to buy and own a home.</p>\r\n            \r\n            <p>If you would like to apply to become a "Smart Women Buy Homes" Advisor please fill out the form in the upper right of this page, and someone will contact you.</p>'),
(2, 2, 'bmccarthy', 'realtor', 'For Realtors', 'For Realtors', '<p>If you are a realtor&reg; who wants to bring the joy of homeownership to single women and expand your real estate practice  we invite you to contact us. We will be happy to share how our   Smart Women Buy Homes Advisor Program can help you.</p>\r\n \r\n<p>This is an exclusive program and is only available to realtors. Please complete the confidential contact form if you would like to learn about the benefits of our program.</p>', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL,
  `method_last_four` varchar(10) NOT NULL,
  `transaction_date` int(11) NOT NULL,
  `transaction_ip` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `sale_amount` decimal(10,2) NOT NULL default '0.00',
  `sale_tax` decimal(10,2) NOT NULL default '0.00',
  `sale_shipping` decimal(10,2) NOT NULL default '0.00',
  `sale_total` decimal(10,2) NOT NULL default '0.00',
  `process_id` varchar(32) NOT NULL,
  `process_type` varchar(32) NOT NULL,
  `process_auth_code` varchar(10) NOT NULL,
  `process_response_code` varchar(10) NOT NULL,
  `process_avs_code` varchar(10) NOT NULL,
  `process_reason_code` varchar(10) NOT NULL,
  `process_reason_text` varchar(255) NOT NULL,
  PRIMARY KEY  (`transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `transactions`
--

