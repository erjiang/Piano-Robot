-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 06, 2010 at 05:43 PM
-- Server version: 5.0.90
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aztekera_music`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `creator` varchar(255) default NULL,
  `edition` varchar(255) default NULL,
  `filename` varchar(255) NOT NULL,
  `length` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `access` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `search_index` (`title`,`creator`,`edition`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `book_metadata`
--

CREATE TABLE IF NOT EXISTS `book_metadata` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `type` enum('boolean','int','decimal','string') NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pieces`
--

CREATE TABLE IF NOT EXISTS `pieces` (
  `id` int(11) NOT NULL auto_increment,
  `book_id` int(11) default NULL,
  `title` varchar(255) NOT NULL,
  `composer` varchar(255) default NULL,
  `description` text,
  `length` int(11) NOT NULL,
  `start` int(11) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `title` (`title`,`composer`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `piece_metadata`
--

CREATE TABLE IF NOT EXISTS `piece_metadata` (
  `id` int(11) NOT NULL,
  `piece_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `type` enum('boolean','int','decimal','string') NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `type` enum('boolean','int','decimal','string') NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
