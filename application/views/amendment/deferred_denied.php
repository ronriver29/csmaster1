 <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <?php if($admin_info->access_level ==2) { ?>
          <?php echo form_open('amendment',array('id'=>'cooperativesAddForm','name'=>'cooperativesAddForm')); ?> 
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

      <?php  if($admin_info->region_code != '00' && $admin_info->access_level==2) :?>
        <h4 style="
        padding: 15px 10px;
        background: #fff;
        background-color: rgb(255, 255, 255);
        border: none;
        border-radius: 0;
        margin-bottom: 20px;
        box-shadow: 1px 1px 1px 2px rgba(0, 0, 0, 0.1);">Deferred/Denied</h4>

        <div class="card border-top-blue shadow-sm mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="cooperativesTable">
                <thead>
                  <tr>
                    <th>Amendment No.</th>
                    <th>Name of Cooperative</th>
                    <th>Amended Name</th>
                    <th>Office Address</th>
                    <th>Status</th>
                    <th>Action </th>
                  </tr>
                </thead>
                <?php
                  foreach($list_of_defer_deny as $cooperative)
                  {
                ?>
                    <tr>
                          <td><?=$cooperative['amendmentNo']?></td>
                          <td>
                           <?php
                           if(strlen($cooperative['acronym'])>0)
                           {
                            $acronym_ = '('.$cooperative['acronym'].')';
                           }
                           else
                           {
                            $acronym_='';
                           }
                            $count_tYpe = explode(',',$cooperative['type_of_cooperative']);
                            if(count($count_tYpe)>1)

                            {
                              $proposeNames = $cooperative['proposed_name'].' Multipurpose Cooperative '.$acronym_.' '.$cooperative['grouping'];
                            }
                            else
                            {
                              $proposeNames = $cooperative['proposed_name'].' '.$cooperative['type_of_cooperative']. ' Cooperative '.$acronym_.' '.$cooperative['grouping'];
                            }
                           echo $this->amendment_model->proposed_name_comparison($cooperative['regNo'],$cooperative['amendmentNo'],$proposeNames);
                            ?>  
                            <td><?= (strcasecmp(trim(preg_replace('/\s\s+/', ' ',$this->amendment_model->get_last_proposed_name($cooperative['regNo'],$cooperative['amendmentNo']))),trim(preg_replace('/\s\s+/', ' ',$proposeNames)))!=0 ? $proposeNames : "")?></td>

                          <td>
                              <?php if($cooperative['house_blk_no']==null && $cooperative['street']==null) $x=''; else $x=', ';?>
                              <?=$cooperative['house_blk_no']?> <?=$cooperative['street'].$x?><?=$cooperative['brgy']?>, <?=$cooperative['city']?>, <?= $cooperative['province']?> <?=$cooperative['region']?>
                          </td>
                          <td>  
                          <span class="badge badge-secondary">
                       
                                <?php if($cooperative['status']==10) echo "DENIED BY DIRECTOR";
                                else if($cooperative['status']==11 && !$this->amendment_model->check_if_revert($cooperative['id'])) echo "DEFERRED";
                                else if($cooperative['status']==11 && $this->amendment_model->check_if_revert($cooperative['id'])) echo "REVERTED-DEFERRED";
                                else if($cooperative['status']==6 && $cooperative['third_evaluated_by']>0) echo "FOR RE-EVALUATION"; ?>
                            
                          </span>
                          </td>

                          <td> 
                          <?php if($cooperative['status'] ==10 || $cooperative['status'] ==11 && $admin_info->access_level ==2):?>
                            <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          <?php endif;?>
                          </td>                    
                    </tr>        
                <?php    
                  }
                ?>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php endif;?>  
    </div>
  </div>
</div>        