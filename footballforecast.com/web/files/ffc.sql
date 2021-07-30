-- phpMyAdmin SQL Dump
-- version 2.6.0-pl3
-- http://phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 29, 2005 at 07:15 AM
-- Server version: 4.1.7
-- PHP Version: 4.3.10
-- 
-- Database: `ffc`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `category`
-- 

INSERT INTO `category` VALUES (2, 'test', 'test category');
INSERT INTO `category` VALUES (3, 'Search Engine', 'SE');

-- --------------------------------------------------------

-- 
-- Table structure for table `link`
-- 

CREATE TABLE `link` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `link`
-- 

INSERT INTO `link` VALUES (2, 'test', 'test category');
INSERT INTO `link` VALUES (3, 'Search Engine', 'SE');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `movie`
-- 

INSERT INTO `movie` VALUES (1, 'Jet', 'Jet live', 'multimedia/nfl.asf', 'new');
INSERT INTO `movie` VALUES (2, 'test', 'test arcihve', 'multimedia/goal.jpg', 'archive');

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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `pick`
-- 

INSERT INTO `pick` VALUES (1, 0x323030352d30372d3238, 'Man United -3 vs Arsenal', 'NCAA', 'Manchester United forever!!!', 'paid');
INSERT INTO `pick` VALUES (2, 0x323030352d30372d3238, 'Man United -2 vs Chelsea', 'NFL', 'Simply United....', 'free');
INSERT INTO `pick` VALUES (3, 0x323030352d30372d3238, 'Arsenal +1 vs Chelsea', 'NCAA', 'just believe in me please...', 'free');
INSERT INTO `pick` VALUES (4, 0x323030352d30372d3238, 'Chelsea +1 vs. Man United', 'NCAA', 'heheheh\r\nakhirnya dapet jugakk', 'paid');
