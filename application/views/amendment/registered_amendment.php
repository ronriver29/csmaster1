 <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <?php $admin = array(1,2,3,4); ?>
        <?php if(in_array($admin_info->access_level,$admin)){ ?>
          <?php echo form_open('amendment/registered',array('id'=>'cooperativesAddForm','name'=>'cooperativesAddForm')); ?> 
          <div class="row rd-row">
          
            <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="areaOfOperation">Proposed Name: </label>
                <input type="text" name="coopName" class="form-control"/>
              </div>
            </div>
          </div> 
           <div class="row col-sm-6 col-md-1 align-self-center col-reserve-btn">
                <input class="btn btn-color-blue" type="submit" name="submit" value="submit" style="float:left;">
            </div>
        <?php echo form_close(); ?>  
        <hr>
        <?php }?>

      <?php if($admin_info->region_code != '00') :?>
      <h4 style="
      padding: 15px 10px;
      background: #fff;
      background-color: rgb(255, 255, 255);
      border: none;
      border-radius: 0;
 
      box-shadow: 1px 1px 1px 2px rgba(0, 0, 0, 0.1);">Registered</h4>
      </div>

      <div class="col-sm-12 col-md-12">
          <div class="card border-top-blue shadow-sm mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Amendment No.</th>
                      <th>Name of Cooperative</th>
                      <th>Amended Name</th>
                      <th>Office Address</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($list_cooperatives_registered as $cooperative_registered) : ?>
                      <tr>
                        <td><?=$cooperative_registered['amendmentNo']?></td>
                        <td>
                          <?php
                            if(strlen($cooperative_registered['acronym'])>0)
                           {
                            $acronym_ = '('.$cooperative_registered['acronym'].')';
                           }
                           else
                           {
                            $acronym_='';
                           }
                            $count_tYpe = explode(',',$cooperative_registered['type_of_cooperative']);
                          if(count($count_tYpe)>1)

                          {
                            $proposeNames = $cooperative_registered['proposed_name'].' Multipurpose Cooperative '.$acronym_;
                          }
                          else
                          {
                            $proposeNames = $cooperative_registered['proposed_name'].' '.$cooperative_registered['type_of_cooperative']. ' Cooperative '.$acronym_;
                          }
                          echo $this->amendment_model->proposed_name_comparison($cooperative_registered['regNo'],$cooperative_registered['amendmentNo'],$proposeNames);
                          ?>  
                          <td><?= (strcasecmp(trim(preg_replace('/\s\s+/', ' ',$this->amendment_model->get_last_proposed_name($cooperative_registered['regNo'],$cooperative_registered['amendmentNo']))),trim(preg_replace('/\s\s+/', ' ',$proposeNames)))!=0 ? $proposeNames : "")?></td>

                        <td>
                          <?php if($cooperative_registered['house_blk_no']==null && $cooperative_registered['street']==null) $x=''; else $x=', ';?>
                          <?=$cooperative_registered['house_blk_no']?> <?=$cooperative_registered['street'].$x?><?=$cooperative_registered['brgy']?>, <?=$cooperative_registered['city']?>, <?= $cooperative_registered['province']?> <?=$cooperative_registered['region']?>
                        </td>
                        <td>
                          <span class="badge badge-secondary">
                            <?php if($cooperative_registered['status']==15) { echo "REGISTERED"; }?>
                          </span>
                        </td>
                        <td width="31%">
                          <?php $ar = array(2,5); $viewdoc_array = array(2,3,5) ?>
                          <?php if(in_array($admin_info->access_level,$ar)):?>
                            <ul id="ul-admin">
                              <li style="list-style: none;">
                            <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/amendment_registration" class="btn btn-sm btn-info"><i class='fas fa-print'></i> Re-print Registration</a>
                          </li>
                           <?php endif; ?>
                           <?php if(in_array($admin_info->access_level,$viewdoc_array)): ?>
                          <li style="list-style: none;">
                            <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/amendment_documents" class="btn btn-sm btn-info"><i class='fas fa-eye'></i> View Document</a>
                          </li>
                           <?php endif; //end of viewdoc array?>
                        </ul>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <?=$links?>
              </div>
            </div>
          </div>
        </div><?endif; ?>
    </div>
  </div>
</div>        