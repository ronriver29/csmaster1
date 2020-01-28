<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-26 21:11:56 --> 404 Page Not Found: Amendment/business_activity
ERROR - 2019-04-26 21:11:56 --> 404 Page Not Found: Amendment/coop_info
ERROR - 2019-04-26 21:13:07 --> 404 Page Not Found: Amendment/coop_info
ERROR - 2019-04-26 21:32:04 --> Severity: Parsing Error --> syntax error, unexpected 'public' (T_PUBLIC) C:\xampp\htdocs\coopris\application\models\Amendment_model.php 38
ERROR - 2019-04-26 21:33:38 --> Query error: Unknown column 'cooperative.type_of_cooperative' in 'field list' - Invalid query: SELECT `registeredcoop`.*, `refbrgy`.`brgyCode` as `bCode`, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunCode` as `cCode`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provCode` as `pCode`, `refprovince`.`provDesc` as `province`, `refregion`.`regCode` as `rCode`, `refregion`.`regDesc` as `region`, `cooperative`.`type_of_cooperative`
FROM `registeredcoop`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `registeredcoop`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
INNER JOIN `cooperatives` ON `cooperatives`.`id`=`registeredcoop`.`application_id`
WHERE `regNo` = '9520-1013000000000002'
