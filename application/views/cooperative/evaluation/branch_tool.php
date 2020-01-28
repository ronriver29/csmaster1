<div class="row">
  <div class="col">
    <div class="row mb-2">
      <div class="col-sm-12 col-md-12">
        <?php if($branch_info->status>9) : ?>
          <a class="btn btn-secondary btn-sm float-left" href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/documents" role="button" style="margin-right: 50px"><i class="fas fa-arrow-left"></i> Go Back</a>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card mb-4 border-top-blue">
      <div class="card-header">    
        <h4><strong> Validation Tool/Report for Cooperative Branch/Satellite </strong></h4>
      </div>
      <?php echo form_open('cooperative_tool/save_branch', 'name="toolForm" id="toolForm"');?>
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
              <td colspan="4"><b>a. Proposed Branch/Satellite Office Address</b></td>
            </tr>
            <tr>
              <td width="40%" style="padding-left: 30px">a.1The  proposed branch/satellite office address is existing and can be verified (thru ocular inspection or availability or a lease contract of the proposed branch/satellite office address)</td>
              <?php // echo $ans; ?>
                  <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[0]" value="1" required></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[0]" value="0" required></td>';
                    }else{
                      if ($ans[0]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="1" checked required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="0" required></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="1" required></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[0]" value="0" checked required></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[0]" value="<?=$rem[0]?>"></td>
            </tr>
            <tr>
                <td style="padding-left: 30px">a.2. The proposed location of the branch is not within 500-meter radius of a cooperative engaged in the same line of business with that of the proposed branch (<i>Means of verification :ocular inspection</i>)
                  <br><br>
                  *Note: Applicable for Branch only
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
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[1]" value="0" checked required></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[1]" value="<?=$rem[1]?>"></td>
            </tr>
            <tr>
              <td colspan="4"><b>b. Membership</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px">b.1. Existence of members in the area to be served <br>(<i>Means of verification list of members in the area</i>)</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[2]" value="<?=$rem[2]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">b.2. Members are within the common bond of membership</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[3]" value="<?=$rem[3]?>"></td>
            </tr>
            <tr>
                <td style="padding-left: 30px">b.3 The business responds to members' needs <br>(<i>Means of verification: interview, survey if applicable</i>) </td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[4]" value="<?=$rem[4]?>"></td>
            </tr>
            <tr>
              <td colspan="4"><b>c. Business Viability</b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">c.1. availability of the Capital required. <br>(<i>Means of verification: 3 years AFS, operation and budget plan</i>)</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[5]" value="<?=$rem[5]?>"></td>
            </tr>
            
            <tr>
                <td style="padding-left: 30px">c.2. The projected revenue and expenses show positive result.<br>(<i>Means of verification: feasibility study</i>)</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[6]" value="<?=$rem[6]?>"></td>
            </tr>
          </table>
          <table width="100%">
            <tr>
              <td><b>Other Findings</b> <i>(Either compliance / non-compliance to existing law, rules and regulations issued by CDA)</i></td>
            </tr>
            <tr>
              <td><textArea rows="4" cols="147" name="findings"><?php echo $findings;?></textArea></td>
            </tr>
            <tr>
              <td><b>Reasons/justifications on the recommendation</b></td>
            </tr>
            <tr>
              <td><textArea rows="4" cols="147" name="comments"><?php echo $comments;?></textArea></td>
            </tr>
          </table>
            
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <?php if($branch_info->status==9): ?>
          <div class="col-sm-12 offset-md-8 col-md-2 align-self-center order-xs-2 order-sm-2 order-1 col-signup-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="branchBtn" name="branchBtn" value="Submit">
          </div>
        <?php endif;?>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
