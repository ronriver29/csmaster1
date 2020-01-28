<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-22 00:01:45 --> Severity: Error --> Call to undefined method laboratories_model::get_all_laboratories() C:\xampp\htdocs\coopris\application\controllers\laboratories.php 212
ERROR - 2019-04-22 00:01:53 --> Severity: Error --> Call to undefined method laboratories_model::get_all_laboratories() C:\xampp\htdocs\coopris\application\controllers\laboratories.php 212
ERROR - 2019-04-22 00:02:11 --> Query error: Unknown column 'coopName' in 'field list' - Invalid query: SELECT `laboratories`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`, `coopName`
FROM `laboratories`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `laboratories`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `laboratories`.`user_id` = '8'
ERROR - 2019-04-22 00:04:39 --> Severity: Notice --> Undefined variable: list_branches C:\xampp\htdocs\coopris\application\views\applications\list_of_laboratories.php 76
ERROR - 2019-04-22 00:04:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\list_of_laboratories.php 76
ERROR - 2019-04-22 00:05:28 --> Severity: Notice --> Undefined variable: list_branches C:\xampp\htdocs\coopris\application\views\applications\list_of_laboratories.php 76
ERROR - 2019-04-22 00:05:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\list_of_laboratories.php 76
ERROR - 2019-04-22 00:22:54 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 98
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 99
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 100
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 101
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 102
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 104
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 105
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 106
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 107
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 108
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 109
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 110
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 111
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 112
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 113
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 114
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 115
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 116
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 98
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 99
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 100
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 101
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 102
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 104
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 105
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 106
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 107
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 108
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 109
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 110
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 111
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 112
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 113
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 114
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 115
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 116
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 98
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 99
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 100
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 101
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 102
ERROR - 2019-04-22 00:22:55 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 104
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 105
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 106
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 107
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 108
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 109
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 110
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 111
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 112
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 113
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 114
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 115
ERROR - 2019-04-22 00:22:56 --> Severity: Notice --> Undefined variable: cooperative C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 116
ERROR - 2019-04-22 00:24:14 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-22 00:24:14 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-22 00:24:25 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-22 00:24:25 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
