# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42)
# Database: folite_clean
# Generation Time: 2016-09-01 12:22:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table fx_account_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_account_details`;

CREATE TABLE `fx_account_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'en_US',
  `address` varchar(64) COLLATE utf8_unicode_ci DEFAULT '-',
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT '-',
  `mobile` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(40) COLLATE utf8_unicode_ci DEFAULT 'english',
  `department` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` mediumtext COLLATE utf8_unicode_ci,
  `use_gravatar` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'Y',
  `as_company` enum('false','true') COLLATE utf8_unicode_ci DEFAULT 'false',
  `allowed_modules` text COLLATE utf8_unicode_ci,
  `hourly_rate` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;



# Dump of table fx_activities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_activities`;

CREATE TABLE `fx_activities` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `module` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_field_id` int(11) DEFAULT NULL,
  `activity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'fa-coffee',
  `value1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_api_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_api_access`;

CREATE TABLE `fx_api_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL DEFAULT '',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_api_keys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_api_keys`;

CREATE TABLE `fx_api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `api_key` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text COLLATE utf8_unicode_ci,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_api_limits
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_api_limits`;

CREATE TABLE `fx_api_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_api_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_api_logs`;

CREATE TABLE `fx_api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `params` text COLLATE utf8_unicode_ci,
  `api_key` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` tinyint(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_assign_projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_assign_projects`;

CREATE TABLE `fx_assign_projects` (
  `a_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `assigned_user` int(11) NOT NULL,
  `project_assigned` int(11) NOT NULL,
  `assign_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_assign_tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_assign_tasks`;

CREATE TABLE `fx_assign_tasks` (
  `a_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `assigned_user` int(11) NOT NULL,
  `project_assigned` int(11) NOT NULL,
  `task_assigned` int(11) NOT NULL,
  `assign_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_bug_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_bug_comments`;

CREATE TABLE `fx_bug_comments` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci,
  `date_commented` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_bug_files
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_bug_files`;

CREATE TABLE `fx_bug_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `bug` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_ext` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(5) DEFAULT NULL,
  `is_image` int(2) DEFAULT NULL,
  `image_width` int(5) DEFAULT NULL,
  `image_height` int(5) DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `uploaded_by` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_bugs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_bugs`;

CREATE TABLE `fx_bugs` (
  `bug_id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_ref` int(11) DEFAULT NULL,
  `project` int(11) DEFAULT NULL,
  `reporter` int(11) DEFAULT NULL,
  `assigned_to` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bug_status` enum('Unconfirmed','Confirmed','Pending','Resolved','Verified') COLLATE utf8_unicode_ci DEFAULT 'Pending',
  `issue_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reproducibility` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `severity` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priority` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bug_description` text COLLATE utf8_unicode_ci,
  `reported_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bug_id`),
  UNIQUE KEY `issue_ref` (`issue_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_captcha
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_captcha`;

CREATE TABLE `fx_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(16) COLLATE utf8_unicode_ci DEFAULT '0',
  `word` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_categories`;

CREATE TABLE `fx_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) DEFAULT NULL,
  `module` varchar(32) DEFAULT 'expenses',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `fx_categories` WRITE;
/*!40000 ALTER TABLE `fx_categories` DISABLE KEYS */;

INSERT INTO `fx_categories` (`id`, `cat_name`, `module`)
VALUES
	(1,'Domain Purchase','expenses'),
	(2,'Office Rent','expenses'),
	(3,'Consulting','expenses');

/*!40000 ALTER TABLE `fx_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_comment_replies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_comment_replies`;

CREATE TABLE `fx_comment_replies` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment` int(11) DEFAULT NULL,
  `reply_msg` text COLLATE utf8_unicode_ci,
  `replied_by` int(11) DEFAULT NULL,
  `del` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_comments`;

CREATE TABLE `fx_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `posted_by` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_companies`;

CREATE TABLE `fx_companies` (
  `co_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_ref` int(32) DEFAULT NULL,
  `individual` tinyint(4) DEFAULT '0',
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_contact` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_mobile` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'USD',
  `language` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VAT` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hosting_company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `port` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_holder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iban` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bic` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sortcode` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_config`;

CREATE TABLE `fx_config` (
  `config_key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`config_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `fx_config` WRITE;
/*!40000 ALTER TABLE `fx_config` DISABLE KEYS */;

INSERT INTO `fx_config` (`config_key`, `value`)
VALUES
	('2checkout_private_key',''),
	('2checkout_publishable_key',''),
	('2checkout_seller_id',''),
	('allowed_files','gif|png|jpeg|jpg|pdf|doc|txt|docx|xls|zip|rar|xls|mp4'),
	('allow_client_registration','TRUE'),
	('automatic_email_on_recur','TRUE'),
	('auto_backup_db','TRUE'),
	('auto_close_ticket','30'),
	('beta_updates','FALSE'),
	('billing_email',''),
	('billing_email_name',''),
	('bitcoin_address',''),
	('bitcoin_api_key',''),
	('blur_login','TRUE'),
	('braintee_live','TRUE'),
	('braintree_merchant_id',''),
	('braintree_private_key',''),
	('braintree_public_key',''),
	('build','0'),
	('button_color','success'),
	('captcha_login','FALSE'),
	('chart_color','#11A7DB'),
	('client_create_project','TRUE'),
	('company_address','4146 Golden Woods'),
	('company_city','Sydney'),
	('company_country','Australia'),
	('company_domain',''),
	('company_email',''),
	('company_fax',''),
	('company_legal_name',''),
	('company_logo','logo.png'),
	('company_mobile','(123) 456 00000'),
	('company_name',''),
	('company_phone','(123) 456 78900'),
	('company_phone_2',''),
	('company_registration',''),
	('company_state','Sample State'),
	('company_vat',''),
	('company_zip_code','20300'),
	('contact_person','John Doe'),
	('cron_key','34WI2L12L87I1A65M90M9A42N41D08A26I'),
	('cron_last_run','a:8:{s:14:\"cron_recurring\";a:2:{s:7:\"success\";b:1;s:6:\"result\";s:31:\"There are no recurring invoices\";}s:13:\"cron_projects\";a:2:{s:7:\"success\";b:1;s:6:\"result\";s:29:\"There are no overdue projects\";}s:13:\"cron_invoices\";a:2:{s:7:\"success\";b:1;s:6:\"result\";s:29:\"There are no overdue invoices\";}s:13:\"cron_outgoing\";a:2:{s:7:\"success\";b:1;s:6:\"result\";s:28:\"There are no outgoing emails\";}s:18:\"cron_close_tickets\";a:2:{s:7:\"success\";b:1;s:6:\"result\";s:29:\"There are no inactive tickets\";}s:14:\"cron_backup_db\";a:2:{s:7:\"success\";b:1;s:6:\"result\";s:31:\"Database backed up successfully\";}s:11:\"cron_xrates\";a:2:{s:7:\"success\";b:0;s:6:\"result\";s:30:\"App ID is blank. Rates updated\";}s:18:\"cron_fetch_tickets\";a:2:{s:7:\"success\";b:1;s:6:\"result\";s:15:\"Tickets fetched\";}}'),
	('currency_decimals','2'),
	('currency_position','before'),
	('date_format','%d-%m-%Y'),
	('date_php_format','d-m-Y'),
	('date_picker_format','dd-mm-yyyy'),
	('decimal_separator','.'),
	('default_currency','USD'),
	('default_currency_symbol','$'),
	('default_language','english'),
	('default_project_settings','{\"show_team_members\":\"off\",\"show_milestones\":\"on\",\"show_project_tasks\":\"on\",\"show_project_files\":\"on\",\"show_timesheets\":\"off\",\"show_project_bugs\":\"on\",\"show_project_history\":\"off\",\"show_project_calendar\":\"on\",\"show_project_comments\":\"on\",\"show_project_links\":\"on\",\"client_add_tasks\":\"on\",\"show_project_gantt\":\"on\",\"show_project_hours\":\"on\"}'),
	('default_tax','2.00'),
	('default_tax2','0.00'),
	('default_terms','Thank you for <span style=\"font-weight: bold;\">your</span> business. Please process this invoice within the due date.'),
	('demo_mode','FALSE'),
	('developer','ig63Yd/+yuA8127gEyTz9TY4pnoeKq8dtocVP44+BJvtlRp8Vqcetwjk51dhSB6Rx8aVIKOPfUmNyKGWK7C/gg=='),
	('disable_emails','FALSE'),
	('display_estimate_badge','TRUE'),
	('display_invoice_badge','TRUE'),
	('email_account_details','TRUE'),
	('email_estimate_message','Hi {CLIENT}<br>Thanks for your business inquiry. <br>The estimate EST {REF} is attached with this email. <br>Estimate Overview:<br>Estimate # : EST {REF}<br>Amount: {CURRENCY} {AMOUNT}<br> You can view the estimate online at:<br>{LINK}<br>Best Regards,<br>{COMPANY}'),
	('email_invoice_message','Hello {CLIENT}<br>Here is the invoice of {CURRENCY} {AMOUNT}<br>You can view the invoice online at:<br>{LINK}<br>Best Regards,<br>{COMPANY}'),
	('email_piping','TRUE'),
	('email_staff_tickets','TRUE'),
	('enable_languages','TRUE'),
	('estimate_color','#FB6B5B'),
	('estimate_footer','Powered by Freelancer Office'),
	('estimate_language','en'),
	('estimate_prefix','EST'),
	('estimate_start_no','1'),
	('estimate_terms','Looking forward to doing business with you.'),
	('estimate_to_project','FALSE'),
	('file_max_size','80000'),
	('gcal_api_key',''),
	('gcal_id',''),
	('hide_branding','FALSE'),
	('hide_sidebar','FALSE'),
	('hourly_rate','0.00'),
	('increment_invoice_number','TRUE'),
	('installed','TRUE'),
	('invoices_due_after','15'),
	('invoice_color','#53B567'),
	('invoice_footer','Powered by Freelancer Office'),
	('invoice_language','en'),
	('invoice_logo','invoice_logo.png'),
	('invoice_logo_height','60'),
	('invoice_logo_width','303'),
	('invoice_prefix','INV'),
	('invoice_start_no','1'),
	('languages',''),
	('last_check','1472718040'),
	('last_seen_activities','1469792851'),
	('locale','en_US'),
	('login_bg','bg_login.jpg'),
	('login_title','Project Management'),
	('logo_or_icon','logo_title'),
	('mailbox','INBOX'),
	('mail_encryption','tls'),
	('mail_flags','/novalidate-cert'),
	('mail_imap','TRUE'),
	('mail_imap_host','imap.gmail.com'),
	('mail_password',''),
	('mail_port','993'),
	('mail_search','UNSEEN'),
	('mail_ssl','TRUE'),
	('mail_username',''),
	('notify_bug_assignment','TRUE'),
	('notify_bug_comments','TRUE'),
	('notify_bug_reporter','TRUE'),
	('notify_bug_status','TRUE'),
	('notify_message_received','TRUE'),
	('notify_payment_received','TRUE'),
	('notify_project_assignments','TRUE'),
	('notify_project_comments','TRUE'),
	('notify_project_files','TRUE'),
	('notify_project_opened','TRUE'),
	('notify_task_assignments','TRUE'),
	('notify_task_comments','TRUE'),
	('notify_task_created','TRUE'),
	('notify_ticket_closed','TRUE'),
	('notify_ticket_reopened','TRUE'),
	('notify_ticket_reply','TRUE'),
	('paypal_cancel_url','paypal/cancel'),
	('paypal_email',''),
	('paypal_ipn_url','paypal/t_ipn/ipn'),
	('paypal_live','TRUE'),
	('paypal_success_url','paypal/success'),
	('pdf_engine','mpdf'),
	('postmark_api_key',''),
	('postmark_from_address',''),
	('project_prefix','PRO'),
	('protocol','mail'),
	('purchase_code',''),
	('quantity_decimals','2'),
	('reminder_message','Hello {CLIENT}<br>This is a friendly reminder to pay your invoice of {CURRENCY} {AMOUNT}<br>You can view the invoice online at:<br>{LINK}<br>Best Regards,<br>{COMPANY}'),
	('remote_login_expires','72'),
	('reset_key','34WI2L12L87I1A65M90M9A42N41D08A26I'),
	('rows_per_table','25'),
	('settings','email'),
	('show_estimate_tax','TRUE'),
	('show_invoice_tax','TRUE'),
	('show_login_image','TRUE'),
	('show_only_logo','FALSE'),
	('show_time_ago','TRUE'),
	('sidebar_theme','dark'),
	('site_appleicon','logo_favicon.png'),
	('site_author','William M.'),
	('site_desc','Freelancer Office is a Web based PHP project management system for Freelancers - buy it on codecanyon'),
	('site_favicon','logo_favicon.png'),
	('site_icon','fa-flask'),
	('slack_channel',''),
	('slack_notification','FALSE'),
	('slack_username',''),
	('slack_webhook',''),
	('smtp_encryption',''),
	('smtp_host','in-v3.mailjet.com'),
	('smtp_pass',''),
	('smtp_port','587'),
	('smtp_user',''),
	('stop_timer_logout','FALSE'),
	('stripe_private_key',''),
	('stripe_public_key',''),
	('support_email',''),
	('support_email_name',''),
	('swap_to_from','TRUE'),
	('system_font','roboto'),
	('tax_decimals','2'),
	('theme_color','dark'),
	('thousand_separator',','),
	('ticket_default_department','1'),
	('ticket_start_no','1'),
	('timezone','Europe/Moscow'),
	('top_bar_color','dark'),
	('two_checkout_live','TRUE'),
	('updates','1'),
	('update_xrates','TRUE'),
	('use_alternate_emails','TRUE'),
	('use_gravatar','TRUE'),
	('use_postmark','FALSE'),
	('use_recaptcha','TRUE'),
	('valid_license','TRUE'),
	('webmaster_email',''),
	('website_name',''),
	('xrates_app_id',''),
	('xrates_check','2016-08-12');

/*!40000 ALTER TABLE `fx_config` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_countries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_countries`;

CREATE TABLE `fx_countries` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `value` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `fx_countries` WRITE;
/*!40000 ALTER TABLE `fx_countries` DISABLE KEYS */;

INSERT INTO `fx_countries` (`id`, `value`)
VALUES
	(1,'Afghanistan'),
	(2,'Aringland Islands'),
	(3,'Albania'),
	(4,'Algeria'),
	(5,'American Samoa'),
	(6,'Andorra'),
	(7,'Angola'),
	(8,'Anguilla'),
	(9,'Antarctica'),
	(10,'Antigua and Barbuda'),
	(11,'Argentina'),
	(12,'Armenia'),
	(13,'Aruba'),
	(14,'Australia'),
	(15,'Austria'),
	(16,'Azerbaijan'),
	(17,'Bahamas'),
	(18,'Bahrain'),
	(19,'Bangladesh'),
	(20,'Barbados'),
	(21,'Belarus'),
	(22,'Belgium'),
	(23,'Belize'),
	(24,'Benin'),
	(25,'Bermuda'),
	(26,'Bhutan'),
	(27,'Bolivia'),
	(28,'Bosnia and Herzegovina'),
	(29,'Botswana'),
	(30,'Bouvet Island'),
	(31,'Brazil'),
	(32,'British Indian Ocean territory'),
	(33,'Brunei Darussalam'),
	(34,'Bulgaria'),
	(35,'Burkina Faso'),
	(36,'Burundi'),
	(37,'Cambodia'),
	(38,'Cameroon'),
	(39,'Canada'),
	(40,'Cape Verde'),
	(41,'Cayman Islands'),
	(42,'Central African Republic'),
	(43,'Chad'),
	(44,'Chile'),
	(45,'China'),
	(46,'Christmas Island'),
	(47,'Cocos (Keeling) Islands'),
	(48,'Colombia'),
	(49,'Comoros'),
	(50,'Congo'),
	(51,'Congo'),
	(52,' Democratic Republic'),
	(53,'Cook Islands'),
	(54,'Costa Rica'),
	(55,'Ivory Coast (Ivory Coast)'),
	(56,'Croatia (Hrvatska)'),
	(57,'Cuba'),
	(58,'Cyprus'),
	(59,'Czech Republic'),
	(60,'Denmark'),
	(61,'Djibouti'),
	(62,'Dominica'),
	(63,'Dominican Republic'),
	(64,'East Timor'),
	(65,'Ecuador'),
	(66,'Egypt'),
	(67,'El Salvador'),
	(68,'Equatorial Guinea'),
	(69,'Eritrea'),
	(70,'Estonia'),
	(71,'Ethiopia'),
	(72,'Falkland Islands'),
	(73,'Faroe Islands'),
	(74,'Fiji'),
	(75,'Finland'),
	(76,'France'),
	(77,'French Guiana'),
	(78,'French Polynesia'),
	(79,'French Southern Territories'),
	(80,'Gabon'),
	(81,'Gambia'),
	(82,'Georgia'),
	(83,'Germany'),
	(84,'Ghana'),
	(85,'Gibraltar'),
	(86,'Greece'),
	(87,'Greenland'),
	(88,'Grenada'),
	(89,'Guadeloupe'),
	(90,'Guam'),
	(91,'Guatemala'),
	(92,'Guinea'),
	(93,'Guinea-Bissau'),
	(94,'Guyana'),
	(95,'Haiti'),
	(96,'Heard and McDonald Islands'),
	(97,'Honduras'),
	(98,'Hong Kong'),
	(99,'Hungary'),
	(100,'Iceland'),
	(101,'India'),
	(102,'Indonesia'),
	(103,'Iran'),
	(104,'Iraq'),
	(105,'Ireland'),
	(106,'Israel'),
	(107,'Italy'),
	(108,'Jamaica'),
	(109,'Japan'),
	(110,'Jordan'),
	(111,'Kazakhstan'),
	(112,'Kenya'),
	(113,'Kiribati'),
	(114,'Korea (north)'),
	(115,'Korea (south)'),
	(116,'Kuwait'),
	(117,'Kyrgyzstan'),
	(118,'Lao People\'s Democratic Republic'),
	(119,'Latvia'),
	(120,'Lebanon'),
	(121,'Lesotho'),
	(122,'Liberia'),
	(123,'Libyan Arab Jamahiriya'),
	(124,'Liechtenstein'),
	(125,'Lithuania'),
	(126,'Luxembourg'),
	(127,'Macao'),
	(128,'Macedonia'),
	(129,'Madagascar'),
	(130,'Malawi'),
	(131,'Malaysia'),
	(132,'Maldives'),
	(133,'Mali'),
	(134,'Malta'),
	(135,'Marshall Islands'),
	(136,'Martinique'),
	(137,'Mauritania'),
	(138,'Mauritius'),
	(139,'Mayotte'),
	(140,'Mexico'),
	(141,'Micronesia'),
	(142,'Moldova'),
	(143,'Monaco'),
	(144,'Mongolia'),
	(145,'Montserrat'),
	(146,'Morocco'),
	(147,'Mozambique'),
	(148,'Myanmar'),
	(149,'Namibia'),
	(150,'Nauru'),
	(151,'Nepal'),
	(152,'Netherlands'),
	(153,'Netherlands Antilles'),
	(154,'New Caledonia'),
	(155,'New Zealand'),
	(156,'Nicaragua'),
	(157,'Niger'),
	(158,'Nigeria'),
	(159,'Niue'),
	(160,'Norfolk Island'),
	(161,'Northern Mariana Islands'),
	(162,'Norway'),
	(163,'Oman'),
	(164,'Pakistan'),
	(165,'Palau'),
	(166,'Palestinian Territories'),
	(167,'Panama'),
	(168,'Papua New Guinea'),
	(169,'Paraguay'),
	(170,'Peru'),
	(171,'Philippines'),
	(172,'Pitcairn'),
	(173,'Poland'),
	(174,'Portugal'),
	(175,'Puerto Rico'),
	(176,'Qatar'),
	(177,'Runion'),
	(178,'Romania'),
	(179,'Russian Federation'),
	(180,'Rwanda'),
	(181,'Saint Helena'),
	(182,'Saint Kitts and Nevis'),
	(183,'Saint Lucia'),
	(184,'Saint Pierre and Miquelon'),
	(185,'Saint Vincent and the Grenadines'),
	(186,'Samoa'),
	(187,'San Marino'),
	(188,'Sao Tome and Principe'),
	(189,'Saudi Arabia'),
	(190,'Senegal'),
	(191,'Serbia and Montenegro'),
	(192,'Seychelles'),
	(193,'Sierra Leone'),
	(194,'Singapore'),
	(195,'Slovakia'),
	(196,'Slovenia'),
	(197,'Solomon Islands'),
	(198,'Somalia'),
	(199,'South Africa'),
	(200,'South Georgia and the South Sandwich Islands'),
	(201,'Spain'),
	(202,'Sri Lanka'),
	(203,'Sudan'),
	(204,'Suriname'),
	(205,'Svalbard and Jan Mayen Islands'),
	(206,'Swaziland'),
	(207,'Sweden'),
	(208,'Switzerland'),
	(209,'Syria'),
	(210,'Taiwan'),
	(211,'Tajikistan'),
	(212,'Tanzania'),
	(213,'Thailand'),
	(214,'Togo'),
	(215,'Tokelau'),
	(216,'Tonga'),
	(217,'Trinidad and Tobago'),
	(218,'Tunisia'),
	(219,'Turkey'),
	(220,'Turkmenistan'),
	(221,'Turks and Caicos Islands'),
	(222,'Tuvalu'),
	(223,'Uganda'),
	(224,'Ukraine'),
	(225,'United Arab Emirates'),
	(226,'United Kingdom'),
	(227,'United States of America'),
	(228,'Uruguay'),
	(229,'Uzbekistan'),
	(230,'Vanuatu'),
	(231,'Vatican City'),
	(232,'Venezuela'),
	(233,'Vietnam'),
	(234,'Virgin Islands (British)'),
	(235,'Virgin Islands (US)'),
	(236,'Wallis and Futuna Islands'),
	(237,'Western Sahara'),
	(238,'Yemen'),
	(239,'Zaire'),
	(240,'Zambia'),
	(241,'Zimbabwe');

/*!40000 ALTER TABLE `fx_countries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_currencies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_currencies`;

CREATE TABLE `fx_currencies` (
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xrate` decimal(12,5) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `fx_currencies` WRITE;
/*!40000 ALTER TABLE `fx_currencies` DISABLE KEYS */;

INSERT INTO `fx_currencies` (`code`, `name`, `symbol`, `xrate`)
VALUES
	('AED','United Arab Emirates Dirham','د.إ',3.67289),
	('AUD','Australian Dollar','$',1.30080),
	('BRL','Brazilian Real','R$',3.14040),
	('CAD','Canadian Dollar','$',1.29832),
	('CHF','Swiss Franc','Fr',0.97409),
	('CLP','Chilean Peso','$',648.05470),
	('CNY','Chinese Yuan','¥',6.64129),
	('CZK','Czech Koruna','Kč',24.22761),
	('DKK','Danish Krone','Kr',6.66957),
	('EUR','Euro','€',0.89650),
	('GBP','British Pound','£',0.77119),
	('HKD','Hong Kong Dollar','$',7.75631),
	('HUF','Hungarian Forint','Ft',278.03320),
	('IDR','Indonesian Rupiah','Rp',13117.60000),
	('ILS','Israeli New Shekel','₪',3.81352),
	('INR','Indian Rupee','₹',66.80453),
	('JPY','Japanese Yen','¥',101.96110),
	('KES','Kenya shillings',' KSh',101.47569),
	('KRW','Korean Won','₩',1101.70668),
	('MXN','Mexican Peso','$',18.28351),
	('MYR','Malaysian Ringgit','RM',4.01622),
	('NOK','Norwegian Krone','kr',8.24010),
	('NZD','New Zealand Dollar','$',1.38963),
	('PHP','Philippine Peso','₱',46.67836),
	('PKR','Pakistan Rupee','₨',104.58520),
	('PLN','Polish Zloty','zł',3.81973),
	('RUB','Russian Ruble','₽',64.32546),
	('SEK','Swedish Krona','kr',8.45683),
	('SGD','Singapore Dollar','$',1.34558),
	('THB','Thai Baht','฿',34.80894),
	('TRY','Turkish Lira','₺',2.95759),
	('TWD','Taiwan Dollar','$',31.37491),
	('USD','US Dollar','$',1.00000),
	('VEF','Bolívar Fuerte','Bs.',9.97100),
	('ZAR','South African Rand','R',13.38618);

/*!40000 ALTER TABLE `fx_currencies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_departments`;

CREATE TABLE `fx_departments` (
  `deptid` int(10) NOT NULL AUTO_INCREMENT,
  `deptname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `depthidden` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`deptid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_email_templates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_email_templates`;

CREATE TABLE `fx_email_templates` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_group` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template_body` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `fx_email_templates` WRITE;
/*!40000 ALTER TABLE `fx_email_templates` DISABLE KEYS */;

INSERT INTO `fx_email_templates` (`template_id`, `email_group`, `subject`, `template_body`)
VALUES
	(1,'registration','Registration successful','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>New Account</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {USERNAME},</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			Thanks for joining {SITE_NAME}. We listed your sign in details below, make sure you keep them safe.<br>			To open your {SITE_NAME} homepage, please follow this link:<br>			<a href=\"{SITE_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>{SITE_NAME} Account</strong></a><br><br>			Link doesn\'t work? Copy the following link to your browser address bar:<br><br>{SITE_URL}<br><br>			Your username: {USERNAME}<br>			Your email address: {EMAIL}<br>			Your password: {PASSWORD}<br><br><br>										Best Regards,<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(2,'forgot_password','Forgot Password','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>New Password</h4>\n																	<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			Forgot your password, huh? No big deal.<br>To create a new password, just follow this link:<br>			<a href=\"{PASS_KEY_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>Create new password</strong></a><br><br>			Link doesn\'t work? Copy the following link to your browser address bar:<br>			{PASS_KEY_URL}<br><br>			You received this email, because it was requested by a {SITE_NAME} user.This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same.<br><br>Thank you,<br><br>										Best Regards,<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(3,'change_email','Change Email','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px; \">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>Change Email</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {NEW_EMAIL},</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			You have changed your email address for {SITE_NAME}.<br>Follow this link to confirm your new email address:<br>			<a href=\"{NEW_EMAIL_KEY_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>Confirm Email</strong></a><br><br>			Link doesn\'t work? Copy the following link to your browser address bar:<br>			{NEW_EMAIL_KEY_URL}<br><br>			Your email address: {NEW_EMAIL}<br><br>			You received this email, because it was requested by a {SITE_NAME} user. If you have received this by mistake, please DO NOT click the confirmation link, and simply delete this email. After a short time, the request will be removed from the system.<br><br>Thank you,<br><br>										Best Regards,<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(4,'activate_account','Activate Account','                                                            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\"> </td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px; \">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\"> </td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>Activate Account</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {USERNAME},</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			Thanks for joining {SITE_NAME}. We listed your sign in details below, make sure you keep them safe.			To verify your email address, please follow this link:<br>			<a href=\"{ACTIVATE_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>Complete Registration</strong></a><br><br>			Link doesn\'t work? Copy the following link to your browser address bar:<br>			{ACTIVATE_URL}<br>			Please verify your email within {ACTIVATION_PERIOD} hours, otherwise your registration will become invalid and you will have to register again.<br><br>			Your username: {USERNAME}<br>			Your email address: {EMAIL}<br>			Your password: {PASSWORD}<br><br><br>																					Best Regards,<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\"> </td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\"> </td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(5,'reset_password','Reset Password','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>New Password</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {USERNAME},</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			You have changed your password.<br>Please, keep it in your records so you don\'t forget it:<br>Your username: {USERNAME}<br>Your email address: {EMAIL}<br>Your new password: {NEW_PASSWORD}<br><br><br>										Best Regards,<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(6,'bug_assigned','Bug : {TITLE} assigned','                                        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">	<tbody>		<tr>			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">				<tbody>					<tr>						<td height=\"50\" width=\"600\"> </td>					</tr>					<tr>						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>					</tr>					<tr>						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">							<tbody>								<tr>									<td height=\"10\" width=\"560\"> </td>								</tr>								<tr>									<td width=\"560\">									<h4>Bug assigned</h4>									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			A new bug <strong>{ISSUE_TITLE} </strong> has been assigned to you by <strong>{ASSIGNED_BY}</strong> in project <strong>{PROJECT_TITLE}</strong>.<br>You can view this bug by logging in to the portal using the link below:<br><a href=\"{SITE_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,<br>																		{SITE_NAME}</p>									</td>								</tr>								<tr>									<td height=\"10\" width=\"560\"> </td>								</tr>							</tbody>						</table>						</td>					</tr>					<tr>						<td height=\"10\" width=\"600\"> </td>					</tr>					<tr>						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>					</tr>				</tbody>			</table>			</td>		</tr>	</tbody></table>'),
	(7,'bug_status','Bug status changed','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">	<tbody>		<tr>			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">				<tbody>					<tr>						<td height=\"50\" width=\"600\">&nbsp;</td>					</tr>					<tr>						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>					</tr>					<tr>						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">							<tbody>								<tr>									<td height=\"10\" width=\"560\">&nbsp;</td>								</tr>								<tr>									<td width=\"560\">									<h4>Bug status changed</h4>									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi There,</p>								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			Bug <strong>{ISSUE_TITLE}</strong> has been marked as <strong>{STATUS}</strong> by <strong>{MARKED_BY}</strong>.<br>You can view this bug by logging in to the portal using the link below:<br><a href=\"{BUG_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,<br>																		{SITE_NAME}</p>									</td>								</tr>								<tr>									<td height=\"10\" width=\"560\">&nbsp;</td>								</tr>							</tbody>						</table>						</td>					</tr>					<tr>						<td height=\"10\" width=\"600\">&nbsp;</td>					</tr>					<tr>						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>					</tr>				</tbody>			</table>			</td>		</tr>	</tbody></table>'),
	(8,'bug_comment','New Comment','                                                                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n				<tbody>\r\n					<tr>\r\n						<td height=\"50\" width=\"600\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\r\n					</tr>\r\n					<tr>\r\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\r\n							<tbody>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n								</tr>\r\n								<tr>\r\n									<td width=\"560\">									<h4>New comment received</h4>\r\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi There,</p>\r\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			A new comment has been posted by <strong>{POSTED_BY}</strong> to bug <strong>{ISSUE_TITLE}</strong>.<br>You can view the comment using the link below:<br><a href=\"{COMMENT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br>\r\n<span style=\"font-style:italic;\">{COMMENT_MESSAGE}</span>\r\n<br><br>\r\nBest Regards,<br>																		{SITE_NAME}</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"10\" width=\"600\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>'),
	(9,'bug_file','New bug file','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>New Upload</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi There,</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			A new file has been uploaded by <strong>{UPLOADED_BY}</strong> to issue <strong>{ISSUE_TITLE}</strong>.<br>You can view the bug using the link below.:<br><a href=\"{BUG_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(10,'bug_reported','Bug : {TITLE}','                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">	<tbody>		<tr>			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">				<tbody>					<tr>						<td height=\"50\" width=\"600\"> </td>					</tr>					<tr>						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>					</tr>					<tr>						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">							<tbody>								<tr>									<td height=\"10\" width=\"560\"> </td>								</tr>								<tr>									<td width=\"560\">									<h4>New bug reported</h4>									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi There,</p>								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			A new bug <strong>{ISSUE_TITLE}</strong> has been reported by <strong>{ADDED_BY}</strong>.<br>You can view the Bug using the Dashboard Page:<br><a href=\"{BUG_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>									</td>								</tr>								<tr>									<td height=\"10\" width=\"560\"> </td>								</tr>							</tbody>						</table>						</td>					</tr>					<tr>						<td height=\"10\" width=\"600\"> </td>					</tr>					<tr>						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>					</tr>				</tbody>			</table>			</td>		</tr>	</tbody></table>'),
	(11,'project_file','New Project File','                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>New Upload</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			A new file has been uploaded by <strong>{UPLOADED_BY}</strong> to project <strong>{PROJECT_TITLE}</strong>.<br>You can view the Project using the link below:<br><a href=\"{PROJECT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(12,'project_complete','Project Completed','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>Project Completed</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {CLIENT_NAME},</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			Project : <strong>{PROJECT_TITLE}</strong> - <strong>{PROJECT_CODE}</strong> has been completed.<br>You can view the project by logging into your portal Account:<br><a href=\"{PROJECT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br>Project Overview:<br>Hours Logged # : <strong>{PROJECT_HOURS}</strong> hours<br>Project Cost : <strong>{PROJECT_COST}</strong><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(13,'project_comment','New Comment','                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n\n	<tbody>\n\n		<tr>\n\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n\n				<tbody>\n\n					<tr>\n\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n\n					</tr>\n\n					<tr>\n\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n\n					</tr>\n\n					<tr>\n\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n\n							<tbody>\n\n								<tr>\n\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n\n								</tr>\n\n								<tr>\n\n									<td width=\"560\">\n									<h4>New comment received</h4>\n\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>\n\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">\n			A new comment has been posted by <strong>{POSTED_BY}</strong> to project <strong>{PROJECT_TITLE}</strong>.\n\nYou can view the comment using the link below:<br>\n<a href=\"{COMMENT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a>\n<br><br>\n<span style=\"font-style:italic;\">{COMMENT_MESSAGE}</span>\n<br><br>\n\n									Best Regards,\n									<br>									\n									{SITE_NAME}</p>\n\n									</td>\n\n								</tr>\n\n								<tr>\n\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n\n								</tr>\n\n							</tbody>\n\n						</table>\n\n						</td>\n\n					</tr>\n\n					<tr>\n\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n\n					</tr>\n\n					<tr>\n\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n\n					</tr>\n\n				</tbody>\n\n			</table>\n\n			</td>\n\n		</tr>\n\n	</tbody>\n\n</table>'),
	(14,'task_assigned','Task assigned','                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>Task Assigned</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			A new task <strong>{TASK_NAME}</strong> has been assigned to you by <strong>{ASSIGNED_BY}</strong> in project <strong>{PROJECT_TITLE}</strong>.You can view this task by logging in to the portal using the link below:<br><a href=\"{PROJECT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(15,'project_assigned','Project assigned','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">	<tbody>		<tr>			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">				<tbody>					<tr>						<td height=\"50\" width=\"600\">&nbsp;</td>					</tr>					<tr>						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>					</tr>					<tr>						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">							<tbody>								<tr>									<td height=\"10\" width=\"560\">&nbsp;</td>								</tr>								<tr>									<td width=\"560\">									<h4>Project Assigned</h4>									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			A new project <strong>{PROJECT_TITLE}</strong> has been assigned to you by <strong>{ASSIGNED_BY}</strong>.<br>You can view this project by logging in to the portal using the link below:<br><a href=\"{PROJECT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>									</td>								</tr>								<tr>									<td height=\"10\" width=\"560\">&nbsp;</td>								</tr>							</tbody>						</table>						</td>					</tr>					<tr>						<td height=\"10\" width=\"600\">&nbsp;</td>					</tr>					<tr>						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>					</tr>				</tbody>			</table>			</td>		</tr>	</tbody></table>'),
	(16,'payment_email','Payment Received','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\r\n\r\n	<tbody>\r\n\r\n		<tr>\r\n\r\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n				<tbody>\r\n\r\n					<tr>\r\n\r\n						<td height=\"50\" width=\"600\">&nbsp;</td>\r\n\r\n					</tr>\r\n\r\n					<tr>\r\n\r\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\r\n\r\n					</tr>\r\n\r\n					<tr>\r\n\r\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\r\n\r\n							<tbody>\r\n\r\n								<tr>\r\n\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n\r\n								</tr>\r\n\r\n								<tr>\r\n\r\n									<td width=\"560\">									<h4>Invoice {REF} Payment</h4>\r\n\r\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Dear Customer,</p>\r\n\r\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">								We have received your payment of {INVOICE_CURRENCY}{PAID_AMOUNT}.<br>								Thank you for your Payment and business. We look forward to working with you again.<br>								--------------------------<br>																		<br><br>																		Best Regards,<br>																		{SITE_NAME}</p>\r\n\r\n									</td>\r\n\r\n								</tr>\r\n\r\n								<tr>\r\n\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n\r\n								</tr>\r\n\r\n							</tbody>\r\n\r\n						</table>\r\n\r\n						</td>\r\n\r\n					</tr>\r\n\r\n					<tr>\r\n\r\n						<td height=\"10\" width=\"600\">&nbsp;</td>\r\n\r\n					</tr>\r\n\r\n					<tr>\r\n\r\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\r\n\r\n					</tr>\r\n\r\n				</tbody>\r\n\r\n			</table>\r\n\r\n			</td>\r\n\r\n		</tr>\r\n\r\n	</tbody>\r\n\r\n</table>'),
	(17,'invoice_message','New Invoice','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>Invoice {REF}</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello {CLIENT},</p>\n									<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">Here is the invoice of {CURRENCY}{AMOUNT}<br>									You can login to see the status of your invoice by using this link:<br>									<a href=\"{INVOICE_LINK}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Invoice</strong></a><br>									<br>									Best Regards,<br>									{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(18,'invoice_reminder','Invoice Reminder','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>Invoice {REF} Reminder</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello {CLIENT},</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">									This is a friendly reminder to pay your invoice of {CURRENCY}{AMOUNT}<br>									You can view the invoice online at:<br>																		<a href=\"{INVOICE_LINK}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Invoice</strong>									</a><br><br>																		Best Regards,<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(19,'message_received','Message Received','<table align=\"center\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px; \">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>New message received</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {RECIPIENT},</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">You have received a message from <strong>{SENDER}</strong>.<br>------------------------------------------------------------------:<br><span style=\"font-style:italic;\">{MESSAGE}</span><br><br><a href=\"{SITE_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Message</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(20,'estimate_email','New Estimate','                    <table style=\"margin-left:20px; \" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px; \">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>Estimate {ESTIMATE_REF} Created</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {CLIENT},</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">Thanks for your business inquiry.<br>The estimate <strong>{ESTIMATE_REF}</strong> is attached with this email.<br><br>Estimate Overview:<br>Estimate # : <strong>{ESTIMATE_REF}</strong><br>Amount: <strong>{CURRENCY}{AMOUNT}</strong><br>\nCreated: <strong>{CREATED_DATE}</strong><br>\nDue Date: <strong>{DUE_DATE}</strong><br>\nYou can view the estimate online at:<br><a href=\"{ESTIMATE_LINK}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Estimate</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(21,'ticket_staff_email','Ticket [SUBJECT]','                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n				<tbody>\r\n					<tr>\r\n						<td height=\"50\" width=\"600\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\r\n					</tr>\r\n					<tr>\r\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\r\n							<tbody>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n								</tr>\r\n								<tr>\r\n									<td width=\"560\">									<h4>New Ticket</h4>\r\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {USER_EMAIL},</p>\r\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">Ticket <strong>{SUBJECT}</strong> has been opened.<br>You may view the ticket by clicking on the following link:<br>Client Email : {REPORTER_EMAIL}<br><br><a href=\"{TICKET_LINK}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Ticket</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"10\" width=\"600\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>'),
	(22,'ticket_client_email','Ticket [SUBJECT]','                                                                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n				<tbody>\r\n					<tr>\r\n						<td height=\"50\" width=\"600\"> </td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\r\n					</tr>\r\n					<tr>\r\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\r\n							<tbody>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\"> </td>\r\n								</tr>\r\n								<tr>\r\n									<td width=\"560\">									<h4>Ticket Opened</h4>\r\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {CLIENT_EMAIL},</p>\r\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			Your ticket has been opened with us.<br>Ticket <strong>{SUBJECT}</strong><br>Status : Open<br>Click on the below link to see the ticket details and post replies: <br><a href=\"{TICKET_LINK}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Ticket</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\"> </td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"10\" width=\"600\"> </td>\r\n					</tr>\r\n					<tr>\r\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>'),
	(23,'ticket_reply_email','Ticket [SUBJECT] response','                                                                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">	<tbody>		<tr>			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">				<tbody>					<tr>						<td height=\"50\" width=\"600\">&nbsp;</td>					</tr>					<tr>						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>					</tr>					<tr>						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">							<tbody>								<tr>									<td height=\"10\" width=\"560\">&nbsp;</td>								</tr>								<tr>									<td width=\"560\">									<h4>Ticket Response</h4>									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi There,</p>								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">A new response has been added to Ticket <strong>{SUBJECT}</strong><br><br>Ticket : <strong>#{TICKET_CODE}</strong><br>Status : <strong>{TICKET_STATUS}</strong><br><span style=\"font-style:italic;\">{TICKET_REPLY}</span><br><br>\r\nTo see the response and post additional comments, click on the link below:<br><a href=\"{TICKET_LINK}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Ticket</strong></a><br><br>								Best Regards,<br>																		{SITE_NAME}</p>									</td>								</tr>								<tr>									<td height=\"10\" width=\"560\">&nbsp;</td>								</tr>							</tbody>						</table>						</td>					</tr>					<tr>						<td height=\"10\" width=\"600\">&nbsp;</td>					</tr>					<tr>						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>					</tr>				</tbody>			</table>			</td>		</tr>	</tbody></table>'),
	(24,'ticket_closed_email','Ticket [SUBJECT] closed','                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">	<tbody>		<tr>			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">				<tbody>					<tr>						<td height=\"50\" width=\"600\">&nbsp;</td>					</tr>					<tr>						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>					</tr>					<tr>						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">							<tbody>								<tr>									<td height=\"10\" width=\"560\">&nbsp;</td>								</tr>								<tr>									<td width=\"560\">									<h4>Ticket Closed</h4>									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {REPORTER_EMAIL},</p>								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			Ticket <strong>{SUBJECT}</strong> has been closed by <strong>{STAFF_USERNAME}</strong><br>Ticket : <strong>#{TICKET_CODE}</strong><br>Status : <strong>{TICKET_STATUS}</strong><br>To see the responses or open the ticket, click on the link below:<br><a href=\"{TICKET_LINK}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Ticket</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>									</td>								</tr>								<tr>									<td height=\"10\" width=\"560\">&nbsp;</td>								</tr>							</tbody>						</table>						</td>					</tr>					<tr>						<td height=\"10\" width=\"600\">&nbsp;</td>					</tr>					<tr>						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>					</tr>				</tbody>			</table>			</td>		</tr>	</tbody></table>'),
	(25,'project_updated','Project updated','                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>Project Updated</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			<strong>{PROJECT_TITLE}</strong> has been updated by <strong>{ASSIGNED_BY}</strong>.You can view this project by logging in to the portal using the link below:<br><a href=\"{PROJECT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(26,'task_updated','Task updated','                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n\n	<tbody>\n\n		<tr>\n\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n\n				<tbody>\n\n					<tr>\n\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n\n					</tr>\n\n					<tr>\n\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n\n					</tr>\n\n					<tr>\n\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n\n							<tbody>\n\n								<tr>\n\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n\n								</tr>\n\n								<tr>\n\n									<td width=\"560\">\n									<h4>Task Updated</h4>\n\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>\n\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">\n			<strong>{TASK_NAME}</strong> in <strong>{PROJECT_TITLE}</strong> has been updated by <strong>{ASSIGNED_BY}</strong>.<br>\n\nYou can view this project by logging in to the portal using the link below:<br>\n<a href=\"{PROJECT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a>\n<br><br><br>\n\n									Best Regards,\n									<br>									\n									{SITE_NAME}</p>\n\n									</td>\n\n								</tr>\n\n								<tr>\n\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n\n								</tr>\n\n							</tbody>\n\n						</table>\n\n						</td>\n\n					</tr>\n\n					<tr>\n\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n\n					</tr>\n\n					<tr>\n\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n\n					</tr>\n\n				</tbody>\n\n			</table>\n\n			</td>\n\n		</tr>\n\n	</tbody>\n\n</table>'),
	(27,'email_signature',NULL,'                    <p>                                        1234 Main Street, Anywhere, MA 01234, USA</p>'),
	(28,'auto_close_ticket','Ticket Auto Closed','                                        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n				<tbody>\r\n					<tr>\r\n						<td height=\"50\" width=\"600\"> </td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\r\n					</tr>\r\n					<tr>\r\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\r\n							<tbody>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\"> </td>\r\n								</tr>\r\n								<tr>\r\n									<td width=\"560\">									<h4>Ticket Closed</h4>\r\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {REPORTER_EMAIL},</p>\r\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">Ticket <strong>{SUBJECT}</strong> has been auto closed due to inactivity. <br><br>Ticket : <strong>#{TICKET_CODE}</strong><br>Status : <strong>{TICKET_STATUS}</strong><br>To see the responses or open the ticket, click on the link below:<br><a href=\"{TICKET_LINK}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Ticket</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\"> </td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"10\" width=\"600\"> </td>\r\n					</tr>\r\n					<tr>\r\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>'),
	(29,'project_created','Project Created','                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\n	<tbody>\n		<tr>\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n				<tbody>\n					<tr>\n						<td height=\"50\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\n							<tbody>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n								<tr>\n									<td width=\"560\">									<h4>Project Opened</h4>\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			<strong>{PROJECT_TITLE}</strong> has been opened by <span style=\"font-weight: bold;\">{CREATED_BY}</span>. You can view this project by logging in to the portal using the link below:<br><a href=\"{PROJECT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\n									</td>\n								</tr>\n								<tr>\n									<td height=\"10\" width=\"560\">&nbsp;</td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td height=\"10\" width=\"600\">&nbsp;</td>\n					</tr>\n					<tr>\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n	</tbody>\n</table>'),
	(30,'task_created','Task Created','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\r\n\r\n\r\n	<tbody>\r\n\r\n\r\n		<tr>\r\n\r\n\r\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n\r\n				<tbody>\r\n\r\n\r\n					<tr>\r\n\r\n\r\n						<td height=\"50\" width=\"600\">&nbsp;</td>\r\n\r\n\r\n					</tr>\r\n\r\n\r\n					<tr>\r\n\r\n\r\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\r\n\r\n\r\n					</tr>\r\n\r\n\r\n					<tr>\r\n\r\n\r\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\r\n\r\n\r\n							<tbody>\r\n\r\n\r\n								<tr>\r\n\r\n\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n\r\n\r\n								</tr>\r\n\r\n\r\n								<tr>\r\n\r\n\r\n									<td width=\"560\">									<h4>Task Created</h4>\r\n\r\n\r\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>\r\n\r\n\r\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			<strong>{TASK_NAME}</strong> has been created by <span style=\"font-weight: bold;\">{CREATED_BY}</span>. You can view this task by logging in to the portal using the link below:<br><a href=\"{PROJECT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\r\n\r\n\r\n									</td>\r\n\r\n\r\n								</tr>\r\n\r\n\r\n								<tr>\r\n\r\n\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n\r\n\r\n								</tr>\r\n\r\n\r\n							</tbody>\r\n\r\n\r\n						</table>\r\n\r\n\r\n						</td>\r\n\r\n\r\n					</tr>\r\n\r\n\r\n					<tr>\r\n\r\n\r\n						<td height=\"10\" width=\"600\">&nbsp;</td>\r\n\r\n\r\n					</tr>\r\n\r\n\r\n					<tr>\r\n\r\n\r\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\r\n\r\n\r\n					</tr>\r\n\r\n\r\n				</tbody>\r\n\r\n\r\n			</table>\r\n\r\n\r\n			</td>\r\n\r\n\r\n		</tr>\r\n\r\n\r\n	</tbody>\r\n\r\n\r\n</table>'),
	(31,'task_comment','Task Comment','<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n				<tbody>\r\n					<tr>\r\n						<td height=\"50\" width=\"600\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\r\n					</tr>\r\n					<tr>\r\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\r\n							<tbody>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n								</tr>\r\n								<tr>\r\n									<td width=\"560\">									<h4>New comment received</h4>\r\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hello,</p>\r\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			A new comment has been posted by <strong>{POSTED_BY}</strong> to task&nbsp;<strong>{TASK_NAME}</strong>.You can view the comment using the link below:<br><a href=\"{COMMENT_URL}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Dashboard</strong></a><br><br><span style=\"font-style:italic;\">{COMMENT_MESSAGE}</span><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"10\" width=\"600\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>'),
	(32,'ticket_reopened_email','Ticket [SUBJECT] reopened','                                                            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"top\">			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n				<tbody>\r\n					<tr>\r\n						<td height=\"50\" width=\"600\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"90\" style=\"color:#999999\" width=\"600\">{INVOICE_LOGO}</td>\r\n					</tr>\r\n					<tr>\r\n						<td bgcolor=\"whitesmoke\" height=\"200\" style=\"background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif\" valign=\"top\" width=\"600\">						<table align=\"center\" style=\"margin-left:15px;\">\r\n							<tbody>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n								</tr>\r\n								<tr>\r\n									<td width=\"560\">									<h4>Ticket re-opened</h4>\r\n									<p style=\"font-size:12px; font-family:Helvetica,Arial,sans-serif\">Hi {RECIPIENT},</p>\r\n								<p style=\"font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif\">			Ticket <b>{SUBJECT}</b> was re-opened by <b>{USER}</b>.<br>Status : Open<br>Click on the below link to see the ticket details and post replies: <br><a href=\"{TICKET_LINK}\" style=\"color: #11A7DB; text-decoration: none;\"><strong>View Ticket</strong></a><br><br><br>									Best Regards,									<br>																		{SITE_NAME}</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td height=\"10\" width=\"560\">&nbsp;</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"10\" width=\"600\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td align=\"right\"><span style=\"font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif\">{SIGNATURE}</span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>');

/*!40000 ALTER TABLE `fx_email_templates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_estimate_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_estimate_items`;

CREATE TABLE `fx_estimate_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_tax_rate` decimal(10,2) DEFAULT '0.00',
  `item_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT 'Item Name',
  `item_desc` longtext COLLATE utf8_unicode_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `item_tax_total` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `estimate_id` int(11) NOT NULL,
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_order` int(11) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_estimates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_estimates`;

CREATE TABLE `fx_estimates` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `due_date` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'USD',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8_unicode_ci,
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax2` decimal(10,2) DEFAULT '0.00',
  `status` enum('Accepted','Declined','Pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `date_sent` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `est_deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'No',
  `show_client` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'Yes',
  `invoiced` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'No',
  PRIMARY KEY (`est_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_events`;

CREATE TABLE `fx_events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) DEFAULT NULL,
  `description` text,
  `start_date` varchar(64) DEFAULT NULL,
  `end_date` varchar(64) DEFAULT NULL,
  `project` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `color` varchar(32) DEFAULT '#38354a',
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_expenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_expenses`;

CREATE TABLE `fx_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` int(11) DEFAULT NULL,
  `billable` int(11) DEFAULT '1',
  `amount` decimal(10,2) DEFAULT '0.00',
  `expense_date` varchar(32) DEFAULT NULL,
  `notes` text,
  `project` int(11) DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `invoiced` int(11) DEFAULT NULL,
  `invoiced_id` int(11) DEFAULT NULL,
  `show_client` enum('Yes','No') DEFAULT 'Yes',
  `category` int(11) DEFAULT NULL,
  `saved` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_fields`;

CREATE TABLE `fx_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `deptid` int(10) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uniqid` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_files
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_files`;

CREATE TABLE `fx_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `client_id` int(11) DEFAULT '0',
  `file_name` text COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ext` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `is_image` int(2) DEFAULT NULL,
  `image_width` int(5) DEFAULT NULL,
  `image_height` int(5) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `uploaded_by` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_hooks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_hooks`;

CREATE TABLE `fx_hooks` (
  `module` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `parent` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hook` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(10) DEFAULT NULL,
  `access` int(2) NOT NULL,
  `core` int(2) DEFAULT NULL,
  `visible` int(2) DEFAULT '1',
  `permission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` int(2) NOT NULL DEFAULT '1',
  `last_run` datetime DEFAULT NULL,
  PRIMARY KEY (`module`,`hook`,`access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `fx_hooks` WRITE;
/*!40000 ALTER TABLE `fx_hooks` DISABLE KEYS */;

INSERT INTO `fx_hooks` (`module`, `parent`, `hook`, `icon`, `name`, `route`, `order`, `access`, `core`, `visible`, `permission`, `enabled`, `last_run`)
VALUES
	('cron_backup_db','','cron_job_admin','fa-database','auto_backup_database','crons/backup_db',7,1,1,1,'',1,'2016-08-12 12:00:23'),
	('cron_close_tickets','','cron_job_admin','fa-ticket','auto_close_tickets','crons/close_tickets',5,1,1,1,'',1,'2016-08-12 12:00:23'),
	('cron_fetch_tickets','','cron_job_admin','fa-ticket','fetch_ticket_emails','crons/fetch_tickets',6,1,1,1,'',1,'2016-08-12 12:00:23'),
	('cron_invoices','','cron_job_admin','fa-clock-o','overdue_invoices','crons/invoices',3,1,1,1,'',1,'2016-08-12 12:00:23'),
	('cron_outgoing','','cron_job_admin','fa-envelope-o','pending_emails','crons/outgoing_emails',4,1,1,1,'',1,'2016-08-12 12:00:23'),
	('cron_projects','','cron_job_admin','fa-clock-o','overdue_projects','crons/projects',2,1,1,1,'',1,'2016-08-12 12:00:23'),
	('cron_recurring','','cron_job_admin','fa-retweet','recurring_invoices','crons/recur',1,1,1,1,'',1,'2016-08-12 12:00:23'),
	('cron_xrates','','cron_job_admin','fa-money','open_exchange_rates','crons/xrates',8,1,1,1,'',1,'2016-08-12 12:00:23'),
	('cron_xrates_settings','cron_xrates','cron_job_settings','','open_exchange_rates','settings/xrates',9,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_calendar','','main_menu_admin','fa-calendar','calendar','calendar',2,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_clients','','main_menu_admin','fa-building','clients','companies',3,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_estimates','menu_sales','main_menu_admin','fa-angle-right','estimates','estimates',2,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_estimates','','main_menu_client','fa-list-alt','estimates','estimates',5,2,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_estimates','','main_menu_staff','fa-list-alt','estimates','estimates',5,3,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_expenses','menu_sales','main_menu_admin','fa-angle-right','expenses','expenses',3,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_expenses','','main_menu_client','fa-list-alt','expenses','expenses',7,2,1,1,'show_project_cost',1,'0000-00-00 00:00:00'),
	('menu_expenses','','main_menu_staff','fa-list-alt','expenses','expenses',7,3,1,1,'view_project_expenses',1,'0000-00-00 00:00:00'),
	('menu_home','','main_menu_admin','fa-tachometer','home','',1,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_home','','main_menu_client','fa-dashboard','home','clients',1,2,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_home','','main_menu_staff','fa-dashboard','home','collaborator',1,3,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_invoices','menu_sales','main_menu_admin','fa-angle-right','invoices','invoices',1,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_invoices','','main_menu_client','fa-list','invoices','invoices',4,2,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_invoices','','main_menu_staff','fa-list','invoices','invoices',4,3,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_items','menu_sales','main_menu_admin','fa-angle-right','items','items',8,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_messages','','main_menu_admin','fa-send-o','messages','messages',6,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_messages','','main_menu_client','fa-envelope-o','messages','messages',3,2,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_messages','','main_menu_staff','fa-envelope-o','messages','messages',3,3,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_notes','','main_menu_admin','fa-sticky-note-o','notes','notebook',11,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_notes','','main_menu_client','fa-sticky-note-o','notes','notebook',11,2,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_notes','','main_menu_staff','fa-sticky-note-o','notes','notebook',11,3,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_payments','menu_sales','main_menu_admin','fa-angle-right','payments','payments',3,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_payments','','main_menu_client','fa-money','payments','payments',6,2,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_payments','','main_menu_staff','fa-money','payments','payments',6,3,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_projects','','main_menu_admin','fa-cubes','projects','projects',5,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_projects','','main_menu_client','fa-coffee','projects','projects',2,2,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_projects','','main_menu_staff','fa-coffee','projects','projects',2,3,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_reports','','main_menu_admin','fa-bar-chart-o','reports','reports',12,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_sales','','main_menu_admin','fa-bank','accounting','#',4,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_settings','','main_menu_admin','fa-cogs','settings','settings',9,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_tax_rates','menu_sales','main_menu_admin','fa-angle-right','tax_rates','invoices/tax_rates',4,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_tickets','','main_menu_admin','fa-ticket','tickets','tickets',7,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_tickets','','main_menu_client','fa-ticket','tickets','tickets',8,2,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_tickets','','main_menu_staff','fa-ticket','tickets','tickets',8,3,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_users','','main_menu_admin','fa-lock','users','users/account',10,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_bugs','','projects_menu_admin','fa-bug','project_bugs','bugs',9,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_bugs','','projects_menu_client','fa-bug','project_bugs','bugs',9,2,1,1,'show_project_bugs',1,'0000-00-00 00:00:00'),
	('project_bugs','','projects_menu_staff','fa-bug','project_bugs','bugs',9,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_calendar','','projects_menu_admin','fa-calendar','project_calendar','calendar',3,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_calendar','','projects_menu_client','fa-calendar','project_calendar','calendar',3,2,1,1,'show_project_calendar',1,'0000-00-00 00:00:00'),
	('project_calendar','','projects_menu_staff','fa-calendar','project_calendar','calendar',3,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_comments','','projects_menu_admin','ion-chatbubble-working','project_comments','comments',6,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_comments','','projects_menu_client','fa-comments-o','project_comments','comments',6,2,1,1,'show_project_comments',1,'0000-00-00 00:00:00'),
	('project_comments','','projects_menu_staff','fa-comments-o','project_comments','comments',6,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_dashboard','','projects_menu_admin','ion-ios-speedometer','dashboard','dashboard',1,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_dashboard','','projects_menu_client','fa-dashboard','dashboard','dashboard',1,2,1,1,'',1,'0000-00-00 00:00:00'),
	('project_dashboard','','projects_menu_staff','fa-dashboard','dashboard','dashboard',1,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_files','','projects_menu_admin','fa-folder-open','project_files','files',8,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_files','','projects_menu_client','fa-folder-open','project_files','files',8,2,1,1,'show_project_files',1,'0000-00-00 00:00:00'),
	('project_files','','projects_menu_staff','fa-folder-open','project_files','files',8,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_gantt','','projects_menu_admin','ion-shuffle','project_gantt','gantt',12,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_gantt','','projects_menu_client','fa-road','project_gantt','gantt',12,2,1,1,'show_project_gantt',1,'0000-00-00 00:00:00'),
	('project_gantt','','projects_menu_staff','fa-road','project_gantt','gantt',12,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_links','','projects_menu_admin','ion-link','project_links','links',10,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_links','','projects_menu_client','fa-globe','project_links','links',10,2,1,1,'show_project_links',1,'0000-00-00 00:00:00'),
	('project_links','','projects_menu_staff','fa-globe','project_links','links',10,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_milestones','','projects_menu_admin','ion-ios-navigate','milestones','milestones',4,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_milestones','','projects_menu_client','fa-rocket','milestones','milestones',4,2,1,1,'show_milestones',1,'0000-00-00 00:00:00'),
	('project_milestones','','projects_menu_staff','fa-rocket','milestones','milestones',4,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_notes','','projects_menu_admin','ion-ios-compose-outline','project_notes','notes',11,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_notes','','projects_menu_client','fa-pencil','project_notes','notes',11,2,1,1,'view_project_notes',1,'0000-00-00 00:00:00'),
	('project_notes','','projects_menu_staff','fa-pencil','project_notes','notes',11,3,1,1,'view_project_notes',1,'0000-00-00 00:00:00'),
	('project_settings','','projects_menu_admin','ion-ios-settings','project_settings','settings',13,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_tasks','','projects_menu_admin','ion-checkmark-circled','project_tasks','tasks',2,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_tasks','','projects_menu_client','fa-tasks','project_tasks','tasks',2,2,1,1,'show_project_tasks',1,'0000-00-00 00:00:00'),
	('project_tasks','','projects_menu_staff','fa-tasks','project_tasks','tasks',2,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_team_members','','projects_menu_admin','ion-ios-people','team_members','teams',5,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_team_members','','projects_menu_client','fa-group','team_members','teams',5,2,1,1,'show_team_members',1,'0000-00-00 00:00:00'),
	('project_team_members','','projects_menu_staff','fa-group','team_members','teams',5,3,1,1,'',1,'0000-00-00 00:00:00'),
	('project_timesheets','','projects_menu_admin','ion-ios-timer','timesheets','timesheets',7,1,1,1,'',1,'0000-00-00 00:00:00'),
	('project_timesheets','','projects_menu_client','fa-clock-o','timesheets','timesheets',7,2,1,1,'show_timesheets',1,'0000-00-00 00:00:00'),
	('project_timesheets','','projects_menu_staff','fa-clock-o','timesheets','timesheets',7,3,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_cron','','settings_menu_admin','fa-rocket','cron_settings','crons',13,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_custom_fields','','settings_menu_admin','fa-star-o','custom_fields','fields',11,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_departments','','settings_menu_admin','fa-sitemap','departments','departments',9,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_email','','settings_menu_admin','fa-envelope-o','email_settings','email',3,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_email_templates','','settings_menu_admin','fa-pencil-square','email_templates','templates',5,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_estimate','','settings_menu_admin','fa-file-o','estimate_settings','estimate',8,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_general','','settings_menu_admin','fa-info-circle','general_settings','general',1,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_invoice','','settings_menu_admin','fa-money','invoice_settings','invoice',7,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_menu','','settings_menu_admin','fa-list-alt','menu_settings','menu',10,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_payment','','settings_menu_admin','fa-dollar','payment_settings','payments',4,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_system','','settings_menu_admin','fa-desktop','system_settings','system',2,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_theme','','settings_menu_admin','fa-code','theme_settings','theme',9,1,1,1,'',1,'0000-00-00 00:00:00'),
	('settings_translations','','settings_menu_admin','fa-globe','translations','translations',12,1,1,1,'',1,'0000-00-00 00:00:00'),
	('user_menu_plugins','','user_menu_admin','','plugins','updates/plugins',1,1,1,1,'',1,'0000-00-00 00:00:00'),
	('menu_industries', 'menu_projects', 'main_menu_admin', 'fa-angle-right', 'industries', 'projects/industries', '1', '1', '1', '1', '', '1', '0000-00-00 00:00:00');

/*!40000 ALTER TABLE `fx_hooks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_invoices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_invoices`;

CREATE TABLE `fx_invoices` (
  `inv_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `due_date` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `allow_paypal` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `allow_braintree` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'Yes',
  `braintree_merchant_ac` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow_stripe` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `allow_2checkout` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'Yes',
  `allow_bitcoin` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax2` decimal(10,2) DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `recurring` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `r_freq` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '31',
  `recur_start_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recur_end_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recur_frequency` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recur_next_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USD',
  `status` enum('Unpaid','Paid') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `archived` int(11) DEFAULT '0',
  `date_sent` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inv_deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `show_client` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `viewed` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `alert_overdue` int(11) DEFAULT '0',
  `extra_fee` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`inv_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_items`;

CREATE TABLE `fx_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_tax_rate` decimal(10,2) DEFAULT '0.00',
  `item_tax_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `invoice_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Item Name',
  `item_desc` longtext COLLATE utf8_unicode_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `item_order` int(11) DEFAULT '0',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_items_saved
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_items_saved`;

CREATE TABLE `fx_items_saved` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'Item Name',
  `item_desc` longtext COLLATE utf8_unicode_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `item_tax_rate` decimal(10,2) DEFAULT '0.00',
  `item_tax_total` decimal(10,2) DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `deleted` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'No',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_languages`;

CREATE TABLE `fx_languages` (
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(2) DEFAULT '0',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `fx_languages` WRITE;
/*!40000 ALTER TABLE `fx_languages` DISABLE KEYS */;

INSERT INTO `fx_languages` (`code`, `name`, `icon`, `active`)
VALUES
	('cs','czech','cs',1),
	('de','german','de',1),
	('el','greek','gr',1),
	('en','english','us',1),
	('es','spanish','es',1),
	('fr','french','fr',1),
	('hr','croatian','hr',0),
	('it','italian','it',1),
	('nl','dutch','nl',1),
	('no','norwegian','no',1),
	('pl','polish','pl',1),
	('pt','portuguese','pt',1),
	('pt-br','portuguese-brazilian','pt',1),
	('ro','romanian','ro',1),
	('ru','russian','ru',1),
	('sr','serbian','sr',0),
	('tr','turkish','tr',1);

/*!40000 ALTER TABLE `fx_languages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_links`;

CREATE TABLE `fx_links` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `description` text,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_locales
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_locales`;

CREATE TABLE `fx_locales` (
  `locale` varchar(10) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `fx_locales` WRITE;
/*!40000 ALTER TABLE `fx_locales` DISABLE KEYS */;

INSERT INTO `fx_locales` (`locale`, `code`, `language`, `name`)
VALUES
	('aa_DJ','aa','afar','Afar (Djibouti)'),
	('aa_ER','aa','afar','Afar (Eritrea)'),
	('aa_ET','aa','afar','Afar (Ethiopia)'),
	('af_ZA','af','afrikaans','Afrikaans (South Africa)'),
	('am_ET','am','amharic','Amharic (Ethiopia)'),
	('an_ES','an','aragonese','Aragonese (Spain)'),
	('ar_AE','ar','arabic','Arabic (United Arab Emirates)'),
	('ar_BH','ar','arabic','Arabic (Bahrain)'),
	('ar_DZ','ar','arabic','Arabic (Algeria)'),
	('ar_EG','ar','arabic','Arabic (Egypt)'),
	('ar_IN','ar','arabic','Arabic (India)'),
	('ar_IQ','ar','arabic','Arabic (Iraq)'),
	('ar_JO','ar','arabic','Arabic (Jordan)'),
	('ar_KW','ar','arabic','Arabic (Kuwait)'),
	('ar_LB','ar','arabic','Arabic (Lebanon)'),
	('ar_LY','ar','arabic','Arabic (Libya)'),
	('ar_MA','ar','arabic','Arabic (Morocco)'),
	('ar_OM','ar','arabic','Arabic (Oman)'),
	('ar_QA','ar','arabic','Arabic (Qatar)'),
	('ar_SA','ar','arabic','Arabic (Saudi Arabia)'),
	('ar_SD','ar','arabic','Arabic (Sudan)'),
	('ar_SY','ar','arabic','Arabic (Syria)'),
	('ar_TN','ar','arabic','Arabic (Tunisia)'),
	('ar_YE','ar','arabic','Arabic (Yemen)'),
	('ast_ES','ast','asturian','Asturian (Spain)'),
	('as_IN','as','assamese','Assamese (India)'),
	('az_AZ','az','azerbaijani','Azerbaijani (Azerbaijan)'),
	('az_TR','az','azerbaijani','Azerbaijani (Turkey)'),
	('bem_ZM','bem','bemba','Bemba (Zambia)'),
	('ber_DZ','ber','berber','Berber (Algeria)'),
	('ber_MA','ber','berber','Berber (Morocco)'),
	('be_BY','be','belarusian','Belarusian (Belarus)'),
	('bg_BG','bg','bulgarian','Bulgarian (Bulgaria)'),
	('bn_BD','bn','bengali','Bengali (Bangladesh)'),
	('bn_IN','bn','bengali','Bengali (India)'),
	('bo_CN','bo','tibetan','Tibetan (China)'),
	('bo_IN','bo','tibetan','Tibetan (India)'),
	('br_FR','br','breton','Breton (France)'),
	('bs_BA','bs','bosnian','Bosnian (Bosnia and Herzegovina)'),
	('byn_ER','byn','blin','Blin (Eritrea)'),
	('ca_AD','ca','catalan','Catalan (Andorra)'),
	('ca_ES','ca','catalan','Catalan (Spain)'),
	('ca_FR','ca','catalan','Catalan (France)'),
	('ca_IT','ca','catalan','Catalan (Italy)'),
	('crh_UA','crh','crimean turkish','Crimean Turkish (Ukraine)'),
	('csb_PL','csb','kashubian','Kashubian (Poland)'),
	('cs_CZ','cs','czech','Czech (Czech Republic)'),
	('cv_RU','cv','chuvash','Chuvash (Russia)'),
	('cy_GB','cy','welsh','Welsh (United Kingdom)'),
	('da_DK','da','danish','Danish (Denmark)'),
	('de_AT','de','german','German (Austria)'),
	('de_BE','de','german','German (Belgium)'),
	('de_CH','de','german','German (Switzerland)'),
	('de_DE','de','german','German (Germany)'),
	('de_LI','de','german','German (Liechtenstein)'),
	('de_LU','de','german','German (Luxembourg)'),
	('dv_MV','dv','divehi','Divehi (Maldives)'),
	('dz_BT','dz','dzongkha','Dzongkha (Bhutan)'),
	('ee_GH','ee','ewe','Ewe (Ghana)'),
	('el_CY','el','greek','Greek (Cyprus)'),
	('el_GR','el','greek','Greek (Greece)'),
	('en_AG','en','english','English (Antigua and Barbuda)'),
	('en_AS','en','english','English (American Samoa)'),
	('en_AU','en','english','English (Australia)'),
	('en_BW','en','english','English (Botswana)'),
	('en_CA','en','english','English (Canada)'),
	('en_DK','en','english','English (Denmark)'),
	('en_GB','en','english','English (United Kingdom)'),
	('en_GU','en','english','English (Guam)'),
	('en_HK','en','english','English (Hong Kong SAR China)'),
	('en_IE','en','english','English (Ireland)'),
	('en_IN','en','english','English (India)'),
	('en_JM','en','english','English (Jamaica)'),
	('en_MH','en','english','English (Marshall Islands)'),
	('en_MP','en','english','English (Northern Mariana Islands)'),
	('en_MU','en','english','English (Mauritius)'),
	('en_NG','en','english','English (Nigeria)'),
	('en_NZ','en','english','English (New Zealand)'),
	('en_PH','en','english','English (Philippines)'),
	('en_SG','en','english','English (Singapore)'),
	('en_TT','en','english','English (Trinidad and Tobago)'),
	('en_US','en','english','English (United States)'),
	('en_VI','en','english','English (Virgin Islands)'),
	('en_ZA','en','english','English (South Africa)'),
	('en_ZM','en','english','English (Zambia)'),
	('en_ZW','en','english','English (Zimbabwe)'),
	('eo','eo','esperanto','Esperanto'),
	('es_AR','es','spanish','Spanish (Argentina)'),
	('es_BO','es','spanish','Spanish (Bolivia)'),
	('es_CL','es','spanish','Spanish (Chile)'),
	('es_CO','es','spanish','Spanish (Colombia)'),
	('es_CR','es','spanish','Spanish (Costa Rica)'),
	('es_DO','es','spanish','Spanish (Dominican Republic)'),
	('es_EC','es','spanish','Spanish (Ecuador)'),
	('es_ES','es','spanish','Spanish (Spain)'),
	('es_GT','es','spanish','Spanish (Guatemala)'),
	('es_HN','es','spanish','Spanish (Honduras)'),
	('es_MX','es','spanish','Spanish (Mexico)'),
	('es_NI','es','spanish','Spanish (Nicaragua)'),
	('es_PA','es','spanish','Spanish (Panama)'),
	('es_PE','es','spanish','Spanish (Peru)'),
	('es_PR','es','spanish','Spanish (Puerto Rico)'),
	('es_PY','es','spanish','Spanish (Paraguay)'),
	('es_SV','es','spanish','Spanish (El Salvador)'),
	('es_US','es','spanish','Spanish (United States)'),
	('es_UY','es','spanish','Spanish (Uruguay)'),
	('es_VE','es','spanish','Spanish (Venezuela)'),
	('et_EE','et','estonian','Estonian (Estonia)'),
	('eu_ES','eu','basque','Basque (Spain)'),
	('eu_FR','eu','basque','Basque (France)'),
	('fa_AF','fa','persian','Persian (Afghanistan)'),
	('fa_IR','fa','persian','Persian (Iran)'),
	('ff_SN','ff','fulah','Fulah (Senegal)'),
	('fil_PH','fil','filipino','Filipino (Philippines)'),
	('fi_FI','fi','finnish','Finnish (Finland)'),
	('fo_FO','fo','faroese','Faroese (Faroe Islands)'),
	('fr_BE','fr','french','French (Belgium)'),
	('fr_BF','fr','french','French (Burkina Faso)'),
	('fr_BI','fr','french','French (Burundi)'),
	('fr_BJ','fr','french','French (Benin)'),
	('fr_CA','fr','french','French (Canada)'),
	('fr_CF','fr','french','French (Central African Republic)'),
	('fr_CG','fr','french','French (Congo)'),
	('fr_CH','fr','french','French (Switzerland)'),
	('fr_CM','fr','french','French (Cameroon)'),
	('fr_FR','fr','french','French (France)'),
	('fr_GA','fr','french','French (Gabon)'),
	('fr_GN','fr','french','French (Guinea)'),
	('fr_GP','fr','french','French (Guadeloupe)'),
	('fr_GQ','fr','french','French (Equatorial Guinea)'),
	('fr_KM','fr','french','French (Comoros)'),
	('fr_LU','fr','french','French (Luxembourg)'),
	('fr_MC','fr','french','French (Monaco)'),
	('fr_MG','fr','french','French (Madagascar)'),
	('fr_ML','fr','french','French (Mali)'),
	('fr_MQ','fr','french','French (Martinique)'),
	('fr_NE','fr','french','French (Niger)'),
	('fr_SN','fr','french','French (Senegal)'),
	('fr_TD','fr','french','French (Chad)'),
	('fr_TG','fr','french','French (Togo)'),
	('fur_IT','fur','friulian','Friulian (Italy)'),
	('fy_DE','fy','western frisian','Western Frisian (Germany)'),
	('fy_NL','fy','western frisian','Western Frisian (Netherlands)'),
	('ga_IE','ga','irish','Irish (Ireland)'),
	('gd_GB','gd','scottish gaelic','Scottish Gaelic (United Kingdom)'),
	('gez_ER','gez','geez','Geez (Eritrea)'),
	('gez_ET','gez','geez','Geez (Ethiopia)'),
	('gl_ES','gl','galician','Galician (Spain)'),
	('gu_IN','gu','gujarati','Gujarati (India)'),
	('gv_GB','gv','manx','Manx (United Kingdom)'),
	('ha_NG','ha','hausa','Hausa (Nigeria)'),
	('he_IL','he','hebrew','Hebrew (Israel)'),
	('hi_IN','hi','hindi','Hindi (India)'),
	('hr_HR','hr','croatian','Croatian (Croatia)'),
	('hsb_DE','hsb','upper sorbian','Upper Sorbian (Germany)'),
	('ht_HT','ht','haitian','Haitian (Haiti)'),
	('hu_HU','hu','hungarian','Hungarian (Hungary)'),
	('hy_AM','hy','armenian','Armenian (Armenia)'),
	('ia','ia','interlingua','Interlingua'),
	('id_ID','id','indonesian','Indonesian (Indonesia)'),
	('ig_NG','ig','igbo','Igbo (Nigeria)'),
	('ik_CA','ik','inupiaq','Inupiaq (Canada)'),
	('is_IS','is','icelandic','Icelandic (Iceland)'),
	('it_CH','it','italian','Italian (Switzerland)'),
	('it_IT','it','italian','Italian (Italy)'),
	('iu_CA','iu','inuktitut','Inuktitut (Canada)'),
	('ja_JP','ja','japanese','Japanese (Japan)'),
	('ka_GE','ka','georgian','Georgian (Georgia)'),
	('kk_KZ','kk','kazakh','Kazakh (Kazakhstan)'),
	('kl_GL','kl','kalaallisut','Kalaallisut (Greenland)'),
	('km_KH','km','khmer','Khmer (Cambodia)'),
	('kn_IN','kn','kannada','Kannada (India)'),
	('kok_IN','kok','konkani','Konkani (India)'),
	('ko_KR','ko','korean','Korean (South Korea)'),
	('ks_IN','ks','kashmiri','Kashmiri (India)'),
	('ku_TR','ku','kurdish','Kurdish (Turkey)'),
	('kw_GB','kw','cornish','Cornish (United Kingdom)'),
	('ky_KG','ky','kirghiz','Kirghiz (Kyrgyzstan)'),
	('lg_UG','lg','ganda','Ganda (Uganda)'),
	('li_BE','li','limburgish','Limburgish (Belgium)'),
	('li_NL','li','limburgish','Limburgish (Netherlands)'),
	('lo_LA','lo','lao','Lao (Laos)'),
	('lt_LT','lt','lithuanian','Lithuanian (Lithuania)'),
	('lv_LV','lv','latvian','Latvian (Latvia)'),
	('mai_IN','mai','maithili','Maithili (India)'),
	('mg_MG','mg','malagasy','Malagasy (Madagascar)'),
	('mi_NZ','mi','maori','Maori (New Zealand)'),
	('mk_MK','mk','macedonian','Macedonian (Macedonia)'),
	('ml_IN','ml','malayalam','Malayalam (India)'),
	('mn_MN','mn','mongolian','Mongolian (Mongolia)'),
	('mr_IN','mr','marathi','Marathi (India)'),
	('ms_BN','ms','malay','Malay (Brunei)'),
	('ms_MY','ms','malay','Malay (Malaysia)'),
	('mt_MT','mt','maltese','Maltese (Malta)'),
	('my_MM','my','burmese','Burmese (Myanmar)'),
	('naq_NA','naq','namibia','Namibia'),
	('nb_NO','nb','norwegian bokmål','Norwegian Bokmål (Norway)'),
	('nds_DE','nds','low german','Low German (Germany)'),
	('nds_NL','nds','low german','Low German (Netherlands)'),
	('ne_NP','ne','nepali','Nepali (Nepal)'),
	('nl_AW','nl','dutch','Dutch (Aruba)'),
	('nl_BE','nl','dutch','Dutch (Belgium)'),
	('nl_NL','nl','dutch','Dutch (Netherlands)'),
	('nn_NO','nn','norwegian nynorsk','Norwegian Nynorsk (Norway)'),
	('no_NO','no','norwegian','Norwegian (Norway)'),
	('nr_ZA','nr','south ndebele','South Ndebele (South Africa)'),
	('nso_ZA','nso','northern sotho','Northern Sotho (South Africa)'),
	('oc_FR','oc','occitan','Occitan (France)'),
	('om_ET','om','oromo','Oromo (Ethiopia)'),
	('om_KE','om','oromo','Oromo (Kenya)'),
	('or_IN','or','oriya','Oriya (India)'),
	('os_RU','os','ossetic','Ossetic (Russia)'),
	('pap_AN','pap','papiamento','Papiamento (Netherlands Antilles)'),
	('pa_IN','pa','punjabi','Punjabi (India)'),
	('pa_PK','pa','punjabi','Punjabi (Pakistan)'),
	('pl_PL','pl','polish','Polish (Poland)'),
	('ps_AF','ps','pashto','Pashto (Afghanistan)'),
	('pt_BR','pt','portuguese','Portuguese (Brazil)'),
	('pt_GW','pt','portuguese','Portuguese (Guinea-Bissau)'),
	('pt_PT','pt','portuguese','Portuguese (Portugal)'),
	('ro_MD','ro','romanian','Romanian (Moldova)'),
	('ro_RO','ro','romanian','Romanian (Romania)'),
	('ru_RU','ru','russian','Russian (Russia)'),
	('ru_UA','ru','russian','Russian (Ukraine)'),
	('rw_RW','rw','kinyarwanda','Kinyarwanda (Rwanda)'),
	('sa_IN','sa','sanskrit','Sanskrit (India)'),
	('sc_IT','sc','sardinian','Sardinian (Italy)'),
	('sd_IN','sd','sindhi','Sindhi (India)'),
	('seh_MZ','seh','sena','Sena (Mozambique)'),
	('se_NO','se','northern sami','Northern Sami (Norway)'),
	('sid_ET','sid','sidamo','Sidamo (Ethiopia)'),
	('si_LK','si','sinhala','Sinhala (Sri Lanka)'),
	('sk_SK','sk','slovak','Slovak (Slovakia)'),
	('sl_SI','sl','slovenian','Slovenian (Slovenia)'),
	('sn_ZW','sn','shona','Shona (Zimbabwe)'),
	('so_DJ','so','somali','Somali (Djibouti)'),
	('so_ET','so','somali','Somali (Ethiopia)'),
	('so_KE','so','somali','Somali (Kenya)'),
	('so_SO','so','somali','Somali (Somalia)'),
	('sq_AL','sq','albanian','Albanian (Albania)'),
	('sq_MK','sq','albanian','Albanian (Macedonia)'),
	('sr_BA','sr','serbian','Serbian (Bosnia and Herzegovina)'),
	('sr_ME','sr','serbian','Serbian (Montenegro)'),
	('sr_RS','sr','serbian','Serbian (Serbia)'),
	('ss_ZA','ss','swati','Swati (South Africa)'),
	('st_ZA','st','southern sotho','Southern Sotho (South Africa)'),
	('sv_FI','sv','swedish','Swedish (Finland)'),
	('sv_SE','sv','swedish','Swedish (Sweden)'),
	('sw_KE','sw','swahili','Swahili (Kenya)'),
	('sw_TZ','sw','swahili','Swahili (Tanzania)'),
	('ta_IN','ta','tamil','Tamil (India)'),
	('teo_UG','teo','teso','Teso (Uganda)'),
	('te_IN','te','telugu','Telugu (India)'),
	('tg_TJ','tg','tajik','Tajik (Tajikistan)'),
	('th_TH','th','thai','Thai (Thailand)'),
	('tig_ER','tig','tigre','Tigre (Eritrea)'),
	('ti_ER','ti','tigrinya','Tigrinya (Eritrea)'),
	('ti_ET','ti','tigrinya','Tigrinya (Ethiopia)'),
	('tk_TM','tk','turkmen','Turkmen (Turkmenistan)'),
	('tl_PH','tl','tagalog','Tagalog (Philippines)'),
	('tn_ZA','tn','tswana','Tswana (South Africa)'),
	('to_TO','to','tongan','Tongan (Tonga)'),
	('tr_CY','tr','turkish','Turkish (Cyprus)'),
	('tr_TR','tr','turkish','Turkish (Turkey)'),
	('ts_ZA','ts','tsonga','Tsonga (South Africa)'),
	('tt_RU','tt','tatar','Tatar (Russia)'),
	('ug_CN','ug','uighur','Uighur (China)'),
	('uk_UA','uk','ukrainian','Ukrainian (Ukraine)'),
	('ur_PK','ur','urdu','Urdu (Pakistan)'),
	('uz_UZ','uz','uzbek','Uzbek (Uzbekistan)'),
	('ve_ZA','ve','venda','Venda (South Africa)'),
	('vi_VN','vi','vietnamese','Vietnamese (Vietnam)'),
	('wa_BE','wa','walloon','Walloon (Belgium)'),
	('wo_SN','wo','wolof','Wolof (Senegal)'),
	('xh_ZA','xh','xhosa','Xhosa (South Africa)'),
	('yi_US','yi','yiddish','Yiddish (United States)'),
	('yo_NG','yo','yoruba','Yoruba (Nigeria)'),
	('zh_CN','zh','chinese','Chinese (China)'),
	('zh_HK','zh','chinese','Chinese (Hong Kong SAR China)'),
	('zh_SG','zh','chinese','Chinese (Singapore)'),
	('zh_TW','zh','chinese','Chinese (Taiwan)'),
	('zu_ZA','zu','zulu','Zulu (South Africa)');

/*!40000 ALTER TABLE `fx_locales` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_login_attempts`;

CREATE TABLE `fx_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `login` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_messages`;

CREATE TABLE `fx_messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_to` int(11) DEFAULT NULL,
  `user_from` int(11) DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci,
  `status` enum('Read','Unread') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unread',
  `attached_file` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `favourite` int(11) DEFAULT '0',
  `deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_milestones
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_milestones`;

CREATE TABLE `fx_milestones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `milestone_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `project` int(11) DEFAULT NULL,
  `start_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `due_date` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_notes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_notes`;

CREATE TABLE `fx_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` longtext,
  `date` bigint(13) DEFAULT '0',
  `owner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_outgoing_emails
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_outgoing_emails`;

CREATE TABLE `fx_outgoing_emails` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sent_to` varchar(64) DEFAULT NULL,
  `sent_from` varchar(64) DEFAULT NULL,
  `subject` text,
  `message` longtext,
  `date_sent` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delivered` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_payment_methods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_payment_methods`;

CREATE TABLE `fx_payment_methods` (
  `method_id` int(11) NOT NULL AUTO_INCREMENT,
  `method_name` varchar(64) NOT NULL DEFAULT 'Paypal',
  PRIMARY KEY (`method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `fx_payment_methods` WRITE;
/*!40000 ALTER TABLE `fx_payment_methods` DISABLE KEYS */;

INSERT INTO `fx_payment_methods` (`method_id`, `method_name`)
VALUES
	(1,'Online'),
	(2,'Cash'),
	(3,'Bank Deposit'),
	(5,'Cheque');

/*!40000 ALTER TABLE `fx_payment_methods` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_payments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_payments`;

CREATE TABLE `fx_payments` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` int(11) NOT NULL,
  `paid_by` int(11) NOT NULL,
  `payer_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(64) COLLATE utf8_unicode_ci DEFAULT 'USD',
  `amount` decimal(10,2) DEFAULT '0.00',
  `trans_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attached_file` text COLLATE utf8_unicode_ci,
  `payment_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `month_paid` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year_paid` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inv_deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `refunded` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'No',
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `trans_id` (`trans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_permissions`;

CREATE TABLE `fx_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','deleted') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `fx_permissions` WRITE;
/*!40000 ALTER TABLE `fx_permissions` DISABLE KEYS */;

INSERT INTO `fx_permissions` (`permission_id`, `name`, `description`, `status`)
VALUES
	(1,'view_all_invoices','Allow user access to view all invoices','active'),
	(2,'edit_all_invoices','Allow user access to edit all invoices','active'),
	(3,'add_invoices','Allow user access to add invoices','active'),
	(4,'delete_invoices','Allow user access to delete invoice','active'),
	(5,'pay_invoice_offline','Allow user access to make offline Invoice Payments','active'),
	(6,'view_payments','Allow user access to view own payments','active'),
	(7,'email_invoices','Allow user access to email invoices','active'),
	(8,'send_email_reminders','Allow user access to send invoice reminders','active'),
	(9,'add_estimates','Allow user access to add estimates','active'),
	(10,'edit_estimates','Allow user access to edit all estimates','active'),
	(11,'view_all_estimates','Allow user access to view all estimates','active'),
	(12,'delete_estimates','Allow user access to delete estimates','active'),
	(17,'view_all_projects','Allow user access to view all projects','active'),
	(18,'view_project_cost','Allow user access to view project cost','active'),
	(19,'add_projects','Allow user access to add projects','active'),
	(20,'edit_all_projects','Allow user access to edit projects','active'),
	(21,'view_all_projects','Allow user access to view all projects','active'),
	(22,'delete_projects','Allow user access to delete projects','active'),
	(23,'edit_settings','Allow user access to edit all settings','active'),
	(25,'view_project_clients','Allow staff to view project\'s clients','active'),
	(26,'view_project_notes','Allow staff to view project notes','active'),
	(27,'view_all_expenses','Allow staff to view all expenses','active'),
	(28,'edit_expenses','Allow staff to edit expenses','active'),
	(29,'delete_expenses','Allow staff to delete expenses','active'),
	(30,'add_expenses','Allow staff to add expenses','active'),
	(31,'view_project_expenses','Allow staff to view project expenses','active'),
	(32,'view_all_payments','Allow staff to view all payments','active'),
	(33,'edit_payments','Allow staff to edit payments','active');

/*!40000 ALTER TABLE `fx_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_plugins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_plugins`;

CREATE TABLE `fx_plugins` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `version` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plugin_uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `installed` int(1) DEFAULT NULL,
  `licence` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `has_update` int(1) DEFAULT '0',
  `update_version` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_priorities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_priorities`;

CREATE TABLE `fx_priorities` (
  `priority` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `fx_priorities` WRITE;
/*!40000 ALTER TABLE `fx_priorities` DISABLE KEYS */;

INSERT INTO `fx_priorities` (`priority`)
VALUES
	('Low'),
	('Medium'),
	('High'),
	('Urgent');

/*!40000 ALTER TABLE `fx_priorities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_project_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_project_settings`;

CREATE TABLE `fx_project_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `fx_project_settings` WRITE;
/*!40000 ALTER TABLE `fx_project_settings` DISABLE KEYS */;

INSERT INTO `fx_project_settings` (`id`, `setting`, `description`)
VALUES
	(1,'show_team_members','Allow client to view team members'),
	(2,'show_milestones','Allow client to view project milestones'),
	(3,'show_project_tasks','Allow client to view project tasks'),
	(4,'show_project_files','Allow client to view project files'),
	(5,'show_timesheets','Allow clients to view project timesheets'),
	(6,'show_project_bugs','Allow client to view project bugs'),
	(7,'show_project_history','Allow client to view project history'),
	(8,'show_project_calendar','Allow clients to view project calendars'),
	(9,'show_project_comments','Allow clients to view project comments'),
	(10,'show_project_links','Allow client to view project links'),
	(11,'client_add_tasks','Allow client to to add task'),
	(12,'show_project_gantt','Allow client to view Gantt chart'),
	(13,'show_project_hours','Allow client to view project hours');

/*!40000 ALTER TABLE `fx_project_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_project_timer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_project_timer`;

CREATE TABLE `fx_project_timer` (
  `timer_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time_in_sec` int(11) DEFAULT '0',
  `start_time` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `date_timed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `billable` tinyint(4) DEFAULT '1',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`timer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_projects`;

CREATE TABLE `fx_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Project Title',
  `description` longtext COLLATE utf8_unicode_ci,
  `client` int(11) NOT NULL,
  `budget` VARCHAR(255),
  `currency` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `due_date` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fixed_rate` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'No',
  `hourly_rate` decimal(10,2) DEFAULT '0.00',
  `fixed_price` decimal(10,2) DEFAULT '0.00',
  `progress` int(11) DEFAULT '0',
  `notes` longtext COLLATE utf8_unicode_ci,
  `assign_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('On Hold','Active','Done') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `timer` enum('On','Off') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Off',
  `timer_started_by` int(11) DEFAULT NULL,
  `timer_start` int(11) DEFAULT NULL,
  `time_logged` int(11) DEFAULT NULL,
  `proj_deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `auto_progress` enum('TRUE','FALSE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'FALSE',
  `estimate_hours` decimal(10,2) NOT NULL DEFAULT '0.00',
  `settings` text COLLATE utf8_unicode_ci,
  `language` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archived` int(11) DEFAULT '0',
  `pinned` int(11) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alert_overdue` int(11) DEFAULT '0',
  `industry` int(11) NOT NULL,
  `project_category` int(11) NOT NULL,
  `project_sub_category` int(11) NOT NULL,
  `public` varchar(10),
  `created_by` varchar(150),
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_roles`;

CREATE TABLE `fx_roles` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(64) NOT NULL,
  `default` int(11) NOT NULL,
  `permissions` varchar(255) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `fx_roles` WRITE;
/*!40000 ALTER TABLE `fx_roles` DISABLE KEYS */;

INSERT INTO `fx_roles` (`r_id`, `role`, `default`, `permissions`)
VALUES
	(1,'admin',1,'{\"settings\":\"permissions\",\"role\":\"admin\",\"view_all_invoices\":\"on\",\"edit_invoices\":\"on\",\"pay_invoice_offline\":\"on\",\"view_all_payments\":\"on\",\"email_invoices\":\"on\",\"send_email_reminders\":\"on\"}'),
	(2,'client',2,'{\"settings\":\"permissions\",\"role\":\"client\"}'),
	(3,'staff',3,'{\"settings\":\"permissions\",\"role\":\"staff\",\"view_all_invoices\":\"on\",\"edit_invoices\":\"on\",\"add_invoices\":\"on\",\"pay_invoice_offline\":\"on\",\"send_email_reminders\":\"on\"}');

/*!40000 ALTER TABLE `fx_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_saved_tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_saved_tasks`;

CREATE TABLE `fx_saved_tasks` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT 'Task Name',
  `task_desc` text COLLATE utf8_unicode_ci,
  `visible` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `estimate_hours` decimal(10,2) DEFAULT '0.00',
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `saved_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_status`;

CREATE TABLE `fx_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `fx_status` WRITE;
/*!40000 ALTER TABLE `fx_status` DISABLE KEYS */;

INSERT INTO `fx_status` (`id`, `status`)
VALUES
	(1,'resolved'),
	(2,'closed'),
	(3,'open'),
	(5,'pending');

/*!40000 ALTER TABLE `fx_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fx_task_files
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_task_files`;

CREATE TABLE `fx_task_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `task` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` mediumtext COLLATE utf8_unicode_ci,
  `path` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `file_ext` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `is_image` int(2) DEFAULT NULL,
  `image_width` int(10) DEFAULT NULL,
  `image_height` int(10) DEFAULT NULL,
  `original_name` mediumtext COLLATE utf8_unicode_ci,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `file_status` enum('unconfirmed','confirmed','in_progress','done','verified') COLLATE utf8_unicode_ci DEFAULT 'unconfirmed',
  `uploaded_by` int(11) DEFAULT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_tasks`;

CREATE TABLE `fx_tasks` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Task Name',
  `project` int(11) NOT NULL,
  `milestone` int(11) DEFAULT NULL,
  `assigned_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `visible` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `task_progress` int(11) DEFAULT '0',
  `timer_status` enum('On','Off') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Off',
  `timer_started_by` int(11) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `estimated_hours` decimal(10,2) DEFAULT NULL,
  `logged_time` int(11) NOT NULL DEFAULT '0',
  `auto_progress` enum('TRUE','FALSE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'FALSE',
  `start_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `due_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pinned` int(11) DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_tasks_timer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_tasks_timer`;

CREATE TABLE `fx_tasks_timer` (
  `timer_id` int(11) NOT NULL AUTO_INCREMENT,
  `task` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `time_in_sec` int(11) DEFAULT '0',
  `start_time` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `user` int(11) DEFAULT NULL,
  `date_timed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `billable` tinyint(4) DEFAULT '1',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`timer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dump of table fx_user_status

DROP TABLE IF EXISTS `fx_user_status`;

CREATE TABLE `fx_user_status` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
  	`status` varchar(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
);

INSERT INTO `fx_user_status` (`status`)
VALUES
	('Confirmed'),
	('Pending'),
	('Declined')

# Dump of table fx_user_status

DROP TABLE IF EXISTS `fx_user_type`;

CREATE TABLE `fx_user_type` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
  	`type` varchar(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
);

INSERT INTO `fx_user_type` (`type`)
VALUES
	('Client'),
	('Consultant')

# ------------

DROP TABLE IF EXISTS `fx_industries`;

CREATE TABLE `fx_industries` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
  	`name` varchar(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
);

insert into `fx_industries` (`name`) 
values ('Advertising and Media'),
		('Mining'),
		('Private Equity'),
		('Retail and consumer goods');

DROP TABLE IF EXISTS `fx_project_categories`;

CREATE TABLE `fx_project_categories` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
  	`name` varchar(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
);

insert into `fx_project_categories` (`name`) 
values ('Big Data And Advance Analytics'),
('Black Economic Empowerment'),
('Change Management'),
('Customer Strategy And Marketing'),
('Design'),
('Financial Management'),
('Human Capital'),
('Information Technology'),
('Innovation Management'),
('New Business Development And Sales'),
('Operations Management'),
('Private Equity'),
('Sales'),
('Software Consulting'),
('Strategy'),
('Technology And Digital');

DROP TABLE IF EXISTS `fx_project_sub_categories`;

CREATE TABLE `fx_project_sub_categories` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`parent_category` int(10) DEFAULT NULL,
  	`name` varchar(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
);

insert into `fx_project_sub_categories` (`parent_category`,`name`)
values (15, 'Business Unit Strategy');


# Dump of table fx_tax_rates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_tax_rates`;

CREATE TABLE `fx_tax_rates` (
  `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_rate_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `tax_rate_percent` decimal(10,2) NOT NULL DEFAULT '0.00',
  KEY `Index 1` (`tax_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_ticketreplies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_ticketreplies`;

CREATE TABLE `fx_ticketreplies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ticketid` int(10) DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci,
  `replier` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `replierid` int(10) DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table fx_tickets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_tickets`;

CREATE TABLE `fx_tickets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ticket_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `reporter` int(10) DEFAULT '0',
  `priority` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `additional` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `attachment` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `archived_t` int(2) DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_code` (`ticket_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table fx_todo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_todo`;

CREATE TABLE `fx_todo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project` int(11) DEFAULT NULL,
  `list_name` varchar(255) DEFAULT NULL,
  `status` enum('pending','done') DEFAULT 'pending',
  `saved_by` int(11) DEFAULT NULL,
  `visible` enum('Yes','No') DEFAULT 'No',
  `date_saved` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_un_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_un_sessions`;

CREATE TABLE `fx_un_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_updates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_updates`;

CREATE TABLE `fx_updates` (
  `build` int(11) NOT NULL DEFAULT '0',
  `code` varchar(50) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `version` varchar(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `filename` varchar(255) DEFAULT NULL,
  `importance` enum('low','medium','high') DEFAULT 'low',
  `dependencies` varchar(255) DEFAULT NULL,
  `installed` int(11) DEFAULT '0',
  `sql` text,
  `files` text,
  `depends` varchar(255) DEFAULT NULL,
  `includes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`build`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_user_autologin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_user_autologin`;

CREATE TABLE `fx_user_autologin` (
  `key_id` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expires` timestamp NULL DEFAULT NULL,
  `remote` int(2) DEFAULT '0',
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fx_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fx_users`;

CREATE TABLE `fx_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
