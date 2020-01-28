<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-12 01:51:50 --> Severity: Notice --> Undefined index: type_of_branch C:\xampp\htdocs\coopris\application\views\applications\list_of_branches.php 113
ERROR - 2019-04-12 02:09:18 --> 404 Page Not Found: Branches/f92405699504d652f7b678536ec07fe078a54d72741a4f8656776334b245d99f622ce619e0468554dc42f5ac2b88cd126d383cf879b217828fe350204adaa0c8OYGbNFR3cdABW6qzRiLixwa~59FzCou97DLN8nSv.O0-
ERROR - 2019-04-12 03:34:25 --> 404 Page Not Found: Branch/delete_branch
ERROR - 2019-04-12 03:43:28 --> 404 Page Not Found: Branch/delete_branch
ERROR - 2019-04-12 03:43:45 --> 404 Page Not Found: Branch/delete_branch
ERROR - 2019-04-12 03:44:46 --> 404 Page Not Found: Branch/delete_branch
ERROR - 2019-04-12 03:50:33 --> 404 Page Not Found: Branches/delete_branch
ERROR - 2019-04-12 03:50:50 --> 404 Page Not Found: Branches/delete_branch
ERROR - 2019-04-12 03:53:50 --> 404 Page Not Found: Branches/delete_branch
ERROR - 2019-04-12 03:57:14 --> 404 Page Not Found: Branches/delete_branch
ERROR - 2019-04-12 03:58:22 --> 404 Page Not Found: Branches/delete_branch
ERROR - 2019-04-12 03:58:30 --> 404 Page Not Found: Branches/delete_branch
ERROR - 2019-04-12 04:03:38 --> 404 Page Not Found: Branches/delete_branch
ERROR - 2019-04-12 04:05:18 --> Query error: Unknown column 'business_activities_cooperative.branches_id' in 'on clause' - Invalid query: SELECT `business_activities_cooperative`.`industry_subclass_by_coop_type_id` as `BAC_id`, `major_industry`.`description` as `mdesc`, `subclass`.`description` as `sdesc`
FROM `registeredcoop`
INNER JOIN `business_activities_cooperative` ON `business_activities_cooperative`.`branches_id` = `registeredcoop`.`application_id`
INNER JOIN `industry_subclass_by_coop_type` ON `industry_subclass_by_coop_type`.`id` = `business_activities_cooperative`.`industry_subclass_by_coop_type_id`
INNER JOIN `major_industry` ON `major_industry`.`id` = `industry_subclass_by_coop_type`.`major_industry_id`
JOIN `subclass` ON `subclass`.`id` = `industry_subclass_by_coop_type`.`subclass_id`
WHERE `regNo` = '9520-1013000000000002'
ERROR - 2019-04-12 04:05:59 --> Query error: Unknown column 'business_activities_cooperative.branches_id' in 'on clause' - Invalid query: SELECT `business_activities_cooperative`.`industry_subclass_by_coop_type_id` as `BAC_id`, `major_industry`.`description` as `mdesc`, `subclass`.`description` as `sdesc`
FROM `registeredcoop`
INNER JOIN `business_activities_cooperative` ON `business_activities_cooperative`.`branches_id` = `registeredcoop`.`application_id`
INNER JOIN `industry_subclass_by_coop_type` ON `industry_subclass_by_coop_type`.`id` = `business_activities_cooperative`.`industry_subclass_by_coop_type_id`
INNER JOIN `major_industry` ON `major_industry`.`id` = `industry_subclass_by_coop_type`.`major_industry_id`
JOIN `subclass` ON `subclass`.`id` = `industry_subclass_by_coop_type`.`subclass_id`
WHERE `regNo` = '9520-1013000000000002'
ERROR - 2019-04-12 05:17:16 --> 404 Page Not Found: Branches/delete_branch
ERROR - 2019-04-12 05:19:36 --> 404 Page Not Found: Branches/delete_branch
ERROR - 2019-04-12 05:31:28 --> Query error: Unknown column 'users_id' in 'where clause' - Invalid query: SELECT *
FROM `branches`
WHERE `users_id` = '8'
AND `id` = '7'
ERROR - 2019-04-12 05:35:00 --> 404 Page Not Found: Branches/2e8af9190c5bda920cf4473b171c56052948e444c6a7d68fbcbb0414b950026a13bc33a9990cde14e42c03337081e9b9c17da7930cb5457025d321f32f27bb53fAPAG2oi73WPDk~Tmbi2ygGTlI~OOQGEjaYfmiIC9WQ-
ERROR - 2019-04-12 07:03:03 --> Severity: Error --> Call to undefined method branches_model::check_own_cooperative() C:\xampp\htdocs\coopris\application\controllers\branches.php 189
ERROR - 2019-04-12 12:06:53 --> Query error: Unknown column 'business_activities_of_branches.branches_id' in 'where clause' - Invalid query: SELECT `major_industry`.`id` as `bactivity_id`, `major_industry`.`description` as `bactivity_name`, `subclass`.`id` as `bactivitysubtype_id`, `subclass`.`description` as `bactivitysubtype_name`
FROM `business_activities_cooperative`
INNER JOIN `industry_subclass_by_coop_type` ON `industry_subclass_by_coop_type`.`id` = `business_activities_cooperative`.`industry_subclass_by_coop_type_id`
INNER JOIN `major_industry` ON `major_industry`.`id` = `industry_subclass_by_coop_type`.`major_industry_id`
INNER JOIN `subclass` ON `subclass`.`id` = `industry_subclass_by_coop_type`.`subclass_id`
WHERE `business_activities_of_branches`.`branches_id` = '6'
ERROR - 2019-04-12 12:07:57 --> Severity: Notice --> Undefined property: stdClass::$proposed_name C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 107
ERROR - 2019-04-12 12:07:57 --> Severity: Notice --> Undefined property: stdClass::$type_of_branch C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 107
ERROR - 2019-04-12 12:07:57 --> Severity: Notice --> Undefined property: stdClass::$grouping C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 107
ERROR - 2019-04-12 12:07:57 --> Severity: Notice --> Undefined property: stdClass::$category_of_branch C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 112
ERROR - 2019-04-12 12:07:57 --> Severity: Notice --> Undefined property: stdClass::$common_bond_of_membership C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 125
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: members_composition C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 130
ERROR - 2019-04-12 12:07:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 130
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined property: stdClass::$expire_at C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 162
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 369
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 372
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: cooperator_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 388
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: cooperator_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 391
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 397
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: purposes_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 407
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: purposes_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 410
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 416
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: article_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 426
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: article_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 429
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 435
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: committees_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 445
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: committees_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 448
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 454
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: economic_survey_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 464
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: economic_survey_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 467
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 473
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: staff_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 483
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: staff_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 486
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 492
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 502
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 505
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: document_two C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 505
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 517
ERROR - 2019-04-12 12:07:58 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 536
ERROR - 2019-04-12 12:19:34 --> Severity: Parsing Error --> syntax error, unexpected 'endif' (T_ENDIF) C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 152
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 355
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 358
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: cooperator_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 374
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: cooperator_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 377
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 383
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: purposes_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 393
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: purposes_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 396
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 402
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: article_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 412
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: article_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 415
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 421
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: committees_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 431
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: committees_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 434
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 440
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: economic_survey_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 450
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: economic_survey_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 453
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 459
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: staff_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 469
ERROR - 2019-04-12 12:20:09 --> Severity: Notice --> Undefined variable: staff_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 472
ERROR - 2019-04-12 12:20:10 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 478
ERROR - 2019-04-12 12:20:10 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 488
ERROR - 2019-04-12 12:20:10 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 491
ERROR - 2019-04-12 12:20:10 --> Severity: Notice --> Undefined variable: document_two C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 491
ERROR - 2019-04-12 12:20:10 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 503
ERROR - 2019-04-12 12:20:10 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 522
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 355
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 358
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: cooperator_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 374
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: cooperator_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 377
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 383
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: purposes_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 393
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: purposes_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 396
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 402
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: article_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 412
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: article_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 415
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 421
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: committees_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 431
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: committees_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 434
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 440
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: economic_survey_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 450
ERROR - 2019-04-12 12:23:21 --> Severity: Notice --> Undefined variable: economic_survey_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 453
ERROR - 2019-04-12 12:23:22 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 459
ERROR - 2019-04-12 12:23:22 --> Severity: Notice --> Undefined variable: staff_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 469
ERROR - 2019-04-12 12:23:22 --> Severity: Notice --> Undefined variable: staff_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 472
ERROR - 2019-04-12 12:23:22 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 478
ERROR - 2019-04-12 12:23:22 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 488
ERROR - 2019-04-12 12:23:22 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 491
ERROR - 2019-04-12 12:23:22 --> Severity: Notice --> Undefined variable: document_two C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 491
ERROR - 2019-04-12 12:23:22 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 503
ERROR - 2019-04-12 12:23:22 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 522
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 355
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 358
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: cooperator_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 374
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: cooperator_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 377
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 383
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: purposes_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 393
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: purposes_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 396
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 402
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: article_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 412
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: article_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 415
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 421
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: committees_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 431
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: committees_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 434
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 440
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: economic_survey_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 450
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: economic_survey_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 453
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 459
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: staff_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 469
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: staff_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 472
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 478
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 488
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 491
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: document_two C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 491
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 503
ERROR - 2019-04-12 12:23:32 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 522
ERROR - 2019-04-12 12:40:17 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 355
ERROR - 2019-04-12 12:40:17 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 358
ERROR - 2019-04-12 12:40:17 --> Severity: Notice --> Undefined variable: document_two C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 358
ERROR - 2019-04-12 12:40:17 --> Severity: Notice --> Undefined variable: bylaw_complete C:\xampp\htdocs\coopris\application\views\cooperative\branch_detail.php 388
ERROR - 2019-04-12 18:06:47 --> 404 Page Not Found: Branches/19add5bc4320ea91e834dd78d8abcc06f232aa0628f2e7c790e9a77500af287eedf5ef3241b7dd246c70b442dfad3d1290ec188a79b1fab88fd31fdbbe07584eh7PB04fpKmdQBdL9ESKLyuSFXMxZ33y5J9dV.Ph8VR4-
ERROR - 2019-04-12 18:07:12 --> 404 Page Not Found: Branches/19add5bc4320ea91e834dd78d8abcc06f232aa0628f2e7c790e9a77500af287eedf5ef3241b7dd246c70b442dfad3d1290ec188a79b1fab88fd31fdbbe07584eh7PB04fpKmdQBdL9ESKLyuSFXMxZ33y5J9dV.Ph8VR4-
ERROR - 2019-04-12 18:38:58 --> Severity: Notice --> Undefined property: Documents::$branch_model C:\xampp\htdocs\coopris\application\controllers\Documents.php 178
ERROR - 2019-04-12 18:38:58 --> Severity: Error --> Call to a member function get_branch_info() on null C:\xampp\htdocs\coopris\application\controllers\Documents.php 178
ERROR - 2019-04-12 18:43:43 --> Severity: Parsing Error --> syntax error, unexpected end of file C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 232
ERROR - 2019-04-12 19:09:34 --> Severity: Parsing Error --> syntax error, unexpected end of file C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 232
ERROR - 2019-04-12 19:09:39 --> Severity: Parsing Error --> syntax error, unexpected end of file C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 232
ERROR - 2019-04-12 19:24:40 --> Severity: Parsing Error --> syntax error, unexpected end of file C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 232
ERROR - 2019-04-12 19:25:32 --> Severity: Parsing Error --> syntax error, unexpected end of file C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 231
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Undefined variable: document_two C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 19:28:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-12 19:28:52 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-12 19:28:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-12 19:28:53 --> Severity: Notice --> Undefined variable: document_one C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 19:28:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 19:28:53 --> Severity: Notice --> Undefined variable: document_two C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 19:28:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 19:32:49 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 19:32:49 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 19:32:49 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 19:32:49 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 19:32:49 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-12 19:32:49 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 106
ERROR - 2019-04-12 19:32:49 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-12 19:32:50 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 108
ERROR - 2019-04-12 19:32:50 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-12 19:32:50 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 123
ERROR - 2019-04-12 19:32:50 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-12 19:32:50 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 125
ERROR - 2019-04-12 19:32:50 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 19:32:50 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 22:09:11 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 22:09:11 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 22:09:11 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 22:09:11 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 22:22:08 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) C:\xampp\htdocs\coopris\application\models\branches_model.php 238
ERROR - 2019-04-12 22:22:44 --> Query error: Unknown column 'branches.application_id' in 'on clause' - Invalid query: SELECT `branches`.*, `refbrgy`.`brgyCode` as `bCode`, `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunCode` as `cCode`, `refcitymun`.`citymunDesc` as `city`, `refprovince`.`provCode` as `pCode`, `refprovince`.`provDesc` as `province`, `refregion`.`regCode` as `rCode`, `refregion`.`regDesc` as `region`, `cooperatives`.`category_of_cooperative`, `cooperatives`.`grouping`
FROM `branches`
INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `branches`.`addrCode`
INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode`
INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode`
JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode`
INNER JOIN `cooperatives` ON `cooperatives`.`id`=`branches`.`application_id`
WHERE `branches`.`user_id` = '8'
AND `branches`.`id` = '6'
ERROR - 2019-04-12 22:24:58 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 22:24:58 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 89
ERROR - 2019-04-12 22:24:58 --> Severity: Notice --> Undefined variable: coop_info C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 22:24:58 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 91
ERROR - 2019-04-12 22:26:25 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 22:26:25 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 22:27:09 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 22:27:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 22:28:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 22:30:09 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 22:34:10 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 22:34:10 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 22:34:10 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 44
ERROR - 2019-04-12 22:34:10 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Purposes.php 38
ERROR - 2019-04-12 10:40:08 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 10:45:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 10:45:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 10:58:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 10:58:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:00:09 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 146
ERROR - 2019-04-12 11:00:09 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 159
ERROR - 2019-04-12 11:01:57 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:01:57 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:04:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:04:22 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:05:32 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:05:32 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:05:40 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:05:40 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:25:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:25:43 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:26:13 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:26:13 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:28:32 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:28:32 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:29:23 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:29:23 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:29:32 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:29:32 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:30:13 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:30:13 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:41:26 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 184
ERROR - 2019-04-12 11:41:26 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 184
ERROR - 2019-04-12 11:41:26 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 185
ERROR - 2019-04-12 11:41:26 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 185
ERROR - 2019-04-12 11:41:27 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 186
ERROR - 2019-04-12 11:41:27 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 186
ERROR - 2019-04-12 11:41:27 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 187
ERROR - 2019-04-12 11:41:27 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 187
ERROR - 2019-04-12 11:41:27 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 188
ERROR - 2019-04-12 11:41:27 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 188
ERROR - 2019-04-12 11:41:27 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:41:27 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 184
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 184
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 185
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 185
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 186
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 186
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 187
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 187
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Undefined variable: branch_info C:\xampp\htdocs\coopris\application\controllers\Documents.php 188
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 188
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:42:14 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:43:49 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:43:49 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:44:04 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:44:04 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:45:35 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:45:35 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 11:45:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 11:45:53 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 12:52:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 12:52:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 12:58:36 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 150
ERROR - 2019-04-12 12:58:36 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\views\documents\list_of_documents_branch.php 163
ERROR - 2019-04-12 13:07:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 13:15:30 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 13:16:24 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 13:16:24 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 13:16:24 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 44
ERROR - 2019-04-12 13:16:24 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Purposes.php 38
ERROR - 2019-04-12 13:16:33 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 13:17:29 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\models\Purpose_model.php 34
ERROR - 2019-04-12 13:41:38 --> 404 Page Not Found: 
ERROR - 2019-04-12 13:43:58 --> 404 Page Not Found: Cooperatives/fcdcdc4f5c56318d935d47acbbf9c4c92a7e6caf5f954ad2ce5a11cfd7a40d5147f08dda31b76cacfff7d3c89698e4d6d0c3e09ae1db19284cca4126b07e375cjGXVVss8iQrhK4CENZaiwogslKBue8megB2us1CwLW4-
ERROR - 2019-04-12 13:47:25 --> 404 Page Not Found: 
ERROR - 2019-04-12 13:47:50 --> 404 Page Not Found: 
ERROR - 2019-04-12 13:48:35 --> 404 Page Not Found: 
ERROR - 2019-04-12 14:03:49 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\coopris\application\models\Uploaded_Document_model.php 13
ERROR - 2019-04-12 14:03:59 --> Severity: Error --> Allowed memory size of 134217728 bytes exhausted (tried to allocate 40897547 bytes) C:\xampp\htdocs\coopris\system\core\Output.php 457
ERROR - 2019-04-12 14:05:29 --> Severity: Error --> Allowed memory size of 134217728 bytes exhausted (tried to allocate 40897547 bytes) C:\xampp\htdocs\coopris\system\core\Output.php 457
ERROR - 2019-04-12 14:05:47 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\coopris\application\models\Uploaded_Document_model.php 13
ERROR - 2019-04-12 14:06:44 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\coopris\application\models\Uploaded_Document_model.php 13
ERROR - 2019-04-12 14:38:13 --> 404 Page Not Found: Branches/deaaddd2af30c57381dd24c8b388b4911d2fdb74331263ebb583765db8e74a02112c688018d4c4017ed1486111f93c338a9fb25787caa0e704ffec7053c7b7563RTlA2ihbjV1nDB9arL3BvFnUK0at9pUW2I03MaHdoo-
ERROR - 2019-04-12 16:55:00 --> Severity: Notice --> Undefined variable: branch_nifo C:\xampp\htdocs\coopris\application\controllers\Documents.php 1511
ERROR - 2019-04-12 16:55:00 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 1511
ERROR - 2019-04-12 16:56:18 --> Severity: Notice --> Undefined variable: branch_nifo C:\xampp\htdocs\coopris\application\controllers\Documents.php 1511
ERROR - 2019-04-12 16:56:18 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\coopris\application\controllers\Documents.php 1511
ERROR - 2019-04-12 17:13:03 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\coopris\application\models\Uploaded_Document_model.php 13
ERROR - 2019-04-12 17:13:06 --> 404 Page Not Found: Cooperatives/c3aa85d961460350fb2c8a8305dbe58b4a353edea76194ab2553cc232981bb6459b88f505c5c12ffda9e65f0443a867354d224c2637f4883613e144a3e70124ab1k9H5Y8h8ipB.HNnPJ03E60qS4WXZ7qyBGbgv9HKHU-
ERROR - 2019-04-12 17:13:48 --> 404 Page Not Found: Documents/upload_document_6
ERROR - 2019-04-12 17:40:12 --> 404 Page Not Found: Cooperatives/439f54fc4093c393c9337d4e01f47e49b757b6adbb61d51d69f26e7b387882cc79a5fba1c3f14b9067ffed3f6d97ec8098e5debd94fafdbab8fb40dd55fa7549moPWewIYn4pKmaa3MWlY.VmS~MCxAw2jBOs~EiBXptM-
ERROR - 2019-04-12 17:52:20 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\coopris\application\models\Uploaded_Document_model.php 13
ERROR - 2019-04-12 17:52:38 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\coopris\application\models\Uploaded_Document_model.php 13
ERROR - 2019-04-12 17:58:23 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\coopris\application\models\Uploaded_Document_model.php 13
ERROR - 2019-04-12 17:58:39 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\coopris\application\models\Uploaded_Document_model.php 13
ERROR - 2019-04-12 19:49:55 --> Severity: Error --> Call to undefined method Uploaded_Document_model::get_document_one_5() C:\xampp\htdocs\coopris\application\controllers\branches.php 426
ERROR - 2019-04-12 19:50:49 --> Severity: Error --> Call to undefined method Uploaded_Document_model::get_document_5() C:\xampp\htdocs\coopris\application\controllers\branches.php 426
ERROR - 2019-04-12 19:51:03 --> Severity: Error --> Call to undefined method Uploaded_Document_model::get_document_5() C:\xampp\htdocs\coopris\application\controllers\branches.php 426
ERROR - 2019-04-12 19:52:52 --> Severity: Notice --> Undefined property: stdClass::$evaluated_by C:\xampp\htdocs\coopris\application\models\branches_model.php 605
