-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 11 Janvier 2016 à 23:47
-- Version du serveur :  5.6.17-log
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `panga_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(5),
(5);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `user_id`, `category_name`, `category_description`, `created_date`, `updated_date`) VALUES
(1, 1, 'posts', 'These are posts that are blogs related', '2014-06-22 19:00:33', '2015-11-21 16:20:00'),
(2, 1, 'news', 'These are articles containing news', '2014-06-22 19:17:17', '2015-11-13 00:59:26'),
(3, 1, 'Events', 'These are posts related to events with RHU', '2015-11-11 23:05:59', '2015-11-13 01:01:43');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_media`
--

CREATE TABLE IF NOT EXISTS `tbl_media` (
  `media_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `media_code` varchar(25) NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `media_name` varchar(250) NOT NULL,
  `media_size` int(6) NOT NULL,
  `media_type` varchar(25) NOT NULL,
  `media_ext` varchar(25) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tbl_media`
--

INSERT INTO `tbl_media` (`media_id`, `media_code`, `post_id`, `user_id`, `media_name`, `media_size`, `media_type`, `media_ext`, `created_date`, `updated_date`) VALUES
(1, '93A45D3AFD5F48A', 1, 1, 'welcome_image', 16, 'image/jpeg', '.jpg', '2015-11-21 19:03:47', '2015-11-21 18:03:47'),
(2, 'DD6ED818FE916BA', 2, 1, 'ourStaff', 37, 'image/jpeg', '.jpg', '2015-11-29 23:10:02', '2015-11-30 05:24:27'),
(3, '117E4C25BAB7A2B', 4, 1, 'AujZ4WOwps6h_DfjizOpRK-7-QE7a1qO0ejWC9iVVjGN', 197, 'image/jpeg', '.jpg', '2015-11-29 23:17:30', '2015-11-30 05:17:30'),
(4, 'A56294055C5B9E9', 3, 1, 'ourevents', 62, 'image/jpeg', '.jpg', '2015-11-29 23:22:34', '2015-11-30 05:22:34');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_post`
--

CREATE TABLE IF NOT EXISTS `tbl_post` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `post_slug` varchar(100) NOT NULL DEFAULT '',
  `post_name` varchar(250) NOT NULL,
  `post_title` varchar(250) NOT NULL,
  `post_content` text NOT NULL,
  `post_description` varchar(500) NOT NULL,
  `post_keywords` varchar(500) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `post_order` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `post_type` varchar(15) NOT NULL,
  `post_template` varchar(25) NOT NULL,
  `publication_date` date NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `user_id`, `parent_id`, `post_slug`, `post_name`, `post_title`, `post_content`, `post_description`, `post_keywords`, `is_active`, `post_order`, `category_id`, `post_type`, `post_template`, `publication_date`, `created_date`, `updated_date`) VALUES
(1, 1, 0, '', 'home ', 'About Reviving Hope Uganda', '<p>Reviving Hope Uganda is charitable, indigenous, non-for-profit youth ages from 11-30 and children months &ndash; 10 years development organization registered with the aim of empowering vulnerable groups particularly the HIV/AIDS victims, youths and orphans with knowledge, skills and support to alleviate poverty within this target group as a strategy to address one of the key factors contributing to the rapid spread of the HIV/AIDS pandemic.<br /><br />Since 2012, Reviving Hope Uganda has been joining forces with youth in different areas to prevent, create awareness and sensitize people about HIV/AIDS which we also top up with skills we try and train the youth to help alleviate poverty which as an organization we believe is one of the major causes for HIV/AIDS. To help achieve all the above, Reviving Hope Uganda has had people volunteer that is from around the villages, schools, different organizations dealing with the same area of interest and those that feel touched with our cause who help in going out there spreading the gospel about HIV/AIDS prevention and POSTIVE living to their fellow youth in different societies with the help of all our local leaders starting from our very own LC1 chairman Mr. Kijongolo to Makindye Sub-county through the office of the GISO Mr. Nsubuga to Wakiso District through the office of Mr. Ssekajili. <br /><br />Reviving Hope Uganda aims at involving the youth in the fight against HIV/AIDS, illiteracy and alleviate poverty in Uganda by talking them into being faithful, abstaining, condom use to promote behavior change by engaging them into activities such as jewelry-making, baskets,&nbsp; mat-making, liquid soap-making and candle-making hence creating awareness on issues concerning HIV/AIDS among the youth.<br /><br />Reviving Hope Uganda uses skills development for income generation, information education, community outreach, capacity building to address the given issues and so far we have covered Kawuku, Namulanda, Mpala, Bwebajja, Kitende, Lweza, Sseguku, Lubowa, Zzana, Ndejje.<br /><br />The NGO supports to develop activities to reach specific site and populations such as: the infected and affected youth, trading centers, make-shift markets, bar girls, prostitutes, areas of home and community based care support. We use training workshops, voluntary counseling,&nbsp;debates in schools and testing and other activities to help the youth take part in the socio-economic development.</p>', 'The reviving hope Uganda official website, your source for news and events about the charitable, indigenous, non-for-profit organization,', 'rhu,reviving hope uganda, NGO, Uganda, AIDS, Charity,', 1, 1, 1, 'primary_page', 'primary_page', '1901-01-30', '2015-11-21 23:59:59', '2016-01-11 22:25:55'),
(2, 1, 0, 'staff_members', 'our staff', 'staff members', '<p>Below are our amazing, flawless and special staff members who keep the candle burning.</p>', '', '', 1, 2, 1, 'primary_page', 'stuff_members_page', '2015-11-22', '2015-11-22 11:05:06', '2015-11-22 17:12:10'),
(3, 1, 0, 'events', 'Events', 'Our Events', '<p><span >These are articles&nbsp;related to events with Reviving Hope Uganda.</span></p>', '', '', 1, 3, 1, 'primary_page', 'posts_by_category_page', '0000-00-00', '2015-11-29 23:07:48', '2015-11-29 22:08:08'),
(4, 1, 3, 'world_aids_day_celebrations_02_12_2015', 'world Aids day celebrations', 'world Aids day celebrations', '<p>This year we are involving the community in the World Aids day celebrations. We will be doing something different.... THE HUMAN RIBBON. RHU together with Students of Kitende Primary School will be forming the red ribbon,a symbol worn to signify awareness and support for people living with HIV. We are fighting HIV and vowing for Zero new Infections...RHU, Getting to Zero.</p>', '', '', 1, 4, 3, 'secondary_page', 'secondary_page', '0000-00-00', '2015-11-29 23:17:15', '2015-11-30 05:25:48');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_token` varchar(20) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `avatar_icon` varchar(250) NOT NULL DEFAULT 'icon_no_avatar.png',
  `password` varchar(128) NOT NULL,
  `user_role` int(2) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_token`, `first_name`, `last_name`, `username`, `email`, `avatar_icon`, `password`, `user_role`, `created_date`, `updated_date`) VALUES
(1, '0B57A11CC148472', 'Jean-luc', 'Kasyano', 'newline', 'revivinghopeug@gmail.com', 'icon_no_avatar.png', '91562a3060a78e4c1e922e07d1e9efe952888296f14360c29d3eb566036977a4', 2, '2014-06-22 16:43:13', '2016-01-11 21:26:59'),
(2, NULL, 'ibraheem', 'saad', 'triadinc', 'a.ndayikeza@triadinc.com', 'icon_no_avatar.png', 'f33e5992d3d4a63a33ae1f2e328ab641727157a25a599a2a563427c04f3460c8', 2, '2014-06-22 16:46:18', '2014-06-23 22:44:02'),
(3, NULL, 'ngbagaro', 'lodza', 'kitsa', 'sharkey@gmail.com', 'icon_no_avatar.png', 'f33e5992d3d4a63a33ae1f2e328ab641727157a25a599a2a563427c04f3460c8', 3, '2014-08-29 02:01:51', '2014-08-29 00:01:51');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
