<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-21 07:25:45 --> Could not find the language line "form_validation_number"
ERROR - 2019-04-21 07:55:39 --> Severity: Parsing Error --> syntax error, unexpected ')' C:\xampp\htdocs\coopris\application\models\Cooperator_model.php 358
ERROR - 2019-04-21 07:56:09 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::row() C:\xampp\htdocs\coopris\application\models\Cooperator_model.php 359
ERROR - 2019-04-21 07:56:11 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::row() C:\xampp\htdocs\coopris\application\models\Cooperator_model.php 359
ERROR - 2019-04-21 07:56:14 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::row() C:\xampp\htdocs\coopris\application\models\Cooperator_model.php 359
ERROR - 2019-04-21 07:56:19 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::row() C:\xampp\htdocs\coopris\application\models\Cooperator_model.php 359
ERROR - 2019-04-21 07:56:21 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::row() C:\xampp\htdocs\coopris\application\models\Cooperator_model.php 359
ERROR - 2019-04-21 07:57:16 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::row() C:\xampp\htdocs\coopris\application\models\Cooperator_model.php 359
ERROR - 2019-04-21 07:59:14 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `cooperators`.*, `refbrgy`.`brgyCode` as `bCode`, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunCode` as `cCode`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provCode` as `pCode`, `refprovince`.`provDesc` as `province`, `refregion`.`regCode` as `rCode`, `refregion`.`regDesc` as `region`
FROM `cooperators`
INNER JOIN `refbrgy` ON `refbrgy`.`brgycode`=`cooperators`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `id` = '98'
ERROR - 2019-04-21 08:00:13 --> Query error: Unknown column 'cooperator.id' in 'where clause' - Invalid query: SELECT `cooperators`.*, `refbrgy`.`brgyCode` as `bCode`, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunCode` as `cCode`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provCode` as `pCode`, `refprovince`.`provDesc` as `province`, `refregion`.`regCode` as `rCode`, `refregion`.`regDesc` as `region`
FROM `cooperators`
INNER JOIN `refbrgy` ON `refbrgy`.`brgycode`=`cooperators`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `cooperator`.`id` = '98'
ERROR - 2019-04-21 23:08:02 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-21 23:08:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-21 23:08:05 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-21 23:08:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-21 23:08:07 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:08:07 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:11:12 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:11:12 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:11:42 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 613
ERROR - 2019-04-21 23:12:08 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:12:08 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:12:17 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 613
ERROR - 2019-04-21 23:12:51 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:12:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:13:05 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:13:05 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:13:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 613
ERROR - 2019-04-21 23:15:24 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:15:24 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:15:56 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:15:56 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:16:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:16:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:19:34 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:19:34 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-21 23:57:46 --> Severity: Notice --> Undefined property: laboratories::$laboratories_model C:\xampp\htdocs\coopris\application\controllers\laboratories.php 212
ERROR - 2019-04-21 23:57:46 --> Severity: Error --> Call to a member function get_all_laboratories() on null C:\xampp\htdocs\coopris\application\controllers\laboratories.php 212
ERROR - 2019-04-21 23:58:38 --> Severity: Error --> Call to undefined method laboratories_model::get_all_laboratories() C:\xampp\htdocs\coopris\application\controllers\laboratories.php 212
