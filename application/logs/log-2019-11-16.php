<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-16 10:30:15 --> Query error: Column 'coopName' in field list is ambiguous - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`, `coopName`, `registeredcoop`.`addrCode` as `prevreg`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
JOIN `registeredcoop` ON `registeredcoop`.`regNo` = `branches`.`regNo`
WHERE `branches`.`user_id` = '102'
ERROR - 2019-11-16 10:30:35 --> Query error: Column 'coopName' in field list is ambiguous - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`, `coopName`, `registeredcoop`.`addrCode` as `prevreg`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
JOIN `registeredcoop` ON `registeredcoop`.`regNo` = `branches`.`regNo`
WHERE `branches`.`user_id` = '102'
ERROR - 2019-11-16 10:41:00 --> Query error: Column 'coopName' in field list is ambiguous - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`, `coopName`, `registeredcoop`.`addrCode` as `prevreg`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
JOIN `registeredcoop` ON `registeredcoop`.`regNo` = `branches`.`regNo`
WHERE `branches`.`user_id` = '102'
ERROR - 2019-11-16 10:46:09 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 10:46:09 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 10:46:17 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 10:46:17 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:23:45 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:23:45 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:23:56 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:23:56 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:24:07 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:24:07 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 63
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 64
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 64
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 65
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 80
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 81
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 82
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 82
ERROR - 2019-11-16 11:24:09 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-11-16 11:24:12 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:24:12 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:24:22 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:24:22 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:25:25 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:25:25 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:31:33 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:31:33 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 63
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 64
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 64
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 65
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 80
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 81
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 82
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 82
ERROR - 2019-11-16 11:31:40 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-11-16 11:31:43 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:31:43 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:31:50 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:31:50 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 11:31:53 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 128
ERROR - 2019-11-16 11:31:53 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 147
ERROR - 2019-11-16 19:36:02 --> Query error: Column 'coopName' in field list is ambiguous - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`, `coopName`, `registeredcoop`.`addrCode` as `prevreg`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
JOIN `registeredcoop` ON `registeredcoop`.`regNo` = `branches`.`regNo`
WHERE `branches`.`user_id` = '17'
ERROR - 2019-11-16 19:39:40 --> Query error: Column 'coopName' in field list is ambiguous - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`, `coopName`, `registeredcoop`.`addrCode` as `prevreg`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
JOIN `registeredcoop` ON `registeredcoop`.`regNo` = `branches`.`regNo`
WHERE `branches`.`user_id` = '17'
ERROR - 2019-11-16 19:51:04 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-11-16 19:51:09 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-11-16 19:51:13 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-11-16 19:51:18 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 742
ERROR - 2019-11-16 19:52:58 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-11-16 19:53:02 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-11-16 19:53:07 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-11-16 19:53:11 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 742
ERROR - 2019-11-16 19:53:46 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 711
ERROR - 2019-11-16 19:53:46 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 616
ERROR - 2019-11-16 19:57:50 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-11-16 19:57:50 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-11-16 19:58:16 --> 404 Page Not Found: 
ERROR - 2019-11-16 19:58:16 --> 404 Page Not Found: 
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 440
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 441
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 442
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 443
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 444
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 33
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 42
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 52
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 97
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 102
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 102
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'branchName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 102
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'house_blk_no' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 107
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 107
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'house_blk_no' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'region' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'area_of_operation' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 121
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 127
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 128
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 129
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 130
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 131
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 132
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 134
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 134
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 135
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 140
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 199
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 202
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 207
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 213
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 220
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 232
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 242
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 245
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 251
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 258
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 258
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 269
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 269
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 269
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 269
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 272
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 278
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 285
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 285
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 296
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 296
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 296
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 299
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 305
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 312
ERROR - 2019-11-16 19:58:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 312
ERROR - 2019-11-16 20:01:52 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 193
ERROR - 2019-11-16 20:01:52 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 203
ERROR - 2019-11-16 20:01:57 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-11-16 20:01:57 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 193
ERROR - 2019-11-16 20:01:57 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 203
ERROR - 2019-11-16 20:02:02 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-11-16 20:02:02 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 193
ERROR - 2019-11-16 20:02:02 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 203
ERROR - 2019-11-16 20:02:06 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-11-16 20:02:06 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 193
ERROR - 2019-11-16 20:02:06 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 203
ERROR - 2019-11-16 20:02:49 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 742
ERROR - 2019-11-16 20:03:15 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-11-16 20:03:15 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-11-16 20:03:42 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:03:42 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:06:43 --> Query error: Unknown column 'x.regCode' in 'where clause' - Invalid query: select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "002%" or x.regCode like "002%"
    and branches.status in (5)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "002%" or x.regCode like "002%"
    and branches.status in (13,14,15,23)
ERROR - 2019-11-16 20:07:47 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:07:47 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:09:08 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:09:08 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:09:23 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:09:23 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:09:52 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:09:52 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:11:05 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:11:05 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:12:08 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:12:08 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:13:04 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:13:04 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:27:02 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:27:02 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:27:24 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:27:24 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:28:02 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:28:02 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:28:45 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:28:45 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:29:58 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:29:58 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:30:06 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:30:06 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:32:44 --> Severity: Notice --> Undefined variable: outside_the_region /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 192
ERROR - 2019-11-16 20:32:44 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 192
ERROR - 2019-11-16 20:42:43 --> Severity: Notice --> Undefined variable: outside_the_regions /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 199
ERROR - 2019-11-16 20:42:43 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 199
ERROR - 2019-11-16 20:43:39 --> Severity: Notice --> Undefined variable: outside_the_regions /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 199
ERROR - 2019-11-16 20:43:39 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 199
ERROR - 2019-11-16 20:46:22 --> Severity: error --> Exception: syntax error, unexpected 'endforeach' (T_ENDFOREACH) /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 231
ERROR - 2019-11-16 20:46:42 --> Severity: Notice --> Undefined variable: outside_the_region /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 214
ERROR - 2019-11-16 20:46:42 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 214
ERROR - 2019-11-16 20:48:50 --> Severity: error --> Exception: syntax error, unexpected 'endif' (T_ENDIF) /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 225
ERROR - 2019-11-16 20:50:06 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 713
ERROR - 2019-11-16 20:50:06 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 616
ERROR - 2019-11-16 20:50:18 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-11-16 20:50:18 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-11-16 20:50:22 --> Severity: Notice --> Undefined variable: branch /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 207
ERROR - 2019-11-16 20:50:22 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:50:22 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:50:33 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 20:50:33 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:00:34 --> Severity: Notice --> Undefined variable: submit /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 15
ERROR - 2019-11-16 21:01:11 --> Severity: Notice --> Undefined variable: submit /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 15
ERROR - 2019-11-16 21:02:10 --> Severity: Notice --> Undefined variable: branc_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 9
ERROR - 2019-11-16 21:02:10 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 9
ERROR - 2019-11-16 21:02:16 --> Severity: Notice --> Undefined variable: branc_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 9
ERROR - 2019-11-16 21:02:16 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 9
ERROR - 2019-11-16 21:02:58 --> Severity: error --> Exception: syntax error, unexpected 'endif' (T_ENDIF) /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 63
ERROR - 2019-11-16 21:02:59 --> Severity: error --> Exception: syntax error, unexpected 'endif' (T_ENDIF) /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 63
ERROR - 2019-11-16 21:23:10 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:23:10 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:24:08 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:24:08 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:24:14 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:24:14 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:25:21 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:25:21 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:25:27 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:25:27 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:26:21 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:26:21 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:27:42 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:27:46 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:27:46 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:30:21 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:30:21 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:35:57 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 680
ERROR - 2019-11-16 21:36:01 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:36:01 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:38:12 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:38:12 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:38:18 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 680
ERROR - 2019-11-16 21:38:22 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:38:22 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:39:26 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:39:26 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:39:37 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 680
ERROR - 2019-11-16 21:39:41 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:39:41 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:41:19 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:41:19 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:41:25 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 680
ERROR - 2019-11-16 21:41:28 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:41:28 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:42:57 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:42:57 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:43:02 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 21:43:05 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:43:05 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:43:34 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:43:34 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:43:40 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 21:43:43 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:43:43 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:45:48 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:45:48 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:45:53 --> Severity: error --> Exception: Too few arguments to function branches_model::get_branch_info(), 1 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php on line 615 and exactly 2 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 229
ERROR - 2019-11-16 21:46:16 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 680
ERROR - 2019-11-16 21:46:17 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:46:17 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:47:18 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:47:18 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:47:25 --> Severity: Notice --> Undefined variable: branch_info /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:47:25 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:47:25 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 680
ERROR - 2019-11-16 21:47:29 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:47:29 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:48:26 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:48:26 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:51:11 --> Severity: Notice --> Undefined variable: branch_info /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:51:11 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:51:11 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 680
ERROR - 2019-11-16 21:51:14 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:51:14 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:51:42 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:51:42 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:54:12 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:54:12 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:55:36 --> Severity: Notice --> Undefined variable: branch_info /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:55:36 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:55:36 --> Severity: Notice --> Undefined variable: branch_info /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 679
ERROR - 2019-11-16 21:55:36 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 679
ERROR - 2019-11-16 21:55:36 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 21:55:53 --> Severity: Notice --> Undefined variable: branch_info /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:55:53 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:55:53 --> Severity: Notice --> Undefined variable: branch_info /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 679
ERROR - 2019-11-16 21:55:53 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 679
ERROR - 2019-11-16 21:55:53 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 21:56:03 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:56:03 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:56:14 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:56:14 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:56:19 --> Severity: Notice --> Undefined variable: branch_info /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:56:19 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:56:19 --> Severity: Notice --> Undefined variable: branch_info /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 679
ERROR - 2019-11-16 21:56:19 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 679
ERROR - 2019-11-16 21:56:19 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 21:56:41 --> Severity: Notice --> Undefined variable: branch_info /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:56:41 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 21:56:41 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 21:58:32 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 21:58:33 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:58:33 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:59:02 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:59:02 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 21:59:07 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 22:01:59 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:01:59 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:02:12 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:02:12 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:02:17 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:02:17 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:02:38 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 680
ERROR - 2019-11-16 22:02:39 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:02:39 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:02:53 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 22:02:53 --> Severity: Notice --> Undefined variable: step /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 22:02:54 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:02:54 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:03:19 --> Severity: error --> Exception: Too few arguments to function branches_model::get_branch_info(), 1 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php on line 615 and exactly 2 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 229
ERROR - 2019-11-16 22:03:58 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 1147
ERROR - 2019-11-16 22:04:09 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 675
ERROR - 2019-11-16 22:04:13 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:04:13 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:06:15 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:06:15 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:06:21 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 676
ERROR - 2019-11-16 22:08:53 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 22:08:54 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:08:54 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:09:44 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:09:44 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:09:50 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 22:09:51 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:09:51 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:10:17 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:10:17 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:10:22 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 677
ERROR - 2019-11-16 22:10:26 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:10:26 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:12:14 --> Severity: error --> Exception: syntax error, unexpected '==' (T_IS_EQUAL), expecting identifier (T_STRING) or variable (T_VARIABLE) or '{' or '$' /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 618
ERROR - 2019-11-16 22:12:27 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 748
ERROR - 2019-11-16 22:12:28 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 748
ERROR - 2019-11-16 22:13:47 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 748
ERROR - 2019-11-16 22:14:01 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 773
ERROR - 2019-11-16 22:14:11 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:14:11 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:15:51 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 22:15:52 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:15:52 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:16:01 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 22:16:04 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:16:04 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:17:03 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:17:03 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:17:13 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 677
ERROR - 2019-11-16 22:17:14 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:17:14 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:18:14 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 677
ERROR - 2019-11-16 22:18:15 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:18:15 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:18:54 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 677
ERROR - 2019-11-16 22:18:55 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:18:55 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:19:22 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 677
ERROR - 2019-11-16 22:19:38 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 677
ERROR - 2019-11-16 22:20:29 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 677
ERROR - 2019-11-16 22:20:41 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 677
ERROR - 2019-11-16 22:20:45 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 677
ERROR - 2019-11-16 22:20:46 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:20:46 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:22:13 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:22:13 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:22:37 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 676
ERROR - 2019-11-16 22:22:38 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:22:38 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:23:52 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:23:52 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:23:57 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 22:23:58 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:23:58 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:24:08 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 22:24:11 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:24:11 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:24:23 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:24:23 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:25:35 --> Severity: error --> Exception: syntax error, unexpected 'elseif' (T_ELSEIF) /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 640
ERROR - 2019-11-16 22:25:54 --> Severity: error --> Exception: syntax error, unexpected 'elseif' (T_ELSEIF) /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 640
ERROR - 2019-11-16 22:26:22 --> Severity: error --> Exception: syntax error, unexpected 'elseif' (T_ELSEIF) /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 640
ERROR - 2019-11-16 22:26:27 --> Severity: error --> Exception: syntax error, unexpected 'elseif' (T_ELSEIF) /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 640
ERROR - 2019-11-16 22:27:57 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:27:57 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:28:02 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 681
ERROR - 2019-11-16 22:28:06 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:28:06 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-11-16 22:33:49 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Amendment.php 1197
ERROR - 2019-11-16 22:33:49 --> Severity: Warning --> Creating default object from empty value /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Amendment.php 1206
ERROR - 2019-11-16 22:33:52 --> 404 Page Not Found: 
ERROR - 2019-11-16 22:34:10 --> Severity: Notice --> Undefined index: Producers /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_model.php 1010
ERROR - 2019-11-16 22:34:10 --> Query error: Column 'content' cannot be null - Invalid query: INSERT INTO `amendment_purposes` (`cooperatives_id`, `content`) VALUES (159, NULL)
ERROR - 2019-11-16 22:37:18 --> Severity: Notice --> Undefined index: Producers /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_model.php 1010
ERROR - 2019-11-16 22:37:18 --> Query error: Column 'content' cannot be null - Invalid query: INSERT INTO `amendment_purposes` (`cooperatives_id`, `content`) VALUES (159, NULL)
ERROR - 2019-11-16 22:37:36 --> Severity: Notice --> Undefined index: Producers /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_model.php 1010
ERROR - 2019-11-16 22:37:36 --> Query error: Column 'content' cannot be null - Invalid query: INSERT INTO `amendment_purposes` (`cooperatives_id`, `content`) VALUES (159, NULL)
ERROR - 2019-11-16 22:38:02 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_article_of_cooperation_model.php 48
ERROR - 2019-11-16 23:34:08 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_article_of_cooperation_model.php 48
ERROR - 2019-11-16 23:36:12 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_article_of_cooperation_model.php 48
ERROR - 2019-11-16 23:36:16 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_article_of_cooperation_model.php 48
ERROR - 2019-11-16 23:36:20 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_article_of_cooperation_model.php 48
ERROR - 2019-11-16 23:36:51 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_article_of_cooperation_model.php 48
ERROR - 2019-11-16 23:36:51 --> Severity: Notice --> Undefined variable: capitalization_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 404
ERROR - 2019-11-16 23:36:51 --> Severity: Notice --> Undefined variable: capitalization_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 407
ERROR - 2019-11-16 23:36:51 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 480
ERROR - 2019-11-16 23:36:51 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 483
ERROR - 2019-11-16 23:40:47 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Amendment_article_of_cooperation_model.php 48
ERROR - 2019-11-16 23:40:47 --> Severity: Notice --> Undefined variable: capitalization_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 404
ERROR - 2019-11-16 23:40:47 --> Severity: Notice --> Undefined variable: capitalization_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 407
ERROR - 2019-11-16 23:40:47 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 480
ERROR - 2019-11-16 23:40:47 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 483
ERROR - 2019-11-16 23:41:00 --> Severity: Notice --> Undefined variable: capitalization_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 404
ERROR - 2019-11-16 23:41:00 --> Severity: Notice --> Undefined variable: capitalization_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 407
ERROR - 2019-11-16 23:41:00 --> Severity: Notice --> Undefined variable: article_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 461
ERROR - 2019-11-16 23:41:00 --> Severity: Notice --> Undefined variable: article_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 464
ERROR - 2019-11-16 23:41:00 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 480
ERROR - 2019-11-16 23:41:00 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 483
ERROR - 2019-11-16 23:41:10 --> Severity: Notice --> Undefined variable: capitalization_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 404
ERROR - 2019-11-16 23:41:10 --> Severity: Notice --> Undefined variable: capitalization_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 407
ERROR - 2019-11-16 23:41:10 --> Severity: Notice --> Undefined variable: article_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 461
ERROR - 2019-11-16 23:41:10 --> Severity: Notice --> Undefined variable: article_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 464
ERROR - 2019-11-16 23:41:10 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 480
ERROR - 2019-11-16 23:41:10 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 483
ERROR - 2019-11-16 23:43:15 --> Severity: Notice --> Undefined variable: article_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 461
ERROR - 2019-11-16 23:43:15 --> Severity: Notice --> Undefined variable: article_complete /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 464
ERROR - 2019-11-16 23:43:15 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 480
ERROR - 2019-11-16 23:43:15 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 483
ERROR - 2019-11-16 23:43:49 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 480
ERROR - 2019-11-16 23:43:49 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 483
ERROR - 2019-11-16 23:44:12 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 480
ERROR - 2019-11-16 23:44:12 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 483
ERROR - 2019-11-16 23:44:25 --> Severity: error --> Exception: syntax error, unexpected 'amendment' (T_STRING), expecting ',' or ')' /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Amendment.php 507
ERROR - 2019-11-16 23:44:34 --> Severity: error --> Exception: syntax error, unexpected 'the' (T_STRING) /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Amendment.php 508
ERROR - 2019-11-16 23:44:36 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 480
ERROR - 2019-11-16 23:44:36 --> Severity: Notice --> Undefined variable: gad_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/amendment_details.php 483
