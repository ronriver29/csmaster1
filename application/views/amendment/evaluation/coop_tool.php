<style type="text/css">

  input[type="radio"]{

      box-shadow: none;

  }

</style>

<div class="row">

  <div class="col">

    <div class="row mb-2">

      <div class="col-sm-12 col-md-12">
        <?php 
        $url='';
          switch ($coop_info->status) {
            case 12:
              $url='/amendment_documents';
              break;
            
            default:
             $url ='';
              break;
          }
        ?>
        <?php if($coop_info->status>3) : ?>

          <a class="btn btn-secondary btn-sm float-left" href="<?php echo base_url();?>amendment/<?= $encrypted_id ?><?=$url?>" role="button" style="margin-right: 50px"><i class="fas fa-arrow-left"></i> Go Back</a>

        <?php endif;?>

      </div>

    </div>

  </div>  

  <div class="col">

    <div class="card mb-4 border-top-blue">      

        <div class="card-header">

          <h4><strong> Verification/Validation Tool for Registration of Amendment </strong></h4>

        </div>

      <?php echo form_open('Amendment_cooperative_tool/save', 'name="toolForm" id="toolForm"');?>

      <div class="card-body">

        <div class="row">

         

          <input type="hidden" name="id" value="<?=$encrypted_id?>"/>

          <table class="table table-bordered" Width="100%">

            <tr>

              <td><b>Areas of Consideration</b></td>

              <td><b>Yes</b></td>

              <td><b>No</b></td>

              <td><b>Remarks</b></td>

            </tr>

            <tr>

              <td colspan="4"><b>a. General Assembly Resolution</b></td>

            </tr>

            <tr> 

              <td width="40%" style="padding-left: 30px">a.1. The General Assembly Resolution submitted is consistent  with the minutes of the General Assembly meeting as to the proposed amendments (Means of verification: GA Minutes of  Meeting)</td>

              <?php if ($ans==null){

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[0]" value="1"></td>';

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[0]" value="0"></td>';

                    }else{

                      if ($ans[0]==1){

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="1" checked></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="0"></td>';

                      }else{

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="1"></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="0" checked></td>';

                      }

                    } 

              ?>

              <?php if(empty($rem[0])){$rem[0]=null;}?>

              <td width="50%"><textarea rows="5" class="form-control" name ="sagot[0]"><?=$rem[0]?></textarea><!-- <input type="text" class="form-control" name ="sagot[0]" value="<?=$rem[0]?>"> --></td>

            </tr>

            <tr>

              <td style="padding-left: 30px">a.2.The proposed amendment was  approved by two thirds (2/3) votes of all members with voting rights (Means of verification: attendance sheet, list of members entitled to vote certified by the BOD, GA Minutes, latest approved Bylaws)</td>

              <?php if ($ans==null){

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[1]" value="1"></td>';

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[1]" value="0"></td>';

                    }else{

                      if ($ans[1]==1){

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[1]" value="1" checked></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[1]" value="0"></td>';

                      }else{

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[1]" value="1"></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[1]" value="0" checked></td>';

                      }

                    } 

              ?>

              <?php if(empty($rem[1])){$rem[1]=null;}?>

              <td width="50%"><textarea rows="5" class="form-control" name ="sagot[1]"><?=$rem[1]?></textarea><!-- <input type="text" class="form-control" name ="sagot[1]" value="<?=$rem[1]?>"> --></td>

            </tr>

            <tr>

              <td colspan="4"><b>Amended Provision:</b></td>

            </tr>

            <tr>

              <td colspan="4"><b>b. Increase in capitalization</b></td>

            </tr>

            <tr>

              <td style="padding-left: 30px">b.1.There is actual capital contribution of members. (Means of verification : Official receipt, subsidiary ledger)</td>

              <?php if ($ans==null){

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[2]" value="1"></td>';

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[2]" value="0"></td>';

                    }else{

                      if ($ans[2]==1){

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[2]" value="1" checked></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[2]" value="0"></td>';

                      }else{

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[2]" value="1"></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[2]" value="0" checked></td>';

                      }

                    } 

              ?>

              <?php if(empty($rem[2])){$rem[2]=null;}?>

              <td width="50%"><textarea rows="5" class="form-control" name ="sagot[2]"><?=$rem[2]?></textarea><!-- <input type="text" class="form-control" name ="sagot[2]" value="<?=$rem[2]?>"> --></td>

            </tr>

            <tr>

              <td colspan="4"><b>c. Area of Operation</b></td>

            </tr>

            <tr>

              <td style="padding-left: 30px">c.1 The expansion of area of operation is included in the Business Plan/Strategic Plan/Development Plan where it is approved.( Means of verification: Minutes of the GA, Plan)</td>

              <?php if ($ans==null){

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[3]" value="1"></td>';

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[3]" value="0"></td>';

                    }else{

                      if ($ans[3]==1){

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[3]" value="1" checked></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[3]" value="0"></td>';

                      }else{

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[3]" value="1"></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[3]" value="0" checked></td>';

                      }

                    } 

              ?>

              <?php if(empty($rem[3])){$rem[3]=null;}?>

              <td width="50%"><textarea rows="5" class="form-control" name ="sagot[3]"><?=$rem[3]?></textarea><!-- <input type="text" class="form-control" name ="sagot[3]" value="<?=$rem[3]?>"> --></td>

            </tr>

            <tr>

              <td style="padding-left: 30px"> c.2 Presence of potential/existing members in the proposed area of operation (Means of verification: Voting population vs.  list of members in the area, survey if available)</td>

              <?php if ($ans==null){

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[4]" value="1"></td>';

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[4]" value="0"></td>';

                    }else{

                      if ($ans[4]==1){

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[4]" value="1" checked></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[4]" value="0"></td>';

                      }else{

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[4]" value="1"></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[4]" value="0" checked></td>';

                      }

                    } 

              ?>

                 <?php if(empty($rem[4])){$rem[4]=null;} ?>

              <td width="50%"><textarea rows="5" class="form-control" name ="sagot[4]"><?=$rem[4]?></textarea><!-- <input type="text" class="form-control" name ="sagot[4]" value="<?=$rem[4]?>"> --></td>

            </tr>

            

            <tr>

              <td colspan="4"><b>d. Principal Office </b></td>

            </tr>

            <tr>

              <td style="padding-left: 30px">d.1 The proposed principal office is available (Means of verification : ocular inspection or availability or a lease contract of the proposed office address)</td>

              <?php if ($ans==null){

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[5]" value="1"></td>';

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[5]" value="0"></td>';

                    }else{

                      if ($ans[5]==1){

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[5]" value="1" checked></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[5]" value="0"></td>';

                      }else{

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[5]" value="1"></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[5]" value="0" checked></td>';

                      }

                    } 

              ?>

                 <?php if(empty($rem[5])){$rem[5]=null;}?>

              <td width="50%"><textarea rows="5" class="form-control" name ="sagot[5]"><?=$rem[5]?></textarea><!-- <input type="text" class="form-control" name ="sagot[5]" value="<?=$rem[5]?>"> --></td>

            </tr>

            

            <tr>

              <td colspan="4"><b>e. Additional Business  Activity</b></td>

            </tr>

            <tr>

              <td style="padding-left: 30px">e.1. Capital requirements for business type/s to be undertaken is adequate , if not  the cooperative provides strategy for its viability(Means of verification: feasibility study, latest AFS, Standard rate for capital adequacy is 10% formula: net worth over risk asset)</td>

              <?php if ($ans==null){

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[6]" value="1"></td>';

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[6]" value="0"></td>';

                    }else{

                      if ($ans[6]==1){

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[6]" value="1" checked></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[6]" value="0"></td>';

                      }else{

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[6]" value="1"></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[6]" value="0" checked></td>';

                      }

                    } 

              ?>

                 <?php if(empty($rem[6])){$rem[6]=null;}?>

              <td width="50%"><textarea rows="5" class="form-control" name ="sagot[6]"><?=$rem[6]?></textarea><!-- <input type="text" class="form-control" name ="sagot[6]" value="<?=$rem[6]?>"> --></td>

            </tr>

            <tr>

              <td style="padding-left: 30px">e.2. The projected revenue and expenses show positive result.( Means of verification:  feasibility study)</td>

              <?php if ($ans==null){

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[7]" value="1"></td>';

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[7]" value="0"></td>';

                    }else{

                      if ($ans[7]==1){

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[7]" value="1" checked></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[7]" value="0"></td>';

                      }else{

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[7]" value="1"></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[7]" value="0" checked></td>';

                      }

                    } 

              ?>

                 <?php if(empty($rem[7])){$rem[7]=null;}?>

              <td width="50%"><textarea rows="5" class="form-control" name ="sagot[7]"><?=$rem[7]?></textarea><!-- <input type="text" class="form-control" name ="sagot[7]" value="<?=$rem[7]?>"> --></td>

            </tr>

            <tr>

              <td style="padding-left: 30px">e.3. The proposed additional business responds to members' needs (Means of verification: interview, survey if applicable) </td>

              <?php if ($ans==null){

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[8]" value="1"></td>';

                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[8]" value="0"></td>';

                    }else{

                      if ($ans[8]==1){

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[8]" value="1" checked></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[8]" value="0"></td>';

                      }else{

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[8]" value="1"></td>';

                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[8]" value="0" checked></td>';

                      }

                    } 

              ?>

                 <?php if(empty($rem[8])){$rem[8]=null;}?>

              <td width="50%"><textarea rows="5" class="form-control" name ="sagot[8]"><?=$rem[8]?></textarea><!-- <input type="text" class="form-control" name ="sagot[8]" value="<?=$rem[8]?>"> --></td>

            </tr>

            

          </table>

          <table width="100%">

            <tr>

              <td><b>Other Findings</b> <i>(within existing law, rules and regulations and CDA guidelines)</i></td>

            </tr>

            <tr>

              <td><textArea rows="4" cols="147" name="findings"><?php echo $findings;?></textArea></td>

            </tr>

            <tr>

              <td><b>Recommendations</b> <i>(clear and specific as to induce a strong belief/judgment by the approving officer)</i></td>

            </tr>

            <tr>

              <td><textArea rows="4" cols="147" name="comments"><?php echo $comments;?></textArea></td>

            </tr>

          </table>

            

        </div>

      </div>

      <div class="card-footer">

        <div class="row">

          <?php if($coop_info->status==3): ?>

          <div class="col-sm-12  col-md-12 align-self-center order-xs-2 order-sm-2 order-1 col-signup-btn">

              <input class="btn btn-block btn-color-blue" type="submit" id="coopBtn" name="coopBtn" value="Submit Validation Report">

          </div>

        <?php endif;?>

        </div>

      </div>

      <?php echo form_close(); ?>

    </div>

  </div>

</div>

