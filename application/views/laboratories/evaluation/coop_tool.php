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
              <td><b>Yes</b></td>
              <td><b>No</b></td>
              <td><b>Remarks</b></td>
            </tr>
            <tr>
              <td colspan="4"><b>a. Pre-Membership Education Seminar (PMES) conducted by:</b></td>
            </tr>
            <tr>
              <td width="40%" style="padding-left: 30px">a.1. Accredited Training Providers</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[0]" value="<?=$rem[0]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">a.2. Local Government Unit</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[1]" value="<?=$rem[1]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">a.3. CDA</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[2]" value="<?=$rem[2]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">a.4. Others, please specify</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[3]" value="<?=$rem[3]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">a.5. Basic concept of cooperative understood by members</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[4]" value="<?=$rem[4]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">a.6 Presence/proof of attendance(all cooperators)</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[5]" value="<?=$rem[5]?>"></td>
            </tr>
            <tr>
              <td colspan="4"><b>b. Organization</b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">b.1. Consistency of name, purpose & objective in the Articles, Bylaws and Economic Survey (real intent versus document)</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[6]" value="<?=$rem[6]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">b.2. Presence of interim Core Management Team</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[7]" value="<?=$rem[7]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">b.3. Presence of complete/actual proposed office address</td>
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
              <td width="50%"><input type="text" class="form-control" name ="sagot[8]" value="<?=$rem[8]?>"></td>
            </tr>
            <tr>
              <td colspan="4"><b>c. Membership</b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">c.1. Presence of common bond of interest and field of membership</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[9]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[9]" value="0"></td>';
                    }else{
                      if ($ans[9]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[9]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[9]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[9]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[9]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[9]" value="<?=$rem[9]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">c.2. Presence of actual members and compliance with Voluntary and Open Membership principle</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[10]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[10]" value="0"></td>';
                    }else{
                      if ($ans[10]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[10]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[10]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[10]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[10]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[10]" value="<?=$rem[10]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">c.3. Members reside within area of operation(verify Brgy. records or interview officials/ residents)</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[11]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[11]" value="0"></td>';
                    }else{
                      if ($ans[11]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[11]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[11]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[11]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[11]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[11]" value="<?=$rem[11]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">c.4. If associational, is it registered with concerned regulatory authority?</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[12]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[12]" value="0"></td>';
                    }else{
                      if ($ans[12]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[12]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[12]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[12]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[12]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[12]" value="<?=$rem[12]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">c.5. Presence of appointed officer/s related to members of BOD within the 3rd degree</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[13]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[13]" value="0"></td>';
                    }else{
                      if ($ans[13]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[13]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[13]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[13]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[13]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[13]" value="<?=$rem[13]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">c.6. Presence of dual membership in case of similar/labor service type of coop (reason for joining similar coop type)</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[14]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[14]" value="0"></td>';
                    }else{
                      if ($ans[14]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[14]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[14]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[14]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[14]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[14]" value="<?=$rem[14]?>"></td>
            </tr>
            <tr>
              <td colspan="4"><b>d. Capital Contribution of Members</b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">d.1. Presence of actual member’s contribution</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[15]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[15]" value="0"></td>';
                    }else{
                      if ($ans[15]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[15]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[15]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[15]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[15]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[15]" value="<?=$rem[15]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">d.2. Proof of contribution/acknowledgement receipt</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[16]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[16]" value="0"></td>';
                    }else{
                      if ($ans[16]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[16]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[16]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[16]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[16]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[16]" value="<?=$rem[16]?>"></td>
            </tr>
            <tr>
              <td colspan="4"><b>e. Document Requirements</b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">e.1. Presence of complete registration document requirements (if incomplete documents submitted)</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[17]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[17]" value="0"></td>';
                    }else{
                      if ($ans[17]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[17]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[17]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[17]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[17]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[17]" value="<?=$rem[17]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">e.2. Authenticity of Signatures</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[18]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[18]" value="0"></td>';
                    }else{
                      if ($ans[18]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[18]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[18]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[18]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[18]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[18]" value="<?=$rem[18]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">e.3. Duplication of officer’s functions</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[19]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[19]" value="0"></td>';
                    }else{
                      if ($ans[19]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[19]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[19]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[19]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[19]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[19]" value="<?=$rem[19]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">e.4. Complied with other special documents requirements for other selected types of coops</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[20]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[20]" value="0"></td>';
                    }else{
                      if ($ans[20]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[20]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[20]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[20]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[20]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[20]" value="<?=$rem[20]?>"></td>
            </tr>
            <tr>
              <td colspan="4"><b>f. Viability/Feasibility</b></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">f.1. Capital adequacy for business type/s to be undertaken and the strategy for viability</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[21]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[21]" value="0"></td>';
                    }else{
                      if ($ans[21]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[21]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[21]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[21]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[21]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[21]" value="<?=$rem[21]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">f.2. Adequate Surety Bond Coverage</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[22]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[22]" value="0"></td>';
                    }else{
                      if ($ans[22]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[22]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[22]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[22]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[22]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[22]" value="<?=$rem[22]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">f.3. Presence of projected viable financial expense and  revenue </td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[23]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[23]" value="0"></td>';
                    }else{
                      if ($ans[23]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[23]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[23]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[23]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[23]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[23]" value="<?=$rem[23]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">f.4. Appropriate business for member’s needs and coop type</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[24]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[24]" value="0"></td>';
                    }else{
                      if ($ans[24]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[24]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[24]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[24]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[24]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[24]" value="<?=$rem[24]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">f.5. Presence of the same coop type/viability of co-existence in the same area of operation</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[25]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[25]" value="0"></td>';
                    }else{
                      if ($ans[25]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[25]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[25]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[25]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[25]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[25]" value="<?=$rem[25]?>"></td>
            </tr>
            <tr>
              <td style="padding-left: 30px">f.6. Is the proposed cooperative assisted by NGO/GA/LGU/etc.?</td>
              <?php if ($ans==null){
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[26]" value="1"></td>';
                      echo '<td width="5%"><input type="radio" class="form-control validate[required]" name="ans[26]" value="0"></td>';
                    }else{
                      if ($ans[26]==1){
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[26]" value="1" checked></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[26]" value="0"></td>';
                      }else{
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[26]" value="1"></td>';
                        echo '<td><input type="radio" class="form-control validate[required]" name="ans[26]" value="0" checked></td>';
                      }
                    } 
              ?>
              <td width="50%"><input type="text" class="form-control" name ="sagot[26]" value="<?=$rem[26]?>"></td>
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
          <div class="col-sm-12 offset-md-8 col-md-2 align-self-center order-xs-2 order-sm-2 order-1 col-signup-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="coopBtn" name="coopBtn" value="Submit">
          </div>
        <?php endif;?>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
