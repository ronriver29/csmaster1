<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-14 00:02:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '- where regNo="9520-1013000000000002" and addrCode like "137402%"' at line 1 - Invalid query: select * from branches- where regNo="9520-1013000000000002" and addrCode like "137402%"
ERROR - 2019-04-14 00:28:57 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by C:\xampp\htdocs\coopris\application\models\branches_model.php 640
ERROR - 2019-04-14 00:32:24 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by C:\xampp\htdocs\coopris\application\models\branches_model.php 640
ERROR - 2019-04-14 00:32:39 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by C:\xampp\htdocs\coopris\application\models\branches_model.php 640
ERROR - 2019-04-14 01:03:08 --> Query error: Unknown column 'branches.refbrgy_brgyCode' in 'on clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
INNER JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` IN('2', '4', '5', '11', '9', '13', '14', '15')
ERROR - 2019-04-14 01:45:14 --> Severity: Warning --> fsockopen(): php_network_getaddresses: getaddrinfo failed: No such host is known.  C:\xampp\htdocs\coopris\system\libraries\Email.php 2069
ERROR - 2019-04-14 01:45:14 --> Severity: Warning --> fsockopen(): unable to connect to ssl://smtp.gmail.com:465 (php_network_getaddresses: getaddrinfo failed: No such host is known. ) C:\xampp\htdocs\coopris\system\libraries\Email.php 2069
ERROR - 2019-04-14 02:05:52 --> Query error: Unknown column 'branches.refbrgy_brgyCode' in 'on clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
INNER JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` IN('2', '4', '5', '11', '9', '13', '14', '15')
ERROR - 2019-04-14 02:23:21 --> Query error: Unknown column 'branches.refbrgy_brgyCode' in 'on clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
INNER JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` IN('2', '4', '5', '11', '9', '13', '14', '15')
ERROR - 2019-04-14 02:35:47 --> Severity: Parsing Error --> syntax error, unexpected 'endif' (T_ENDIF) C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 141
ERROR - 2019-04-14 02:37:36 --> Severity: Notice --> Undefined index: proposed_name C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:37:36 --> Severity: Notice --> Undefined index: type_of_branch C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:37:36 --> Severity: Notice --> Undefined index: grouping C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:38:29 --> Severity: Notice --> Undefined index: proposed_name C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:38:29 --> Severity: Notice --> Undefined index: type_of_branch C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:38:29 --> Severity: Notice --> Undefined index: grouping C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:38:43 --> Severity: Notice --> Undefined index: proposed_name C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:38:43 --> Severity: Notice --> Undefined index: type_of_branch C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:38:43 --> Severity: Notice --> Undefined index: grouping C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:39:38 --> Severity: Notice --> Undefined index: proposed_name C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:39:38 --> Severity: Notice --> Undefined index: type_of_branch C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 02:39:38 --> Severity: Notice --> Undefined index: grouping C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 03:34:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '013"
    and branches.status in (8,10,11,12,18,19,20,21)' at line 8 - Invalid query: select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "013""
    and branches.status in (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "013"
    and branches.status in (8,10,11,12,18,19,20,21)
ERROR - 2019-04-14 03:35:21 --> Severity: Notice --> Undefined index: proposed_name C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 03:35:21 --> Severity: Notice --> Undefined index: type_of_branch C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 03:35:21 --> Severity: Notice --> Undefined index: grouping C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 130
ERROR - 2019-04-14 03:45:21 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 578
ERROR - 2019-04-14 04:14:03 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:17:36 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:22:46 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:23:00 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:27:04 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:27:15 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:27:22 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:32:39 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:35:38 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:37:07 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:38:29 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:41:00 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:49:53 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:50:11 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:50:12 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:50:17 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:52:42 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:54:32 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:54:52 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:56:12 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:56:29 --> 404 Page Not Found: 
ERROR - 2019-04-14 04:59:20 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\branches_model.php 636
ERROR - 2019-04-14 04:59:39 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\branches_model.php 636
ERROR - 2019-04-14 05:00:43 --> 404 Page Not Found: 
ERROR - 2019-04-14 05:02:34 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\branches_model.php 636
ERROR - 2019-04-14 05:03:44 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\branches_model.php 636
ERROR - 2019-04-14 05:17:23 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\branches_model.php 636
ERROR - 2019-04-14 05:18:34 --> Query error: Unknown column 'evaluated_by' in 'where clause' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `branches`
WHERE `id` = '7'
AND `status` = 2
AND `evaluated_by` != 0
ERROR - 2019-04-14 05:45:07 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 578
ERROR - 2019-04-14 05:56:58 --> Severity: Error --> Call to undefined method branches_model::check_expired_reservation() C:\xampp\htdocs\coopris\application\controllers\Documents.php 176
ERROR - 2019-04-14 05:59:07 --> 404 Page Not Found: Documents/view_document_5
ERROR - 2019-04-14 06:06:40 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 578
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: encrypted_branch_id C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 3
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 160
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: document_5 C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 171
ERROR - 2019-04-14 06:22:45 --> Severity: Notice --> Undefined variable: document_5 C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 176
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Undefined variable: document_6 C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 192
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Undefined variable: document_6 C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 197
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Undefined variable: document_7 C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 213
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Undefined variable: document_7 C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 218
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 06:22:46 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 217
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 217
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 218
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 218
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 219
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 219
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 220
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 220
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 221
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 221
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: encrypted_branch_id C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 3
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 160
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:25:53 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:25:54 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:25:54 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 06:25:54 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 06:38:40 --> Query error: Unknown column 'branches.refbrgy_brgyCode' in 'on clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyCode` as `bCode`, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunCode` as `cCode`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provCode` as `pCode`, `refprovince`.`provDesc` as `province`, `refregion`.`regCode` as `rCode`, `refregion`.`regDesc` as `region`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `branches`.`id` = '6'
ERROR - 2019-04-14 06:39:21 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 218
ERROR - 2019-04-14 06:39:21 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 220
ERROR - 2019-04-14 06:39:21 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 221
ERROR - 2019-04-14 06:39:21 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 222
ERROR - 2019-04-14 06:39:21 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 223
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 224
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 9
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 160
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 06:39:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 06:40:07 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 218
ERROR - 2019-04-14 06:40:07 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 220
ERROR - 2019-04-14 06:40:07 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 221
ERROR - 2019-04-14 06:40:07 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 222
ERROR - 2019-04-14 06:40:07 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 223
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined property: stdClass::$application_id C:\xampp\htdocs\coopris\application\controllers\Documents.php 224
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined property: stdClass::$category_of_cooperative C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined property: stdClass::$grouping C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined property: stdClass::$category_of_cooperative C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined property: stdClass::$grouping C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined property: stdClass::$category_of_cooperative C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined property: stdClass::$grouping C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 160
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 06:40:08 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 06:43:55 --> Query error: Unknown column 'cooperatives.category_of_cooperative' in 'field list' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyCode` as `bCode`, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunCode` as `cCode`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provCode` as `pCode`, `refprovince`.`provDesc` as `province`, `refregion`.`regCode` as `rCode`, `refregion`.`regDesc` as `region`, `cooperatives`.`category_of_cooperative`, `cooperatives`.`grouping`, `registeredcoop`.`application_id`, `registeredcoop`.`addrCode` as `mainAddr`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `branches`.`id` = '6'
ERROR - 2019-04-14 06:44:39 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:44:39 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 06:44:39 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:44:39 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 06:44:39 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 06:44:39 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:30:19 --> Severity: Notice --> Undefined property: stdClass::$Name C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 11
ERROR - 2019-04-14 07:30:19 --> Severity: Notice --> Undefined property: stdClass::$Name C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 12
ERROR - 2019-04-14 07:30:19 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:30:19 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:30:19 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:30:19 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:30:19 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:30:19 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:31:34 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:31:35 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:31:35 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:31:35 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:31:35 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:31:35 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:34:23 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:34:23 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:34:23 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:34:23 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:34:23 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:34:24 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:36:43 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:36:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:36:43 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:36:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:36:43 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:36:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:36:56 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:36:56 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:36:56 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:36:56 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:36:56 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:36:56 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:38:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:38:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:38:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:38:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:38:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:38:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:46:02 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:46:02 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:46:02 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:46:02 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:46:02 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:46:02 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:46:19 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:46:19 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 07:46:19 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:46:20 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 07:46:20 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 07:46:20 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 08:00:33 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:00:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:00:38 --> Query error: Unknown column 'evaluated_by' in 'where clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `refregion`.`regCode` LIKE '%013%' ESCAPE '!'
AND `status` = 3
AND `evaluated_by` = '21'
ERROR - 2019-04-14 08:00:46 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:00:46 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:00:49 --> Severity: Notice --> Undefined variable: members_composition C:\xampp\htdocs\coopris\application\views\cooperative\cooperative_detail.php 130
ERROR - 2019-04-14 08:00:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\cooperative\cooperative_detail.php 130
ERROR - 2019-04-14 08:08:01 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:08:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:09:29 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:09:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:44:19 --> Severity: Parsing Error --> syntax error, unexpected '$query' (T_VARIABLE) C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 619
ERROR - 2019-04-14 08:48:51 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:48:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:49:15 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 08:49:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 09:56:49 --> Severity: Warning --> Missing argument 4 for Cooperatives_model::defer_by_admin(), called in C:\xampp\htdocs\coopris\application\controllers\Cooperatives.php on line 946 and defined C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 527
ERROR - 2019-04-14 09:56:50 --> Severity: Notice --> Undefined variable: step C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 531
ERROR - 2019-04-14 09:56:50 --> Severity: Notice --> Use of undefined constant step - assumed 'step' C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 533
ERROR - 2019-04-14 10:00:33 --> Severity: Notice --> Use of undefined constant step - assumed 'step' C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 533
ERROR - 2019-04-14 10:01:24 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:01:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:08:26 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:08:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:08:44 --> Severity: Warning --> Missing argument 4 for Cooperatives_model::defer_by_admin(), called in C:\xampp\htdocs\coopris\application\controllers\Cooperatives.php on line 964 and defined C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 527
ERROR - 2019-04-14 10:08:44 --> Severity: Notice --> Undefined variable: step C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 531
ERROR - 2019-04-14 10:08:44 --> Severity: Notice --> Use of undefined constant step - assumed 'step' C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 533
ERROR - 2019-04-14 10:08:45 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:08:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:10:54 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:10:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:12:17 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:12:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:12:22 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:12:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:12:29 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:12:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:26:30 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:26:30 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:27:00 --> Severity: Warning --> Missing argument 4 for Cooperatives_model::defer_by_admin(), called in C:\xampp\htdocs\coopris\application\controllers\Cooperatives.php on line 964 and defined C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 527
ERROR - 2019-04-14 10:27:00 --> Severity: Notice --> Undefined variable: step C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 531
ERROR - 2019-04-14 10:27:00 --> Severity: Notice --> Use of undefined constant step - assumed 'step' C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 533
ERROR - 2019-04-14 10:27:00 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:27:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:28:05 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:28:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:28:19 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:28:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:29:55 --> Severity: Notice --> Use of undefined constant step - assumed 'step' C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 533
ERROR - 2019-04-14 10:35:06 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:35:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:35:33 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:35:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:39:51 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:39:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:41:28 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:41:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:44:43 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:44:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:45:45 --> Severity: Warning --> Missing argument 4 for Cooperatives_model::defer_by_admin(), called in C:\xampp\htdocs\coopris\application\controllers\Cooperatives.php on line 919 and defined C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 527
ERROR - 2019-04-14 10:45:45 --> Severity: Notice --> Undefined variable: step C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 531
ERROR - 2019-04-14 10:45:45 --> Severity: Notice --> Undefined variable: step C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 533
ERROR - 2019-04-14 10:45:46 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:45:46 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:48:02 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:48:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:48:23 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 10:48:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:06:22 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:06:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:06:43 --> Severity: Warning --> Missing argument 4 for Cooperatives_model::deny_by_admin(), called in C:\xampp\htdocs\coopris\application\controllers\Cooperatives.php on line 829 and defined C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 498
ERROR - 2019-04-14 11:06:43 --> Severity: Notice --> Undefined variable: step C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 501
ERROR - 2019-04-14 11:06:43 --> Severity: Notice --> Undefined variable: step C:\xampp\htdocs\coopris\application\models\Cooperatives_model.php 503
ERROR - 2019-04-14 11:06:43 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:06:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:20:50 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:20:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:21:03 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:21:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:22:45 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:22:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:22:59 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:22:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 11:54:29 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 11:54:29 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 11:54:29 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 11:54:29 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\deny_modal_branch.php 21
ERROR - 2019-04-14 11:54:29 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 11:54:29 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\defer_modal_branch.php 21
ERROR - 2019-04-14 12:03:01 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 12:03:01 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 12:18:14 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 12:18:14 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 12:18:23 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 12:18:23 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 12:18:37 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 12:18:37 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 18:36:59 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 18:36:59 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 18:42:30 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 18:42:30 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 18:44:23 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 18:44:23 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 18:45:00 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 18:45:00 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\cooperative\evaluation\approve_modal_branch.php 25
ERROR - 2019-04-14 23:49:15 --> 404 Page Not Found: 
ERROR - 2019-04-14 23:49:45 --> 404 Page Not Found: 
ERROR - 2019-04-14 23:52:36 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 23:52:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 23:52:51 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 23:52:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 23:55:19 --> Severity: Notice --> Undefined variable: list_specialist C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
ERROR - 2019-04-14 23:55:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\applications\assign_admin_modal.php 27
