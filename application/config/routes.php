<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:amendment_staff
|
|	example.com/class/method/id/F
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded. 
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'cooperatives';
//$route['default_controller'] = 'welcome';
$route['default_controller'] = 'users/index';

$route['amendment/(:num)'] = 'amendment/index/$1';
$route['amendment/deferred_denied'] = 'amendment/deferred_denied';
$route['amendment/deferred_denied/(:num)'] = 'amendment/deferred_denied/$1';
$route['amendment/registered'] = 'amendment/registered';
$route['amendment/registered/(:num)'] = 'amendment/registered/$1';
$route['amendment/registered_ho'] = 'amendment/registered_ho';
$route['amendment/registered_ho/(:num)'] = 'amendment/registered_ho/$1';
$route['amendment_update/replicate'] = 'amendment_update/replicate';
$route['amendment_update/update_registeredNo'] = 'amendment_update/update_registeredNo';
$route['amendment_update/authorized_user_submission'] = 'amendment_update/authorized_user_submission';
$route['amendment_update/seed_data'] = 'amendment_update/seed_data';
//amendment UNION
$route['amendment/(:any)/amendment_union/(:num)'] = 'amendment_union/index/$1/$2';
$route['amendment/(:any)/amendment_union'] = 'amendment_union/index/$1';
$route['amendment/(:any)/article_union'] = 'amendment_articles/union/$1';

$route['branches/(:any)/documents/bylaws_primary_branch'] = 'documents/bylaws_primary_branch/$1';
$route['branches/(:any)/documents/bylaws_primary_branch_amend'] = 'documents/bylaws_primary_branch_amend/$1';
$route['branches/(:any)/documents/articles_cooperation_primary_branch'] = 'documents/articles_cooperation_primary_branch/$1';
$route['branches/(:any)/documents/articles_cooperation_primary_branch_amend'] = 'documents/articles_cooperation_primary_branch_amend/$1';
$route['branches/(:any)/documents/affidavit_primary_bs'] = 'documents/affidavit_primary_bs/$1';
$route['branches/(:any)/documents/affidavit_primary_bs_amend'] = 'documents/affidavit_primary_bs_amend/$1';

$route['branches/payment/(:any)'] = 'branches/payment/$1';
$route['branches/get_branch_info'] = 'branches/get_branch_info';
$route['branches/registration'] = 'branches/registration';
$route['branches/(:any)/Payments_branch'] = 'Payments_branch/index/$1';
$route['branches/specialist'] = 'branches/specialist';
$route['branches/deny_branch'] = 'branches/deny_branch';
$route['branches/defer_branch'] = 'branches/defer_branch';
$route['branches/approve_branch'] = 'branches/approve_branch';
$route['branches/(:any)'] = 'branches/view/$1';
$route['branches/(:any)/bns_closure'] = 'bns_closure/index/$1';
$route['branches/(:any)/bns_conversion'] = 'bns_conversion/index/$1';
$route['branches/(:any)/bns_transfer'] = 'bns_transfer/index/$1';
$route['branches/(:any)/cooperative_tool/branch']='cooperative_tool/branch/$1';
$route['branches/(:any)/bupdate']  =  'branches/bupdate/$1';
$route['branches/(:any)/composition'] = 'branches/composition';
$route['branches/delete_branches'] = 'branches/delete_branches';
$route['branches/business_activity/(:any)'] = 'branches/business_activity/$1';
$route['branches/(:any)/business_activity/(:any)'] = 'branches/business_activity/$2/$1';
$route['branches/coop_info/(:any)'] = 'branches/coop_info/$1';

$route['branch_update/(:any)/evaluate'] = 'branch_update/evaluate/$1';
$route['branch_update/(:any)/documents_branch_update'] = 'documents_branch_update/branch/$1';
$route['branch_update/(:any)/view'] = 'branch_update/view/$1';
$route['branch_update/(:any)/bupdate']  =  'branch_update/bupdate/$1';

$route['for_transfer/(:any)/Payments_branch_for_transfer'] = 'Payments_branch_for_transfer/index/$1';
$route['for_conversion/(:any)/Payments_branch_for_conversion'] = 'Payments_branch_for_conversion/index/$1';
$route['for_transfer/deny_branch_for_transfer'] = 'for_transfer/deny_branch_for_transfer';
$route['for_transfer/specialist'] = 'for_transfer/specialist';
$route['for_transfer/approve_branch'] = 'for_transfer/approve_branch';
$route['for_closure/approve_branch'] = 'for_closure/approve_branch';
$route['for_closure/defer_branch'] = 'for_closure/defer_branch';

$route['bns_transfer/transfer_region'] = 'bns_transfer/transfer_region';

$route['branches/(:any)/documents_closure'] = 'documents_closure/branch/$1';
$route['branches/(:any)/documents_transfer'] = 'documents_transfer/branch/$1';
$route['branches/(:any)/documents_conversion'] = 'documents_conversion/branch/$1';

$route['branches/(:any)/documents_conversion_submission'] = 'documents_conversion_submission/branch/$1';
$route['branches/(:any)/documents_transfer_submission'] = 'documents_transfer_submission/branch/$1';
$route['branches/(:any)/documents_closure_submission'] = 'documents_closure_submission/branch/$1';
$route['branches/(:any)/documents_closure/upload_document_letter_of_intent'] = 'documents_closure/upload_document_letter_of_intent/$1';
$route['bns_closure/(:any)/evaluate'] = 'bns_closure/evaluate/$1';
$route['bns_transfer/(:any)/evaluate'] = 'bns_transfer/evaluate/$1';
$route['bns_conversion/(:any)/evaluate'] = 'bns_conversion/evaluate/$1';
$route['bns_closure/(:any)/evaluation_for_submission'] = 'bns_closure/evaluation_for_submission/$1';
$route['bns_transfer/(:any)/evaluation_for_submission'] = 'bns_transfer/evaluation_for_submission/$1';
$route['bns_conversion/(:any)/evaluation_for_submission'] = 'bns_conversion/evaluation_for_submission/$1';
$route['branches/(:any)/documents_closure_submission/upload_document_44'] = 'documents_closure_submission/upload_document_44/$1';
$route['branches/(:any)/documents_closure_submission/upload_document_45'] = 'documents_closure_submission/upload_document_45/$1';
$route['branches/(:any)/documents_closure_submission/upload_document_46'] = 'documents_closure_submission/upload_document_46/$1';

$route['branches/(:any)/documents_transfer_submission/upload_document_for_transfer_47'] = 'documents_transfer_submission/upload_document_for_transfer_47/$1';
$route['branches/(:any)/documents_transfer_submission/upload_document_for_transfer_48'] = 'documents_transfer_submission/upload_document_for_transfer_48/$1';
$route['branches/(:any)/documents_transfer_submission/upload_document_for_transfer_49'] = 'documents_transfer_submission/upload_document_for_transfer_49/$1';

$route['branches/(:any)/documents_conversion_submission/upload_document_for_conversion_50'] = 'documents_conversion_submission/upload_document_for_conversion_50/$1';
$route['branches/(:any)/documents_conversion_submission/upload_document_for_conversion_51'] = 'documents_conversion_submission/upload_document_for_conversion_51/$1';
$route['branches/(:any)/documents_conversion_submission/upload_document_for_conversion_52'] = 'documents_conversion_submission/upload_document_for_conversion_52/$1';
$route['branches/(:any)/documents_conversion_submission/upload_document_for_conversion_53'] = 'documents_conversion_submission/upload_document_for_conversion_53/$1';
$route['branches/(:any)/documents_conversion_submission/upload_document_for_conversion_54'] = 'documents_conversion_submission/upload_document_for_conversion_54/$1';

$route['branches/(:any)/documents'] = 'documents/branch/$1';
$route['branches/(:any)/documents/view_document_one/(:any)'] = 'documents/view_document_one/$1/$2';
$route['branches/(:any)/documents/view_document_one_branch/(:any)/(:any)'] = 'documents/view_document_one_branch/$1/$2/$3';
$route['branches/(:any)/documents/view_document_two/(:any)'] = 'documents/view_document_two/$1/$2';
$route['branches/(:any)/documents/upload_document_5'] = 'documents/upload_document_5/$1';
$route['branches/(:any)/documents/upload_document_6'] = 'documents/upload_document_6/$1';
$route['branches/(:any)/documents/upload_document_7'] = 'documents/upload_document_7/$1';
$route['branches/(:any)/documents/upload_document_8'] = 'documents/upload_document_8/$1';
$route['branches/(:any)/documents/upload_document_9'] = 'documents/upload_document_9/$1';
$route['branches/(:any)/documents/upload_document_40'] = 'documents/upload_document_40/$1';
$route['branches/(:any)/documents/upload_document_others_bns'] = 'documents/upload_document_others_bns/$1';
$route['branches/(:any)/documents/(:any)/view_document_5/(:any)'] = 'documents/view_document_5/$1/$2/$3';
$route['branches/(:any)/documents/(:any)/view_document_6/(:any)'] = 'documents/view_document_6/$1/$2/$3';
$route['branches/(:any)/documents/(:any)/view_document_7/(:any)'] = 'documents/view_document_7/$1/$2/$3';
$route['branches/(:any)/documents/(:any)/view_document_8/(:any)'] = 'documents/view_document_8/$1/$2/$3';
$route['branches/(:any)/documents/(:any)/view_document_9/(:any)'] = 'documents/view_document_9/$1/$2/$3';
$route['branches/(:any)/evaluate'] = 'branches/evaluate/$1';
$route['branches/(:any)/registration'] = 'registration/branch/$1';
$route['branches/get_cooperative_info'] = 'branches/get_cooperative_info';
$route['branches/(:any)/forpaymentbranches'] = 'forpaymentbranches/index/$1';
$route['branches/(:any)/forpaymentbranches_for_conversion'] = 'forpaymentbranches_for_conversion/index/$1';
$route['branches/(:any)/forpaymentbranches_for_transfer'] = 'forpaymentbranches_for_transfer/index/$1';
$route['branches/(:any)/branch_registered'] = 'branch_registered/index/$1';

$route['laboratories/(:any)/laboratory_registered'] = 'laboratory_registered/index/$1';
$route['laboratories/coop_info/(:any)'] = 'laboratories/coop_info/$1';
$route['laboratories/approve_laboratories_2'] ='Laboratories/approve_laboratories_2'; //modify
$route['laboratories/payment'] = 'Laboratories/payment'; //modify by
$route['laboratories/deny_laboratory'] = 'laboratories/deny_laboratory';//modify by json
$route['laboratories/defer_laboratory'] = 'laboratories/defer_laboratory';//modify by json
$route['laboratories/registration'] = 'laboratories/registration';
$route['laboratories/get_cooperative_info'] = 'laboratories/get_cooperative_info';//modify
$route['laboratories/(:any)'] = 'laboratories/view/$1';
$route['laboratories/(:any)/laboratories_cooperators'] = 'laboratories_cooperators/index/$1';
$route['laboratories/(:any)/laboratories_cooperators/add'] = 'laboratories_cooperators/add/$1';
$route['laboratories/(:any)/laboratories_cooperators/coop_info/(:any)'] = 'laboratories_cooperators/coop_info/$1/$2';
$route['laboratories_cooperators/(:any)/api/regions'] ='api/regions/index';
$route['laboratories_cooperators/(:any)/api/provinces'] ='api/provinces/index';
$route['laboratories/(:any)/api/provinces'] ='api/provinces/index';
$route['laboratories/(:any)/api/cities'] = 'api/cities/index';
$route['laboratories/(:any)/api/barangays'] = 'api/barangays/index';
$route['laboratories/(:any)/laboratories_cooperators/get_cooperative_info'] ='laboratories_cooperators/get_cooperative_info';
$route['laboratories/(:any)/laboratories_cooperators/get_cooperative_info_edit'] ='laboratories_cooperators/get_cooperative_info_edit'; //modify by jayson
$route['laboratories/(:any)/laboratories_cooperators/cooperative_info_details'] ='laboratories_cooperators/cooperative_info_details'; //modify by jayson
$route['laboratories/(:any)/laboratories_cooperators/(:any)/cooperative_info_details'] ='laboratories_cooperators/cooperative_info_details'; //modify by jayson


$route['laboratories/(:any)/laboratories_cooperators/api/regions'] ='api/regions/index';
$route['laboratories/(:any)/laboratories_cooperators/api/provinces'] ='api/provinces/index';
$route['laboratories/(:any)/laboratories_cooperators/api/cities'] = 'api/cities/index';
$route['laboratories/(:any)/laboratories_cooperators/api/barangays'] = 'api/barangays/index';

//$route['laboratories/laboratories_cooperators/check_cooperator_not_exist'] = 'laboratories_cooperators/check_cooperator_not_exist';
$route['laboratories/cooperators/check_cooperator_not_exist'] = 'laboratories_cooperators/check_cooperator_not_exist';
$route['laboratories/cooperators/check_position_not_exist'] = 'laboratories_cooperators/check_position_not_exist';
$route['laboratories/(:any)/cooperators/check_edit_cooperator_not_exist'] = 'laboratories_cooperators/check_edit_cooperator_not_exist';
$route['laboratories/(:any)/cooperators/check_edit_position_not_exist'] = 'laboratories_cooperators/check_edit_position_not_exist';

$route['laboratories/(:any)/laboratories_cooperators/(:any)/edit'] = 'laboratories_cooperators/edit/$1/$2';
$route['laboratories/(:any)/evaluate'] = 'laboratories/evaluate/$1';
$route['laboratories/(:any)/laboratories_documents'] = 'laboratories_documents/index/$1';
$route['cooperatives/assign_specialist'] = 'cooperatives/assign_specialist';
$route['cooperatives/coc'] = 'cooperatives/coc';
$route['laboratories/specialist'] = 'laboratories/specialist';
$route['laboratories/(:any)/cooperative_tool'] = 'cooperative_tool/index/$1';

$route['laboratories/(:any)/laboratories_payments_branch'] = 'laboratories_payments_branch/index/$1';
$route['laboratories/(:any)/laboratories_forpayment'] = 'laboratories_forpayment/index/$1';
$route['laboratories/(:any)/rupdate'] = 'laboratories/rupdate/$1';  //modify
$route['laboratories/delete_laboratory'] = 'laboratories/delete_laboratory';  //modify
$route['laboratories/(:any)/laboratories_registration'] = 'laboratories_registration/index/$1';
$route['laboratories/(:any)/UploadDocuments']= 'laboratories/UploadDocuments/$1'; //modify
$route['laboratories/(:any)/documents/upload_manual_operation/(:any)']= 'documents/upload_manual_operation/$1/$2'; //modify
$route['laboratories/(:any)/documents/upload_document_others_lab'] = 'documents/upload_document_others_lab/$1';
$route['laboratories/(:any)/documents/view_document_laboratory/(:any)/(:any)'] = 'documents/view_document_laboratory/$1/$2/$3';//modify
$route['laboratories/(:any)/laboratories_documents/view_document_one_lab3/(:any)/(:any)'] = 'laboratories_documents/view_document_one_lab3/$1/$2/$3';//modify



$route['laboratories/(:any)/laboratories_documents/view_document_one_lab/(:any)/(:any)'] = 'laboratories_documents/view_document_one_lab/$1/$2/$3';//modify

$route['laboratories/(:any)/laboratories_documents/document_view_review'] = 'laboratories_documents/document_view_review/$1';//modify
$route['laboratories/(:any)/laboratories_documents/bylaws_primary/(:any)'] = 'laboratories_documents/bylaws_primary/$1/$2';//modify
$route['laboratories/(:any)/laboratories_documents/articles_cooperation_primary'] = 'laboratories_documents/articles_cooperation_primary/$1';//modify
$route['laboratories/(:any)/laboratories_documents/affidavit_primary_lab'] = 'laboratories_documents/affidavit_primary_lab/$1';//modify
$route['laboratories/(:any)/laboratories_documents/economic_survey_lab'] = 'laboratories_documents/economic_survey_lab/$1';//modify

$route['amendment/(:any)/amendment_cooperators/check_edit_position_not_exist'] = 'amendment_cooperators/check_edit_position_not_exist';
$route['amendment/(:any)/amendment_cooperators/get_post_cooperator_info_ajax'] = 'amendment_cooperators/get_post_cooperator_info_ajax';
$route['amendment/coop_info/(:any)'] = 'amendment/coop_info/$1';


$route['bylaws/(:any)/union'] = 'bylaws/union/$1';
$route['cooperatives/approve_laboratories'] = 'cooperatives/approve_laboratories';
$route['cooperatives/bylaws/check_minimum_regular_subscription'] = 'bylaws/check_minimum_regular_subscription';
$route['cooperatives/bylaws/check_minimum_regular_pay'] = 'bylaws/check_minimum_regular_pay';
$route['cooperatives/bylaws/check_minimum_associate_subscription'] = 'bylaws/check_minimum_associate_subscription';
$route['cooperatives/bylaws/check_minimum_associate_pay'] = 'bylaws/check_minimum_associate_pay';
$route['cooperatives/(:any)/payments'] = 'payments/index/$1';
$route['cooperatives/(:any)/affiliators/check_position_not_exist/(:any)'] = 'affiliators/check_position_not_exist/$1/$2';
$route['cooperatives/(:any)/affiliators/check_edit_position_not_exist/(:any)/(:any)'] = 'affiliators/check_edit_position_not_exist/$1/$2/$3';
$route['cooperatives/(:any)/evaluate'] = 'cooperatives/evaluate/$1';
// $route['cooperatives/(:any)/documents/view_document_one/(:any)'] = 'documents/view_document_one/$1/$2';
$route['cooperatives/sp'] = 'cooperatives/sp';
//modiy by json
$route['cooperatives/(:any)/documents/view_document_one/(:any)/(:any)'] = 'documents/view_document_one/$1/$2/$3';
$route['cooperatives/(:any)/documents/view_document_two/(:any)'] = 'documents/view_document_two/$1/$2';
$route['cooperatives/(:any)/documents/view_document_three/(:any)'] = 'documents/view_document_three/$1/$2';
$route['cooperatives/(:any)/documents/upload_document_one'] = 'documents/upload_document_one/$1';
$route['cooperatives/(:any)/documents/upload_document_two'] = 'documents/upload_document_two/$1';
$route['cooperatives/(:any)/documents/upload_document_three'] = 'documents/upload_document_three/$1';
$route['cooperatives/(:any)/documents/upload_document_unifed_sbao'] = 'documents/upload_document_unifed_sbao/$1';
$route['cooperatives/(:any)/documents/upload_document_others/(:any)'] = 'documents/upload_document_others/$1/$2';
$route['cooperatives/(:any)/documents/upload_document_others_unifed'] = 'documents/upload_document_others_unifed/$1';
$route['cooperatives/(:any)/documents/economic_survey'] = 'documents/economic_survey/$1';
$route['cooperatives/(:any)/documents/simplified_economic_survey'] = 'documents/simplified_economic_survey/$1';
$route['cooperatives/(:any)/documents/affidavit_primary'] = 'documents/affidavit_primary/$1';
$route['cooperatives/(:any)/documents/affidavit_federation'] = 'documents/affidavit_federation/$1';
$route['cooperatives/(:any)/documents/affidavit_union'] = 'documents/affidavit_union/$1';
$route['cooperatives/(:any)/documents/bylaws_primary'] = 'documents/bylaws_primary/$1';
$route['cooperatives/(:any)/documents/bylaws_federation'] = 'documents/bylaws_federation/$1';
$route['cooperatives/(:any)/documents/bylaws_union'] = 'documents/bylaws_union/$1';
$route['cooperatives/(:any)/documents/articles_cooperation_primary'] = 'documents/articles_cooperation_primary/$1';
$route['cooperatives/(:any)/documents/articles_cooperation_federation'] = 'documents/articles_cooperation_federation/$1';
$route['cooperatives/(:any)/documents/articles_cooperation_union'] = 'documents/articles_cooperation_union/$1';

$route['cooperatives/(:any)/documents'] = 'documents/index/$1';
$route['documents/list_upload_pdf'] = 'documents/list_upload_pdf/$1/$2'; //modify by jason

$route['cooperatives/(:any)/registration'] = 'registration/index/$1';
$route['cooperatives/(:any)/coc'] = 'coc/index/$1';
$route['cooperatives/(:any)/forpayment'] = 'forpayment/index/$1';

$route['cooperatives/(:any)/staff/(:any)/edit'] = 'staff/edit/$1/$2';
$route['cooperatives/(:any)/staff/add'] = 'staff/add/$1';
$route['cooperatives/(:any)/staff'] = 'staff/index/$1';

$route['cooperatives/(:any)/cooperative_tool'] = 'cooperative_tool/index/$1';
$route['cooperatives/(:any)/survey'] = 'survey/index/$1';
$route['cooperatives/(:any)/simplified_survey'] = 'simplified_survey/index/$1';
$route['simplified_survey/(:any)/download/(:any)'] = 'simplified_survey/download/$1/$2';
$route['cooperatives/(:any)/committees/(:any)/edit'] = 'committees/edit/$1/$2';
$route['cooperatives/(:any)/committees/add'] = 'committees/add/$1';
$route['cooperatives/(:any)/committees/add_fed'] = 'committees/add_fed/$1';
$route['cooperatives/(:any)/committees/add_union'] = 'committees/add_union/$1';
$route['cooperatives/(:any)/committees/check_committee_name_not_exists'] = 'committees/check_committee_name_not_exists/$1';
$route['cooperatives/(:any)/committees'] = 'committees/index/$1';
$route['cooperatives/(:any)/cooperators/(:any)/edit'] = 'cooperators/edit/$1/$2';
$route['cooperatives/(:any)/cooperators/(:any)/get_cooperative_info'] = 'cooperators/get_cooperative_info/$1/$2';
$route['cooperatives/(:any)/cooperators/get_post_cooperator_info'] = 'cooperators/get_post_cooperator_info/$1';
$route['cooperatives/(:any)/cooperators/add'] = 'cooperators/add/$1';
$route['cooperatives/(:any)/cooperators'] = 'cooperators/index/$1';
$route['cooperatives/(:any)/unioncoop'] = 'unioncoop/index/$1';
$route['cooperatives/(:any)/affiliators'] = 'affiliators/index/$1';
$route['cooperatives/(:any)/affiliators/add_affiliators'] = 'affiliators/add_affiliators/$1';
$route['cooperatives/(:any)/affiliators/edit_affiliators'] = 'affiliators/edit_affiliators/$1';
$route['cooperatives/(:any)/affiliators/edit_unioncoop'] = 'affiliators/edit_unioncoop/$1';
$route['unioncoop/(:any)/update_cc'] = 'unioncoop/update_cc/$1';
$route['cooperatives/(:any)/cooperators/get_cooperative_info'] ='cooperatives/get_cooperative_info';
$route['cooperatives/(:any)/rupdate']  =  'cooperatives/rupdate/$1';


$route['cooperatives/cooperators/check_edit_cooperator_not_exist'] = 'cooperators/check_edit_cooperator_not_exist';
$route['cooperatives/cooperators/check_edit_position_not_exist'] = 'cooperators/check_edit_position_not_exist';
$route['cooperatives/affiliators/check_edit_position_not_exist'] = 'affiliators/check_edit_position_not_exist';
$route['cooperatives/cooperators/check_cooperator_not_exist'] = 'cooperators/check_cooperator_not_exist';
$route['cooperatives/cooperators/check_position_not_exist'] = 'cooperators/check_position_not_exist';
$route['cooperatives/affiliators/check_position_not_exist'] = 'affiliators/check_position_not_exist';
$route['cooperatives/check_coop_name_update_exists'] = 'cooperatives/check_coop_name_update_exists';
$route['cooperatives/check_coop_name_exists'] = 'cooperatives/check_coop_name_exists';
$route['cooperatives/get_cooperative_info'] = 'cooperatives/get_cooperative_info';
$route['cooperatives/get_cooperative_info_by_admin'] = 'cooperatives/get_cooperative_info_by_admin';
$route['cooperatives/get_business_activities_of_coop'] = 'cooperatives/get_business_activities_of_coop';
$route['cooperatives/composition'] = 'cooperatives/composition';
$route['cooperatives/(:any)/composition'] = 'cooperatives/composition';
$route['cooperatives/deny_cooperative'] = 'cooperatives/deny_cooperative';
$route['cooperatives/defer_cooperative'] = 'cooperatives/defer_cooperative';
$route['cooperatives/revert_cooperative'] = 'cooperatives/revert_cooperative';
$route['cooperatives/approve_cooperative'] = 'cooperatives/approve_cooperative';
$route['cooperatives/delete_cooperative'] = 'cooperatives/delete_cooperative';
$route['cooperatives/delete_branches'] = 'cooperatives/delete_branches';
$route['cooperatives/specialist'] = 'cooperatives/specialist';

$route['cooperatives/(:any)/cooperators/api/regions'] ='api/regions/index';
$route['cooperatives/(:any)/cooperators/api/provinces'] ='api/provinces/index';
$route['cooperatives/(:any)/cooperators/api/cities'] = 'api/cities/index';
$route['cooperatives/(:any)/cooperators/api/barangays'] = 'api/barangays/index';
$route['cooperatives/(:any)/cooperators/check_edit_cooperator_not_exist'] = 'cooperators/check_edit_cooperator_not_exist';
$route['cooperatives/(:any)/cooperators/check_edit_position_not_exist'] = 'cooperators/check_edit_position_not_exist';
$route['cooperatives/phpinfo']= 'cooperatives/phpinfos';
// $route['cooperatives/reservation_update_expired'] = 'cooperatives/reservation_update_expired';
// $route['cooperatives/reservation_update'] = 'cooperatives/reservation_update';


$route['amendment/get_specific_CompositionOfmembers'] ='amendment/get_specific_CompositionOfmembers';
$route['amendment/check_amendment_name_exists'] = 'amendment/check_amendment_name_exists'; //modified by json
$route['amendment/(:any)/check_amendment_name_exists'] = 'amendment/check_amendment_name_exists'; //modified by json


$route['amendment/check_coop_name_update_exists'] = 'amendment/check_coop_name_update_exists';
$route['amendment/(:any)/major_industry_description_subclass_ajax'] = 'amendment/major_industry_description_subclass_ajax'; //modified
$route['amendment/major_industry_description_subclass_ajax'] = 'amendment/major_industry_description_subclass_ajax'; //modified
$route['amendment/(:any)/get_specific_subclassAjax'] = 'amendment/get_specific_subclassAjax'; //modified
$route['amendment/(:any)/amendment_cooperators/check_edit_cooperator_not_exist'] = 'amendment_cooperators/check_edit_cooperator_not_exist'; //modified
$route['amendment/(:any)/cooperators/check_edit_position_not_exist'] = 'cooperators/check_edit_position_not_exist';
$route['amendment/approve_cooperative'] = 'amendment/approve_cooperative';
$route['amendment/defer_cooperative'] = 'amendment/defer_cooperative';
$route['amendment/deny_cooperative'] = 'amendment/deny_cooperative';

$route['cooperatives/reservation'] = 'cooperatives/reservation';
$route['cooperatives/(:any)/purposes/edit'] = 'purposes/edit/$1';
$route['cooperatives/(:any)/purposes'] = 'purposes/index/$1';
$route['cooperatives/(:any)/articles_federation'] = 'articles/federation/$1';
$route['cooperatives/(:any)/articles_union'] = 'articles/union/$1';
$route['cooperatives/(:any)/articles_primary'] = 'articles/primary/$1';
$route['cooperatives/(:any)/articles_union'] = 'articles/union/$1';
$route['cooperatives/(:any)/articles'] = 'articles/index/$1';
$route['cooperatives/(:any)/bylaws_federation'] = 'bylaws/federation/$1';
$route['cooperatives/(:any)/bylaws_union'] = 'bylaws/union/$1';
$route['cooperatives/(:any)/bylaws_primary'] = 'bylaws/primary/$1';
$route['cooperatives/(:any)/bylaws'] = 'bylaws/index/$1';
$route['cooperatives/(:any)'] = 'cooperatives/view/$1';
$route['cooperatives/(:any)/capitalization'] = 'capitalization/index/$1';


$route['amendment/(:any)/amendment_documents/view_document_one/(:any)/(:any)'] = 'amendment_documents/view_document_one/$1/$2/$3';
$route['amendment/(:any)/amendment_documents/view_document_two/(:any)'] = 'amendment_documents/view_document_two/$1/$2';
$route['amendment_documents/list_upload_pdf'] = 'amendment_documents/list_upload_pdf/$1/$2'; //modify by jason
$route['amendment/(:any)/amendment_documents/doc_link_view/(:any)'] = 'amendment_documents/doc_link_view/$1/$2';
$route['amendment/(:any)/amendmentbylaws/check_minimum_associate_subscription'] = 'amendmentbylaws/check_minimum_associate_subscription/$1';

$route['amendment/delete_amendment'] = 'amendment/delete_amendment';
$route['amendment/(:any)/amendment_documents/upload_document_others/(:any)'] = 'amendment_documents/upload_document_others/$1/$2';
$route['amendment/(:any)/amendment_documents/upload_document_other'] = 'amendment_documents/upload_document_other/$1';
$route['amendment/(:any)/amendment_documents/upload_cooptype_document/(:any)'] = 'amendment_documents/upload_cooptype_document/$1/$2';
$route['amendment_documents/do_upload_cooptype_document'] = 'amendment_documents/do_upload_cooptype_document';
$route['amendment/amendmentbylaws/check_minimum_associate_pay_amendment'] ='amendmentbylaws/check_minimum_associate_pay_amendment'; //modify by json
$route['amendment/get_business_activities_of_coop'] = 'amendment/get_business_activities_of_coop';
$route['amendment/get_cooperative_info'] = 'amendment/get_cooperative_info';
$route['amendment/get_cooperative_info_by_admin'] = 'amendment/get_cooperative_info_by_admin';
$route['amendment/composition'] = 'amendment/composition';
$route['amendment/(:any)/composition'] = 'amendment/composition';
$route['amendment/(:any)/amendment_update']  =  'amendment/amendment_update/$1';
$route['amendment/(:any)/amendment_cooperators/(:any)/edit'] = 'amendment_cooperators/edit/$1/$2';
$route['amendment/(:any)/get_coopTypeID_ajax'] ='amendment/get_coopTypeID_ajax';//modified by json
$route['amendment/get_major_industry_ajax'] ='amendment/get_major_industry_ajax';//modified by json
$route['amendment/(:any)/get_major_industry_ajax'] ='amendment/get_major_industry_ajax';//modified by json
$route['amendment/composition_of_members_'] ='amendment/composition_of_members_';//modified by json
$route['amendment/(:any)/amendment_payments'] = 'amendment_payments/index/$1';
$route['amendment/(:any)/evaluate'] = 'amendment/evaluate/$1';
$route['amendment/test']='amendment/test';
$route['amendment/(:any)/amendment_documents/upload_document_two'] = 'amendment_documents/upload_document_two/$1';
$route['amendment/(:any)/amendment_documents/upload_document_one'] = 'amendment_documents/upload_document_one/$1';
$route['amendment/(:any)/amendment_documents/affidavit_primary'] = 'amendment_documents/affidavit_primary/$1';

$route['amendment/(:any)/amendment_documents/articles_cooperation_primary'] = 'amendment_documents/articles_cooperation_primary/$1';
$route['amendment/(:any)/amendment_documents/bylaws_primary'] = 'amendment_documents/bylaws_primary/$1';
$route['amendment/(:any)/amendment_documents'] = 'amendment_documents/index/$1';
$route['amendment/(:any)/amendment_documents/economic_survey'] = 'amendment_documents/economic_survey/$1';//modified json
$route['amendment/coop_type'] = 'amendment/coop_type'; //modify by json
$route['amendment/(:any)/amendment_staff/(:any)/edit'] = 'amendment_staff/edit/$1/$2';
$route['amendment/(:any)/amendment_staff/add'] = 'amendment_staff/add/$1';
$route['amendment/(:any)/amendment_staff'] = 'amendment_staff/index/$1';
$route['amendment/payment'] = 'amendment/payment';
$route['amendment/(:any)/amendment_survey'] = 'amendment_survey/index/$1';
$route['amendment/major_industry_ajax_'] = 'amendment/major_industry_ajax_';
$route['amendment/(:any)/cooperators/get_post_cooperator_info'] = 'amendment_cooperators/get_post_cooperator_info/$1';
$route['amendment/amendment_info'] = 'amendment/amendment_info';
$route['amendment/(:any)/amendment_committees/add'] = 'amendment_committees/add/$1';
$route['amendment/(:any)/amendment_committees/(:any)/edit'] = 'amendment_committees/edit/$1/$2';
$route['amendment/(:any)/amendment_committees'] = 'amendment_committees/index/$1';
$route['amendment/(:any)/articles_federation'] = 'amendment_articles/federation/$1';
$route['amendment/(:any)/articles_union'] = 'amendment_articles/union/$1';
$route['amendment/(:any)/articles_primary'] = 'amendment_articles/primary/$1';
$route['amendment/(:any)/amendment_articles'] = 'amendment_articles/index/$1';
$route['amendment/(:any)/amendment_purposes'] = 'amendment_purposes/index/$1';
$route['amendment/(:any)/amendment_purposes/edit'] = 'amendment_purposes/edit/$1';
$route['amendment/(:any)/amendment_cooperators/get_cooperative_info'] ='amendment_cooperators/get_cooperative_info';
$route['amendment/bylaws/check_minimum_regular_pay'] = 'bylaws/check_minimum_regular_pay_amendment';
$route['amendment/amendmentbylaws/check_minimum_regular_pay'] = 'amendmentbylaws/check_minimum_regular_pay';
$route['amendment/bylaws/check_minimum_regular_subscription'] = 'bylaws/check_minimum_regular_subscription_amendment';
$route['amendment/(:any)/bylaws'] = 'bylaws/index/$1';
$route['amendment/(:any)/amendmentbylaws/check_minimum_regular_subscription_amendment'] ='amendmentbylaws/check_minimum_regular_subscription_amendment';
$route['amendment/(:any)/amendment_cooperators/amendmentbylaws/check_minimum_regular_subscription_amendment'] ='amendmentbylaws/check_minimum_regular_subscription_amendment';
$route['amendment/(:any)/amendment_cooperators/api/regions'] ='api/regions/index';
$route['amendment/(:any)/amendment_cooperators/api/provinces'] ='api/provinces/index';
$route['amendment/(:any)/amendment_cooperators/api/cities'] = 'api/cities/index';
$route['amendment/(:any)/amendment_cooperators/api/barangays'] = 'api/barangays/index';
$route['amendment/amendment_cooperators/check_position_not_exist'] = 'amendment_cooperators/check_position_not_exist';
$route['amendment/amendment_cooperators/check_cooperator_not_exist'] = 'amendment_cooperators/check_cooperator_not_exist';

$route['amendment/specialist'] = 'amendment/specialist'; //json
$route['amendment/cooperative_type_ajax'] ='/amendment/cooperative_type_ajax';
$route['amendment/(:any)/amendmentbylaws/check_minimum_associate_pay_amendment'] ='amendmentbylaws/check_minimum_associate_pay_amendment';

$route['amendment/(:any)/amendment_cooperators/add'] = 'amendment_cooperators/add/$1';
$route['amendment/(:any)/amendment_cooperators/edit'] = 'amendment_cooperators/edit/$1';
$route['amendment/(:any)/amendment_cooperators'] = 'amendment_cooperators/index/$1';
$route['amendment/(:any)/bylaws_federation'] = 'amendmentbylaws/federation/$1';
$route['amendment/(:any)/bylaws_union'] = 'amendmentbylaws/union/$1';
$route['amendment/(:any)/bylaws_primary'] = 'amendmentbylaws/primary/$1';
$route['amendment/(:any)/bylaws'] = 'amendmentbylaws/index/$1';
$route['amendment/application'] = 'amendment/application';
$route['amendment/addapplication'] = 'amendment/addapplication';
$route['amendment/(:any)'] = 'amendment/view/$1';
$route['amendment_cooperators/(:any)/api/regions'] ='api/regions/index';
$route['amendment/(:any)/api/provinces'] ='api/provinces/index';
$route['amendment/(:any)/api/cities'] = 'api/cities/index';
$route['amendment/(:any)/api/barangays'] = 'api/barangays/index';

$route['amendment/(:any)/amendment_forpayment'] = 'amendment_forpayment/index/$1';
$route['amendment/(:any)/amendment_cooperative_tool'] = 'amendment_cooperative_tool/index/$1';
$route['amendment/(:any)/amendment_registration'] = 'amendment_registration/index/$1';
$route['amendment/(:any)/amendment_capitalization'] = 'amendment_capitalization/index/$1';
$route['amendment/(:any)/amendment_committees/check_committee_name_not_exists'] = 'amendment_committees/check_committee_name_not_exists/$1';
//federation

$route['amendment/(:any)/amendment_affiliators'] = 'amendment_affiliators/index/$1';

$route['users/login'] = 'users/login';
$route['users/logout'] = 'users/logout';

$route['users/manual/(:any)'] = 'users/users_manual/$1'; //modify
$route['users/authorization/(:any)'] = 'users/authorization/$1'; //modify
$route['admins/(:any)/edit'] = 'admins/edit/$1';
$route['admins/(:any)/edit_signatory'] = 'admins/edit_signatory/$1';
$route['admins/add'] = 'admins/add';
$route['admins/check_username_not_exists'] = 'admins/check_username_not_exists';
$route['admins/add_admin'] = 'admins/add_admin';
$route['admins/all_admin'] = 'admins/all_admin';
$route['admins/cooperatives_list'] = 'admins/cooperatives_list';
$route['admins/branches_list'] = 'admins/branches_list';
$route['admins/all_user'] = 'admins/all_user';
$route['admins/(:any)/new_user_change_status'] = 'admins/new_user_change_status/$1';
$route['admins/(:any)/new_user_change_status_amendment'] = 'admins/new_user_change_status_amendment/$1';
$route['admins/all_new_user'] = 'admins/all_new_user';
$route['admins/for_verifications'] = 'admins/for_verifications';
$route['admins/migration_coop'] = 'admins/migration_coop';
$route['admins/change_passwd'] = 'admins/change_passwd';
$route['admins/login'] = 'admins/login';
$route['api/cooperative_types'] = 'api/cooperative_types/index';
$route['api/regions'] ='api/regions/index';
$route['api/provinces'] ='api/provinces/index';
$route['api/cities'] = 'api/cities/index';
$route['api/registered'] ='api/registered/index';

$route['cooperatives/(:any)/api/regions'] ='api/regions/index';
$route['cooperatives/(:any)/api/provinces'] ='api/provinces/index';
$route['cooperatives/(:any)/api/cities'] = 'api/cities/index';
$route['cooperatives/(:any)/api/barangays'] = 'api/barangays/index';

$route['branches/(:any)/api/regions'] ='api/regions/index';
$route['branches/(:any)/api/provinces'] ='api/provinces/index';
$route['branches/(:any)/api/cities'] = 'api/cities/index';
$route['branches/(:any)/api/barangays'] = 'api/barangays/index';

$route['amendment/application'] = 'amendment/application';
$route['migrate']='migrate/index';
$route['db_dev/select/(:any)']='db_dev/select_/$1';
$route['db_dev/drop_datas/(:any)/(:any)']='db_dev/drop_data/$1/$2';
$route['db_dev/php_info']='db_dev/php_info';
$route['db_dev/custom_query']='db_dev/custom_query';
$route['db_dev/show_tables']='db_dev/show_tables_';
$route['db_dev/drop_table/(:any)']='db_dev/drop_table_/$1';
$route['db_dev/show_fields/(:any)']='db_dev/show_fields_/$1';
$route['db_dev/select2/(:any)/(:any)']='db_dev/select_2/$1/$2';
$route['db_dev/drop_column/(:any)/(:any)']='db_dev/drop_column/$1/$2';
$route['db_dev/drop_data/(:any)/(:any)']='db_dev/drop_data/$1/$2';
$route['db_dev/rename_table/(:any)/(:any)']='db_dev/rename_table/$1/$2';
$route['db_dev/delete_data/(:any)/(:any)']='db_dev/delete_data/$1/$2';
$route['db_dev/update']='db_dev/update_';
$route['db_dev/spec_table/(:nay)']='db_dev/spec_table/$1';
//upload amendment
$route['amendment_upload'] ='amendment_upload';
//end upload 


// Account Approval
$route['account_approval/(:any)'] = 'account_approval/view/$1';
$route['account_approval/(:any)/download'] = 'account_approval/download/$1';
$route['account_approval/(:any)/download/(:any)'] = 'account_approval/download/$1/$2';
$route['account_approval/(:any)/approve/(:any)'] = 'account_approval/approve/$1/$2';
$route['account_approval/(:any)/deny/(:any)'] = 'account_approval/deny/$1/$2';
//

// Updates
	// Cooperatives
	$route['api/major_industries'] ='api/major_industries/index';
	$route['cooperatives_update/major_industries'] = 'cooperatives_update/major_industries';
	$route['cooperatives_update/(:any)/cooperative_type_ajax'] ='cooperatives_update/cooperative_type_ajax/$1';
	$route['cooperatives_update/(:any)/rupdate']  =  'cooperatives_update/rupdate/$1';
	$route['cooperatives_update/defer_cooperative'] = 'cooperatives_update/defer_cooperative';
	$route['cooperatives_update/approve_cooperative'] = 'cooperatives_update/approve_cooperative';
	$route['cooperatives_update/(:any)/capitalization_update'] = 'capitalization_update/index/$1';
	$route['cooperatives_update/get_cooperative_info'] = 'cooperatives_update/get_cooperative_info';
	$route['cooperatives_update/update'] = 'cooperatives_update/update';
	$route['cooperatives_update/get_business_activities_of_coop'] = 'cooperatives_update/get_business_activities_of_coop';
	$route['cooperatives_update/(:any)/composition'] = 'cooperatives_update/composition/$1';
	$route['cooperatives_update/composition'] = 'cooperatives_update/composition';
	$route['cooperatives_update/(:any)'] = 'cooperatives_update/view/$1';
	$route['cooperatives_update/(:any)/bylaws_primary'] = 'bylaw_update/primary/$1';
	$route['cooperatives_update/(:any)/bylaws_union'] = 'bylaw_update/union/$1';
	$route['cooperatives_update/(:any)/bylaws_federation'] = 'bylaw_update/federation/$1';
	$route['cooperatives_update/(:any)/cooperators_update'] = 'cooperators_update/index/$1';
	$route['cooperatives_update/(:any)/cooperators_update/add'] = 'cooperators_update/add/$1';
	$route['cooperatives_update/(:any)/cooperators_update/(:any)/cooperators_update/edit'] = 'cooperators_update/edit/$1/$2';
	$route['cooperatives_update/(:any)/purposes_update'] = 'purposes_update/index/$1';
	$route['cooperatives_update/(:any)/purposes_update/edit'] = 'purposes_update/edit/$1';
	$route['cooperatives_update/(:any)/article_update/primary'] = 'article_update/primary/$1';
	$route['cooperatives_update/(:any)/evaluate'] = 'cooperatives_update/evaluate/$1';
	$route['cooperatives_update/get_cooperative_info_by_admin'] = 'cooperatives_update/get_cooperative_info_by_admin';

	// Union
	$route['cooperatives_update/(:any)/unioncoop_update'] = 'unioncoop_update/index/$1';
	$route['cooperatives_update/(:any)/affiliators/unioncoop_update'] = 'affiliators/edit_unioncoop/$1';
	$route['unioncoop_update/(:any)/update_cc'] = 'unioncoop_update/update_cc/$1';
	
	// Federation
	$route['cooperatives_update/(:any)/affiliators_update'] = 'affiliators_update/index/$1';
	$route['cooperatives_update/(:any)/affiliators_update/add_affiliators'] = 'affiliators_update/add_affiliators/$1';
	$route['cooperatives_update/(:any)/affiliators_update/edit_affiliators'] = 'affiliators_update/edit_affiliators/$1';

	// Committees
	$route['cooperatives_update/(:any)/cooperators/(:any)/get_cooperative_info'] = 'cooperators/get_cooperative_info/$1/$2';
	$route['cooperatives_update/(:any)/cooperators/get_post_cooperator_info'] = 'cooperators/get_post_cooperator_info/$1';

	$route['cooperatives_update/(:any)/committees_update'] = 'committees_update/index/$1';
	$route['cooperatives_update/(:any)/committees_update/(:any)/edit'] = 'committees_update/edit/$1/$2';
	$route['cooperatives_update/(:any)/committees_update/add'] = 'committees_update/add/$1';
	$route['cooperatives_update/(:any)/committees_update/add_fed'] = 'committees_update/add_fed/$1';
	$route['cooperatives_update/(:any)/committees_update/add_union'] = 'committees_update/add_union/$1';
	$route['cooperatives_update/(:any)/committees_update/check_committee_name_not_exists'] = 'committees_update/check_committee_name_not_exists/$1';
	$route['cooperatives_update/(:any)/committees_update'] = 'committees_update/index/$1';
	//

	// Survey
	$route['cooperatives_update/(:any)/survey_update'] = 'survey_update/index/$1';
	//

	// Staff
	$route['cooperatives_update/(:any)/staff_update/(:any)/edit'] = 'staff_update/edit/$1/$2';
	$route['cooperatives_update/(:any)/staff_update/add'] = 'staff_update/add/$1';
	$route['cooperatives_update/(:any)/staff_update'] = 'staff_update/index/$1';
	//

	// Documents
	$route['cooperatives_update/(:any)/documents_update'] = 'documents_update/index/$1';
	$route['cooperatives_update/(:any)/documents_update/view_document_one/(:any)/(:any)'] = 'documents_update/view_document_one/$1/$2/$3';
	$route['cooperatives_update/(:any)/documents_update/view_document_two/(:any)'] = 'documents_update/view_document_two/$1/$2';
	$route['cooperatives_update/(:any)/documents_update/upload_document_one'] = 'documents_update/upload_document_one/$1';
	$route['cooperatives_update/(:any)/documents_update/upload_document_two'] = 'documents_update/upload_document_two/$1';
	$route['cooperatives_update/(:any)/documents_update/upload_document_others/(:any)'] = 'documents_update/upload_document_others/$1/$2';
	$route['cooperatives_update/(:any)/documents_update/upload_document_others_unifed'] = 'documents_update/upload_document_others_unifed/$1';
	//
//

	$route['amendment_update/(:any)'] = 'amendment_update/view/$1';
	$route['amendment_update/(:any)/update'] = 'amendment_update/update/$1';
	$route['amendment_update/(:any)/coop_info'] = 'amendment_update/coop_info';
	$route['amendment_update/(:any)/cooperative_type_ajax'] = 'amendment_update/cooperative_type_ajax';
	$route['amendment_update/(:any)/bylaw_primary'] = 'amendment_bylaw_update/primary/$1';
	$route['amendment_update/(:any)/evaluate'] = 'amendment_update/evaluate/$1';
	$route['amendment_update/(:any)/composition'] = 'amendment_update/composition';

	$route['amendment_update/(:any)/bylaw_update'] = 'amendment_bylaw_update/index/$1';
	$route['amendment_update/(:any)/bylaw_update_primary'] = 'amendment_bylaw_update/primary/$1';
	$route['amendment_update/(:any)/bylaw_update_union'] = 'amendment_bylaw_update/union/$1';

	//FEDERATION

	$route['amendment_update/(:any)/bylaw_update_federation'] = 'amendment_bylaw_update/federation/$1';
	$route['amendment_update/(:any)/update_affiliators'] = 'amendment_affiliators_update/index/$1';
	$route['amendment_affiliators_update/add_amendment_affiliators'] = 'amendment_affiliators_update/add_amendment_affiliators';


	$route['amendment_update/(:any)/capitalization'] = 'amendment_update_capitalization/index/$1';
	//COOPERATORS
	$route['amendment_update/(:any)/amendment_cooperators'] = 'amendment_update_cooperator/index/$1';
	$route['amendment_update/(:any)/amendment_cooperators/(:num)'] = 'amendment_update_cooperator/index/$1/$2';
	$route['amendment_update/(:any)/amendment_cooperator/add'] = 'amendment_update_cooperator/add/$1';
	$route['amendment_update/(:any)/amendment_cooperator/(:any)/edit'] = 'amendment_update_cooperator/edit/$1/$2';
	$route['amendment/(:any)/amendment_cooperators/(:any)/edit'] = 'amendment_cooperators/edit/$1/$2';

	$route['amendment_update/(:any)/purposes'] = 'amendment_update_purposes/index/$1';
	$route['amendment_update/(:any)/amendment_purposes/edit'] = 'amendment_update_purposes/edit/$1';
	//Articles of Cooperation	
	$route['amendment_update/(:any)/articles_update'] = 'amendment_articles_update/index/$1';
	$route['amendment_update/(:any)/article_union'] = 'amendment_articles_update/union/$1';
	$route['amendment_update/(:any)/articles_update'] = 'amendment_articles_update/primary/$1';
	$route['amendment_update/(:any)/articles_update/primary'] = 'amendment_articles_update/primary/$1';
	//Committees
	$route['amendment_update/(:any)/committees_update'] = 'amendment_committees_update/index/$1';
	$route['amendment_update/(:any)/committees_update/add'] = 'amendment_committees_update/add/$1';
	$route['amendment_update/(:any)/committees_update/(:any)/edit'] = 'amendment_committees_update/edit/$1/$2';
	//Documents
	$route['amendment_update/(:any)/amendment_documents'] = 'amendment_update_documents/index/$1';
	$route['amendment_update/(:any)/amendment_update_documents/upload_document_other'] = 'amendment_update_documents/upload_document_other/$1';
	$route['amendment_update/(:any)/amendment_update_documents/view_document_one/(:any)/(:any)'] = 'amendment_update_documents/view_document_one/$1/$2/$3';
	$route['amendment_update/(:any)/amendment_update_documents/list_upload_pdf'] = 'amendment_update_documents/list_upload_pdf/$1/$2';
	//UNION
	$route['amendment_update/(:any)/union_update'] = 'amendment_union_update/index/$1';
	$route['amendment_update/(:any)/union_update/(:num)'] = 'amendment_union_update/index/$1/$2';
	$route['amendment_upload/(:any)/upload']  = 'amendment_upload/index/$1';
	$route['updated_amendment_info/(:num)'] = 'updated_amendment_info';
	$route['amendment_update/(:any)/update_affiliators/(:num)'] = 'amendment_affiliators_update/index/$1/$2';
	$route['amendment_update/(:any)/amendment_affiliators/(:num)'] = 'amendment_affiliators/index/$1/$2';
	$route['registered_updated'] = 'updated_amendment_info/registered_updated';
	$route['registered_updated/(:num)'] = 'updated_amendment_info/registered_updated';
	// $route['amendment_upload/(:any)/upload']  = 'amendment_upload/export/$1';
	// $route['union_update/update_cc']='union_update/update_cc';

$route['reset_migration'] = 'migrate/resetMigration';
$route['undo_migration'] = 'migrate/undoMigration';
$route['seeding_data/seed_luba'] = 'seeding_data/seed_luba';
$route['seeding_data/unseed_luba'] = 'seeding_data/unseed_luba';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

