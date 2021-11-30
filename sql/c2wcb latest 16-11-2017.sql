-- --------------------------------------------------------
-- Host:                         139.162.27.141
-- Server version:               5.7.18-0ubuntu0.16.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for c2wcb_db
CREATE DATABASE IF NOT EXISTS `c2wcb_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `c2wcb_db`;


-- Dumping structure for table c2wcb_db.cached_contacts
CREATE TABLE IF NOT EXISTS `cached_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL DEFAULT '0',
  `company` varchar(255) NOT NULL DEFAULT '0',
  `office_id` int(10) unsigned NOT NULL DEFAULT '0',
  `office` varchar(255) NOT NULL DEFAULT '0',
  `primary_contact_name` varchar(255) NOT NULL DEFAULT '0',
  `primary_contact_email` varchar(255) NOT NULL DEFAULT '0',
  `primary_contact_phone` varchar(255) NOT NULL DEFAULT '0',
  `secondary_contact_name` varchar(255) NOT NULL DEFAULT '0',
  `secondary_contact_email` varchar(255) NOT NULL DEFAULT '0',
  `secondary_contact_phone` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__companies` (`company_id`),
  KEY `FK__offices` (`office_id`),
  CONSTRAINT `FK__companies` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `FK__offices` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table c2wcb_db.cached_contacts: ~0 rows (approximately)
/*!40000 ALTER TABLE `cached_contacts` DISABLE KEYS */;
INSERT INTO `cached_contacts` (`id`, `company_id`, `company`, `office_id`, `office`, `primary_contact_name`, `primary_contact_email`, `primary_contact_phone`, `secondary_contact_name`, `secondary_contact_email`, `secondary_contact_phone`) VALUES
	(1, 1, 'Cenveo Solutions', 1, 'Head Office', 'Arjun Ghosh', 'arjun@cenveo.com', '1234567823', 'Samitha Nair', 'samitha@cenveo.com', '2343123456');
/*!40000 ALTER TABLE `cached_contacts` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.candidates
CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expected_ctc` int(10) unsigned DEFAULT NULL,
  `preferred_city` tinytext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  `first_job_start_date` date DEFAULT NULL,
  `highest_qualification_level` tinytext COLLATE utf8_unicode_ci COMMENT 'data from master',
  `highest_qualification` tinytext COLLATE utf8_unicode_ci COMMENT 'data from master',
  `head_line` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `experience_years` tinyint(4) DEFAULT NULL,
  `experience_months` tinyint(4) DEFAULT NULL,
  `current_ctc` int(10) unsigned DEFAULT NULL,
  `can_relocate` tinyint(4) DEFAULT NULL,
  `current_employer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_city` mediumtext COLLATE utf8_unicode_ci COMMENT 'data from master',
  `source` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'data from master',
  `category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creator_id` int(10) unsigned DEFAULT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci,
  `country_id` int(10) unsigned DEFAULT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `postal_code` tinytext COLLATE utf8_unicode_ci COMMENT 'data from master',
  `primary_email` tinytext COLLATE utf8_unicode_ci,
  `secondary_email` tinytext COLLATE utf8_unicode_ci,
  `primary_phone` tinytext COLLATE utf8_unicode_ci,
  `secondary_phone` tinytext COLLATE utf8_unicode_ci,
  `photo_url` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `candidates_creator_id_foreign` (`creator_id`),
  CONSTRAINT `candidates_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `cms_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.candidates: ~9 rows (approximately)
/*!40000 ALTER TABLE `candidates` DISABLE KEYS */;
INSERT INTO `candidates` (`id`, `first_name`, `last_name`, `birth_date`, `gender`, `religion`, `expected_ctc`, `preferred_city`, `first_job_start_date`, `highest_qualification_level`, `highest_qualification`, `head_line`, `status`, `created_at`, `updated_at`, `experience_years`, `experience_months`, `current_ctc`, `can_relocate`, `current_employer`, `current_designation`, `current_city`, `source`, `category`, `creator_id`, `address`, `country_id`, `state_id`, `city_id`, `postal_code`, `primary_email`, `secondary_email`, `primary_phone`, `secondary_phone`, `photo_url`) VALUES
	(1, 'Raghav', 'Ram', '1994-02-28', 'Male', 'Hindu', 12, '1', '2017-09-04', '1', '1', 'Test', 1, '2017-09-26 10:47:52', '2017-10-06 06:49:01', 0, NULL, 15, 1, 'Test', 'Test', '1', '1', 'General', 1, 'Raghav Mandir', 1, 1, 1, '695001', 'sid@mail.com', NULL, '7896541230', NULL, NULL),
	(2, 'Madhav', 'M', '2017-09-18', 'Male', 'Hindu', 12, '1', '2017-09-25', '2', '3', 'A young talented art designer', 1, '2017-09-26 11:16:49', '2017-10-06 06:52:00', 1, 2, 12, 1, 'Test', 'Test', '1', '1', 'General', 1, 'Madhav Mahal', 2, 2, 2, '695001', 'madhav@mail.com', NULL, '7845123690', NULL, NULL),
	(3, 'Raj', 'Kumar', '2017-06-05', 'Male', 'Hindu', 12, '1', '2017-01-02', '2', '2', 'Test', NULL, '2017-09-27 12:30:11', '2017-10-06 08:29:25', 16, 6, 18, 0, 'Test', 'Test', '1', '1', 'General', 1, 'Raj Mandir', 1, 1, 1, '695001', 'siddhimail@mail.com', NULL, '1456321789', NULL, NULL),
	(4, 'Siddhi', 'Vinayak', '1994-02-14', 'Male', 'Hindu', 18, '1', '2016-06-13', '2', '2', 'PHP Developer', 1, '2017-09-28 12:20:58', '2017-10-06 06:55:14', 1, 2, 14, 1, 'STS', 'Developer', '1', '1', 'General', NULL, 'Ayappa Building', 1, 1, 1, '695001', 'siddhi@mail.com', 'sdasds@mail.com', '8891915726', '798956210', 'uploads/1/2017-10/w3logo.jpg'),
	(5, 'Arun', 'Mohan', '1994-06-05', 'male', 'HIndu', 2, '1', NULL, '1', '1', 'Python Developer', NULL, '2017-09-29 10:41:28', NULL, 0, 10, 12, 1, 'UST', 'Tester', '1', '1', 'General', NULL, 'Aruna Bhavan', 1, 1, 1, '695001', 'arun@mail.com', NULL, '456178932', NULL, 'uploads/1/2017-09/w3logo.jpg'),
	(6, 'Vijayakrishnan', 'Krishnan', '1992-07-16', 'male', 'Hindu', 20, '1', '2009-06-24', '2', '2', 'Full stack develop - MEAN stack', NULL, '2017-10-02 10:08:44', NULL, 8, 2, 18, 1, NULL, NULL, '1', '1', NULL, NULL, 'Sarang, TC 8/1504(1), Thirumala', 1, 1, 1, '695001', 'vjeleven@gmail.com', 'vjeleven@gmail.com', '9895506686', NULL, NULL),
	(7, 'Aravind', 'Krishna', '1994-08-30', 'Male', 'HIndu1', 16, '1', '2017-10-09', '1', '1', 'Customer Care Executive', NULL, '2017-10-04 06:19:16', '2017-10-04 07:14:42', 0, 2, 16, 1, 'Allianz', 'Claims Executive', '1', '1', 'General', NULL, 'Aravinda Bhavan, Venganoor', 1, 1, 1, '695531', 'aravind@mail.com', NULL, '7214563987', NULL, 'uploads/1/2017-10/women_hairstyling.png'),
	(8, 'Rahul', 'Varma', '1998-02-13', 'Male', 'Hindu', 12, '1', '2016-06-13', '2', '2', 'A young talented web developer', NULL, '2017-10-06 04:36:46', NULL, 1, 1, 12, 1, 'Spericorn', 'Developer', '1', '1', 'General', NULL, 'Neelanjanam, Palode,', 1, 1, 1, '695001', 'rahul@mail.com', NULL, '859630147', NULL, 'uploads/1/2017-10/email_express_mail_512.png'),
	(9, 'Abhiraj', 'Parameswaran', '1994-05-23', 'Male', 'Hindu', 12, '1', NULL, '2', '2', 'A Fresher With Basic Programming knowledge', NULL, '2017-10-06 04:57:50', '2017-10-06 05:10:50', NULL, NULL, 1, 1, NULL, NULL, '1', '1', 'General', NULL, 'Neelanjanam, Palode', 1, 1, 1, '695001', 'abhiraj@mail.com', NULL, '849632157', NULL, 'uploads/1/2017-10/w3logo.jpg'),
	(10, 'Vishnu Edit', 'Narayanan Edit', '2017-11-13', 'Male', 'HIndu Edit', 40, '2', '2016-09-13', '1', '1', 'A mechanical engineer with basic programming knowledge Edit', NULL, '2017-10-09 04:54:18', '2017-10-09 07:41:03', 2, 1, 36, 1, 'Tata Ellexsi Edit', 'Tester Edit', '2', '1', 'General', NULL, 'Narayana bhavan, Neeramankrara, pappanamcode edit', 2, 2, 2, '695001', 'narayanedit@mail.com', NULL, '98654751230', NULL, NULL),
	(11, 'Mubashira', 'Anas', '1994-11-17', 'Female', 'Muslim', 17, '1', '2016-05-16', '2', '2', 'A web designer with basic php knowledge.', NULL, '2017-10-09 07:55:44', '2017-10-20 02:33:59', 1, 2, 16, 1, 'Abyssis', 'Designer', '2', '1', 'General', NULL, 'Anas Mahal, Attingal.', 1, 1, 1, '695001', 'mubi@mail.com', NULL, '965874123', NULL, 'uploads/1/2017-10/candidate_dafault.png');
/*!40000 ALTER TABLE `candidates` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.candidate_general_skills
CREATE TABLE IF NOT EXISTS `candidate_general_skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `general_skill` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  PRIMARY KEY (`id`),
  KEY `candidate_general_skills_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `candidate_general_skills_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.candidate_general_skills: ~6 rows (approximately)
/*!40000 ALTER TABLE `candidate_general_skills` DISABLE KEYS */;
INSERT INTO `candidate_general_skills` (`id`, `candidate_id`, `general_skill`) VALUES
	(2, 5, 'Positive Attitude'),
	(3, 7, 'Team Work'),
	(4, 7, 'Positive Attitude'),
	(5, 8, 'Solid Communication'),
	(6, 10, 'Solid Communication'),
	(7, 11, 'Team Work');
/*!40000 ALTER TABLE `candidate_general_skills` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.candidate_industries
CREATE TABLE IF NOT EXISTS `candidate_industries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `industry` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  PRIMARY KEY (`id`),
  KEY `candidate_industries_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `candidate_industries_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.candidate_industries: ~9 rows (approximately)
/*!40000 ALTER TABLE `candidate_industries` DISABLE KEYS */;
INSERT INTO `candidate_industries` (`id`, `candidate_id`, `industry`) VALUES
	(2, 5, 'BPO'),
	(3, 7, 'BPO'),
	(4, 7, 'IT'),
	(5, 7, 'Accounting/Finance'),
	(6, 4, 'Entertainment/ Media/ Publishing'),
	(7, 4, 'Teacher'),
	(8, 8, 'Bio Technology & Life Sciences'),
	(9, 10, 'IT');
/*!40000 ALTER TABLE `candidate_industries` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.candidate_industry_functional_areas
CREATE TABLE IF NOT EXISTS `candidate_industry_functional_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `industry_functional_area` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  PRIMARY KEY (`id`),
  KEY `candidate_industry_functional_areas_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `candidate_industry_functional_areas_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.candidate_industry_functional_areas: ~3 rows (approximately)
/*!40000 ALTER TABLE `candidate_industry_functional_areas` DISABLE KEYS */;
INSERT INTO `candidate_industry_functional_areas` (`id`, `candidate_id`, `industry_functional_area`) VALUES
	(4, 7, 'Software'),
	(5, 8, 'Accounting'),
	(6, 10, 'Automobile Developing');
/*!40000 ALTER TABLE `candidate_industry_functional_areas` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.candidate_industry_functional_area_roles
CREATE TABLE IF NOT EXISTS `candidate_industry_functional_area_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `role` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_industry_roles_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `candidate_industry_roles_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.candidate_industry_functional_area_roles: ~4 rows (approximately)
/*!40000 ALTER TABLE `candidate_industry_functional_area_roles` DISABLE KEYS */;
INSERT INTO `candidate_industry_functional_area_roles` (`id`, `candidate_id`, `role`, `created_at`, `updated_at`) VALUES
	(3, 5, 'PHP Developer', '2017-10-04 06:36:55', '2017-10-04 06:41:52'),
	(4, 7, 'PHP Developer', '2017-10-04 08:53:33', NULL),
	(6, 10, 'PHP Developer', '2017-10-09 05:46:28', '2017-10-09 05:51:12'),
	(8, 8, 'Accountant', '2017-10-09 09:25:45', NULL);
/*!40000 ALTER TABLE `candidate_industry_functional_area_roles` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.candidate_industry_functional_area_skills
CREATE TABLE IF NOT EXISTS `candidate_industry_functional_area_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `industry_functional_area_skill` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  `experience_years` tinyint(4) DEFAULT NULL,
  `experience_months` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_industry_functional_area_skills_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `candidate_industry_functional_area_skills_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.candidate_industry_functional_area_skills: ~7 rows (approximately)
/*!40000 ALTER TABLE `candidate_industry_functional_area_skills` DISABLE KEYS */;
INSERT INTO `candidate_industry_functional_area_skills` (`id`, `candidate_id`, `industry_functional_area_skill`, `experience_years`, `experience_months`) VALUES
	(1, 1, 'PHP', 3, 2),
	(3, 5, 'PHP', 0, 2),
	(5, 7, 'PHP', 2, 3),
	(6, 4, 'PHP', 0, 7),
	(7, 8, 'Tally ERP', 1, 2),
	(8, 9, 'PHP', 0, 2),
	(9, 10, 'Automobile Test', 1, 2);
/*!40000 ALTER TABLE `candidate_industry_functional_area_skills` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.candidate_notes
CREATE TABLE IF NOT EXISTS `candidate_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_notes_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `candidate_notes_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.candidate_notes: ~4 rows (approximately)
/*!40000 ALTER TABLE `candidate_notes` DISABLE KEYS */;
INSERT INTO `candidate_notes` (`id`, `candidate_id`, `note`) VALUES
	(2, 5, 'Python testing in mother board of intel'),
	(3, 7, 'Customer Relations Manager at allianz'),
	(4, 8, 'Have an international driving license'),
	(5, 10, 'Edit in note for narayanan.');
/*!40000 ALTER TABLE `candidate_notes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.candidate_qualifications
CREATE TABLE IF NOT EXISTS `candidate_qualifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `is_completed` tinyint(1) NOT NULL,
  `completed_year` int(11) DEFAULT NULL,
  `score` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qualification` mediumtext COLLATE utf8_unicode_ci COMMENT 'data from master',
  `qualification_level` mediumtext COLLATE utf8_unicode_ci COMMENT 'data from master',
  PRIMARY KEY (`id`),
  KEY `candidate_qualifications_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `candidate_qualifications_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.candidate_qualifications: ~4 rows (approximately)
/*!40000 ALTER TABLE `candidate_qualifications` DISABLE KEYS */;
INSERT INTO `candidate_qualifications` (`id`, `candidate_id`, `is_completed`, `completed_year`, `score`, `created_at`, `updated_at`, `qualification`, `qualification_level`) VALUES
	(2, 5, 1, 2016, '500', '2017-09-29 10:48:20', '2017-10-04 06:35:13', 'Btech', 'Graduate'),
	(3, 7, 1, 2016, '450', '2017-10-04 06:24:16', NULL, 'Mtech', 'Post Graduate'),
	(4, 8, 1, 2016, '350', '2017-10-06 05:43:07', '2017-10-06 05:44:32', 'Btech', 'Graduate'),
	(5, 4, 1, 2016, '450', '2017-10-06 06:57:17', '2017-10-06 06:57:53', 'Btech', 'Graduate'),
	(6, 10, 0, 2018, '600', '2017-10-09 05:35:26', '2017-10-09 05:36:13', 'Mtech', 'Post Graduate');
/*!40000 ALTER TABLE `candidate_qualifications` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.candidate_resumes
CREATE TABLE IF NOT EXISTS `candidate_resumes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned DEFAULT NULL,
  `resume_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_resumes_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `candidate_resumes_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.candidate_resumes: ~4 rows (approximately)
/*!40000 ALTER TABLE `candidate_resumes` DISABLE KEYS */;
INSERT INTO `candidate_resumes` (`id`, `candidate_id`, `resume_url`, `status`, `created_at`, `updated_at`) VALUES
	(2, 5, 'uploads/1/2017-10/08_sreejith.docx', NULL, '2017-09-29 10:49:05', '2017-10-04 06:40:02'),
	(3, 7, 'uploads/1/2017-10/316.docx', NULL, '2017-10-04 06:25:51', NULL),
	(4, 8, 'uploads/1/2017-10/aa.doc', NULL, '2017-10-06 11:43:37', NULL),
	(5, 10, 'uploads/1/2017-10/316.docx', NULL, '2017-10-09 05:28:02', '2017-10-09 05:30:40');
/*!40000 ALTER TABLE `candidate_resumes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_country_id_foreign` (`country_id`),
  KEY `cities_state_id_foreign` (`state_id`),
  CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.cities: ~2 rows (approximately)
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`id`, `country_id`, `state_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Trivandrum', NULL, '2017-09-26 10:09:31', NULL),
	(2, 2, 2, 'Islamabad City', NULL, '2017-09-27 12:41:06', NULL),
	(3, 3, 3, 'Colombo', NULL, '2017-10-09 09:46:56', NULL);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_apicustom
CREATE TABLE IF NOT EXISTS `cms_apicustom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permalink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_query_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sql_where` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` longtext COLLATE utf8mb4_unicode_ci,
  `responses` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_apicustom: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_apicustom` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_apicustom` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_apikey
CREATE TABLE IF NOT EXISTS `cms_apikey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `screetkey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_apikey: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_apikey` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_apikey` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_dashboard
CREATE TABLE IF NOT EXISTS `cms_dashboard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_dashboard: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_dashboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_dashboard` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_email_queues
CREATE TABLE IF NOT EXISTS `cms_email_queues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `send_at` datetime DEFAULT NULL,
  `email_recipient` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_cc_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_content` text COLLATE utf8mb4_unicode_ci,
  `email_attachments` text COLLATE utf8mb4_unicode_ci,
  `is_sent` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_email_queues: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_email_queues` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_email_queues` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_email_templates
CREATE TABLE IF NOT EXISTS `cms_email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_email_templates: ~2 rows (approximately)
/*!40000 ALTER TABLE `cms_email_templates` DISABLE KEYS */;
INSERT INTO `cms_email_templates` (`id`, `name`, `slug`, `subject`, `content`, `description`, `from_name`, `from_email`, `cc_email`, `created_at`, `updated_at`) VALUES
	(1, 'Email Template Forgot Password Backend', 'forgot_password_backend', NULL, '<p>Hi,</p><p>Someone requested forgot password, here is your new password : </p><p>[password]</p><p><br></p><p>--</p><p>Regards,</p><p>Admin</p>', '[password]', 'System', 'system@crudbooster.com', NULL, '2017-09-26 07:32:55', NULL),
	(2, 'Submit Resume', 'submit_resume', 'Potential candidate for your job order', '<p>Dear [contact_name],</p><p>Please find attached the resume of [candidate_name], whom we believe is a good match for your requirements.</p><p>Thank You,<br>[your_name],<br>Connecting2Work HR Solutions</p>', 'submit-resume', 'Connecting2Work HR Solutions', 'info@connecting2work.com', NULL, '2017-10-02 13:57:44', '2017-10-02 14:00:39');
/*!40000 ALTER TABLE `cms_email_templates` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_logs
CREATE TABLE IF NOT EXISTS `cms_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `useragent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `id_cms_users` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=614 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_logs: ~515 rows (approximately)
/*!40000 ALTER TABLE `cms_logs` DISABLE KEYS */;
INSERT INTO `cms_logs` (`id`, `ipaddress`, `useragent`, `url`, `description`, `details`, `id_cms_users`, `created_at`, `updated_at`) VALUES
	(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-26 07:33:49', NULL),
	(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-26 09:35:11', NULL),
	(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/countries/add-save', 'Add New Data India at Countries', '', 1, '2017-09-26 09:58:54', NULL),
	(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/states/add-save', 'Add New Data Kerala at States', '', 1, '2017-09-26 10:01:14', NULL),
	(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/countries/add-save', 'Add New Data Pakistan at Countries', '', 1, '2017-09-26 10:01:37', NULL),
	(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/cities/add-save', 'Add New Data Trivandrum at Cities', '', 1, '2017-09-26 10:09:31', NULL),
	(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/add-save', 'Add New Data Sid at Candidates', '', 1, '2017-09-26 10:47:52', NULL),
	(8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/delete/1', 'Delete data Sid at Candidates', '', 1, '2017-09-26 10:49:34', NULL),
	(9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/add-save', 'Add New Data Siddhi at Candidates', '', 1, '2017-09-26 11:16:49', NULL),
	(10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/delete/3', 'Delete data Address at Menu Management', '', 1, '2017-09-26 11:25:05', NULL),
	(11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/addresses/add-save', 'Add New Data 1 at Address', '', 1, '2017-09-26 11:27:24', NULL),
	(12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_emails/add-save', 'Add New Data 1 at emails', '', 1, '2017-09-26 12:11:55', NULL),
	(13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-27 04:29:09', NULL),
	(14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://local.c2wcb.com/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-27 05:28:31', NULL),
	(15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/add-save', 'Add New Data IT at Industries', '', 1, '2017-09-27 06:08:15', NULL),
	(16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Hardware at Industry Functional Areas', '', 1, '2017-09-27 06:33:56', NULL),
	(17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://local.c2wcb.com/admin/companies/add-save', 'Add New Data Cenveo Solutions at Companies', '', 1, '2017-09-27 06:36:53', NULL),
	(18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Software at Industry Functional Areas', '', 1, '2017-09-27 06:55:25', NULL),
	(19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data PHP at Industry Functional Area Skills', '', 1, '2017-09-27 06:56:35', NULL),
	(20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/module_generator/delete/25', 'Delete data Inddustry Role at Module Generator', '', 1, '2017-09-27 07:05:04', NULL),
	(21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://local.c2wcb.com/admin/offices/add-save', 'Add New Data Head Office at Offices', '', 1, '2017-09-27 07:18:41', NULL),
	(22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/module_generator/delete/24', 'Delete data Industry Roles at Module Generator', '', 1, '2017-09-27 07:19:02', NULL),
	(23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/delete/6', 'Delete data CandidateIndustries at Menu Management', '', 1, '2017-09-27 07:43:58', NULL),
	(24, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://local.c2wcb.com/admin/offices/edit-save/1', 'Update data Head Office at Offices', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>country_id</td><td></td><td>1</td></tr><tr><td>state_id</td><td></td><td>1</td></tr><tr><td>city_id</td><td></td><td>1</td></tr><tr><td>postal_code</td><td></td><td>695001</td></tr><tr><td>deleted_at</td><td></td><td></td></tr></tbody></table>', 1, '2017-09-27 08:00:30', NULL),
	(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://local.c2wcb.com/admin/offices/edit-save/1', 'Update data Head Office at Offices', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>address</td><td>Statue, SreeVilas lane</td><td>Statue Jn.</td></tr><tr><td>deleted_at</td><td></td><td></td></tr></tbody></table>', 1, '2017-09-27 08:05:07', NULL),
	(26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://local.c2wcb.com/admin/contacts/add-save', 'Add New Data Neena at Contacts', '', 1, '2017-09-27 09:22:39', NULL),
	(27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://local.c2wcb.com/admin/contacts/add-save', 'Add New Data Rheyan at Contacts', '', 1, '2017-09-27 09:26:55', NULL),
	(28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'admin@crudbooster.com logout', '', 1, '2017-09-27 10:36:23', NULL),
	(29, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/add-save', 'Add New Data Raj at Candidates', '', 1, '2017-09-27 12:30:11', NULL),
	(30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/addresses/add-save', 'Add New Data 3 at Address', '', 1, '2017-09-27 12:30:34', NULL),
	(31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/states/add-save', 'Add New Data Islamabad at States', '', 1, '2017-09-27 12:36:50', NULL),
	(32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/states/edit-save/2', 'Update data Islamabad at States', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>country_id</td><td>1</td><td>2</td></tr><tr><td>status</td><td></td><td></td></tr><tr><td>deleted_at</td><td></td><td></td></tr></tbody></table>', 1, '2017-09-27 12:38:13', NULL),
	(33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/states/edit-save/2', 'Update data Islamabad at States', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>status</td><td></td><td></td></tr><tr><td>deleted_at</td><td></td><td></td></tr></tbody></table>', 1, '2017-09-27 12:39:15', NULL),
	(34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/cities/add-save', 'Add New Data Islamabad City at Cities', '', 1, '2017-09-27 12:41:06', NULL),
	(35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-28 05:00:27', NULL),
	(36, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-28 05:28:33', NULL),
	(37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/contact_emails/add-save', 'Add New Data 1 at Contact Emails', '', 1, '2017-09-28 05:50:55', NULL),
	(38, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/edit-save/1', 'Update data  at CandidateFunctionalAreas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area_id</td><td>1</td><td>2</td></tr></tbody></table>', 1, '2017-09-28 05:51:51', NULL),
	(39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/edit-save/1', 'Update data  at CandidateFunctionalAreas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>candidate_id</td><td>2</td><td></td></tr><tr><td>industry_functional_area_id</td><td>2</td><td>1</td></tr></tbody></table>', 1, '2017-09-28 05:53:27', NULL),
	(40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/delete/1', 'Delete data 1 at CandidateIndustries', '', 1, '2017-09-28 06:05:07', NULL),
	(41, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/office_industries/add-save', 'Add New Data 1 at Office Industries', '', 1, '2017-09-28 06:20:38', NULL),
	(42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/industries/add-save', 'Add New Data Insurance at Industries', '', 1, '2017-09-28 06:22:23', NULL),
	(43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/industries/add-save', 'Add New Data Agriculture/ Dairy Based at Industries', '', 1, '2017-09-28 06:22:47', NULL),
	(44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 1 at CandidateIndustries', '', 1, '2017-09-28 06:23:08', NULL),
	(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/delete/1', 'Delete data 1 at CandidateFunctionalAreas', '', 1, '2017-09-28 06:23:33', NULL),
	(46, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/delete/1', 'Delete data  at CandidateFunctionalAreas', '', 1, '2017-09-28 06:23:34', NULL),
	(47, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/offices/add-save', 'Add New Data Development Center at Offices', '', 1, '2017-09-28 06:23:34', NULL),
	(48, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/contacts/add-save', 'Add New Data Rishitha at Contacts', '', 1, '2017-09-28 06:24:10', NULL),
	(49, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/office_industries/add-save', 'Add New Data 2 at Office Industries', '', 1, '2017-09-28 06:24:40', NULL),
	(50, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/add-save', 'Add New Data 1 at CandidateFunctionalAreas', '', 1, '2017-09-28 06:26:02', NULL),
	(51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 1 at CandidateFunctionalAreaSkills', '', 1, '2017-09-28 06:26:50', NULL),
	(52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/office_industries/edit-save/2', 'Update data  at Office Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody></tbody></table>', 1, '2017-09-28 06:27:39', NULL),
	(53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/office_industries/add-save', 'Add New Data 3 at Office Industries', '', 1, '2017-09-28 06:28:45', NULL),
	(54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/contacts/add-save', 'Add New Data Rashi at Contacts', '', 1, '2017-09-28 06:29:52', NULL),
	(55, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/contact_emails/add-save', 'Add New Data 2 at Contact Emails', '', 1, '2017-09-28 06:30:14', NULL),
	(56, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/contact_emails/edit-save/2', 'Update data  at Contact Emails', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>emails</td><td>rashi@mail.com</td><td>rashi1@mail.com</td></tr></tbody></table>', 1, '2017-09-28 06:30:58', NULL),
	(57, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/module_generator/delete/33', 'Delete data CandidateQualifications at Module Generator', '', 1, '2017-09-28 06:39:26', NULL),
	(58, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/module_generator/delete/34', 'Delete data Industry Functional AreaRoles at Module Generator', '', 1, '2017-09-28 06:55:23', NULL),
	(59, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-28 09:40:55', NULL),
	(60, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/module_generator/delete/15', 'Delete data Candidates at Module Generator', '', 1, '2017-09-28 09:41:30', NULL),
	(61, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/16', 'Delete data Address at Module Generator', '', 1, '2017-09-28 10:01:43', NULL),
	(62, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/28', 'Delete data CandidateFunctionalAreas at Module Generator', '', 1, '2017-09-28 10:02:10', NULL),
	(63, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/30', 'Delete data CandidateFunctionalAreaSkills at Module Generator', '', 1, '2017-09-28 10:02:15', NULL),
	(64, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/26', 'Delete data CandidateIndustries at Module Generator', '', 1, '2017-09-28 10:02:25', NULL),
	(65, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/29', 'Delete data Contact Emails at Module Generator', '', 1, '2017-09-28 10:02:31', NULL),
	(66, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/32', 'Delete data Contact Phone Numbers at Module Generator', '', 1, '2017-09-28 10:02:38', NULL),
	(67, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/27', 'Delete data Contacts at Module Generator', '', 1, '2017-09-28 10:02:43', NULL),
	(68, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/17', 'Delete data emails at Module Generator', '', 1, '2017-09-28 10:02:48', NULL),
	(69, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/19', 'Delete data Companies at Module Generator', '', 1, '2017-09-28 10:02:53', NULL),
	(70, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/23', 'Delete data Offices at Module Generator', '', 1, '2017-09-28 10:03:06', NULL),
	(71, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/18', 'Delete data Job Orders at Module Generator', '', 1, '2017-09-28 10:03:11', NULL),
	(72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/31', 'Delete data Office Industries at Module Generator', '', 1, '2017-09-28 10:03:17', NULL),
	(73, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/35', 'Delete data IndustryFunctionalAreaRoles at Module Generator', '', 1, '2017-09-28 10:03:23', NULL),
	(74, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/21', 'Delete data Industry Functional Areas at Module Generator', '', 1, '2017-09-28 10:03:29', NULL),
	(75, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/module_generator/delete/22', 'Delete data Industry Functional Area Skills at Module Generator', '', 1, '2017-09-28 10:03:36', NULL),
	(76, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/postal_codes/add-save', 'Add New Data 695001 at Postal Codes', '', 1, '2017-09-28 10:40:32', NULL),
	(77, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/sources/add-save', 'Add New Data Google at Sources', '', 1, '2017-09-28 10:42:56', NULL),
	(78, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/delete/10', 'Delete data FunctionalAreas at Menu Management', '', 1, '2017-09-28 10:43:03', NULL),
	(79, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/menu_management/edit-save/11', 'Update data Sources Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>Sources</td><td>Sources Master</td></tr><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>8</td><td></td></tr></tbody></table>', 1, '2017-09-28 10:48:14', NULL),
	(80, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Human Resource at Industry Functional Areas', '', 1, '2017-09-28 10:48:27', NULL),
	(81, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/menu_management/edit-save/9', 'Update data Postal Codes Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>Postal Codes</td><td>Postal Codes Master</td></tr><tr><td>type</td><td>Route</td><td>Module</td></tr><tr><td>path</td><td>AdminPostalCodesControllerGetIndex</td><td>postal_codes</td></tr><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>6</td><td></td></tr></tbody></table>', 1, '2017-09-28 10:49:45', NULL),
	(82, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/menu_management/edit-save/11', 'Update data Sources Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>type</td><td>Route</td><td>Module</td></tr><tr><td>path</td><td>AdminSourcesControllerGetIndex</td><td>sources</td></tr><tr><td>sorting</td><td>8</td><td></td></tr></tbody></table>', 1, '2017-09-28 10:50:46', NULL),
	(83, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/5', 'Update data Industries Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>Industries</td><td>Industries Master</td></tr><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>5</td><td></td></tr></tbody></table>', 1, '2017-09-28 10:53:06', NULL),
	(84, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/menu_management/edit-save/12', 'Update data General Skills Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>General Skills</td><td>General Skills Master</td></tr><tr><td>type</td><td>Route</td><td>Module</td></tr><tr><td>path</td><td>AdminGeneralSkillsControllerGetIndex</td><td>general_skills</td></tr><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>9</td><td></td></tr></tbody></table>', 1, '2017-09-28 10:53:41', NULL),
	(85, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/general_skills/add-save', 'Add New Data Positive Attitude at General Skills', '', 1, '2017-09-28 10:54:11', NULL),
	(86, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/general_skills/add-save', 'Add New Data Team Work at General Skills', '', 1, '2017-09-28 10:54:23', NULL),
	(87, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data JAVA at Industry Functional Area Skills', '', 1, '2017-09-28 10:58:14', NULL),
	(88, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/general_skill_notes/add-save', 'Add New Data 1 at General Skill Note', '', 1, '2017-09-28 10:58:42', NULL),
	(89, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/general_skill_notes/add-save', 'Add New Data 2 at General Skill Note', '', 1, '2017-09-28 10:59:41', NULL),
	(90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/delete/1', 'Delete data PHP at Industry Functional Area Skills', '', 1, '2017-09-28 11:01:43', NULL),
	(91, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/general_skill_notes/add-save', 'Add New Data 3 at General Skill Note', '', 1, '2017-09-28 11:01:49', NULL),
	(92, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data PHP at Industry Functional Area Skills', '', 1, '2017-09-28 11:02:11', NULL),
	(93, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/general_skill_notes/add-save', 'Add New Data 4 at General Skill Note', '', 1, '2017-09-28 11:02:23', NULL),
	(94, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/general_skill_notes/add-save', 'Add New Data 5 at General Skill Note', '', 1, '2017-09-28 11:02:49', NULL),
	(95, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/delete/2', 'Delete data JAVA at Industry Functional Area Skills', '', 1, '2017-09-28 11:02:54', NULL),
	(96, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/delete/3', 'Delete data PHP at Industry Functional Area Skills', '', 1, '2017-09-28 11:02:58', NULL),
	(97, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/general_skill_notes/edit-save/5', 'Update data  at General Skill Note', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>note</td><td>Importance to Team members points</td><td>Importance to Team members view points</td></tr></tbody></table>', 1, '2017-09-28 11:03:27', NULL),
	(98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data PHP at Industry Functional Area Skills', '', 1, '2017-09-28 11:04:50', NULL),
	(99, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/add-save', 'Add New Data Accounting at Industries', '', 1, '2017-09-28 11:07:39', NULL),
	(100, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Accounting at Industry Functional Areas', '', 1, '2017-09-28 11:08:13', NULL),
	(101, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data Accounts at Industry Functional Area Skills', '', 1, '2017-09-28 11:10:07', NULL),
	(102, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/delete/13', 'Delete data IndustryFunctionalAreaSkillNotes at Menu Management', '', 1, '2017-09-28 11:17:32', NULL),
	(103, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 1 at IndustryFunctionalAreaSkillNotes', '', 1, '2017-09-28 11:21:21', NULL),
	(104, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data JAVA at Industry Functional Area Skills', '', 1, '2017-09-28 11:23:10', NULL),
	(105, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data Human Resource at Industry Functional Area Skills', '', 1, '2017-09-28 11:26:09', NULL),
	(106, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/add-save', 'Add New Data IT at Industries', '', 1, '2017-09-28 11:27:54', NULL),
	(107, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Software at Industry Functional Areas', '', 1, '2017-09-28 11:28:24', NULL),
	(108, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data PHP at Industry Functional Area Skills', '', 1, '2017-09-28 11:28:54', NULL),
	(109, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 1 at IndustryFunctionalAreaSkillNotes', '', 1, '2017-09-28 11:29:08', NULL),
	(110, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/delete/14', 'Delete data IndustryFunctionalAreaRoles at Menu Management', '', 1, '2017-09-28 11:31:50', NULL),
	(111, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data PHP Developer at Industry Functional AreaRoles', '', 1, '2017-09-28 11:35:53', NULL),
	(112, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/delete/15', 'Delete data CandidateResumes at Menu Management', '', 1, '2017-09-28 11:44:53', NULL),
	(113, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/qualification_levels/add-save', 'Add New Data 1 at Qualification Levels', '', 1, '2017-09-28 11:47:55', NULL),
	(114, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/qualifications/add-save', 'Add New Data 1 at Qualifications', '', 1, '2017-09-28 11:51:43', NULL),
	(115, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/add-save', 'Add New Data Candidate at Menu Management', '', 1, '2017-09-28 11:58:50', NULL),
	(116, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/delete/2', 'Delete data Siddhi at Candidates', '', 1, '2017-09-28 11:59:00', NULL),
	(117, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/delete/3', 'Delete data Raj at Candidates', '', 1, '2017-09-28 11:59:03', NULL),
	(118, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/add-save', 'Add New Data Siddhi at Candidates', '', 1, '2017-09-28 12:20:58', NULL),
	(119, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-29 05:24:53', NULL),
	(120, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 2 at CandidateIndustries', '', 1, '2017-09-29 05:42:28', NULL),
	(121, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/delete/1', 'Delete data 1 at CandidateIndustries', '', 1, '2017-09-29 05:51:43', NULL),
	(122, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/delete/2', 'Delete data 2 at CandidateIndustries', '', 1, '2017-09-29 05:51:54', NULL),
	(123, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 1 at CandidateIndustries', '', 1, '2017-09-29 05:58:00', NULL),
	(124, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/delete/18', 'Delete data CandidateFunctionalAreas at Menu Management', '', 1, '2017-09-29 06:13:38', NULL),
	(125, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/add-save', 'Add New Data 1 at CandidateFunctionalAreas', '', 1, '2017-09-29 06:17:59', NULL),
	(126, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/delete/19', 'Delete data CandidateNotes at Menu Management', '', 1, '2017-09-29 06:20:59', NULL),
	(127, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_notes/add-save', 'Add New Data 1 at CandidateNotes', '', 1, '2017-09-29 06:24:01', NULL),
	(128, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_resumes/add-save', 'Add New Data 1 at CandidateResumes', '', 1, '2017-09-29 06:28:30', NULL),
	(129, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/companies/add-save', 'Add New Data Abyssis at Companies', '', 1, '2017-09-29 06:50:13', NULL),
	(130, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/add-save', 'Add New Data 1 at CandidateQualifications', '', 1, '2017-09-29 06:57:01', NULL),
	(131, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/delete/1', 'Delete data 1 at CandidateFunctionalAreaSkills', '', 1, '2017-09-29 08:39:08', NULL),
	(132, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 1 at CandidateFunctionalAreaSkills', '', 1, '2017-09-29 08:49:51', NULL),
	(133, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/add-save', 'Add New Data 1 at Candidate Functional Area Skill Roles', '', 1, '2017-09-29 09:22:26', NULL),
	(134, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/delete/1', 'Delete data 1 at Candidate Functional Area Skills', '', 1, '2017-09-29 09:23:00', NULL),
	(135, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 1 at Candidate Functional Area Skills', '', 1, '2017-09-29 09:23:24', NULL),
	(136, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_orders/add-save', 'Add New Data PHP Fresher with good comm skills at Job Orders', '', 1, '2017-09-29 09:25:38', NULL),
	(137, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/17', 'Update data Candidates at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>Candidate</td><td>Candidates</td></tr><tr><td>path</td><td>candidates</td><td></td></tr><tr><td>sorting</td><td>2</td><td></td></tr></tbody></table>', 1, '2017-09-29 09:27:50', NULL),
	(138, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/1', 'Update data Countries Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>Countries</td><td>Countries Master</td></tr><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>3</td><td></td></tr></tbody></table>', 1, '2017-09-29 09:28:26', NULL),
	(139, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/16', 'Update data Qualifications Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>QualificationLevels</td><td>Qualifications Master</td></tr><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>4</td><td></td></tr></tbody></table>', 1, '2017-09-29 09:29:31', NULL),
	(140, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/17', 'Update data Candidates at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>path</td><td></td><td>candidates</td></tr><tr><td>icon</td><td>fa fa-glass</td><td></td></tr><tr><td>sorting</td><td>2</td><td></td></tr></tbody></table>', 1, '2017-09-29 09:33:39', NULL),
	(141, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/add-save', 'Add New Data 1 at Company Industries', '', 1, '2017-09-29 09:39:10', NULL),
	(142, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_general_skills/add-save', 'Add New Data 1 at Candidate General Skills', '', 1, '2017-09-29 09:39:45', NULL),
	(143, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Mobile Safari/537.36', 'http://c2wcb.local/admin/company_industries/add-save', 'Add New Data 2 at Company Industries', '', 1, '2017-09-29 09:40:48', NULL),
	(144, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/add-save', 'Add New Data 3 at Company Industries', '', 1, '2017-09-29 09:44:37', NULL),
	(145, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/add-save', 'Add New Data 4 at Company Industries', '', 1, '2017-09-29 09:50:45', NULL),
	(146, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_notes/add-save', 'Add New Data 1 at Company Notes', '', 1, '2017-09-29 09:57:07', NULL),
	(147, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/add-save', 'Add New Data 5 at Company Industries', '', 1, '2017-09-29 10:07:51', NULL),
	(148, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/module_generator/delete/62', 'Delete data Offices at Module Generator', '', 1, '2017-09-29 10:30:09', NULL),
	(149, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/module_generator/delete/62', 'Delete data Offices at Module Generator', '', 1, '2017-09-29 10:30:14', NULL),
	(150, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/add-save', 'Add New Data Arun at Candidates', '', 1, '2017-09-29 10:41:28', NULL),
	(151, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 2 at Candidate Industries', '', 1, '2017-09-29 10:42:11', NULL),
	(152, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/add-save', 'Add New Data 2 at Candidate Functional Areas', '', 1, '2017-09-29 10:42:51', NULL),
	(153, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_general_skills/add-save', 'Add New Data 2 at Candidate General Skills', '', 1, '2017-09-29 10:43:49', NULL),
	(154, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_notes/add-save', 'Add New Data 2 at Candidate Notes', '', 1, '2017-09-29 10:44:54', NULL),
	(155, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/add-save', 'Add New Data 2 at Candidate Qualifications', '', 1, '2017-09-29 10:48:21', NULL),
	(156, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_resumes/add-save', 'Add New Data 2 at Candidate Resumes', '', 1, '2017-09-29 10:49:05', NULL),
	(157, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/qualification_levels/add-save', 'Add New Data 2 at Qualification Levels', '', 1, '2017-09-29 11:39:08', NULL),
	(158, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/qualifications/add-save', 'Add New Data 2 at Qualifications', '', 1, '2017-09-29 11:39:36', NULL),
	(159, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/offices/add-save', 'Add New Data Marketing Wing at Offices', '', 1, '2017-09-29 13:58:48', NULL),
	(160, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-29 14:03:40', NULL),
	(161, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/office_industries/add-save', 'Add New Data 4 at Office Industries', '', 1, '2017-09-29 14:19:21', NULL),
	(162, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/admins/add-save', 'Add New Data Monu G at Admins', '', 1, '2017-09-29 14:20:31', NULL),
	(163, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.91 Safari/537.36 OPR/48.0.2685.32', 'http://c2wcb.local/admin/login', 'monu@c2w.org login with IP Address 127.0.0.1', '', 2, '2017-09-29 14:24:17', NULL),
	(164, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/industries/add-save', 'Add New Data BPO at Industries', '', 1, '2017-09-29 14:25:46', NULL),
	(165, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/20', 'Update data Job Orders at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>icon</td><td>fa fa-list</td><td>fa fa-globe</td></tr></tbody></table>', 1, '2017-09-29 14:26:32', NULL),
	(166, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/industry_functional_areas/add-save', 'Add New Data Non-voice Support at Functional Areas', '', 1, '2017-09-29 14:26:45', NULL),
	(167, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/industry_functional_area_skills/add-save', 'Add New Data English Writing at Functional Area Skills', '', 1, '2017-09-29 14:28:19', NULL),
	(168, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/delete/1', 'Delete data 1 at Company Industries', '', 1, '2017-09-29 14:56:39', NULL),
	(169, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/delete/2', 'Delete data 2 at Company Industries', '', 1, '2017-09-29 14:56:50', NULL),
	(170, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/delete/3', 'Delete data 3 at Company Industries', '', 1, '2017-09-29 14:57:00', NULL),
	(171, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/add-save', 'Add New Data 6 at Company Industries', '', 1, '2017-09-29 15:29:02', NULL),
	(172, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/edit-save/6', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>company_id</td><td>1</td><td></td></tr><tr><td>industry</td><td>BPO</td><td>2</td></tr></tbody></table>', 1, '2017-09-29 15:30:16', NULL),
	(173, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/delete/4', 'Delete data 4 at Company Industries', '', 1, '2017-09-29 15:30:36', NULL),
	(174, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/office_notes/add-save', 'Add New Data 1 at Office Notes', '', 1, '2017-09-29 15:45:38', NULL),
	(175, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-09-30 06:05:16', NULL),
	(176, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_general_skills/add-save', 'Add New Data 1 at Job Order General Skills', '', 1, '2017-09-30 07:04:20', NULL),
	(177, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_general_skills/edit-save/1', 'Update data  at Job Order General Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>job_order_id</td><td>1</td><td></td></tr><tr><td>general_skill</td><td>Positive Attitude</td><td>2</td></tr></tbody></table>', 1, '2017-09-30 07:07:34', NULL),
	(178, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_general_skills/edit-save/1', 'Update data  at Job Order General Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>general_skill</td><td>2</td><td>Team Work</td></tr></tbody></table>', 1, '2017-09-30 07:17:41', NULL),
	(179, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_general_skills/edit-save/1', 'Update data  at Job Order General Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>general_skill</td><td>Team Work</td><td>Positive Attitude</td></tr></tbody></table>', 1, '2017-09-30 07:18:04', NULL),
	(180, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/edit-save/6', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>2</td><td>BPO</td></tr></tbody></table>', 1, '2017-09-30 07:23:18', NULL),
	(181, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/company_industries/edit-save/5', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody></tbody></table>', 1, '2017-09-30 07:23:37', NULL),
	(182, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/office_industries/add-save', 'Add New Data 5 at Office Industries', '', 1, '2017-09-30 07:53:50', NULL),
	(183, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/office_industries/edit-save/4', 'Update data  at Office Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody></tbody></table>', 1, '2017-09-30 07:55:01', NULL),
	(184, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/office_industries/edit-save/1', 'Update data  at Office Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody></tbody></table>', 1, '2017-09-30 07:55:21', NULL),
	(185, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_industry_functional_areas/add-save', 'Add New Data 1 at Job Order Industry Functional Areas', '', 1, '2017-09-30 10:06:34', NULL),
	(186, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_industry_functional_areas/edit-save/1', 'Update data  at Job Order Industry Functional Areas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td>Software</td><td>Non-voice Support</td></tr></tbody></table>', 1, '2017-09-30 10:10:07', NULL),
	(187, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_industry_functional_areas/edit-save/1', 'Update data  at Job Order Industry Functional Areas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td>Non-voice Support</td><td>Software</td></tr></tbody></table>', 1, '2017-09-30 10:10:24', NULL),
	(188, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_preferences/add-save', 'Add New Data Candidate between age 25-30 at Job Order Preferences', '', 1, '2017-09-30 10:43:27', NULL),
	(189, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_preferences/edit-save/1', 'Update data Candidates between age 25-30 years at Job Order Preferences', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>job_order_id</td><td>1</td><td></td></tr><tr><td>preference_name</td><td>Candidate between age 25-30</td><td>Candidates between age 25-30 years</td></tr></tbody></table>', 1, '2017-09-30 10:43:56', NULL),
	(190, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_notes/add-save', 'Add New Data 1 at Job Order Notes', '', 1, '2017-09-30 11:29:39', NULL),
	(191, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_notes/edit-save/1', 'Update data  at Job Order Notes', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>job_order_id</td><td>1</td><td></td></tr><tr><td>note</td><td>Job Order Submitted</td><td>Job Order Submitted & Processing</td></tr></tbody></table>', 1, '2017-09-30 11:30:04', NULL),
	(192, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-01 09:41:42', NULL),
	(193, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_orders/edit-save/1', 'Update data PHP Fresher with good comm skills at Job Orders', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>IT</td><td>1</td></tr><tr><td>deleted_at</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-01 13:05:24', NULL),
	(194, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-02 05:09:25', NULL),
	(195, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_orders/add-save', 'Add New Data Experienced Outbound Sales Guy for Agro Products at Job Orders', '', 1, '2017-10-02 09:14:16', NULL),
	(196, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/candidates/add-save', 'Add New Data Vijayakrishnan at Candidates', '', 1, '2017-10-02 10:08:44', NULL),
	(197, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_orders/add-save', 'Add New Data Senior Frontend Develeoper at Job Orders', '', 1, '2017-10-02 10:44:32', NULL),
	(198, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/email_templates/add-save', 'Add New Data Submit Resume at Email Templates', '', 1, '2017-10-02 13:57:44', NULL),
	(199, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/email_templates/edit-save/2', 'Update data Submit Resume at Email Templates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>content</td><td><p>Dear [office-contact-name],</p><p>Please find attached the resume of [candidate-name], whom we believe is a good match for your requirements.</p><p>Thank You,<br>[logged-in-user-name],<br>Connecting2Work HR Solutions</p></td><td><p>Dear [contact_name],</p><p>Please find attached the resume of [candidate_name], whom we believe is a good match for your requirements.</p><p>Thank You,<br>[your_name],<br>Connecting2Work HR Solutions</p></td></tr><tr><td>from_name</td><td></td><td>Connecting2Work HR Solutions</td></tr><tr><td>from_email</td><td></td><td>info@connecting2work.com</td></tr><tr><td>cc_email</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-02 14:00:39', NULL),
	(200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-02 14:09:46', NULL),
	(201, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-03 03:32:02', NULL),
	(202, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-03 13:55:41', NULL),
	(203, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-04 03:09:36', NULL),
	(204, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.91 Safari/537.36 OPR/48.0.2685.32', 'http://c2wcb.local/admin/login', 'monu@c2w.org login with IP Address 127.0.0.1', '', 2, '2017-10-04 04:48:03', NULL),
	(205, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/17', 'Update data Candidates at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>2</td><td></td></tr></tbody></table>', 1, '2017-10-04 04:48:51', NULL),
	(206, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/18', 'Update data Companies at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>3</td><td></td></tr></tbody></table>', 1, '2017-10-04 04:49:34', NULL),
	(207, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/21', 'Update data Managers at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>4</td><td></td></tr></tbody></table>', 1, '2017-10-04 04:49:56', NULL),
	(208, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/22', 'Update data Recruiters at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>5</td><td></td></tr></tbody></table>', 1, '2017-10-04 04:50:12', NULL),
	(209, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/23', 'Update data Admins at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>6</td><td></td></tr></tbody></table>', 1, '2017-10-04 04:50:27', NULL),
	(210, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/menu_management/edit-save/16', 'Update data Qualifications Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>7</td><td></td></tr></tbody></table>', 1, '2017-10-04 04:50:44', NULL),
	(211, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/add-save', 'Add New Data Aravind at Candidates', '', 1, '2017-10-04 06:19:16', NULL),
	(212, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 3 at Candidate Industries', '', 1, '2017-10-04 06:20:08', NULL),
	(213, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/add-save', 'Add New Data 3 at Candidate Functional Areas', '', 1, '2017-10-04 06:21:38', NULL),
	(214, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_general_skills/add-save', 'Add New Data 3 at Candidate General Skills', '', 1, '2017-10-04 06:22:22', NULL),
	(215, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_notes/add-save', 'Add New Data 3 at Candidate Notes', '', 1, '2017-10-04 06:23:22', NULL),
	(216, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/add-save', 'Add New Data 3 at Candidate Qualifications', '', 1, '2017-10-04 06:24:16', NULL),
	(217, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_resumes/add-save', 'Add New Data 3 at Candidate Resumes', '', 1, '2017-10-04 06:25:52', NULL),
	(218, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data Customer Executive at Industry Functional Area Roles', '', 1, '2017-10-04 06:28:45', NULL),
	(219, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/add-save', 'Add New Data 2 at Candidate Functional Area Skill Roles', '', 1, '2017-10-04 06:29:26', NULL),
	(220, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 2 at Candidate Functional Area Skills', '', 1, '2017-10-04 06:30:22', NULL),
	(221, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/edit-save/2', 'Update data  at Candidate Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>IT</td><td>BPO</td></tr></tbody></table>', 1, '2017-10-04 06:31:54', NULL),
	(222, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/edit-save/2', 'Update data  at Candidate Functional Areas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td>Software</td><td>Non-voice Support</td></tr></tbody></table>', 1, '2017-10-04 06:32:36', NULL),
	(223, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_general_skills/edit-save/2', 'Update data  at Candidate General Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>general_skill</td><td>Team Work</td><td>Positive Attitude</td></tr></tbody></table>', 1, '2017-10-04 06:33:32', NULL),
	(224, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_notes/edit-save/2', 'Update data  at Candidate Notes', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>note</td><td>Pythin testing in mother board of intel</td><td>Python testing in mother board of intel</td></tr></tbody></table>', 1, '2017-10-04 06:34:16', NULL),
	(225, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/edit-save/2', 'Update data  at Candidate Qualifications', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>completed_year</td><td>2017</td><td>2016</td></tr><tr><td>score</td><td>490</td><td>500</td></tr><tr><td>qualification</td><td>Mtech</td><td>Btech</td></tr><tr><td>qualification_level</td><td>Post Graduate</td><td>Graduate</td></tr></tbody></table>', 1, '2017-10-04 06:35:13', NULL),
	(226, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/add-save', 'Add New Data 3 at Candidate Functional Area Skill Roles', '', 1, '2017-10-04 06:36:55', NULL),
	(227, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 3 at Candidate Functional Area Skills', '', 1, '2017-10-04 06:37:48', NULL),
	(228, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/edit-save/3', 'Update data  at Candidate Functional Area Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area_skill</td><td>English Writing</td><td>PHP</td></tr></tbody></table>', 1, '2017-10-04 06:38:24', NULL),
	(229, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_resumes/delete-image', 'Delete the image of 2 at Candidate Resumes', '', 1, '2017-10-04 06:39:44', NULL),
	(230, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_resumes/edit-save/2', 'Update data  at Candidate Resumes', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>resume_url</td><td></td><td>uploads/1/2017-10/08_sreejith.docx</td></tr><tr><td>status</td><td></td><td></td></tr><tr><td>deleted_at</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-04 06:40:02', NULL),
	(231, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-04 06:40:25', NULL),
	(232, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/edit-save/3', 'Update data  at Candidate Functional Area Skill Roles', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>role</td><td>Customer Executive</td><td>PHP Developer</td></tr></tbody></table>', 1, '2017-10-04 06:41:52', NULL),
	(233, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 4 at Candidate Functional Area Skills', '', 1, '2017-10-04 06:46:19', NULL),
	(234, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/edit-save/4', 'Update data  at Candidate Functional Area Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area_skill</td><td>PHP</td><td>English Writing</td></tr></tbody></table>', 1, '2017-10-04 06:47:51', NULL),
	(235, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/edit-save/1', 'Update data  at Candidate Functional Area Skill Roles', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>role</td><td>PHP Developer</td><td>Customer Executive</td></tr></tbody></table>', 1, '2017-10-04 06:49:01', NULL),
	(236, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/companies/edit-save/1', 'Update data Cenveo Solutions at Companies', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody></tbody></table>', 1, '2017-10-04 06:51:28', NULL),
	(237, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/edit-save/5', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>IT</td><td>BPO</td></tr></tbody></table>', 1, '2017-10-04 06:59:23', NULL),
	(238, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/edit-save/5', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>BPO</td><td>IT</td></tr></tbody></table>', 1, '2017-10-04 06:59:40', NULL),
	(239, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 7 at Company Industries', '', 1, '2017-10-04 07:04:51', NULL),
	(240, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/industries/add-save', 'Add New Data Accounting/Finance at Industries', '', 1, '2017-10-04 07:09:26', NULL),
	(241, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/edit-save/6', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>BPO</td><td>Accounting/Finance</td></tr></tbody></table>', 1, '2017-10-04 07:09:59', NULL),
	(242, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/edit-save/7', 'Update data Aravind at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>status</td><td></td><td></td></tr><tr><td>deleted_at</td><td></td><td></td></tr><tr><td>creator_id</td><td></td><td></td></tr><tr><td>secondary_email</td><td></td><td></td></tr><tr><td>secondary_phone</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-04 07:14:42', NULL),
	(243, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/edit-save/7', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>BPO</td><td>IT</td></tr></tbody></table>', 1, '2017-10-04 07:22:43', NULL),
	(244, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/edit-save/7', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>IT</td><td>BPO</td></tr></tbody></table>', 1, '2017-10-04 07:23:07', NULL),
	(245, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/edit-save/7', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>BPO</td><td>IT</td></tr></tbody></table>', 1, '2017-10-04 07:26:07', NULL),
	(246, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/edit-save/5', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>IT</td><td>BPO</td></tr></tbody></table>', 1, '2017-10-04 07:27:01', NULL),
	(247, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/edit-save/5', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>BPO</td><td>IT</td></tr></tbody></table>', 1, '2017-10-04 07:27:37', NULL),
	(248, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 8 at Company Industries', '', 1, '2017-10-04 07:28:03', NULL),
	(249, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 9 at Company Industries', '', 1, '2017-10-04 07:29:37', NULL),
	(250, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 10 at Company Industries', '', 1, '2017-10-04 07:30:47', NULL),
	(251, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/10', 'Delete data 10 at Company Industries', '', 1, '2017-10-04 07:31:00', NULL),
	(252, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/10', 'Delete data  at Company Industries', '', 1, '2017-10-04 07:31:05', NULL),
	(253, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/9', 'Delete data 9 at Company Industries', '', 1, '2017-10-04 07:31:31', NULL),
	(254, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 9 at Company Industries', '', 1, '2017-10-04 07:34:31', NULL),
	(255, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/9', 'Delete data 9 at Company Industries', '', 1, '2017-10-04 07:36:55', NULL),
	(256, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 9 at Company Industries', '', 1, '2017-10-04 07:37:42', NULL),
	(257, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/9', 'Delete data 9 at Company Industries', '', 1, '2017-10-04 07:40:41', NULL),
	(258, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/9', 'Delete data  at Company Industries', '', 1, '2017-10-04 07:40:47', NULL),
	(259, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/8', 'Delete data 8 at Company Industries', '', 1, '2017-10-04 07:51:00', NULL),
	(260, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/7', 'Delete data 7 at Company Industries', '', 1, '2017-10-04 07:51:11', NULL),
	(261, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 7 at Company Industries', '', 1, '2017-10-04 07:57:39', NULL),
	(262, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 8 at Company Industries', '', 1, '2017-10-04 08:29:24', NULL),
	(263, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 9 at Company Industries', '', 1, '2017-10-04 08:30:27', NULL),
	(264, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/9', 'Delete data 9 at Company Industries', '', 1, '2017-10-04 08:30:44', NULL),
	(265, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/8', 'Delete data 8 at Company Industries', '', 1, '2017-10-04 08:30:55', NULL),
	(266, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/7', 'Delete data 7 at Company Industries', '', 1, '2017-10-04 08:31:07', NULL),
	(267, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 7 at Company Industries', '', 1, '2017-10-04 08:33:40', NULL),
	(268, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 4 at Candidate Industries', '', 1, '2017-10-04 08:37:48', NULL),
	(269, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 5 at Candidate Industries', '', 1, '2017-10-04 08:38:35', NULL),
	(270, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 6 at Candidate Industries', '', 1, '2017-10-04 08:43:35', NULL),
	(271, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/7', 'Delete data 7 at Company Industries', '', 1, '2017-10-04 08:51:58', NULL),
	(272, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/add-save', 'Add New Data 4 at Candidate Functional Area Skill Roles', '', 1, '2017-10-04 08:53:34', NULL),
	(273, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/add-save', 'Add New Data 4 at Candidate Functional Areas', '', 1, '2017-10-04 08:58:01', NULL),
	(274, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 5 at Candidate Functional Area Skills', '', 1, '2017-10-04 09:04:10', NULL),
	(275, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_general_skills/add-save', 'Add New Data 4 at Candidate General Skills', '', 1, '2017-10-04 09:09:35', NULL),
	(276, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/add-save', 'Add New Data 4 at Candidate Qualifications', '', 1, '2017-10-04 09:18:41', NULL),
	(277, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/add-save', 'Add New Data 5 at Candidate Qualifications', '', 1, '2017-10-04 09:21:40', NULL),
	(278, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/delete/5', 'Delete data 5 at Candidate Qualifications', '', 1, '2017-10-04 09:22:23', NULL),
	(279, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/edit-save/4', 'Update data  at Candidate Qualifications', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>score</td><td>450</td><td>500</td></tr></tbody></table>', 1, '2017-10-04 09:28:12', NULL),
	(280, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_general_skills/add-save', 'Add New Data 2 at Job Order General Skills', '', 1, '2017-10-04 09:43:38', NULL),
	(281, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_general_skills/edit-save/2', 'Update data  at Job Order General Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>general_skill</td><td>Team Work</td><td>Positive Attitude</td></tr></tbody></table>', 1, '2017-10-04 09:46:41', NULL),
	(282, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/add-save', 'Add New Data Internet at Industries', '', 1, '2017-10-04 09:47:55', NULL),
	(283, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_general_skills/add-save', 'Add New Data 3 at Job Order General Skills', '', 1, '2017-10-04 09:57:04', NULL),
	(284, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_general_skills/add-save', 'Add New Data 4 at Job Order General Skills', '', 1, '2017-10-04 09:57:26', NULL),
	(285, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_general_skills/delete/4', 'Delete data 4 at Job Order General Skills', '', 1, '2017-10-04 09:59:05', NULL),
	(286, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 2 at Industry Functional Area Skill Notes', '', 1, '2017-10-04 12:20:02', NULL),
	(287, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/delete/2', 'Delete data 2 at Industry Functional Area Skill Notes', '', 1, '2017-10-04 12:20:26', NULL),
	(288, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-05 04:28:43', NULL),
	(289, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/add-save', 'Add New Data Active at General Skills', '', 1, '2017-10-05 04:55:06', NULL),
	(290, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/add-save', 'Add New Data Positive Attittude at General Skills', '', 1, '2017-10-05 05:01:15', NULL),
	(291, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/delete/4', 'Delete data Positive Attittude at General Skills', '', 1, '2017-10-05 05:01:56', NULL),
	(292, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/delete/3', 'Delete data Active at General Skills', '', 1, '2017-10-05 05:02:09', NULL),
	(293, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/edit-save/1', 'Update data Positive Attitude at General Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>description</td><td></td><td>Positive</td></tr><tr><td>status</td><td>1</td><td></td></tr><tr><td>deleted_at</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-05 05:04:57', NULL),
	(294, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skill_notes/add-save', 'Add New Data 6 at General Skill Notes', '', 1, '2017-10-05 05:20:25', NULL),
	(295, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-05 05:21:01', NULL),
	(296, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/delete/3', 'Delete data Active at General Skills', '', 1, '2017-10-05 05:35:04', NULL),
	(297, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/delete/4', 'Delete data Positive Attittude at General Skills', '', 1, '2017-10-05 05:35:42', NULL),
	(298, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skill_notes/delete/6', 'Delete data 6 at General Skill Notes', '', 1, '2017-10-05 05:36:15', NULL),
	(299, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/delete/3', 'Delete data Active at General Skills', '', 1, '2017-10-05 05:36:59', NULL),
	(300, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/companies/edit-save/1', 'Update data Cenveo Solutions at Companies', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody></tbody></table>', 1, '2017-10-05 05:53:08', NULL),
	(301, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/delete/1', 'Delete data Sid at Candidates', '', 1, '2017-10-05 06:01:34', NULL),
	(302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/add-save', 'Add New Data Teacher at Industries', '', 1, '2017-10-05 06:17:13', NULL),
	(303, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Teacher at Functional Areas', '', 1, '2017-10-05 06:20:30', NULL),
	(304, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data Lecturer at Functional Area Skills', '', 1, '2017-10-05 06:24:41', NULL),
	(305, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 2 at Industry Functional Area Skill Notes', '', 1, '2017-10-05 06:26:28', NULL),
	(306, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/delete/3', 'Delete data Lecturer at Functional Area Skills', '', 1, '2017-10-05 06:37:42', NULL),
	(307, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/delete/3', 'Delete data Lecturer at Functional Area Skills', '', 1, '2017-10-05 06:39:54', NULL),
	(308, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 7 at Company Industries', '', 1, '2017-10-05 06:40:55', NULL),
	(309, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/add-save', 'Add New Data 8 at Company Industries', '', 1, '2017-10-05 06:44:45', NULL),
	(310, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/edit-save/8', 'Update data  at Company Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>Chemicals/Petrochemicals</td><td>Bio Technology & Life Sciences</td></tr></tbody></table>', 1, '2017-10-05 06:49:05', NULL),
	(311, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_industries/delete/8', 'Delete data 8 at Company Industries', '', 1, '2017-10-05 06:49:39', NULL),
	(312, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/office_industries/add-save', 'Add New Data 6 at Office Industries', '', 1, '2017-10-05 06:51:28', NULL),
	(313, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/office_industries/edit-save/1', 'Update data  at Office Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>BPO</td><td>KPO/Analytics</td></tr></tbody></table>', 1, '2017-10-05 06:52:36', NULL),
	(314, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/office_industries/delete/1', 'Delete data 1 at Office Industries', '', 1, '2017-10-05 06:52:58', NULL),
	(315, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_notes/add-save', 'Add New Data 2 at Company Notes', '', 1, '2017-10-05 06:56:48', NULL),
	(316, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_notes/edit-save/2', 'Update data  at Company Notes', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>note</td><td>Test Note 2</td><td>Test Note 2 Edited</td></tr></tbody></table>', 1, '2017-10-05 06:57:10', NULL),
	(317, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_notes/delete/2', 'Delete data 2 at Company Notes', '', 1, '2017-10-05 06:57:22', NULL),
	(318, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/company_notes/add-save', 'Add New Data 2 at Company Notes', '', 1, '2017-10-05 06:58:29', NULL),
	(319, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/office_notes/add-save', 'Add New Data 2 at Office Notes', '', 1, '2017-10-05 07:02:07', NULL),
	(320, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/office_notes/edit-save/2', 'Update data  at Office Notes', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>note</td><td>Test Note 2</td><td>new note added</td></tr></tbody></table>', 1, '2017-10-05 07:02:29', NULL),
	(321, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/offices/delete/2', 'Delete data Development Center at Offices', '', 1, '2017-10-05 07:04:19', NULL),
	(322, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data Test at Functional Area Skills', '', 1, '2017-10-05 07:13:07', NULL),
	(323, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data Test 1 at Functional Area Skills', '', 1, '2017-10-05 07:14:14', NULL),
	(324, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/general_skills/add-save', 'Add New Data Solid Communication at General Skills', '', 1, '2017-10-05 07:15:10', NULL),
	(325, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 2 at Industry Functional Area Skill Notes', '', 1, '2017-10-05 07:17:45', NULL),
	(326, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 3 at Industry Functional Area Skill Notes', '', 1, '2017-10-05 07:18:40', NULL),
	(327, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_general_skills/add-save', 'Add New Data 4 at Job Order General Skills', '', 1, '2017-10-05 07:19:07', NULL),
	(328, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 4 at Industry Functional Area Skill Notes', '', 1, '2017-10-05 07:19:19', NULL),
	(329, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 5 at Industry Functional Area Skill Notes', '', 1, '2017-10-05 07:19:43', NULL),
	(330, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_general_skills/delete/4', 'Delete data 4 at Job Order General Skills', '', 1, '2017-10-05 07:19:42', NULL),
	(331, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_general_skills/edit-save/3', 'Update data  at Job Order General Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>general_skill</td><td>Team Work</td><td>Solid Communication</td></tr></tbody></table>', 1, '2017-10-05 07:20:03', NULL),
	(332, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data Lecturer at Industry Functional Area Roles', '', 1, '2017-10-05 07:21:30', NULL),
	(333, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data Primary Teacher at Industry Functional Area Roles', '', 1, '2017-10-05 07:22:10', NULL),
	(334, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/delete/3', 'Delete data Teacher at Functional Areas', '', 1, '2017-10-05 07:23:27', NULL),
	(335, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/delete/3', 'Delete data Teacher at Functional Areas', '', 1, '2017-10-05 07:23:59', NULL),
	(336, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data Lecturer at Industry Functional Area Roles', '', 1, '2017-10-05 07:25:41', NULL),
	(337, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data Primary Teacher at Industry Functional Area Roles', '', 1, '2017-10-05 07:26:10', NULL),
	(338, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/delete/3', 'Delete data Teacher at Functional Areas', '', 1, '2017-10-05 07:26:42', NULL),
	(339, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Teacher at Functional Areas', '', 1, '2017-10-05 07:34:28', NULL),
	(340, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/delete/3', 'Delete data Teacher at Functional Areas', '', 1, '2017-10-05 07:34:56', NULL),
	(341, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_general_skills/edit-save/2', 'Update data  at Job Order General Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>general_skill</td><td>Positive Attitude</td><td>Team Work</td></tr></tbody></table>', 1, '2017-10-05 08:04:51', NULL),
	(342, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_industry_functional_areas/add-save', 'Add New Data 2 at Job Order Industry Functional Areas', '', 1, '2017-10-05 08:10:05', NULL),
	(343, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_industry_functional_areas/add-save', 'Add New Data 3 at Job Order Industry Functional Areas', '', 1, '2017-10-05 08:34:05', NULL),
	(344, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_industry_functional_areas/delete/3', 'Delete data 3 at Job Order Industry Functional Areas', '', 1, '2017-10-05 08:46:47', NULL),
	(345, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/delete/4', 'Delete data Siddhi at Candidates', '', 1, '2017-10-05 08:53:53', NULL),
	(346, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 6 at Candidate Industries', '', 1, '2017-10-05 08:55:44', NULL),
	(347, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 7 at Candidate Industries', '', 1, '2017-10-05 08:57:59', NULL),
	(348, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_orders/add-save', 'Add New Data BPO - Non-voice Support Executive at Job Orders', '', 1, '2017-10-05 08:58:58', NULL),
	(349, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 6 at Candidate Functional Area Skills', '', 1, '2017-10-05 08:59:33', NULL),
	(350, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_orders/edit-save/4', 'Update data BPO - Non-voice Support Executive at Job Orders', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>status</td><td>New</td><td></td></tr></tbody></table>', 1, '2017-10-05 09:06:50', NULL),
	(351, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_orders/edit-save/4', 'Update data BPO - Non-voice Support Executive at Job Orders', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>status</td><td>New</td><td></td></tr></tbody></table>', 1, '2017-10-05 09:08:20', NULL),
	(352, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_orders/edit-save/4', 'Update data BPO - Non-voice Support Executive at Job Orders', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td></td><td>Non-voice Support</td></tr><tr><td>status</td><td>New</td><td></td></tr><tr><td>intro_call_date</td><td></td><td></td></tr><tr><td>submission_date</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-05 09:09:38', NULL),
	(353, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/5', 'Delete data Teacher at Industries', '', 1, '2017-10-05 09:29:14', NULL),
	(354, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Teacher at Functional Areas', '', 1, '2017-10-05 09:30:29', NULL),
	(355, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/12', 'Delete data Education at Industries', '', 1, '2017-10-05 09:35:23', NULL),
	(356, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/job_order_industry_functional_area_skills/add-save', 'Add New Data 1 at Job Order Industry Functional Area Skills', '', 1, '2017-10-05 09:40:15', NULL),
	(357, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/add-save', 'Add New Data Hotel/Restaurant at Industries', '', 1, '2017-10-05 09:46:20', NULL),
	(358, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Management at Functional Areas', '', 1, '2017-10-05 09:47:06', NULL),
	(359, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data Customer Service at Functional Area Skills', '', 1, '2017-10-05 09:48:13', NULL),
	(360, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 2 at Industry Functional Area Skill Notes', '', 1, '2017-10-05 09:48:47', NULL),
	(361, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data Manager at Industry Functional Area Roles', '', 1, '2017-10-05 09:49:30', NULL),
	(362, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Hotel/Restaurant at Industries', '', 1, '2017-10-05 09:51:11', NULL),
	(363, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data Manager at Functional Area Skills', '', 1, '2017-10-05 10:36:07', NULL),
	(364, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 2 at Industry Functional Area Skill Notes', '', 1, '2017-10-05 10:36:52', NULL),
	(365, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data Manager at Industry Functional Area Roles', '', 1, '2017-10-05 10:38:39', NULL),
	(366, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Hotel/Restaurant at Industries', '', 1, '2017-10-05 10:39:22', NULL),
	(367, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Hotel/Restaurant at Industries', '', 1, '2017-10-05 10:42:42', NULL),
	(368, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Hotel/Restaurant at Industries', '', 1, '2017-10-05 10:43:42', NULL),
	(369, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-06 04:30:29', NULL),
	(370, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/add-save', 'Add New Data Rahul at Candidates', '', 1, '2017-10-06 04:36:46', NULL),
	(371, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/add-save', 'Add New Data Abhiraj at Candidates', '', 1, '2017-10-06 04:57:51', NULL),
	(372, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/edit-save/9', 'Update data Abhiraj at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>first_job_start_date</td><td></td><td></td></tr><tr><td>status</td><td></td><td></td></tr><tr><td>experience_years</td><td></td><td></td></tr><tr><td>experience_months</td><td></td><td></td></tr><tr><td>current_employer</td><td></td><td></td></tr><tr><td>current_designation</td><td></td><td></td></tr><tr><td>creator_id</td><td></td><td></td></tr><tr><td>secondary_email</td><td></td><td></td></tr><tr><td>secondary_phone</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-06 05:10:50', NULL),
	(373, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 8 at Candidate Industries', '', 1, '2017-10-06 05:25:14', NULL),
	(374, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/add-save', 'Add New Data 5 at Candidate Functional Areas', '', 1, '2017-10-06 05:40:21', NULL),
	(375, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 7 at Candidate Functional Area Skills', '', 1, '2017-10-06 05:41:31', NULL),
	(376, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_general_skills/add-save', 'Add New Data 5 at Candidate General Skills', '', 1, '2017-10-06 05:42:24', NULL),
	(377, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/add-save', 'Add New Data 4 at Candidate Qualifications', '', 1, '2017-10-06 05:43:08', NULL),
	(378, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/edit-save/4', 'Update data  at Candidate Qualifications', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>score</td><td>450</td><td>350</td></tr></tbody></table>', 1, '2017-10-06 05:44:33', NULL),
	(379, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/companies/edit-save/2', 'Update data Abyssis at Companies', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>contract_rate</td><td>20.00</td><td>7.00</td></tr></tbody></table>', 1, '2017-10-06 06:05:26', NULL),
	(380, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/edit-save/5', 'Update data  at Candidate Functional Areas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td>Software</td><td>Non-voice Support</td></tr></tbody></table>', 1, '2017-10-06 06:23:57', NULL),
	(381, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/edit-save/5', 'Update data  at Candidate Functional Areas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td>Non-voice Support</td><td>Software</td></tr></tbody></table>', 1, '2017-10-06 06:24:41', NULL),
	(382, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/add-save', 'Add New Data 5 at Candidate Functional Area Skill Roles', '', 1, '2017-10-06 06:25:57', NULL),
	(383, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/qualifications/add-save', 'Add New Data 3 at Qualifications', '', 1, '2017-10-06 06:35:29', NULL),
	(384, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/edit-save/1', 'Update data Raghav at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>first_name</td><td>Sid</td><td>Raghav</td></tr><tr><td>last_name</td><td>Vinayak</td><td>Ram</td></tr><tr><td>birth_date</td><td>1994-02-14</td><td>1994-02-28</td></tr><tr><td>experience_years</td><td>14</td><td>0</td></tr><tr><td>source</td><td>Naukri</td><td>1</td></tr></tbody></table>', 1, '2017-10-06 06:49:01', NULL),
	(385, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/edit-save/2', 'Update data Madhav at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>first_name</td><td>Siddhi</td><td>Madhav</td></tr><tr><td>last_name</td><td>Vinayak</td><td>M</td></tr><tr><td>head_line</td><td>Head</td><td>A young talented art designer</td></tr><tr><td>experience_years</td><td>14</td><td>1</td></tr><tr><td>source</td><td>Naukri</td><td>1</td></tr></tbody></table>', 1, '2017-10-06 06:52:00', NULL),
	(386, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/delete-image', 'Delete the image of Siddhi at Candidates', '', 1, '2017-10-06 06:53:25', NULL),
	(387, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/edit-save/4', 'Update data Siddhi at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>gender</td><td>male</td><td>Male</td></tr><tr><td>expected_ctc</td><td>12</td><td>18</td></tr><tr><td>current_ctc</td><td>12</td><td>14</td></tr><tr><td>source</td><td></td><td>1</td></tr><tr><td>creator_id</td><td></td><td></td></tr><tr><td>primary_email</td><td>dssadasd@mail.com</td><td>siddhi@mail.com</td></tr><tr><td>secondary_email</td><td>sdasds@mail.com</td><td></td></tr><tr><td>primary_phone</td><td>798956210</td><td>8891915726</td></tr><tr><td>secondary_phone</td><td>798956210</td><td></td></tr><tr><td>photo_url</td><td></td><td>uploads/1/2017-10/w3logo.jpg</td></tr></tbody></table>', 1, '2017-10-06 06:55:15', NULL),
	(388, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/add-save', 'Add New Data 5 at Candidate Qualifications', '', 1, '2017-10-06 06:57:18', NULL),
	(389, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/edit-save/5', 'Update data  at Candidate Qualifications', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>completed_year</td><td>2017</td><td>2016</td></tr></tbody></table>', 1, '2017-10-06 06:57:53', NULL),
	(390, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/qualifications/add-save', 'Add New Data 4 at Qualifications', '', 1, '2017-10-06 07:02:16', NULL),
	(391, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-06 07:27:09', NULL),
	(392, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/edit-save/6', 'Update data Automotive/ Ancillaries at Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>description</td><td></td><td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc felis diam, egestas in sem quis, pretium feugiat orci. Mauris tincidunt massa et nulla sollicitudin, in auctor odio imperdiet. Aenean fermentum nulla sem, convallis ullamcorper neque dictum ut.</td></tr><tr><td>status</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-06 07:29:44', NULL),
	(393, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/job_order_preferences/add-save', 'Add New Data Age between 24-30 years at Job Order Preferences', '', 1, '2017-10-06 07:30:38', NULL),
	(394, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/edit-save/6', 'Update data Automotive/ Ancillaries at Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>description</td><td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc felis diam, egestas in sem quis, pretium feugiat orci. Mauris tincidunt massa et nulla sollicitudin, in auctor odio imperdiet. Aenean fermentum nulla sem, convallis ullamcorper neque dictum ut.</td><td>Automobile</td></tr><tr><td>status</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-06 07:32:18', NULL),
	(395, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/edit-save/3', 'Update data Raj at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>source</td><td>Naukri</td><td>1</td></tr></tbody></table>', 1, '2017-10-06 08:29:26', NULL),
	(396, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Accounting at Functional Areas', '', 1, '2017-10-06 08:55:21', NULL),
	(397, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-06 10:49:24', NULL),
	(398, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 8 at Candidate Functional Area Skills', '', 1, '2017-10-06 11:06:33', NULL),
	(399, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/offices/add-save', 'Add New Data Head Office at Offices', '', 1, '2017-10-06 11:31:21', NULL),
	(400, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/office_industries/add-save', 'Add New Data 7 at Office Industries', '', 1, '2017-10-06 11:32:50', NULL),
	(401, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_notes/add-save', 'Add New Data 4 at Candidate Notes', '', 1, '2017-10-06 11:43:21', NULL),
	(402, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_resumes/add-save', 'Add New Data 4 at Candidate Resumes', '', 1, '2017-10-06 11:43:38', NULL),
	(403, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-07 06:54:36', NULL),
	(404, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-09 04:36:00', NULL),
	(405, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/add-save', 'Add New Data Vishnu at Candidates', '', 1, '2017-10-09 04:54:18', NULL),
	(406, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/edit-save/10', 'Update data Vishnu Edit at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>first_name</td><td>Vishnu</td><td>Vishnu Edit</td></tr><tr><td>last_name</td><td>Narayanan</td><td>Narayanan Edit</td></tr><tr><td>religion</td><td>HIndu</td><td>HIndu Edit</td></tr><tr><td>expected_ctc</td><td>13</td><td>40</td></tr><tr><td>first_job_start_date</td><td>2016-09-18</td><td>2016-09-13</td></tr><tr><td>head_line</td><td>A mechanical engineer with basic programming knowledge</td><td>A mechanical engineer with basic programming knowledge Edit</td></tr><tr><td>status</td><td></td><td></td></tr><tr><td>can_relocate</td><td></td><td>1</td></tr><tr><td>current_employer</td><td>Tata Ellexsi</td><td>Tata Ellexsi Edit</td></tr><tr><td>current_designation</td><td>Tester</td><td>Tester Edit</td></tr><tr><td>creator_id</td><td></td><td></td></tr><tr><td>address</td><td>Narayana bhavan, Neeramankrara, pappanamcode</td><td>Narayana bhavan, Neeramankrara, pappanamcode edit</td></tr><tr><td>primary_email</td><td>narayan@mail.com</td><td>narayanedit@mail.com</td></tr><tr><td>secondary_email</td><td></td><td></td></tr><tr><td>secondary_phone</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-09 04:56:26', NULL),
	(407, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidates/edit-save/10', 'Update data Vishnu Edit at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>status</td><td></td><td></td></tr><tr><td>creator_id</td><td></td><td></td></tr><tr><td>secondary_email</td><td></td><td></td></tr><tr><td>secondary_phone</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-09 04:57:16', NULL),
	(408, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 9 at Candidate Industries', '', 1, '2017-10-09 05:08:16', NULL),
	(409, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Automobile Developing at Functional Areas', '', 1, '2017-10-09 05:12:23', NULL),
	(410, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_notes/add-save', 'Add New Data 5 at Candidate Notes', '', 1, '2017-10-09 05:13:51', NULL),
	(411, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_notes/edit-save/5', 'Update data  at Candidate Notes', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>note</td><td>Note For narayanan.</td><td>Edit in note for narayanan.</td></tr></tbody></table>', 1, '2017-10-09 05:14:32', NULL),
	(412, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/add-save', 'Add New Data 6 at Candidate Functional Areas', '', 1, '2017-10-09 05:15:16', NULL),
	(413, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/edit-save/9', 'Update data  at Candidate Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>Automotive/ Ancillaries</td><td>IT</td></tr></tbody></table>', 1, '2017-10-09 05:18:43', NULL),
	(414, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/edit-save/6', 'Update data  at Candidate Functional Areas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td>Automobile Developing</td><td>Non-voice Support</td></tr></tbody></table>', 1, '2017-10-09 05:21:31', NULL),
	(415, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_resumes/add-save', 'Add New Data 5 at Candidate Resumes', '', 1, '2017-10-09 05:28:03', NULL),
	(416, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_resumes/delete-image', 'Delete the image of 5 at Candidate Resumes', '', 1, '2017-10-09 05:29:21', NULL),
	(417, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_resumes/edit-save/5', 'Update data  at Candidate Resumes', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>resume_url</td><td></td><td>uploads/1/2017-10/316.docx</td></tr><tr><td>status</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-09 05:30:41', NULL),
	(418, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/add-save', 'Add New Data 6 at Candidate Qualifications', '', 1, '2017-10-09 05:35:27', NULL),
	(419, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_qualifications/edit-save/6', 'Update data  at Candidate Qualifications', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>is_completed</td><td>1</td><td>0</td></tr><tr><td>completed_year</td><td>2016</td><td>2018</td></tr><tr><td>score</td><td>590</td><td>600</td></tr><tr><td>qualification</td><td>Btech</td><td>Mtech</td></tr><tr><td>qualification_level</td><td>Graduate</td><td>Post Graduate</td></tr></tbody></table>', 1, '2017-10-09 05:36:14', NULL),
	(420, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_general_skills/add-save', 'Add New Data 6 at Candidate General Skills', '', 1, '2017-10-09 05:36:36', NULL),
	(421, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_general_skills/edit-save/6', 'Update data  at Candidate General Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>general_skill</td><td>Team Work</td><td>Solid Communication</td></tr></tbody></table>', 1, '2017-10-09 05:37:30', NULL),
	(422, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data Automobile Test at Functional Area Skills', '', 1, '2017-10-09 05:38:52', NULL),
	(423, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data Automobile Tester at Industry Functional Area Roles', '', 1, '2017-10-09 05:40:36', NULL),
	(424, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/edit-save/6', 'Update data  at Candidate Functional Areas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td>Non-voice Support</td><td>Automobile Developing</td></tr></tbody></table>', 1, '2017-10-09 05:42:00', NULL),
	(425, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 9 at Candidate Functional Area Skills', '', 1, '2017-10-09 05:44:42', NULL),
	(426, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/edit-save/9', 'Update data  at Candidate Functional Area Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area_skill</td><td>English Writing</td><td>Automobile Test</td></tr></tbody></table>', 1, '2017-10-09 05:45:18', NULL),
	(427, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/add-save', 'Add New Data 6 at Candidate Functional Area Skill Roles', '', 1, '2017-10-09 05:46:29', NULL),
	(428, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/edit-save/6', 'Update data  at Candidate Functional Area Skill Roles', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>role</td><td>Automobile Tester</td><td>Customer Executive</td></tr></tbody></table>', 1, '2017-10-09 05:47:33', NULL),
	(429, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/delete/4', 'Delete data Automobile Developing at Functional Areas', '', 1, '2017-10-09 05:48:35', NULL),
	(430, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/edit-save/6', 'Update data  at Candidate Functional Area Skill Roles', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>role</td><td>Customer Executive</td><td>PHP Developer</td></tr></tbody></table>', 1, '2017-10-09 05:51:12', NULL),
	(431, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 202.83.38.136', '', 1, '2017-10-09 06:07:11', NULL),
	(432, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 202.83.38.136', '', 2, '2017-10-09 06:08:00', NULL),
	(433, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/menu_management/edit-save/11', 'Update data Sources Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>12</td><td></td></tr></tbody></table>', 1, '2017-10-09 06:09:12', NULL),
	(434, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/menu_management/edit-save/9', 'Update data Postal Codes Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>icon</td><td>fa fa-map-marker</td><td>fa fa-paper-plane</td></tr><tr><td>sorting</td><td>11</td><td></td></tr></tbody></table>', 1, '2017-10-09 06:22:32', NULL),
	(435, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/add-save', 'Add New Data Test Industry at Industries', '', 1, '2017-10-09 06:26:10', NULL),
	(436, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Test Industry at Industries', '', 1, '2017-10-09 06:29:36', NULL),
	(437, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 202.83.38.136', '', 1, '2017-10-09 06:30:27', NULL),
	(438, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/add-save', 'Add New Data Law Enforcement/Security Services at Industries', '', 1, '2017-10-09 06:35:17', NULL),
	(439, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Legal at Functional Areas', '', 1, '2017-10-09 06:36:41', NULL),
	(440, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/add-save', 'Add New Data Law at Functional Area Skills', '', 1, '2017-10-09 06:38:52', NULL),
	(441, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/menu_management/edit-save/9', 'Update data Postal Codes Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>icon</td><td>fa fa-paper-plane</td><td>fa fa-envelope-o</td></tr><tr><td>sorting</td><td>11</td><td></td></tr></tbody></table>', 1, '2017-10-09 06:58:26', NULL),
	(442, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/menu_management/edit-save/1', 'Update data Countries Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>10</td><td></td></tr></tbody></table>', 1, '2017-10-09 06:59:28', NULL),
	(443, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_roles/add-save', 'Add New Data Lawyer/Attorney at Industry Functional Area Roles', '', 1, '2017-10-09 07:00:18', NULL),
	(444, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/menu_management/edit-save/12', 'Update data General Skills Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>9</td><td></td></tr></tbody></table>', 1, '2017-10-09 07:00:42', NULL),
	(445, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/menu_management/edit-save/5', 'Update data Industries Master at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>8</td><td></td></tr></tbody></table>', 1, '2017-10-09 07:01:32', NULL),
	(446, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skill_notes/add-save', 'Add New Data 2 at Industry Functional Area Skill Notes', '', 1, '2017-10-09 07:03:02', NULL),
	(447, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industries/add-save', 'Add New Data 10 at Candidate Industries', '', 1, '2017-10-09 07:04:48', NULL),
	(448, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_areas/add-save', 'Add New Data 7 at Candidate Functional Areas', '', 1, '2017-10-09 07:05:38', NULL),
	(449, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_skills/add-save', 'Add New Data 10 at Candidate Functional Area Skills', '', 1, '2017-10-09 07:06:22', NULL),
	(450, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_industry_functional_area_roles/add-save', 'Add New Data 7 at Candidate Functional Area Skill Roles', '', 1, '2017-10-09 07:07:51', NULL),
	(451, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/add-save', 'Add New Data Problem solving at General Skills', '', 1, '2017-10-09 07:12:24', NULL),
	(452, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/candidate_general_skills/add-save', 'Add New Data 7 at Candidate General Skills', '', 1, '2017-10-09 07:14:04', NULL),
	(453, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/menu_management/edit-save/21', 'Update data Managers at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>icon</td><td>fa fa-glass</td><td>fa fa-group</td></tr><tr><td>sorting</td><td>4</td><td></td></tr></tbody></table>', 1, '2017-10-09 07:20:32', NULL),
	(454, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/menu_management/edit-save/22', 'Update data Recruiters at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>icon</td><td>fa fa-glass</td><td>fa fa-group</td></tr><tr><td>sorting</td><td>5</td><td></td></tr></tbody></table>', 1, '2017-10-09 07:21:43', NULL),
	(455, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/menu_management/edit-save/23', 'Update data Admins at Menu Management', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>icon</td><td>fa fa-glass</td><td>fa fa-group</td></tr><tr><td>sorting</td><td>6</td><td></td></tr></tbody></table>', 1, '2017-10-09 07:22:27', NULL),
	(456, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/general_skills/delete/4', 'Delete data Problem solving at General Skills', '', 1, '2017-10-09 07:24:46', NULL),
	(457, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_area_skills/delete/3', 'Delete data Law at Functional Area Skills', '', 1, '2017-10-09 07:31:54', NULL),
	(458, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-09 07:31:44', NULL),
	(459, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-09 07:31:48', NULL),
	(460, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidates/delete-image', 'Delete the image of Vishnu Edit at Candidates', '', 1, '2017-10-09 07:40:34', NULL),
	(461, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidates/edit-save/10', 'Update data Vishnu Edit at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody></tbody></table>', 1, '2017-10-09 07:41:03', NULL),
	(462, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidates/add-save', 'Add New Data Mubashira at Candidates', '', 1, '2017-10-09 07:55:44', NULL),
	(463, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/companies/add-save', 'Add New Data Neo Tech at Companies', '', 1, '2017-10-09 08:04:51', NULL),
	(464, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/offices/add-save', 'Add New Data Head Office at Offices', '', 1, '2017-10-09 08:55:46', NULL),
	(465, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/add-save', 'Add New Data Laravel at Functional Area Skills', '', 2, '2017-10-09 08:56:11', NULL),
	(466, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/add-save', 'Add New Data Java at Functional Area Skills', '', 2, '2017-10-09 08:56:30', NULL),
	(467, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/add-save', 'Add New Data Ruby on Rails at Functional Area Skills', '', 2, '2017-10-09 08:56:53', NULL),
	(468, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/add-save', 'Add New Data Python at Functional Area Skills', '', 2, '2017-10-09 08:57:05', NULL),
	(469, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/add-save', 'Add New Data HTML at Functional Area Skills', '', 2, '2017-10-09 08:57:23', NULL),
	(470, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/office_notes/add-save', 'Add New Data 3 at Office Notes', '', 1, '2017-10-09 08:57:28', NULL),
	(471, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/add-save', 'Add New Data Tally ERP at Functional Area Skills', '', 2, '2017-10-09 08:57:35', NULL),
	(472, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/add-save', 'Add New Data Microsoft Excel at Functional Area Skills', '', 2, '2017-10-09 08:58:00', NULL),
	(473, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/add-save', 'Add New Data English Writing at Functional Area Skills', '', 2, '2017-10-09 08:59:01', NULL),
	(474, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_roles/edit-save/1', 'Update data Software Developer at Industry Functional Area Roles', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>PHP Developer</td><td>Software Developer</td></tr></tbody></table>', 2, '2017-10-09 09:01:09', NULL),
	(475, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_roles/add-save', 'Add New Data Project Leader at Industry Functional Area Roles', '', 2, '2017-10-09 09:01:22', NULL),
	(476, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/company_industries/add-save', 'Add New Data 8 at Company Industries', '', 1, '2017-10-09 09:01:34', NULL),
	(477, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_roles/add-save', 'Add New Data Project Manager at Industry Functional Area Roles', '', 2, '2017-10-09 09:01:40', NULL),
	(478, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_roles/add-save', 'Add New Data Team Leader at Industry Functional Area Roles', '', 2, '2017-10-09 09:01:52', NULL),
	(479, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/industry_functional_area_roles/add-save', 'Add New Data Software Architect at Industry Functional Area Roles', '', 2, '2017-10-09 09:02:19', NULL),
	(480, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/qualification_levels/add-save', 'Add New Data 3 at Qualification Levels', '', 2, '2017-10-09 09:03:05', NULL),
	(481, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/qualification_levels/add-save', 'Add New Data 4 at Qualification Levels', '', 2, '2017-10-09 09:03:16', NULL),
	(482, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/office_industries/add-save', 'Add New Data 8 at Office Industries', '', 1, '2017-10-09 09:03:32', NULL),
	(483, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/qualification_levels/add-save', 'Add New Data 5 at Qualification Levels', '', 2, '2017-10-09 09:04:19', NULL),
	(484, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/qualification_levels/add-save', 'Add New Data 6 at Qualification Levels', '', 2, '2017-10-09 09:04:49', NULL),
	(485, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/qualifications/add-save', 'Add New Data 5 at Qualifications', '', 2, '2017-10-09 09:05:22', NULL),
	(486, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/qualifications/add-save', 'Add New Data 6 at Qualifications', '', 2, '2017-10-09 09:05:59', NULL),
	(487, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/qualifications/add-save', 'Add New Data 7 at Qualifications', '', 2, '2017-10-09 09:06:18', NULL),
	(488, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/job_orders/add-save', 'Add New Data PHP Laravel Developer at Job Orders', '', 1, '2017-10-09 09:12:53', NULL),
	(489, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/job_orders/add-save', 'Add New Data Wanted Accountant at Job Orders', '', 1, '2017-10-09 09:18:45', NULL),
	(490, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidate_industry_functional_area_skills/edit-save/7', 'Update data  at Candidate Functional Area Skills', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area_skill</td><td>PHP</td><td>Tally ERP</td></tr><tr><td>experience_years</td><td>0</td><td>1</td></tr><tr><td>experience_months</td><td>0</td><td>2</td></tr></tbody></table>', 1, '2017-10-09 09:22:08', NULL),
	(491, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidate_industry_functional_areas/edit-save/5', 'Update data  at Candidate Functional Areas', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td>Software</td><td>Accounting</td></tr></tbody></table>', 1, '2017-10-09 09:22:24', NULL),
	(492, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/managers/add-save', 'Add New Data Rhea Naik at Managers', '', 1, '2017-10-09 09:23:08', NULL),
	(493, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/managers/delete-image', 'Delete the image of Rhea Naik at Managers', '', 1, '2017-10-09 09:23:44', NULL),
	(494, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/managers/edit-save/3', 'Update data Rhea Naik at Managers', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>photo</td><td></td><td>uploads/1/2017-10/profile_pic_9363.jpg</td></tr><tr><td>password</td><td>$2y$10$IFcEjMkuGZRUHyOpJDMNhOGPHgCXblRDazy917OMpAUu1mNHB3.Me</td><td>$2y$10$iBfv3U1yfztOjzsxmbIiuOrmDKtBrzqEqWldeeouf4NCGjl/t0teW</td></tr><tr><td>id_cms_privileges</td><td>3</td><td></td></tr><tr><td>status</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-09 09:23:55', NULL),
	(495, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/industry_functional_area_roles/add-save', 'Add New Data Accountant at Industry Functional Area Roles', '', 1, '2017-10-09 09:25:24', NULL),
	(496, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidate_industry_functional_area_roles/add-save', 'Add New Data 8 at Candidate Functional Area Skill Roles', '', 1, '2017-10-09 09:25:45', NULL),
	(497, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidate_industry_functional_area_roles/delete/5', 'Delete data 5 at Candidate Functional Area Skill Roles', '', 1, '2017-10-09 09:25:51', NULL),
	(498, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/recruiters/add-save', 'Add New Data Neeraj Kumar at Recruiters', '', 2, '2017-10-09 09:25:53', NULL),
	(499, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/sources/add-save', 'Add New Data Friends at Sources', '', 2, '2017-10-09 09:27:43', NULL),
	(500, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/sources/add-save', 'Add New Data Dailies at Sources', '', 2, '2017-10-09 09:27:53', NULL),
	(501, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0', 'http://c2wcb.vontext.com/admin/sources/edit-save/3', 'Update data Daily at Sources', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>Dailies</td><td>Daily</td></tr></tbody></table>', 2, '2017-10-09 09:28:24', NULL),
	(502, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/countries/add-save', 'Add New Data Sri Lanka at Countries', '', 1, '2017-10-09 09:44:17', NULL),
	(503, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/states/add-save', 'Add New Data Western at States', '', 1, '2017-10-09 09:46:29', NULL),
	(504, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/cities/add-save', 'Add New Data Colombo at Cities', '', 1, '2017-10-09 09:46:56', NULL),
	(505, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidate_general_skills/add-save', 'Add New Data 7 at Candidate General Skills', '', 1, '2017-10-09 10:06:27', NULL),
	(506, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/general_skill_notes/add-save', 'Add New Data 6 at General Skill Notes', '', 1, '2017-10-09 10:07:15', NULL),
	(507, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/general_skill_notes/add-save', 'Add New Data 7 at General Skill Notes', '', 1, '2017-10-09 10:08:05', NULL),
	(508, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/general_skill_notes/delete/7', 'Delete data 7 at General Skill Notes', '', 1, '2017-10-09 10:08:26', NULL),
	(509, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/general_skill_notes/delete/2', 'Delete data 2 at General Skill Notes', '', 1, '2017-10-09 10:08:33', NULL),
	(510, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/general_skill_notes/add-save', 'Add New Data 7 at General Skill Notes', '', 1, '2017-10-09 10:11:16', NULL),
	(511, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/general_skill_notes/delete/7', 'Delete data 7 at General Skill Notes', '', 1, '2017-10-09 10:11:22', NULL),
	(512, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Law Enforcement/Security Services at Industries', '', 1, '2017-10-09 11:50:23', NULL),
	(513, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Law Enforcement/Security Services at Industries', '', 1, '2017-10-09 11:51:44', NULL),
	(514, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Law Enforcement/Security Services at Industries', '', 1, '2017-10-09 11:52:07', NULL),
	(515, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Law Enforcement/Security Services at Industries', '', 1, '2017-10-09 11:53:25', NULL),
	(516, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industries/delete/16', 'Delete data Law Enforcement/Security Services at Industries', '', 1, '2017-10-09 11:54:28', NULL),
	(517, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/industry_functional_areas/add-save', 'Add New Data Teacher at Functional Areas', '', 1, '2017-10-09 12:17:17', NULL),
	(518, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/industry_functional_areas/delete/4', 'Delete data Teacher at Functional Areas', '', 1, '2017-10-09 12:17:20', NULL),
	(519, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/industry_functional_areas/add-save', 'Add New Data Teaching at Functional Areas', '', 1, '2017-10-09 12:17:47', NULL),
	(520, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/add-save', 'Add New Data Test at Functional Area Skills', '', 1, '2017-10-09 12:18:06', NULL),
	(521, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/industry_functional_area_skills/delete/11', 'Delete data Test at Functional Area Skills', '', 1, '2017-10-09 12:18:09', NULL),
	(522, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/industry_functional_area_roles/add-save', 'Add New Data Teaching at Industry Functional Area Roles', '', 1, '2017-10-09 12:18:28', NULL),
	(523, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/industry_functional_area_roles/delete/9', 'Delete data Teaching at Industry Functional Area Roles', '', 1, '2017-10-09 12:18:32', NULL),
	(524, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/delete/2', 'Delete data Non-voice Support at Functional Areas', '', 1, '2017-10-09 12:26:01', NULL),
	(525, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/industry_functional_areas/add-save', 'Add New Data Non voice Associate at Functional Areas', '', 1, '2017-10-09 12:27:17', NULL),
	(526, '111.92.1.228', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.1.228', '', 2, '2017-10-09 12:41:51', NULL),
	(527, '111.92.1.228', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/logout', 'monu@c2w.org logout', '', 2, '2017-10-09 12:47:12', NULL),
	(528, '111.92.1.228', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.1.228', '', 2, '2017-10-09 12:47:25', NULL),
	(529, '111.92.52.79', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.79', '', 2, '2017-10-09 12:48:34', NULL),
	(530, '111.92.52.79', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/job_order_industry_functional_area_skills', 'Try view the data :name at Job Order Industry Functional Area Skills', '', 2, '2017-10-09 12:52:01', NULL),
	(531, '111.92.52.79', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/companies/add-save', 'Add New Data C2W at Companies', '', 2, '2017-10-09 12:59:09', NULL),
	(532, '111.92.52.79', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/offices/add-save', 'Add New Data CHQ at Offices', '', 2, '2017-10-09 13:06:46', NULL),
	(533, '111.92.52.79', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/office_industries/add-save', 'Add New Data 9 at Office Industries', '', 2, '2017-10-09 13:07:06', NULL),
	(534, '111.92.52.79', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/job_orders/add-save', 'Add New Data Accounts Manager at Job Orders', '', 2, '2017-10-09 13:09:44', NULL),
	(535, '111.92.52.79', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidates/edit-save/11', 'Update data Mubashira at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>postal_code</td><td>110082</td><td>695001</td></tr></tbody></table>', 2, '2017-10-09 13:16:20', NULL),
	(536, '111.92.1.228', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.1.228', '', 2, '2017-10-09 13:17:14', NULL),
	(537, '111.92.29.36', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.29.36', '', 2, '2017-10-09 17:35:27', NULL),
	(538, '123.236.66.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 123.236.66.10', '', 1, '2017-10-10 06:30:59', NULL),
	(539, '123.236.66.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/logout', 'admin@crudbooster.com logout', '', 1, '2017-10-10 06:32:25', NULL),
	(540, '123.236.66.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 123.236.66.10', '', 1, '2017-10-10 06:32:33', NULL),
	(541, '123.236.66.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/admins/delete-image', 'Delete the image of Monu G at Admins', '', 1, '2017-10-10 06:32:44', NULL),
	(542, '123.236.66.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/admins/edit-save/2', 'Update data Monu G at Admins', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>photo</td><td></td><td>uploads/1/2017-10/man.png</td></tr><tr><td>password</td><td>$2y$10$xDZ2y3ojb0uWHUsX7cwtwOJYL01as5iRQc8.JpmnIshnEUANlUBfa</td><td></td></tr><tr><td>id_cms_privileges</td><td>2</td><td></td></tr><tr><td>status</td><td></td><td></td></tr></tbody></table>', 1, '2017-10-10 06:33:21', NULL),
	(543, '111.92.52.127', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.127', '', 2, '2017-10-10 12:06:39', NULL),
	(544, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 202.83.38.136', '', 1, '2017-10-11 06:33:17', NULL),
	(545, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.7', '', 2, '2017-10-11 07:59:13', NULL),
	(546, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/job_orders/edit-save/7', 'Update data Accounts Manager at Job Orders', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>status</td><td>Hiring In Progress</td><td></td></tr></tbody></table>', 2, '2017-10-11 09:11:29', NULL),
	(547, '111.92.29.36', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.29.36', '', 2, '2017-10-11 18:44:39', NULL),
	(548, '111.92.52.79', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.79', '', 2, '2017-10-12 10:40:48', NULL),
	(549, '111.92.29.36', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.29.36', '', 2, '2017-10-12 19:35:28', NULL),
	(550, '111.92.52.103', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.103', '', 2, '2017-10-17 05:28:47', NULL),
	(551, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-19 05:38:42', NULL),
	(552, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-19 06:32:10', NULL),
	(553, '111.92.3.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 111.92.3.69', '', 1, '2017-10-19 06:48:01', NULL),
	(554, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-20 01:56:50', NULL),
	(555, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/candidates/edit-save/11', 'Update data Mubashira at Candidates', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>status</td><td></td><td></td></tr><tr><td>creator_id</td><td></td><td></td></tr><tr><td>secondary_email</td><td></td><td></td></tr><tr><td>secondary_phone</td><td></td><td></td></tr><tr><td>photo_url</td><td></td><td>uploads/1/2017-10/candidate_dafault.png</td></tr></tbody></table>', 1, '2017-10-20 02:34:00', NULL),
	(556, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-20 09:22:53', NULL),
	(557, '111.92.28.230', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.28.230', '', 2, '2017-10-20 18:38:46', NULL),
	(558, '111.92.28.230', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/candidate_industries/edit-save/8', 'Update data  at Candidate Industries', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry</td><td>IT</td><td>Bio Technology & Life Sciences</td></tr></tbody></table>', 2, '2017-10-20 18:43:49', NULL),
	(559, '111.92.52.127', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.127', '', 2, '2017-10-21 06:18:16', NULL),
	(560, '111.92.28.230', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.28.230', '', 2, '2017-10-21 17:23:29', NULL),
	(561, '111.92.28.230', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.28.230', '', 2, '2017-10-21 17:54:05', NULL),
	(562, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-24 02:28:13', NULL),
	(563, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-25 11:00:20', NULL),
	(564, '111.92.0.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 111.92.0.120', '', 1, '2017-10-25 11:43:24', NULL),
	(565, '111.92.52.103', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.103', '', 2, '2017-10-26 10:09:40', NULL),
	(566, '111.92.2.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 111.92.2.5', '', 1, '2017-10-27 05:18:24', NULL),
	(567, '111.92.52.103', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.103', '', 2, '2017-10-27 05:26:33', NULL),
	(568, '111.92.2.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 111.92.2.5', '', 1, '2017-10-27 10:01:09', NULL),
	(569, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-27 12:20:01', NULL),
	(570, '122.174.195.242', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 122.174.195.242', '', 2, '2017-10-28 05:40:39', NULL),
	(571, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.7', '', 2, '2017-10-28 09:20:47', NULL),
	(572, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/job_orders/add-save', 'Add New Data Jr Accountant at Job Orders', '', 2, '2017-10-28 11:45:21', NULL),
	(573, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-28 12:02:00', NULL),
	(574, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/sources/add-save', 'Add New Data Monster at Sources', '', 2, '2017-10-28 12:24:36', NULL),
	(575, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/sources/add-save', 'Add New Data Naukri at Sources', '', 2, '2017-10-28 12:24:43', NULL),
	(576, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/sources/add-save', 'Add New Data Indeed at Sources', '', 2, '2017-10-28 12:24:48', NULL),
	(577, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/sources/add-save', 'Add New Data Times jobs at Sources', '', 2, '2017-10-28 12:24:59', NULL),
	(578, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/sources/add-save', 'Add New Data Shine at Sources', '', 2, '2017-10-28 12:25:03', NULL),
	(579, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/companies/edit-save/1', 'Update data Cenveo Solutions at Companies', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>caption</td><td></td><td></td></tr></tbody></table>', 2, '2017-10-28 12:26:36', NULL),
	(580, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/company_industries/add-save', 'Add New Data 9 at Company Industries', '', 2, '2017-10-28 12:26:52', NULL),
	(581, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/company_industries/add-save', 'Add New Data 10 at Company Industries', '', 2, '2017-10-28 12:26:59', NULL),
	(582, '111.92.52.7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/company_industries/delete/9', 'Delete data 9 at Company Industries', '', 2, '2017-10-28 12:27:05', NULL),
	(583, '111.92.52.31', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.31', '', 2, '2017-10-30 11:24:21', NULL),
	(584, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 202.83.38.136', '', 1, '2017-10-31 08:06:31', NULL),
	(585, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://local.c2wcb.com/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-10-31 09:56:15', NULL),
	(586, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9002/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-02 07:18:46', NULL),
	(587, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9001/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-02 12:02:24', NULL),
	(588, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9001/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-03 06:17:13', NULL),
	(589, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-03 12:09:06', NULL),
	(590, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9001/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-04 04:58:15', NULL),
	(591, '111.92.52.79', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.79', '', 2, '2017-11-04 09:30:31', NULL),
	(592, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9001/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-06 05:33:08', NULL),
	(593, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9001/admin/job_orders/edit-save/1', 'Update data PHP Fresher with good comm skills at Job Orders', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>industry_functional_area</td><td></td><td>Software</td></tr><tr><td>status</td><td>Hiring In Progress</td><td></td></tr><tr><td>intro_call_date</td><td>2017-10-20</td><td></td></tr><tr><td>submission_date</td><td>2017-10-28</td><td></td></tr></tbody></table>', 1, '2017-11-06 05:41:44', NULL),
	(594, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9001/admin/recruiters/edit-save/4', 'Update data Neeraj Kumar at Recruiters', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>photo</td><td>uploads/2/2017-10/no_img_found.png</td><td></td></tr><tr><td>password</td><td>$2y$10$jOc47YaAYAz6XtCtKA25he1WD9vbzrw5KnZAsuJnwz2J11M9mmzJy</td><td></td></tr><tr><td>id_cms_privileges</td><td>4</td><td></td></tr></tbody></table>', 1, '2017-11-06 06:00:53', NULL),
	(595, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9001/admin/managers/edit-save/3', 'Update data Rhea Naik at Managers', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>primary_phone</td><td></td><td>4343434343</td></tr><tr><td>alternate_phone</td><td></td><td>4343434343</td></tr><tr><td>address</td><td></td><td>TC 4/2234, Manvila, Kazhakkoottam, Trivandrum.</td></tr><tr><td>password</td><td>$2y$10$iBfv3U1yfztOjzsxmbIiuOrmDKtBrzqEqWldeeouf4NCGjl/t0teW</td><td></td></tr><tr><td>id_cms_privileges</td><td>3</td><td></td></tr><tr><td>status</td><td></td><td></td></tr></tbody></table>', 1, '2017-11-06 07:30:49', NULL),
	(596, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9001/admin/managers/edit-save/3', 'Update data Rhea Naik at Managers', '<table class="table table-striped"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>password</td><td>$2y$10$iBfv3U1yfztOjzsxmbIiuOrmDKtBrzqEqWldeeouf4NCGjl/t0teW</td><td></td></tr><tr><td>id_cms_privileges</td><td>3</td><td></td></tr><tr><td>status</td><td></td><td></td></tr></tbody></table>', 1, '2017-11-06 09:35:43', NULL),
	(597, '111.92.52.103', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 111.92.52.103', '', 2, '2017-11-06 11:15:13', NULL),
	(598, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://localhost:9001/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-07 08:10:48', NULL),
	(599, '122.174.207.141', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 122.174.207.141', '', 2, '2017-11-08 04:18:34', NULL),
	(600, '122.174.193.189', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 122.174.193.189', '', 2, '2017-11-09 04:23:36', NULL),
	(601, '122.174.193.189', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 122.174.193.189', '', 2, '2017-11-09 09:06:27', NULL),
	(602, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-13 05:01:45', NULL),
	(603, '122.174.192.144', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 122.174.192.144', '', 2, '2017-11-13 08:17:25', NULL),
	(604, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/job_orders/add-save', 'Add New Data PHP Laravel Developer at Job Orders', '', 1, '2017-11-13 09:03:50', NULL),
	(605, '202.83.38.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 202.83.38.136', '', 1, '2017-11-13 09:42:22', NULL),
	(606, '122.174.196.101', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'monu@c2w.org login with IP Address 122.174.196.101', '', 2, '2017-11-16 03:53:41', NULL),
	(607, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-16 04:27:53', NULL),
	(608, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/job_orders/add-save', 'Add New Data SEO at Job Orders', '', 1, '2017-11-16 05:26:42', NULL),
	(609, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-16 09:16:41', NULL),
	(610, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', 'http://127.0.0.1:8000/admin/job_orders/add-save', 'Add New Data Aby Test at Job Orders', '', 1, '2017-11-16 09:38:17', NULL),
	(611, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', 'http://c2wcb.local/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-16 09:46:30', NULL),
	(612, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2017-11-16 10:38:05', NULL),
	(613, '111.92.3.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', 'http://c2wcb.vontext.com/admin/login', 'admin@crudbooster.com login with IP Address 111.92.3.14', '', 1, '2017-11-16 11:38:22', NULL);
/*!40000 ALTER TABLE `cms_logs` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_menus
CREATE TABLE IF NOT EXISTS `cms_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'url',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `id_cms_privileges` int(11) DEFAULT NULL,
  `sorting` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_menus: ~14 rows (approximately)
/*!40000 ALTER TABLE `cms_menus` DISABLE KEYS */;
INSERT INTO `cms_menus` (`id`, `name`, `type`, `path`, `color`, `icon`, `parent_id`, `is_active`, `is_dashboard`, `id_cms_privileges`, `sorting`, `created_at`, `updated_at`) VALUES
	(1, 'Countries Master', 'Route', 'AdminCountriesControllerGetIndex', 'normal', 'fa fa-globe', 0, 1, 0, 1, 11, '2017-09-26 09:56:38', '2017-10-09 06:59:28'),
	(5, 'Industries Master', 'Route', 'AdminIndustriesControllerGetIndex', 'normal', 'fa fa-building', 0, 1, 0, 1, 9, '2017-09-27 06:06:53', '2017-10-09 07:01:32'),
	(9, 'Postal Codes Master', 'Module', 'postal_codes', 'normal', 'fa fa-envelope-o', 0, 1, 0, 1, 12, '2017-09-28 10:39:53', '2017-10-09 06:58:26'),
	(11, 'Sources Master', 'Module', 'sources', 'normal', 'fa fa-paper-plane', 0, 1, 0, 1, 13, '2017-09-28 10:42:12', '2017-10-09 06:09:12'),
	(12, 'General Skills Master', 'Module', 'general_skills', 'normal', 'fa fa-check-circle', 0, 1, 0, 1, 10, '2017-09-28 10:51:47', '2017-10-09 07:00:42'),
	(16, 'Qualifications Master', 'Route', 'AdminQualificationLevelsControllerGetIndex', 'normal', 'fa fa-graduation-cap', 0, 1, 0, 1, 8, '2017-09-28 11:45:59', '2017-10-04 04:50:44'),
	(17, 'Candidates', 'Module', 'candidates', 'normal', 'fa fa-user', 0, 1, 0, 1, 2, '2017-09-28 11:58:50', '2017-10-04 04:48:51'),
	(18, 'Companies', 'Module', 'companies', 'normal', 'fa fa-bank', 0, 1, 0, 1, 3, '2017-09-29 06:03:25', '2017-10-04 04:49:34'),
	(20, 'Job Orders', 'Route', 'AdminJobOrdersControllerGetIndex', 'normal', 'fa fa-globe', 0, 1, 0, 1, 1, '2017-09-29 08:42:27', '2017-09-29 14:26:29'),
	(21, 'Managers', 'Route', 'AdminManagersControllerGetIndex', 'normal', 'fa fa-group', 0, 1, 0, 1, 5, '2017-09-29 14:07:37', '2017-10-09 07:20:32'),
	(22, 'Recruiters', 'Route', 'AdminRecruitersControllerGetIndex', 'normal', 'fa fa-group', 0, 1, 0, 1, 6, '2017-09-29 14:09:36', '2017-10-09 07:21:43'),
	(23, 'Admins', 'Route', 'AdminAdminsControllerGetIndex', 'normal', 'fa fa-group', 0, 1, 0, 1, 7, '2017-09-29 14:17:03', '2017-10-09 07:22:27'),
	(24, 'Contacts', 'Route', 'AdminCachedContactsControllerGetIndex', NULL, 'fa fa-glass', 0, 1, 0, 1, 4, '2017-11-04 08:02:36', NULL),
	(25, 'Calendar', 'Route', 'AdminCalendarControllerGetIndex', NULL, 'fa fa-glass', 0, 1, 0, 1, 14, '2017-11-13 05:28:54', NULL);
/*!40000 ALTER TABLE `cms_menus` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_menus_privileges
CREATE TABLE IF NOT EXISTS `cms_menus_privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cms_menus` int(11) DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_menus_privileges: ~45 rows (approximately)
/*!40000 ALTER TABLE `cms_menus_privileges` DISABLE KEYS */;
INSERT INTO `cms_menus_privileges` (`id`, `id_cms_menus`, `id_cms_privileges`) VALUES
	(2, 2, 1),
	(3, 3, 1),
	(4, 3, 1),
	(5, 4, 1),
	(7, 6, 1),
	(8, 7, 1),
	(9, 8, 1),
	(11, 10, 1),
	(18, 13, 1),
	(19, 14, 1),
	(20, 15, 1),
	(24, 19, 1),
	(33, 20, 2),
	(34, 20, 3),
	(35, 20, 4),
	(36, 20, 1),
	(37, 17, 2),
	(38, 17, 3),
	(39, 17, 4),
	(40, 17, 1),
	(41, 18, 2),
	(42, 18, 3),
	(43, 18, 1),
	(51, 16, 2),
	(52, 16, 3),
	(53, 16, 4),
	(54, 16, 1),
	(55, 11, 2),
	(56, 11, 1),
	(57, 9, 2),
	(58, 9, 1),
	(59, 1, 2),
	(60, 1, 1),
	(61, 12, 2),
	(62, 12, 1),
	(63, 5, 2),
	(64, 5, 1),
	(65, 21, 2),
	(66, 21, 1),
	(67, 22, 2),
	(68, 22, 3),
	(69, 22, 1),
	(70, 23, 2),
	(71, 23, 1),
	(72, 24, 1),
	(73, 25, 1);
/*!40000 ALTER TABLE `cms_menus_privileges` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_moduls
CREATE TABLE IF NOT EXISTS `cms_moduls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_protected` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_moduls: ~54 rows (approximately)
/*!40000 ALTER TABLE `cms_moduls` DISABLE KEYS */;
INSERT INTO `cms_moduls` (`id`, `name`, `icon`, `path`, `table_name`, `controller`, `is_protected`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Notifications', 'fa fa-cog', 'notifications', 'cms_notifications', 'NotificationsController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(2, 'Privileges', 'fa fa-cog', 'privileges', 'cms_privileges', 'PrivilegesController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(3, 'Privileges Roles', 'fa fa-cog', 'privileges_roles', 'cms_privileges_roles', 'PrivilegesRolesController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(4, 'Users Management', 'fa fa-users', 'users', 'cms_users', 'AdminCmsUsersController', 0, 1, '2017-09-26 07:32:55', NULL, NULL),
	(5, 'Settings', 'fa fa-cog', 'settings', 'cms_settings', 'SettingsController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(6, 'Module Generator', 'fa fa-database', 'module_generator', 'cms_moduls', 'ModulsController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(7, 'Menu Management', 'fa fa-bars', 'menu_management', 'cms_menus', 'MenusController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(8, 'Email Templates', 'fa fa-envelope-o', 'email_templates', 'cms_email_templates', 'EmailTemplatesController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(9, 'Statistic Builder', 'fa fa-dashboard', 'statistic_builder', 'cms_statistics', 'StatisticBuilderController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(10, 'API Generator', 'fa fa-cloud-download', 'api_generator', '', 'ApiCustomController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(11, 'Log User Access', 'fa fa-flag-o', 'logs', 'cms_logs', 'LogsController', 1, 1, '2017-09-26 07:32:55', NULL, NULL),
	(12, 'Countries', 'fa fa-globe', 'countries', 'countries', 'AdminCountriesController', 0, 0, '2017-09-26 09:56:38', NULL, NULL),
	(13, 'States', 'fa fa-glass', 'states', 'states', 'AdminStatesController', 0, 0, '2017-09-26 09:59:25', NULL, NULL),
	(14, 'Cities', 'fa fa-glass', 'cities', 'cities', 'AdminCitiesController', 0, 0, '2017-09-26 10:03:04', NULL, NULL),
	(20, 'Industries', 'fa fa-building', 'industries', 'industries', 'AdminIndustriesController', 0, 0, '2017-09-27 06:06:53', NULL, NULL),
	(36, 'Postal Codes', 'fa fa-map-marker', 'postal_codes', 'postal_codes', 'AdminPostalCodesController', 0, 0, '2017-09-28 10:39:52', NULL, NULL),
	(37, 'Functional Areas', 'fa fa-glass', 'industry_functional_areas', 'industry_functional_areas', 'AdminIndustryFunctionalAreasController', 0, 0, '2017-09-28 10:41:50', NULL, NULL),
	(38, 'Sources', 'fa fa-paper-plane', 'sources', 'sources', 'AdminSourcesController', 0, 0, '2017-09-28 10:42:12', NULL, NULL),
	(39, 'General Skills', 'fa fa-check-circle', 'general_skills', 'general_skills', 'AdminGeneralSkillsController', 0, 0, '2017-09-28 10:51:47', NULL, NULL),
	(40, 'Functional Area Skills', 'fa fa-glass', 'industry_functional_area_skills', 'industry_functional_area_skills', 'AdminIndustryFunctionalAreaSkillsController', 0, 0, '2017-09-28 10:53:49', NULL, NULL),
	(41, 'General Skill Notes', 'fa fa-glass', 'general_skill_notes', 'general_skill_notes', 'AdminGeneralSkillNotesController', 0, 0, '2017-09-28 10:55:21', NULL, NULL),
	(42, 'Industry Functional Area Skill Notes', 'fa fa-glass', 'industry_functional_area_skill_notes', 'industry_functional_area_skill_notes', 'AdminIndustryFunctionalAreaSkillNotesController', 0, 0, '2017-09-28 11:13:27', NULL, NULL),
	(43, 'Industry Functional Area Roles', 'fa fa-glass', 'industry_functional_area_roles', 'industry_functional_area_roles', 'AdminIndustryFunctionalAreaRolesController', 0, 0, '2017-09-28 11:30:05', NULL, NULL),
	(44, 'Candidates', 'fa fa-user', 'candidates', 'candidates', 'AdminCandidatesController', 0, 0, '2017-09-28 11:39:57', NULL, NULL),
	(45, 'Candidate Resumes', 'fa fa-glass', 'candidate_resumes', 'candidate_resumes', 'AdminCandidateResumesController', 0, 0, '2017-09-28 11:44:04', NULL, NULL),
	(46, 'Qualification Levels', 'fa fa-graduation-cap', 'qualification_levels', 'qualification_levels', 'AdminQualificationLevelsController', 0, 0, '2017-09-28 11:45:58', NULL, NULL),
	(47, 'Qualifications', 'fa fa-graduation-cap', 'qualifications', 'qualifications', 'AdminQualificationsController', 0, 0, '2017-09-28 11:49:59', NULL, NULL),
	(48, 'Resumes', 'fa fa-glass', 'resumes', 'resumes', 'AdminResumesController', 0, 0, '2017-09-28 11:54:26', NULL, NULL),
	(49, 'Candidate Industries', 'fa fa-glass', 'candidate_industries', 'candidate_industries', 'AdminCandidateIndustriesController', 0, 0, '2017-09-29 05:31:09', NULL, NULL),
	(50, 'Candidate Functional Areas', 'fa fa-glass', 'candidate_industry_functional_areas', 'candidate_industry_functional_areas', 'AdminCandidateIndustryFunctionalAreasController', 0, 0, '2017-09-29 06:09:05', NULL, NULL),
	(51, 'Candidate Notes', 'fa fa-glass', 'candidate_notes', 'candidate_notes', 'AdminCandidateNotesController', 0, 0, '2017-09-29 06:20:14', NULL, NULL),
	(52, 'Candidate Qualifications', 'fa fa-glass', 'candidate_qualifications', 'candidate_qualifications', 'AdminCandidateQualificationsController', 0, 0, '2017-09-29 06:30:54', NULL, NULL),
	(53, 'Companies', 'fa fa-bank', 'companies', 'companies', 'AdminCompaniesController', 0, 0, '2017-09-29 06:03:25', NULL, NULL),
	(54, 'Candidate Functional Area Skills', 'fa fa-glass', 'candidate_industry_functional_area_skills', 'candidate_industry_functional_area_skills', 'AdminCandidateIndustryFunctionalAreaSkillsController', 0, 0, '2017-09-29 08:31:05', NULL, NULL),
	(55, 'Job Orders', 'fa fa-list', 'job_orders', 'job_orders', 'AdminJobOrdersController', 0, 0, '2017-09-29 08:42:24', NULL, NULL),
	(56, 'Candidate Functional Area Skill Roles', 'fa fa-glass', 'candidate_industry_functional_area_roles', 'candidate_industry_functional_area_roles', 'AdminCandidateIndustryFunctionalAreaRolesController', 0, 0, '2017-09-29 08:54:17', NULL, NULL),
	(57, 'Company Industries', 'fa fa-glass', 'company_industries', 'company_industries', 'AdminCompanyIndustriesController', 0, 0, '2017-09-29 09:28:26', NULL, NULL),
	(58, 'Candidate General Skills', 'fa fa-glass', 'candidate_general_skills', 'candidate_general_skills', 'AdminCandidateGeneralSkillsController', 0, 0, '2017-09-29 09:29:20', NULL, NULL),
	(59, 'Company Notes', 'fa fa-glass', 'company_notes', 'company_notes', 'AdminCompanyNotesController', 0, 0, '2017-09-29 09:52:37', NULL, NULL),
	(60, 'Office Industries', 'fa fa-glass', 'office_industries', 'office_industries', 'AdminOfficeIndustriesController', 0, 0, '2017-09-29 10:08:36', NULL, NULL),
	(61, 'Office Notes', 'fa fa-glass', 'office_notes', 'office_notes', 'AdminOfficeNotesController', 0, 0, '2017-09-29 10:13:28', NULL, NULL),
	(63, 'Offices', 'fa fa-glass', 'offices', 'offices', 'AdminOfficesController', 0, 0, '2017-09-29 10:31:59', NULL, NULL),
	(64, 'Managers', 'fa fa-glass', 'managers', 'cms_users', 'AdminManagersController', 0, 0, '2017-09-29 14:07:36', NULL, NULL),
	(65, 'Recruiters', 'fa fa-glass', 'recruiters', 'cms_users', 'AdminRecruitersController', 0, 0, '2017-09-29 14:09:35', NULL, NULL),
	(66, 'Admins', 'fa fa-glass', 'admins', 'cms_users', 'AdminAdminsController', 0, 0, '2017-09-29 14:17:02', NULL, NULL),
	(67, 'Events', 'fa fa-glass', 'events', 'events', 'AdminEventsController', 0, 0, '2017-09-29 15:51:03', NULL, NULL),
	(68, 'Event Notes', 'fa fa-glass', 'event_notes', 'event_notes', 'AdminEventNotesController', 0, 0, '2017-09-29 15:55:58', NULL, NULL),
	(69, 'Job Order General Skills', 'fa fa-glass', 'job_order_general_skills', 'job_order_general_skills', 'AdminJobOrderGeneralSkillsController', 0, 0, '2017-09-30 06:37:13', NULL, NULL),
	(70, 'Job Order Industry Functional Areas', 'fa fa-glass', 'job_order_industry_functional_areas', 'job_order_industry_functional_areas', 'AdminJobOrderIndustryFunctionalAreasController', 0, 0, '2017-09-30 09:56:10', NULL, NULL),
	(71, 'Job Order Preferences', 'fa fa-glass', 'job_order_preferences', 'job_order_preferences', 'AdminJobOrderPreferencesController', 0, 0, '2017-09-30 10:28:38', NULL, NULL),
	(72, 'Job Order Notes', 'fa fa-glass', 'job_order_notes', 'job_order_notes', 'AdminJobOrderNotesController', 0, 0, '2017-09-30 11:25:23', NULL, NULL),
	(73, 'Job Order Applicants', 'fa fa-glass', 'job_order_applicants', 'job_order_applicants', 'AdminJobOrderApplicantsController', 0, 0, '2017-10-01 09:55:55', NULL, NULL),
	(74, 'Job Order Industry Functional Area Skills', 'fa fa-glass', 'job_order_industry_functional_area_skills', 'job_order_industry_functional_area_skills', 'AdminJobOrderIndustryFunctionalAreaSkillsController', 0, 0, '2017-10-05 09:21:26', NULL, NULL),
	(75, 'Contacts', 'fa fa-glass', 'cached_contacts', 'cached_contacts', 'AdminCachedContactsController', 0, 0, '2017-11-04 08:02:25', NULL, NULL),
	(76, 'Calendar', 'fa fa-glass', 'calendar', 'events', 'AdminCalendarController', 0, 0, '2017-11-13 05:28:43', NULL, NULL);
/*!40000 ALTER TABLE `cms_moduls` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_notifications
CREATE TABLE IF NOT EXISTS `cms_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cms_users` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_notifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_notifications` DISABLE KEYS */;
INSERT INTO `cms_notifications` (`id`, `id_cms_users`, `content`, `url`, `is_read`, `created_at`, `updated_at`) VALUES
	(1, 1, 'New Job Order added', '/blah', 1, NULL, NULL);
/*!40000 ALTER TABLE `cms_notifications` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_privileges
CREATE TABLE IF NOT EXISTS `cms_privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_superadmin` tinyint(1) DEFAULT NULL,
  `theme_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_privileges: ~4 rows (approximately)
/*!40000 ALTER TABLE `cms_privileges` DISABLE KEYS */;
INSERT INTO `cms_privileges` (`id`, `name`, `is_superadmin`, `theme_color`, `created_at`, `updated_at`) VALUES
	(1, 'Super Administrator', 1, 'skin-red', '2017-09-26 07:32:55', NULL),
	(2, 'Admin', 0, 'skin-yellow', NULL, NULL),
	(3, 'Manager', 0, 'skin-purple', NULL, NULL),
	(4, 'Recruiter', 0, 'skin-green', NULL, NULL);
/*!40000 ALTER TABLE `cms_privileges` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_privileges_roles
CREATE TABLE IF NOT EXISTS `cms_privileges_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_visible` tinyint(1) DEFAULT NULL,
  `is_create` tinyint(1) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `is_edit` tinyint(1) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `id_cms_moduls` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_privileges_roles: ~183 rows (approximately)
/*!40000 ALTER TABLE `cms_privileges_roles` DISABLE KEYS */;
INSERT INTO `cms_privileges_roles` (`id`, `is_visible`, `is_create`, `is_read`, `is_edit`, `is_delete`, `id_cms_privileges`, `id_cms_moduls`, `created_at`, `updated_at`) VALUES
	(1, 1, 0, 0, 0, 0, 1, 1, '2017-09-26 07:32:55', NULL),
	(2, 1, 1, 1, 1, 1, 1, 2, '2017-09-26 07:32:55', NULL),
	(3, 0, 1, 1, 1, 1, 1, 3, '2017-09-26 07:32:55', NULL),
	(4, 1, 1, 1, 1, 1, 1, 4, '2017-09-26 07:32:55', NULL),
	(5, 1, 1, 1, 1, 1, 1, 5, '2017-09-26 07:32:55', NULL),
	(6, 1, 1, 1, 1, 1, 1, 6, '2017-09-26 07:32:55', NULL),
	(7, 1, 1, 1, 1, 1, 1, 7, '2017-09-26 07:32:55', NULL),
	(8, 1, 1, 1, 1, 1, 1, 8, '2017-09-26 07:32:55', NULL),
	(9, 1, 1, 1, 1, 1, 1, 9, '2017-09-26 07:32:55', NULL),
	(10, 1, 1, 1, 1, 1, 1, 10, '2017-09-26 07:32:55', NULL),
	(11, 1, 0, 1, 0, 1, 1, 11, '2017-09-26 07:32:55', NULL),
	(12, 1, 1, 1, 1, 1, 1, 12, NULL, NULL),
	(13, 1, 1, 1, 1, 1, 1, 13, NULL, NULL),
	(14, 1, 1, 1, 1, 1, 1, 14, NULL, NULL),
	(15, 1, 1, 1, 1, 1, 1, 15, NULL, NULL),
	(16, 1, 1, 1, 1, 1, 1, 16, NULL, NULL),
	(17, 1, 1, 1, 1, 1, 1, 17, NULL, NULL),
	(18, 1, 1, 1, 1, 1, 1, 18, NULL, NULL),
	(19, 1, 1, 1, 1, 1, 1, 19, NULL, NULL),
	(20, 1, 1, 1, 1, 1, 1, 20, NULL, NULL),
	(21, 1, 1, 1, 1, 1, 1, 21, NULL, NULL),
	(22, 1, 1, 1, 1, 1, 1, 22, NULL, NULL),
	(23, 1, 1, 1, 1, 1, 1, 23, NULL, NULL),
	(24, 1, 1, 1, 1, 1, 1, 24, NULL, NULL),
	(25, 1, 1, 1, 1, 1, 1, 25, NULL, NULL),
	(26, 1, 1, 1, 1, 1, 1, 26, NULL, NULL),
	(27, 1, 1, 1, 1, 1, 1, 27, NULL, NULL),
	(28, 1, 1, 1, 1, 1, 1, 28, NULL, NULL),
	(29, 1, 1, 1, 1, 1, 1, 29, NULL, NULL),
	(30, 1, 1, 1, 1, 1, 1, 30, NULL, NULL),
	(31, 1, 1, 1, 1, 1, 1, 31, NULL, NULL),
	(32, 1, 1, 1, 1, 1, 1, 32, NULL, NULL),
	(33, 1, 1, 1, 1, 1, 1, 33, NULL, NULL),
	(34, 1, 1, 1, 1, 1, 1, 34, NULL, NULL),
	(35, 1, 1, 1, 1, 1, 1, 35, NULL, NULL),
	(36, 1, 1, 1, 1, 1, 1, 36, NULL, NULL),
	(37, 1, 1, 1, 1, 1, 1, 37, NULL, NULL),
	(38, 1, 1, 1, 1, 1, 1, 38, NULL, NULL),
	(39, 1, 1, 1, 1, 1, 1, 39, NULL, NULL),
	(40, 1, 1, 1, 1, 1, 1, 40, NULL, NULL),
	(41, 1, 1, 1, 1, 1, 1, 41, NULL, NULL),
	(42, 1, 1, 1, 1, 1, 1, 42, NULL, NULL),
	(43, 1, 1, 1, 1, 1, 1, 43, NULL, NULL),
	(44, 1, 1, 1, 1, 1, 1, 44, NULL, NULL),
	(45, 1, 1, 1, 1, 1, 1, 45, NULL, NULL),
	(46, 1, 1, 1, 1, 1, 1, 46, NULL, NULL),
	(47, 1, 1, 1, 1, 1, 1, 47, NULL, NULL),
	(48, 1, 1, 1, 1, 1, 1, 48, NULL, NULL),
	(49, 1, 1, 1, 1, 1, 1, 49, NULL, NULL),
	(50, 1, 1, 1, 1, 1, 1, 50, NULL, NULL),
	(51, 1, 1, 1, 1, 1, 1, 51, NULL, NULL),
	(52, 1, 1, 1, 1, 1, 1, 52, NULL, NULL),
	(53, 1, 1, 1, 1, 1, 1, 54, NULL, NULL),
	(54, 1, 1, 1, 1, 1, 1, 55, NULL, NULL),
	(55, 1, 1, 1, 1, 1, 1, 56, NULL, NULL),
	(56, 1, 1, 1, 1, 1, 2, 16, NULL, NULL),
	(57, 1, 1, 1, 1, 1, 2, 44, NULL, NULL),
	(58, 1, 1, 1, 1, 1, 2, 49, NULL, NULL),
	(59, 1, 1, 1, 1, 1, 2, 28, NULL, NULL),
	(60, 1, 1, 1, 1, 1, 2, 50, NULL, NULL),
	(61, 1, 1, 1, 1, 1, 2, 30, NULL, NULL),
	(62, 1, 1, 1, 1, 1, 2, 54, NULL, NULL),
	(63, 1, 1, 1, 1, 1, 2, 26, NULL, NULL),
	(64, 1, 1, 1, 1, 1, 2, 51, NULL, NULL),
	(65, 1, 1, 1, 1, 1, 2, 33, NULL, NULL),
	(66, 1, 1, 1, 1, 1, 2, 52, NULL, NULL),
	(67, 1, 1, 1, 1, 1, 2, 45, NULL, NULL),
	(68, 1, 1, 1, 1, 1, 2, 15, NULL, NULL),
	(69, 1, 1, 1, 1, 1, 2, 14, NULL, NULL),
	(70, 1, 1, 1, 1, 1, 2, 19, NULL, NULL),
	(71, 1, 1, 1, 1, 1, 2, 53, NULL, NULL),
	(72, 1, 1, 1, 1, 1, 2, 29, NULL, NULL),
	(73, 1, 1, 1, 1, 1, 2, 32, NULL, NULL),
	(74, 1, 1, 1, 1, 1, 2, 27, NULL, NULL),
	(75, 1, 1, 1, 1, 1, 2, 12, NULL, NULL),
	(76, 1, 1, 1, 1, 1, 2, 17, NULL, NULL),
	(77, 1, 1, 1, 1, 1, 2, 37, NULL, NULL),
	(78, 1, 1, 1, 1, 1, 2, 40, NULL, NULL),
	(79, 1, 1, 1, 1, 1, 2, 41, NULL, NULL),
	(80, 1, 1, 1, 1, 1, 2, 39, NULL, NULL),
	(81, 1, 1, 1, 1, 1, 2, 25, NULL, NULL),
	(82, 1, 1, 1, 1, 1, 2, 20, NULL, NULL),
	(83, 1, 1, 1, 1, 1, 2, 22, NULL, NULL),
	(84, 1, 1, 1, 1, 1, 2, 34, NULL, NULL),
	(85, 1, 1, 1, 1, 1, 2, 21, NULL, NULL),
	(86, 1, 1, 1, 1, 1, 2, 24, NULL, NULL),
	(87, 1, 1, 1, 1, 1, 2, 35, NULL, NULL),
	(88, 1, 1, 1, 1, 1, 2, 43, NULL, NULL),
	(89, 1, 1, 1, 1, 1, 2, 42, NULL, NULL),
	(90, 1, 1, 1, 1, 1, 2, 18, NULL, NULL),
	(91, 1, 1, 1, 1, 1, 2, 55, NULL, NULL),
	(92, 1, 1, 1, 1, 1, 2, 31, NULL, NULL),
	(93, 1, 1, 1, 1, 1, 2, 23, NULL, NULL),
	(94, 1, 1, 1, 1, 1, 2, 36, NULL, NULL),
	(95, 1, 1, 1, 1, 1, 2, 46, NULL, NULL),
	(96, 1, 1, 1, 1, 1, 2, 47, NULL, NULL),
	(97, 1, 1, 1, 1, 1, 2, 48, NULL, NULL),
	(98, 1, 1, 1, 1, 1, 2, 38, NULL, NULL),
	(99, 1, 1, 1, 1, 1, 2, 13, NULL, NULL),
	(100, 1, 1, 1, 1, 1, 2, 4, NULL, NULL),
	(101, 1, 1, 1, 1, 1, 3, 56, NULL, NULL),
	(102, 1, 1, 1, 1, 1, 3, 54, NULL, NULL),
	(103, 1, 1, 1, 1, 1, 3, 50, NULL, NULL),
	(104, 1, 1, 1, 1, 1, 3, 49, NULL, NULL),
	(105, 1, 1, 1, 1, 1, 3, 51, NULL, NULL),
	(106, 1, 1, 1, 1, 1, 3, 52, NULL, NULL),
	(107, 1, 1, 1, 1, 1, 3, 45, NULL, NULL),
	(108, 1, 1, 1, 1, 1, 3, 44, NULL, NULL),
	(109, 1, 1, 1, 1, 1, 3, 14, NULL, NULL),
	(110, 1, 1, 1, 1, 1, 3, 53, NULL, NULL),
	(111, 1, 1, 1, 1, 1, 3, 12, NULL, NULL),
	(112, 1, 1, 1, 1, 1, 3, 40, NULL, NULL),
	(113, 1, 1, 1, 1, 1, 3, 37, NULL, NULL),
	(114, 1, 1, 1, 1, 1, 3, 41, NULL, NULL),
	(115, 1, 1, 1, 1, 1, 3, 39, NULL, NULL),
	(116, 1, 1, 1, 1, 1, 3, 20, NULL, NULL),
	(117, 1, 1, 1, 1, 1, 3, 43, NULL, NULL),
	(118, 1, 1, 1, 1, 1, 3, 42, NULL, NULL),
	(119, 1, 1, 1, 1, 1, 3, 55, NULL, NULL),
	(120, 1, 1, 1, 1, 1, 3, 36, NULL, NULL),
	(121, 1, 1, 1, 1, 1, 3, 46, NULL, NULL),
	(122, 1, 1, 1, 1, 1, 3, 47, NULL, NULL),
	(123, 1, 1, 1, 1, 1, 3, 48, NULL, NULL),
	(124, 1, 1, 1, 1, 1, 3, 38, NULL, NULL),
	(125, 1, 1, 1, 1, 1, 3, 13, NULL, NULL),
	(126, 1, 1, 1, 1, 1, 4, 56, NULL, NULL),
	(127, 1, 1, 1, 1, 1, 4, 54, NULL, NULL),
	(128, 1, 1, 1, 1, 1, 4, 50, NULL, NULL),
	(129, 1, 1, 1, 1, 1, 4, 49, NULL, NULL),
	(130, 1, 1, 1, 1, 0, 4, 51, NULL, NULL),
	(131, 1, 1, 1, 1, 1, 4, 52, NULL, NULL),
	(132, 1, 1, 1, 1, 1, 4, 45, NULL, NULL),
	(133, 1, 1, 1, 1, 0, 4, 44, NULL, NULL),
	(134, 1, 1, 1, 1, 0, 4, 14, NULL, NULL),
	(135, 1, 1, 1, 1, 0, 4, 12, NULL, NULL),
	(136, 1, 1, 1, 1, 0, 4, 40, NULL, NULL),
	(137, 1, 1, 1, 1, 0, 4, 37, NULL, NULL),
	(138, 1, 1, 1, 1, 0, 4, 41, NULL, NULL),
	(139, 1, 1, 1, 1, 0, 4, 39, NULL, NULL),
	(140, 1, 1, 1, 1, 0, 4, 20, NULL, NULL),
	(141, 1, 1, 1, 1, 0, 4, 43, NULL, NULL),
	(142, 1, 1, 1, 1, 0, 4, 42, NULL, NULL),
	(143, 1, 1, 1, 1, 0, 4, 55, NULL, NULL),
	(144, 1, 1, 1, 1, 0, 4, 36, NULL, NULL),
	(145, 1, 1, 1, 1, 0, 4, 46, NULL, NULL),
	(146, 1, 1, 1, 1, 0, 4, 47, NULL, NULL),
	(147, 1, 1, 1, 1, 0, 4, 48, NULL, NULL),
	(148, 1, 1, 1, 1, 0, 4, 38, NULL, NULL),
	(149, 1, 1, 1, 1, 0, 4, 13, NULL, NULL),
	(150, 1, 1, 1, 1, 1, 1, 57, NULL, NULL),
	(151, 1, 1, 1, 1, 1, 1, 58, NULL, NULL),
	(152, 1, 1, 1, 1, 1, 1, 59, NULL, NULL),
	(153, 1, 1, 1, 1, 1, 1, 60, NULL, NULL),
	(154, 1, 1, 1, 1, 1, 1, 61, NULL, NULL),
	(155, 1, 1, 1, 1, 1, 1, 62, NULL, NULL),
	(156, 1, 1, 1, 1, 1, 1, 63, NULL, NULL),
	(157, 1, 1, 1, 1, 1, 1, 64, NULL, NULL),
	(158, 1, 1, 1, 1, 1, 1, 65, NULL, NULL),
	(159, 1, 1, 1, 1, 1, 1, 66, NULL, NULL),
	(160, 1, 1, 1, 1, 1, 2, 66, NULL, NULL),
	(161, 1, 1, 1, 1, 1, 2, 56, NULL, NULL),
	(162, 1, 1, 1, 1, 1, 2, 58, NULL, NULL),
	(163, 1, 1, 1, 1, 1, 2, 57, NULL, NULL),
	(164, 1, 1, 1, 1, 1, 2, 59, NULL, NULL),
	(165, 1, 1, 1, 1, 1, 2, 64, NULL, NULL),
	(166, 1, 1, 1, 1, 1, 2, 60, NULL, NULL),
	(167, 1, 1, 1, 1, 1, 2, 61, NULL, NULL),
	(168, 1, 1, 1, 1, 1, 2, 63, NULL, NULL),
	(169, 1, 1, 1, 1, 1, 2, 65, NULL, NULL),
	(170, 1, 1, 1, 1, 1, 1, 67, NULL, NULL),
	(171, 1, 1, 1, 1, 1, 1, 68, NULL, NULL),
	(172, 1, 1, 1, 1, 1, 1, 69, NULL, NULL),
	(173, 1, 1, 1, 1, 1, 1, 70, NULL, NULL),
	(174, 1, 1, 1, 1, 1, 1, 71, NULL, NULL),
	(175, 1, 1, 1, 1, 1, 1, 72, NULL, NULL),
	(176, 1, 1, 1, 1, 1, 1, 73, NULL, NULL),
	(177, 1, 1, 1, 1, 1, 2, 68, NULL, NULL),
	(178, 1, 1, 1, 1, 1, 2, 67, NULL, NULL),
	(179, 1, 1, 1, 1, 1, 2, 73, NULL, NULL),
	(180, 1, 1, 1, 1, 1, 2, 69, NULL, NULL),
	(181, 1, 1, 1, 1, 1, 2, 70, NULL, NULL),
	(182, 1, 1, 1, 1, 1, 2, 72, NULL, NULL),
	(183, 1, 1, 1, 1, 1, 2, 71, NULL, NULL),
	(184, 1, 1, 1, 1, 1, 1, 74, NULL, NULL),
	(185, 1, 1, 1, 1, 1, 1, 75, NULL, NULL),
	(186, 1, 1, 1, 1, 1, 1, 76, NULL, NULL);
/*!40000 ALTER TABLE `cms_privileges_roles` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_settings
CREATE TABLE IF NOT EXISTS `cms_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `content_input_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dataenum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `helper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_setting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_settings: ~16 rows (approximately)
/*!40000 ALTER TABLE `cms_settings` DISABLE KEYS */;
INSERT INTO `cms_settings` (`id`, `name`, `content`, `content_input_type`, `dataenum`, `helper`, `created_at`, `updated_at`, `group_setting`, `label`) VALUES
	(1, 'login_background_color', NULL, 'text', NULL, 'Input hexacode', '2017-09-26 07:32:55', NULL, 'Login Register Style', 'Login Background Color'),
	(2, 'login_font_color', NULL, 'text', NULL, 'Input hexacode', '2017-09-26 07:32:55', NULL, 'Login Register Style', 'Login Font Color'),
	(3, 'login_background_image', NULL, 'upload_image', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Login Register Style', 'Login Background Image'),
	(4, 'email_sender', 'support@crudbooster.com', 'text', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Email Setting', 'Email Sender'),
	(5, 'smtp_driver', 'mail', 'select', 'smtp,mail,sendmail', NULL, '2017-09-26 07:32:55', NULL, 'Email Setting', 'Mail Driver'),
	(6, 'smtp_host', '', 'text', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Email Setting', 'SMTP Host'),
	(7, 'smtp_port', '25', 'text', NULL, 'default 25', '2017-09-26 07:32:55', NULL, 'Email Setting', 'SMTP Port'),
	(8, 'smtp_username', '', 'text', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Email Setting', 'SMTP Username'),
	(9, 'smtp_password', '', 'text', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Email Setting', 'SMTP Password'),
	(10, 'appname', 'C2W', 'text', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Application Setting', 'Application Name'),
	(11, 'default_paper_size', 'Legal', 'text', NULL, 'Paper size, ex : A4, Legal, etc', '2017-09-26 07:32:55', NULL, 'Application Setting', 'Default Paper Print Size'),
	(12, 'logo', '/logo.png', 'upload_image', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Application Setting', 'Logo'),
	(13, 'favicon', NULL, 'upload_image', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Application Setting', 'Favicon'),
	(14, 'api_debug_mode', 'true', 'select', 'true,false', NULL, '2017-09-26 07:32:55', NULL, 'Application Setting', 'API Debug Mode'),
	(15, 'google_api_key', NULL, 'text', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Application Setting', 'Google API Key'),
	(16, 'google_fcm_key', NULL, 'text', NULL, NULL, '2017-09-26 07:32:55', NULL, 'Application Setting', 'Google FCM Key');
/*!40000 ALTER TABLE `cms_settings` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_statistics
CREATE TABLE IF NOT EXISTS `cms_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_statistics: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_statistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_statistics` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_statistic_components
CREATE TABLE IF NOT EXISTS `cms_statistic_components` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cms_statistics` int(11) DEFAULT NULL,
  `componentID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_statistic_components: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_statistic_components` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_statistic_components` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.cms_users
CREATE TABLE IF NOT EXISTS `cms_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.cms_users: ~4 rows (approximately)
/*!40000 ALTER TABLE `cms_users` DISABLE KEYS */;
INSERT INTO `cms_users` (`id`, `name`, `photo`, `email`, `primary_phone`, `alternate_phone`, `address`, `password`, `id_cms_privileges`, `created_at`, `updated_at`, `status`) VALUES
	(1, 'Super Admin', NULL, 'admin@crudbooster.com', NULL, NULL, NULL, '$2y$10$U6RxyGnAVLQrj8H3DEyp/OVaOVRF7cCgo.3lFcrqdebhbhMZDsY92', 1, '2017-09-26 07:32:55', NULL, 'Active'),
	(2, 'Monu G', 'uploads/1/2017-10/man.png', 'monu@c2w.org', NULL, NULL, NULL, '$2y$10$xDZ2y3ojb0uWHUsX7cwtwOJYL01as5iRQc8.JpmnIshnEUANlUBfa', 2, '2017-09-29 14:20:30', '2017-10-10 06:33:21', NULL),
	(3, 'Rhea Naik', 'uploads/1/2017-10/profile_pic_9363.jpg', 'rhea@mail.com', '4343434343', '4343434343', 'TC 4/2234, Manvila, Kazhakkoottam, Trivandrum.', '$2y$10$iBfv3U1yfztOjzsxmbIiuOrmDKtBrzqEqWldeeouf4NCGjl/t0teW', 3, '2017-10-09 09:23:07', '2017-11-06 09:35:43', NULL),
	(4, 'Neeraj Kumar', NULL, 'neeraj@mail.com', '1212121212', '2121212121', 'Flat No.201, SFS, kazhakkoottam, Trivandrum', '$2y$10$jOc47YaAYAz6XtCtKA25he1WD9vbzrw5KnZAsuJnwz2J11M9mmzJy', 4, '2017-10-09 09:25:53', '2017-11-06 06:00:53', NULL);
/*!40000 ALTER TABLE `cms_users` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `web_site` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `founded_date` date DEFAULT NULL,
  `team_strength` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contract_rate` decimal(6,2) NOT NULL,
  `logo_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `primary_contact_name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `primary_contact_email` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `primary_contact_phone` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `secondary_contact_name` tinytext COLLATE utf8_unicode_ci,
  `secondary_contact_email` tinytext COLLATE utf8_unicode_ci,
  `secondary_contact_phone` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.companies: ~4 rows (approximately)
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` (`id`, `name`, `web_site`, `founded_date`, `team_strength`, `contract_rate`, `logo_url`, `caption`, `status`, `created_at`, `updated_at`, `primary_contact_name`, `primary_contact_email`, `primary_contact_phone`, `secondary_contact_name`, `secondary_contact_email`, `secondary_contact_phone`) VALUES
	(1, 'Cenveo Solutions', 'www.cenveosolutions.com', '2012-06-06', '45', 9.00, 'uploads/1/2017-10/logo_1st_draft.png', '', 1, '2017-09-27 06:36:53', '2017-10-28 12:26:36', 'Samitha Nair', 'sam@cenveosolutions.com', '5678123456', 'Mohammad Rafi', 'rafi@cenveosolutions.com', '3456789012'),
	(2, 'Abyssis', 'abyssis.com', '2016-06-28', '4', 7.00, NULL, '', 1, '2017-09-29 06:50:13', '2017-10-06 06:05:25', 'Akhil', 'Akhil@mail.com', '7894561230', 'Rahul', 'rahul@mail.com', '4561230898'),
	(3, 'Neo Tech', 'neotechnologies.com', '2015-11-02', '25', 7.00, NULL, 'NewInnovations', 1, '2017-10-09 08:04:51', NULL, 'Sid', 'sid@mail.com', '7485963210', 'Anand', 'anand@msil.com', '859632174'),
	(4, 'C2W', 'www.c2w.org', '2017-07-04', '15', 8.33, 'uploads/2/2017-10/images.png', NULL, 1, '2017-10-09 12:59:09', NULL, 'Karthic', 'Karthic@c2w.org', '8183947770', 'Willard', 'Wiil@c2w.org', '04714011026');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.company_industries
CREATE TABLE IF NOT EXISTS `company_industries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `industry` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  PRIMARY KEY (`id`),
  KEY `company_industries_company_id_foreign` (`company_id`),
  CONSTRAINT `company_industries_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.company_industries: ~6 rows (approximately)
/*!40000 ALTER TABLE `company_industries` DISABLE KEYS */;
INSERT INTO `company_industries` (`id`, `company_id`, `industry`) VALUES
	(5, 1, 'IT'),
	(6, 1, 'Accounting/Finance'),
	(7, 1, 'Banking/ Financial Services'),
	(8, 3, 'BPO'),
	(10, 4, 'Automotive/ Ancillaries');
/*!40000 ALTER TABLE `company_industries` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.company_notes
CREATE TABLE IF NOT EXISTS `company_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_notes_company_id_foreign` (`company_id`),
  CONSTRAINT `company_notes_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.company_notes: ~1 rows (approximately)
/*!40000 ALTER TABLE `company_notes` DISABLE KEYS */;
INSERT INTO `company_notes` (`id`, `company_id`, `note`) VALUES
	(1, 1, 'Test Note1'),
	(2, 1, 'Test data 2');
/*!40000 ALTER TABLE `company_notes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.countries: ~2 rows (approximately)
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'India', NULL, '2017-09-26 09:58:54', NULL),
	(2, 'Pakistan', NULL, '2017-09-26 10:01:37', NULL),
	(3, 'Sri Lanka', NULL, '2017-10-09 09:44:17', NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_id` int(10) unsigned NOT NULL,
  `type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `candidate_id` int(10) unsigned DEFAULT NULL,
  `event_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_job_order_id_foreign` (`job_order_id`),
  KEY `events_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `events_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`),
  CONSTRAINT `events_job_order_id_foreign` FOREIGN KEY (`job_order_id`) REFERENCES `job_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.events: ~6 rows (approximately)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `job_order_id`, `type`, `candidate_id`, `event_date`, `created_at`, `updated_at`, `status`) VALUES
	(1, 9, 'SUBMISSION', 9, '2017-11-14 00:00:00', '2017-11-14 12:47:21', '2017-11-14 14:54:22', NULL),
	(2, 5, 'intro_call_date', NULL, '2017-11-16 00:00:00', NULL, NULL, 'Intro Call Scheduled'),
	(4, 10, 'Intro Call Date', NULL, '2017-11-17 00:00:00', NULL, NULL, 'Intro Call Scheduled'),
	(5, 10, 'submission_date', NULL, '2017-11-18 00:00:00', NULL, NULL, 'Hiring In Progress'),
	(10, 11, 'Intro Call Date', NULL, '2017-11-18 00:00:00', '2017-11-16 11:16:20', NULL, 'Intro Call Scheduled'),
	(11, 11, 'submission_date', NULL, '2018-01-17 00:00:00', '2017-11-16 11:23:18', NULL, 'Hiring In Progress');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.event_notes
CREATE TABLE IF NOT EXISTS `event_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_notes_event_id_foreign` (`event_id`),
  CONSTRAINT `event_notes_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.event_notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `event_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_notes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.general_skills
CREATE TABLE IF NOT EXISTS `general_skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.general_skills: ~3 rows (approximately)
/*!40000 ALTER TABLE `general_skills` DISABLE KEYS */;
INSERT INTO `general_skills` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Positive Attitude', 'Positive', 1, '2017-09-28 10:54:11', '2017-10-05 05:04:57'),
	(2, 'Team Work', NULL, 1, '2017-09-28 10:54:23', NULL),
	(3, 'Solid Communication', 'Good command over English', NULL, '2017-10-05 07:15:09', NULL);
/*!40000 ALTER TABLE `general_skills` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.general_skill_notes
CREATE TABLE IF NOT EXISTS `general_skill_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `general_skill_id` int(10) unsigned NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `general_skill_notes_general_skill_id_foreign` (`general_skill_id`),
  CONSTRAINT `general_skill_notes_general_skill_id_foreign` FOREIGN KEY (`general_skill_id`) REFERENCES `general_skills` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.general_skill_notes: ~5 rows (approximately)
/*!40000 ALTER TABLE `general_skill_notes` DISABLE KEYS */;
INSERT INTO `general_skill_notes` (`id`, `general_skill_id`, `note`) VALUES
	(1, 1, 'Positive attitude towards work'),
	(3, 2, 'Patience to work as a team'),
	(4, 2, 'Meet deadlines'),
	(5, 1, 'Importance to Team members view points'),
	(6, 2, 'Team Work');
/*!40000 ALTER TABLE `general_skill_notes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.industries
CREATE TABLE IF NOT EXISTS `industries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.industries: ~14 rows (approximately)
/*!40000 ALTER TABLE `industries` DISABLE KEYS */;
INSERT INTO `industries` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'IT', 'Information Technology', NULL, '2017-09-28 11:27:54', NULL),
	(2, 'BPO', 'Business Process Outsourcing', NULL, '2017-09-29 14:25:45', NULL),
	(3, 'Accounting/Finance', 'Accounting and Finance related', NULL, '2017-10-04 07:09:25', NULL),
	(4, 'Internet', 'Web Related', NULL, '2017-10-04 09:47:55', NULL),
	(6, 'Automotive/ Ancillaries', 'Automobile', NULL, NULL, '2017-10-06 07:32:17'),
	(7, 'Banking/ Financial Services', NULL, NULL, NULL, NULL),
	(8, 'Bio Technology & Life Sciences', NULL, NULL, NULL, NULL),
	(9, 'Chemicals/Petrochemicals', NULL, NULL, NULL, NULL),
	(10, 'Construction', NULL, NULL, NULL, NULL),
	(11, 'FMCG', NULL, NULL, NULL, NULL),
	(12, 'Education', NULL, NULL, NULL, NULL),
	(13, 'Entertainment/ Media/ Publishing', NULL, NULL, NULL, NULL),
	(14, 'Insurance', NULL, NULL, NULL, NULL),
	(15, 'KPO/Analytics', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `industries` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.industry_functional_areas
CREATE TABLE IF NOT EXISTS `industry_functional_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `industry_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `industry_functional_areas_industry_id_foreign` (`industry_id`),
  CONSTRAINT `industry_functional_areas_industry_id_foreign` FOREIGN KEY (`industry_id`) REFERENCES `industries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.industry_functional_areas: ~4 rows (approximately)
/*!40000 ALTER TABLE `industry_functional_areas` DISABLE KEYS */;
INSERT INTO `industry_functional_areas` (`id`, `industry_id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Software', 'Software', 1, '2017-09-28 11:28:24', NULL),
	(3, 3, 'Accounting', 'Accounting', NULL, '2017-10-06 08:55:21', NULL),
	(4, 12, 'Teaching', 'Teaching', NULL, '2017-10-09 12:17:47', NULL),
	(5, 2, 'Non voice Associate', 'Non voice Associate', NULL, '2017-10-09 12:27:16', NULL);
/*!40000 ALTER TABLE `industry_functional_areas` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.industry_functional_area_roles
CREATE TABLE IF NOT EXISTS `industry_functional_area_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `industry_functional_area_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `industry_roles_induistry_functional_area_id_foreign` (`industry_functional_area_id`),
  CONSTRAINT `industry_roles_functionalarea_id_foreign` FOREIGN KEY (`industry_functional_area_id`) REFERENCES `industry_functional_areas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.industry_functional_area_roles: ~7 rows (approximately)
/*!40000 ALTER TABLE `industry_functional_area_roles` DISABLE KEYS */;
INSERT INTO `industry_functional_area_roles` (`id`, `name`, `industry_functional_area_id`, `created_at`, `updated_at`) VALUES
	(1, 'Software Developer', 1, '2017-09-28 11:35:53', '2017-10-09 09:01:09'),
	(4, 'Project Leader', 1, '2017-10-09 09:01:22', NULL),
	(5, 'Project Manager', 1, '2017-10-09 09:01:40', NULL),
	(6, 'Team Leader', 1, '2017-10-09 09:01:52', NULL),
	(7, 'Software Architect', 1, '2017-10-09 09:02:19', NULL),
	(8, 'Accountant', 3, '2017-10-09 09:25:24', NULL);
/*!40000 ALTER TABLE `industry_functional_area_roles` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.industry_functional_area_skills
CREATE TABLE IF NOT EXISTS `industry_functional_area_skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `industry_functional_area_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ind_fun_area_id` (`industry_functional_area_id`),
  CONSTRAINT `ind_fun_area_id` FOREIGN KEY (`industry_functional_area_id`) REFERENCES `industry_functional_areas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.industry_functional_area_skills: ~8 rows (approximately)
/*!40000 ALTER TABLE `industry_functional_area_skills` DISABLE KEYS */;
INSERT INTO `industry_functional_area_skills` (`id`, `industry_functional_area_id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'PHP', 'PHP', NULL, '2017-09-28 11:28:54', NULL),
	(3, 1, 'Laravel', 'Laravel Framework', NULL, '2017-10-09 08:56:11', NULL),
	(4, 1, 'Java', 'Java Development', NULL, '2017-10-09 08:56:30', NULL),
	(5, 1, 'Ruby on Rails', 'Ruby on Rails', NULL, '2017-10-09 08:56:53', NULL),
	(6, 1, 'Python', 'Python', NULL, '2017-10-09 08:57:05', NULL),
	(7, 1, 'HTML', 'HTML', NULL, '2017-10-09 08:57:23', NULL),
	(8, 3, 'Tally ERP', 'Tally ERP', NULL, '2017-10-09 08:57:35', NULL),
	(9, 3, 'Microsoft Excel', 'Microsoft Excel', NULL, '2017-10-09 08:58:00', NULL);
/*!40000 ALTER TABLE `industry_functional_area_skills` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.industry_functional_area_skill_notes
CREATE TABLE IF NOT EXISTS `industry_functional_area_skill_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `industry_functional_area_skill_id` int(10) unsigned NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ind_fun_area_skill_id` (`industry_functional_area_skill_id`),
  CONSTRAINT `ind_fun_area_skill_id` FOREIGN KEY (`industry_functional_area_skill_id`) REFERENCES `industry_functional_area_skills` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.industry_functional_area_skill_notes: ~1 rows (approximately)
/*!40000 ALTER TABLE `industry_functional_area_skill_notes` DISABLE KEYS */;
INSERT INTO `industry_functional_area_skill_notes` (`id`, `industry_functional_area_skill_id`, `note`) VALUES
	(1, 1, 'Web Development');
/*!40000 ALTER TABLE `industry_functional_area_skill_notes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.industry_skill_notes
CREATE TABLE IF NOT EXISTS `industry_skill_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `industry_skill_id` int(10) unsigned NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `industry_skill_notes_industry_skill_id_foreign` (`industry_skill_id`),
  CONSTRAINT `industry_skill_notes_industry_skill_id_foreign` FOREIGN KEY (`industry_skill_id`) REFERENCES `industry_functional_area_skills` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.industry_skill_notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `industry_skill_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `industry_skill_notes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_orders
CREATE TABLE IF NOT EXISTS `job_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) NOT NULL,
  `office_id` int(10) unsigned NOT NULL,
  `creator_id` int(10) unsigned DEFAULT NULL,
  `industry` mediumtext COLLATE utf8_unicode_ci COMMENT 'data from master',
  `industry_functional_area` mediumtext COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_vacancies` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `min_exp_years` tinyint(4) DEFAULT NULL,
  `max_exp_years` tinyint(4) DEFAULT NULL,
  `min_exp_months` tinyint(4) DEFAULT NULL,
  `max_exp_months` tinyint(4) DEFAULT NULL,
  `min_ctc` int(11) DEFAULT NULL,
  `max_ctc` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinytext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reference_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro_call_date` date DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_orders_creator_id_foreign` (`creator_id`),
  KEY `job_orders_company_id_foreign` (`company_id`),
  CONSTRAINT `job_orders_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `cms_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_orders: ~11 rows (approximately)
/*!40000 ALTER TABLE `job_orders` DISABLE KEYS */;
INSERT INTO `job_orders` (`id`, `company_id`, `office_id`, `creator_id`, `industry`, `industry_functional_area`, `title`, `num_vacancies`, `start_date`, `expiry_date`, `min_exp_years`, `max_exp_years`, `min_exp_months`, `max_exp_months`, `min_ctc`, `max_ctc`, `description`, `status`, `created_at`, `updated_at`, `reference_id`, `intro_call_date`, `submission_date`) VALUES
	(1, 1, 2, 4, 'IT', 'Software', 'PHP Fresher with good comm skills', 1, '2017-09-28', '2017-11-30', 1, 1, 1, 12, 5000, 12000, 'PHP Fresher with good comm skills', 'Hiring In Progress', '2017-09-29 09:25:37', '2017-11-06 05:41:44', 'CV101', '2017-10-20', '2017-10-28'),
	(2, 1, 3, 1, 'BPO', NULL, 'Experienced Outbound Sales Guy for Agro Products', 2, '2017-10-18', '2017-10-28', 4, 6, 1, 1, 300000, 350000, 'Experienced Outbound Sales Guy for Agro Products', 'Hiring In Progress', '2017-10-02 09:14:16', NULL, 'BPO101', '2017-10-10', '2017-10-25'),
	(3, 1, 1, 1, 'IT', NULL, 'Senior Frontend Develeoper', 1, '2017-10-25', '2017-10-31', 5, 7, 1, 1, 12, 15, 'Senior Frontend Develeoper', 'Hiring In Progress', '2017-10-02 10:44:32', NULL, 'EEE45', '2017-10-19', '2017-10-31'),
	(4, 1, 3, 1, 'BPO', 'Non-voice Support', 'BPO - Non-voice Support Executive', 4, '2017-10-05', '2017-10-30', 2, 6, 0, 0, 1, 3, 'BPO - Non-voice Support Executive', 'Hiring In Progress', '2017-10-05 08:58:57', '2017-10-05 09:09:38', 'CENVEO-BPO-2', '2017-10-09', '2017-10-10'),
	(5, 2, 4, 1, 'IT', 'Software', 'PHP Laravel Developer', 5, '2017-10-16', '2017-10-18', 2, 6, 2, 3, 0, 5, 'technology trends and frameworks. Desirable: Experience in any other PHP frameworks, PrestaShop, WordPress, AngularJS, HTML5 and CSS3.', 'Hiring In Progress', '2017-10-09 09:12:53', NULL, 'NE', '2017-11-16', '2017-11-29'),
	(6, 3, 5, 1, 'Accounting/Finance', 'Accounting', 'Wanted Accountant', 2, '2017-10-16', '2017-10-30', 2, 5, 1, 12, 12, 20, 'To manage accounts payable (bill payments, salaries, petty cash etc.) and receivable through cash / cheque / voucher in a timely manner  To establish and maintain fiscal files and records to document transactions.', 'Hiring In Progress', '2017-10-09 09:18:45', NULL, 'NE', '2017-10-10', '2017-10-13'),
	(7, 4, 6, 2, 'Accounting/Finance', 'Accounting', 'Accounts Manager', 1, '2017-10-09', '2017-10-31', 2, 4, 2, 0, 150000, 300000, 'Manage and oversee the daily operations of the accounting department including: month and end-year process accounts payable/receivable cash receipts general ledger payroll and utilities treasury, budgeting cash forecasting revenue and expenditure variance', 'On Hold', '2017-10-09 13:09:44', '2017-10-11 09:11:29', 'C2W123', '2017-10-09', '2017-10-09'),
	(8, 4, 6, 2, 'Accounting/Finance', 'Accounting', 'Jr Accountant', 1, '2017-10-28', '2017-10-31', 1, 2, 1, 1, 200000, 250000, 'accontant', 'Hiring In Progress', '2017-10-28 11:45:21', NULL, '12', '2017-10-28', '2017-10-30'),
	(9, 2, 4, 1, 'IT', 'Accounting', 'PHP Laravel Developer', 3, '2017-11-08', '2017-11-20', 3, 2, 5, 11, 12, 16, 'For Event Checking', 'Hiring In Progress', '2017-11-13 09:03:47', NULL, 'event_id', '2017-11-14', '2017-11-17'),
	(10, 2, 4, 1, 'Automotive/ Ancillaries', 'Non voice Associate', 'SEO', 6, '2017-11-07', '2017-11-14', 3, 2, 1, 5, 1, 5, 'SEO Analyst', 'Hiring In Progress', '2017-11-16 05:26:32', NULL, '8', '2017-11-17', '2017-11-18'),
	(11, 2, 4, 1, 'Automotive/ Ancillaries', 'Accounting', 'Aby Test', 8, '2017-11-15', '2017-11-17', 5, 3, 1, 5, 0, 5, 'Test Aby', 'Hiring In Progress', '2017-11-16 09:38:15', NULL, 'tyets', '2017-11-18', '2018-01-17');
/*!40000 ALTER TABLE `job_orders` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_applicants
CREATE TABLE IF NOT EXISTS `job_order_applicants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_id` int(10) unsigned NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  `primary_status` tinytext COLLATE utf8_unicode_ci,
  `secondary_status` tinytext COLLATE utf8_unicode_ci,
  `next_action` tinytext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `creator_id` int(10) unsigned DEFAULT NULL,
  `interview_round` int(10) unsigned DEFAULT '1',
  `callback_date` date DEFAULT NULL,
  `scheduled_feedback_date` date DEFAULT NULL,
  `interview_date` timestamp NULL DEFAULT NULL,
  `interview_confirmation_date` date DEFAULT NULL,
  `interview_followup_date` date DEFAULT NULL,
  `offer_confirmation_date` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `notes` longtext COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_order_applicants_job_order_id_foreign` (`job_order_id`),
  KEY `job_order_applicants_candidate_id_foreign` (`candidate_id`),
  KEY `job_order_applicants_creator_id_foreign` (`creator_id`),
  CONSTRAINT `job_order_applicants_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`),
  CONSTRAINT `job_order_applicants_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `cms_users` (`id`),
  CONSTRAINT `job_order_applicants_job_order_id_foreign` FOREIGN KEY (`job_order_id`) REFERENCES `job_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_applicants: ~26 rows (approximately)
/*!40000 ALTER TABLE `job_order_applicants` DISABLE KEYS */;
INSERT INTO `job_order_applicants` (`id`, `job_order_id`, `candidate_id`, `primary_status`, `secondary_status`, `next_action`, `created_at`, `updated_at`, `creator_id`, `interview_round`, `callback_date`, `scheduled_feedback_date`, `interview_date`, `interview_confirmation_date`, `interview_followup_date`, `offer_confirmation_date`, `joining_date`, `notes`, `deleted_at`) VALUES
	(1, 1, 4, 'Submission', 'Submitted-to-client', 'Get Feedback from Client', '2017-10-02 11:32:13', '2017-10-02 11:32:17', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 1, 5, 'Qualify', 'Pending Review', 'Complete Review', '2017-10-02 14:41:13', '2017-10-02 14:41:13', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 2, 5, 'Qualify', 'Qualified', 'Submit', '2017-10-02 14:47:29', '2017-10-02 14:47:29', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 3, 6, 'Placed', 'Joined', 'Send Invoice', '2017-10-04 10:31:09', '2017-10-04 10:31:09', 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 3, 5, 'Qualify', 'Qualified', 'Submit', '2017-10-02 19:48:49', '2017-10-02 19:48:49', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 4, 8, 'Qualify', 'Qualified', 'Submit', '2017-10-09 07:54:15', '2017-10-09 07:54:15', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 4, 3, 'Qualify', 'Pending Review', 'Qualify', '2017-10-09 07:58:36', '2017-10-09 07:58:36', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-09 08:53:51'),
	(9, 4, 10, 'Qualify', 'Pending Review', 'Qualify', '2017-10-09 08:53:39', '2017-10-09 08:53:39', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 6, 9, 'Interviewing', 'Interview Scheduled', 'Confirm Interview Schedule', '2017-10-09 09:40:56', '2017-10-09 09:40:56', 1, 1, NULL, NULL, '2017-10-12 11:00:00', NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 6, 8, 'Qualify', 'Pending Review', 'Qualify', '2017-10-09 09:41:28', '2017-10-09 09:41:28', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 7, 11, 'Interviewing', 'Interview In Progress', 'Get Interview Feedback', '2017-10-09 18:02:10', '2017-10-09 18:02:10', 2, 2, NULL, NULL, NULL, NULL, '2017-10-11', NULL, NULL, NULL, NULL),
	(13, 7, 8, 'Placed', 'Joined', 'Send Invoice', '2017-10-09 13:10:49', '2017-10-09 13:10:49', 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 7, 6, 'Submission', 'Approved by the Client', 'Schedule Interview', '2017-10-09 13:10:50', '2017-10-09 13:10:50', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 7, 3, 'Offer', 'Un-Qualified', 'Inform Candidate', '2017-10-09 13:10:51', '2017-10-09 13:10:51', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-09 17:55:01'),
	(16, 7, 1, 'Qualify', 'Declined by C2W', '-', '2017-10-11 09:27:45', '2017-10-11 09:27:45', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 7, 2, 'Qualify', 'Pending Review', 'Qualify', '2017-10-11 09:27:46', '2017-10-11 09:27:46', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 7, 7, 'Qualify', 'Qualified', 'Submit', '2017-10-09 18:02:16', '2017-10-09 18:02:16', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 8, 1, 'Submission', 'Approved by the Client', 'Schedule Interview', '2017-11-04 09:31:35', '2017-11-04 09:31:35', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 8, 2, 'Submission', 'Rejected by the Client', '-', '2017-10-28 11:46:23', '2017-10-28 11:46:23', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 8, 4, 'Submission', 'Submitted to Client', 'Get Submission Feedback', '2017-10-28 11:46:20', '2017-10-28 11:46:20', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 8, 5, 'Submission', 'Submitted to Client', 'Get Submission Feedback', '2017-10-28 11:46:22', '2017-10-28 11:46:22', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 8, 8, 'Submission', 'Submitted to Client', 'Get Submission Feedback', '2017-10-28 11:46:29', '2017-10-28 11:46:29', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 8, 7, 'Interviewing', 'Shortlisted for Next Round', 'Confirm Interview Schedule', '2017-10-28 11:46:31', '2017-10-28 11:46:31', 2, 2, NULL, NULL, '2017-10-30 17:04:00', NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 9, 1, 'Qualify', 'Pending Review', 'Qualify', '2017-11-16 03:54:08', '2017-11-16 03:54:08', 2, 1, NULL, NULL, '2017-11-07 15:04:00', NULL, NULL, NULL, NULL, NULL, NULL),
	(26, 9, 4, 'Placed', 'Joined', 'Send Invoice', '2017-11-13 09:43:09', '2017-11-13 09:43:09', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(27, 9, 7, 'Placed', 'Joined', 'Send Invoice', '2017-11-13 09:43:10', '2017-11-13 09:43:10', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `job_order_applicants` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_applicant_history
CREATE TABLE IF NOT EXISTS `job_order_applicant_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_id` int(10) unsigned NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `creator_id` int(10) unsigned DEFAULT NULL,
  `notes` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `job_order_applicant_history_job_order_id_foreign` (`job_order_id`),
  KEY `job_order_applicant_history_candidate_id_foreign` (`candidate_id`),
  KEY `job_order_applicant_history_creator_id_foreign` (`creator_id`),
  CONSTRAINT `job_order_applicant_history_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`),
  CONSTRAINT `job_order_applicant_history_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`),
  CONSTRAINT `job_order_applicant_history_job_order_id_foreign` FOREIGN KEY (`job_order_id`) REFERENCES `job_orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_applicant_history: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_order_applicant_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_order_applicant_history` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_applicant_notes
CREATE TABLE IF NOT EXISTS `job_order_applicant_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_applicant_id` int(10) unsigned NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_order_applicant_notes_job_order_applicant_id_foreign` (`job_order_applicant_id`),
  CONSTRAINT `job_order_applicant_notes_job_order_applicant_id_foreign` FOREIGN KEY (`job_order_applicant_id`) REFERENCES `job_order_applicants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_applicant_notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_order_applicant_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_order_applicant_notes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_applicant_statuses
CREATE TABLE IF NOT EXISTS `job_order_applicant_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_applicant_id` int(10) unsigned NOT NULL,
  `prev_primary_status` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `prev_secondary_status` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `new_primary_status` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `new_secondary_status` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci,
  `creator_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prev_callback_date` date DEFAULT NULL,
  `prev_scheduled_feedback_date` date DEFAULT NULL,
  `prev_interview_date` timestamp NULL DEFAULT NULL,
  `prev_interview_confirmation_date` date DEFAULT NULL,
  `prev_interview_followup_date` date DEFAULT NULL,
  `prev_offer_confirmation_date` date DEFAULT NULL,
  `prev_joining_date` date DEFAULT NULL,
  `new_callback_date` date DEFAULT NULL,
  `new_scheduled_feedback_date` date DEFAULT NULL,
  `new_interview_date` timestamp NULL DEFAULT NULL,
  `new_interview_confirmation_date` date DEFAULT NULL,
  `new_interview_followup_date` date DEFAULT NULL,
  `new_offer_confirmation_date` date DEFAULT NULL,
  `new_joining_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_job_order_applicant_statuses_job_order_applicants` (`job_order_applicant_id`),
  CONSTRAINT `FK_job_order_applicant_statuses_job_order_applicants` FOREIGN KEY (`job_order_applicant_id`) REFERENCES `job_order_applicants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_applicant_statuses: ~188 rows (approximately)
/*!40000 ALTER TABLE `job_order_applicant_statuses` DISABLE KEYS */;
INSERT INTO `job_order_applicant_statuses` (`id`, `job_order_applicant_id`, `prev_primary_status`, `prev_secondary_status`, `new_primary_status`, `new_secondary_status`, `note`, `creator_id`, `created_at`, `updated_at`, `prev_callback_date`, `prev_scheduled_feedback_date`, `prev_interview_date`, `prev_interview_confirmation_date`, `prev_interview_followup_date`, `prev_offer_confirmation_date`, `prev_joining_date`, `new_callback_date`, `new_scheduled_feedback_date`, `new_interview_date`, `new_interview_confirmation_date`, `new_interview_followup_date`, `new_offer_confirmation_date`, `new_joining_date`) VALUES
	(1, 1, 'Pipeline', 'Associated', 'Qualify', 'Reviewed', 'Review done. Not sure.', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 1, 'Qualify', 'Reviewed', 'Qualify', 'Qualified', 'All good. Can email client.', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 1, 'Qualify', 'Qualified', 'Submission', 'Submitted-to-client', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 1, 'Submission', 'Submitted-to-client', 'Submission', 'Submitted-to-client', NULL, 1, '2017-10-02 13:30:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 1, 'Submission', 'Submitted-to-client', 'Submission', 'Submitted-to-client', 'Waiting forever...', 1, '2017-10-02 13:30:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 1, 'Submission', 'Submitted-to-client', 'Submission', 'Submitted-to-client', 'Client yet to respond :(', 1, '2017-10-02 13:31:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 2, 'Pipeline', 'Associated', 'Qualify', 'Pending Review', NULL, 1, '2017-10-02 14:41:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 3, 'Pipeline', 'Associated', 'Qualify', 'Qualified', NULL, 1, '2017-10-02 14:47:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 3, 'Qualify', 'Qualified', 'Submission', 'Approved by client', NULL, 1, '2017-10-02 15:11:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 3, 'Submission', 'Approved by client', 'Submission', 'Rejected by client', 'Client not impressed with comm skills.', 1, '2017-10-02 15:11:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 5, 'Pipeline', 'Associated', 'Qualify', 'Qualified', 'Guy looks good', 1, '2017-10-02 16:19:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 5, 'Qualify', 'Qualified', 'Submission', 'Approved by client', 'Client has ok\'d it', 1, '2017-10-02 16:19:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 5, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 1, '2017-10-02 18:05:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 5, 'Qualify', 'Qualified', 'Qualify', 'Reviewed', NULL, 1, '2017-10-02 18:39:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 5, 'Qualify', 'Reviewed', 'Q', 'u', NULL, 1, '2017-10-02 19:08:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 5, 'Qualify', 'Reviewed', 'Q', 'u', NULL, 1, '2017-10-02 19:08:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 5, 'Q', 'u', 'Qualify', 'Pending Review', NULL, 1, '2017-10-02 19:09:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 5, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 1, '2017-10-02 19:09:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 5, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 1, '2017-10-02 19:09:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 5, 'Qualify', 'Qualified', 'Qualify', 'Scheduled Call Back', NULL, 1, '2017-10-02 19:10:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 5, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Scheduled Call Back', NULL, 1, '2017-10-02 19:11:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 5, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Scheduled Call Back', NULL, 1, '2017-10-02 19:12:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 5, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 1, '2017-10-02 19:14:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 6, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 1, '2017-10-02 19:48:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 3, 'Submission', 'Rejected by client', 'Qualify', 'Qualified', NULL, 1, '2017-10-02 19:55:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(26, 5, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 1, '2017-10-03 09:02:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(27, 6, 'Qualify', 'Qualified', 'Qualify', 'Pending Review', NULL, 1, '2017-10-03 09:13:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(28, 5, 'Submission', 'Submitted to Client', 'Submission', 'Reschedule Submission', NULL, 1, '2017-10-03 09:26:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, 5, 'Submission', 'Reschedule Submission', 'Submission', 'Reschedule Submission', 'Client was too busy!', 1, '2017-10-03 09:27:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(30, 6, 'Qualify', 'Pending Review', 'Qualify', 'Declined by C2W', NULL, 1, '2017-10-03 09:30:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(31, 6, 'Qualify', 'Declined by C2W', 'Qualify', 'Pending Review', NULL, 1, '2017-10-03 09:30:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(32, 6, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 1, '2017-10-03 09:31:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(33, 5, 'Submission', 'Reschedule Submission', 'Submission', 'Approved by the Client', NULL, 1, '2017-10-03 19:27:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(34, 5, 'Submission', 'Approved by the Client', 'Qualify', 'Qualified', NULL, 1, '2017-10-03 19:41:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(35, 5, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 1, '2017-10-03 19:42:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(36, 5, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 1, '2017-10-03 19:42:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(37, 5, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', 'Interview has been set!', 1, '2017-10-03 19:49:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(38, 5, 'Interviewing', 'Interview Scheduled', 'Interview', 'Interview-Scheduled', NULL, 1, '2017-10-03 20:06:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(39, 5, 'Interview', 'Interview-Scheduled', 'Submission', 'Approved by client', NULL, 1, '2017-10-03 20:06:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(40, 5, 'Submission', 'Approved by client', 'Interviewing', 'Interview Scheduled', NULL, 1, '2017-10-03 20:08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(41, 5, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Reschedule', NULL, 1, '2017-10-03 20:20:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(42, 5, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview Scheduled', NULL, 1, '2017-10-03 20:22:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(43, 5, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Schedule Confirmed', NULL, 1, '2017-10-03 20:22:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(44, 5, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Schedule Confirmed', NULL, 1, '2017-10-03 20:22:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(45, 5, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview In Progress', NULL, 1, '2017-10-03 20:25:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(46, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'On-Hold', NULL, 1, '2017-10-04 09:15:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(47, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'On Hold', NULL, 1, '2017-10-04 09:16:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(48, 5, 'Interviewing', 'On Hold', 'Interviewing', 'Rescheduled', NULL, 1, '2017-10-04 09:17:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(49, 5, 'Interviewing', 'Rescheduled', 'Interviewing', 'Rejected by the Client', NULL, 1, '2017-10-04 09:17:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(50, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'On Hold', NULL, 1, '2017-10-04 09:19:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-24', NULL, NULL),
	(51, 5, 'Interviewing', 'On Hold', 'Interviewing', 'Rescheduled', NULL, 1, '2017-10-04 09:19:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-25', NULL, NULL),
	(52, 5, 'Interviewing', 'Rescheduled', 'Interviewing', 'On Hold', NULL, 1, '2017-10-04 09:20:31', NULL, NULL, NULL, NULL, NULL, '2017-10-25', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-26', NULL, NULL),
	(53, 5, 'Interviewing', 'On Hold', 'Interviewing', 'Rescheduled', NULL, 1, '2017-10-04 09:20:44', NULL, NULL, NULL, NULL, NULL, '2017-10-26', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-21', NULL, NULL),
	(54, 5, 'Interviewing', 'Rescheduled', 'Interviewing', 'Shortlisted for Next Round', NULL, 1, '2017-10-04 09:21:02', NULL, NULL, NULL, NULL, NULL, '2017-10-21', NULL, NULL, NULL, NULL, '2017-10-30 10:30:00', NULL, NULL, NULL, NULL),
	(55, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'Shortlisted for Next Round', NULL, 1, '2017-10-04 09:27:02', NULL, NULL, NULL, '2017-10-30 10:30:00', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-21 10:45:00', NULL, NULL, NULL, NULL),
	(56, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'To be Offered', NULL, 1, '2017-10-04 09:38:40', NULL, NULL, NULL, '2017-10-21 10:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(57, 5, 'Interviewing', 'To be Offered', 'Offering', 'Offer Made', NULL, 1, '2017-10-04 09:39:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-20', NULL),
	(58, 5, 'Offering', 'Offer Made', 'Offering', 'Offer Accepted', NULL, 1, '2017-10-04 09:51:18', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-31'),
	(59, 5, 'Offering', 'Offer Accepted', 'Placed', 'Joining Extended', NULL, 1, '2017-10-04 09:56:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-31', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-08'),
	(60, 5, 'Placed', 'Joining Extended', 'Placed', 'Joined', NULL, 1, '2017-10-04 09:56:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(61, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'To be Offered', NULL, 1, '2017-10-04 09:57:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(62, 5, 'Interviewing', 'To be Offered', 'Offering', 'Offer Made', NULL, 1, '2017-10-04 09:57:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-26', NULL),
	(63, 5, 'Offering', 'Offer Made', 'Offering', 'Offer Accepted', NULL, 1, '2017-10-04 09:57:25', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-19'),
	(64, 5, 'Offering', 'Offer Accepted', 'Placed', 'Backed Out', NULL, 1, '2017-10-04 09:57:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(65, 5, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 1, '2017-10-04 10:00:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-19', NULL, NULL, NULL, NULL, NULL, NULL),
	(66, 5, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 1, '2017-10-04 10:00:40', NULL, '2017-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(67, 5, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 1, '2017-10-04 10:02:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-13', NULL, NULL, NULL, NULL, NULL, NULL),
	(68, 5, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 1, '2017-10-04 10:02:35', NULL, '2017-10-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(69, 5, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 1, '2017-10-04 10:02:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(70, 5, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 1, '2017-10-04 10:02:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(71, 5, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', NULL, 1, '2017-10-04 10:03:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-11 00:30:00', NULL, NULL, NULL, NULL),
	(72, 5, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview Scheduled', NULL, 1, '2017-10-04 10:03:43', NULL, NULL, NULL, '2017-10-11 00:30:00', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-27 01:30:00', NULL, NULL, NULL, NULL),
	(73, 5, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview In Progress', NULL, 1, '2017-10-04 10:03:58', NULL, NULL, NULL, '2017-10-27 01:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-30', NULL, NULL),
	(74, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'Shortlisted for Next Round', NULL, 1, '2017-10-04 10:04:32', NULL, NULL, NULL, NULL, NULL, '2017-10-30', NULL, NULL, NULL, NULL, '2017-10-31 02:39:00', NULL, NULL, NULL, NULL),
	(75, 5, 'Interviewing', 'Shortlisted for Next Round', 'Interviewing', 'Interview In Progress', NULL, 1, '2017-10-04 10:04:45', NULL, NULL, NULL, '2017-10-31 02:39:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-02', NULL, NULL),
	(76, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'To be Offered', NULL, 1, '2017-10-04 10:04:55', NULL, NULL, NULL, NULL, NULL, '2017-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(77, 5, 'Interviewing', 'To be Offered', 'Offering', 'Offer Made', NULL, 1, '2017-10-04 10:05:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-04', NULL),
	(78, 5, 'Offering', 'Offer Made', 'Offering', 'Offer Accepted', NULL, 1, '2017-10-04 10:05:32', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-15'),
	(79, 5, 'Offering', 'Offer Accepted', 'Placed', 'Joined', NULL, 1, '2017-10-04 10:05:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(80, 5, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 2, '2017-10-04 10:23:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-28', NULL, NULL, NULL, NULL, NULL, NULL),
	(81, 5, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', 'Guy is good!', 2, '2017-10-04 10:23:36', NULL, '2017-10-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(82, 5, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-04 10:25:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(83, 5, 'Submission', 'Submitted to Client', 'Submission', 'Reschedule Submission', NULL, 2, '2017-10-04 10:25:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-30', NULL, NULL, NULL, NULL, NULL),
	(84, 5, 'Submission', 'Reschedule Submission', 'Submission', 'Approved by the Client', NULL, 2, '2017-10-04 10:25:34', NULL, NULL, '2017-10-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(85, 5, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', NULL, 2, '2017-10-04 10:25:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-31 10:25:00', NULL, NULL, NULL, NULL),
	(86, 5, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 2, '2017-10-04 10:31:22', NULL, NULL, NULL, '2017-10-31 10:25:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(87, 5, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-04 10:31:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(88, 5, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 2, '2017-10-04 10:32:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(89, 5, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', NULL, 2, '2017-10-04 10:33:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-25 12:15:00', NULL, NULL, NULL, NULL),
	(90, 5, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview In Progress', NULL, 2, '2017-10-04 10:33:45', NULL, NULL, NULL, '2017-10-25 12:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-27', NULL, NULL),
	(91, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'Shortlisted for Next Round', NULL, 2, '2017-10-04 10:34:22', NULL, NULL, NULL, NULL, NULL, '2017-10-27', NULL, NULL, NULL, NULL, '2017-10-31 09:30:00', NULL, NULL, NULL, NULL),
	(92, 5, 'Interviewing', 'Shortlisted for Next Round', 'Interviewing', 'Interview In Progress', NULL, 2, '2017-10-04 10:34:38', NULL, NULL, NULL, '2017-10-31 09:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-02', NULL, NULL),
	(93, 5, 'Interviewing', 'Interview In Progress', 'Interviewing', 'To be Offered', NULL, 2, '2017-10-04 10:34:49', NULL, NULL, NULL, NULL, NULL, '2017-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(94, 5, 'Interviewing', 'To be Offered', 'Offering', 'Offer Made', NULL, 2, '2017-10-04 10:35:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-04', NULL),
	(95, 5, 'Offering', 'Offer Made', 'Offering', 'Offer Accepted', NULL, 2, '2017-10-04 10:35:26', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-15'),
	(96, 5, 'Offering', 'Offer Accepted', 'Placed', 'Joined', NULL, 2, '2017-10-04 10:35:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(97, 7, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 2, '2017-10-09 08:54:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(98, 10, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', 'Seems to be good', 2, '2017-10-09 12:52:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(99, 10, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-09 12:53:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(100, 10, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', 'profile shortlisted', 2, '2017-10-09 12:53:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(101, 10, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', 'Spoke to the candidate and the interview has been scheduled', 2, '2017-10-09 12:55:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-11 11:15:00', NULL, NULL, NULL, NULL),
	(102, 10, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview Scheduled', NULL, 2, '2017-10-09 12:56:22', NULL, NULL, NULL, '2017-10-11 11:15:00', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-12 11:00:00', NULL, NULL, NULL, NULL),
	(103, 12, 'Qualify', 'Pending Review', 'Qualify', 'Declined by C2W', NULL, 2, '2017-10-09 13:22:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(104, 13, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 2, '2017-10-09 13:22:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-12', NULL, NULL, NULL, NULL, NULL, NULL),
	(105, 14, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 2, '2017-10-09 13:22:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(106, 15, 'Qualify', 'Pending Review', 'Qualify', 'Declined by C2W', NULL, 2, '2017-10-09 13:22:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(107, 13, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', 'Good', 2, '2017-10-09 17:42:22', NULL, '2017-10-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(108, 13, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-09 17:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(109, 13, 'Submission', 'Submitted to Client', 'Submission', 'Reschedule Submission', 'test note', 2, '2017-10-09 17:44:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10', NULL, NULL, NULL, NULL, NULL),
	(110, 13, 'Submission', 'Reschedule Submission', 'Submission', 'Rejected by the Client', 'Rejected by client', 2, '2017-10-09 17:45:51', NULL, NULL, '2017-10-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(111, 13, 'Submission', 'Rejected by the Client', 'Interview', 'Interview-to-be-Scheduled', NULL, 2, '2017-10-09 17:46:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(112, 13, 'Interview', 'Interview-to-be-Scheduled', 'Interviewing', 'Interview Scheduled', NULL, 2, '2017-10-09 17:47:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04 13:01:00', NULL, NULL, NULL, NULL),
	(113, 13, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview In Progress', NULL, 2, '2017-10-09 17:47:28', NULL, NULL, NULL, '2017-10-04 13:01:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-13', NULL, NULL),
	(114, 13, 'Interviewing', 'Interview In Progress', 'Interviewing', 'Shortlisted for Next Round', NULL, 2, '2017-10-09 17:47:50', NULL, NULL, NULL, NULL, NULL, '2017-10-13', NULL, NULL, NULL, NULL, '2017-10-10 13:00:00', NULL, NULL, NULL, NULL),
	(115, 13, 'Interviewing', 'Shortlisted for Next Round', 'Interviewing', 'Interview In Progress', NULL, 2, '2017-10-09 17:48:13', NULL, NULL, NULL, '2017-10-10 13:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04', NULL, NULL),
	(116, 13, 'Interviewing', 'Interview In Progress', 'Interviewing', 'To be Offered', NULL, 2, '2017-10-09 17:48:35', NULL, NULL, NULL, NULL, NULL, '2017-10-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(117, 13, 'Interviewing', 'To be Offered', 'Offering', 'Offer Made', NULL, 2, '2017-10-09 17:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-12', NULL),
	(118, 15, 'Qualify', 'Declined by C2W', 'Place', 'Hired', NULL, 2, '2017-10-09 17:55:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(119, 15, 'Place', 'Hired', 'Offer', 'Un-Qualified', NULL, 2, '2017-10-09 17:55:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(120, 13, 'Offering', 'Offer Made', 'Offering', 'Offer Accepted', NULL, 2, '2017-10-09 18:03:12', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-11'),
	(121, 13, 'Offering', 'Offer Accepted', 'Placed', 'Joined', NULL, 2, '2017-10-09 18:03:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(122, 12, 'Qualify', 'Pending Review', 'Qualify', 'Declined by C2W', NULL, 2, '2017-10-11 08:00:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(123, 18, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', 'need to call him back', 2, '2017-10-11 08:03:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04', NULL, NULL, NULL, NULL, NULL, NULL),
	(124, 18, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', 'Qualified', 2, '2017-10-11 08:04:11', NULL, '2017-10-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(125, 14, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-17 09:38:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(126, 12, 'Qualify', 'Declined by C2W', 'Qualify', 'Pending Review', NULL, 2, '2017-10-17 09:40:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(127, 12, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 2, '2017-10-17 09:40:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-02', NULL, NULL, NULL, NULL, NULL, NULL),
	(128, 12, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 2, '2017-10-17 09:42:36', NULL, '2017-10-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(129, 12, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-17 10:02:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(130, 12, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 2, '2017-10-17 10:02:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(131, 12, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', NULL, 2, '2017-10-17 10:03:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-19 15:00:00', NULL, NULL, NULL, NULL),
	(132, 12, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview In Progress', NULL, 2, '2017-10-17 10:03:39', NULL, NULL, NULL, '2017-10-19 15:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-19', NULL, NULL),
	(133, 12, 'Interviewing', 'Interview In Progress', 'Interviewing', 'On Hold', NULL, 2, '2017-10-17 10:03:51', NULL, NULL, NULL, NULL, NULL, '2017-10-19', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-21', NULL, NULL),
	(134, 12, 'Interviewing', 'On Hold', 'Interviewing', 'Rescheduled', NULL, 2, '2017-10-17 10:04:04', NULL, NULL, NULL, NULL, NULL, '2017-10-21', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-20', NULL, NULL),
	(135, 12, 'Interviewing', 'Rescheduled', 'Interviewing', 'Shortlisted for Next Round', NULL, 2, '2017-10-17 10:04:25', NULL, NULL, NULL, NULL, NULL, '2017-10-20', NULL, NULL, NULL, NULL, '2017-10-23 18:03:00', NULL, NULL, NULL, NULL),
	(136, 12, 'Interviewing', 'Shortlisted for Next Round', 'Interview', 'Interview-to-be-Scheduled', NULL, 2, '2017-10-20 18:39:59', NULL, NULL, NULL, '2017-10-23 18:03:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(137, 12, 'Interview', 'Interview-to-be-Scheduled', 'Interviewing', 'Interview Scheduled', NULL, 2, '2017-10-20 18:40:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-19 10:11:00', NULL, NULL, NULL, NULL),
	(138, 12, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview In Progress', NULL, 2, '2017-10-20 18:41:01', NULL, NULL, NULL, '2017-10-19 10:11:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-11', NULL, NULL),
	(139, 16, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 2, '2017-10-21 08:14:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-22', NULL, NULL, NULL, NULL, NULL, NULL),
	(140, 14, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 2, '2017-10-21 08:16:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(141, 16, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Declined by C2W', NULL, 2, '2017-10-28 11:33:34', NULL, '2017-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(142, 19, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 2, '2017-10-28 11:46:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-28', NULL, NULL, NULL, NULL, NULL, NULL),
	(143, 19, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Scheduled Call Back', NULL, 2, '2017-10-28 11:46:59', NULL, '2017-10-28', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-28', NULL, NULL, NULL, NULL, NULL, NULL),
	(144, 19, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 2, '2017-10-28 11:47:06', NULL, '2017-10-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(145, 20, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 2, '2017-10-28 11:47:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(146, 21, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 2, '2017-10-28 11:47:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(147, 20, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 2, '2017-10-28 11:47:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(148, 21, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 2, '2017-10-28 11:47:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(149, 22, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 2, '2017-10-28 11:47:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(150, 23, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 2, '2017-10-28 11:47:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(151, 24, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 2, '2017-10-28 11:47:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(152, 24, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-28 11:48:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(153, 23, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-28 11:48:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(154, 22, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-28 11:48:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(155, 21, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-28 11:48:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(156, 20, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-28 11:48:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(157, 19, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-10-28 11:48:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(158, 19, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 2, '2017-10-28 11:48:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(159, 20, 'Submission', 'Submitted to Client', 'Submission', 'Rejected by the Client', NULL, 2, '2017-10-28 11:48:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(160, 19, 'Submission', 'Approved by the Client', 'Interview', 'Interview-Scheduled', NULL, 2, '2017-10-28 12:36:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(161, 24, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 2, '2017-10-28 12:36:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(162, 24, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', NULL, 2, '2017-10-28 12:36:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(163, 24, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', NULL, 2, '2017-10-28 12:36:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-31 13:01:00', NULL, NULL, NULL, NULL),
	(164, 24, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview In Progress', NULL, 2, '2017-10-28 12:48:06', NULL, NULL, NULL, '2017-10-31 13:01:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-30', NULL, NULL),
	(165, 24, 'Interviewing', 'Interview In Progress', 'Interviewing', 'Shortlisted for Next Round', NULL, 2, '2017-10-28 12:48:26', NULL, NULL, NULL, NULL, NULL, '2017-10-30', NULL, NULL, NULL, NULL, '2017-10-30 17:04:00', NULL, NULL, NULL, NULL),
	(166, 19, 'Interview', 'Interview-Scheduled', 'Qualify', '-', NULL, 2, '2017-11-04 09:31:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(167, 19, 'Qualify', 'Pending Review', 'Qualify', 'Qualified', NULL, 2, '2017-11-04 09:31:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(168, 19, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-11-04 09:31:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(169, 19, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 2, '2017-11-04 09:32:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(170, 25, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 1, '2017-11-13 09:44:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-16', NULL, NULL, NULL, NULL, NULL, NULL),
	(171, 25, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 1, '2017-11-13 09:47:10', NULL, '2017-11-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(172, 25, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 1, '2017-11-13 09:47:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(173, 25, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 1, '2017-11-13 09:48:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-21', NULL, NULL, NULL, NULL, NULL),
	(174, 25, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', NULL, 1, '2017-11-13 09:48:53', NULL, NULL, '2017-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-06 16:02:00', NULL, NULL, NULL, NULL),
	(175, 25, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview Scheduled', NULL, 1, '2017-11-13 09:49:15', NULL, NULL, NULL, '2017-11-06 16:02:00', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-07 15:04:00', NULL, NULL, NULL, NULL),
	(176, 26, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 1, '2017-11-13 09:51:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-31', NULL, NULL, NULL, NULL, NULL, NULL),
	(177, 26, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 1, '2017-11-13 09:52:21', NULL, '2017-10-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(178, 26, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 1, '2017-11-13 09:52:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(179, 26, 'Submission', 'Submitted to Client', 'Submission', 'Reschedule Submission', NULL, 1, '2017-11-13 09:53:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-23', NULL, NULL, NULL, NULL, NULL),
	(180, 26, 'Submission', 'Reschedule Submission', 'Submission', 'Approved by the Client', NULL, 1, '2017-11-13 09:53:38', NULL, NULL, '2017-11-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(181, 26, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', NULL, 1, '2017-11-13 09:54:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-14 15:03:00', NULL, NULL, NULL, NULL),
	(182, 26, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview In Progress', NULL, 1, '2017-11-13 09:56:59', NULL, NULL, NULL, '2017-11-14 15:03:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-01', NULL, NULL),
	(183, 26, 'Interviewing', 'Interview In Progress', 'Interviewing', 'To be Offered', NULL, 1, '2017-11-13 10:00:55', NULL, NULL, NULL, NULL, NULL, '2017-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(184, 26, 'Interviewing', 'To be Offered', 'Offering', 'Offer Made', NULL, 1, '2017-11-13 10:01:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-23', NULL),
	(185, 26, 'Offering', 'Offer Made', 'Offering', 'Offer Accepted', NULL, 1, '2017-11-13 10:02:54', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-15'),
	(186, 26, 'Offering', 'Offer Accepted', 'Placed', 'Joining Extended', '6', 1, '2017-11-13 10:09:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-15', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-14'),
	(187, 26, 'Placed', 'Joining Extended', 'Placed', 'Joined', NULL, 1, '2017-11-13 10:09:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(188, 27, 'Qualify', 'Pending Review', 'Qualify', 'Scheduled Call Back', NULL, 2, '2017-11-16 03:54:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-16', NULL, NULL, NULL, NULL, NULL, NULL),
	(189, 27, 'Qualify', 'Scheduled Call Back', 'Qualify', 'Qualified', NULL, 2, '2017-11-16 03:55:13', NULL, '2017-11-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(190, 27, 'Qualify', 'Qualified', 'Submission', 'Submitted to Client', NULL, 2, '2017-11-16 03:55:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(191, 27, 'Submission', 'Submitted to Client', 'Submission', 'Approved by the Client', NULL, 2, '2017-11-16 03:55:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(192, 27, 'Submission', 'Approved by the Client', 'Interviewing', 'Interview Scheduled', NULL, 2, '2017-11-16 03:56:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 04:00:00', NULL, NULL, NULL, NULL),
	(193, 27, 'Interviewing', 'Interview Scheduled', 'Interviewing', 'Interview In Progress', NULL, 2, '2017-11-16 03:57:06', NULL, NULL, NULL, '2017-11-17 04:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17', NULL, NULL),
	(194, 27, 'Interviewing', 'Interview In Progress', 'Interviewing', 'To be Offered', NULL, 2, '2017-11-16 03:57:42', NULL, NULL, NULL, NULL, NULL, '2017-11-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(195, 27, 'Interviewing', 'To be Offered', 'Offering', 'Offer Made', NULL, 2, '2017-11-16 03:57:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-18', NULL),
	(196, 27, 'Offering', 'Offer Made', 'Offering', 'Offer Accepted', NULL, 2, '2017-11-16 03:58:15', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-18'),
	(197, 27, 'Offering', 'Offer Accepted', 'Placed', 'Joined', NULL, 2, '2017-11-16 03:58:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `job_order_applicant_statuses` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_assignees
CREATE TABLE IF NOT EXISTS `job_order_assignees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cms_users_id` int(10) unsigned NOT NULL,
  `job_orders_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_order_assignees_user_id_foreign` (`cms_users_id`),
  KEY `job_order_assignees_joborder_id_foreign` (`job_orders_id`),
  CONSTRAINT `job_order_assignees_joborder_id_foreign` FOREIGN KEY (`job_orders_id`) REFERENCES `job_orders` (`id`),
  CONSTRAINT `job_order_assignees_user_id_foreign` FOREIGN KEY (`cms_users_id`) REFERENCES `cms_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_assignees: ~6 rows (approximately)
/*!40000 ALTER TABLE `job_order_assignees` DISABLE KEYS */;
INSERT INTO `job_order_assignees` (`id`, `cms_users_id`, `job_orders_id`, `created_at`, `updated_at`) VALUES
	(4, 2, 1, '2017-10-02 11:36:01', '2017-10-02 11:36:01'),
	(5, 4, 10, NULL, NULL),
	(6, 3, 10, NULL, NULL),
	(7, 1, 10, NULL, NULL),
	(8, 4, 11, NULL, NULL),
	(9, 3, 11, NULL, NULL);
/*!40000 ALTER TABLE `job_order_assignees` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_general_skills
CREATE TABLE IF NOT EXISTS `job_order_general_skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_id` int(10) unsigned NOT NULL,
  `general_skill` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `experience` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_order_general_skills_job_order_id_foreign` (`job_order_id`),
  CONSTRAINT `job_order_general_skills_job_order_id_foreign` FOREIGN KEY (`job_order_id`) REFERENCES `job_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_general_skills: ~3 rows (approximately)
/*!40000 ALTER TABLE `job_order_general_skills` DISABLE KEYS */;
INSERT INTO `job_order_general_skills` (`id`, `job_order_id`, `general_skill`, `experience`) VALUES
	(1, 1, 'Positive Attitude', 3),
	(2, 3, 'Team Work', 3),
	(3, 3, 'Solid Communication', 3);
/*!40000 ALTER TABLE `job_order_general_skills` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_industry_functional_areas
CREATE TABLE IF NOT EXISTS `job_order_industry_functional_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_id` int(10) unsigned NOT NULL,
  `industry_functional_area` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  PRIMARY KEY (`id`),
  KEY `job_order_industry_functional_areas_job_order_id_foreign` (`job_order_id`),
  CONSTRAINT `job_order_industry_functional_areas_job_order_id_foreign` FOREIGN KEY (`job_order_id`) REFERENCES `job_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_industry_functional_areas: ~3 rows (approximately)
/*!40000 ALTER TABLE `job_order_industry_functional_areas` DISABLE KEYS */;
INSERT INTO `job_order_industry_functional_areas` (`id`, `job_order_id`, `industry_functional_area`) VALUES
	(1, 1, 'Software'),
	(2, 3, 'Software');
/*!40000 ALTER TABLE `job_order_industry_functional_areas` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_industry_functional_area_skills
CREATE TABLE IF NOT EXISTS `job_order_industry_functional_area_skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_id` int(10) unsigned NOT NULL,
  `industry_functional_area_skill` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  `experience` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_order_industry_functional_area_skills_job_order_id_foreign` (`job_order_id`),
  CONSTRAINT `job_order_industry_functional_area_skills_job_order_id_foreign` FOREIGN KEY (`job_order_id`) REFERENCES `job_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_industry_functional_area_skills: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_order_industry_functional_area_skills` DISABLE KEYS */;
INSERT INTO `job_order_industry_functional_area_skills` (`id`, `job_order_id`, `industry_functional_area_skill`, `experience`) VALUES
	(1, 4, 'English Writing', 3);
/*!40000 ALTER TABLE `job_order_industry_functional_area_skills` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_notes
CREATE TABLE IF NOT EXISTS `job_order_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_id` int(10) unsigned NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_order_notes_job_order_id_foreign` (`job_order_id`),
  CONSTRAINT `job_order_notes_job_order_id_foreign` FOREIGN KEY (`job_order_id`) REFERENCES `job_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_order_notes` DISABLE KEYS */;
INSERT INTO `job_order_notes` (`id`, `job_order_id`, `note`) VALUES
	(1, 1, 'Job Order Submitted & Processing');
/*!40000 ALTER TABLE `job_order_notes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.job_order_preferences
CREATE TABLE IF NOT EXISTS `job_order_preferences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_order_id` int(10) unsigned NOT NULL,
  `preference_name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_order_preferences_job_order_id_foreign` (`job_order_id`),
  CONSTRAINT `job_order_preferences_job_order_id_foreign` FOREIGN KEY (`job_order_id`) REFERENCES `job_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.job_order_preferences: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_order_preferences` DISABLE KEYS */;
INSERT INTO `job_order_preferences` (`id`, `job_order_id`, `preference_name`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Candidates between age 25-30 years', '2017-09-30 10:43:26', '2017-09-30 10:43:56'),
	(2, 4, 'Age between 24-30 years', '2017-10-06 07:30:37', NULL);
/*!40000 ALTER TABLE `job_order_preferences` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table c2wcb_db.migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.offices
CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `started_date` date NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'data from master',
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `primary_contact_name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `primary_contact_email` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `primary_contact_phone` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `secondary_contact_name` tinytext COLLATE utf8_unicode_ci,
  `secondary_contact_email` tinytext COLLATE utf8_unicode_ci,
  `secondary_contact_phone` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `offices_company_id_foreign` (`company_id`),
  KEY `offices_country_id_foreign` (`country_id`),
  KEY `offices_state_id_foreign` (`state_id`),
  KEY `offices_city_id` (`city_id`),
  CONSTRAINT `offices_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `offices_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `offices_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  CONSTRAINT `offices_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.offices: ~5 rows (approximately)
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` (`id`, `name`, `company_id`, `started_date`, `address`, `country_id`, `state_id`, `city_id`, `postal_code`, `status`, `created_at`, `updated_at`, `primary_contact_name`, `primary_contact_email`, `primary_contact_phone`, `secondary_contact_name`, `secondary_contact_email`, `secondary_contact_phone`) VALUES
	(1, 'Head Office', 1, '2015-05-18', 'Statue Jn.', 1, 1, 1, '695001', 1, '2017-09-27 07:18:41', '2017-09-27 08:05:07', 'Arjun Ghosh', '', '', NULL, NULL, NULL),
	(2, 'Development Center', 1, '2014-07-22', 'Statue, Trivandrum', 1, 1, 1, NULL, 1, '2017-09-28 06:23:34', NULL, 'Raj Mahesh', '', '', NULL, NULL, NULL),
	(3, 'Marketing Wing', 1, '2013-07-18', 'Pattom', 1, 1, 1, '1', 1, '2017-09-29 13:58:47', NULL, 'Rajarshi Vishwa', 'rajarshi@mail.com', '7654321111', NULL, NULL, NULL),
	(4, 'Head Office', 2, '2016-04-04', 'H & C buling, Kunnumpuram, Ayurveda College', 1, 1, 1, '1', 1, '2017-10-06 11:31:21', NULL, 'Noble TIlak', 'noble@mail.com', '745896321', NULL, NULL, NULL),
	(5, 'Head Office', 3, '2016-10-10', 'H & C buling, Kunnumpuram, Ayurveda College', 1, 1, 1, '1', 1, '2017-10-09 08:55:45', NULL, 'Anand', 'anand@mail.com', '857469321', 'Akash', 'akash@mail.com', '9985471420'),
	(6, 'CHQ', 4, '2016-08-02', 'XIV-396-J, Block 1, 3rd Floor, TransAsia Corporate Park, Seaport-Airport Road, Chittethukara, Kakkanad', 1, 1, 1, '1', 1, '2017-10-09 13:06:46', NULL, 'Praveena', 'aa@c2w.org', '4714011026', 'SOORYA', 'msdu@c2w.org', '7736043614');
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.office_industries
CREATE TABLE IF NOT EXISTS `office_industries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(10) unsigned NOT NULL,
  `industry` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'data from master',
  PRIMARY KEY (`id`),
  KEY `office_industries_office_id_foreign` (`office_id`),
  CONSTRAINT `office_industries_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.office_industries: ~5 rows (approximately)
/*!40000 ALTER TABLE `office_industries` DISABLE KEYS */;
INSERT INTO `office_industries` (`id`, `office_id`, `industry`) VALUES
	(2, 2, 'Accounting/Finance'),
	(3, 2, 'BPO'),
	(4, 1, 'IT'),
	(5, 3, 'BPO'),
	(6, 1, 'Accounting/Finance'),
	(7, 4, 'IT'),
	(8, 5, 'IT'),
	(9, 6, 'Automotive/ Ancillaries');
/*!40000 ALTER TABLE `office_industries` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.office_notes
CREATE TABLE IF NOT EXISTS `office_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(10) unsigned NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `office_notes_office_id_foreign` (`office_id`),
  CONSTRAINT `office_notes_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.office_notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `office_notes` DISABLE KEYS */;
INSERT INTO `office_notes` (`id`, `office_id`, `note`) VALUES
	(1, 1, '50 employees are currently working in Head office'),
	(2, 1, 'new note added'),
	(3, 5, 'A bunch of young coders.');
/*!40000 ALTER TABLE `office_notes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.postal_codes
CREATE TABLE IF NOT EXISTS `postal_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table c2wcb_db.postal_codes: ~0 rows (approximately)
/*!40000 ALTER TABLE `postal_codes` DISABLE KEYS */;
INSERT INTO `postal_codes` (`id`, `name`) VALUES
	(1, '695001');
/*!40000 ALTER TABLE `postal_codes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.qualifications
CREATE TABLE IF NOT EXISTS `qualifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qualification_level_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `qualifications_qualification_unique` (`qualification`),
  KEY `qualifications_qualification_level_id_foreign` (`qualification_level_id`),
  CONSTRAINT `qualifications_qualification_level_id_foreign` FOREIGN KEY (`qualification_level_id`) REFERENCES `qualification_levels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.qualifications: ~6 rows (approximately)
/*!40000 ALTER TABLE `qualifications` DISABLE KEYS */;
INSERT INTO `qualifications` (`id`, `qualification`, `created_at`, `updated_at`, `qualification_level_id`) VALUES
	(1, 'Mtech', '2017-09-28 11:51:43', NULL, 1),
	(2, 'Btech', '2017-09-29 11:39:36', NULL, 2),
	(3, 'BA', '2017-10-06 06:35:28', NULL, 2),
	(4, 'MA', '2017-10-06 07:02:15', NULL, 1),
	(5, 'PGDCA', '2017-10-09 09:05:22', NULL, 6),
	(6, 'Bachelor in Commerce', '2017-10-09 09:05:59', NULL, 2),
	(7, 'Bachelor in Computer Applications', '2017-10-09 09:06:18', NULL, 2);
/*!40000 ALTER TABLE `qualifications` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.qualification_levels
CREATE TABLE IF NOT EXISTS `qualification_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qual_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `qualification_levels_qual_level_unique` (`qual_level`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.qualification_levels: ~6 rows (approximately)
/*!40000 ALTER TABLE `qualification_levels` DISABLE KEYS */;
INSERT INTO `qualification_levels` (`id`, `qual_level`, `created_at`, `updated_at`) VALUES
	(1, 'Post Graduate', '2017-09-28 11:47:55', NULL),
	(2, 'Graduate', '2017-09-29 11:39:07', NULL),
	(3, 'Diploma', '2017-10-09 09:03:05', NULL),
	(4, 'School Level', '2017-10-09 09:03:16', NULL),
	(5, 'Doctorate', '2017-10-09 09:04:19', NULL),
	(6, 'Post-graduate Diploma', '2017-10-09 09:04:49', NULL);
/*!40000 ALTER TABLE `qualification_levels` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.resumes
CREATE TABLE IF NOT EXISTS `resumes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resume` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `parse_status` int(11) NOT NULL,
  `json_path` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.resumes: ~0 rows (approximately)
/*!40000 ALTER TABLE `resumes` DISABLE KEYS */;
/*!40000 ALTER TABLE `resumes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.sources
CREATE TABLE IF NOT EXISTS `sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table c2wcb_db.sources: ~7 rows (approximately)
/*!40000 ALTER TABLE `sources` DISABLE KEYS */;
INSERT INTO `sources` (`id`, `name`) VALUES
	(1, 'Google'),
	(2, 'Friends'),
	(3, 'Daily'),
	(4, 'Monster'),
	(5, 'Naukri'),
	(6, 'Indeed'),
	(7, 'Times jobs'),
	(8, 'Shine');
/*!40000 ALTER TABLE `sources` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.states
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `states_country_id_foreign` (`country_id`),
  CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.states: ~2 rows (approximately)
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` (`id`, `country_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Kerala', NULL, '2017-09-26 10:01:14', NULL),
	(2, 2, 'Islamabad', NULL, '2017-09-27 12:36:50', '2017-09-27 12:39:15'),
	(3, 3, 'Western', NULL, '2017-10-09 09:46:29', NULL);
/*!40000 ALTER TABLE `states` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.taxes
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` decimal(5,2) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.taxes: ~0 rows (approximately)
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.workflow_primary_statuses
CREATE TABLE IF NOT EXISTS `workflow_primary_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `main_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.workflow_primary_statuses: ~0 rows (approximately)
/*!40000 ALTER TABLE `workflow_primary_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_primary_statuses` ENABLE KEYS */;


-- Dumping structure for table c2wcb_db.workflow_secondary_statuses
CREATE TABLE IF NOT EXISTS `workflow_secondary_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pipeline_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workflow_secondary_statuses_main_status_id_foreign` (`main_status_id`),
  CONSTRAINT `workflow_secondary_statuses_main_status_id_foreign` FOREIGN KEY (`main_status_id`) REFERENCES `workflow_primary_statuses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table c2wcb_db.workflow_secondary_statuses: ~0 rows (approximately)
/*!40000 ALTER TABLE `workflow_secondary_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_secondary_statuses` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
