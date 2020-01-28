<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-24 17:07:41 --> Severity: Parsing Error --> syntax error, unexpected '?>', expecting function (T_FUNCTION) C:\xampp\htdocs\coopris\application\controllers\Amendments.php 59
ERROR - 2019-04-24 17:08:46 --> Severity: Parsing Error --> syntax error, unexpected end of file, expecting function (T_FUNCTION) C:\xampp\htdocs\coopris\application\controllers\Amendments.php 60
ERROR - 2019-04-24 17:08:48 --> Severity: Parsing Error --> syntax error, unexpected end of file, expecting function (T_FUNCTION) C:\xampp\htdocs\coopris\application\controllers\Amendments.php 60
ERROR - 2019-04-24 17:10:29 --> Severity: Notice --> Undefined property: Amendments::$amendments_model C:\xampp\htdocs\coopris\application\controllers\Amendments.php 22
ERROR - 2019-04-24 17:10:29 --> Severity: Error --> Call to a member function get_all_amendments() on null C:\xampp\htdocs\coopris\application\controllers\Amendments.php 22
ERROR - 2019-04-24 17:11:08 --> Severity: error --> Exception: Unable to locate the model you have specified: Amendments-model C:\xampp\htdocs\coopris\system\core\Loader.php 348
ERROR - 2019-04-24 17:11:27 --> Severity: Notice --> Undefined property: Amendments::$amendments_model C:\xampp\htdocs\coopris\application\controllers\Amendments.php 22
ERROR - 2019-04-24 17:11:27 --> Severity: Error --> Call to a member function get_all_amendments() on null C:\xampp\htdocs\coopris\application\controllers\Amendments.php 22
ERROR - 2019-04-24 17:11:42 --> Query error: Table 'cis.amendments' doesn't exist - Invalid query: SELECT `amendments`.*, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provDesc` as `province`, `refregion`.`regDesc` as `region`
FROM `amendments`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `amendments`.`refbrgy_brgyCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `amendments`.`users_id` = '8'
ERROR - 2019-04-24 21:55:09 --> 404 Page Not Found: Amendments/index
ERROR - 2019-04-24 21:55:13 --> Severity: Compile Error --> Cannot redeclare class Cooperatives_model C:\xampp\htdocs\coopris\application\models\Amendments_model.php 960
ERROR - 2019-04-24 22:14:52 --> 404 Page Not Found: Ammendments/reservation
