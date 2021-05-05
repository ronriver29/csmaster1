<?php
$config = array(
        'users/login' => array (
                array(
                  'field' => 'eAddressLogin',
                  'label' => 'Email Address',
                  'rules' => 'trim|required|valid_email',
                  'errors' => array (
                    'required' => 'Please enter your email address.'
                  ),
                ),
                array(
                  'field' => 'passwordLogin',
                  'label' => 'Password',
                  'rules' => 'trim|required',
                  'errors' => array (
                    'required' => 'Please enter your password.'
                  ),
                )
        ),
        'users/signup' => array (
                array(
                  'field' => 'fName',
                  'label' => 'Full Name',
                  'rules' => 'trim|required|callback_fullname_check'
                ),
                array(
                  'field' => 'bDate',
                  'label' => 'Birth Date',
                  'rules' => 'trim|required|callback_birthdate_check'
                ),
                array(
                  'field' => 'mNo',
                  'label' => 'Mobile Number',
                  'rules' => 'trim|required|callback_mobile_number_check'
                ),
                array(
                  'field' => 'eAddress',
                  'label' => 'Email Address',
                  'rules' => 'trim|required|valid_email|is_unique[users.email]'
                ),
                array(
                  'field' => 'hAddress',
                  'label' => 'Home Address',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'pword',
                  'label' => 'Password',
                  'rules' => 'trim|required|min_length[4]'
                ),
                array(
                  'field' => 'cPword',
                  'label' => 'Confirm Password',
                  'rules' => 'trim|required|matches[pword]'
                ),
                array(
                  'field' => 'validIdNo',
                  'label' => 'TIN Number',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'signUpAgree',
                  'label' => 'Terms and Condition',
                  'rules' => 'trim|required',
                  'errors' => array(
                    'required' => 'You must agree to terms and conditions.'
                  ),
                ),

        ),
        'users/use_registered_email' => array (
                array(
                  'field' => 'fName',
                  'label' => 'Full Name',
                  'rules' => 'trim|required|callback_fullname_check'
                ),
                array(
                  'field' => 'bDate',
                  'label' => 'Birth Date',
                  'rules' => 'trim|required|callback_birthdate_check'
                ),
                array(
                  'field' => 'mNo',
                  'label' => 'Mobile Number',
                  'rules' => 'trim|required|callback_mobile_number_check'
                ),
                array(
                  'field' => 'eAddress',
                  'label' => 'Email Address',
                  'rules' => 'trim|required|valid_email|is_unique[users.email]'
                ),
                array(
                  'field' => 'hAddress',
                  'label' => 'Home Address',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'pword',
                  'label' => 'Password',
                  'rules' => 'trim|required|min_length[4]'
                ),
                array(
                  'field' => 'cPword',
                  'label' => 'Confirm Password',
                  'rules' => 'trim|required|matches[pword]'
                ),
                array(
                  'field' => 'validIdNo',
                  'label' => 'TIN Number',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'signUpAgree',
                  'label' => 'Terms and Condition',
                  'rules' => 'trim|required',
                  'errors' => array(
                    'required' => 'You must agree to terms and conditions.'
                  ),
                ),

        ),
        'branches/bupdate' => array (
          array(
            'field' => 'typeOfbranchsatellite',
            'label' => 'Type',
            'rules' => 'trim|required'
          ),
//          array(
//            'field' => 'areaOfOperation',
//            'label' => 'Area of Operation',
//            'rules' => 'trim|required'
//          ),
//          array(
//            'field' => 'region',
//            'label' => 'Region',
//            'rules' => 'trim|required'
//          ),
          array(
            'field' => 'province',
            'label' => 'Province',
            'rules' => 'trim|required'
          ),
          array(
            'field' => 'city',
            'label' => 'City',
            'rules' => 'trim|required'
          ),  
          array(
            'field' => 'barangay',
            'label' => 'Barangay',
            'rules' => 'trim|required'
          ), 
        ),
        'branches/registration' => array (
          array(
            'field' => 'typeOfBranch',
            'label' => 'Type',
            'rules' => 'trim|required'
          ),
          array(
            'field' => 'coopName',
            'label' => 'Name of the Cooperative',
            'rules' => 'trim|required'
          ),
//          array(
//            'field' => 'regNo',
//            'label' => 'Registration No of the Cooperative',
//            'rules' => 'trim|required'
//          ),
//          array(
//            'field' => 'MI[]',
//            'label' => 'Major Industry',
//            'rules' => 'trim|required'
//          ),
//          array(
//            'field' => 'SC[]',
//            'label' => 'Major Industry Subclass',
//            'rules' => 'trim|required'
//          ),
          array(
            'field' => 'barangay',
            'label' => 'Barangay',
            'rules' => ''
          ),
          array(
            'field' => 'city',
            'label' => 'City',
            'rules' => ''
          ),
          array(
            'field' => 'province',
            'label' => 'Province',
            'rules' => ''
          ),
          array(
            'field' => 'region',
            'label' => 'Region',
            'rules' => ''
          ),
          array(
            'field' => 'branchAddAgree',
            'label' => 'Terms and Condition',
            'rules' => 'required',
            'errors' => array(
              'required' => 'You must agree to terms and conditions.'
            ),
          ),
        ),
        'cooperatives/reservation' => array (
                array(
                  'field' => 'categoryOfCooperative',
                  'label' => 'Category of Cooperative',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'typeOfCooperative',
                  'label' => 'Type of Cooperative',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'majorIndustry[]',
                  'label' => 'Major Industry',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'subClass[]',
                  'label' => 'Major Industry Subclass',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'proposedName',
                  'label' => 'Proposed Name',
                  'rules' => 'trim|required|callback_type_of_cooperative_check|callback_cooperative_word_check|callback_cooperative_name_exists_check'
                ),
                array(
                  'field' => 'commonBondOfMembership',
                  'label' => 'Common Bond of Membership',
                  'rules' => 'trim|required'
                ),
//                array(
//                  'field' => 'compositionOfMembers[]',
//                  'label' => 'Composition of Members',
//                  'rules' => 'trim|required'
//                ),
                /*array(
                  'field' => 'blkNo',
                  'label' => 'Block Number',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'streetName',
                  'label' => 'Street Name',
                  'rules' => 'trim|required'
                ),*/
                array(
                  'field' => 'barangay',
                  'label' => 'Barangay',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'city',
                  'label' => 'City',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'province',
                  'label' => 'Province',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'region',
                  'label' => 'Region',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'reserveAddAgree',
                  'label' => 'Region',
                  'rules' => 'required',
                  'errors' => array(
                    'required' => 'You must agree to terms and conditions.'
                  ),
                ),
        ),
        'cooperatives/rupdate' => array (
                array(
                  'field' => 'categoryOfCooperative',
                  'label' => 'Category of Cooperative',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'typeOfCooperative',
                  'label' => 'Type of Cooperative',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'majorIndustry[]',
                  'label' => 'Major Industry',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'subClass[]',
                  'label' => 'Major Industry Subclass',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'proposedName',
                  'label' => 'Proposed Name',
                   'rules' => 'trim|required|callback_type_of_cooperative_check|callback_cooperative_word_check'
                  // 'rules' => 'trim|required|callback_type_of_cooperative_check|callback_cooperative_word_check|callback_cooperative_name_exists_update_check'
                ),
                array(
                  'field' => 'commonBondOfMembership',
                  'label' => 'Common Bond of Membership',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'barangay',
                  'label' => 'Barangay',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'city',
                  'label' => 'City',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'province',
                  'label' => 'Province',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'region',
                  'label' => 'Region',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'reserveUpdateAgree',
                  'label' => 'Terms and Condition',
                  'rules' => 'required',
                  'errors' => array(
                    'required' => 'You must agree to terms and conditions.'
                  ),
                ),
        ),
        'amendmentbylaws/primary' => array (
                array(
                  'field' => 'kindsOfMember',
                  'label' => 'Kinds of Member',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'membershipFee',
                  'label' => 'Membership Fee',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'regularQualifications[]',
                  'label' => 'Regular Qualifications',
                  'rules' => 'trim|required'
                ),
//                array(
//                  'field' => 'additionalRequirementsForMembership',
//                  'label' => 'Additional Requirements for Membership',
//                  'rules' => 'trim'
//                ),
                array(
                  'field' => 'associateQualifications[]',
                  'label' => 'Associate Qualifications',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'actUponMembershipDays',
                  'label' => 'Days to act upon an application',
                  'rules' => 'trim|required'
                ),
            /*BEGIN: Commented for Capitalization  -BY FRED*/
//                array(
//                  'field' => 'regularMembershipPercentagePay',
//                  'label' => 'Minimum Shares Paid for Regular Member',
//                  'rules' => 'trim|required'
//                ),
//                array(
//                  'field' => 'regularMembershipPercentageSubscription',
//                  'label' => 'Minimum Shares Subscribed for Regular Member',
//                  'rules' => 'trim|required'
//                ),
//                array(
//                  'field' => 'associateMembershipPercentagePay',
//                  'label' => 'Minimum Shares Paid for Associate Member',
//                  'rules' => 'trim'
//                ),
//                array(
//                  'field' => 'associateMembershipPercentageSubscription',
//                  'label' => 'Minimum Shares Subscribed for Associate Member',
//                  'rules' => 'trim'
//                ),
                /*END: commented for ccalitalization update*/
//                array(
//                  'field' => 'additionalConditionsForVoting',
//                  'label' => 'Additional Condition for Voting',
//                  'rules' => 'trim'
//                ),
                array(
                  'field' => 'regularMeetingDay',
                  'label' => 'Day of Regular Meeting',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'quorumPercentage',
                  'label' => 'Percentage of member entitled to vote to constitute the quorum',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'consecutiveAbsences',
                  'label' => 'Consecutive Absences for Disqualification',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'consecutivePercentageAbsences',
                  'label' => 'Percentage of Absences for Disqualification',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'termHoldDirector',
                  'label' => 'Term of Directors',
                  'rules' => 'trim|required'
                ),
//                array(
//                  'field' => 'investPerMonth',
//                  'label' => 'Invest per month of every member',
//                  'rules' => 'trim|required'
//                ),
//                array(
//                  'field' => 'investAnnualInterest',
//                  'label' => 'Annual Interest of every member on capital',
//                  'rules' => 'trim|required'
//                ),
//                array(
//                  'field' => 'investService',
//                  'label' => 'Invest for Service',
//                  'rules' => 'trim|required'
//                ),
                array(
                  'field' => 'educationFund',
                  'label' => 'Education Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'reserveFund',
                  'label' => 'Reserve Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'communityFund',
                  'label' => 'Community Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'othersFund',
                  'label' => 'Optional Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'nonMemberPatronYears',
                  'label' => 'Non-members patron years',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'amendmentMembersWith',
                  'label' => 'Amendments',
                  'rules' => 'trim|required'
                ),
        ),
        'bylaws/primary' => array (
                array(
                  'field' => 'kindsOfMember',
                  'label' => 'Kinds of Member',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'membershipFee',
                  'label' => 'Membership Fee',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'regularQualifications[]',
                  'label' => 'Regular Qualifications',
                  'rules' => 'trim|required'
                ),
//                array(
//                  'field' => 'additionalRequirementsForMembership',
//                  'label' => 'Additional Requirements for Membership',
//                  'rules' => 'trim'
//                ),
                array(
                  'field' => 'associateQualifications',
                  'label' => 'Associate Qualifications',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'actUponMembershipDays',
                  'label' => 'Days to act upon an application',
                  'rules' => 'trim|required'
                ),
            /*BEGIN: Commented for Capitalization  -BY FRED*/
//                array(
//                  'field' => 'regularMembershipPercentagePay',
//                  'label' => 'Minimum Shares Paid for Regular Member',
//                  'rules' => 'trim|required'
//                ),
//                array(
//                  'field' => 'regularMembershipPercentageSubscription',
//                  'label' => 'Minimum Shares Subscribed for Regular Member',
//                  'rules' => 'trim|required'
//                ),
//                array(
//                  'field' => 'associateMembershipPercentagePay',
//                  'label' => 'Minimum Shares Paid for Associate Member',
//                  'rules' => 'trim'
//                ),
//                array(
//                  'field' => 'associateMembershipPercentageSubscription',
//                  'label' => 'Minimum Shares Subscribed for Associate Member',
//                  'rules' => 'trim'
//                ),
                /*END: commented for ccalitalization update*/
//                array(
//                  'field' => 'additionalConditionsForVoting',
//                  'label' => 'Additional Condition for Voting',
//                  'rules' => 'trim'
//                ),
                array(
                  'field' => 'regularMeetingDay',
                  'label' => 'Day of Regular Meeting',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'quorumPercentage',
                  'label' => 'Percentage of member entitled to vote to constitute the quorum',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'consecutiveAbsences',
                  'label' => 'Consecutive Absences for Disqualification',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'consecutivePercentageAbsences',
                  'label' => 'Percentage of Absences for Disqualification',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'termHoldDirector',
                  'label' => 'Term of Directors',
                  'rules' => 'trim|required'
                ),
//                array(
//                  'field' => 'investPerMonth',
//                  'label' => 'Invest per month of every member',
//                  'rules' => 'trim|required'
//                ),
//                array(
//                  'field' => 'investAnnualInterest',
//                  'label' => 'Annual Interest of every member on capital',
//                  'rules' => 'trim|required'
//                ),
//                array(
//                  'field' => 'investService',
//                  'label' => 'Invest for Service',
//                  'rules' => 'trim|required'
//                ),
                array(
                  'field' => 'educationFund',
                  'label' => 'Education Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'reserveFund',
                  'label' => 'Reserve Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'communityFund',
                  'label' => 'Community Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'othersFund',
                  'label' => 'Optional Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'nonMemberPatronYears',
                  'label' => 'Non-members patron years',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'amendmentMembersWith',
                  'label' => 'Amendments',
                  'rules' => 'trim|required'
                ),
        ),
    'bylaws/federation' => array (
                array(
                  'field' => 'kindsOfMember',
                  'label' => 'Kinds of Member',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'membershipFee',
                  'label' => 'Membership Fee',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'associateQualifications',
                  'label' => 'Associate Qualifications',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'actUponMembershipDays',
                  'label' => 'Days to act upon an application',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'regularMeetingDay',
                  'label' => 'Day of Regular Meeting',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'quorumPercentage',
                  'label' => 'Percentage of member entitled to vote to constitute the quorum',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'consecutiveAbsences',
                  'label' => 'Consecutive Absences for Disqualification',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'consecutivePercentageAbsences',
                  'label' => 'Percentage of Absences for Disqualification',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'termHoldDirector',
                  'label' => 'Term of Directors',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'educationFund',
                  'label' => 'Education Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'reserveFund',
                  'label' => 'Reserve Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'communityFund',
                  'label' => 'Community Fund',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'othersFund',
                  'label' => 'Optional Fund',
                  'rules' => 'trim|required'
                ),
        ),
        'bylaws/union' => array (
                    array(
                      'field' => 'kindsOfMember',
                      'label' => 'Kinds of Member',
                      'rules' => 'trim|required'
                    ),
                    array(
                      'field' => 'membershipFee',
                      'label' => 'Membership Fee',
                      'rules' => 'trim|required'
                    ),
                    array(
                      'field' => 'actUponMembershipDays',
                      'label' => 'Days to act upon an application',
                      'rules' => 'trim|required'
                    ),
                    array(
                      'field' => 'quorumPercentage',
                      'label' => 'Percentage of member entitled to vote to constitute the quorum',
                      'rules' => 'trim|required'
                    ),
                    array(
                      'field' => 'termHoldDirector',
                      'label' => 'New Election of Directors',
                      'rules' => 'trim|required'
                    ),
                    array(
                      'field' => 'directorsTerm',
                      'label' => 'Term of Directors',
                      'rules' => 'trim|required'
                    ),
            ),
        'amendment_cooperators/add' => array (
                array(
                  'field' => 'position',
                  'label' => 'Position',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'membershipType',
                  'label' => 'Type of Membership',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'fName',
                  'label' => 'Full Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'subscribedShares',
                  'label' => 'No. of Subscribed Shares',
                  'rules' => 'trim|required|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'paidShares',
                  'label' => 'No. of Paid Shares',
                  'rules' => 'trim|required|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'gender',
                  'label' => 'Gender',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'bDate',
                  'label' => 'Birth Date',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'barangay',
                  'label' => 'Barangay',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'validIdType',
                  'label' => 'Valid ID Type',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'validIdNo',
                  'label' => 'Valid ID No.',
                  'rules' => 'trim|required'
                ),
                // array(
                //   'field' => 'dateIssued',
                //   'label' => 'Date Issued',
                //   'rules' => 'trim|required'
                // ),
                array(
                  'field' => 'placeIssuance',
                  'label' => 'Place of Issuance',
                  'rules' => 'trim|required'
                )
        ),
        'cooperators/add' => array (
                array(
                  'field' => 'position',
                  'label' => 'Position',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'membershipType',
                  'label' => 'Type of Membership',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'fName',
                  'label' => 'Full Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'subscribedShares',
                  'label' => 'No. of Subscribed Shares',
                  'rules' => 'trim|required|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'paidShares',
                  'label' => 'No. of Paid Shares',
                  'rules' => 'trim|required|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'gender',
                  'label' => 'Gender',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'bDate',
                  'label' => 'Birth Date',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'barangay',
                  'label' => 'Barangay',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'validIdType',
                  'label' => 'Valid ID Type',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'validIdNo',
                  'label' => 'Valid ID No.',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'dateIssued',
                  'label' => 'Date Issued',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'placeIssuance',
                  'label' => 'Place of Issuance',
                  'rules' => 'trim|required'
                )
        ),
        'cooperators/edit' => array (
                array(
                  'field' => 'position',
                  'label' => 'Position',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'membershipType',
                  'label' => 'Type of Membership',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'fName',
                  'label' => 'Full Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'subscribedShares',
                  'label' => 'No. of Subscribed Shares',
                  'rules' => 'trim|required|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'paidShares',
                  'label' => 'No. of Paid Shares',
                  'rules' => 'trim|required|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'gender',
                  'label' => 'Gender',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'bDate',
                  'label' => 'Birth Date',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'validIdType',
                  'label' => 'Valid ID Type',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'validIdNo',
                  'label' => 'Valid ID No.',
                  'rules' => 'trim|required'
                ),
                // array(
                //   'field' => 'dateIssued',
                //   'label' => 'Date Issued',
                //   'rules' => 'trim|required'
                // ),
                array(
                  'field' => 'placeIssuance',
                  'label' => 'Place of Issuance',
                  'rules' => 'trim|required'
                )
        ),
        'purposes/edit' => array (
                array(
                  'field' => 'purposes[]',
                  'label' => 'Purposes',
                  'rules' => 'trim'
                )
        ),
        'articles/primary' => array(
                array(
                  'field' => 'cooperativeExistence',
                  'label' => 'Years of Existence',
                  'rules' => 'trim|required|greater_than_equal_to[1]|less_than_equal_to[50]'
                ),
                array(
                  'field' => 'turnOverDirectors',
                  'label' => 'Days before Turnover',
                  'rules' => 'trim|required|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'commonShares',
                  'label' => 'Common Shares',
                  'rules' => 'trim|required|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'parValueCommon',
                  'label' => 'Par Value Per Common Share',
                  'rules' => 'trim|required|greater_than_equal_to[100]|less_than_equal_to[1000]'
                ),
                array(
                  'field' => 'preferredShares',
                  'label' => 'Preferred Shares',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'parValuePreferred',
                  'label' => 'Par Value Per Preferred Share',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'authorizedShareCapital',
                  'label' => 'Authorized Share Capital',
                  'rules' => 'trim|required'
                ),
        ),
        'committees/add' => array (
                array(
                  'field' => 'committeeName',
                  'label' => 'Committee Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'cooperatorID',
                  'label' => 'Cooperator Name',
                  'rules' => 'trim|required'
                )
        ),
        'committees/edit' => array (
                array(
                  'field' => 'committeeName',
                  'label' => 'Committee Name',
                  'rules' => 'trim|required'
                )
        ),
        'amendment_committees/edit' => array (
                array(
                  'field' => 'committeeName',
                  'label' => 'Committee Name',
                  'rules' => 'trim|required'
                )
        ),
        'survey/index' => array (
                array(
                  'field' => 'backgroundCooperative',
                  'label' => 'Background of the Cooperative',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'rationaleCooperative',
                  'label' => 'Rationale of the Cooperative',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'increaseFirst',
                  'label' => 'Projected Increase of Membership for first year',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'increaseSecond',
                  'label' => 'Projected Increase of Membership for second year',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'increaseThird',
                  'label' => 'Projected Increase of Membership for third year',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                // array(
                //   'field' => 'previouslyRegisteredWith[]',
                //   'label' => 'Proposed Cooperative previously registered with',
                //   'rules' => 'trim|required'
                // ),
                array(
                  'field' => 'registeredOthersSpecify',
                  'label' => 'Others previosuly registered with',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'sameArea',
                  'label' => 'Same good/services in your area of operation',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'strategiesSupport[]',
                  'label' => 'Strategies of the cooperative to support members',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'strategiesSupportOthersSpecify',
                  'label' => 'Other Strategies of the cooperative to support members',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'transactBusiness',
                  'label' => 'Intending to business with',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'businessActivityFirst',
                  'label' => 'Business activities the Cooperative plans to undertake on its first year',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'businessActivitySecond',
                  'label' => 'Business activities the Cooperative plans to undertake on its second year',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'businessActivityThird',
                  'label' => 'Business activities the Cooperative plans to undertake on its third year',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'generateCapital[]',
                  'label' => 'How shall the Cooperative generate its capital',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'initialCapital',
                  'label' => 'Initial operating capital',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'strategyCapitalBuildUp',
                  'label' => 'Strategies for internal capital build-up',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'revenueFirst',
                  'label' => 'Projected revenue based on the initial operating capital on its first year',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'revenueSecond',
                  'label' => 'Projected revenue based on the initial operating capital on its second year',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'revenueThird',
                  'label' => 'Projected revenue based on the initial operating capital on its third year',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'expenditureFirst',
                  'label' => 'Estimated expenses for first year',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'expenditureSecond',
                  'label' => 'Estimated expenses for second year',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'expenditureThird',
                  'label' => 'Estimated expenses for third year',
                  'rules' => 'trim|required|integer|greater_than_equal_to[1]'
                ),
                array(
                  'field' => 'investments[]',
                  'label' => 'Does the Cooperative intend to invest',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'investOthersSpecify',
                  'label' => 'Others Cooperative intend to invest',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'equipments[]',
                  'label' => 'Necessary Equipment/machineries/facilities',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'equipmentOthersSpecify',
                  'label' => 'Other Necessary Equipment/machineries/facilities',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'procureEquipments[]',
                  'label' => 'Procure equipment/machineries/facilities',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'procureEquipmentOthersSpecify',
                  'label' => 'Other Necessary Equipment/machineries/facilities',
                  'rules' => 'trim'
                ),
                array(
                  'field' => 'necessarySkills',
                  'label' => 'Necessary skills/experiences/trainings',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'qualificationsBoard',
                  'label' => 'Qualifications/skills of the board of directors',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'educationProgramMembers',
                  'label' => 'Education programs for Members',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'educationProgramOfficers',
                  'label' => 'Education programs for Officers',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'educationProgramStaff',
                  'label' => 'Education programs for Staff',
                  'rules' => 'trim|required'
                ),
        ),
        'staff/add' => array (
                array(
                  'field' => 'position',
                  'label' => 'Position',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'fName',
                  'label' => 'Full Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'statusOfAppointment',
                  'label' => 'Status of Appointment',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'pAddress',
                  'label' => 'Postal Address',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'gender',
                  'label' => 'Gender',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'bDate',
                  'label' => 'Birth Date',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'minimumEducation',
                  'label' => 'Minimum Education Experience/Training',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'monthlyCompensation',
                  'label' => 'Monthly Compensation',
                  'rules' => 'trim|required'
                ),
        ),
        'staff/edit' => array (
                array(
                  'field' => 'position',
                  'label' => 'Position',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'fName',
                  'label' => 'Full Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'statusOfAppointment',
                  'label' => 'Status of Appointment',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'pAddress',
                  'label' => 'Postal Address',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'gender',
                  'label' => 'Gender',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'bDate',
                  'label' => 'Birth Date',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'minimumEducation',
                  'label' => 'Minimum Education Experience/Training',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'monthlyCompensation',
                  'label' => 'Monthly Compensation',
                  'rules' => 'trim|required'
                ),
        ),
        'cooperatives/defer_cooperative' => array (
                array(
                  'field' => 'comment',
                  'label' => 'Reason why deferred',
                  'rules' => 'trim|required'
                ),
        ),
        'cooperatives/deny_cooperative' => array (
                array(
                  'field' => 'comment',
                  'label' => 'Reason why denied',
                  'rules' => 'trim|required'
                ),
        ),
        'branches/defer_branch' => array (
                array(
                  'field' => 'comment',
                  'label' => 'Reason why deferred',
                  'rules' => 'trim|required'
                ),
        ),
        'branches/deny_branch' => array (
                array(
                  'field' => 'comment',
                  'label' => 'Reason why denied',
                  'rules' => 'trim|required'
                ),
        ),
        'admins/login' => array (
                array(
                  'field' => 'usernameAdminLogin',
                  'label' => 'Username',
                  'rules' => 'trim|required',
                  'errors' => array (
                    'required' => 'Please enter your username.'
                  ),
                ),
                array(
                  'field' => 'passwordAdminLogin',
                  'label' => 'Password',
                  'rules' => 'trim|required',
                  'errors' => array (
                    'required' => 'Please enter your password.'
                  ),
                )
        ),
        'admins/add' => array (
                array(
                  'field' => 'fName',
                  'label' => 'Full Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'eAddress',
                  'label' => 'Email Address',
                  'rules' => 'trim|required|valid_email'
                ),
                array(
                  'field' => 'access_level',
                  'label' => 'Access Level',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'region',
                  'label' => 'Region',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'uname',
                  'label' => 'Username',
                  'rules' => 'trim|required|is_unique[admin.username]'
                ),
                array(
                  'field' => 'pword',
                  'label' => 'Password',
                  'rules' => 'trim|required|min_length[4]'
                ),
                array(
                  'field' => 'cPword',
                  'label' => 'Full Name',
                  'rules' => 'trim|required|matches[pword]'
                ),
        ),
        'admins/add_signatory' => array (
                array(
                  'field' => 'signatory',
                  'label' => 'Full Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'region',
                  'label' => 'Region',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'designation',
                  'label' => 'Signatory Designation',
                  'rules' => 'trim|required'
                ),
        ),
        'admins/edit_signatory' => array (
                array(
                  'field' => 'signatory',
                  'label' => 'Full Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'region',
                  'label' => 'Region',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'designation',
                  'label' => 'Signatory Designation',
                  'rules' => 'trim|required'
                ),
        ),
        'admins/edit' => array (
                array(
                  'field' => 'fName',
                  'label' => 'Full Name',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'eAddress',
                  'label' => 'Email Address',
                  'rules' => 'trim|required|valid_email'
                ),
                array(
                  'field' => 'access_level',
                  'label' => 'Access Level',
                  'rules' => 'trim|required'
                ),
                array(
                  'field' => 'region',
                  'label' => 'Region',
                  'rules' => 'trim|required'
                ),
        ),
    );
?>
