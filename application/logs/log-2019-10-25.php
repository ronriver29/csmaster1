<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-25 09:00:06 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:00:06 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:02:53 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:02:53 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:05:57 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:05:57 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:06:16 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:06:16 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:07:21 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:07:21 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:07:40 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:07:40 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:08:11 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:08:11 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:19:32 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:19:32 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:20:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''158'
ORDER BY `full_name` ASC' at line 7 - Invalid query: SELECT `cooperators`.*, `refbrgy`.`brgyCode` as `bCode`, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunCode` as `cCode`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provCode` as `pCode`, `refprovince`.`provDesc` as `province`, `refregion`.`regCode` as `rCode`, `refregion`.`regDesc` as `region`
FROM `cooperators`
LEFT JOIN `refbrgy` ON `refbrgy`.`brgycode`=`cooperators`.`addrCode`
LEFT JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
LEFT JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
LEFT JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
WHERE `position` = "Chairperson" AND `position` = "Vice-Chairperson" AND `position` = "Board of Director" AND cooperatives_id '158'
ORDER BY `full_name` ASC
ERROR - 2019-10-25 09:22:21 --> Severity: Notice --> Undefined variable: cooperators_list_bods /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/economic_survey.php 545
ERROR - 2019-10-25 09:22:21 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/economic_survey.php 545
ERROR - 2019-10-25 09:22:21 --> Severity: Notice --> Undefined variable: cooperators_list_bods /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/economic_survey.php 545
ERROR - 2019-10-25 09:22:21 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/economic_survey.php 545
ERROR - 2019-10-25 09:27:37 --> Severity: Notice --> Undefined variable: cooperators_list_bods /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/economic_survey.php 545
ERROR - 2019-10-25 09:27:37 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/economic_survey.php 545
ERROR - 2019-10-25 09:29:52 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:29:52 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:30:04 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:30:04 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:31:51 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:31:51 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:31:54 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 35
ERROR - 2019-10-25 09:31:54 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 38
ERROR - 2019-10-25 09:31:54 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:31:54 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:03 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 35
ERROR - 2019-10-25 09:32:03 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 38
ERROR - 2019-10-25 09:32:03 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:03 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:06 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 35
ERROR - 2019-10-25 09:32:06 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 38
ERROR - 2019-10-25 09:32:06 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:06 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:11 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 35
ERROR - 2019-10-25 09:32:11 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 38
ERROR - 2019-10-25 09:32:11 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:11 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:19 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:19 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:56 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:32:56 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:33:15 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:33:15 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 09:34:29 --> 404 Page Not Found: Admisn/login
ERROR - 2019-10-25 09:55:52 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 09:55:52 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:55:59 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 09:55:59 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:56:05 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 09:56:05 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:56:12 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 09:56:12 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:56:12 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:56:17 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 09:56:18 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:56:18 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:56:24 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 09:56:25 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:56:25 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:56:30 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 09:56:30 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 09:56:30 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'qr_code' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 42
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 56
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 60
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 63
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 66
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 78
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 37
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 38
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 71
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 105
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 134
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 135
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 168
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 202
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 236
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 237
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 270
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 304
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 330
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 09:56:49 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:00:50 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 10:00:50 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 10:00:59 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 10:00:59 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 10:01:13 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 10:01:13 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 10:01:22 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 10:01:22 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'qr_code' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 42
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 56
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 60
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 63
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 66
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 78
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 37
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 38
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 71
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 105
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 134
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 135
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 168
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 202
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 236
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 237
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 270
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 304
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 330
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:05:46 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:06:34 --> Severity: Notice --> Undefined variable: add_membership /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/bylaw_info/bylaw_primary_form.php 228
ERROR - 2019-10-25 10:06:34 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/bylaw_info/bylaw_primary_form.php 228
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'qr_code' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 42
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 56
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 60
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 63
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 66
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 78
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 37
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 38
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 71
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 105
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 134
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 135
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 168
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 202
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 236
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 237
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 270
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 304
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 330
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:14:20 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'qr_code' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 42
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 56
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 60
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 63
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 66
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 78
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 37
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 38
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 71
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 105
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 134
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 135
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 168
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 202
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 236
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 237
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 270
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 304
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 330
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:16:01 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:19:43 --> Query error: Unknown column 'BESU1' in 'field list' - Invalid query: insert into registeredcoop(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant,application_id) select RTRIM(CONCAT(proposed_name, ' ', type_of_cooperative, ' ',((BESU1)), ' Cooperative ', grouping)), '9520-100200029478', category_of_cooperative, type_of_cooperative, '10-25-2019', common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode, 'Compliant',id from cooperatives where id=158
ERROR - 2019-10-25 10:20:05 --> Query error: Unknown column 'BESU1' in 'field list' - Invalid query: insert into registeredcoop(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant,application_id) select RTRIM(CONCAT(proposed_name, ' ', type_of_cooperative, ' ',(BESU1), ' Cooperative ', grouping)), '9520-100200029478', category_of_cooperative, type_of_cooperative, '10-25-2019', common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode, 'Compliant',id from cooperatives where id=158
ERROR - 2019-10-25 10:20:18 --> Query error: Unknown column 'BESU1' in 'field list' - Invalid query: insert into registeredcoop(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant,application_id) select RTRIM(CONCAT(proposed_name, ' ', type_of_cooperative, ' ',(BESU1), ' Cooperative ', grouping)), '9520-100200029478', category_of_cooperative, type_of_cooperative, '10-25-2019', common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode, 'Compliant',id from cooperatives where id=158
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'qr_code' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 42
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 56
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 60
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 63
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 66
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 78
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 37
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 38
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 71
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 105
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 134
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 135
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 168
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 202
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 236
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 237
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 270
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 304
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 330
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:23:45 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'qr_code' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 42
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 56
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 60
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 63
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 66
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 78
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 37
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 38
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 71
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 105
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 134
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 135
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 168
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 202
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 236
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 237
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 270
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 304
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 330
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:24:14 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:27:27 --> Query error: Column count doesn't match value count at row 1 - Invalid query: insert into registeredcoop(coopName, acronym, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant,application_id) select RTRIM(CONCAT(proposed_name, ' ', type_of_cooperative, ' Cooperative ', grouping)), '9520-100200029478', category_of_cooperative, type_of_cooperative, '10-25-2019', common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode, 'Compliant',id from cooperatives where id=158
ERROR - 2019-10-25 10:34:18 --> Severity: Notice --> Undefined variable: title /opt/lampp/htdocs/cmvtest/coopris_3/application/views/template/header.php 4
ERROR - 2019-10-25 10:34:28 --> Severity: Notice --> Undefined variable: title /opt/lampp/htdocs/cmvtest/coopris_3/application/views/template/header.php 4
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'qr_code' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 42
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 56
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 60
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 63
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 66
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Registration.php 78
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 31
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 37
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 38
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 71
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 80
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 92
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 105
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 128
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 134
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 135
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 168
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 177
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 189
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 202
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 230
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 236
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 237
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 270
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 279
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 291
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 304
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 327
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 330
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'noStreet' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'Street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 331
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'regNo' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'dateRegistered' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:35:28 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/cor_view.php 336
ERROR - 2019-10-25 10:40:49 --> 404 Page Not Found: Branches/get_branch_info
ERROR - 2019-10-25 10:44:05 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 10:44:05 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 10:44:35 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 10:44:35 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 10:44:44 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 10:44:44 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 10:45:03 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 10:45:03 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 10:47:14 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 13
ERROR - 2019-10-25 10:54:23 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 10:54:23 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 10:54:39 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 10:54:39 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 10:54:45 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 10:54:45 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 10:55:39 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 10:55:39 --> Severity: Notice --> Undefined variable: coo_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 220
ERROR - 2019-10-25 10:55:39 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 220
ERROR - 2019-10-25 10:55:39 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 10:55:48 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 10:55:48 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:03:07 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 13
ERROR - 2019-10-25 11:03:24 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 13
ERROR - 2019-10-25 11:03:34 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 722
ERROR - 2019-10-25 11:04:39 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:04:39 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:04:41 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:04:41 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:05:11 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:05:11 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:05:16 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:05:16 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:10:36 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:10:36 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:10:45 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:10:45 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:10:52 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info_(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2656 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 27
ERROR - 2019-10-25 11:11:40 --> Severity: error --> Exception: syntax error, unexpected ''p' (T_ENCAPSED_AND_WHITESPACE), expecting ']' /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php 497
ERROR - 2019-10-25 11:13:28 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:13:28 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:14:02 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:14:02 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:14:18 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info_(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2657 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 27
ERROR - 2019-10-25 11:14:26 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:14:26 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:14:28 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:14:28 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:14:37 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info_(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2656 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 27
ERROR - 2019-10-25 11:16:17 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:16:17 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:16:23 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:16:23 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:16:24 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info_(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2657 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 27
ERROR - 2019-10-25 11:16:30 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info_(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2657 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 27
ERROR - 2019-10-25 11:17:03 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info_(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2657 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 27
ERROR - 2019-10-25 11:17:04 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:17:04 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:17:35 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info_(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2656 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 27
ERROR - 2019-10-25 11:18:06 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info_(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2657 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 27
ERROR - 2019-10-25 11:19:31 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:19:31 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:19:31 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:20:36 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:20:36 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:20:42 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:20:42 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:20:42 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:21:17 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:21:17 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:21:30 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:21:30 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:21:30 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:21:54 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:21:54 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:22:11 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:22:11 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:22:16 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:22:17 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:22:17 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:22:43 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:22:43 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:23:22 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:23:22 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:23:49 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:23:49 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:24:05 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:24:05 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:24:05 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:25:26 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:25:26 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:25:27 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:25:27 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:25:32 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:25:32 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:25:32 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:25:44 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:25:44 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:25:49 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:25:49 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:26:41 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 733
ERROR - 2019-10-25 11:26:41 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 586
ERROR - 2019-10-25 11:26:45 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:26:45 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:26:57 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:26:57 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:28:36 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 699
ERROR - 2019-10-25 11:28:36 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 596
ERROR - 2019-10-25 11:28:37 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:28:37 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:28:42 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:28:42 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:28:42 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:29:34 --> Severity: error --> Exception: /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php exists, but doesn't declare class Uploaded_document_model /opt/lampp/htdocs/cmvtest/coopris_3/system/core/Loader.php 340
ERROR - 2019-10-25 11:29:36 --> Severity: error --> Exception: /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php exists, but doesn't declare class Uploaded_document_model /opt/lampp/htdocs/cmvtest/coopris_3/system/core/Loader.php 340
ERROR - 2019-10-25 11:29:37 --> Severity: error --> Exception: /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php exists, but doesn't declare class Uploaded_document_model /opt/lampp/htdocs/cmvtest/coopris_3/system/core/Loader.php 340
ERROR - 2019-10-25 11:29:38 --> Severity: error --> Exception: /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php exists, but doesn't declare class Uploaded_document_model /opt/lampp/htdocs/cmvtest/coopris_3/system/core/Loader.php 340
ERROR - 2019-10-25 11:29:39 --> Severity: error --> Exception: /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php exists, but doesn't declare class Uploaded_document_model /opt/lampp/htdocs/cmvtest/coopris_3/system/core/Loader.php 340
ERROR - 2019-10-25 11:29:54 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:29:54 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:29:56 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:29:56 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:29:58 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:29:58 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:29:58 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:29:59 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:29:59 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 11:31:15 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 661
ERROR - 2019-10-25 11:31:20 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:31:20 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 11:31:28 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:31:28 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:31:34 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:31:35 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:31:35 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:32:16 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:32:16 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:34:16 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 28
ERROR - 2019-10-25 11:34:16 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:34:16 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:43:00 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 170
ERROR - 2019-10-25 11:43:00 --> Severity: Notice --> Trying to get property 'filename' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents.php 235
ERROR - 2019-10-25 11:45:22 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2510 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 11:45:56 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2510 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 11:46:49 --> 404 Page Not Found: Branches/get_branch_info
ERROR - 2019-10-25 11:48:13 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2458 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 11:48:42 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2510 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 11:48:51 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2562 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 11:49:21 --> Severity: Notice --> Undefined variable: data /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_uploaded_pdf.php 92
ERROR - 2019-10-25 11:54:00 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 11:54:00 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 12:01:56 --> Severity: Notice --> Undefined property: stdClass::$fullname /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Cooperatives_model.php 670
ERROR - 2019-10-25 12:01:56 --> Severity: Notice --> Undefined property: stdClass::$groping /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Cooperatives_model.php 670
ERROR - 2019-10-25 12:02:00 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 12:02:00 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 13:03:11 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2510 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 13:05:52 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:05:52 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 435
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 436
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 437
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 438
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 439
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 33
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 42
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 52
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 97
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 102
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 102
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'branchName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 102
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'house_blk_no' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 107
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 107
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'house_blk_no' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'region' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'area_of_operation' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 121
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 127
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 128
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 129
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 130
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 131
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 132
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 134
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 134
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 135
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 140
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 199
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 202
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 207
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 223
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 233
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 236
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 242
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 249
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 249
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 260
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 260
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 260
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 263
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 269
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 276
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 276
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 287
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 287
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 290
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 296
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 303
ERROR - 2019-10-25 13:08:28 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 303
ERROR - 2019-10-25 13:08:35 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2458 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 435
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 436
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 437
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 438
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'application_id' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 439
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 33
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 42
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 52
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'coopName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 97
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 102
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 102
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'branchName' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 102
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'house_blk_no' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 107
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 107
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'house_blk_no' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'street' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'brgy' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'city' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'province' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'region' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 108
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'area_of_operation' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 121
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 127
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 128
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 129
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 130
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 131
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 132
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 134
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 134
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 135
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 140
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 199
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 202
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 207
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 223
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 233
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 236
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 242
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 249
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 249
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 260
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 260
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 260
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 263
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 269
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 276
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 276
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 287
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 287
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 290
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'type' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 296
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 303
ERROR - 2019-10-25 13:08:38 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/branch_detail.php 303
ERROR - 2019-10-25 13:09:17 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2458 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 13:10:23 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 13:10:23 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 13:10:27 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 13:10:27 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 13:10:35 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 13:10:35 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 13:10:38 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 13:10:38 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 13:15:35 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2461 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 13:17:40 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2461 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 13:24:34 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/upload_form/upload_document_7.php 23
ERROR - 2019-10-25 13:24:34 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/upload_form/upload_document_7.php 23
ERROR - 2019-10-25 13:25:29 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/upload_form/upload_document_7.php 23
ERROR - 2019-10-25 13:25:29 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/upload_form/upload_document_7.php 23
ERROR - 2019-10-25 13:33:51 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:33:51 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:33:52 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:33:56 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:33:56 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:34:06 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:34:06 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:34:07 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:34:21 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:34:21 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:34:28 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:39:30 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:39:30 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:39:31 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:39:36 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:39:52 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:39:54 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:39:54 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:39:55 --> 404 Page Not Found: 
ERROR - 2019-10-25 13:40:09 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:40:09 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:40:12 --> 404 Page Not Found: 
ERROR - 2019-10-25 13:40:17 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:40:17 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:40:19 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:40:22 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 13:40:51 --> Severity: Notice --> Undefined variable: cooperative /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 146
ERROR - 2019-10-25 13:41:02 --> Severity: Notice --> Undefined variable: cooperative /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/list_of_branches.php 146
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:42:53 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:42:55 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:42:56 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:42:57 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 13:42:57 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:43:02 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:43:15 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 13:43:19 --> Severity: Notice --> Undefined property: stdClass::$proposed_name /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Forpaymentbranches.php 25
ERROR - 2019-10-25 13:43:32 --> 404 Page Not Found: 
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 13:43:44 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 13:43:51 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 13:50:29 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 722
ERROR - 2019-10-25 13:51:58 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 13:51:58 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 13:51:58 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 13:51:58 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 13:53:36 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 13:53:36 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 13:53:39 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 13:53:39 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 13:54:00 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 13:54:00 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 13:54:36 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 13:54:36 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 13:54:38 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 13:54:38 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 13:54:41 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 13:54:41 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:03:05 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:03:05 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:06:29 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 14:06:29 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:06:31 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:08:34 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 722
ERROR - 2019-10-25 14:09:08 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 722
ERROR - 2019-10-25 14:09:11 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:09:46 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:09:48 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:10:06 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:10:36 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:10:36 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:12:51 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:13:06 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:13:10 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:13:22 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:13:23 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:13:38 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:13:40 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:14:02 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:14:05 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:14:27 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:14:34 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:14:52 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:14:56 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:15:17 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:15:23 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:15:37 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:15:38 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:15:52 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:15:56 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:10 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:16:19 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:30 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:16:34 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:47 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:16:50 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:50 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:16:52 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 14:16:52 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:16:53 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:16:57 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:17:13 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:17:16 --> 404 Page Not Found: Laboratories_cooperators/get_cooperative_info
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:17:30 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:17:40 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:17:43 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 14:17:43 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 14:17:59 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 14:17:59 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 14:21:33 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:21:33 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:21:33 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:21:33 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:21:33 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:21:33 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:23:50 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:23:50 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:23:50 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:23:50 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:23:50 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:23:50 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:23:57 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:23:57 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:23:57 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:23:57 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:23:57 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:23:57 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:25:38 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:25:43 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 14:25:43 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 14:26:06 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:26:06 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:26:06 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:26:06 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:26:06 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:26:06 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 14:26:58 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 14:26:59 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 14:26:59 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 14:27:36 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:27:36 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:27:44 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:27:44 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:27:46 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:27:46 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:30:52 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:30:52 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:30:52 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:30:52 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:30:52 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:30:52 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:31:22 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:31:22 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:31:26 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 733
ERROR - 2019-10-25 14:31:26 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 586
ERROR - 2019-10-25 14:31:30 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:31:30 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:32:00 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:32:00 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:32:00 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:32:00 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:32:00 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:32:00 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:32:00 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:32:00 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:32:03 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 699
ERROR - 2019-10-25 14:32:03 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 596
ERROR - 2019-10-25 14:32:16 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:32:16 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:32:19 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 35
ERROR - 2019-10-25 14:32:19 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Bylaw_model.php 38
ERROR - 2019-10-25 14:32:19 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:32:19 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:32:23 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:32:23 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:32:25 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:32:25 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:33:58 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal_laboratories.php 27
ERROR - 2019-10-25 14:33:58 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal_laboratories.php 27
ERROR - 2019-10-25 14:34:10 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:34:10 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/evaluation/approve_modal_laboratories.php 25
ERROR - 2019-10-25 14:34:10 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:34:10 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/deny_modal_cooperative.php 21
ERROR - 2019-10-25 14:34:10 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:34:10 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/defer_modal_cooperative.php 21
ERROR - 2019-10-25 14:34:11 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:34:11 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:34:49 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:34:49 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:35:35 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:35:35 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:35:45 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:35:45 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:36:00 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:36:00 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:36:01 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal_laboratories.php 27
ERROR - 2019-10-25 14:36:01 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal_laboratories.php 27
ERROR - 2019-10-25 14:39:42 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:39:42 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:40:01 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 722
ERROR - 2019-10-25 14:41:28 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:41:28 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:41:30 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:41:30 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:41:38 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:41:38 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 14:41:41 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:41:41 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:41:44 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:41:44 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 25
ERROR - 2019-10-25 14:51:38 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 14:51:38 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 14:55:50 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 14:55:50 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 14:57:45 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 734
ERROR - 2019-10-25 14:57:45 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 586
ERROR - 2019-10-25 14:57:49 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:57:49 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:58:53 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:58:53 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:58:55 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 14:58:55 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 14:58:59 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 734
ERROR - 2019-10-25 14:58:59 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 586
ERROR - 2019-10-25 14:59:04 --> Severity: Warning --> fsockopen(): unable to connect to ssl://smtp.gmail.com:465 (Connection timed out) /opt/lampp/htdocs/cmvtest/coopris_3/system/libraries/Email.php 2069
ERROR - 2019-10-25 14:59:04 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 14:59:04 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:02:44 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:02:44 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:02:47 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:02:47 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:06:33 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:06:33 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:06:36 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:06:36 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:06:40 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 734
ERROR - 2019-10-25 15:06:40 --> Severity: error --> Exception: Too few arguments to function branches_model::approve_by_admin(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php on line 734 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 546
ERROR - 2019-10-25 15:07:05 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 734
ERROR - 2019-10-25 15:07:05 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 586
ERROR - 2019-10-25 15:07:10 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:07:10 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:07:37 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:07:37 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:08:12 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:08:12 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:08:17 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 700
ERROR - 2019-10-25 15:08:17 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 596
ERROR - 2019-10-25 15:09:18 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:09:18 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:11:33 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal_laboratories.php 27
ERROR - 2019-10-25 15:11:33 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal_laboratories.php 27
ERROR - 2019-10-25 15:11:45 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 15:11:45 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: directors_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 66
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: directors_count_odd /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: total_directors /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 67
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: chairperson_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 68
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: vice_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 69
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: treasurer_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 70
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: secretary_count /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 71
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: associate_not_exists /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 72
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: minimum_regular_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 73
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: minimum_regular_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Trying to get property 'regular_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 74
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: minimum_associate_subscription /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_subscription' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 75
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: minimum_associate_pay /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Trying to get property 'associate_percentage_shares_pay' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 76
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: bylaw_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Trying to get property 'kinds_of_members' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 77
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: check_regular_paid /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 83
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 84
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: total_regular /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 85
ERROR - 2019-10-25 15:12:35 --> Severity: Notice --> Undefined variable: ten_percent /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratory_cooperators_list.php 88
ERROR - 2019-10-25 15:16:02 --> Severity: Notice --> Undefined property: stdClass::$branchName /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 102
ERROR - 2019-10-25 15:16:02 --> Severity: Notice --> Undefined property: stdClass::$area_of_operation /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/laboratories_detail.php 121
ERROR - 2019-10-25 15:16:04 --> Severity: Notice --> Undefined variable: branching_fee /opt/lampp/htdocs/cmvtest/coopris_3/application/views/laboratories/payment_form_laboratories.php 84
ERROR - 2019-10-25 15:16:41 --> Severity: Warning --> Cannot modify header information - headers already sent /opt/lampp/htdocs/cmvtest/coopris_3/system/helpers/url_helper.php 564
ERROR - 2019-10-25 15:20:16 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:20:16 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:20:21 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:20:21 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:20:42 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 700
ERROR - 2019-10-25 15:20:43 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 596
ERROR - 2019-10-25 15:20:57 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:20:57 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:21:01 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:21:01 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:21:03 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:21:03 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:21:06 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:21:06 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:21:12 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:21:12 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:21:55 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:21:55 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:27:05 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 9
ERROR - 2019-10-25 15:27:05 --> Severity: Notice --> Trying to get property 'comment_by_specialist' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 9
ERROR - 2019-10-25 15:27:05 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:27:05 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:27:17 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:27:17 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:27:50 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:27:50 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:28:27 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 33
ERROR - 2019-10-25 15:28:27 --> Severity: Notice --> Trying to get property 'comment_by_senior' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 33
ERROR - 2019-10-25 15:28:27 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:28:27 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:28:38 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:28:38 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:28:49 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:28:49 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:28:51 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:28:51 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:29:54 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 722
ERROR - 2019-10-25 15:30:28 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:30:28 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:30:32 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:30:32 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:30:34 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:30:34 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:30:38 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 734
ERROR - 2019-10-25 15:30:38 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 586
ERROR - 2019-10-25 15:30:42 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:30:42 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:30:58 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:30:58 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:31:03 --> Severity: Notice --> Undefined variable: reason_commment /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 700
ERROR - 2019-10-25 15:31:03 --> Severity: Notice --> Undefined variable: coop_full_name /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 596
ERROR - 2019-10-25 15:31:19 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:31:19 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:31:22 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:31:22 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:31:24 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:31:24 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:31:29 --> Severity: Notice --> Undefined property: stdClass::$fullname /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Branches_model.php 690
ERROR - 2019-10-25 15:31:33 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:31:33 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:31:52 --> Severity: Notice --> Undefined variable: admin_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 23
ERROR - 2019-10-25 15:31:52 --> Severity: Notice --> Trying to get property 'access_level' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 23
ERROR - 2019-10-25 15:31:52 --> Severity: Notice --> Undefined variable: admin_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 23
ERROR - 2019-10-25 15:31:52 --> Severity: Notice --> Trying to get property 'access_level' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 23
ERROR - 2019-10-25 15:31:52 --> Severity: Notice --> Undefined variable: admin_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 33
ERROR - 2019-10-25 15:31:52 --> Severity: Notice --> Trying to get property 'access_level' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 33
ERROR - 2019-10-25 15:38:46 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:38:46 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:38:49 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:39:02 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:39:02 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 15:39:04 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:39:04 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-10-25 15:40:27 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:40:27 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:43:12 --> Severity: Notice --> Undefined property: stdClass::$temp_evaluation_comment /opt/lampp/htdocs/cmvtest/coopris_3/application/views/documents/list_of_documents_branch.php 42
ERROR - 2019-10-25 15:43:12 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:43:12 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:43:23 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:43:23 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:43:44 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:43:44 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:44:03 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:44:03 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:44:08 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:44:08 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:44:18 --> Severity: Notice --> Trying to get property 'citymunDesc' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 332
ERROR - 2019-10-25 15:44:18 --> Severity: Notice --> Trying to get property 'provDesc' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Branches.php 332
ERROR - 2019-10-25 15:44:30 --> Severity: error --> Exception: Too few arguments to function Uploaded_Document_model::add_document_info(), 4 passed in /opt/lampp/htdocs/cmvtest/coopris_3/application/controllers/Documents.php on line 2161 and exactly 5 expected /opt/lampp/htdocs/cmvtest/coopris_3/application/models/Uploaded_document_model.php 12
ERROR - 2019-10-25 15:45:16 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/upload_form/upload_document_7.php 23
ERROR - 2019-10-25 15:45:16 --> Severity: Notice --> Trying to get property 'status' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/upload_form/upload_document_7.php 23
ERROR - 2019-10-25 15:45:43 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:45:43 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:45:44 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:45:44 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:45:45 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:45:45 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:45:53 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:45:53 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:46:30 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:46:30 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:46:58 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:46:58 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:47:00 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:47:00 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:10 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:10 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:11 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:11 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:16 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:16 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:23 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:23 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:29 --> Severity: Notice --> Undefined variable: coop_info /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 15:48:29 --> Severity: Notice --> Trying to get property 'evaluation_comment' of non-object /opt/lampp/htdocs/cmvtest/coopris_3/application/views/cooperative/evaluation/approve_modal_branch.php 31
ERROR - 2019-10-25 16:24:56 --> Severity: Notice --> Undefined variable: list_specialist /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-10-25 16:24:56 --> Severity: Warning --> Invalid argument supplied for foreach() /opt/lampp/htdocs/cmvtest/coopris_3/application/views/applications/assign_admin_modal.php 27
