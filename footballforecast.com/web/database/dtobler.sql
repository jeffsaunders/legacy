-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: 10.0.6.102
-- Generation Time: Mar 31, 2006 at 01:33 AM
-- Server version: 4.0.24
-- PHP Version: 4.3.2
-- 
-- Database: `dtobler`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `category`
-- 

CREATE TABLE `category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `category`
-- 

INSERT INTO `category` VALUES (2, 'test', 'test category');
INSERT INTO `category` VALUES (3, 'Search Engine', 'SE');

-- --------------------------------------------------------

-- 
-- Table structure for table `handicap`
-- 

CREATE TABLE `handicap` (
  `id` int(11) NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `name` varchar(255) NOT NULL default '',
  `photo` varchar(255) NOT NULL default '',
  `week` decimal(10,2) NOT NULL default '0.00',
  `amount` decimal(10,2) NOT NULL default '0.00',
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `handicap`
-- 

INSERT INTO `handicap` VALUES (1, '2005-09-01', 'Dennis Tobler', 'images/handicapper/dennist.jpg', 98.99, 199.99, 'Hello Football Fans.<br><br>\r\n\r\n<b>MY WAGERING STRATEGY:</b>  Start with a comfortable opening bankroll (only wager what you can afford to lose).  After assigning a bankroll, the strategy is simple money management.  Each week, wager 10% of your bankroll on my 10 UNIT plays, 5% of your bankroll on my 5 UNIT plays and 3% of your bankroll on my 3 UNIT plays.  As your bankroll goes up…so does the size of your wagers. Strict money management will make you a WINNER this season!     <b>DENNIS TOBLER</b>');
INSERT INTO `handicap` VALUES (2, '2005-09-08', 'Jimbo', 'images/handicapper/jimbo.jpg', 99.95, 199.00, 'Howdy, that''s the greeting you get at Tex A&M.\r\nI am an Aggie and a real person just like you. I''ve got an eight to five job.  I am an accountant, controller and a CPA.  I''ve lived in Vegas for 10 years - and I love football. I love parlays and hit five teamers all year. You''ll love my picks and my strategy. I will release my top college and NFL sections each Thursday. Parlay them, tease, round robin them...but whatever you do use my winners!');
INSERT INTO `handicap` VALUES (3, '2005-09-01', 'Prime Picks', 'images/handicapper/ballqube100.jpg', 99.00, 199.00, 'These selctions are from a group of professional Las Vegas handicappers, ALL who wish to remain anoyomous. THESE GAMES ARE MENT TO BE PLAYED STRAIGHT AND STRONG!!!');

-- --------------------------------------------------------

-- 
-- Table structure for table `link`
-- 

CREATE TABLE `link` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL default '',
  `category_id` int(11) NOT NULL default '0',
  `admin` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `phone` varchar(255) NOT NULL default '',
  `reciprocal` varchar(255) NOT NULL default '',
  `comment` text NOT NULL,
  `active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=42 ;

-- 
-- Dumping data for table `link`
-- 

INSERT INTO `link` VALUES (2, 'Frugal Car Rental', 'Las Vegas rental cars starting at only $19.99 a day or $134.99 a week.  Frugal Car Rental provides the highest quality service and best overall prices in Las Vegas.', 'http://www.frugalcarrental.com', 3, 'Walter Zeiser', 'walter@cybermight.com', '702.897.1954', 'http://www.frugalcarrental.com/links.htm', '', 1);
INSERT INTO `link` VALUES (13, 'Advantage Football', 'Online suicide Football Pool open to the world.', 'http://www.AdvantageFootball.com', 0, '', 'advertising@advantagefootball.com', '', 'http://www.advantagefootball.com/Advertise.asp', '', 1);
INSERT INTO `link` VALUES (14, '49ers Paradise', 'A place and 49ers fan can call home, with updated news all day, everyday, including orginal content and a great community.', 'http://www.49ersparadise.com', 0, '', 'webmaster@49ersparadise.cjb.net', '', 'http://www.49ersparadise.com/links.shtml', '', 1);
INSERT INTO `link` VALUES (11, 'College Football Predictions', 'American College Football ', 'http://homepages.cae.wisc.edu/~dwilson/rsfc/rate/gambling.shtml', 3, 'David L. Wilson', 'dwilson@cae.wisc.edu', '608/233-7211', 'http://homepages.cae.wisc.edu/~dwilson/rsfc/rate/gambling.shtml', '', 1);
INSERT INTO `link` VALUES (16, 'Bodog Sportsbook!', 'Pro football game lines at Bodog Sports!', 'http://www.bodog.com/sportsbook/', 0, '', 'links@bodog.com', '', 'http://www.bodog.com/link-echange/', '', 1);
INSERT INTO `link` VALUES (17, 'Astrology Consulting Services for Gamblers', 'A site for Glamblers can get their Astrology Consultation.', 'http://www.e-destin.com', 0, '', 'webmaster@e-destin.com', '', 'http://www.e-destin.com', '', 1);
INSERT INTO `link` VALUES (15, 'SoccerNetUSA', 'SoccerNetUSA offers info about soccer tournaments, mls, world Cup Soccer 2006, ncaa soccer, world cups soccers, major league soccer, Fifa, soccer stadiums, classic soccer players, scores and history.', 'http://soccernetusa.com', 0, '', 'links@soccernetusa.com', '', 'http://soccernetusa.com', '', 1);
INSERT INTO `link` VALUES (18, 'Wager Web', '<p><a\r\nhref="http://www.wagerweb.com/index.cfm?page=live-lines&liveid=1"\r\nstyle="font-size:9pt;color:#0000FF;font-family:arial;font-weight:bold;text-decoration:\r\nunderline">NFL Football Betting odds at WagerWeb!</a><br>\r\n<span style="font-size:8pt;text-decoration:\r\nnone;font-family:arial;font-weight:normal">All the best NFL odds and\r\nlines at WagerWeb Sportsbook! </span></p>\r\n', 'http://www.wagerweb.com/', 0, '', '', '', 'http://www.wegarweb.com/links', '', 1);
INSERT INTO `link` VALUES (19, 'Pro Group Racing', 'Horse Racing. Selections and information. International puters welcome. ', 'http://www.progroupracing.com.au', 0, '', '', '', 'http://www.progroupracing.com/links/', '', 1);
INSERT INTO `link` VALUES (20, 'Fantasy Football Mastermind', 'Providing comprehensive fantasy football coverage.', 'http://www.ffmastermind.com/quickbits.php', 0, '', '', '', 'http://www.ffmastermind.com/linkus.php', '', 1);
INSERT INTO `link` VALUES (21, 'Fantasy Tailgate', 'A fantasy football community with news, cheat sheets, rankings, NFL rumors, Moch Drafts, our famous Starters & Slackers, articles and forms.', 'http://www.fantasytailgate.com/', 0, '', '', '', 'http://www.fantasytailgate.com/LINKS.html', '', 1);
INSERT INTO `link` VALUES (22, 'You Wager', 'You wager offers everything from sports betting to online poker.', 'http://www.youwager.com/', 0, '', '', '', 'http://www.youwager.com/links/football-football-2.html', '', 1);
INSERT INTO `link` VALUES (23, 'OOBG', 'The offical offshore betting guide.', 'http://www.oobg.com', 0, '', '', '', 'http://www.links@oobg.com', '', 1);
INSERT INTO `link` VALUES (24, 'Thos Baker', 'Premuim quality teak chairs, tables, loungers, benches, streamers, Adirondacks and outdoor lawn and deck furniture items available for immediate shipment.\r\n', '<a href=', 0, '', '', '', 'http://www.thosbaker.com', '', 1);
INSERT INTO `link` VALUES (25, 'HotList Rookies.com- Basball Cards', '<a href=''http://www.hotlistrookies.com'' target=_blank><b>HotListRookies.com - Baseball Cards</b></a><br>Search for your favorite player''s baseball cards, rookie cards, vintage and baseball Hall of Fame cards, authentic certified autograph baseball cards, factory sealed baseball card sets, and game used memorabilia.<br><br>', 'http://www.hotlistrookies.com', 0, '', '', '', 'http://www.hotlistrookies.com/links/php', '', 1);
INSERT INTO `link` VALUES (26, 'Air Hockey', ' \r\n\r\n \r\n\r\n\r\n<a href=''www.americansupersports.com/'' target=_blank><b>Air Hockey</b></a><br>Great prices on quality air hockey tables including Dynamo air hockey, Great American, Carrom, Harvard, Shelti, and Playcraft air hockey.<br><br>', 'www.americansupersports.com/', 0, '', '', '', 'http:www.americansupersports.com/links.php', '', 1);
INSERT INTO `link` VALUES (27, 'Football-Rumours', '<a href="http://www.football-rumours.com/"><b>Football Rumours</b></a><br />Football rumours news transfers and player profiles with pictures', 'http://www.football-rumors.com', 0, '', '', '', 'http://www.football-rumours.com/links/php', '', 1);
INSERT INTO `link` VALUES (28, 'Big Games Live on your pc', 'Watch live football games, soccer, tennis, whatever your sport, we''ve got it all, plus more, LIVE!', 'http://www.sky-pc.biz', 0, '', '', '', 'http:www.sky-pc.biz', '', 1);
INSERT INTO `link` VALUES (29, 'Party Poker Stars', 'Collect your free poker money from Party Poker Stars http://www.party-poker-1.com that offers players some of the top poker games and tournaments that can be played at any of the party poker tables.', 'http://www.party-poker-1.com', 0, '', '', '', 'http://www.party-poker-1.com', '', 0);
INSERT INTO `link` VALUES (30, 'Link Partners', '<font face="Verdana, Arial" size="2"><b><a href="http://www.linkpartners.com">LinkPartners.com</a></b><br>  The Easy Way to Find Link Swap Partners</font>', 'http://www.linkpartners.com', 0, '', '', '', '', '', 0);
INSERT INTO `link` VALUES (31, 'A2Z Gift Outlet', '<a href="http://www.a2zgiftoutlet.com/">A2Z Gift Outlet</a> - A2Z Gift Outlet, Welcome to our online store. We have the special gift for the loved one in your life. If you do not see the gift you are looking for call us and we will get it for you.', 'http://www.a2giftoutlet.com', 0, '', '', '', 'http://www.a2zgiftoutlet.com/links/index.htm', '', 1);
INSERT INTO `link` VALUES (32, 'Auto Dealer Incentives', '<a href="http://www.autodealerincentives.net">Auto Dealer Incentives</a><br>\r\nWith auto dealer incentives becoming as liberal as they are, it wouldn''t surprise me if some auto manufacturers advertised an incentive program to send buyers'' kids to college for free.<br> \r\n\r\n\r\n', 'http://www.autodealerincentives.net', 0, '', '', '', 'http://www.autodealerincentives.net/resources.html', '', 1);
INSERT INTO `link` VALUES (33, 'US Term Life', '<a href="http://www.ustermlife.com">Term Life Insurance Quotation</a><br>\r\nWe offer term life insurance quotation service online find an agent today! Term Life Insurance provides you a low cost policy protection and death benefit for your family.<br> \r\n\r\n\r\n', 'http://www.ustermlife.com/index.html', 0, '', '', '', 'http://www.ustermlife.com/resources1.html', '', 1);
INSERT INTO `link` VALUES (34, 'LINK WITH US', 'Revolutionize your link Trades today! Link quickly and easily with other webmasters and link exchangers. Our link exchange manager automates the link process so you can save valuable time spent link trading and the SEO process. Refocus and manage your time more efficiently with robust link trading tools and see why everyone is raving about LinkWithUs.com!\r\n\r\n \r\n\r\n', 'http://www.linkwithus.com', 0, '', '', '', 'http://www.linkwithus.com', '', 1);
INSERT INTO `link` VALUES (35, 'Poker Movies', 'Your source for poker movie reviews.', 'http://www.pokerandlife.com/movies.htm', 0, '', '', '', 'http://www.pokerandlife.com/letsplay.htm', '', 1);
INSERT INTO `link` VALUES (36, 'True Poker Room', 'Two true poker rooms to play at.', 'http://www.truepokerroom.com', 0, '', '', '', 'http://www.truepokerroom.com', '', 1);
INSERT INTO `link` VALUES (37, 'The Designer Sunglasses', 'Find quality sunglasses at low prices.', 'http://www.sunglassofthemonth.com', 0, '', '', '', 'http://www.sunglassofthemonth.com/directory', '', 1);
INSERT INTO `link` VALUES (38, 'Green Power Alternatives', 'Your online source of green power alternatives.', 'http://www.greenpoweralternatives.com', 0, '', '', '', 'http://www.greenpoweralternatives.com/directory', '', 1);
INSERT INTO `link` VALUES (39, 'In the beginning was...', 'Find out how it could have been in the beginning.', 'http://www.inthebeginningwas.com', 0, '', '', '', 'http://www.inthebeginning.com/directory', '', 1);
INSERT INTO `link` VALUES (40, 'KFFL', 'The Hottest, NFL, MLB and Fantasy News and Content', 'http://www.kffl.com', 0, '', '', '', 'http://www.kffl.com/static/links', '', 1);
INSERT INTO `link` VALUES (41, 'Online wagering Sportsbook and Casino at BetPop.com\r\n', 'Online wagering Sportsbook and Casino at BetPop.com offers online sports betting on all major sports. World''s highest football and basketball parlay payoffs and world''s lowest teaser juice.\r\n', 'http://www.betpop.com', 0, 'Benjamin Chaverri', 'links@betpop.com', '18009689243', 'http://www.betpop.com/links/index.php', '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `member`
-- 

CREATE TABLE `member` (
  `no` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  `state` varchar(50) NOT NULL default '',
  `phone` varchar(50) NOT NULL default '',
  `login_id` varchar(50) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `status` varchar(50) NOT NULL default '',
  `registration_date` date NOT NULL default '0000-00-00',
  `last_login` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`no`)
) TYPE=MyISAM AUTO_INCREMENT=71 ;

-- 
-- Dumping data for table `member`
-- 

INSERT INTO `member` VALUES (1, 'Frely', 'frely@cybermight.com', 'Jl. Gamelan', 'Vegas', 'NV', '34536547', 'frely', 'frely', 'free', '2005-07-30', '0000-00-00');
INSERT INTO `member` VALUES (2, 'Test user', 'test@here.net', 'Home address', 'Vegas', 'Nevada', '23567', 'test', 'admin', 'free', '2005-08-02', '0000-00-00');
INSERT INTO `member` VALUES (3, 'Dennis Tobler', 'winner@footballforecaast.com', '', '', '', '', 'winner', 'dt5169', 'free', '2005-08-05', '0000-00-00');
INSERT INTO `member` VALUES (4, 'mindi', 'pinkxstar@hotmail.com', '', '', '', '7026589643', 'mindiii09', '060187', 'free', '2005-08-05', '0000-00-00');
INSERT INTO `member` VALUES (5, 'Kevin Olson', 'keolson@hotmail.com', '', '', '', '011-506-643-2208', 'bigskyoly', 'ontime22', 'free', '2005-08-09', '0000-00-00');
INSERT INTO `member` VALUES (6, 'jim burford', 'jburfman@tjm.lvcoxmail.com', '3900 paradise rd no 257', 'Las Vegas', 'nevada', '702 683 7575', 'jimbo', 'burfman', 'free', '2005-08-11', '0000-00-00');
INSERT INTO `member` VALUES (7, 'Arnie', 'mandy0976@yahoo.com', '', '', '', '', 'arnie', 'mandy0976', 'free', '2005-08-15', '0000-00-00');
INSERT INTO `member` VALUES (8, 'Predrag Sadzakovic', 'peca@ujp.sr.gov.yu', 'Zidarska 8/14', 'Beograd', 'Srbija', '381112891697', 'pecas', 'pecasad', 'free', '2005-08-18', '0000-00-00');
INSERT INTO `member` VALUES (9, 'Theodor', 'pardopolis777@msn.com', '', '', '', '', 'Theo', '110338', 'free', '2005-08-19', '0000-00-00');
INSERT INTO `member` VALUES (10, 'Juan Rodriguez', 'rodrigueztyle2@juno.com', '9040 W 5th Ave', 'Lakewood', 'CO', '720-270-3994', 'conejo2000', 'guanatos', 'free', '2005-08-20', '0000-00-00');
INSERT INTO `member` VALUES (11, 'Raymond Trujillo', 'lvman_1025@yahoo.com', '2320 N Nellis #2', 'Las Vegas', 'NV', '702-785-8666', 'lvman1025', 'stunner', 'free', '2005-08-22', '0000-00-00');
INSERT INTO `member` VALUES (12, 'dave', 'minibikenrw@aol.com', 'hochst', 'german', 'deutsch', '', 'mini', 'bike', 'free', '2005-08-22', '0000-00-00');
INSERT INTO `member` VALUES (13, 'qwert', 'robert@footballforecast.com', '1109 w adams', 'Las Vegas', 'nevada', '7024667674', '123456', '123456', 'free', '2005-08-23', '0000-00-00');
INSERT INTO `member` VALUES (14, 'robert roberts', 'robert@footballforecast.com', '1109 w adams', 'Las Vegas', 'nevada', '7024667674', 'qwert', '123456', 'free', '2005-08-23', '0000-00-00');
INSERT INTO `member` VALUES (15, 'Dennis Tobler', 'dennis@gamingbroadcast.com', '', '', '', '702-655-4423', 'dtobler', '5169', 'free', '2005-08-24', '0000-00-00');
INSERT INTO `member` VALUES (16, 'Kevin Paul', 'noisejunke@earthlink.net', '', '', '', '', 'noisejunke', 'blue', 'free', '2005-08-25', '0000-00-00');
INSERT INTO `member` VALUES (17, 'Tom Poidevin', 'tpoid3@optonline.net', '550 Third St', 'Any City', 'NY', '548-323-0004', 'tpoid3', 'magmag', 'free', '2005-08-25', '0000-00-00');
INSERT INTO `member` VALUES (18, 'Nikki', 'dream70239@aol.com', '', '', '', '', 'nikki', 'change', 'free', '2005-08-30', '0000-00-00');
INSERT INTO `member` VALUES (19, 'ken', 'kkottsick1@bis.midco.net', '', '', '', '', 'kkottsick12BIS.MIDCO.NET', 'kittykitty', 'free', '2005-08-30', '0000-00-00');
INSERT INTO `member` VALUES (20, 'magic fraga', 'magiccostarica@aol.com', 'hcr 20 lot 1580', 'blythe', 'ca', '760-922-6848', 'magic89', '7351334', 'free', '2005-09-01', '0000-00-00');
INSERT INTO `member` VALUES (21, 'Tim Teegarden', 'tteegarden@d211.org', '38w751 Bonnie Ct', 'St. Charles', 'IL', '630-443-7122', 'tteegarden28', 'he1431431', 'free', '2005-09-01', '0000-00-00');
INSERT INTO `member` VALUES (22, 'duffy', 'dschulz@lakemac.net', 'box 103', 'brule', 'ne', '308-287-2130', '66666', 'floyd', 'free', '2005-09-02', '0000-00-00');
INSERT INTO `member` VALUES (23, 'Al Smedley', 'Opah702@aol.com', '360 Chesapeake', 'Henderson', 'Nv', '564-4449', 'BigAl702', 'chesapeake1', 'free', '2005-09-02', '0000-00-00');
INSERT INTO `member` VALUES (24, 'Joey', 'dadevilcr@yahoo.com', 'CR', 'betspc', 'betspc', '888-425-30-45', 'joeybetspc', 'cliffman', 'free', '2005-09-03', '0000-00-00');
INSERT INTO `member` VALUES (25, 'bill kinney', 'bill1husker@yahoo.com', '', '', '', '', 'bkinney', 'mercedes', 'free', '2005-09-05', '0000-00-00');
INSERT INTO `member` VALUES (26, 'Lyal Herzog', 'bacshee@hotmail.com', '385 new hampshire way', 'placentia', 'ca', '714 328-5515', 'bacshee', 'richie', 'free', '2005-09-06', '0000-00-00');
INSERT INTO `member` VALUES (27, 'Jeff Saunders', 'jeff@nr.net', '217 Creekside Drive', 'Murphy', 'TX, 75094', '972-461-0540', 'jeffsaunders', 'chargers', 'free', '2005-09-06', '0000-00-00');
INSERT INTO `member` VALUES (28, 'Marilyn Shullo', 'marilynlshullo@hotmail.com', '650 S. Town Center Dr #2078', 'Las Vegas', 'NV', '702-321-2062', 'intrestdnu', 'oneoff2k', 'free', '2005-09-06', '0000-00-00');
INSERT INTO `member` VALUES (29, 'S Garcia', 'sgarcia_92543@yahoo.com', '551 S. Carmalita', 'Hemet', 'Ca', '9512855661s', 'sgarcia61', '051261', 'free', '2005-09-06', '0000-00-00');
INSERT INTO `member` VALUES (30, 'Pam', 'PBrady@burgesons.com', '620 Tennessee', 'Redlands', 'CA', '9097933685', 'Mythtery', '317717', 'free', '2005-09-06', '0000-00-00');
INSERT INTO `member` VALUES (31, 'loretta walters', 'walters.l@rogers.com', '816 Bayswater Street', 'Woodstock', 'Ontario', 'N4S 5K5', 'lwalters', '312101', 'free', '2005-09-06', '0000-00-00');
INSERT INTO `member` VALUES (32, 'Gary Haack', 'haackfam@daltontel.net', '3068 Rd. 59 E', 'Dix', 'NE.', '308 682 5563', 'garyhaack', '123456', 'free', '2005-09-06', '0000-00-00');
INSERT INTO `member` VALUES (33, 'Terry Turner', 'dturner275@comcast.net', '', '', '', '239-898-9589', 'tlturner', '8358tdlt', 'free', '2005-09-07', '0000-00-00');
INSERT INTO `member` VALUES (34, 'Carmen Conejo', 'carmen.conejo@gmail.com', 'pavas', 'San Jose', 'Costa Rica', '3823318', 'carmen.conejo', 'repollo', 'free', '2005-09-07', '0000-00-00');
INSERT INTO `member` VALUES (35, 'Gary Bristow', 'gbristow@enmax-ups.com', '16181 Hollyridge Drive', 'Parker', 'CO', '303-841-0452', 'gbristow', '006622', 'free', '2005-09-08', '0000-00-00');
INSERT INTO `member` VALUES (36, 'LLOYD HAACK', 'schreib@omnitelcom.com', 'Bix 4984', 'Greene', 'Iowa', '641 816 5611', 'haacksaw', 'kathryn', 'free', '2005-09-08', '0000-00-00');
INSERT INTO `member` VALUES (37, 'coolkel', 'coolkel@cox.net', '', '', '', '', 'coolkel', 'jb', 'free', '2005-09-08', '0000-00-00');
INSERT INTO `member` VALUES (38, 'coolkel', 'coolkel@cox.net', '', '', '', '', 'coolkelcoolkel', 'jbjb', 'free', '2005-09-08', '0000-00-00');
INSERT INTO `member` VALUES (39, 'Dave Haack', 'DaveHaack55@hotmail.com', '3118 Primrose Drive', 'Scottsbluff', 'Nebraska', '308 635 7485', 'Dave Haack', 'action', 'free', '2005-09-15', '0000-00-00');
INSERT INTO `member` VALUES (40, 'chet', 'fcsm63@hotmail.com', '1872 west 9th street', 'brooklyn', 'new jersey', '20140638887', 'fcsmfs', '129212', 'free', '2005-09-28', '0000-00-00');
INSERT INTO `member` VALUES (41, 'Anthony', 'antanglin@netzero.com', '11324 Anglin Lane', 'Folsom', 'Louisiana', '', 'antanglin', 'summer', 'free', '2005-10-06', '0000-00-00');
INSERT INTO `member` VALUES (42, 'dave sabre', 'davidosabre@aol.com', '999 main st', 'palm cove', 'fl', '772-811-9406', 'davidosabre', 'pumpk1n', 'free', '2005-10-13', '0000-00-00');
INSERT INTO `member` VALUES (43, 'Lynn Price', 'lynngambleprice@hotmail.com', '8844 Cortile Drive', 'Las Vegas', 'nv', '702/243-9112', 'lynngambleprice@hotmail.com', 'deanna', 'free', '2005-10-13', '0000-00-00');
INSERT INTO `member` VALUES (44, 'RENATO COLLADO', 'renatocollado@hotmail.com', 'DOMINICAN REPUBLIC', 'SANTO DOMINGO', 'SANTO DOMINGO', '809-601-6389', 'RENATO', 'RENI0870', 'free', '2005-10-19', '0000-00-00');
INSERT INTO `member` VALUES (45, 'Michael Shaw', 'surecash116@msn.com', '116 45th St. South', 'Brigantine', 'nj', '609-264-7651', 'surecash116', 'trump69', 'free', '2005-10-20', '0000-00-00');
INSERT INTO `member` VALUES (46, 'charles r thornton', 'traethornton@yahoo.com', '1389 jonesboro rd,', 'dunn', 'nc', '910-892-4454', 'traeday', 'sungod', 'free', '2005-10-22', '0000-00-00');
INSERT INTO `member` VALUES (47, 'BreckColquett', 'breck@bcsupply.com', '2008 east 50th', 'lubbock', 'texas', '806-239-3636', 'Laser1', 'zito', 'free', '2005-10-29', '0000-00-00');
INSERT INTO `member` VALUES (48, 'Joe', 'dadevilcr@yahoo.com', 'CR', 'CR', 'CR', '1112223335', 'Fuckyou', 'fuckyou', 'free', '2005-10-29', '0000-00-00');
INSERT INTO `member` VALUES (49, 'Sam Scott', 'bigdudelv@aol.com', '1825 Lamplighter Lane', 'Las Vegas', 'NV', 'NA', 'bigdudelv', 'star', 'free', '2005-10-31', '0000-00-00');
INSERT INTO `member` VALUES (50, 'kenneth cole', 'kennethcolea@aol.com', '3726 Yaupon dr', 'grand Prairie', 'Texas', '817-714-8700', 'kc1102', 'theiceman', 'free', '2005-11-02', '0000-00-00');
INSERT INTO `member` VALUES (51, 'Reg Archer', 'reg_archer@yahoo.com', '2048 S. Raleigh St', 'Denver', 'CO', '303-896-3481', 'reggie', 'bavery', 'free', '2005-11-02', '0000-00-00');
INSERT INTO `member` VALUES (52, 'Norman Manhin', 'normanm@gmail.com', '', '', '', '', 'janus771', 'ricedout', 'free', '2005-11-03', '0000-00-00');
INSERT INTO `member` VALUES (53, 'grant wright', 'gawright@hiwaay.net', '308 knightsbridge rd.', 'florence', 'al', '256-383-6357', 'gawright', 'mckenna', 'free', '2005-11-07', '0000-00-00');
INSERT INTO `member` VALUES (54, 'McLeod Banks', 'mbanks36@hotmail.com', '3482 countryhill drive', 'Bartlett', 'TN', '901-382-5614', 'endzone36', 'ironman', 'free', '2005-11-10', '0000-00-00');
INSERT INTO `member` VALUES (55, 'robert carlisle', 'carlislepc@aol.com', '772 valley ridge way', 'pensacola', 'fl', '850-554-8020', 'bob. b. bucks', 'billions1', 'free', '2005-11-16', '0000-00-00');
INSERT INTO `member` VALUES (56, 'Ron Mexico', 'ElSucio373@yahoo.com', '13841 SW 283 Terrace', 'Homestead', 'FL', '305-910-1212', 'ElSucio373', '12345678', 'free', '2005-11-16', '0000-00-00');
INSERT INTO `member` VALUES (57, 'Greg Bearden', 'gregb10@cox.net', '10162 Country Flats Lane', 'Las Vegas', 'NV', '702-256-6652', 'gregb10', 'needlegpb', 'free', '2005-11-17', '0000-00-00');
INSERT INTO `member` VALUES (58, 'nikki murdock', 'nikki@footballforecast.com', '', '', '', '1888 944 6644', 'dream', 'people', 'free', '2005-11-17', '0000-00-00');
INSERT INTO `member` VALUES (59, 'Bill Goodman', '8415@earthlink.net', '3104 Barkley Avenue', 'Midland', 'Texas', '4325206642', 'silverviper', 'matrix', 'free', '2005-11-20', '0000-00-00');
INSERT INTO `member` VALUES (60, 'zoltan paal', 'zgpaal@yahoo.com', '2434 e 6600 s.', 'salt lake city', 'utah', '8019423697', '708914', 'kalocsa', 'free', '2005-11-21', '0000-00-00');
INSERT INTO `member` VALUES (61, 'Walter Zeiser', 'wzeiser@cybermight.com', '123', '123', '123', '702-312-1601', '123', '123', 'free', '2005-11-22', '0000-00-00');
INSERT INTO `member` VALUES (62, 'shane', 'custombike124@yahoo.com', '308 central rd', 'duluth', 'mn', '2183918237', 'splinter124', 'cut99las', 'free', '2005-11-26', '0000-00-00');
INSERT INTO `member` VALUES (63, 'Jeff Ritchie', 'uteksteper@aol.com', '6025 Jason Dr.', 'Concord', 'NC', '704-795-6287', 'bpoint', 'avalon', 'free', '2005-11-30', '0000-00-00');
INSERT INTO `member` VALUES (64, 'Pete Ladd', 'yubappx@sbcglobal.net', '2399 Chele Ave', 'Marysville', 'CA', '530-870-2225', 'Lizard66', '133113', 'free', '2005-11-30', '0000-00-00');
INSERT INTO `member` VALUES (65, 'KG', 'sky@virtual-mail.com', 'no.20,50thstreet,yangon,myanmar', 'yangon', 'TAMWE', '095102709', 'KG', '13799', 'free', '2005-12-06', '0000-00-00');
INSERT INTO `member` VALUES (66, 'Chris', 'cpaterson@iwon.com', '5561 N. Croatan Hwy #355', 'Kitty Hawk', 'NC', '301 254 7778', 'chrispat', 'chrispat', 'free', '2005-12-07', '0000-00-00');
INSERT INTO `member` VALUES (67, 'Senad', 'roka_88@yahoo.com', 'Oslobodjenje 17', 'Novi Pazar', 'Yugoslavia', '020315985', 'senad_k', 'dalmatinska', 'free', '2006-01-07', '0000-00-00');
INSERT INTO `member` VALUES (68, 'Mr keen', 'ke@mail4u.com.mm', '162,a', 'yangon', 'myanmar', '+095224837', 'keen', 'CyberSp@ce', 'free', '2006-01-19', '0000-00-00');
INSERT INTO `member` VALUES (69, 'Mujan Edin', 'nuni@bih.net.ba', 'Doljani 78', 'Pazaric', 'Sarajevo', '061700948', 'Mujdza33', 'mujdza33', 'free', '2006-02-26', '0000-00-00');
INSERT INTO `member` VALUES (70, 'STANISLAUS  G OKEKE', 'celia_stan@yahoo.com', 'P.O.BOX 164 NNOBI ANAMBRA--STAE', 'NNOBI', 'ANAMBRA', '0803  8288754', 'PRINCE STAN', 'orange', 'free', '2006-03-15', '0000-00-00');

-- --------------------------------------------------------

-- 
-- Table structure for table `movie`
-- 

CREATE TABLE `movie` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `movie` varchar(255) NOT NULL default '',
  `status` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `movie`
-- 

INSERT INTO `movie` VALUES (1, '18-minutes Video Clip  from the past', 'This sample is a collage of videos spanning 20 years.\r\n\r\nWe are preparing a spectacular 2005 season…highlighted by a NEW version of Football Forecast Weekly, plus more Thoroughbred Racing Forecast, Inside Sports 2k, and a brand new “Poker Plus” series.', 'multimedia/nfl.asf', 'archive');
INSERT INTO `movie` VALUES (2, 'TV Multimedia Show', 'FOOTBALL FORECAST WEEKLY TELEVISON SHOW\r\nARCHIVED FROM PREVIOUS WEEK', 'multimedia/weekly.wmv', 'hidden');
INSERT INTO `movie` VALUES (3, 'goal archive', '20 years of Football Forecast', 'multimedia/gaming_broadcast_collage.wmv', 'archive');
INSERT INTO `movie` VALUES (5, 'test', 'test', '/mov/archive/FFW_Jimbo.wmv', 'archive');
INSERT INTO `movie` VALUES (6, 'test weekly video', 'test weekly', 'multimedia/weekly.wmv', 'tv_multimedia');
INSERT INTO `movie` VALUES (7, 'test weekly video', 'test weekly vid', 'http://www.footballforecast.com/mov/multimedia/FFW_Jimbo.wmv', 'tv_multimedia');
INSERT INTO `movie` VALUES (8, 'Weekly Video', 'Footballfans - Enjoy our weekly Video Show!', 'multimedia/weekly.php', 'tv_multimedia');
INSERT INTO `movie` VALUES (9, 'test weekly video', 'test', 'http://www.footballforecast.com/multimedia/weekly_video.wmv', 'tv_multimedia');

-- --------------------------------------------------------

-- 
-- Table structure for table `pick`
-- 

CREATE TABLE `pick` (
  `id` int(11) NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `title` varchar(255) NOT NULL default '',
  `competition` varchar(50) NOT NULL default '',
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL default '',
  `handicapper` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=35 ;

-- 
-- Dumping data for table `pick`
-- 

INSERT INTO `pick` VALUES (2, '2005-12-28', '10 UNIT PLAYS', 'College', '\r\nBoston College -1 VS Boise\r\n<br>\r\nTulsa +7.5 VS Fresno St.\r\n\r\n', 'paid', 1);
INSERT INTO `pick` VALUES (3, '2005-12-28', '5 UNIT PLAYS', 'College', 'N.C. St. -6 VS South Fla.\r\n<br>\r\nTCU -3.5 VS Iowa St.\r\n<br>\r\n', 'paid', 1);
INSERT INTO `pick` VALUES (16, '2006-01-17', 'This years record was 27-6 !!!! You do the math $$$', 'College', 'THIS YEAR''S RECORD IS NOW 27-6!!! THAT IS 85 PERCENT!\r\n', 'free', 0);
INSERT INTO `pick` VALUES (34, '2005-12-28', '3 UNIT PLAYS', 'College', 'Utah +8 VS Georgia Tech\r\n<br>\r\nOklahoma +3.5 VS Oregon\r\n<br>\r\nMissouri +3.5 VS South Carolina', 'paid', 1);
INSERT INTO `pick` VALUES (15, '2006-02-08', 'CONTACT US FOR ALL YOUR WINNING SPORT SELECTIONS', 'NFL', 'From all of us here at Football Forecast, thank you for sharing this football season with us...', 'free', 0);
INSERT INTO `pick` VALUES (22, '2005-12-21', '5 UNIT PLAYS', 'NFL', 'Eagles +1 vs Cardinals\r\n<br>\r\nRaiders +14 vs Broncos\r\n<br>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'paid', 1);
INSERT INTO `pick` VALUES (33, '2005-12-21', '10 UNIT PLAYS', 'NFL', 'Patriots -3.5 vs Jets\r\n<br>\r\nChiefs -1 vs Chargers\r\n<br>\r\nPanthers -5 vs Cowboys\r\n\r\n\r\n\r\n', 'paid', 1);
INSERT INTO `pick` VALUES (23, '2005-12-21', '3 UNIT PLAYS', 'NFL', 'Dolphins -5 vs Titans\r\n<br>\r\nFalcons +3.5 vs Buccs\r\n\r\n', 'paid', 1);
INSERT INTO `pick` VALUES (24, '2005-12-08', 'KEY GAMES - COLLEGE', 'College', 'NO COLLEGE GAMES THIS WEEKEND\r\n\r\n\r\n\r\n\r\n', 'paid', 2);
INSERT INTO `pick` VALUES (25, '2005-12-13', 'KEY GAMES - NFL', 'College', 'Patriots -4.5\r\n<br>\r\nColts -7\r\n<br>\r\nTexans +1\r\n<br>\r\nJaguars -14\r\n<br>\r\nChiefs - Giants UNDER 40\r\n<br>\r\nSeahawks -6.5\r\n<br>\r\nFalcons - Bears OVER 31\r\n<br>\r\nJets - Dolphins OVER 36 \r\n<br>\r\nCowboys +3\r\n<br>\r\nBrowns +3\r\n\r\n\r\n\r\n', 'paid', 2);
INSERT INTO `pick` VALUES (26, '2005-11-17', 'WISEGUYS TOP MOVES - NFL', 'NFL', 'Saints +9.5 vs Patriots\r\n<br>\r\nRedskins -6 vs Raiders\r\n<br>\r\nEagles +7.5 vs Giants', 'paid', 3);
INSERT INTO `pick` VALUES (28, '2005-12-28', '25 UNIT PLAY', 'College', 'Nebraska +11.5 VS Michigan', 'paid', 1);
INSERT INTO `pick` VALUES (31, '2005-11-17', 'WISEGUYS TOP MOVES - COLLEGE', 'College', 'Kansas St. -1 vs Missouri\r\n<br>\r\nNevada -9 vs Utah St.\r\n<br>\r\nUTEP -7.5 vs UAB', 'paid', 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `subscription`
-- 

CREATE TABLE `subscription` (
  `no` int(11) NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `ipn` varchar(255) NOT NULL default '',
  `user_id` varchar(255) NOT NULL default '',
  `handicapper` int(11) NOT NULL default '0',
  `type` varchar(255) NOT NULL default '',
  `expire` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`no`)
) TYPE=MyISAM AUTO_INCREMENT=47 ;

-- 
-- Dumping data for table `subscription`
-- 

INSERT INTO `subscription` VALUES (1, '2005-11-22', '', 'frely', 1, 'monthly', '2005-12-22');
INSERT INTO `subscription` VALUES (25, '0000-00-00', '', 'test', 3, 'weekly', '2006-01-01');
INSERT INTO `subscription` VALUES (24, '0000-00-00', '', 'test', 2, 'weekly', '2006-01-01');
INSERT INTO `subscription` VALUES (23, '0000-00-00', '', 'test', 1, 'weekly', '2006-01-01');
INSERT INTO `subscription` VALUES (26, '0000-00-00', '', 'test', 1, 'monthly', '2006-01-01');
INSERT INTO `subscription` VALUES (27, '0000-00-00', '', 'test', 2, 'monthly', '2006-01-01');
INSERT INTO `subscription` VALUES (28, '0000-00-00', '', 'test', 3, 'monthly', '2006-01-01');
INSERT INTO `subscription` VALUES (31, '0000-00-00', '', 'kc1102', 1, 'monthly', '2006-01-01');
INSERT INTO `subscription` VALUES (46, '0000-00-00', '', 'gregb10', 1, 'monthly', '2006-01-01');
INSERT INTO `subscription` VALUES (34, '2005-11-18', '', 'frely', 2, 'weekly', '2005-11-25');
INSERT INTO `subscription` VALUES (35, '2005-11-18', '', 'frely', 3, 'monthly', '2005-12-18');
INSERT INTO `subscription` VALUES (36, '0000-00-00', '', 'silverviper', 1, 'monthly', '2006-01-01');
INSERT INTO `subscription` VALUES (37, '2005-11-22', '', '123', 1, 'monthly', '2005-12-22');
INSERT INTO `subscription` VALUES (38, '2005-11-23', '', 'silverviper', 2, 'weekly', '2005-11-30');
INSERT INTO `subscription` VALUES (45, '0000-00-00', '', 'bpoint', 2, 'monthly', '2005-12-30');
INSERT INTO `subscription` VALUES (40, '2005-11-30', '', 'Lizard66', 2, 'weekly', '2005-12-07');
INSERT INTO `subscription` VALUES (41, '2005-12-10', '', '', 0, 'monthly', '2006-01-10');
