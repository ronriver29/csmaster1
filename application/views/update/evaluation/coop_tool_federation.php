<div class="row">
  <div class="col">
    <div class="row mb-2">
      <div class="col-sm-12 col-md-12">
        <?php if($coop_info->status>3) : ?>
          <a class="btn btn-secondary btn-sm float-left" href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/documents" role="button" style="margin-right: 50px"><i class="fas fa-arrow-left"></i> Go Back</a>
        <?php endif;?>
      </div>
    </div>
  </div>  
  <div class="col">
    <div class="card mb-4 border-top-blue">      
        <div class="card-header">
          <h4><strong> Verification/Validation Tool for Registration of Cooperative </strong></h4>
        </div>
      <?php echo form_open('cooperative_tool/save', 'name="toolForm" id="toolForm"');?>
      <div class="card-body">
        <div class="row">
          <input type="hidden" name="id" value="<?=$encrypted_id?>"/>
          <table class="table table-bordered" Width="100%">
            <tr>
              <td><b>Areas of Consideration</b></td>
              <td><b>Means of Verification</b></td>
              <td><b>Yes</b></td>
              <td><b>No</b></td>
              <td><b>Remarks</b></td>
            </tr>
            <tr>
              <td colspan="4"><b>A. BASIC KNOWLEDGE ON FEDERATIONS, ITS FUNCTIONS AND OPERATIONS</b></td>
            </tr>
            <tr>
              <td width="40%" style="padding-left: 30px">1. Basic Knowledge on federation of cooperatives, functions and operations.
              </td>
              <td width="10%">
                Response to interview
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[0]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[0]" value="0" required></td>';
                    }else{
                      if ($ans[0]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="1" checked required</td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="0" checked required></td>';
                      }
                    } 
              ?>

              <?php if(empty($rem[0])){$rem[0]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[0]" value=""><?=$rem[0]?></textarea></td>
            </tr>
            </tr>
              <td colspan="4"><b>B. ORGANIZATION</b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">1. Validation of existence and the status of member cooperative</td>
              <td width="10%">
                Masterlist of Cooperatives
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[1]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[1]" value="0" required></td>';
                    }else{
                      if ($ans[1]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[1]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[1]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[1]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[1]" value="2" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[1])){$rem[1]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[1]" value=""><?=$rem[1]?></textarea></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">2. The proposed members of the federation are engaged in the same line of business.
              </td>
              <td width="10%">
                <ul>
                  <li>ACBL of proposed federation</li>
                  <li>ACBL of each member-cooperative</li>
                </ul>
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[2]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[2]" value="0" required></td>';
                    }else{
                      if ($ans[2]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[2]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[2]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[2]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[2]" value="0" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[2])){$rem[2]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[2]" value=""><?=$rem[2]?></textarea></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">3. Presence of interim members of the Board and other officers.</td>
              <td width="10%">
                Minutes of the Organizational Meeting
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[3]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[3]" value="0" required></td>';
                    }else{
                      if ($ans[3]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[3]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[3]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[3]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[3]" value="0" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[3])){$rem[3]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[3]" value=""><?=$rem[3]?></textarea></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">4. The presence of an office where the proposed federation will conduct its official business.</td>
              <td width="10%">
                <ul>
                  <li>Through ocular inspection of the office, if possible, and</li>
                  <li>Contract of lease, other documents showing consent or permission from the lessor/owner</li>
                </ul>
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[4]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[4]" value="0" required></td>';
                    }else{
                      if ($ans[4]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[4]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[4]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[4]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[4]" value="0" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[4])){$rem[4]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[4]" value=""><?=$rem[4]?></textarea></td>
            </tr>
            <tr>
              <td colspan="4"><b>C. MEMBERSHIP</b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">1. Proof of compliance to the number of members required for the establishment of a secondary or a tertiary federation </td>
              <td width="10%">
                GA Resolution of each member cooperative
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[5]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[5]" value="0" required></td>';
                    }else{
                      if ($ans[5]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[5]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[5]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[5]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[5]" value="0" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[5])){$rem[5]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[5]" value=""><?=$rem[5]?></textarea></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">2. The primary cooperative members are within the area of coverage of the proposed federation.<br>
              </td>
              <td width="10%">
                <ul>
                  <li>AC of proposed federation</li>
                  <li>AC of member- cooperatives</li>
                </ul>
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[6]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[6]" value="0" required></td>';
                    }else{
                      if ($ans[6]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[6]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[6]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[6]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[6]" value="0" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[6])){$rem[6]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[6]" value=""><?=$rem[6]?></textarea></td>
            </tr>
            <tr>
              <td colspan="4"><b>D. MEMBERS AND CAPITAL CONTRIBUTION </b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">1. The General Assembly Resolution contains the following:<br><br>
                <ol type="a">
                  <li>Authorizing membership in the proposed federation; and</li>
                  
                  <li style="padding-top: 60%;">Authorizing the contribution of a specific amount to the capitalization requirements and other dues to the proposed federation. </li>
                </ol>
              </td>
              <td width="10%">
                <ul>
                  <br><br><br>
                  <li>GA Resolution that has approved exact amounts of paid-up share capital contributions,</li>
                  <br>
                  <li>Board of Director Resolution on Authorize representative of each member-cooperative</li>
                </ul>
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[7]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[7]" value="0" required></td>';
                    }else{
                      if ($ans[7]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[7]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[7]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[7]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[7]" value="0" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[7])){$rem[7]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[7]" value=""><?=$rem[7]?></textarea></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">2. The initial capital contributions of member-cooperatives are already received by the Treasurer of the proposed federation. </td>
              <td width="10%">
                <ul>
                  <li>Treasurers Affidavit;</li>
                  <br>
                  <li>Bank Book in the name of the Chairman and Treasurer, BOD Resolution to open the bank account and the authorized signatories; and</li>
                  <br>
                  <li>Acknowledgement receipt or any proof of payment.</li>
                </ul>
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[8]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[8]" value="0" required></td>';
                    }else{
                      if ($ans[8]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[8]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[8]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[8]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[8]" value="0" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[8])){$rem[8]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[8]" value=""><?=$rem[8]?></textarea></td>
            </tr>
            <tr>
              <td colspan="4"><b>E. VIABILITY/FEASIBILITY</b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">1. The Capital is sufficient to finance the business activity of the proposed federation and if insufficient specify the strategy to be adopted in raising the deficiency.</td>
              <td width="10%">
                Feasibility study
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[9]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[9]" value="0" required></td>';
                    }else{
                      if ($ans[9]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[9]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[9]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[9]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[9]" value="0" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[9])){$rem[9]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[9]" value=""><?=$rem[9]?></textarea></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">2. All accountable officers are covered by adequate Surety Bond considering the initial net worth at the time of registration</td>
              <td width="10%">
                <ul>
                  <li>Surety Bond Policy/ </li>
                  <br>
                  <li>Treasurers Affidavit, (Legal Basis: MC 2020-24 Art. V, Section 6.)</li>
                </ul>
              </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[10]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[10]" value="0" required></td>';
                    }else{
                      if ($ans[10]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[10]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[10]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[10]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[10]" value="0" checked required></td>';
                      }
                    } 
              ?>
               <?php if(empty($rem[10])){$rem[10]=null;}?>
              <td width="40%"><textarea rows="5" type="text" class="form-control" name ="sagot[10]" value=""><?=$rem[10]?></textarea></td> 
            </tr>
          </table>
          <table width="100%">
            <tr>
              <td><b>Other Findings</b> <i>(within existing law, rules and regulations and CDA guidelines)</i></td>
            </tr>
            <tr>
              <td><textArea rows="4" cols="115" name="findings"><?php echo $findings;?></textArea></td>
            </tr>
            <tr>
              <td><b>Recommendations</b> <i>(clear and specific as to induce a strong belief/judgment by the approving officer)</i></td>
            </tr>
            <tr>
              <td><textArea rows="4" cols="115" name="comments"><?php echo $comments;?></textArea></td>
            </tr>
          </table>
            
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <?php if($coop_info->status==3): ?>
          <div class="col-sm-12 offset-md-8 col-md-4 align-self-center order-xs-4 order-sm-2 order-1 col-signup-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="coopBtn" name="coopBtn" value="Submit Validation Report">
          </div>
        <?php endif;?>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
