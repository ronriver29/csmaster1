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
  body{
      /*font-family: 'Bookman Old Style'; font-size: 12px; */
       font-family: 'Bookman Old Style',arial !important;font-size:12px;
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
<div class="container-fluid text-monospace">
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
      <p class="text-justify font-weight-normal" style="text-indent: 50px;">We, the undersigned duly authorized representative(s) of our respective cooperatives, all of legal age and Filipino citizens, who, on this day have voluntarily organized a <u>Cooperative Union</u>, do hereby adopt the following By-laws.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article I<br>Purpose/s and Goals</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">The purpose/s and goal/s of this Cooperative Union are those set forth in its Articles of Cooperation.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article II<br>Membership</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Membership.</i> This Cooperative Union shall have <?php  echo ($bylaw_info->kinds_of_members == 1)? "regular members only" : "regulars and associate members";?>.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Qualification for Membership.</i> The membership of this Cooperative Union is open to any registered primary cooperatives and/or federations of all types.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Requirements for Membership.</i> A member must comply with the following requirements: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Approved application for membership;</li>
        <li>General Assembly Resolution stating that the General Assembly has approved their membership and the amount of dues to the Cooperative Union; </li>
        <li>Resolution of the Board of Directors designating an authorized representative;</li>
        <li>paid the membership fees, dues and contribution; and</li>
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
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Application for Membership.</i> An applicant for membership shall file a duly accomplished form to the Board of Directors who shall act upon the application within <?= ucwords(num_format_custom($bylaw_info->act_upon_membership_days));?> (<?= $bylaw_info->act_upon_membership_days?>) days from the date of filing. The Board of Directors shall devise a form for the purpose which shall, aside from the profile of the applicant cooperative, include the duties of an member to participate in all programs including but not limited to capital build-up, patronizing the businesses and services and savings mobilization of the federation and, such other information as may be deemed necessary. </p>
        <p class="text-justify" style="text-indent: 50px;">The application form for membership shall include an undertaking to uphold the By-laws, policies, guidelines, rules, and regulations promulgated by the Board of Directors and the general assembly. </p>
        <p class="text-justify" style="text-indent: 50px;"> No application for membership shall be given due course if not accompanied with a membership fee of <?= ucwords(num_format_custom(str_replace(',','',$bylaw_info->membership_fee))). ' Pesos';?> (Php <?= number_format(str_replace(',','',$bylaw_info->membership_fee),2)?>), which shall be refunded to the applicant cooperative in case of denial of the application.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 5. <i class="font-weight-bold">Appeal.</i> An applicant cooperative whose application was denied by the Board of Directors may appeal to the Appeal and Grievance Committee or the general assembly by giving notice to the Secretary of the Cooperative Union within thirty (30) days upon receipt of the decision. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 6. <i class="font-weight-bold">Duties and Responsibilities of Members.</i> Every member shall have the following duties:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Pay the monthly dues and whatever fees and contributions; </li>
        <li>Patronize the Cooperative Union’s services; </li>
        <li>Participate in the membership education programs; </li>
        <li>Attend and participate in the deliberation of all matters taken during General Assembly meetings; </li>
        <li>Observe and obey all lawful orders, decisions, rules and regulations adopted by the Board of Directors and the General Assembly;</li>
        <li>Remit the Cooperative Education and Training Fund (CETF) due to the Federation/Union; and</li>
        <li>Promote the purposes and goals of the Cooperative Union, the success of its operations, the welfare of its member and the cooperative movement in general.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 7. <i class="font-weight-bold">Rights and Privileges of Members.</i> A member shall have the following rights and privileges:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Attend through authorized representative during General Assembly meetings;</li>
        <li>Avail the services of the Cooperative Union, subject to certain conditions as may be prescribed by the Board of Directors;</li>
        <li>Inspect and examine the books of accounts, the minute's books, and other records of the Cooperative Union during reasonable office hours;</li>
        <li>Secure copies of Cooperative Union’s records/documents pertaining to the account information of the concerned member; and</li>
        <li>Such other rights and privileges may be granted by the General Assembly.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 8. <i class="font-weight-bold">Members Entitled to Vote.</i> Any regular member who meets the following conditions is a member entitled to vote:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Paid the membership fee and the value of the minimum contribution required for membership;</li>
        <li>Not delinquent in the payment of its contribution, dues, fees, and other accounts or obligations;</li>
        <li>Has not violated any provision of cooperative laws, CDA administrative issuances,  Articles of Cooperation and this By-laws, the terms and conditions of the subscription agreement; and the decisions, guidelines, rules and regulations promulgated by the Board of Directors and the general assembly;</li>
        <li>Completed the continuing education program prescribed by the Board of Directors;</li>
        <li>Remitted the Cooperative Education and Training Fund (CETF) due to the Union; and</li>
        <li>Participated in the affairs of the Cooperative Union and patronized its services in accordance with the policies and guidelines.</li>
      </ol>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">Failure of the member to meet any of the above conditions shall mean suspension of voting rights subject to the declaration of the Board of Directors until the same has been lifted upon the determination of the latter.</p>
      <p class="text-justify" style="text-indent: 50px;">Consequently, a member entitled to vote shall have the following additional rights:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
        <ol class="text-justify" type="a">
          <li>Participate and vote on all matters deliberated upon during General Assembly meetings;</li>
          <li>Seek any elective or appointive position, subject to the provisions of this By-laws and the Philippine Cooperative Code of 2008; and</li>
          <li>Such other rights and privileges as may be provided by the General Assembly.</li>
        </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 9. <i class="font-weight-bold">Termination of Membership.</i> Termination of membership may be automatic, voluntary, or involuntary, which shall have the effect of extinguishing all rights of a member in the Cooperative Union.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li><strong>Automatic Termination of Membership.</strong> The dissolution or the insolvency of an member shall be considered an automatic termination of its membership in the Cooperative Union</li>
        <li><strong>Voluntary Termination.</strong> An member may, for any valid reason, withdraw membership from the Cooperative Union by giving a sixty (60) day's notice to the Board of Directors.</li>
        <li><strong>Involuntary Termination.</strong> An member may be terminated by a vote of the majority of all the members of the Board of Directors for any of the following causes:
            <ol class="text-justify" type="i">
            <li>Has not patronized the services of the Cooperative Union as provided for in its policies ; </li>
            <li>Has continuously failed to comply with its obligations as provided for in the policies of the Cooperative Union; </li>
            <li>Has violated any provision of this By-laws and the policies promulgated by the board of directors of the Cooperative Union; and </li>
            <li>For any act or omission injurious or prejudicial to the interest or the welfare of the Cooperative Union. </li>
            </ol>
        </li>
      </ol>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 10. <i class="font-weight-bold">Manner of Notifying a Member in Case of Involuntary Termination.</i> The Board of Directors shall notify in writing the member which is being considered for termination and shall allow it to be heard. The decision of the Board of Directors shall be in writing and shall be communicated personally or by registered mail to the said member.  A decision for termination shall be appealable to the General Assembly whose decision shall be final, within thirty (30) days from receipt thereof.
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article III<br>Administration</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">The General Assembly (GA).</i> The General Assembly is composed of all the members entitled to vote, duly assembled and constituting a quorum and is the highest policy-making body of the Cooperative Union.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Powers of the General Assembly.</i> Subject to the pertinent provisions of the Cooperative Code and the rules issued thereunder, General Assembly shall have the following exclusive powers which cannot be delegated:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>To determine and approve amendments to the cooperative Articles of Cooperation and By-laws; </li>
        <li>To elect or appoint the members of the board of directors, and to remove them for cause; </li>
        <li>To approve developmental plans of the cooperative; and </li>
        <li>To delegate the following power/s to a smaller body of the Cooperative Union: </li>
          <ol class="text-justify" type="i">
            <?php if(strlen($bylaw_info->delegate_powers)>0) :?>
                <?php foreach($delegate_powers as $requirement) : ?>
                  <li><?= $requirement ?></li>
                <?php endforeach; ?>
              <?php endif; ?>
          </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Meetings.</i> Meetings of the General Assembly, board of directors and committees may be regular or special. All proceedings and businesses undertaken at any meeting of the general assembly or Board of Directors, if within the powers or authority of the Cooperative Union, there being a quorum, shall be valid.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Regular General Assembly Meeting.</i> The General Assembly shall hold its annual regular meeting at the principal office of the Cooperative Union or any place in the Philippines within ninety (90) days after the close of its fiscal year.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 5. <i class="font-weight-bold">Special General Assembly Meeting.</i> The Board of Directors may, by a majority vote of all its members, call a Special General Assembly meeting at any time to consider urgent matters requiring immediate membership decision. The Board of Directors must likewise call a Special General Assembly meeting within one (1) month from receipt of a written request from a) at least ten percent (10%) of the total number of members entitled to vote; b) the Audit Committee; or c) upon Order of the Cooperative Development Authority.</p>
    </div>
  </div>
  <!-- <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li> at least ten percent (10%) of the total number of members entitled to vote,</li>
        <li> the Audit Committee, or</li>
        <li> upon Order of the Cooperative Development Authority;</li>
      </ol>
    </div>
  </div> -->
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 6. <i class="font-weight-bold">Notice of Meeting.</i> All notices of meetings shall be in writing and shall include the date, time, place, and agenda.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
          <li> <i class="font-weight-bold">Regular General Assembly Meeting.</i>  Notice of the annual regular General Assembly meeting shall be served by the Secretary, personally or his duly authorized representative, by registered mail, or by electronic means to all members of record at its last known postal address, or by posting or publication, or through other electronic means, at least one (1) week before the said meeting.  It shall be accompanied by an agenda, minutes of meeting of the last General Assembly meeting, consolidated reports of the Board of Directors and Committees, audited financial statements, and other papers which may assist the members to intelligently participate in the proceedings.</li>
          <li><i class="font-weight-bold">Special General Assembly Meeting.</i>  Notice of any Special General Assembly meeting shall be served by the Secretary personally or his duly authorized representative, by registered mail, or by electronic means upon each members which is entitled to vote at his last known postal address, or by posting or publication, or through other electronic means, at least one (1) week before the said meeting.  It shall state the purpose and, except for related issues, no other business shall be considered during the meeting. </li>
          <li><i class="font-weight-bold">Waiver of Notice.</i>  Notice of any meeting may be waived, expressly or impliedly, by the member concerned. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 7. <i class="font-weight-bold">Order of Business.</i> As far as practicable, the order of business of a regular General Assembly meeting shall be as follows:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Call to order; </li>
        <li>Declaration/Consideration of presence of quorum; </li>
        <li>Reading, consideration and approval of the minutes of the previous meeting; </li>
        <li>Presentation and approval of the reports of the board of directors, officers, and the committees, including audited financial statements of the Cooperative Union; </li>
        <li>Unfinished business; </li>
        <li>New business;
            <ol class="text-justify" type="1" id="customlist">
              <li>Election of directors and committee members </li>
              <li>Approval of Development and/or annual Plan and Budget </li>
              <li>Hiring of External Auditor </li>
              <li>Other related business matters </li>
            </ol>
        </li>
        <li>Announcements; and </li>
        <li>Adjournment</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 8. <i class="font-weight-bold">Quorum for General Assembly Meeting.</i> During regular or special general assembly meeting, at least <?= num_format_custom($bylaw_info->members_percent_quorom)?> percent (<?= $bylaw_info->members_percent_quorom?>%) of the total number of members entitled to vote shall constitute a quorum. </p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 9. <i class="font-weight-bold">Voting System.</i> Only members entitled to vote shall be qualified to participate and vote in any general assembly meeting. The votes cast by the representative/delegate duly authorized shall be deemed as votes cast by the members.</p>
        <p class="text-justify" style="text-indent: 50px;">Election of Directors and Committee members shall be by secret ballot. Action on all matters shall be in any manner that will truly and correctly reflect the will of the membership.</p>
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
        <li>Provide general policy direction; </li>
        <li>Formulate the strategic development plan; </li>
        <li>Determine and prescribe its organizational and operational structure; </li>
        <li>Review the Annual Plan and Budget and recommend for the approval by the General Assembly; </li>
        <li>Establish policies and procedures for the effective operation and ensure proper implementation of such; </li>
        <li>Evaluate the capability and qualification of an External Auditor and recommend to the General Assembly the engagement of his/her services;</li>
        <li>Appoint the members of the Mediation/ Conciliation and Ethics Committees and other Officers as specified in the Code and Cooperative Union’s By-laws; </li>
        <li>Decide election related cases involving the Election Committee and its members in accordance with the Guidelines issued by the CDA, Art. 137 of Republic Act No. 9520, Memorandum Circulars issued by the Cooperative Development Authority, Alternative Dispute Resolution Act of 2004 and its suppletory laws;</li>
        <li>Act on the recommendation/s of the Ethics Committee on cases involving violations of Code of Governance and Ethical Standards in accordance with the Guidelines issued by the CDA, Art. 137 of Republic Act No. 9520, Memorandum Circulars issued by the Cooperative Development Authority, Alternative Dispute Resolution Act of 2004 and its suppletory laws; and</li>
        <li>Perform such other functions as may be prescribed in the By-laws or authorized by the General Assembly;</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Qualifications.</i> Any member who is entitled to vote and has the following qualifications can be elected or continue as member of the Board of Directors:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Has paid the fees, dues, and contribution;</li>
        <li>Has no delinquent account with the Cooperative Union; </li>
        <li>Have continuously patronized the Cooperative Union’s services;</li>
        <li>An member in good standing for the last two (2) years;</li>
        <li>Completed or willingness to complete within the prescribed period the required education and training whichever is applicable; and </li>
        <li>Other qualifications prescribed in the rules and regulations of the Authority. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Disqualifications.</i> Any member representative under any of the following circumstances shall be disqualified to be elected as a member of the Board of Directors or any committee, or to continue as such:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Holding any elective position in the government, except that of a party list representative  being an officer of a cooperative he or she represents; </li>
        <li>Is a member of the Board of Directors holding other position directly involved in the day-to-day operation and management of the cooperative he/she represents; </li>
        <li>Having direct or indirect personal interest with the business of the Cooperative Union; </li>
        <li>Having been absent for  three (3) consecutive meetings or in more than fifty percent (50%) of all meetings within the twelve (12) month period unless with valid  excuse as approved by the board of directors; </li>
        <li>Having been convicted in administrative proceedings or civil/criminal suits involving financial and/or property accountability; and </li>
        <li>Having been disqualified by law.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 5. <i class="font-weight-bold">Election of Directors.</i> The members of the Board of Directors shall be elected, by secret ballot, by the members, who are duly authorized representatives, who are entitled to vote during the annual regular General Assembly meeting or special general assembly meeting called for the  purpose. Unless earlier removed for cause, or have resigned or become incapacitated, they shall hold office for a term of <?=num_format_custom($bylaw_info->director_hold_term) ?> (<?=$bylaw_info->director_hold_term?>) years or until their successors shall have been elected and qualified; Provided, that majority of the elected directors obtaining the highest number of votes during the first election after registration shall serve for two (2) years, and the remaining directors for one (1) year. Thereafter, all directors shall serve for a term of <?=num_format_custom($bylaw_info->directors_term) ?> (<?=$bylaw_info->directors_term?>) years. The term of the cooperating directors shall expire upon the election of their successors in the first regular general assembly after registration.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 6. <i class="font-weight-bold">Election of Officer within the Board of Directors.</i> The Board of Directors shall convene within ten (10) days after the General Assembly meeting to elect by secret ballot from among themselves the Chairperson and the Vice-Chairperson, appoint the Secretary and the Treasurer from outside of the Board.</p>
        <p class="text-justify" style="text-indent: 50px;">For committees to be elected by the General Assembly and/or appointed by the Board of Directors, the same procedural process of electing the Chairperson, Vice-Chairperson, or other positions among themselves should be followed.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular">Section 7. <i class="font-weight-bold">Meeting of the Board of Directors.</i> The regular meeting of the Board of Directors shall be held at least once a month. However, the Chairperson or majority of the directors may at any time call a special Board meeting to consider urgent matters. The call shall be addressed and delivered through the Secretary stating the date, time and place of such meeting and the matters to be considered.</p> 
        <p class="text-justify">The Notice of regular and special meetings of the Board of Directors, unless dispensed with, shall be served by the Secretary in writing or thru electronic means to each director at least two (2) days before such meeting.</p>
        <p class="text-justify">The majority of the total number of directors constitutes a quorum to transact business of the meeting. Any decision or action taken by the majority members of the Board of Directors in a meeting duly assembled shall be a valid cooperative act.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 8. <i class="font-weight-bold">Vacancies.</i> Any vacancy occurring in the Board of Directors by reason of death, incapacity, removal or resignation may be filled-up by a majority vote of the remaining directors, if still constituting a quorum; otherwise, such vacancy shall be filled by the General Assembly in a regular or special meeting called for the purpose. The elected director shall serve only for the unexpired term of his predecessor in office.</p>
        <p class="text-justify">In the event that the General Assembly failed to muster a quorum to fill the positions vacated by directors whose terms have expired and said directors refuse to continue their functions on a hold-over capacity, the remaining members of the Board together with the members of the Audit Committee shall designate, from the qualified regular members of the General Assembly, their replacements who shall serve temporarily as such until their successors shall have been elected and qualified in a regular or special General Assembly meeting called for the purpose.</p>
        <p class="text-justify">If a vacancy occurs in any elective committee it shall be filled by the remaining members of the said committee, if still constituting a quorum, otherwise, the Board, in its discretion, may appoint or hold a special election to fill such vacancy.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class=text-justify "font-weight-regular">Section 9. <i class="font-weight-bold">Removal of Members of the Board of Directors and Committee Members.</i> All complaints about the removal of any elected officer shall be filed with the Board of Directors and such officer shall be given the opportunity to be heard. The majority of the Board of Directors may place the officer concerned under preventive suspension pending the resolution of the investigation. Upon finding<i> prima facie </i> evidence of guilt, the Board of Directors shall present its recommendation for removal to the General Assembly. An elective officer may be removed by three-fourths (¾) of the regular members present and constituting a quorum, in a regular or special general assembly meeting called for the purpose. The officer concerned shall be given the opportunity to be heard at said Assembly. For this purpose, the Board of Directors shall provide policy on suspension.</p>
        <p class="text-justify">In cases where the officers sought to be removed consist of the majority of the Board of Directors, at least 10% of the members with voting rights may file a petition with the CDA, upon failure of the Board of Directors to call an assembly meeting for the purpose to commence the proceeding for their removal within thirty (30) days from notice. The decision of the General Assembly on the matter is final and executory.</p>
        <p class="text-justify" style="text-indent: 50px;">An officer appointed by the Board of Directors may be removed from office for cause by a majority vote of all the members of the Board of Directors.</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 10. <i class="font-weight-bold">Prohibitions.</i> Any members of the Board of Directors shall not hold any other position directly involved in the day-to-day operation and management of the Cooperative Union nor engage in any services similar to that of the Cooperative Union or who in any way has a conflict of interest in it.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article V<br>Committees</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Audit Committee.</i> An Audit Committee is hereby created and shall be composed of three (3) members to be elected during a General Assembly meeting and shall hold office for a term of one (1) year or until their successors shall have been elected and qualified. Within ten (10) days after their election, they shall elect from among themselves a Chairperson, Vice-Chairperson and a Secretary. No member of the committee shall hold any other position within the Cooperative Union during his term of office. The Committee shall provide internal audit service, maintain a complete record of its examination and inventory, and submit audit report quarterly or as may be required by the Board and the General Assembly.</p>
        <p class="text-justify" style="text-indent: 50px;">The audit committee shall be directly accountable and responsible to the General Assembly. It shall have the power and duty to continuously monitor the adequacy and effectiveness of the Cooperative management control system and audit the performance of the Cooperative Union and its various responsibility centers.</p>
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
        <li> Monitor the adequacy and effectiveness of the Cooperative Union’s management and control system; </li>
        <li>Audit the performance of the Cooperative Union and its various responsibility centers; </li>
        <li> Review continuously and periodically the books of account and other financial records to ensure that these are in accordance with the cooperative principles & generally accepted accounting procedures; </li>
        <li> Submit reports on the results of the internal audit and recommends necessary changes on policies and other related matters on operation to the Board of Directors and General Assembly; </li>
        <li>Recommend or petition to the Board of Directors conduct of special general assembly when necessary; and </li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorize by the General Assembly.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Election Committee.</i> An Election Committee is hereby created and shall be composed of three (3) members to be elected during a General Assembly meeting and shall hold office for a term of one (1) year or until their successors shall have been elected and qualified. Within ten (10) days after their election they shall elect from among themselves a Chairperson, Vice-Chairperson and a Secretary. No member of the committee shall hold any other position within the Cooperative Union during his term of office.</p>
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
        <li>Formulate election rules and guidelines and recommend its approval to the General Assembly;</li>
        <li>Implement election rules and guidelines duly approved by the General Assembly;</li>
        <li>Recommend necessary amendments to the election rules and guidelines, in consultation with the Board of Directors, for approval of the General Assembly</li>
        <li>Supervise the conduct, manner and procedure of election and other election related activities and act on the changes thereto</li>
        <li>Canvass and certify the results of the election;</li>
        <li>Proclaim the winning candidates;</li>
        <li>Decide election and other related cases except those involving the Election Committee or its members in accordance with the Guidelines issued by the CDA, Art. 137 of  Republic Act 9520 and its Implementing Rules and Regulations; Alternative Dispute Resolution Act of 2004 and its suppletory laws and circulars issued by the Cooperative Development Authority, and</li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorized by the General Assembly</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 5. <i class="font-weight-bold">Education and Training Committee.</i> An Education and Training Committee is hereby created and shall be composed of three (3) members to be appointed by the Board of Directors and shall serve for a term of one (1) year, without prejudice to their reappointment. Within ten (10) days after their appointment, they shall elect from among themselves a Vice-Chairperson and a Secretary.</p>
        <p class="text-justify" style="text-indent: 50px;">The committee shall be responsible for the planning and implementation of the information, educational and human resource development programs of the Cooperative Union for its members, officers, and the communities within its area of operation.</p>
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
        <li>Keep members, officers, staff well-informed regarding Cooperative Union’s goals/objectives, policies & procedures, services, etc.;</li>
        <li>Plan and implement an educational program for the Cooperative Union members, officers, and staff;</li>
        <li>Develop promotional and training materials for the Cooperative Union;</li>
        <li>Conduct/Coordinate training activities.</li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorized by the General Assembly. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 7. <i class="font-weight-bold">Mediation and Conciliation Committee.</i> A Mediation and Conciliation Committee is hereby created and shall be composed of three (3) members to be appointed by the Board of Directors. Within ten (10) days after their appointment, they shall elect from among themselves a Chairperson, Vice-Chairperson and a Secretary who shall serve for a term of one (1) year or until successors shall have been appointed and qualified. No member of the Committee shall hold any other position in the Cooperative Union during his term of office.</p>
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
        <li>Monitor Conciliation-Mediation program and processes; </li>
        <li>Submit semi-annual reports of cooperative cases to the Authority within 15 days after the end of every semester; </li>
        <li>Accept and file Evaluation Reports; </li>
        <li>Submit recommendations for improvements to the Board of Directors; </li>
        <li>Recommend to the BOD any member of the Cooperative Union for Conciliation-Mediation Training as Cooperative Mediator-Conciliator; </li>
        <li>Settle the disputes lodged in accordance with the Guidelines issued by the CDA, Art. 137 of  Republic Act 9520 and its Implementing Rules and Regulations; Alternative Dispute Resolution Act of 2004 and its supple Tory laws and circulars issued by the Cooperative Development Authority; </li>
        <li>Issue the Certificate of Non-Settlement after exhaustion of reasonable efforts to settle the disputes lodged in accordance with the Guidelines issued by the CDA, Art. 137 of  Republic Act 9520 and its Implementing Rules and Regulations; Alternative Dispute Resolution Act of-2004 and its supple Tory laws and circulars issued by the Cooperative Development Authority;</li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorized by the General Assembly. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 9. <i class="font-weight-bold">Ethics Committee.</i> An Ethics Committee is hereby created and shall be composed of three (3) members to be appointed by the Board of Directors. Within ten (10)days after their appointment, they shall elect from among themselves a Chairperson, Vice-Chairperson and a Secretary who shall serve for a term of one (1) year or until successors shall have been appointed and qualified. No member of the Committee shall hold any other position in the Cooperative Union during his term of office</p>
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
        <li>Develop Code of Governance and Ethical Standard to be observed by the members, officers and employees of the Cooperative Union subject to the approval of the BOD and ratification of the General Assembly; </li>
        <li>Disseminate, promote and implement the approved Code of Governance and Ethical Standards; </li>
        <li>Monitor compliance with the Code of Governance and Ethical Standards and recommend to the Board of Directors measures to address the gap, if any; </li>
        <li>Conduct initial investigation or inquiry upon receipt of a complaint involving Code of Governance and Ethical Standards and submit report to the Board of Directors together with the appropriate sanctions in accordance with the Guidelines issued by the CDA, Art. 137 of  Republic Act 9520 and its Implementing Rules and Regulations; Alternative Dispute Resolution Act of 2004 and its suppletory laws and circulars issued by the Cooperative Development Authority; </li>
        <li>Recommend ethical rules and policy to the Board of Directors; </li>
        <li>Perform such other functions as may be delegated by the Board of Directors or authorized by the General Assembly. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 11. <i class="font-weight-bold">Gender and Development (GAD) Committee.</i> – A Gender and Development (GAD) Committee shall be composed of three ( 3) members to be appointed by the Board of Directors provided that at least one member shall come from the Board.  The Committee shall elect from among themselves a Chairperson. The Committee members shall hold office until replaced by the Board.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 12. <i class="font-weight-bold">Functions and Responsibilities.</i> The Gender and Development  (GAD) Committee shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Conduct gender analysis;</li>
        <li>Develop and recommend Gender and Development (GAD) and Gender Equality (GE) policies and programs/activities/projects to the Board;</li>
        <li>Monitor and assess progress in the implementation of Gender and Development (GAD) programs/activities/projects towards achieving Gender Equality (GE);</li>
        <li>Submit report to the Board; and</li>
        <li>Provide directional guidance.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 13. <i class="font-weight-bold">GAD Focal Person.</i> A GAD Focal Person (GFP) shall be designated by the Board upon recommendation of the management. He or she must be an employee of the cooperative and shall perform GFP roles as additional function.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 14. <i class="font-weight-bold">Functions and Responsibilities of GAD Focal Person (GFP).</i></p>
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
        <p class="text-justify font-weight-regular">Section 15. <i class="font-weight-bold">GAD Education and Training Program.</i> The Cooperative shall identify GAD and GE-related education and training programs.  These shall be included in the annual education and training plan.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 16. <i class="font-weight-bold">GAD Support Systems and Services.</i> The Cooperative shall implement other services that address GAD and GE issues and concerns. It shall also develop and establish necessary support systems that will enhance implementation of the GAD and GE services of the Cooperative.</p>
    </div>
  </div>
  <?php $section_=17; ?>
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
    }
  ?>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section <?php echo $count_row++;?>. <i class="font-weight-bold">Others Committee.</i> By a majority vote of all its members, the Board of Directors may form such other committees as may be deemed necessary for the operation of the Cooperative Union.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VI<br>Officers and Management Staff of the Cooperative Union</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Officers and their Duties.</i> The officers of the Cooperative Union shall include the members of the Board of Directors, Members of the different Committees created by the General Assembly, General Manager or Chief Executive Officer, Secretary, Treasurer and members holding other positions as may be provided for in this by-laws, shall serve according to the functions and responsibilities of their respective offices as follows:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li><i class="font-weight-bold">Chairperson</i> – The Chairperson shall:
          <ol type="i">
            <li>Set the agenda for board meetings in coordination with the other members of the Board of Directors; </li>
            <li>Preside over all meetings of the Board of Directors and of the general assembly; </li>
            <li>Sign contracts, agreements, certificates and other documents on behalf of the cooperative Union as authorized by the Board of Directors or by the General Assembly; and </li>
            <li>Perform such other functions as may be authorized by the Board of Directors or by the General Assembly.</li>
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
            <li> Ensure that all cash collections are deposited in accordance with the policies set by the Board of Directors; </li>
            <li> Have custody of all funds, securities, and documentations relating to all assets, liabilities, income and expenditures; </li>
            <li> Monitor and review the financial management operations of the Cooperative Union, subject to such limitations and control as may be prescribed by Board of Directors; </li>
            <li>Maintain full and complete records of cash transactions; </li>
            <li> Maintain a Petty Cash Fund and Daily Cash Position Report; and </li>
            <li>Perform such other functions as may be delegated by the Board of Directors and by the General Assembly. </li>
          </ol>
        </li>
        <li><i class="font-weight-bold">Secretary</i> – The Secretary shall:
          <ol type="i">
            <li> Keep an updated and complete registry of all members;</li>
            <li> Prepare and maintain records of minutes of all meetings of the Board of Directors & the General Assembly;</li>
            <li> Ensure that necessary Board of Director's actions and decisions are transmitted to the management for compliance and implementation; </li>
            <li> Issue and certify the list of members who are in good standing and entitled to vote as determined by the Board of Directors;</li>
            <li> Serve notice of all meetings called and certify the presence of a quorum of all meetings of the Board of Directors and General Assembly;</li>
            <li> Keep a copy of the Treasurer’s report & other reports;</li>
            <li> Serve as custodian of the cooperative’s Seal; and</li>
            <li> Perform such other functions as may be prescribed or delegated by the Board of Directors and/or by the General Assembly.</li>
          </ol>
        </li>
         <li><i class="font-weight-bold">General Manager</i>. The General Manager shall:
          <ol type="i">
            <li>Oversee the overall day-to-day business operations of the cooperative by providing general direction, supervision, management and administrative control over all the operating departments subject to such limitations as may be set forth by the Board of Directors or the General Assembly;</li>
            <li>Formulate and recommend in coordination with the operating departments under his/her supervision, the Cooperative Union’s Annual and Medium Term Development. Plan, programs and projects, for approval of the Board of Directors, and ratification by the General Assembly; </li>
            <li>Implement the duly approved plans and programs of the Cooperative Union and any other directive or instruction of the Board of Directors; </li>
            <li>Provide and submit to the Board of Director's monthly reports on the status of the Cooperative Union's operation vis-a-vis its target and recommend appropriate policy or operational changes, if necessary;</li>
            <li>Represent the Cooperative Union in any agreement, contract, business  dealings, and in any other official business transaction as may be authorized by the Board of Directors; </li>
            <li> Ensure compliance with all administrative and other requirements of regulatory bodies; </li>
            <li>Maintain records and accounts of the Coopaerative Union in such manner that the true condition of its business may be ascertained therefrom at any time; and </li>
            <li>Perform such other functions as may be delegated by the Board of Directors and by the General Assembly. </li>
          </ol>
        </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Liabilities of Directors, Officers and Committee Members.</i> Directors, officers, and committee members, who willfully and knowingly vote for or assent to patently unlawful acts, or who are guilty of gross negligence or bad faith in directing the affairs of the Cooperative Union or acquire any personal or pecuniary interest in conflict with their duties as Directors, officers or committee members shall be liable jointly and severally for all damages resulting therefrom to the Cooperative Union, members and other persons.</p>
        <p class="text-justify">When a director, officer, or committee member attempts to acquire, or acquires in violation of his duties, any interest or equity adverse to the Cooperative Union in respect to any matter which has been reposed in him in confidence, he shall, as a trustee for the Cooperative Union, be liable for damages or loss of profits which otherwise would have accrued to the Cooperative Union.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Management Staff.</i> A core management team composed of Chief Executive Officer, Cashier, Bookkeeper, Accountant, and other position as may be necessary or as provided for in their Human Resource Manual shall take charge of the day-to-day operations of the Cooperative Union. The Board of Directors shall appoint, fix their compensation and prescribe for their functions and responsibilities.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Qualification of the Chief Executive Officer.</i> No person shall be appointed to the position of Chief Executive Officer unless he/she possesses the following qualifications and none of the disqualifications herein enumerated:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li> Must be familiar with the operation of the Cooperative Union; </li>
        <li>Must have at least two (2) years experience in the operations of or related activities; </li>
        <li>Must not be engaged directly or indirectly in any activity similar to the operation of the Cooperative Union; </li>
        <li>Must be of good moral character; </li>
        <li>Must not have been convicted of any administrative, civil or criminal cases involving moral turpitude, gross negligence or grave misconduct in the performance of his/her duties; </li>
        <li>Must not have been convicted of any administrative, civil or criminal case involving financial and/or property accountabilities at the time of his/her appointment; and</li>
        <li>Must undergo pre-service and/or in-service training.</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 5. <i class="font-weight-bold">Duties of Cashier.</i> The Cashier of the Federation, who shall be under supervision and control of the General Manager shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
          <li> Handle monetary transactions; </li>
        <li> Receive/collect payments and deposits; </li>
        <li> Responsible for money received and expended;</li>
        <li> Prepare reports on money matters; and </li>
        <li> Perform such other duties as the Board of Directors may require. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-regular text-justify">Section 6. <i class="font-weight-bold">Duties of the Accountant.</i> The Accountant of the Federation, who shall be under supervision and control of the General Manager shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
          <li>Install an adequate and effective accounting system within the Cooperative; </li>
        <li>Render reports on the financial condition and operations of the Federation monthly, annually or as may be required by the Board of Directors and/or the general assembly;</li>
        <li>Provide assistance to the Board of Directors in the preparation of annual budget;</li>
        <li>Keep, maintain and preserve all books of accounts, documents, vouchers, contracts and other records concerning the business of the Cooperative and make them available for auditing purposes to the Chairperson of the Audit Committee; and</li>
        <li>Perform such other duties as the Board of Directors may require. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 7. <i class="font-weight-bold">Duties of the Bookkeeper.</i> The bookkeeper of the Cooperative Union who is under supervision and control of the Chief Operating Officer shall:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Records and update books of accounts; </li>
        <li>Assist in the preparation of reports on the financial condition and operations of the Cooperative Union monthly, annually or as may be required by the Board of Directors and/or the General Assembly</li>
        <li>Keep, maintain and preserve all books of accounts, documents, vouchers, contracts and other records concerning the activities of the Cooperative Union and make them available for auditing purposes to the Chairperson of the Audit Committee; and </li>
        <li>Perform such other duties as the Board of Directors may require. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 8. <i class="font-weight-bold">Qualifications of Accountant, Cashier, and Bookkeeper.</i> No person shall be appointed to the position of accountant and bookkeeper unless they possess the following qualifications and none of the disqualifications herein enumerated: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>A Bachelor’s Degree in Accountancy must be required for an Accountant however, the Cashier and Bookkeeper must be knowledgeable in handling monetary transactions, accounting, and bookkeeping;</li>
        <li>Must have at least two (2) years of experience in cooperative operation or related business;</li>
        <li>Must not be engaged directly or indirectly in any activity similar to the activity of the Cooperative Union;</li>
        <li>Must not have been convicted of any administrative, civil or criminal case involving moral turpitude, gross negligence, or grave misconduct in the performance of his/her duties;</li>
        <li>Must be of good moral character; </li>
        <li>Must be willing to undergo pre-service and/or in-service training in accounting; and </li>
        <li>Must not have been convicted of any administrative, civil or criminal case involving financial and/or property accountabilities at the time of his/her appointment. </li>
      </ol>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 9. <i class="font-weight-bold">Compensation.</i> Subject to the approval of the General Assembly, the members of the Board of Directors and Committees may, in addition to per diems for actual attendance to board and committee meetings, and reimbursement of actual and necessary expenses while performing functions on behalf of the Cooperative Union, be given regular compensation.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VII<br>Structure of Funds</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Source of Funds.</i> The Cooperative Union may derive its funds from any or all of the following sources:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Membership fees, dues, and contributions;</li>
        <li>Loans and borrowings;</li>
        <li>Subsidies, grants, legacies, aids, donations, and such other assistance from any local or foreign institution, public or private; and</li>
        <li>Other sources of funds may be authorized by law.</li>
      </ol>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Borrowing.</i> The Board of Directors, upon approval of the General Assembly, may borrow funds from any source, local or foreign, under such terms and conditions that best serve the interest of the Cooperative Union.</p>
    </div>
  </div>
  <!-- <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VIII<br>Operations</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Primary Consideration.</i> Adhering to the principle of service, the Cooperative Union shall endeavor to:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li> Engage in:
          <ol class="text-justify"style="list-style-type:none;">
            <?php if(strlen($bylaw_info->primary_consideration)>0) :?>
                <?php $count=1;?>
                <?php foreach($primary_consideration as $requirement) : ?>
                    <li>a.<?php echo $count++; echo ' '.$requirement;?></li>
                <?php endforeach; ?>
            <?php endif; ?>
          </ol>
        </li>
        <li>Adopt and implement plans and programs with the end view of establishing other needed services for the members and the public; </li>
        <li>Formulate and implement studies and/or programs that will address the needs of member; and </li>
        <li>Collect CETF and other dues from its members</li>
      </ol>
    </div>
  </div> -->
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VIII<br>Settlement of Disputes</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Mediation and Conciliation.</i> All inter and intra-union disputes shall be settled within the Cooperative Union in accordance with the Guidelines issued by the Cooperative Development Authority, Art. 137 0f Republic Act No. 9520 and its Implementing Rules and Regulations, Alternative Dispute Resolution Act of 2004 and its suppletory laws</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Voluntary Arbitration.</i> Any dispute, controversy or claim arising out of or relating to this By-laws, the cooperative law and related rules, administrative guidelines of the Cooperative Development Authority, including disputes involving members, officers, directors, and committee members, intra-union disputes and related issues, and any question regarding the existence, interpretation, validity, breach or termination of agreements, or the membership/general assembly concerns shall be exclusively referred to and finally resolved by voluntary arbitration under the institutional rules promulgated by the Cooperative Development Authority, after compliance with the conciliation or mediation mechanisms embodied in the by-laws of the Cooperative Union, and in such other applicable laws.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article IX<br>Miscellaneous</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Investment of Funds.</i> The Cooperative Union may invest its fund in any or all of the following:</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li>Shares or debentures or securities; </li>
        <li>Any reputable bank in the locality or any tertiary federation of which it is a member and cooperative banks; </li>
        <li> Securities issued or guaranteed by Government; </li>
        <li>Real Estate primarily for the use of the Cooperative Union or its members; or </li>
        <li>In any other manner approved by the General Assembly. </li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 2. <i class="font-weight-bold">Accounting System.</i> The Cooperative Union shall keep, maintain and preserve all its books of accounts and other financial records in accordance with generally accepted accounting principles and practices, applied consistently from year to year, and subject to existing laws, rules and regulations.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 3. <i class="font-weight-bold">Financial Audit, Performance Audit, and Social Audit.</i> At least once a year, the Board of Directors shall cause, in consultation with the Audit Committee, the audit of the books of accounts of the Cooperative Union, performance audit and social audit by CDA Accredited Independent Certified Public Accountant, Accredited Social Auditor, and Cooperative Union’s Compliance Officer/Audit Committee</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 4. <i class="font-weight-bold">Annual Report.</i> During the annual regular assembly meeting, the Cooperative Union shall submit a report of its operation to the general assembly together with the audited financial statements, performance audit and social audit reports. The annual report shall be certified by the Chairperson and Manager of the Cooperative Union as true and correct in all aspects to the best of their knowledge. The audited financial statements and social audit reports shall be certified by CDA Accredited Independent Auditors</p>
        <p class="text-justify">The Cooperative Union shall submit the following attachments to the Authority within (120) days from the end of every calendar year:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <!-- <li>Cooperative Annual Performance Report (CAPR); </li> -->
        <li> Social Audit Report; </li>
        <li> Performance Report; </li>
        <li>Audited Financial Statement</li>
        <li>List of officers and trainings undertaken/completed; </li>
        <li>List of cooperatives which have remitted their respective Cooperative Education and Training Funds (CETF); </li>
        <li>Business consultancy assistance to include the nature and cost and </li>
        <li>Other training activities undertaken specifying therein the nature, participants, and cost of the activity. </li>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article X<br>Amendments</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="text-justify font-weight-regular">Section 1. <i class="font-weight-bold">Amendment of Articles of Cooperation and By-laws.</i> Amendments to the Articles of Cooperation and this By-Laws may be adopted by at least two-thirds (2/3) votes of all members with voting rights without prejudice to the rights of dissenting members to withdraw their membership under the provisions of the Philippine Cooperative Code of 2008.</p>
        <p class="text-justify mb-4" style="text-indent: 50px;">The amendment/s shall take effect upon approval by the Cooperative Development Authority.</p>
        <p class="text-justify" style="text-indent: 50px;">Voted and adopted this _____ day of _______, 20___ in ____________, Philippines</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th>Name of Member</th>
              <th>Name of Representatives</th>
              <th>Signature</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($cooperators_list as $cooperator) :?>
              <?=$count++;?>
              <tr>
                <td><?=$count.'. '.$cooperator['coopName']?></td>
                <td><?=$cooperator['representative']?></td>
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
        <p class="text-justify mb-4" style="text-indent: 50px;">We, constituting the majority of the Board of Directors of the <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> do hereby certify that the foregoing instrument is the Code of By-laws of this Cooperative Union.</p>
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
  <?php if(sizeof($cooperator_directors) >=3) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[0]['representative']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[1]['representative']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[2]['representative']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=5) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[3]['representative']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[4]['representative']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=8) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[5]['representative']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[6]['representative']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[7]['representative']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=10) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[8]['representative']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[9]['representative']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=13) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[10]['representative']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[11]['representative']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[12]['representative']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=15) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[13]['representative']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[14]['representative']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>
