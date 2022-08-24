<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CoopRIS <?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?=APPPATH?>../assets/css/bootstrap.min.css">
  <link rel="icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">
  
  <style>
  @page{margin: 96px 96px 70px 96px;}
  .page_break { page-break-before: always; }
  .table-cooperator, .table-cooperator th, .table-cooperator td {
    border: 0.5px solid #000 !important;
    border-collapse: collapse;
}
  }
    <?php 
  if($coop_info->status == 12){
  ?>
  body{
      /*font-family: 'Bookman Old Style'; font-size: 12px; */
       font-family: 'Bookman Old Style',arial !important;font-size:12px;
    }
  <?php } ?>
  #customlist {
    /* delete default counter */
    list-style-type: none;
    /* create custom counter and set it to 0 */
    counter-reset: elementcounter;
  }

  #customlist>li:before {
    /* print out "Element " followed by the current counter value */
    content: "f." counter(elementcounter) " ";
    /* increment counter */
    counter-increment: elementcounter;
  }
  </style>
  <?php 
if($coop_info->status != 12){
?>
<style type="text/css">
  #printPage
{
  margin-left: 450px;
  padding: 0px;
  width: 670px; / width: 7in; /
  height: 900px; / or height: 9.5in; /
  clear: both;
  page-break-after: always;
}
#customlist {
    /* delete default counter */
    list-style-type: none;
    /* create custom counter and set it to 0 */
    counter-reset: elementcounter;
  }

  #customlist>li:before {
    /* print out "Element " followed by the current counter value */
    content: "f." counter(elementcounter) " ";
    /* increment counter */
    counter-increment: elementcounter;
  }
</style>
<a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/documents" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
<?php } ?>
</head>
<body style="font-size:12">
<script type="text/php">
        if (isset($pdf) ) {
            $x = 570; 
            $y=900;
            $text = "{PAGE_NUM}";//" of {PAGE_COUNT}";
            $font = $fontMetrics->get_font("BOOKOS");
            
            $size = 12;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text,$font , $size, $color, $word_space, $char_space, $angle);
            
        }
</script>
<div class="container-fluid text-monospace" id="printPage">
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">BY-LAWS<br>OF<br><?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-bold">KNOW ALL MEN BY THESE PRESENTS:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">We, the undersigned duly authorized representative(s) of our respective cooperatives, all of legal age and Filipino citizens, who on this day have voluntarily agreed to organize a Technology Service Cooperative, do hereby adopt the following By-laws. </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article I<br>Purpose/s and Goals</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">The goals and purposes of this Cooperative are those set forth in its Articles of Cooperation. </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article II<br>Membership</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Membership.</i> This Cooperative shall have <?php  echo ($bylaw_info->kinds_of_members == 1)? "regular members only" : "regulars and associate members";?>.</p>
      <?php if($bylaw_info->kinds_of_members == 2) :?>
      <p class="text-justify" style="text-indent: 50px;">Associate Members are those who have no right to vote nor be voted upon and are entitled only to limited rights, privileges and membership duration as provided in the By-laws of the Cooperative, the Philippine Cooperative Code of 2008, and its Implementing Rules and Regulation.</p>
      <p class="text-justify" style="text-indent: 50px;">An associate member who meets the minimum requirements of regular membership and continues to patronize the Cooperative for two (2) years, and signifies his/her intention to remain a member shall be considered a regular member.</p>
      <?php endif; ?>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Qualification for Membership.</i> The membership of this Cooperative is open to all types and categories of duly registered cooperatives.</p>
    </div>
  </div>
  <!-- <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="1">
        <li>Regular Members
          <ol class="text-justify" type="a">
            <?php foreach($regular_ar_qualifications as $reg_qualification) :?>
              <li><?= $reg_qualification ?></li>
            <?php endforeach; ?>
          </ol>
        </li>
        <?php if($bylaw_info->kinds_of_members == 2) :?>
        <li>Associate Members
          <ol class="text-justify" type="a">
            <?php foreach($assoc_ar_qualifications as $assoc_qualification) :?>
              <li><?= $assoc_qualification ?></li>
            <?php endforeach; ?>
          </ol>
        </li>
      <?php endif;?>
      </ol>
    </div>
  </div> -->
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Requirements for Membership.</i> A member-cooperative must have complied with the following requirements: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Approved application for membership;</li>
        <li>General Assembly Resolution indicating membership and share capital contribution to this Technology Service Cooperative;</li>
        <li>Board of Directors’ Resolution on authorized representative; </li>
        <li>Subscribed and paid the required minimum share capital and membership fee; and</li>
        <?php if(strlen($bylaw_info->additional_requirements_for_membership)>0) :?>
          <?php foreach($members_additional_requirements as $requirement) : ?>
            <li><?= $requirement ?></li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Application for Membership.</i> An applicant for membership shall file a duly accomplished form to the Board of Directors who shall act upon the application within <?= ucwords(num_format_custom(abs($bylaw_info->act_upon_membership_days)));?> (<?= abs($bylaw_info->act_upon_membership_days)?>) days from the date of filing. The Board of Directors shall devise a form for the purpose which shall, aside from the personal data of applicant, include the duties of a member to participate in all programs including but not limited to capital build-up and savings mobilization of the cooperative and, such other information as may be deemed necessary. </p>
        <p class="text-justify" style="text-indent: 50px;">The application form for membership shall include an undertaking to uphold the By-laws, policies, guidelines, rules and regulations promulgated by the Board of Directors and the general assembly. No application for membership shall be given due course if not accompanied with a membership fee of <?= ucwords(num_format_custom(str_replace(',','',$bylaw_info->membership_fee)));?> Pesos (Php <?= number_format(str_replace(',','',$bylaw_info->membership_fee),2)?>), which shall be refunded to the applicant cooperative in case of denial.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 5. <i class="font-weight-bold">Appeal.</i> An applicant cooperative whose application was denied by the Board of Directors may appeal to the Appeal and Grievance Committee or the General Assembly by giving notice to the Secretary of the cooperative within thirty (30) days upon receipt of the decision. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-regular">Section 6. <i class="font-weight-bold">Minimum Share Capital Requirement.</i> An applicant for regular membership shall subscribe at least <?= num_format_custom($capitalization_info->minimum_subscribed_share_regular)?> (<?= $capitalization_info->minimum_subscribed_share_regular?>) shares and pay the value of at least <?= num_format_custom($capitalization_info->minimum_paid_up_share_regular)?> (<?= $capitalization_info->minimum_paid_up_share_regular?>) shares upon approval of its membership.</p>
      <?php if($bylaw_info->kinds_of_members == 2) :?>
      <p class="text-justify">An applicant for <strong>associate membership</strong> shall subscribe at least <?= num_format_custom($capitalization_info->minimum_subscribed_share_associate)?> (<?= $capitalization_info->minimum_subscribed_share_associate?>) shares and pay the value of at least <?= num_format_custom($capitalization_info->minimum_paid_up_share_associate)?> (<?= $capitalization_info->minimum_paid_up_share_associate?>) shares upon approval of its membership.</p>
      <?php endif;?>
      <p class="text-justify" style="text-indent: 50px;">However, no member-cooperative shall own or hold more than ten percent (10%) of the total subscribed share capital of the Cooperative.</p>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 7. <i class="font-weight-bold">Duties and Responsibilities of a Member.</i> Every member shall have the following duties:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Pay the installment of its share capital subscription as it falls due and participate in the capital build-up and savings mobilization activities of the cooperative;</li>
        <li>Patronize the Cooperative’s businesses and services;  </li>
        <li>Participate in the membership education programs; </li>
        <li>Attend and participate in the deliberation of all matters taken during General Assembly meetings; </li>
        <li>Observe and obey all lawful orders, decisions, rules, and regulations adopted by the Board of Directors and the General Assembly;</li>
        <li>Promote the goals and purposes of the Cooperative, the welfare of its members, and the cooperative movement in general. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 8. <i class="font-weight-bold">Rights and Privileges of Member-Cooperative.</i> A member-cooperative shall have the following rights and privileges: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ul class="text-justify">
          <ol class="text-justify" type="a">
            <li>Attend General Assembly meetings, through its authorized representative; </li>
            <li>Avail of the services of the Cooperative, subject to certain conditions as may be prescribed by the Board of Directors;</li>
            <li>Inspect and examine the books of accounts, the minutes’ books, the share register, and other records of the Cooperative during reasonable office hours; </li>
            <li>Secure copies of records/documents of the Cooperative pertaining to the account information of the concerned member-cooperative; and </li>
            <li>Such other rights and privileges as may be granted by the General Assembly. </li>
          </ol>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 9. <i class="font-weight-bold">Members Entitled to Vote.</i> Any regular member-cooperative who meets the following conditions is a member entitled to vote:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Has paid the membership fee and the value of the minimum shares required for membership; </li>
        <li>Is not delinquent in the payment of its share capital subscriptions and other accounts or obligations; </li>
        <li>Has not violated any provision of cooperative laws, CDA administrative issuances, these Articles of Cooperation and Bylaws, the terms and conditions of the subscription agreement, and the decisions, guidelines, rules, and regulations promulgated by the Board of Directors and the General Assembly; </li>
        <li>Has completed the continuing education program prescribed by the Board of Directors; and</li>
        <li>Has participated in the affairs of the Cooperative and patronized its businesses in accordance with the policies and guidelines. </li>
        <?php if(strlen($bylaw_info->additional_conditions_to_vote)>0) :?>
          <?php foreach ($members_additional_conditions_to_vote as $condition) : ?>
            <li><?= $condition ?></li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ol>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">Failure of a member-cooperative to meet any of the above conditions shall mean suspension of its voting rights subject to the declaration of the Board of Directors until the same has been lifted upon the determination of the latter.</p>
      <p class="text-justify" style="text-indent: 50px;">Consequently, a member-cooperative entitled to vote shall have the following additional rights: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
        <ol class="text-justify" type="a">
          <li>Participate and vote on all matters deliberated upon during General Assembly meetings;</li>
          <li>Qualified to seek any elective or appointive position, subject to the provisions of this By-laws and the Philippine Cooperative Code of 2008; and </li>
          <li>Such other rights and privileges as may be provided by the General Assembly. </li>
        </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 10. <i class="font-weight-bold">Liability of Members.</i> A member-cooperative shall be liable for the debts of the cooperative only to the extent of its subscribed share capital. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 11. <i class="font-weight-bold">Termination of Membership.</i> Termination of membership may be automatic, voluntary, or involuntary, which shall have the effect of extinguishing all rights of a member in the cooperative, subject to the refund of share capital contribution under Section 14 hereof. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li><strong>Automatic Termination of Membership.</strong> The dissolution or the insolvency of a member-cooperative shall be considered an automatic termination of its membership in the cooperative. 
        </li>
        <li><strong>Voluntary Termination.</strong> A member-cooperative may, for any valid reason, withdraw its membership from the cooperative by giving a sixty- (60) day notice to the Board of Directors.</li>
        <li><strong>Involuntary Termination.</strong> A member-cooperative may be terminated by a vote of the majority of all the members of the Board of Directors for any of the following causes: 
            <ol class="text-justify" type="a" style="list-style-type: none;" id="customlist">
              <li>Has not patronized the services/businesses of the cooperative as provided for in its policies; </li>
              <li>Has continuously failed to comply with its obligations as provided for in the policies of the cooperative; </li>
              <li>Has violated any provision of these By-laws and the policies promulgated by the Board of Directors of the cooperative; and</li>
              <li>For any act or omission injurious or prejudicial to the interest or the welfare of the cooperative.</li>
            </ol>
        </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 12. <i class="font-weight-bold">Manner of Involuntary Termination.</p></i>
        <p class="text-justify" style="text-indent: 50px;">The Board of Directors shall notify in writing the member-cooperative which is being considered for termination and shall give them the opportunity to be heard.</p>
        <p class="text-justify" style="text-indent: 50px;">The decision of the Board of Directors shall be in writing and shall be communicated in person or by registered mail to said member-cooperative and shall be appealable within thirty (30) days from receipt thereof to the General Assembly whose decision shall be final.</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 13. <i class="font-weight-bold">Refund of Share Capital Contribution.</i> A member-cooperative whose membership is terminated shall be entitled to a refund of its share capital contribution and all other interests in the cooperative. However, such refund shall not be made if upon payment the value of the assets of the cooperative would be less than the aggregate amount of its debts and liabilities exclusive of its share capital contribution. In which case, the terminated member-cooperative shall continue to be entitled to the interest of its share capital contributions, patronage refund, and the use of the services of the cooperative until such time that all its interests in the cooperative shall have been duly paid.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article III<br>Administration</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">The General Assembly (GA).</i> The General Assembly is composed of all the member-cooperatives entitled to vote, duly assembled and constituting a quorum, and is the highest policy-making body of the cooperative.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Powers of the General Assembly.</i> Subject to the pertinent provisions of the Cooperative Code and the rules issued thereunder, the General Assembly shall have the following exclusive powers which cannot be delegated:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
            <li>To determine and approve amendments to the cooperative Articles of Cooperation and By-laws; </li>
            <li>To elect or appoint the members of the Board of Directors, and to remove them for cause; </li>
            <li>To approve developmental plans of the Cooperative;</li>
    </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Meetings.</i> Meetings of the General Assembly, Board of Directors, and Committees may be regular or special. All proceedings and businesses undertaken at any meeting of the General Assembly, Board of Directors and Committees if within the powers or authority of the Cooperative, there being a quorum, shall be valid.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Regular General Assembly Meeting.</i> The General Assembly shall hold its annual regular meeting at the principal office of the cooperative or any place in the Philippines within <?= $bylaw_info->annual_regular_meeting_day ?> <i style="color:red;"> (shall be within ninety (90) days after the close of its fiscal year) </i> days after the close of its fiscal year.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 5. <i class="font-weight-bold">Special General Assembly Meeting.</i> The Board of Directors may, by a majority vote of all its members, call a special General Assembly meeting at any time to consider urgent matters requiring immediate membership decision. The Board of Directors must likewise call a special General Assembly meeting within one (1) month from receipt of a written request from: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>At least ten percent (10%) of the total number of members entitled to vote;</li>
        <li>The Audit Committee; or  </li>
        <li>The Federation to which the cooperative is a member. </li>
        <li>Upon Order of the Cooperative Development Authority.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 6. <i class="font-weight-bold">Notice of Meeting.</i> All notices of meetings shall be in writing and shall include the date, time, place, and agenda. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
          <li><strong>Regular General Assembly Meeting.</strong> Notice of the annual regular General Assembly meeting shall be served by the Secretary, personally or his duly authorized representative, by registered mail, or by electronic means to all members of record at his last known postal address, or by posting or publication, or through other electronic means, at least one (1) week before the said meeting. It shall be accompanied by an agenda, minutes of the meeting of the last General Assembly meeting, consolidated reports of the Board of Directors and Committees, Audited Financial Statements, and other papers which may assist the members to intelligently participate in the proceedings.</li>
          <li><strong>Special General Assembly Meeting.</strong> Notice of any Special General Assembly meeting shall be served by the Secretary personally or his duly authorized representative, by registered mail, or by electronic means upon each member who is entitled to vote at his last known postal address, or by posting or publication, or through other electronic means, at least one (1) week before the said meeting. It shall state the purpose and, except for related issues, no other business shall be considered during the meeting. </li>
          <li><strong>Waiver of Notice.</strong> Notice of any meeting may be waived, expressly or impliedly, by the member-cooperative concerned. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 7. <i class="font-weight-bold">Order of Business.</i> As far as practicable, the order of business of a regular general assembly meeting shall be:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Call to order; </li>
        <li>Declaration/Consideration of the presence of a quorum;</li>
        <li>Reading, consideration, and approval of the minutes of the previous meeting;</li>
        <li>Presentation and approval of the reports of the Board of Directors, officers, and the committees, including Audited Financial Statements of the cooperative; </li>
        <li>Unfinished business; </li>
        <li>New business;
            <ol class="text-justify" type="f" id="customlist">
              <li><!-- h.1 --> Election of Directors and committee members </li>
              <li><!-- h.2 --> Approval of Development and/or annual Plan and Budget; </li>
              <li><!-- h.3 --> Hiring of External Auditor </li>
              <li><!-- h.4 --> Other related business matters </li>
            </ol>
        </li>
        <li>Announcements; and </li>
        <li>Adjournment</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
      <?php
        if($bylaw_info->members_percent_quorom ==51)
        {
            $members_percent_quorom = 50;
            $quorum_word =  num_format_custom( $members_percent_quorom).' percent plus one';
            $quorum =  $members_percent_quorom.'%+1';
            // $quorum_word =  num_format_custom($bylaw_info->members_percent_quorom).' percent plus one';
            // $quorum = $bylaw_info->members_percent_quorom.'%+1';
        }
        else
        {
           $quorum_word =num_format_custom($bylaw_info->members_percent_quorom).' percent';
           $quorum = $bylaw_info->members_percent_quorom.'%';
        }
      ?>
        <p class="text-justify font-weight-regular">Section 8. <i class="font-weight-bold">Quorum for General Assembly Meeting.</i> During regular or special general assembly meeting, at least <?= $quorum_word?>  (<?= $quorum?>) of the total number of members-cooperative entitled to vote shall constitute a quorum. </p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 9. <i class="font-weight-bold">Voting System.</i> Only member-cooperative entitled to vote shall be qualified to participate and vote in any General Assembly meeting. A member-cooperative is entitled to one vote only. The votes cast by the representative duly authorized shall be deemed as votes cast by the member-cooperative. </p>
        <p class="text-justify" style="text-indent: 50px;">The election of Directors and Committee members shall be by secret ballot.  Action on all matters shall be in a manner that will truly and correctly reflect the will of the member-cooperative.
</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article IV<br>Board of Directors</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Composition of the Board of Directors (BOD).</i> The Board of Directors shall be composed of <?= num_format_custom($no_of_directors)?> (<?= $no_of_directors?>) members.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Functions and Responsibilities.</i> The Board of Directors shall have the following functions and responsibilities:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Provide the general policy direction of the cooperative; </li>
        <li>Formulate the Strategic Development Plan; </li>
        <li>Determine and prescribe the organizational and operational structure;</li>
        <li>Review the Annual Plan and Budget and recommend for its approval     
            by the General Assembly; </li>
        <li>Establish policies and procedures for the effective operation of the cooperative and ensure its proper implementation; </li>
        <li>Evaluate the capability and qualification and recommend to the General Assembly the engagement of the services of an External Auditor; </li>
        <li>Appoint the members of the Mediation/ Conciliation and Ethics Committees and other Officers as specified in the Code and Cooperative By-laws; </li>
        <li>Decide election-related cases involving the Election Committee and its members in accordance with the Guidelines issued by the CDA, Art.  137 of Republic Act No. 9520, Memorandum Circulars issued by the Cooperative Development Authority, Alternative Dispute Resolution Act of 2004 and its suppletory laws; </li>
        <li>Act on the recommendation of the Ethics Committee on cases involving violations of the Code of Governance and Ethical Standards in accordance with the Guidelines issued by the CDA, Art. 137 of Republic Act No. 9520, Memorandum Circulars issued by the Cooperative Development Authority, Alternative Dispute Resolution Act of 2004 and its suppletory laws; and </li>
        <li>Perform such other functions as may be prescribed in the By-laws or authorized by the General Assembly.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Qualifications.</i> Any representative who is entitled to vote and has the following qualifications can be elected or continue as a member of the Board of Directors:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Has paid the minimum capital requirement; </li>
        <li>Has no delinquent account with the cooperative; </li>
        <li>Have continuously patronized the cooperative services;</li>
        <li>A member in good standing for the last two (2) years;</li>
        <li>Completed or willingness to complete within the prescribed period the required education and training whichever is applicable; and </li>
        <li>Other qualifications prescribed in the rules and regulations of the Authority. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Disqualifications.</i> Any representative shall be disqualified to be elected as a member of the Board of Directors or any committee, or to continue as such under any of the following circumstances:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Holding any elective position in the government, except that of a party-list representative being an officer of a cooperative he or she represents; </li>
        <li>The members of the Board of Directors holding other positions directly involved in the day-to-day operation and management of the cooperative he/she represents; </li>
        <li>Having direct or indirect personal interest with the business of the Cooperative; </li>
          <li>Having been absent for <?= num_format_custom($bylaw_info->number_of_absences_disqualification) ?>(<?= $bylaw_info->number_of_absences_disqualification ?>) consecutive meetings or in more than <?=num_format_custom($bylaw_info->percent_of_absences_all_meettings) ?> percent (<?= $bylaw_info->percent_of_absences_all_meettings.'%'?>) of all meetings within the twelve (12) month period unless with valid excuse as approved by the Board of Directors;</li>
        <li>Being an official or employee of the Cooperative Development Authority, except in a Cooperative organized among themselves; </li>
        <li>Having been convicted by final judgement in administrative proceedings or civil/criminal suits involving financial and/or property accountability; and</li>
        <li>Having been disqualified by law.</li>
      </ol>
    </div>
  </div>
  <!-- <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 5. <i class="font-weight-bold">Procedure for Disqualifications.</i> The procedure for disqualification shall be provided in the election guidelines or policy of the Cooperative.</p>
    </div>
  </div> -->
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 5. <i class="font-weight-bold">Election of Directors.</i> The members of the Board of Directors shall be elected, by secret ballot, by the duly authorized representatives, who are entitled to vote during the annual regular general assembly meeting or special General Assembly meeting called for the purpose. </p>
        <p class="text-justify" style="text-indent: 50px;"> Unless earlier removed for cause, or have resigned or become incapacitated, they shall hold office for a term of <b><?=num_format_custom($bylaw_info->director_hold_term) ?></b> (<b><?=$bylaw_info->director_hold_term?></b>) years or until their successors shall have been elected and qualified. Provided, that majority of the elected directors obtaining the highest number of votes during the first election after registration shall serve for two (2) years and the remaining directors for one (1) year. Thereafter, all directors shall serve for a term of (2) years</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify" style="text-indent: 50px;"> The term of the interim directors shall expire upon the election of their successors in the first regular general assembly after registration</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 6. <i class="font-weight-bold">Election of Officer within the Board of Directors.</i> The Board of Directors shall convene within ten (10) days after the General Assembly meeting to elect by secret ballot from among themselves the Chairperson and the Vice-Chairperson, and appoint the Secretary and Treasurer from outside of the Board.</p>
        <p class="text-justify" style="text-indent: 50px;">For committees to be elected by the General Assembly and/or appointed by the Board of Directors, the same procedural process of electing the Chairperson, Vice-Chairperson, or other positions among themselves should be followed. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular">Section 7. <i class="font-weight-bold">Meeting of the Board of Directors.</i>The regular meeting of the Board of Directors shall be held at least once a month. However, the Chairperson or majority of the directors may at any time call a special Board meeting to consider urgent matters. The call shall be addressed and delivered through the Secretary stating the date, time, and place of such meeting and the matters to be considered. Notice of regular and special meetings of the Board of Directors, unless dispensed with, shall be served by the Secretary in writing or thru electronic means to each director at least two (2) days before such meeting.</p>
        <p class="text-justify" style="text-indent: 50px;">The majority of the total number of directors constitutes a quorum to transact business. Any decision or action taken by the majority members of the Board of Directors in a meeting duly assembled shall be a valid cooperative act. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 8. <i class="font-weight-bold">Vacancies.</i> Any vacancy occurring in the Board of Directors by reason of death, incapacity, removal, or resignation may be filled up by a majority vote of the remaining directors, if still constituting a quorum; otherwise, such vacancy shall be filled by the General Assembly in a regular or special meeting called for the purpose. The elected director shall serve only for the unexpired term of his predecessor in office. </p>
        <p class="text-justify" style="text-indent: 50px;">In the event that the General Assembly failed to muster a quorum to fill the positions vacated by directors whose terms have expired and said directors refuse to continue their functions on a hold-over capacity, the remaining members of the Board together with the members of the Audit  Committee shall designate, from the qualified regular members of the  General Assembly, their replacements who shall serve temporarily as such until their successors shall have been elected and qualified in a regular or special General Assembly meeting called for the purpose. If a vacancy occurs in any elective committee, it shall be filled by the remaining members of the said committee, if still constituting a quorum, otherwise, the Board, in its discretion, may appoint or hold a special election to fill such vacancy. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class=text-justify "font-weight-regular">Section 9. <i class="font-weight-bold">Removal of Members of the Board of Directors and Committee Members.</i>All complaints about the removal of any elected officer shall be filed with the Board of Directors and such officer shall be given the opportunity to be heard. The majority of the Board of Directors may place the officer concerned under preventive suspension pending the resolution of the investigation.  Upon finding prima facie evidence of guilt, the Board of Directors shall present its recommendation for removal to the General Assembly. An elective officer may be removed by three-fourths (¾) of the regular members present and constituting a quorum, in a regular or special General Assembly meeting called for the purpose. The officer concerned shall be given the opportunity to be heard at said assembly. For this purpose, the Board of Directors shall provide a policy on suspension.</p>
        <p class="text-justify" style="text-indent: 50px;">In cases where the officers sought to be removed consist of the majority of the Board of Directors, at least 10% of the members with voting rights may file a petition with the CDA, upon failure of the Board of Directors to call an assembly meeting for the purpose to commence the proceeding for their removal within thirty (30) days from notice. The decision of the General Assembly on the matter is final and executory.  </p>
        <p class="text-justify" style="text-indent: 50px;">An officer appointed by the Board of Directors may be removed from office for cause by a majority vote of all the members of the Board of Directors. </p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 10. <i class="font-weight-bold">Prohibitions.</i> Any member of the Board of Directors shall not hold any other position directly involved in the day-to-day operation and management of the cooperative nor engage in any business similar to that of the cooperative or who in any way has a conflict of interest with it. </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article V<br>Committees</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Audit Committee.</i> An Audit Committee is hereby created and shall be composed of three (3) members to be elected during a general assembly meeting and shall hold office for a term of one (1) year or until their successors shall have been elected and qualified. Within ten (10) days after their election, they shall elect from among themselves a Chairperson, Vice-Chairperson, and a Secretary. No member of the committee shall hold any other position within the cooperative during his term of office. The Committee shall provide internal audit service, maintain a complete record of its examination and inventory, and submit an audit report quarterly or as may be required by the Board and the General Assembly.</p>
        <p class="text-justify" style="text-indent: 50px;">The audit committee shall be directly accountable and responsible to the General Assembly. It shall have the power and duty to continuously monitor the adequacy and effectiveness of the cooperative's management control system and audit the performance of the cooperative and its various responsibility centers.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Functions and Responsibilities.</i> The Audit Committee shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Monitor the adequacy and effectiveness of the cooperative's management and control system; </li>
        <li>Audit the performance of the cooperative and its various responsibility centers;</li>
        <li>Review continuously and periodically the books of account and other financial records to ensure that these are in accordance with the cooperative principles & generally accepted accounting procedures;  </li>
        <li>Submit reports to the Board of Directors and the General Assembly on the results of the internal audit and recommends necessary changes in policies and other related matters in operation;  </li>
        <li>Recommend or petition to the Board of Directors for the conduct of a special General Assembly when necessary; and </li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorized by the General Assembly. </li>

      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Election Committee.</i>An Election Committee is hereby created and shall be composed of three (3) members to be elected during a general assembly meeting and shall hold office for a term of one (1) year or until their successors shall have been elected and qualified. Within ten (10) days after their election, they shall elect from among themselves a Chairperson, Vice-Chairperson, and a Secretary. No member of the committee shall hold any other position within the Cooperative during his/her term of office. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Functions and Responsibilities.</i> The Election Committee shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Formulate election rules and guidelines and recommend to the General Assembly for approval; </li>
        <li>Implement election rules and guidelines duly approved by the General Assembly; </li>
        <li>Recommend necessary amendments to the election rules and guidelines, in consultation with the Board of Directors, for approval of the General Assembly; </li>
        <li>Supervise the conduct, manner, and procedure of election and other election-related activities and act on the changes thereto; </li>
        <li>Canvass and certify the results of the election; </li>
        <li>Proclaim the winning candidates; </li>
        <li>Decide election and other related cases except those involving the Election Committee or its members in accordance with the Guidelines issued by the CDA, Art. 137 of Republic Act 9520 and its Implementing Rules and Regulations, Alternative Dispute Resolution Act of 2004 and its suppletory laws and circulars issued by the Cooperative Development Authority; and </li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorized by the General Assembly. </li>

      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 5. <i class="font-weight-bold">Education and Training Committee.</i> An Education and Training Committee is hereby created and shall be composed of three (3) members to be appointed by the Board of Directors and shall serve for a term of one (1) year, without prejudice to their reappointment. Within ten (10) days after their appointment, they shall elect from among themselves a Chairperson, a Vice-Chairperson and a Secretary. </p>
        <p class="text-justify" style="text-indent: 50px;">The committee shall be responsible for the planning and implementation of the information, educational and human resource development programs of the cooperative for its members, officers, and the communities within its area of operation. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 6. <i class="font-weight-bold">Functions and Responsibilities.</i> The Education and Training Committee shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Keep members, officers, staff well-informed regarding Cooperative’s goals/objectives, policies & procedures, services, etc.;</li>
        <li>Plan and implement an educational program for members, officers, and staff;</li>
        <li>Develop promotional and training materials for the cooperative;</li>
        <li>Conduct/Coordinate training activities; and</li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorized by the General Assembly.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 7. <i class="font-weight-bold">Mediation and Conciliation Committee.</i> A Mediation and Conciliation Committee is hereby created and shall be composed of three (3)) members to be appointed by the Board of Directors. Within ten (10) days after their appointment, they shall elect from among themselves a Chairperson, Vice-Chairperson, and a Secretary who shall serve for a term of one (1) year or until successors shall have been appointed and qualified. No member of the Committee shall hold any other position in the cooperative during his term of office.  </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 8. <i class="font-weight-bold">Functions and Responsibilities.</i> The Mediation and Conciliation Committee shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Formulate and develop the Conciliation-Mediation Program and ensure that it is properly implemented; </li>
        <li>Monitor the Conciliation-Mediation programs and processes; </li>
        <li>Submit semi-annual reports of cooperative cases involving members Intra and inter cooperative disputes to the Authority within 15 days after the end of every semester; </li>
        <li>Accept and file Evaluation Reports; </li>
        <li>Submit recommendations for the improvements of the conciliation-mediation policies to the Board of Directors; </li>
        <li>Recommend to the Board of Directors a representative from any member-cooperative to be trained as a Cooperative Mediator-Conciliator; </li>
        <li>Settle the disputes lodged in accordance with the Guidelines issued by the CDA, Art. 137 of Republic Act 9520 and its Implementing Rules and Regulations, Alternative Dispute Resolution Act of 2004 and its suppletory laws and Circulars issued by the Cooperative Development  Authority; </li>
        <li>Issue the Certificate of Non-Settlement after exhaustion of reasonable efforts to settle the disputes lodged before the cooperative; and </li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorized by the General Assembly. </li>

      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 9. <i class="font-weight-bold">Ethics Committee.</i> An Ethics Committee is hereby created and shall be composed of three (3) members to be appointed by the Board of Directors. Within ten (10) days after their appointment, they shall elect from among themselves a Chairperson, Vice-Chairperson, and a Secretary who shall serve for a term of one (1) year or until successors shall have been appointed and qualified. No member of the Committee shall hold any other position in the Cooperative during his term of office.  </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 10. <i class="font-weight-bold">Functions and Responsibilities.</i> The Ethics Committee shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Develop Code of Governance and Ethical Standard to be observed by the members, officers, and employees of the cooperative subject to the approval of the Board of Directors and ratification of the General Assembly; </li>
        <li>Disseminate, promote and implement the approved Code of Governance and Ethical Standards;</li>
        <li>Monitor compliance with the Code of Governance and Ethical Standards and recommend to the Board of Directors measures to address the gap if any; </li>
        <li>Conduct initial investigation or inquiry upon receipt of a complaint involving the Code of Governance and Ethical Standards and submit a report to the Board of Directors together with the appropriate sanctions in accordance with the Guidelines issued by the CDA, Art. 137 of Republic Act 9520 and its Implementing Rules and Regulations; Alternative Dispute Resolution Act of 2004 and its suppletory laws and Circulars issued by the Cooperative Development Authority; </li>
        <li>Recommend ethical rules and policies to the Board of Directors; and </li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorized by the General Assembly.</li>

      </ol>
    </div>
  </div>

  <?php $section_=10; ?>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section <?php echo ++$section_;?>. <i class="font-weight-bold">Gender and Development (GAD) Committee.</i> A Gender and Development (GAD) Committee shall be composed of three ( 3) members to be appointed by the Board of Directors provided that at least one member shall come from the Board.  The Committee shall elect from among themselves a Chairperson. The Committee members shall hold office until replaced by the Board.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section <?php  echo ++$section_;?>. <i class="font-weight-bold">Functions and Responsibilities.</i> The Gender and Development (GAD) Committee shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Conduct gender analysis;</li>
        <li>Develop and recommend Gender and Development ( GAD )and  Gender Equality (GE )policies and programs/activities/projects to the Board;</li>
        <li>Monitor and assess progress in the implementation of Gender and Development  (GAD) programs/activities/projects towards achieving Gender Equality (GE );</li>
        <li>Submit report to the Board; and Provide directional guidance</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section <?php echo ++$section_;?>. <i class="font-weight-bold">GAD Focal Person.</i> A GAD Focal Person (GFP) shall be designated by the Board upon recommendation of the management. He or she must be an employee of the cooperative and shall perform GFP roles as additional function</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section <?php echo ++$section_;?>. <i class="font-weight-bold">Functions and Responsibilities of GAD Focal Person (GFP). </i></p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Coordinates and reviews implementation of GAD programs/activities/projects based on approved plans and budget;</li>
        <li>Prepares performance reports and recommends policy improvements to the GAD Committee;</li>
        <li>Gathers and analyzes gender-related information and other data; and</li>
        <li>Provides administrative services to the GAD Committee.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section <?php echo ++$section_;?>. <i class="font-weight-bold">GAD Education and Training Program.</i> The Cooperative shall identify GAD and GE-related education and training programs.  These shall be included in the annual education and training plan.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section <?php echo ++$section_;?>. <i class="font-weight-bold">GAD Support Systems and Services.</i> The Cooperative shall implement other services that address GAD and GE issues and concerns.  It shall also develop and establish necessary support systems that will enhance implementation of the GAD and GE services of the Cooperative.</p>
    </div>
  </div>
  <?php
    if(is_array($committees_others))
    {
      $count_row = $section_;
      foreach($committees_others as $rowCom)
      {
       $couting = $count_row++;
  ?>
      <div class="row">
        <div class="col-sm-12 col-md-12 text-left">
            <p class="text-justify font-weight-regular">Section <?=$count_row++?>. <i class="font-weight-bold"><?=$rowCom['name']?></i> A <?=$rowCom['name']?> Committee shall be composed of three (3) members to be appointed by the Board of Directors.</p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 col-md-12 text-left">
            <p class="text-justify font-weight-regular">Section <?=$count_row++?>. <i class="font-weight-bold">Functions and Responsibilities.</i> <?=$rowCom['func_and_respons']?>.</p>
        </div>
      </div>  
      
  <?php
      }//end foreach
  ?>
    <div class="row">
      <div class="col-sm-12 col-md-12 text-left">
          <p class="text-justify font-weight-regular">Section <?php echo $count_row++;?>. <i class="font-weight-bold">Others Committee.</i> By a majority vote of all its members, the Board of Directors may form such other committees as may be deemed necessary for the operation of the cooperative.</p>
      </div>
    </div>
    <!-- <div class="row mb-4">
      <div class="col-sm-12 col-md-12 text-left">
          <p class="text-justify font-weight-regular">Section <?php echo $count_row++;?>. <i class="font-weight-bold">Qualification and Disqualification of Committee Members.</i> The qualification and disqualification of the Board of Directors shall also apply to all the members of the committees</p>
      </div>
    </div>   --> 

  <?php    
    }
    else
    {
  ?>
    <div class="row">
      <div class="col-sm-12 col-md-12 text-left">
          <p class="text-justify font-weight-regular">Section 19. <i class="font-weight-bold">Others Committee.</i> By a majority vote of all its members, the Board of Directors may form such other committees as may be deemed necessary for the operation of the Cooperative.</p>
      </div>
    </div>
    <!-- <div class="row mb-4">
      <div class="col-sm-12 col-md-12 text-left">
          <p class="text-justify font-weight-regular">Section 20. <i class="font-weight-bold">Qualification and Disqualification of Committee Members.</i> The qualification and disqualification of the Board of Directors shall also apply to all the members of the committees</p>
      </div>
    </div> -->
  <?php    
    }

  ?>
  
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VI<br>Officers and Management Staff of the Cooperative</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Officers and their Duties.</i> The officers of the cooperative shall include the members of the Board of Directors, Members of the different Committees created by the General Assembly, General Manager or Chief Executive Officer, Secretary, Treasurer and members holding other positions as may be provided for in this By-laws, shall serve according to the functions and responsibilities of their respective offices as follows:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li><i class="font-weight-bold">Chairperson</i> – The Chairperson shall:
          <ol type="i">
            <li>Set and prepare the agenda for board meetings in coordination with the other members of the Board of Directors; </li>
            <li>Preside over all meetings of the Board of Directors and of the general assembly;</li>
            <li>Sign contracts, agreements, certificates, and other documents on behalf of the cooperative as authorized by the Board of Directors or by the General Assembly; and </li>
            <li>Perform such other functions as may be authorized by the Board of Directors or by the General Assembly. </li>
          </ol>
        </li>
        <li><i class="font-weight-bold">Vice-Chairperson </i>–the Vice-Chairperson shall:
          <ol type="i">
            <li>Perform all the duties and responsibilities of the Chairperson in the absence of the latter; </li>
            <li>Perform such other duties as may be delegated by the Board of Directors. </li>
          </ol>
        </li>

        <li><i class="font-weight-bold">Treasurer</i> – The Treasurer shall:
          <ol type="i">
            <li>Ensure that all cash collections are deposited in accordance with the policies set by the Board of Directors;</li>
            <li>Have custody of all funds, securities, and documentation relating to all assets, liabilities, income, and expenditures;</li>
            <li>Monitor and review the financial management operations of the cooperative, subject to such limitations and control as may be  prescribed by the Board of Directors;</li>
            <li>Maintain complete records of cash transactions;</li>
            <li>Maintain a Petty Cash Fund and Daily Cash Position Report; and</li>
            <li>Perform such other functions as may be delegated by the Board of Directors and by the General Assembly.</li>
          </ol>
        </li>
        <li><i class="font-weight-bold">Secretary</i> – The Secretary shall:
          <ol type="i">
            <li> Keep an updated and complete registry of all members</li>
            <li> Prepare and maintain records of minutes of all meetings of the Board of Directors & the General Assembly;  </li>
            <li> Ensure that necessary Board of Directors’  actions and decisions are transmitted to the management for compliance and implementation;</li>
            <li> Issue and certify the list of members who are in good standing and entitled to vote as determined by the Board of Directors;</li>
            <li> Prepare and issue Share Certificates; </li>
            <li> Serve notice of all meetings called and certify the presence of a quorum of all meetings of the Board of Directors and General Assembly;</li>
            <li> Keep a copy of the Treasurer’s report & other reports;</li>
            <li> Keep and maintain the Share & Transfer Book; </li>
            <li> Serve as custodian of the cooperative seal; and </li>
            <li>Perform such other functions as may be prescribed by the Board of Directors and/or by the General Assembly.  </li>
          </ol>
        </li>
         <li><i class="font-weight-bold">General Manager</i>. The General Manager shall:
          <ol type="i">
            <li>Oversee the overall day-to-day business operations of the cooperative by providing general direction, supervision, management, and administrative control over all the operating departments subject to such limitations as may be set forth by the Board of Directors or the General Assembly; </li>
            <li>Formulate and recommend in coordination with the operating departments under his/her supervision, the Cooperative's Annual and Medium Term Development Plan, programs, and projects for approval of the Board of Directors, and ratification by the General Assembly; </li>
            <li>Implement the duly approved plans and programs of the cooperative and any other directive or instruction of the Board of Directors;</li>
            <li>Provide and submit to the Board of Directors monthly reports on the status of the cooperative’s operation vis-a-vis its target and recommend appropriate policy or operational changes, if necessary;</li>
            <li>Represent the cooperative in any agreement, contract, business dealings, and in any other official business transaction as may be authorized by the Board of Directors;</li>
            <li>Ensure compliance with all administrative and other requirements of regulatory bodies;</li>
            <li>Maintain records and accounts of the cooperative in such manner that the true condition of its business may be ascertained therefrom at any time; and </li>
            <li>Perform such other functions as may be delegated by the Board of Directors and by the General Assembly.  </li>
          </ol>
        </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Liabilities of Directors, Officers and Committee Members.</i> Directors, officers, and committee members, who willfully and knowingly vote for or assent to patently unlawful acts, or who are guilty of gross negligence or bad faith in directing the affairs of the cooperative or acquire any personal or pecuniary interest in conflict with their duties as Directors, officers or committee members shall be liable jointly and severally for all damages resulting therefrom to the cooperative, members, and other persons. When a director, officer, or committee member attempts to acquire or acquires in violation of his duties, any interest or equity adverse to the cooperative in respect to any matter which has been reposed in him in confidence, he shall, as a trustee for the cooperative, be liable for damages or loss of profits which otherwise would have accrued to the cooperative. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Management Staff.</i> A core management team composed of Manager, Cashier, Bookkeeper, Accountant, and other position as may be necessary or as provided for in their Human Resource Manual shall take charge of the day-to-day operations of the cooperative. The Board of Directors shall appoint, fix their compensation and prescribe their functions and responsibilities.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Qualification of the General Manager.</i> No person shall be appointed to the position of General Manager unless he/she possesses the following qualifications and none of the disqualifications herein enumerated:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Must be familiar with the operation of the Cooperative; </li>
        <li>Must have at least two (2) years experience in the operations of or related activities; </li>
        <li>Must not be engaged directly or indirectly in any activity similar to the operation of the Cooperative; </li>
        <li>Must not have been convicted of any administrative, civil, or criminal cases involving moral turpitude, gross negligence, or grave misconduct in the performance of his duties; </li>
        <li>Must be of good moral character; </li>
        <li>Must not have been convicted of any  administrative, civil or criminal case involving financial and/or property accountabilities at the time of his/her appointment; and</li>
        <li>Must undergo pre-service and/or in-service trainings. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 5. <i class="font-weight-bold">Duties of the Cashier.</i> The Cashier of the cooperative, who is under the supervision and control of the General Manager shall: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li> Handle monetary transactions; </li>
        <li> Receive/collect payments and deposits; </li>
        <li> Responsible for money received and expended;  </li>
        <li> Prepare reports on money matters; and </li>
        <li> Perform such other duties as the Board of Directors may require. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 6. <i class="font-weight-bold">Duties of the Accountant.</i> The Accountant of the cooperative, who is under the supervision and control of the General Manager shall: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Install an adequate and effective accounting system within the cooperative;  </li>
        <li>Render reports on the financial condition and operations of the cooperative whether monthly, annually or as may be required by the Board of Directors or the General Assembly;</li>
        <li>Assist the Board of Directors in the preparation of the annual budget; </li>
        <li>Keep, maintain and preserve all books of accounts, documents, vouchers, contracts, and other records concerning the business of the cooperative and make them available for auditing purposes to the Chairperson of the Audit Committee; and</li>
        <li>Perform such other duties as the Board of Directors may require. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 7. <i class="font-weight-bold">Duties of the Bookkeeper.</i> The bookkeeper of the cooperative who is under the supervision and control of the Accountant shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Record and update books of accounts; </li>
        <li>Assist in the preparation of reports on the financial condition and operations of the cooperative whether monthly, annually or as may be required by the Board of Directors and/or the general assembly;</li>
        <li>Keep, maintain and preserve all books of accounts, documents, vouchers, contracts, and other records concerning the business of the cooperative and make them available for auditing purposes to the Chairperson of the Audit Committee; and</li>
        <li>Perform such other duties as the Board of Directors may require.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 8. <i class="font-weight-bold">Qualifications of Accountant, Cashier, and Bookkeeper.</i> No person shall be appointed to the position of accountant and bookkeeper unless they possess the following qualifications and none of the disqualifications herein enumerated:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>A Bachelor’s Degree in Accountancy must be required for an Accountant however, the Cashier and Bookkeeper must be knowledgeable in handling monetary transactions, accounting, and bookkeeping;</li>
        <li> Must have at least two (2) years of experience in cooperative operation or related business; </li>
        <li> Must not be engaged directly or indirectly in any activity similar to the business of the cooperative; </li>
        <li> Must not have been convicted of any administrative, civil or criminal case involving moral turpitude, gross negligence, or grave misconduct in the performance of his/her duties; </li>
        <li> Must be of good moral character; </li>
        <li> Must be willing to undergo pre-service and/or in-service training in accounting; and </li>
        <li> Must not have been convicted of any administrative, civil or criminal case involving financial and/or property accountabilities at the time of his/her appointment. </li>
      </ol>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 9. <i class="font-weight-bold">Compensation.</i> Subject to the approval of the General Assembly, the members of the Board of Directors and Committees may, in addition to per diems for actual attendance to board and committee meetings, and reimbursement of actual and necessary expenses while performing functions  on behalf of the cooperative, may be given regular compensation; Provided, further, that the directors and officers shall not be entitled to any per diem when, if in the preceding calendar year, the cooperative reported a net loss or had a dividend rate less than the official inflation rate for the same year. </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VII<br>Capital Structure</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Source of Funds.</i> The cooperative may derive its funds from any or all of the following sources:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Member-cooperative share capital contribution; </li>
        <li>Loans and borrowings including deposits; </li>
        <li>Revolving capital build-up which consists of the deferred payment of patronage refund or interest on share capital; </li>
        <li>Subsidies, grants, legacies, aids, donation and such other assistance from any local or foreign institution, public or private;  </li>
        <li>Retentions from the proceeds of services acquired /goods procured by member-cooperative; and</li>
        <li>Other sources of funds as may be authorized by law.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 2. <i class="font-weight-bold">Continuous Capital Build-Up.</i> Every member-cooperative shall invest in any or all of the following: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>At least <?=ucwords(num_format_custom($bylaw_info->member_invest_per_month))?> Pesos (P<?=$bylaw_info->member_invest_per_month?>)per annum; </li>
        <li>At least <?=ucwords(num_format_custom($bylaw_info->member_percentage_annual_interest))?> percent (<?=$bylaw_info->member_percentage_annual_interest?>%) of member-cooperative annual interest on capital and patronage refund; and </li>
        <li>At least <?=ucwords(num_format_custom($bylaw_info->member_percentage_service))?> percent (<?=$bylaw_info->member_percentage_service?>%) of each good procured /service acquired from the cooperative. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 3. <i class="font-weight-bold">Borrowing.</i> The Board of Directors, upon approval of the General Assembly, may borrow funds from any source, local or foreign, under such terms and conditions that best serve the interest of the cooperative.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 4. <i class="font-weight-bold">Revolving Capital.</i> To strengthen the capital structure of the Cooperative, the General Assembly may authorize the Board of Directors to raise a revolving capital by deferring the payment of patronage refunds and interest on share capital, or such other schemes as may be legally adopted.  To implement this provision, the Board of Directors shall issue a Revolving Capital Certificate with serial number, name, rate of interest, date of retirement, and such other privileges or restrictions as may be deemed just and equitable.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 5. <i class="font-weight-bold">Retentions.</i>The General Assembly may authorize the Board of Directors to raise additional capital by deducting a certain percent on a per-unit basis from the proceeds of services acquired and/or goods procured by member-cooperative.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 6. <i class="font-weight-bold">Share Capital Contribution.</i>Share Capital Contribution refers to the value of capital subscribed and paid for by a member-cooperative in accordance with its Articles of Cooperation.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 7. <i class="font-weight-bold">Fines on Unpaid Subscribed Share Capital.</i>The Board of Directors shall prescribe a reasonable fine for the unpaid subscription of share capital.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 8. <i class="font-weight-bold">Share Capital Certificate.</i> The Board of Directors shall issue a Share Capital Certificate only to a member-cooperative who has fully paid his subscription.</p>
        <p class="text-justify" style="text-indent: 50px;">The Certificate shall be serially numbered and contain the shareholder’s name, the number of shares owned, the par value, and duly signed by the Chairperson and the Secretary, and bearing the official seal of the cooperative. All certificates issued and/or transferred shall be registered in the Cooperative’s Share and Transfer Book. </p>
        <p class="text-justify" style="text-indent: 50px;">The number of shares paid required for the issuance of the Share Capital Certificate shall be determined by the Board of Directors.</p>
        <p class="text-justify" style="text-indent: 50px;">The shares may be purchased, owned, or held only by the cooperative who are eligible for membership. Subject to existing government rules or laws, interests shall be paid only to paid-up shares which may be in cash or credited as payment of unpaid subscriptions, outstanding accounts, or additional shares or to the revolving fund of the cooperative.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 9. <i class="font-weight-bold">Transfer of Shares.</i> The cooperative shall have the first option to buy any share offered for sale. The amount to be paid for such shares shall be the par value provided that:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>the member has held such shares or interests for not less than one (1) year; </li>
        <li>the transfer is made to a member of the cooperative or eligible cooperative that falls within the field of membership of the former; and</li>
        <li>the Board has approved such transfer. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify" style="text-indent: 50px;">The transfer of shares shall not be binding to the cooperative until such transfer has been registered in the share and transfer book. No transfer shall be completed until the old certificate has been endorsed and surrendered to the cooperative and a new certificate is issued in the name of the member-cooperative. The corresponding transfer fee shall be collected from the transferee as prescribed in the cooperative policy. </p>
        <p class="text-justify" style="text-indent: 50px;">In case of lost or destroyed share certificate, the Board of Directors may issue a replacement after the member-cooperative executes a sworn affidavit, setting forth the following: </p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Circumstances as to how, when, and where the said certificate was lost or destroyed; </li>
        <li>The serial number of the certificate and the number of shares it represents;  </li>
        <li>The lost or destroyed certificate has never been transferred, sold, or endorsed to any third party, that should the same be found, the owner shall surrender it to the cooperative; and </li>
        <li>That any false representation or statement made in the aforesaid affidavit shall be a ground for expulsion from the cooperative. </li>
      </ol>
    </div>
  </div>
  <?php 
  $created_at = date('Y-m-d',strtotime($coop_info->created_at));
  $effectivity_date = date('2021-10-12');

  // echo strtotime($created_at).'-'.strtotime($effectivity_date);
   if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date) {?>
    <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VIII<br>Vehicle Operation and Fleet Management</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">The cooperative shall procure  Public Utility Vehicle Modernization Program (PUVMP) - compliant units or as prescribed by the concerned government agency. The said units shall be owned and managed by the cooperative, and the franchise/Certificate of Public Convenience and Necessity shall be registered under its name. <br><br> The aforementioned units shall be under the established fleet management system of the cooperative, either operated internally or by its duly authorized third party.</p>
    </div>
  </div>
  <?php } ?>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date){ echo 'Article IX'; } else { echo 'Article VIII'; }?><br>Allocation and Distribution of Net Surplus</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 1. <i class="font-weight-bold">Allocation.</i> At the end of its fiscal year, the cooperative shall allocate and distribute its net surplus as follows:  </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li> <i class="font-weight-bold">Reserve Fund.</i> <?= ucwords(num_format_custom($bylaw_info->percent_reserve_fund))?> percent (<?=$bylaw_info->percent_reserve_fund?>%) shall be set aside for Reserve Fund subject to the following rules, provided, that in the first five (5) years of operation after registration, this amount shall not be less than fifty per centum (50%) of the net surplus:
          <ol type="i">
            <li>The reserve fund shall be used for the stability of the cooperative and to meet net losses in its operations. The General Assembly may decrease the amount allocated to the reserve fund when it has already exceeded the authorized share capital. Any sum recovered on items previously charged to the reserve fund shall be credited to such fund. </li>
            <li>The reserve fund shall not be utilized for investment, other than those allowed in Republic Act No. 9520. Such sum of the reserve fund in excess of the authorized share capital may be used at any time for any project that would expand the operations of the cooperative upon the resolution of the General Assembly.  </li>
            <li>Upon the dissolution of the cooperative the reserve fund shall not be distributed among the member-cooperative. However, the General Assembly may resolve: 
              <ol type="a">
                <li>To establish a usufructuary fund for the benefit of any Tertiary Cooperative of Federations or Union to which the cooperative is a member; or </li>
                <li>To donate, contribute or otherwise dispose of the amount for the benefit of the community where the cooperative operates. If the member-cooperative could not decide on the disposition of the reserve fund, the same shall be given to the tertiary Federation of cooperative or union to which the cooperative is a member. </li>
              </ol>
            </li>
          </ol>
        </li>
        <li><i class="font-weight-bold">Education and Training Fund.</i> <?= ucwords(num_format_custom($bylaw_info->percent_education_fund))?> percent (<?=$bylaw_info->percent_education_fund?>%) shall be set aside for Education and Training Fund.
          <ol type="i">
            <li>Half of the amount allocated to the education and training fund annually under this subsection may be spent by the cooperative for education and training purposes while the other half may be remitted to a union or tertiary cooperative federation chosen by the cooperative of which it is a member. </li>
            <li>Upon the dissolution of the cooperative, the unexpended balance of the education and training fund pertaining to the cooperative shall be credited to the education and training fund of the chosen union or tertiary cooperatives. </li>
          </ol>
        </li>
        <li><i class="font-weight-bold">Community Development Fund.</i> <?= ucwords(num_format_custom($bylaw_info->percent_community_fund))?> percent (<?=$bylaw_info->percent_community_fund?>%) shall be used for projects and activities that will benefit the community where the cooperative operates.</li>
        <li><i class="font-weight-bold">Optional Fund.</i> <?=ucwords(num_format_custom($bylaw_info->percent_optional_fund))?> percent (<?=$bylaw_info->percent_optional_fund?>%) shall be set aside for Optional Fund for land and building, and any other necessary fund.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 2. <i class="font-weight-bold">Interest on Share Capital and Patronage Refund.</i> The remaining net surplus shall be made available to the members in the form of interest on share capital not to exceed the normal rate of return on investment and patronage refunds. Provided, that any amount remaining after the allowable interest and the patronage refund have been deducted shall be credited to the reserved fund. The sum allocated for patronage refund shall be made available at the same rate to all patrons of the cooperative in proportion to their patronage, provided that:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>In the case of a patron cooperative member with paid-up share capital contribution, the proportionate amount of patronage refund shall be paid to such cooperative unless it agrees to credit the amount to its account as additional share capital contribution; </li>
        <li>In the case of a patron cooperative member with unpaid share capital contribution, its proportionate amount of patronage refund shall be credited to its account until the share capital has been fully paid;</li>
        <li>In the case of non-member patron cooperative, its proportionate amount of patronage refunds shall be set aside in a general fund and shall be allocated to such non-member patron cooperative and only upon request and presentation of evidence of the amount of its patronage. The amount so allocated shall be credited to such patron toward the payment of the minimum capital contribution for membership. When a sum equal to this amount has accumulated at any time within <?= ($coop_info->type_of_cooperative=='Credit' ? "___" : num_format_custom($bylaw_info->non_member_patron_years).' '.'('.$bylaw_info->non_member_patron_years.')')?> years, such patron shall be deemed and become a member of the Technology Service Cooperative if the former so agrees or requests and complies with the provisions of the By-laws for admission to membership; and</li>
        <li> If within the period specified hereof, any subscriber who has not fully paid the subscribed share capital or any non-member patron who has accumulated, the sum necessary for membership, but who does not request nor agree to become a member or fails to comply with the provisions of this By-laws for admission to membership, the amount so accumulated or credited to their account together with any part of the general fund for non-member patron shall be credited to the reserve fund or the education and training fund, at the option of the cooperative.</li>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date){ echo 'Article X'; } else { echo 'Article IX'; }?><br>Settlement of Disputes</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Mediation and Conciliation.</i> All inter and intra-cooperative disputes shall be settled within the cooperative in accordance with the Guidelines issued by the Cooperative Development Authority, Art. 137 0f Republic Act No. 9520 and its Implementing Rules and Regulations, Alternative Dispute Resolution Act of 2004, and its suppletory laws.</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Voluntary Arbitration.</i> Any dispute, controversy, or claim arising out of or relating to this By-laws, the cooperative law, and related rules, administrative guidelines of the Cooperative Development Authority,  including disputes involving members, officers, directors, and committee members, intra-cooperative disputes, and related issues, and any question regarding the existence, interpretation, validity, breach or termination of agreements, or the membership/General Assembly concerns shall be exclusively referred to and finally resolved by voluntary arbitration under the institutional rules promulgated by the Cooperative Development Authority,  after compliance with the conciliation or mediation mechanisms embodied in this By-laws, and such other applicable laws. </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date){ echo 'Article XI'; } else { echo 'Article X'; }?><br>Miscellaneous</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Investment of Capital.</i> The cooperative may invest its capital in any or all of the following:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Shares or debentures or securities; </li>
        <li>Any reputable bank/cooperative bank in the locality or any tertiary cooperatives of which it is a member; </li>
        <li>Securities issued or guaranteed by Government;</li>
        <li>Real Estate primarily for the use of the cooperative or its members; or </li>
        <li>In any other manner approved by the General Assembly.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Accounting System.</i> The cooperative shall keep, maintain and preserve all its books of accounts and other financial records in accordance with generally accepted accounting principles and practices, applied consistently from year to year, and subject to existing laws, rules and regulations.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Financial Audit, Performance Audit, and Social Audit.</i> At least once a year, the Board of Directors shall cause, in consultation with the Audit Committee, the audit of the books of accounts of the cooperative, performance audit and social audit by CDA Accredited Independent Certified Public Accountant, Accredited Social Auditor, and Cooperative's Compliance Officer/Audit Committee.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Annual Report.</i> During the annual regular assembly meeting, the cooperative shall submit a report of its operation to the General Assembly together with the Audited Financial Statements, Performance Audit, and Social Audit reports. The Cooperative Annual Performance Report shall be certified by the Chairperson and Manager of the cooperative as true and correct in all aspects to the best of their knowledge. The Audited Financial Statements and Social Audit Reports shall be certified by CDA Accredited Independent Auditors.</p>
        <p>The cooperative shall submit the web-based Cooperative Annual Progress Report (CAPR) together with the following attachments to the Authority within (120) days from the end of every calendar year;</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Social Audit Report; </li>
        <li>Performance Report; </li>
        <li>Audited Financial Statement; and </li>
        <li>List of officers and training undertaken/completed. </li>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date){ echo 'Article XII'; } else { echo 'Article XI'; }?><br>Amendments</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify mb-2 font-weight-regular">Section 1. <i class="font-weight-bold">Amendment of Articles of Cooperation and By-laws.</i> Amendments to the Articles of Cooperation and this By-Laws may be adopted by at least two-thirds (2/3) votes of all members with voting rights without prejudice to the rights of dissenting members to withdraw their membership under the provisions of the Philippine Cooperative Code of 2008. </p>
        <p class="text-justify mb-2" style="text-indent: 50px;">The amendment/s shall take effect upon approval by the Cooperative Development Authority.</p>
        <p class="text-justify mb-2" style="text-indent: 50px;">Voted and adopted this _____ day of _______, 20___ in ____________, Philippines</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-sm table-cooperator">
          <thead>
            <tr>
              <th>Name of Member-Cooperative</th>
              <th>Name of Representative</th>
              <th>Signature of Representative</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($cooperators_list_regular as $cooperator) :?>
            <?php $count++;?>
              <tr>
                <td><?=$count.'. '.$cooperator['coopName']?></td>
                <td><?=$count.'. '.$cooperator['representative']?></td>
                <td></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify mb-4" style="text-indent: 50px;">We, constituting the majority of the Board of Directors of the <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> do hereby certify that the foregoing instrument is the Code of By-laws of this Cooperative.</p>
        <p class="text-justify" style="text-indent: 50px;">Signed this _______ of __________, ___________, in ____________.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive text-center">
        <table class="table table-borderless table-sm table-director">
          <tbody>
            <tr>
              <td><b><?=$cooperator_chairperson->representative?></b><br>Chairperson</td>
              <td><b><?=$cooperator_vicechairperson->representative?></b><br>Vice-Chairperson</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <?php if(!empty($cooperator_directors[0]['representative'])):?>
                <td><b><?=$cooperator_directors[0]['representative']?></b><br>Director</td>
              <?php endif; ?>
              <?php if(!empty($cooperator_directors[1]['representative'])):?>
                <td><b><?=$cooperator_directors[1]['representative']?></b><br>Director</td>
              <?php endif;?>
              <?php if(!empty($cooperator_directors[2]['representative'])):?>
                <td><b><?=$cooperator_directors[2]['representative']?></b><br>Director</td>
              <?php endif; ?>
              </tr>
          </table>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <?php if(!empty($cooperator_directors[3]['representative'])):?>
                <td><b><?=$cooperator_directors[3]['representative']?></b><br>Director</td>
              <?php endif;?>
              <?php if(!empty($cooperator_directors[4]['representative'])):?>
                <td><b><?=$cooperator_directors[4]['representative']?></b><br>Director</td>
              <?php endif;?>
              </tr>
          </table>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
              <?php if(!empty($cooperator_directors[5]['representative'])): ?>
                <td><b><?=$cooperator_directors[5]['representative']?></b><br>Director</td>
              <?php endif; ?>
              <?php if(!empty($cooperator_directors[6]['representative'])):?>
                <td><b><?=$cooperator_directors[6]['representative']?></b><br>Director</td>
              <?php endif;?>
              <?php if(!empty($cooperator_directors[7]['representative'])):?>
                <td><b><?=$cooperator_directors[7]['representative']?></b><br>Director</td>
              <?php endif; ?>
              </tr>
          </table>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <?php if(!empty($cooperator_directors[8]['representative'])):?>
                <td><b><?=$cooperator_directors[8]['full_name']?></b><br>Director</td>
              <?php endif;?>
                 <?php if(!empty($cooperator_directors[9])):?>
                <td><b><?=$cooperator_directors[9]['representative']?></b><br>Director</td> 
                <?php endif; ?>
              </tr>
          </table>
        </div>
      </div>
    </div>
 

    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <?php if(!empty($cooperator_directors[10])):?>
                <td><b><?=$cooperator_directors[10]['representative']?></b><br>Director</td>
              <?php endif;?>
                <?php if(!empty($cooperator_directors[11])):?>
                    <td><b><?=$cooperator_directors[11]['representative']?></b><br>Director</td>
                <?php endif; ?>
                <?php if(!empty($cooperator_directors[12])):?>
                <td><b><?=$cooperator_directors[12]['representative']?></b><br>Director</td>
                <?php endif; ?> 
              </tr>
          </table>
        </div>
      </div>
    </div>



    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <?php if(!empty($cooperator_directors[13])):?>
                <td><b><?=$cooperator_directors[13]['representative']?></b><br>Director</td>
               <?php endif; ?>
               <?php if(!empty($cooperator_directors[14]['representative'])):?>
                <td><b><?=$cooperator_directors[14]['representative']?></b><br>Director</td>
              <?php endif;?>
              </tr>
          </table>
        </div>
      </div>
    </div>


  <?php //var_dump($cooperator_directors[5]['full_name']);// echo"<pre>"; print_r($cooperator_directors); echo"</pre>";?>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>
