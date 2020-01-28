<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-15 00:06:06 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:06:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:07:44 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:07:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:08:43 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:08:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:09:07 --> Query error: Unknown column 'evaluated_by' in 'where clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` = 3
AND `evaluated_by` = '21'
ERROR - 2019-04-15 00:13:49 --> Query error: Unknown column 'branches.refbrgy_brgyCode' in 'on clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` = 9
AND `evaluator3` = '21'
ERROR - 2019-04-15 00:13:51 --> Query error: Unknown column 'branches.refbrgy_brgyCode' in 'on clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` = 9
AND `evaluator3` = '21'
ERROR - 2019-04-15 00:13:53 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:13:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:13:55 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:13:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:14:02 --> Query error: Unknown column 'branches.refbrgy_brgyCode' in 'on clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` = 9
AND `evaluator3` = '21'
ERROR - 2019-04-15 00:15:01 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:15:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:15:15 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:15:15 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:15:27 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:15:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:16:25 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:16:25 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:16:41 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:16:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:26:05 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:26:05 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:26:19 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:26:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:26:46 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:26:46 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:26:48 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:26:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:26:50 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:26:51 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:26:59 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:26:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:27:53 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:27:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:30:00 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:30:00 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:30:04 --> Query error: Table 'cis.branches-' doesn't exist - Invalid query: SELECT *
FROM `branches-`
WHERE `id` = '7'
ERROR - 2019-04-15 00:32:46 --> Severity: Parsing Error --> syntax error, unexpected ',' C:\xampp\htdocs\coopris\application\controllers\branches.php 981
ERROR - 2019-04-15 00:34:20 --> Severity: Notice --> Undefined variable: admin_info C:\xampp\htdocs\coopris\application\controllers\branches.php 612
ERROR - 2019-04-15 00:34:20 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 612
ERROR - 2019-04-15 00:34:20 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\branches_model.php 570
ERROR - 2019-04-15 00:34:20 --> Query error: Unknown column 'evaluator3' in 'field list' - Invalid query: UPDATE `cooperatives` SET `evaluator3` = NULL, `status` = 12, `expire_at` = '2019-04-30 12:34:20', `evaluation_comment` = NULL
WHERE `id` = '7'
ERROR - 2019-04-15 00:34:31 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:34:31 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:34:41 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:34:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:34:45 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:34:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:34:57 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:34:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:36:59 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:36:59 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:37:17 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:37:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:37:50 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:37:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:37:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:37:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:37:59 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:37:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:43:37 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:43:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:43:39 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:43:39 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:43:46 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:43:46 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:44:53 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:44:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 00:44:55 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:44:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:45:10 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:45:10 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:45:15 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:45:15 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:45:29 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:45:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:46:38 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:46:38 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:47:05 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:47:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:47:49 --> Severity: Parsing Error --> syntax error, unexpected '-', expecting '(' C:\xampp\htdocs\coopris\application\controllers\branches.php 835
ERROR - 2019-04-15 00:48:06 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:48:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 00:48:10 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:48:10 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:48:15 --> 404 Page Not Found: Branches/defer_branch
ERROR - 2019-04-15 00:51:15 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:51:15 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 00:51:35 --> Query error: Table 'cis.branchesa' doesn't exist - Invalid query: SELECT *
FROM `branchesa`
WHERE `id` = '7'
ERROR - 2019-04-15 00:52:09 --> Query error: Table 'cis.branchesb' doesn't exist - Invalid query: SELECT *
FROM `branchesb`
WHERE `id` = '7'
ERROR - 2019-04-15 00:52:20 --> Query error: Table 'cis.branchesc' doesn't exist - Invalid query: SELECT *
FROM `branchesc`
WHERE `id` = '7'
ERROR - 2019-04-15 00:52:30 --> Severity: Notice --> Undefined variable: admin_info C:\xampp\htdocs\coopris\application\controllers\branches.php 981
ERROR - 2019-04-15 00:52:30 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\branches_model.php 687
ERROR - 2019-04-15 00:52:30 --> Query error: Table 'cis.branchesc' doesn't exist - Invalid query: UPDATE `branchesc` SET `evaluator3` = NULL, `status` = 11, `expire_at` = '2019-04-30 12:52:30', `evaluation_comment` = 'fuck you'
WHERE `id` = '7'
ERROR - 2019-04-15 00:59:10 --> Query error: Table 'cis.branchesc' doesn't exist - Invalid query: UPDATE `branchesc` SET `evaluator3` = '21', `status` = 11, `expire_at` = '2019-04-30 12:59:10', `evaluation_comment` = 'fuck you'
WHERE `id` = '7'
ERROR - 2019-04-15 01:00:05 --> Query error: Unknown column 'expire_at' in 'field list' - Invalid query: UPDATE `branches` SET `evaluator3` = '21', `status` = 11, `expire_at` = '2019-04-30 01:00:05', `evaluation_comment` = 'fuck you'
WHERE `id` = '7'
ERROR - 2019-04-15 01:01:08 --> Query error: Unknown column 'updated_at' in 'field list' - Invalid query: UPDATE `branches` SET `evaluator3` = '21', `status` = 11, `updated_at` = '2019-04-30 01:01:08', `evaluation_comment` = 'fuck you'
WHERE `id` = '7'
ERROR - 2019-04-15 01:02:36 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:02:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:03:38 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:03:38 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:04:39 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:04:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:04:45 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:04:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:05:04 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:05:04 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:05:15 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:05:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:12:35 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:12:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:25:40 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:25:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:25:43 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:25:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:25:45 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:25:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:27:40 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:27:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:28:55 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:28:55 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:29:36 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:29:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:29:43 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:29:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:29:49 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:29:49 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:30:14 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:30:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:30:34 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:30:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:31:45 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:31:46 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:31:49 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:31:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:31:53 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:31:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:32:54 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:32:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:35:25 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:35:25 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:35:29 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 596
ERROR - 2019-04-15 01:35:55 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:35:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:35:57 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:35:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:36:00 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:36:00 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:36:00 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:36:00 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:36:07 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 612
ERROR - 2019-04-15 01:36:07 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:36:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:37:03 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:37:03 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:37:07 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 578
ERROR - 2019-04-15 01:37:25 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:37:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 01:37:37 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:37:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:37:42 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:37:42 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:37:46 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 540
ERROR - 2019-04-15 01:37:46 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:37:46 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 01:41:03 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by C:\xampp\htdocs\coopris\application\models\branches_model.php 735
ERROR - 2019-04-15 01:47:30 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by C:\xampp\htdocs\coopris\application\models\branches_model.php 735
ERROR - 2019-04-15 01:50:59 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:50:59 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 01:55:27 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 596
ERROR - 2019-04-15 02:05:30 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:05:30 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:05:34 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:05:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:06:56 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:06:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:07:00 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:07:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:07:54 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:07:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:08:04 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:08:04 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:08:07 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 612
ERROR - 2019-04-15 02:08:08 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:08:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:17:49 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:17:49 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:18:00 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 578
ERROR - 2019-04-15 02:18:55 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:18:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:18:57 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:18:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:19:36 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:19:36 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:19:40 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 540
ERROR - 2019-04-15 02:19:40 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:19:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:19:43 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:19:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:19:47 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 558
ERROR - 2019-04-15 02:19:47 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:19:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:26:03 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:26:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:26:56 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:26:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:27:30 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:27:30 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:27:35 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 612
ERROR - 2019-04-15 02:27:35 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:27:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:28:02 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:28:02 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:28:05 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 578
ERROR - 2019-04-15 02:28:25 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:28:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:28:28 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:28:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:28:32 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:28:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:28:53 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:28:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:29:23 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:29:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:29:28 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:29:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:29:52 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:29:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 02:30:03 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:30:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:30:09 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:30:09 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-15 02:30:13 --> Severity: Notice --> Undefined variable: reason_commment C:\xampp\htdocs\coopris\application\controllers\branches.php 540
ERROR - 2019-04-15 02:30:13 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:30:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_branch_admin_modal.php 27
ERROR - 2019-04-15 02:31:03 --> 404 Page Not Found: Branches/229f018b16ef383d4d673beb1bbd017279b99f1a2cfbaadf866143535ba536d3efcafabde69d3af75a1b79789ffc7931c3661b2c9a76e86296f277a95a41264abmol.anmbqMhRCRZrGrJvcqYnhBvFCbjVWlgMcKw.MA-
ERROR - 2019-04-15 02:31:11 --> 404 Page Not Found: Branches/229f018b16ef383d4d673beb1bbd017279b99f1a2cfbaadf866143535ba536d3efcafabde69d3af75a1b79789ffc7931c3661b2c9a76e86296f277a95a41264abmol.anmbqMhRCRZrGrJvcqYnhBvFCbjVWlgMcKw.MA-
ERROR - 2019-04-15 04:50:24 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:50:40 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:51:05 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:51:53 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:51:53 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:52:19 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:53:50 --> 404 Page Not Found: Branches/20564f52adcc5888aa41624661aea92b553a2585c3275231322f8498badef71666380a26fd78b6ca6e102d5d87260b009509ce049b08974e148073ff2a84cec3ghVVDXbrlCdFpLDx~U5fASQe1Ryy6.8v5GvKeRrcCDs-
ERROR - 2019-04-15 04:54:00 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:55:25 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:56:16 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:56:28 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:56:53 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:57:28 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:57:58 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:58:55 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 04:59:57 --> 404 Page Not Found: Payments_branch/index
ERROR - 2019-04-15 05:03:05 --> Severity: Error --> Call to undefined method branches_model::get_branches_info() C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 35
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Undefined variable: bylaw_info C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 66
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 66
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Undefined variable: total_regular C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 66
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Undefined variable: article_info C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 66
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 66
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Undefined variable: total_associate C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 66
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Undefined variable: article_info C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 66
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 66
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Undefined property: stdClass::$proposed_name C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 73
ERROR - 2019-04-15 05:03:59 --> Severity: Notice --> Undefined property: stdClass::$type_of_cooperative C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 73
ERROR - 2019-04-15 05:39:28 --> Severity: Notice --> Undefined variable: branchName C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 37
ERROR - 2019-04-15 05:39:28 --> Severity: Notice --> Undefined variable: client_info C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 05:39:28 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 05:39:58 --> Severity: Notice --> Undefined variable: branchName C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 37
ERROR - 2019-04-15 05:39:58 --> Severity: Notice --> Undefined variable: client_info C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 05:39:58 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 05:40:30 --> Severity: Notice --> Undefined variable: branchName C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 37
ERROR - 2019-04-15 05:40:30 --> Severity: Notice --> Undefined variable: client_info C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 05:40:30 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 05:41:01 --> Severity: Notice --> Undefined variable: branchName C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 37
ERROR - 2019-04-15 05:41:55 --> Severity: Notice --> Undefined variable: branchName C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 37
ERROR - 2019-04-15 05:41:55 --> Severity: Error --> Cannot access empty property C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 37
ERROR - 2019-04-15 05:42:11 --> Severity: Notice --> Undefined variable: branchName C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 37
ERROR - 2019-04-15 05:42:11 --> Severity: Error --> Cannot access empty property C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 37
ERROR - 2019-04-15 05:56:21 --> Severity: Notice --> Undefined variable: last C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 67
ERROR - 2019-04-15 06:09:51 --> Severity: Notice --> Undefined variable: last C:\xampp\htdocs\coopris\application\views\cooperative\payment_form_branch.php 67
ERROR - 2019-04-15 06:18:00 --> Severity: Notice --> Undefined variable: client_info C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 06:18:00 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 06:18:45 --> Severity: Notice --> Undefined variable: client_info C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 06:18:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\template\header.php 38
ERROR - 2019-04-15 06:54:05 --> Severity: Notice --> Undefined property: Payments_branch::$Payment_branch_model C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 112
ERROR - 2019-04-15 06:54:05 --> Severity: Error --> Call to a member function pay_offline() on null C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 112
ERROR - 2019-04-15 06:54:48 --> Severity: Notice --> Undefined property: stdClass::$tDate C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 39
ERROR - 2019-04-15 06:54:48 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:54:48 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:54:48 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:54:48 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:54:48 --> Severity: Notice --> Undefined variable: nature C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 47
ERROR - 2019-04-15 06:54:48 --> Severity: Notice --> Undefined variable: particulars C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 58
ERROR - 2019-04-15 06:54:48 --> Severity: Notice --> Undefined variable: amount C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 60
ERROR - 2019-04-15 06:56:43 --> Severity: Notice --> Undefined property: stdClass::$tDate C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 39
ERROR - 2019-04-15 06:56:43 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:56:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:56:43 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:56:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:56:43 --> Severity: Notice --> Undefined variable: nature C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 47
ERROR - 2019-04-15 06:56:43 --> Severity: Notice --> Undefined variable: particulars C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 58
ERROR - 2019-04-15 06:56:43 --> Severity: Notice --> Undefined variable: amount C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 60
ERROR - 2019-04-15 06:58:54 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:58:55 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:58:55 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:58:55 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 06:58:55 --> Severity: Notice --> Undefined variable: nature C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 47
ERROR - 2019-04-15 06:58:55 --> Severity: Notice --> Undefined variable: particulars C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 58
ERROR - 2019-04-15 06:58:55 --> Severity: Notice --> Undefined variable: amount C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 60
ERROR - 2019-04-15 07:00:52 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 07:00:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 07:00:52 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 07:00:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 07:09:18 --> Severity: Notice --> Undefined index: payorID C:\xampp\htdocs\coopris\application\models\Payment_model.php 33
ERROR - 2019-04-15 07:09:18 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` IS NULL
AND `nature` = 'Branch  Registration'
AND `amount` = '500.00'
ERROR - 2019-04-15 07:10:16 --> Severity: Notice --> Undefined index: payorID C:\xampp\htdocs\coopris\application\models\Payment_model.php 33
ERROR - 2019-04-15 07:10:16 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` IS NULL
AND `nature` = 'Branch  Registration'
AND `amount` = '500.00'
ERROR - 2019-04-15 07:10:24 --> Severity: Notice --> Undefined index: payorID C:\xampp\htdocs\coopris\application\models\Payment_model.php 33
ERROR - 2019-04-15 07:10:24 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` IS NULL
AND `nature` = 'Branch  Registration'
AND `amount` = '500.00'
ERROR - 2019-04-15 07:11:44 --> Severity: Notice --> Undefined property: Payments_branch::$Payment_h_brancmodel C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 124
ERROR - 2019-04-15 07:11:44 --> Severity: Error --> Call to a member function check_payment_not_exist() on null C:\xampp\htdocs\coopris\application\controllers\Payments_branch.php 124
ERROR - 2019-04-15 07:12:19 --> Severity: Notice --> Undefined index: payorID C:\xampp\htdocs\coopris\application\models\Payment_branch_model.php 33
ERROR - 2019-04-15 07:12:19 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` IS NULL
AND `nature` = 'Branch  Registration'
AND `amount` = '500.00'
ERROR - 2019-04-15 07:13:36 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 07:13:36 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 07:13:36 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 07:13:36 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\order_of_payment_branch.php 43
ERROR - 2019-04-15 07:25:57 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\coopris\system\helpers\url_helper.php 564
ERROR - 2019-04-15 07:29:31 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\coopris\system\helpers\url_helper.php 564
ERROR - 2019-04-15 07:31:45 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\coopris\system\helpers\url_helper.php 564
ERROR - 2019-04-15 07:32:29 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\coopris\system\helpers\url_helper.php 564
ERROR - 2019-04-15 07:34:07 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` = '7'
AND `nature` = 'Name Registration'
ERROR - 2019-04-15 07:34:19 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` = '33'
AND `nature` = 'Name Registration'
ERROR - 2019-04-15 07:43:32 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` = '33'
AND `nature` = 'Name Registration'
ERROR - 2019-04-15 07:43:56 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` = '33'
AND `nature` = 'Name Registration'
ERROR - 2019-04-15 07:44:16 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` = '33'
AND `nature` = 'Name Registration'
ERROR - 2019-04-15 09:21:08 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 09:21:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 09:21:20 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 09:21:20 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 09:22:57 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 09:22:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 09:23:13 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 09:23:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-15 09:25:27 --> Query error: Unknown column 'payorID' in 'where clause' - Invalid query: SELECT *
FROM `payment`
WHERE `payorID` = '33'
AND `nature` = 'Name Registration'
ERROR - 2019-04-15 09:37:43 --> Severity: Parsing Error --> syntax error, unexpected '<' C:\xampp\htdocs\coopris\application\views\applications\list_of_applications.php 134
ERROR - 2019-04-15 12:18:52 --> Query error: Table 'cis.cooperativ' doesn't exist - Invalid query: UPDATE `cooperativ` SET `status` = 14
WHERE `id` IS NULL
ERROR - 2019-04-15 12:25:01 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` = ''
ERROR - 2019-04-15 12:25:06 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` IS NULL
ERROR - 2019-04-15 12:25:51 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` = ''
ERROR - 2019-04-15 12:26:14 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` IS NULL
ERROR - 2019-04-15 12:29:24 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` = 33
ERROR - 2019-04-15 12:29:31 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` = 33
ERROR - 2019-04-15 12:36:22 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` = '33'
ERROR - 2019-04-15 12:36:30 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` IS NULL
ERROR - 2019-04-15 12:38:02 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` IS NULL
ERROR - 2019-04-15 12:38:06 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` IS NULL
ERROR - 2019-04-15 12:40:40 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` IS NULL
ERROR - 2019-04-15 12:42:29 --> Query error: Table 'cis.cooperative' doesn't exist - Invalid query: UPDATE `cooperative` SET `status` = 14
WHERE `id` = '33'
ERROR - 2019-04-15 13:05:44 --> Severity: Notice --> Undefined property: stdClass::$house_blk_no C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 63
ERROR - 2019-04-15 13:05:44 --> Severity: Notice --> Undefined property: stdClass::$street C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 63
ERROR - 2019-04-15 13:05:44 --> Severity: Notice --> Undefined property: stdClass::$house_blk_no C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 140
ERROR - 2019-04-15 13:05:44 --> Severity: Notice --> Undefined property: stdClass::$street C:\xampp\htdocs\coopris\application\views\cooperative\COR_view.php 140
ERROR - 2019-04-15 19:40:35 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\coopris\system\helpers\url_helper.php 564
ERROR - 2019-04-15 19:57:17 --> Severity: Notice --> Undefined variable: coop_id C:\xampp\htdocs\coopris\application\controllers\branches.php 459
ERROR - 2019-04-15 19:57:33 --> Severity: Notice --> Undefined variable: coop_id C:\xampp\htdocs\coopris\application\controllers\branches.php 459
ERROR - 2019-04-15 19:57:38 --> Severity: Notice --> Undefined variable: coop_id C:\xampp\htdocs\coopris\application\controllers\branches.php 459
ERROR - 2019-04-15 20:01:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '- where payor="Helpin Me Electric Cooperative - City Of Marikina NCR Second Dist' at line 1 - Invalid query: select * from payment- where payor="Helpin Me Electric Cooperative - City Of Marikina NCR Second District Branch" and (nature= "Branch Registration" or nature= "Satellite Registration")
ERROR - 2019-04-15 20:01:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '- where payor="Helpin Me Electric Cooperative - City Of Marikina NCR Second Dist' at line 1 - Invalid query: select * from payment- where payor="Helpin Me Electric Cooperative - City Of Marikina NCR Second District Branch" and (nature= "Branch Registration" or nature= "Satellite Registration")
ERROR - 2019-04-15 20:12:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '- where payor="Helpin Me Electric Cooperative - Aguilar Pangasinan Branch" and (' at line 1 - Invalid query: select * from payment- where payor="Helpin Me Electric Cooperative - Aguilar Pangasinan Branch" and (nature= "Branch Registration" or nature= "Satellite Registration")
ERROR - 2019-04-15 20:12:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '- where payor="Helpin Me Electric Cooperative - Aguilar Pangasinan Branch" and (' at line 1 - Invalid query: select * from payment- where payor="Helpin Me Electric Cooperative - Aguilar Pangasinan Branch" and (nature= "Branch Registration" or nature= "Satellite Registration")
ERROR - 2019-04-15 20:29:01 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\coopris\system\helpers\url_helper.php 564
ERROR - 2019-04-15 22:04:48 --> 404 Page Not Found: Branchs/39aeb20aa7548e3fb9bd5ecc1722a55e14843a660037e42cb8f15add851bb0a22af04aa5ef0b1fd906ed1cf89b5a38669a56f9410bf44cf19ffc3a4706c4e59eM0HQ55ilqwFTsfXGLhE2QZdtC9jC9IS9529nXBtHd0A-
ERROR - 2019-04-15 22:05:15 --> Severity: Notice --> Undefined property: stdClass::$noStreet C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 29
ERROR - 2019-04-15 22:05:15 --> Severity: Notice --> Undefined property: stdClass::$Street C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 29
ERROR - 2019-04-15 22:05:15 --> Severity: Notice --> Undefined property: stdClass::$noStreet C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 109
ERROR - 2019-04-15 22:05:15 --> Severity: Notice --> Undefined property: stdClass::$Street C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 109
ERROR - 2019-04-15 22:05:15 --> Severity: Notice --> Undefined property: stdClass::$noStreet C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 190
ERROR - 2019-04-15 22:05:15 --> Severity: Notice --> Undefined property: stdClass::$Street C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 190
ERROR - 2019-04-15 22:07:52 --> Severity: Notice --> Undefined property: stdClass::$noStreet C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 109
ERROR - 2019-04-15 22:07:52 --> Severity: Notice --> Undefined property: stdClass::$Street C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 109
ERROR - 2019-04-15 22:07:52 --> Severity: Notice --> Undefined property: stdClass::$noStreet C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 190
ERROR - 2019-04-15 22:07:52 --> Severity: Notice --> Undefined property: stdClass::$Street C:\xampp\htdocs\coopris\application\views\cooperative\CA_view.php 190
