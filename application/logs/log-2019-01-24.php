<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-01-24 00:38:15 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:38:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:40:24 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_applications.php 66
ERROR - 2019-01-24 00:40:24 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_applications.php 66
ERROR - 2019-01-24 00:40:24 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:40:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:40:51 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:40:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:40:51 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:40:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:49:31 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:49:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:49:35 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:49:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:49:37 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:49:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:52:31 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:52:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:52:48 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 00:52:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 01:04:04 --> Query error: Table 'coopris_new.admins' doesn't exist - Invalid query: SELECT *
FROM `admins`
WHERE `id` = '19'
AND `access_level` = 3
ERROR - 2019-01-24 01:12:58 --> 404 Page Not Found: Admins/revoke_supervisor
ERROR - 2019-01-24 01:13:25 --> Severity: Error --> Maximum execution time of 120 seconds exceeded C:\xampp\htdocs\coopris\system\libraries\Session\drivers\Session_files_driver.php 212
ERROR - 2019-01-24 01:44:45 --> Query error: Table 'coopris_new.admins' doesn't exist - Invalid query: SELECT `cooperatives`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `cooperatives`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `cooperatives`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
INNER JOIN `admins` ON `admins`.`id` = `cooperatives`.`evaluated_by` AND `admins`.`id` = `cooperatives`.`second_evaluated_by`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` = '7'
ERROR - 2019-01-24 01:44:57 --> Query error: Unknown column 'admins.id' in 'on clause' - Invalid query: SELECT `cooperatives`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `cooperatives`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `cooperatives`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
INNER JOIN `admin` ON `admin`.`id` = `cooperatives`.`evaluated_by` AND `admins`.`id` = `cooperatives`.`second_evaluated_by`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` = '7'
ERROR - 2019-01-24 01:59:15 --> Query error: Unknown column 'cooperatives.evaluated_by.full_name' in 'field list' - Invalid query: SELECT `cooperatives`.*, `cooperatives`.`evaluated_by`.`full_name` as `admin_fullname1`, `admin`.`full_name` as `admin_fullname2`
FROM `cooperatives`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `cooperatives`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
INNER JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
LEFT JOIN `admin` ON `cooperatives`.`evaluated_by` = `admin`.`id` AND `cooperatives`.`second_evaluated_by` = `admin`.`id`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` = '7'
ERROR - 2019-01-24 02:05:04 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:05:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:05:09 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:05:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:05:31 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:05:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:05:36 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:05:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:10:36 --> Severity: Notice --> Undefined index: ae1_full_name C:\xampp\htdocs\coopris\application\views\applications\list_of_applications.php 114
ERROR - 2019-01-24 02:10:52 --> Severity: Notice --> Undefined index: ae1_full_name C:\xampp\htdocs\coopris\application\views\applications\list_of_applications.php 114
ERROR - 2019-01-24 02:16:02 --> Severity: Notice --> Undefined index: ae1_full_name C:\xampp\htdocs\coopris\application\views\applications\list_of_applications.php 114
ERROR - 2019-01-24 02:17:13 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:17:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:17:36 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:17:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:21:29 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:21:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:25:22 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:25:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:34:57 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:34:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:35:00 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:35:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:35:02 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:35:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:35:22 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:35:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:37:13 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:37:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:37:30 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:37:30 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:37:34 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:37:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:38:10 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:38:10 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:38:12 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 02:38:12 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:35:40 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:35:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:35:48 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:35:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:35:59 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:35:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:36:29 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:36:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:38:17 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Admin_model.php 330
ERROR - 2019-01-24 03:38:23 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:38:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:38:29 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:38:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:56:12 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:56:12 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:56:31 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:56:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:57:13 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:57:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:58:35 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 03:58:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 04:04:44 --> Severity: Parsing Error --> syntax error, unexpected '<' C:\xampp\htdocs\coopris\application\views\templates\admin_header.php 40
ERROR - 2019-01-24 04:06:00 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-01-24 04:06:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
