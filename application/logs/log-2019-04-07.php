<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-07 00:03:01 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:04:36 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:05:16 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:08:39 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:10:49 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:11:01 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:12:55 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:14:08 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:15:33 --> 404 Page Not Found: Coopera/save_o
ERROR - 2019-04-07 00:18:32 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:19:28 --> 404 Page Not Found: 
ERROR - 2019-04-07 00:22:43 --> Severity: Notice --> Undefined property: Cooperatives::$Cooperatives_model C:\xampp\htdocs\coopris\application\controllers\Cooperatives.php 18
ERROR - 2019-04-07 00:22:43 --> Severity: Error --> Call to a member function save_OR() on null C:\xampp\htdocs\coopris\application\controllers\Cooperatives.php 18
ERROR - 2019-04-07 03:53:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as `b` = ''
WHERE `id` = '1'
AND `b`.`id` = ''' at line 1 - Invalid query: UPDATE `payment` as `a` SET `id` = '1', `or_no` = '123321', `status` = 1, `b`.`status` = 14, `cooperatives` as `b` = ''
WHERE `id` = '1'
AND `b`.`id` = ''
ERROR - 2019-04-07 03:54:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as `b` = ''
WHERE `id` IS NULL
AND `b`.`id` IS NULL' at line 1 - Invalid query: UPDATE `payment` as `a` SET `id` = NULL, `or_no` = NULL, `status` = 1, `b`.`status` = 14, `cooperatives` as `b` = ''
WHERE `id` IS NULL
AND `b`.`id` IS NULL
ERROR - 2019-04-07 03:59:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as `b` = ''
WHERE `a`.`id` = 1
AND `b`.`id` = 33' at line 1 - Invalid query: UPDATE `payment` as `a` SET `a`.`or_no` = 123123, `a`.`status` = 1, `b`.`status` = 14, `cooperatives` as `b` = ''
WHERE `a`.`id` = 1
AND `b`.`id` = 33
ERROR - 2019-04-07 03:59:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as `b` = ''
WHERE `a`.`id` = 1
AND `b`.`id` = 33' at line 1 - Invalid query: UPDATE `payment` as `a` SET `a`.`or_no` = 123123, `a`.`status` = 1, `b`.`status` = 14, `cooperatives` as `b` = ''
WHERE `a`.`id` = 1
AND `b`.`id` = 33
ERROR - 2019-04-07 12:58:48 --> 404 Page Not Found: Cooperatives/46107c58d818d3f4058886dbae350c1a5804d9132ff31597c3a214afca12ec9fec0196e994de079e1957a5d4adcf0b5d3072d612ffb98d2258889e59d77be69eN270ltKhPCmQiFNZBPzJNc4ZqKpTTOt~cvhruMi9mbk-
ERROR - 2019-04-07 13:00:39 --> Severity: Notice --> Undefined property: registration::$registration_model C:\xampp\htdocs\coopris\application\controllers\registration.php 29
ERROR - 2019-04-07 13:00:40 --> Severity: Error --> Call to a member function register_coop() on null C:\xampp\htdocs\coopris\application\controllers\registration.php 29
ERROR - 2019-04-07 13:01:25 --> Query error: Unknown column 'proposed_name' in 'field list' - Invalid query: insert into registeredcoop(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant) select rtrim(proposed_name +' '+ type_of_cooperative  +' Cooperative '+ grouping), '9520-1013000000000001', category_of_cooperative, '2019-04-07', common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode where id=33
ERROR - 2019-04-07 13:03:12 --> Query error: Unknown column 'proposed_name' in 'field list' - Invalid query: insert into registeredcoop(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant) select rtrim(proposed_name +' '+ type_of_cooperative  +' Cooperative '+ grouping), '9520-1013000000000002', category_of_cooperative, '2019-04-07', common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode where id=33
ERROR - 2019-04-07 13:09:35 --> Query error: Column count doesn't match value count at row 1 - Invalid query: insert into registeredcoop(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant) select rtrim(proposed_name +' '+ type_of_cooperative  +' Cooperative '+ grouping), '9520-1013000000000002', category_of_cooperative, '2019-04-07', common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode from cooperatives where id=33
ERROR - 2019-04-07 14:42:23 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 31
ERROR - 2019-04-07 14:42:23 --> Severity: Error --> Class 'pdf' not found C:\xampp\htdocs\coopris\application\controllers\registration.php 38
ERROR - 2019-04-07 14:43:18 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 31
ERROR - 2019-04-07 14:48:39 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 31
ERROR - 2019-04-07 15:01:24 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 31
ERROR - 2019-04-07 15:01:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 31
ERROR - 2019-04-07 16:02:33 --> Severity: Notice --> Undefined property: stdClass::$street C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 62
ERROR - 2019-04-07 16:02:33 --> Severity: Notice --> Undefined property: stdClass::$brgyDesc C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 62
ERROR - 2019-04-07 16:04:58 --> Severity: Notice --> Undefined property: stdClass::$street C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 62
ERROR - 2019-04-07 16:04:58 --> Severity: Notice --> Undefined property: stdClass::$brgyDesc C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 62
ERROR - 2019-04-07 16:37:50 --> Severity: Parsing Error --> syntax error, unexpected '?>' C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 74
ERROR - 2019-04-07 23:42:11 --> Non-existent class: Ci_qr_code
ERROR - 2019-04-07 23:42:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\coopris\application\libraries\Ci_qr_code.php:166) C:\xampp\htdocs\coopris\system\core\Common.php 570
