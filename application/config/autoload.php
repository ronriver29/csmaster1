<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/
$autoload['packages'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in system/libraries/ or your
| application/libraries/ directory, with the addition of the
| 'database' library, which is somewhat of a special case.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|	$autoload['libraries'] = array('user_agent' => 'ua');
*/
$autoload['libraries'] = array('form_validation','session','email','encryption','Numbertowords');

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in system/libraries/ or in your
| application/libraries/ directory, but are also placed inside their
| own subdirectory and they extend the CI_Driver_Library class. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
|
| You can also supply an alternative property name to be assigned in
| the controller:
|
|	$autoload['drivers'] = array('cache' => 'cch');
|
*/
$autoload['drivers'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/
$autoload['helper'] = array('url','form','security','date','encrypt_helper','array','file','string');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|	$autoload['model'] = array('first_model' => 'first');
*/
$autoload['model'] = array(
  'user_model',
  'region_model',
  'province_model',
  'island_model',
  'city_model',
  'barangay_model',
  'business_activity_model',
  'business_activity_subtype_model',
  'cooperatives_model',
  'cooperative_type_model',
  'cooperator_model',
  'member_model',
  'committee_model',
  'purpose_model',
  'bylaw_model',
  'capitalization_model',
  'article_of_cooperation_model',
  'economic_survey_model',
  'staff_model',
  'uploaded_document_model',
  'admin_model',
  'api_model',
  'major_industry_model',
  'industry_subclass_model',
  'Payment_model',
  'registration_model',
  'branches_model',
  'Payment_branch_model',
  'coop_tool_model',
  'laboratories_model',
  'laboratories_cooperator_model', //modify by jason
  'amendment_model',
  'amendment_article_of_cooperation_model',
  'amendment_bylaw_model',
  'amendment_committee_model',
  'amendment_cooperator_model',
  'amendment_purpose_model',
  'amendment_economic_survey_model',
  'amendment_staff_model',
  'email_model',
  'affiliators_model',
  'amendment_capitalization_model',
  'unioncoop_model',
  'charter_model',
  'cais/profile_model',
  'cais/generalinfo_model',
  'cais/sfc_model',
  'cais/sked1_model',
  'cais/sked2_model',
  'cais/sked3_model',
  'cais/sked4_model',
  'cais/sked5_model',
  'cais/sked6_model',
  'cais/sked7_model',
  'cais/sked8_model',
  'cais/sked9_model',
  'cais/sked10_model',
  'cais/sked11_model',
  'cais/sked12_model',
  'cais/sked13_model',
  'cais/sked14_model',
  'cais/sked15_model',
  'cais/sked16_model',
  'cais/sked17_model',
  'cais/sked18_model',
  'cais/sked19_model',
  'cais/sked20_model',
  'cais/sked21_model',
  'cais/sked22_model',
  'cais/sked23_model',
  'cais/sked24_model',
  'cais/sked25_model',
  'cais/sked26_model',
  'cais/sked27_model',
  'cais/sked28_model',
  'cais/sked29_model',
  'cais/sked30_model',
  'cais/sked31_model',
  'cais/sked32_model',
  'cais/so_model',
  'cooperatives_update_model'
);
