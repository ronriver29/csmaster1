<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-04 06:45:41 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-04 06:45:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-04 06:46:02 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-04 06:46:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-04 06:48:22 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-04 06:48:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-04 06:48:33 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-04 06:48:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-04 06:49:22 --> Severity: Parsing Error --> syntax error, unexpected '$data' (T_VARIABLE) C:\xampp\htdocs\coopris\application\controllers\Payments.php 51
ERROR - 2019-04-04 07:37:35 --> Severity: Parsing Error --> syntax error, unexpected 'echo' (T_ECHO) C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 57
ERROR - 2019-04-04 07:40:03 --> Severity: Parsing Error --> syntax error, unexpected 'echo' (T_ECHO) C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 58
ERROR - 2019-04-04 07:42:51 --> Severity: Parsing Error --> syntax error, unexpected 'echo' (T_ECHO) C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 58
ERROR - 2019-04-04 07:43:42 --> Severity: Parsing Error --> syntax error, unexpected ':' C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 58
ERROR - 2019-04-04 07:44:16 --> Severity: Parsing Error --> syntax error, unexpected ':' C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 58
ERROR - 2019-04-04 07:44:40 --> Severity: Parsing Error --> syntax error, unexpected ':' C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 58
ERROR - 2019-04-04 07:46:51 --> Severity: Parsing Error --> syntax error, unexpected ')', expecting ',' or ';' C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 58
ERROR - 2019-04-04 07:49:25 --> Severity: Notice --> Undefined variable: pay_from C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 48
ERROR - 2019-04-04 08:01:37 --> Severity: Parsing Error --> syntax error, unexpected ''</td>' (T_ENCAPSED_AND_WHITESPACE) C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 75
ERROR - 2019-04-04 08:14:51 --> Severity: Parsing Error --> syntax error, unexpected ''</td>' (T_CONSTANT_ENCAPSED_STRING), expecting ',' or ';' C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 74
ERROR - 2019-04-04 08:15:11 --> Severity: Parsing Error --> syntax error, unexpected ''</td>' (T_CONSTANT_ENCAPSED_STRING), expecting ',' or ';' C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 74
ERROR - 2019-04-04 08:15:15 --> Severity: Parsing Error --> syntax error, unexpected ''</td>' (T_CONSTANT_ENCAPSED_STRING), expecting ',' or ';' C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 74
ERROR - 2019-04-04 09:32:32 --> Severity: Error --> Call to undefined function format_num_custom() C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 70
ERROR - 2019-04-04 10:13:25 --> 404 Page Not Found: Payments/add_payment
ERROR - 2019-04-04 10:16:06 --> 404 Page Not Found: Payments/add_payment
ERROR - 2019-04-04 15:47:20 --> Query error: Unknown column 'cooperative_type.id' in 'where clause' - Invalid query: SELECT DISTINCT `major_industry`.`id`, `major_industry`.`description`
FROM `industry_subclass_by_coop_type`
JOIN `major_industry` ON `major_industry`.`id` = `industry_subclass_by_coop_type`.`major_industry_id`
WHERE `cooperative_type`.`id` = '7'
ORDER BY `description` ASC
ERROR - 2019-04-04 15:48:09 --> Query error: Unknown column 'cooperative_type.id' in 'where clause' - Invalid query: SELECT DISTINCT `subclass`.`id`, `subclass`.`description`
FROM `industry_subclass_by_coop_type`
JOIN `subclass` ON `subclass`.`id` = `industry_subclass_by_coop_type`.`subclass_id`
WHERE `cooperative_type`.`id` = '7'
AND `major_industry`.`id` = '85'
ORDER BY `description` ASC
ERROR - 2019-04-04 21:40:47 --> Severity: Parsing Error --> syntax error, unexpected '}' C:\xampp\htdocs\coopris\application\controllers\Payments.php 133
ERROR - 2019-04-04 22:13:32 --> Severity: Notice --> Undefined variable: cooperativeID C:\xampp\htdocs\coopris\application\controllers\Payments.php 133
ERROR - 2019-04-04 22:13:32 --> Severity: Notice --> Undefined property: Payments::$Payment_model C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:13:32 --> Severity: Error --> Call to a member function pay_offline() on null C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:14:45 --> Severity: Notice --> Undefined property: Payments::$Payment_model C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:14:46 --> Severity: Error --> Call to a member function pay_offline() on null C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:16:04 --> Severity: Notice --> Undefined property: Payments::$Payment_model C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:16:04 --> Severity: Error --> Call to a member function pay_offline() on null C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:16:10 --> Severity: Notice --> Undefined property: Payments::$Payment_model C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:16:10 --> Severity: Error --> Call to a member function pay_offline() on null C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:16:21 --> Severity: Notice --> Undefined property: Payments::$Payment_model C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:16:21 --> Severity: Error --> Call to a member function pay_offline() on null C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:18:14 --> Severity: Notice --> Undefined property: Payments::$Payment_model C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:18:14 --> Severity: Error --> Call to a member function pay_offline() on null C:\xampp\htdocs\coopris\application\controllers\Payments.php 134
ERROR - 2019-04-04 22:19:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '13 = ''
WHERE `id` = ''' at line 1 - Invalid query: UPDATE `status` SET 13 = ''
WHERE `id` = ''
ERROR - 2019-04-04 22:35:15 --> Severity: Notice --> Undefined variable: decoded_id C:\xampp\htdocs\coopris\application\views\cooperative\payment_form.php 42
