<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-05 13:51:11 --> Query error: Unknown column 'branchess.regCode' in 'where clause' - Invalid query: select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "007%" and branchess.regCode like "7%"
    and branches.status in (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "007%" and branches.regCode like "7"
    and branches.status in (2,8,9,10,11,12,17,18,19,20)
ERROR - 2019-12-05 13:52:04 --> Query error: Unknown column 'branchess.regCode' in 'where clause' - Invalid query: select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "007%" and branchess.regCode like "7%"
    and branches.status in (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "007%" and branches.regCode like "7"
    and branches.status in (2,8,9,10,11,12,17,18,19,20)
ERROR - 2019-12-05 13:52:13 --> Query error: Unknown column 'branchess.regCode' in 'where clause' - Invalid query: select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "007%" and branchess.regCode like "7%"
    and branches.status in (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "007%" and branches.regCode like "7"
    and branches.status in (2,8,9,10,11,12,17,18,19,20)
ERROR - 2019-12-05 13:52:19 --> Query error: Unknown column 'branchess.regCode' in 'where clause' - Invalid query: select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "007%" and branchess.regCode like "7%"
    and branches.status in (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "007%" and branches.regCode like "7"
    and branches.status in (2,8,9,10,11,12,17,18,19,20)
ERROR - 2019-12-05 13:52:59 --> Query error: Unknown column 'branchess.regCode' in 'where clause' - Invalid query: select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "007%" and branchess.regCode like "07%"
    and branches.status in (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "007%" and branches.regCode like "07"
    and branches.status in (2,8,9,10,11,12,17,18,19,20)
ERROR - 2019-12-05 13:53:39 --> Severity: error --> Exception: syntax error, unexpected ''evaluator1' (T_ENCAPSED_AND_WHITESPACE), expecting ')' /home/administrator/www/coopris/application/models/Branches_model.php 698
ERROR - 2019-12-05 13:57:24 --> Query error: Unknown column 'branchess.regCode' in 'where clause' - Invalid query: select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "007%" and branchess.regCode like "07%"
    and branches.status in (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "007%" and branches.regCode like "07"
    and branches.status in (2,8,9,10,11,12,17,18,19,20)
ERROR - 2019-12-05 13:59:16 --> Query error: Unknown column 'branchess.regCode' in 'where clause' - Invalid query: select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "007%" and branches.regCode like "07%"
    and branches.status in (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "007%" and branchess.regCode like "07%"
    and branches.status in (2,8,9,10,11,12,17,18,19,20)
ERROR - 2019-12-05 14:01:31 --> Severity: Notice --> Undefined variable: reason_commment /home/administrator/www/coopris/application/controllers/Branches.php 733
ERROR - 2019-12-05 14:01:31 --> Severity: Notice --> Undefined variable: coop_full_name /home/administrator/www/coopris/application/models/Branches_model.php 627
ERROR - 2019-12-05 14:01:50 --> Severity: Notice --> Undefined variable: list_specialist /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-05 14:01:50 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-05 14:01:52 --> Severity: Notice --> Undefined variable: list_specialist /home/administrator/www/coopris/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-12-05 14:01:52 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-12-05 14:02:01 --> Severity: Notice --> Undefined variable: list_specialist /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-05 14:02:01 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/applications/assign_admin_modal.php 27
ERROR - 2019-12-05 14:02:03 --> Severity: Notice --> Undefined variable: list_specialist /home/administrator/www/coopris/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-12-05 14:02:03 --> Severity: Warning --> Invalid argument supplied for foreach() /home/administrator/www/coopris/application/views/applications/assign_branch_admin_modal.php 27
ERROR - 2019-12-05 16:11:05 --> Severity: Notice --> Undefined variable: laboratory /home/administrator/www/coopris/application/views/applications/list_of_laboratories.php 291
ERROR - 2019-12-05 16:12:09 --> Severity: Notice --> Undefined variable: laboratory /home/administrator/www/coopris/application/views/applications/list_of_laboratories.php 291
