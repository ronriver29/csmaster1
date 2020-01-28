<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-27 13:44:12 --> Severity: error --> Exception: Call to undefined method Committee_model::add_committee_federation() /home/administrator/www/coopris/application/controllers/Committees.php 210
ERROR - 2019-12-27 13:47:05 --> Severity: error --> Exception: Call to undefined method Committee_model::add_committee_federation() /home/administrator/www/coopris/application/controllers/Committees.php 210
ERROR - 2019-12-27 13:58:43 --> Query error: Unknown table 'coopris.committees' - Invalid query: SELECT `committees`.`id` as `comid`, `committees`.*, `cooperators`.*
FROM `committees_federation`
INNER JOIN `cooperators` ON `cooperators`.`id` = `committees`.`cooperators_id`
INNER JOIN `cooperatives` ON `cooperatives`.`id` = `cooperators`.`cooperatives_id`
WHERE `committees_federation`.`user_id` = '5'
ERROR - 2019-12-27 14:08:51 --> Severity: Notice --> Undefined variable: count /home/administrator/www/coopris/application/views/cooperative/cooperative_detail.php 529
ERROR - 2019-12-27 14:27:05 --> Severity: Notice --> Trying to get property 'full_name' of non-object /home/administrator/www/coopris/application/views/documents/economic_survey.php 434
ERROR - 2019-12-27 14:27:05 --> Severity: Notice --> Trying to get property 'full_name' of non-object /home/administrator/www/coopris/application/views/documents/economic_survey.php 435
ERROR - 2019-12-27 14:27:43 --> 404 Page Not Found: Cooperatives/cbac11ed3f96a4dd44d019ca6857328541d0f4be94d12a41e369099ae8665588a7a349c255f470a02e5a0c8a53c0ec07661fa6ff1c12b95706b5a814d71bbf6eZay3D4FyQkhpVSyxrRaPwNxB1NRE9TVAvleB98arRug-
ERROR - 2019-12-27 14:27:46 --> 404 Page Not Found: Cooperatives/cbac11ed3f96a4dd44d019ca6857328541d0f4be94d12a41e369099ae8665588a7a349c255f470a02e5a0c8a53c0ec07661fa6ff1c12b95706b5a814d71bbf6eZay3D4FyQkhpVSyxrRaPwNxB1NRE9TVAvleB98arRug-
ERROR - 2019-12-27 14:30:49 --> Severity: Notice --> Undefined variable: data /home/administrator/www/coopris/application/models/Uploaded_document_model.php 73
ERROR - 2019-12-27 14:30:49 --> Severity: Notice --> Trying to get property 'filename' of non-object /home/administrator/www/coopris/application/views/documents/list_of_documents.php 183
ERROR - 2019-12-27 14:30:54 --> Severity: Notice --> Trying to get property 'filename' of non-object /home/administrator/www/coopris/application/views/documents/list_of_documents.php 183
ERROR - 2019-12-27 14:31:53 --> Severity: Notice --> Trying to get property 'filename' of non-object /home/administrator/www/coopris/application/views/documents/list_of_documents.php 183
ERROR - 2019-12-27 14:32:00 --> Severity: Notice --> Undefined variable: data /home/administrator/www/coopris/application/models/Uploaded_document_model.php 73
ERROR - 2019-12-27 14:32:00 --> Severity: Notice --> Trying to get property 'filename' of non-object /home/administrator/www/coopris/application/views/documents/list_of_documents.php 183
ERROR - 2019-12-27 14:32:00 --> Severity: Notice --> Trying to get property 'filename' of non-object /home/administrator/www/coopris/application/views/documents/list_of_documents.php 243
ERROR - 2019-12-27 14:34:04 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) /home/administrator/www/coopris/application/controllers/Cooperatives.php 657
ERROR - 2019-12-27 14:41:07 --> Severity: Notice --> Undefined variable: list_specialist /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 14:41:07 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 14:46:41 --> Severity: Notice --> Undefined variable: affiliator_complete /home/administrator/www/coopris/application/views/cooperative/cooperative_detail.php 214
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: directors_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 58
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: directors_count_odd /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 59
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: chairperson_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 60
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: vice_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 61
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: treasurer_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 62
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: secretary_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 63
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: associate_not_exists /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 64
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 65
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: minimum_regular_pay /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 66
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 67
ERROR - 2019-12-27 14:48:43 --> Severity: Notice --> Undefined variable: minimum_associate_pay /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 68
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: directors_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 58
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: directors_count_odd /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 59
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: chairperson_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 60
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: vice_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 61
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: treasurer_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 62
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: secretary_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 63
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: associate_not_exists /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 64
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 65
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: minimum_regular_pay /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 66
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 67
ERROR - 2019-12-27 14:49:32 --> Severity: Notice --> Undefined variable: minimum_associate_pay /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 68
ERROR - 2019-12-27 14:58:57 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_driver::form() /home/administrator/www/coopris/application/models/Affiliators_model.php 132
ERROR - 2019-12-27 14:59:21 --> Query error: Unknown column 'affiliators.users_id' in 'on clause' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `affiliators`
INNER JOIN `cooperatives` ON `affiliators`.`users_id` = `cooperatives`.`users_id`
WHERE `affiliators`.`user_id` = '223'
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: directors_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 58
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: directors_count_odd /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 59
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: chairperson_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 60
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: vice_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 61
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: treasurer_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 62
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: secretary_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 63
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: associate_not_exists /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 64
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 65
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: minimum_regular_pay /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 66
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 67
ERROR - 2019-12-27 15:00:16 --> Severity: Notice --> Undefined variable: minimum_associate_pay /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 68
ERROR - 2019-12-27 15:02:03 --> Severity: Notice --> Undefined variable: client_info /home/administrator/www/coopris/application/views/template/header.php 38
ERROR - 2019-12-27 15:02:03 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/administrator/www/coopris/application/views/template/header.php 38
ERROR - 2019-12-27 15:02:03 --> Severity: Notice --> Undefined variable: client_info /home/administrator/www/coopris/application/views/template/header.php 38
ERROR - 2019-12-27 15:02:03 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/administrator/www/coopris/application/views/template/header.php 38
ERROR - 2019-12-27 15:02:03 --> Severity: Notice --> Undefined variable: business_activities /home/administrator/www/coopris/application/views/federation/affiliators_list.php 41
ERROR - 2019-12-27 15:02:03 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 41
ERROR - 2019-12-27 15:02:03 --> Severity: Notice --> Undefined variable: registered_coop /home/administrator/www/coopris/application/views/federation/affiliators_list.php 61
ERROR - 2019-12-27 15:02:03 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 61
ERROR - 2019-12-27 15:02:03 --> Severity: Notice --> Undefined variable: applied_coop /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:02:03 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/administrator/www/coopris/application/views/template/header.php 38
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/administrator/www/coopris/application/views/template/header.php 38
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:02:28 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 39
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 39
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'region_code' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'region_code' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'regDesc' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 46
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'full_name' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 46
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 47
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 47
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 56
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 56
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:03:06 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:04:21 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Affiliators.php 93
ERROR - 2019-12-27 15:04:21 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Affiliators.php 94
ERROR - 2019-12-27 15:04:21 --> Severity: Notice --> Trying to get property 'area_of_operation' of non-object /home/administrator/www/coopris/application/controllers/Affiliators.php 130
ERROR - 2019-12-27 15:04:21 --> Severity: Notice --> Trying to get property 'refbrgy_brgyCode' of non-object /home/administrator/www/coopris/application/controllers/Affiliators.php 130
ERROR - 2019-12-27 15:04:21 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/administrator/www/coopris/application/views/template/header.php 38
ERROR - 2019-12-27 15:04:21 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/administrator/www/coopris/application/views/template/header.php 38
ERROR - 2019-12-27 15:04:21 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 61
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: directors_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 58
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: directors_count_odd /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 59
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: chairperson_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 60
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: vice_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 61
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: treasurer_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 62
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: secretary_count /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 63
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: associate_not_exists /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 64
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 65
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: minimum_regular_pay /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 66
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 67
ERROR - 2019-12-27 15:04:33 --> Severity: Notice --> Undefined variable: minimum_associate_pay /home/administrator/www/coopris/application/views/cooperators/cooperators_list.php 68
ERROR - 2019-12-27 15:05:01 --> Severity: Notice --> Undefined variable: business_activities /home/administrator/www/coopris/application/views/federation/affiliators_list.php 41
ERROR - 2019-12-27 15:05:01 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 41
ERROR - 2019-12-27 15:05:01 --> Severity: Notice --> Undefined variable: registered_coop /home/administrator/www/coopris/application/views/federation/affiliators_list.php 61
ERROR - 2019-12-27 15:05:01 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 61
ERROR - 2019-12-27 15:05:01 --> Severity: Notice --> Undefined variable: applied_coop /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:05:01 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 38
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 39
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 39
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'region_code' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'region_code' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'regDesc' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 40
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 46
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'full_name' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 46
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 47
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 47
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: admin_info /home/administrator/www/coopris/application/views/templates/admin_header.php 56
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Trying to get property 'access_level' of non-object /home/administrator/www/coopris/application/views/templates/admin_header.php 56
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:18 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:05:27 --> Severity: Notice --> Undefined variable: business_activities /home/administrator/www/coopris/application/views/federation/affiliators_list.php 41
ERROR - 2019-12-27 15:05:27 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 41
ERROR - 2019-12-27 15:05:27 --> Severity: Notice --> Undefined variable: registered_coop /home/administrator/www/coopris/application/views/federation/affiliators_list.php 61
ERROR - 2019-12-27 15:05:27 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 61
ERROR - 2019-12-27 15:05:27 --> Severity: Notice --> Undefined variable: applied_coop /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:05:27 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:05:48 --> Severity: Notice --> Undefined variable: registered_coop /home/administrator/www/coopris/application/views/federation/affiliators_list.php 61
ERROR - 2019-12-27 15:05:48 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 61
ERROR - 2019-12-27 15:05:48 --> Severity: Notice --> Undefined variable: applied_coop /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:05:48 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:05 --> Severity: Notice --> Undefined variable: applied_coop /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:06:05 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/federation/affiliators_list.php 104
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:06:21 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:07:12 --> Severity: Notice --> Undefined variable: cooperator /home/administrator/www/coopris/application/views/federation/affiliators_list.php 70
ERROR - 2019-12-27 15:13:20 --> 404 Page Not Found: Articles/union
ERROR - 2019-12-27 15:14:12 --> 404 Page Not Found: Articles/union
ERROR - 2019-12-27 15:19:27 --> Query error: Unknown column 'affiliators.users_id' in 'on clause' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `affiliators`
INNER JOIN `cooperatives` ON `affiliators`.`users_id` = `cooperatives`.`users_id`
WHERE `affiliators`.`user_id` = '5'
ERROR - 2019-12-27 15:21:04 --> Severity: Notice --> Undefined variable: list_specialist /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 15:21:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 15:22:51 --> Severity: Notice --> Undefined property: stdClass::$user_id /home/administrator/www/coopris/application/controllers/Articles.php 174
ERROR - 2019-12-27 15:23:20 --> Severity: Notice --> Undefined property: stdClass::$user_id /home/administrator/www/coopris/application/controllers/Articles.php 174
ERROR - 2019-12-27 15:30:25 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:30:26 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:30:26 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:30:26 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:30:26 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:30:26 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:30:27 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:30:27 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:30:27 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:30:28 --> Severity: Notice --> Trying to get property 'category_of_cooperative' of non-object /home/administrator/www/coopris/application/controllers/Articles.php 184
ERROR - 2019-12-27 15:32:25 --> Severity: Notice --> Undefined variable: committees_federation /home/administrator/www/coopris/application/views/committees/committees_list.php 77
ERROR - 2019-12-27 15:32:25 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/committees/committees_list.php 82
ERROR - 2019-12-27 15:34:19 --> Severity: error --> Exception: syntax error, unexpected end of file /home/administrator/www/coopris/application/controllers/Committees.php 486
ERROR - 2019-12-27 15:35:26 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/committees/committees_list.php 82
ERROR - 2019-12-27 15:37:07 --> Severity: Notice --> Undefined variable: gad_count /home/administrator/www/coopris/application/views/cooperative/cooperative_detail.php 284
ERROR - 2019-12-27 15:37:07 --> Severity: Notice --> Undefined variable: gad_count /home/administrator/www/coopris/application/views/cooperative/cooperative_detail.php 287
ERROR - 2019-12-27 16:06:11 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) /home/administrator/www/coopris/application/controllers/Documents.php 1594
ERROR - 2019-12-27 16:07:16 --> Severity: Notice --> Undefined index: cooperator_complete /home/administrator/www/coopris/application/controllers/Documents.php 1525
ERROR - 2019-12-27 16:07:49 --> Severity: Notice --> Undefined index: cooperator_complete /home/administrator/www/coopris/application/controllers/Documents.php 1525
ERROR - 2019-12-27 16:10:14 --> Severity: Notice --> Trying to get property 'full_name' of non-object /home/administrator/www/coopris/application/views/documents/economic_survey.php 434
ERROR - 2019-12-27 16:10:14 --> Severity: Notice --> Trying to get property 'full_name' of non-object /home/administrator/www/coopris/application/views/documents/economic_survey.php 435
ERROR - 2019-12-27 16:12:04 --> Severity: Notice --> Undefined variable: list_specialist /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 16:12:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 16:12:24 --> Severity: Notice --> Undefined offset: 18 /home/administrator/www/coopris/application/views/cooperative/evaluation/coop_tool.php 414
ERROR - 2019-12-27 16:12:24 --> Severity: Notice --> Undefined offset: 19 /home/administrator/www/coopris/application/views/cooperative/evaluation/coop_tool.php 432
ERROR - 2019-12-27 16:12:24 --> Severity: Notice --> Undefined offset: 20 /home/administrator/www/coopris/application/views/cooperative/evaluation/coop_tool.php 450
ERROR - 2019-12-27 16:12:24 --> Severity: Notice --> Undefined offset: 25 /home/administrator/www/coopris/application/views/cooperative/evaluation/coop_tool.php 539
ERROR - 2019-12-27 16:12:24 --> Severity: Notice --> Undefined offset: 26 /home/administrator/www/coopris/application/views/cooperative/evaluation/coop_tool.php 557
ERROR - 2019-12-27 16:14:16 --> Severity: Notice --> Undefined variable: list_specialist /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 16:14:16 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 16:14:25 --> Severity: Notice --> Undefined variable: list_specialist /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 16:14:25 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-27 16:15:04 --> 404 Page Not Found: A/logindmins
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 57
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 61
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 64
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 67
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 79
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 38
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 77
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 111
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 121
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 145
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 182
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 216
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 226
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 253
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 289
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 323
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 333
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 349
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:20:24 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 57
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 61
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 64
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 67
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 79
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 38
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 77
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 111
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 121
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 145
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 182
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 216
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 226
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 253
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 289
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 323
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 333
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 349
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:05 --> Severity: Notice --> Undefined variable: html2 /home/administrator/www/coopris/application/controllers/Registration.php 95
ERROR - 2019-12-27 16:22:10 --> Severity: Notice --> Trying to get property 'full_name' of non-object /home/administrator/www/coopris/application/views/documents/economic_survey.php 434
ERROR - 2019-12-27 16:22:10 --> Severity: Notice --> Trying to get property 'full_name' of non-object /home/administrator/www/coopris/application/views/documents/economic_survey.php 435
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 57
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 61
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 64
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 67
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 79
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 38
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 77
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 111
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 121
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 145
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 182
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 216
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 226
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 253
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 289
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 323
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 333
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 349
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:22:30 --> Severity: Notice --> Undefined variable: html2 /home/administrator/www/coopris/application/controllers/Registration.php 95
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 57
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 61
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 64
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 67
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 79
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 38
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 77
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 111
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 121
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 145
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 182
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 216
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 226
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 253
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 289
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 323
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 333
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 349
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:23:05 --> Severity: Notice --> Undefined variable: html2 /home/administrator/www/coopris/application/controllers/Registration.php 95
ERROR - 2019-12-27 16:23:21 --> 404 Page Not Found: Registration/index
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 57
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 61
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 64
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 67
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 79
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 38
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 77
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 111
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 121
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 145
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 182
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 216
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 226
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 253
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 289
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 323
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 333
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 349
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:23:54 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 57
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 61
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 64
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 67
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 79
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 38
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 77
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 111
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 121
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 145
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 182
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 216
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 226
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 253
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 289
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 323
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 333
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 349
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:24:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 57
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 61
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 64
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 67
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 79
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 38
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 77
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 111
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 121
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 145
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 182
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 216
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 226
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 253
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 289
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 323
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 333
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 349
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:27 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 57
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 61
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 64
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 67
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 79
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 38
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 77
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 111
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 121
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 145
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 182
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 216
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 226
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 253
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 289
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 323
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 333
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 349
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:47 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:52 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 57
ERROR - 2019-12-27 16:28:52 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 61
ERROR - 2019-12-27 16:28:52 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 64
ERROR - 2019-12-27 16:28:52 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 67
ERROR - 2019-12-27 16:28:52 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/controllers/Registration.php 79
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 31
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 38
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 77
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 86
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 98
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 111
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 121
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 138
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 145
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 182
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 191
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 203
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 216
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 226
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 246
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 253
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 289
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 298
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 310
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 323
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 333
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 346
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 349
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'Street' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'brgy' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'city' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'province' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 350
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'regNo' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
ERROR - 2019-12-27 16:28:53 --> Severity: Notice --> Trying to get property 'coopName' of non-object /home/administrator/www/coopris/application/views/cooperative/cor_view.php 355
