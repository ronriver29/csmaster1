<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-08-09 08:40:04 --> Severity: Notice --> Undefined property: stdClass::$postal_address /opt/lampp/htdocs/cmvtest/coopris/application/views/committees/edit_form_committee.php 82
ERROR - 2019-08-09 11:30:21 --> Query error: Unknown column 'bCode' in 'field list' - Invalid query: SELECT `cooperators`.*, `refbrgy`.`brgyCode` as `bCode`, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunCode` as `cCode`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provCode` as `pCode`, `refprovince`.`provDesc` as `province`, `refregion`.`regCode` as `rCode`, `refregion`.`regDesc` as `region`, CONCAT(bCode, brgy) AS full_address
FROM `cooperators`
LEFT JOIN `refbrgy` ON `refbrgy`.`brgycode`=`cooperators`.`addrCode`
LEFT JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
LEFT JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
LEFT JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `cooperators`.`id` = '144'
ERROR - 2019-08-09 13:31:58 --> Severity: Notice --> Trying to get property 'full_name' of non-object /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 4
ERROR - 2019-08-09 13:35:25 --> Severity: Notice --> Undefined index: full_name /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 4
ERROR - 2019-08-09 13:38:05 --> Severity: Notice --> Trying to get property 'total_shares' of non-object /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 4
ERROR - 2019-08-09 13:45:18 --> Severity: Notice --> Undefined variable: total_shares /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 12
ERROR - 2019-08-09 13:45:38 --> Severity: Notice --> Undefined variable: total_shares /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 12
ERROR - 2019-08-09 13:45:53 --> Severity: Notice --> Undefined variable: total_shares /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 12
ERROR - 2019-08-09 13:58:21 --> Severity: Notice --> Undefined variable: total_shares /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 13:58:39 --> Severity: Notice --> Undefined variable: total_shares /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 14:32:07 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris/application/models/Uploaded_document_model.php 13
ERROR - 2019-08-09 14:32:49 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris/application/models/Uploaded_document_model.php 13
ERROR - 2019-08-09 15:30:20 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:30:20 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:30:20 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:30:20 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:30:29 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:30:29 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:30:29 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:30:29 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:33:34 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:33:34 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:33:34 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:33:34 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:36:07 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:36:07 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:36:07 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:36:07 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:36:17 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:36:17 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:36:17 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:36:17 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:36:47 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:36:47 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:36:47 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:36:47 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:36:50 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:36:50 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:36:50 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:36:50 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:37:20 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:37:20 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:37:20 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:37:20 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:37:45 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:37:45 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:37:45 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:37:45 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:38:39 --> Severity: error --> Exception: syntax error, unexpected ':' /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 13
ERROR - 2019-08-09 15:39:01 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:39:35 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:39:44 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:39:54 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:39:54 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:39:54 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:39:54 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:40:13 --> Severity: Notice --> Undefined variable: total_subscribed /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:40:13 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 18
ERROR - 2019-08-09 15:40:13 --> Severity: Notice --> Undefined variable: total_paid /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:40:13 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 19
ERROR - 2019-08-09 15:42:56 --> Severity: Warning --> array_sum() expects parameter 1 to be array, integer given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 20
ERROR - 2019-08-09 15:42:56 --> Severity: Warning --> array_sum() expects parameter 1 to be array, integer given /opt/lampp/htdocs/cmvtest/coopris/application/views/cooperators/cooperators_list.php 21
