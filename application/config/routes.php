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
$route['default_controller'] = 'welcome';

$route['branches/(:any)/documents/bylaws_primary_branch'] = 'documents/bylaws_primary_branch/$1';
$route['branches/(:any)/documents/articles_cooperation_primary_branch'] = 'documents/articles_cooperation_primary_branch/$1';
$route['branches/(:any)/documents/affidavit_primary_bs'] = 'documents/affidavit_primary_bs/$1';

$route['branches/payment/(:any)'] = 'branches/payment/$1';
$route['branches/get_branch_info'] = 'branches/get_branch_info';
$route['branches/registration'] = 'branches/registration';
$route['branches/(:any)/Payments_branch'] = 'Payments_branch/index/$1';
$route['branches/specialist'] = 'branches/specialist';
$route['branches/deny_branch'] = 'branches/deny_branch';
$route['branches/defer_branch'] = 'branches/defer_branch';
$route['branches/approve_branch'] = 'branches/approve_branch';
$route['branches/(:any)'] = 'branches/view/$1';
$route['branches/(:any)/cooperative_tool/branch']='cooperative_tool/branch/$1';
$route['branches/(:any)/bupdate']  =  'branches/bupdate/$1';
$route['branches/(:any)/composition'] = 'branches/composition';
$route['branches/delete_branches'] = 'branches/delete_branches';
$route['branches/business_activity/(:any)'] = 'branches/business_activity/$1';
$route['branches/coop_info/(:any)'] = 'branches/coop_info/$1';

$route['branches/(:any)/documents'] = 'documents/branch/$1';
$route['branches/(:any)/documents/view_document_one/(:any)'] = 'documents/view_document_one/$1/$2';
$route['branches/(:any)/documents/view_document_one_branch/(:any)/(:any)'] = 'documents/view_document_one_branch/$1/$2/$3';
$route['branches/(:any)/documents/view_document_two/(:any)'] = 'documents/view_document_two/$1/$2';
$route['branches/(:any)/documents/upload_document_5'] = 'documents/upload_document_5/$1';
$route['branches/(:any)/documents/upload_document_6'] = 'documents/upload_document_6/$1';
$route['branches/(:any)/documents/upload_document_7'] = 'documents/upload_document_7/$1';
$route['branches/(:any)/documents/upload_document_8'] = 'documents/upload_document_8/$1';
$route['branches/(:any)/documents/upload_document_9'] = 'documents/upload_document_9/$1';
$route['branches/(:any)/documents/(:any)/view_document_5/(:any)'] = 'documents/view_document_5/$1/$2/$3';
$route['branches/(:any)/documents/(:any)/view_document_6/(:any)'] = 'documents/view_document_6/$1/$2/$3';
$route['branches/(:any)/documents/(:any)/view_document_7/(:any)'] = 'documents/view_document_7/$1/$2/$3';
$route['branches/(:any)/documents/(:any)/view_document_8/(:any)'] = 'documents/view_document_8/$1/$2/$3';
$route['branches/(:any)/documents/(:any)/view_document_9/(:any)'] = 'documents/view_document_9/$1/$2/$3';
$route['branches/(:any)/evaluate'] = 'branches/evaluate/$1';
$route['branches/(:any)/registration'] = 'registration/branch/$1';
$route['branches/get_cooperative_info'] = 'branches/get_cooperative_info';
$route['branches/(:any)/forpaymentbranches'] = 'forpaymentbranches/index/$1';


$route['laboratories/approve_laboratories_2'] ='Laboratories/approve_laboratories_2'; //modify
$route['laboratories/payment'] = 'Laboratories/payment'; //modify by
$route['laboratories/deny_laboratory'] = 'laboratories/deny_laboratory';//modify by json
$route['laboratories/defer_laboratory'] = 'laboratories/defer_laboratory';//modify by json
$route['laboratories/registration'] = 'laboratories/registration';
$route['laboratories/get_cooperative_info'] = 'laboratories/get_cooperative_info';//modify
$route['laboratories/(:any)'] = 'laboratories/view/$1';
$route['laboratories/(:any)/laboratories_cooperators'] = 'laboratories_cooperators/index/$1';
$route['laboratories/(:any)/laboratories_cooperators/add'] = 'laboratories_cooperators/add/$1';
$route['laboratories_cooperators/(:any)/api/regions'] ='api/regions/index';
$route['laboratories_cooperators/(:any)/api/provinces'] ='api/provinces/index';
$route['laboratories/(:any)/api/provinces'] ='api/provinces/index';
$route['laboratories/(:any)/api/cities'] = 'api/cities/index';
$route['laboratories/(:any)/api/barangays'] = 'api/barangays/index';
$route['laboratories/(:any)/laboratories_cooperators/get_cooperative_info'] ='laboratories_cooperators/get_cooperative_info';
$route['laboratories/(:any)/laboratories_cooperators/get_cooperative_info_edit'] ='laboratories_cooperators/get_cooperative_info_edit'; //modify by jayson
$route['laboratories/(:any)/laboratories_cooperators/cooperative_info_details'] ='laboratories_cooperators/cooperative_info_details'; //modify by jayson


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
$route['laboratories/specialist'] = 'laboratories/specialist';
$route['laboratories/(:any)/cooperative_tool'] = 'cooperative_tool/index/$1';

$route['laboratories/(:any)/laboratories_payments_branch'] = 'laboratories_payments_branch/index/$1';
$route['laboratories/(:any)/laboratories_forpayment'] = 'laboratories_forpayment/index/$1';
$route['laboratories/(:any)/rupdate'] = 'laboratories/rupdate/$1';  //modify
$route['laboratories/delete_laboratory'] = 'laboratories/delete_laboratory';  //modify
$route['laboratories/(:any)/laboratories_registration'] = 'laboratories_registration/index/$1';
$route['laboratories/(:any)/UploadDocuments']= 'laboratories/UploadDocuments/$1'; //modify
$route['laboratories/(:any)/documents/upload_manual_operation/(:any)']= 'documents/upload_manual_operation/$1/$2'; //modify
$route['laboratories/(:any)/documents/view_document_laboratory/(:any)/(:any)'] = 'documents/view_document_laboratory/$1/$2/$3';//modify
$route['laboratories/(:any)/laboratories_documents/view_document_one_lab3/(:any)/(:any)'] = 'laboratories_documents/view_document_one_lab3/$1/$2/$3';//modify



$route['laboratories/(:any)/laboratories_documents/view_document_one_lab/(:any)/(:any)'] = 'laboratories_documents/view_document_one_lab/$1/$2/$3';//modify

$route['laboratories/(:any)/laboratories_documents/document_view_review'] = 'laboratories_documents/document_view_review/$1';//modify
$route['laboratories/(:any)/laboratories_documents/bylaws_primary'] = 'laboratories_documents/bylaws_primary/$1';//modify
$route['laboratories/(:any)/laboratories_documents/articles_cooperation_primary'] = 'laboratories_documents/articles_cooperation_primary/$1';//modify
$route['laboratories/(:any)/laboratories_documents/affidavit_primary_lab'] = 'laboratories_documents/affidavit_primary_lab/$1';//modify
$route['laboratories/(:any)/laboratories_documents/economic_survey_lab'] = 'laboratories_documents/economic_survey_lab/$1';//modify

$route['amendment/(:any)/amendment_cooperators/check_edit_position_not_exist'] = 'amendment_cooperators/check_edit_position_not_exist';
$route['amendment/(:any)/amendment_cooperators/get_post_cooperator_info_ajax'] = 'amendment_cooperators/get_post_cooperator_info_ajax';
//$route['laboratories/deny_cooperative'] = 'laboratories/deny_cooperative';
//$route['laboratories/defer_cooperative'] = 'laboratories/defer_cooperative';


$route['bylaws/(:any)/union'] = 'bylaws/union/$1';
$route['cooperatives/approve_laboratories'] = 'cooperatives/approve_laboratories';
$route['cooperatives/bylaws/check_minimum_regular_subscription'] = 'bylaws/check_minimum_regular_subscription';
$route['cooperatives/bylaws/check_minimum_regular_pay'] = 'bylaws/check_minimum_regular_pay';
$route['cooperatives/bylaws/check_minimum_associate_subscription'] = 'bylaws/check_minimum_associate_subscription';
$route['cooperatives/bylaws/check_minimum_associate_pay'] = 'bylaws/check_minimum_associate_pay';
$route['cooperatives/(:any)/payments'] = 'payments/index/$1';
$route['cooperatives/(:any)/evaluate'] = 'cooperatives/evaluate/$1';
// $route['cooperatives/(:any)/documents/view_document_one/(:any)'] = 'documents/view_document_one/$1/$2';
//modiy by json
$route['cooperatives/(:any)/documents/view_document_one/(:any)/(:any)'] = 'documents/view_document_one/$1/$2/$3';
$route['cooperatives/(:any)/documents/view_document_two/(:any)'] = 'documents/view_document_two/$1/$2';
$route['cooperatives/(:any)/documents/upload_document_one'] = 'documents/upload_document_one/$1';
$route['cooperatives/(:any)/documents/upload_document_two'] = 'documents/upload_document_two/$1';
$route['cooperatives/(:any)/documents/upload_document_others/(:any)'] = 'documents/upload_document_others/$1/$2';
$route['cooperatives/(:any)/documents/economic_survey'] = 'documents/economic_survey/$1';
$route['cooperatives/(:any)/documents/affidavit_primary'] = 'documents/affidavit_primary/$1';
$route['cooperatives/(:any)/documents/affidavit_federation'] = 'documents/affidavit_federation/$1';
$route['cooperatives/(:any)/documents/bylaws_primary'] = 'documents/bylaws_primary/$1';
$route['cooperatives/(:any)/documents/bylaws_federation'] = 'documents/bylaws_federation/$1';
$route['cooperatives/(:any)/documents/articles_cooperation_primary'] = 'documents/articles_cooperation_primary/$1';
$route['cooperatives/(:any)/documents/articles_cooperation_federation'] = 'documents/articles_cooperation_federation/$1';

$route['cooperatives/(:any)/documents'] = 'documents/index/$1';
$route['documents/list_upload_pdf'] = 'documents/list_upload_pdf/$1/$2'; //modify by jason

$route['cooperatives/(:any)/registration'] = 'registration/index/$1';
$route['cooperatives/(:any)/forpayment'] = 'forpayment/index/$1';

$route['cooperatives/(:any)/staff/(:any)/edit'] = 'staff/edit/$1/$2';
$route['cooperatives/(:any)/staff/add'] = 'staff/add/$1';
$route['cooperatives/(:any)/staff'] = 'staff/index/$1';

$route['cooperatives/(:any)/cooperative_tool'] = 'cooperative_tool/index/$1';
$route['cooperatives/(:any)/survey'] = 'survey/index/$1';
$route['cooperatives/(:any)/committees/(:any)/edit'] = 'committees/edit/$1/$2';
$route['cooperatives/(:any)/committees/add'] = 'committees/add/$1';
$route['cooperatives/(:any)/committees/check_committee_name_not_exists'] = 'committees/check_committee_name_not_exists/$1';
$route['cooperatives/(:any)/committees'] = 'committees/index/$1';
$route['cooperatives/(:any)/cooperators/(:any)/edit'] = 'cooperators/edit/$1/$2';
$route['cooperatives/(:any)/cooperators/(:any)/get_cooperative_info'] = 'cooperators/get_cooperative_info/$1/$2';
$route['cooperatives/(:any)/cooperators/get_post_cooperator_info'] = 'cooperators/get_post_cooperator_info/$1';
$route['cooperatives/(:any)/cooperators/add'] = 'cooperators/add/$1';
$route['cooperatives/(:any)/cooperators'] = 'cooperators/index/$1';
$route['cooperatives/(:any)/affiliators'] = 'affiliators/index/$1';
$route['cooperatives/(:any)/affiliators/add_affiliators'] = 'affiliators/add_affiliators/$1';
$route['cooperatives/(:any)/cooperators/get_cooperative_info'] ='cooperatives/get_cooperative_info';
$route['cooperatives/(:any)/rupdate']  =  'cooperatives/rupdate/$1';

$route['cooperatives/cooperators/check_edit_cooperator_not_exist'] = 'cooperators/check_edit_cooperator_not_exist';
$route['cooperatives/cooperators/check_edit_position_not_exist'] = 'cooperators/check_edit_position_not_exist';

$route['cooperatives/cooperators/check_cooperator_not_exist'] = 'cooperators/check_cooperator_not_exist';
$route['cooperatives/cooperators/check_position_not_exist'] = 'cooperators/check_position_not_exist';
$route['cooperatives/check_coop_name_update_exists'] = 'cooperatives/check_coop_name_update_exists';
$route['cooperatives/check_coop_name_exists'] = 'cooperatives/check_coop_name_exists';
$route['cooperatives/get_cooperative_info'] = 'cooperatives/get_cooperative_info';
$route['cooperatives/get_cooperative_info_by_admin'] = 'cooperatives/get_cooperative_info_by_admin';
$route['cooperatives/get_business_activities_of_coop'] = 'cooperatives/get_business_activities_of_coop';
$route['cooperatives/composition'] = 'cooperatives/composition';
$route['cooperatives/(:any)/composition'] = 'cooperatives/composition';
$route['cooperatives/deny_cooperative'] = 'cooperatives/deny_cooperative';
$route['cooperatives/defer_cooperative'] = 'cooperatives/defer_cooperative';
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

$route['cooperatives/reservation'] = 'cooperatives/reservation';
$route['cooperatives/(:any)/purposes/edit'] = 'purposes/edit/$1';
$route['cooperatives/(:any)/purposes'] = 'purposes/index/$1';
$route['cooperatives/(:any)/articles_federation'] = 'articles/federation/$1';
$route['cooperatives/(:any)/articles_union'] = 'articles/union/$1';
$route['cooperatives/(:any)/articles_primary'] = 'articles/primary/$1';
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

$route['amendment/delete_amendment'] = 'amendment/delete_amendment';
$route['amendment/(:any)/amendment_documents/upload_document_others/(:any)'] = 'amendment_documents/upload_document_others/$1/$2';
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
$route['amendment/(:any)/committees'] = 'amendment_committees/index/$1';
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

$route['users/login'] = 'users/login';
$route['users/logout'] = 'users/logout';

$route['users/manual/(:any)'] = 'users/users_manual/$1'; //modify
$route['admins/(:any)/edit'] = 'admins/edit/$1';
$route['admins/add'] = 'admins/add';
$route['admins/check_username_not_exists'] = 'admins/check_username_not_exists';
$route['admins/add_admin'] = 'admins/add_admin';
$route['admins/all_admin'] = 'admins/all_admin';
$route['admins/all_user'] = 'admins/all_user';
$route['admins/change_passwd'] = 'admins/change_passwd';
$route['admins/login'] = 'admins/login';
$route['api/cooperative_types'] = 'api/cooperative_types/index';
$route['api/regions'] ='api/regions/index';
$route['api/provinces'] ='api/provinces/index';
$route['api/cities'] = 'api/cities/index';

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
$route['reset_migration'] = 'migrate/resetMigration';
$route['undo_migration'] = 'migrate/undoMigration';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
