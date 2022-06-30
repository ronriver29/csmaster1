<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_committees" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Edit Committee</h5>
  </div>
</div>
<?php if(validation_errors()) : ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger" role="alert">
      <ul>
        <?php echo validation_errors('<li>','</li>'); ?>
      </ul>
    </div>
  </div>
</div>
<?php endif;  ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('amendment_update/'.$encrypted_id.'/committees_update/'.$encrypted_committee_id.'/edit',array('id'=>'editCommitteeFormAmendment','name'=>'editCommitteeForm')); ?>
      <div class="card-body">
        <div class="row ac-row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control" id="committeeID" name="committeeID" value="<?=$encrypted_committee_id?>">

          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="committeeName">Name of Committee:</label>
              <?php 
               $count_type='';
                $count_type = count(explode(',',$coop_info->type_of_cooperative));
              ?>
               <select class="custom-select validate[required]" name="committeeName" id="committeeName">
                                <option value="Audit" <?php if($committee_info->name=="Audit") echo "selected";?> >Audit</option>
                  <option value="Election" <?php if($committee_info->name=="Election") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Election</option>
                  <option value="Education and Training" <?php if($committee_info->name=="Education and Training") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Education and Training</option>
                  <option value="Mediation and Conciliation" <?php if($committee_info->name=="Mediation and Conciliation") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Mediation and Conciliation</option>
                  <option value="Ethics" <?php if($committee_info->name=="Ethics") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Ethics</option>
                 
                 <?php if ($coop_info->type_of_cooperative == 'Credit' || $coop_info->type_of_cooperative == 'Agriculture' || $coop_info->type =='Multipurpose' || $coop_info->type_of_cooperative == 'Advocacy' || $coop_info->type_of_cooperative =='Agrarian Reform'  || $coop_info->type_of_cooperative =='Consumers' || $count_type>1){?>
                    <option id="A" value="Credit">Credit</option>
                  <?php } ?>
                   <option value="Gender and Development" <?php if($committee_info->name=="Gender and Development") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Gender and Development</option>
                    <?php foreach ($custom_committees as $custom_committee) : ?>
                    <option value="<?= $custom_committee['name'] ?> " <?php if($committee_info->name==$custom_committee['name']) echo "selected";?> > <?= $custom_committee['name'] ?> </option>
                  <?php endforeach;unset($custom_committee); ?>
               <!--  <option value="Others">Others</option> -->

                    </select>  

               <?php /*
             <!--  <?= $cooperator_info->position?> -->
              <select class="custom-select validate[required]" name="committeeName" id="committeeName">
                <option value="" <?php if($committee_info->name=="") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>--</option>
                <?php
                if($cooperator_info->position=='Treasurer' || ($committee_info->type =='others'))
                {
                ?>
                <option value="Audit" <?php if($committee_info->name=="Audit") echo "selected";?> disabled>Audit</option>
                <option value="Election" <?php if($committee_info->name=="Election") echo "selected";?> disabled>Election</option>
                <option value="Education and Training" <?php if($committee_info->name=="Education and Training") echo "selected";?> disabled>Education and Training</option>
                <option value="Mediation and Conciliation" <?php if($committee_info->name=="Mediation and Conciliation") echo "selected";?> disabled>Mediation and Conciliation</option>
                <option value="Ethics" <?php if($committee_info->name=="Ethics") echo "selected";?> disabled>Ethics</option>

                  <option value="Gender and Development" <?php if($committee_info->name=="Gender and Development") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Gender and Development</option>
                <?php
                }
                elseif($cooperator_info->position=='Vice-Chairperson' || ($committee_info->type =='others'))
                {
                ?>
                  <option value="Audit" <?php if($committee_info->name=="Audit") echo "selected";?> disabled>Audit</option>
                <option value="Election" <?php if($committee_info->name=="Election") echo "selected";?> disabled>Election</option>
                <option value="Education and Training" <?php if($committee_info->name=="Education and Training") echo "selected";?> >Education and Training</option>
                <option value="Mediation and Conciliation" <?php if($committee_info->name=="Mediation and Conciliation") echo "selected";?> disabled>Mediation and Conciliation</option>
                <option value="Ethics" <?php if($committee_info->name=="Ethics") echo "selected";?> disabled>Ethics</option>

                  <option value="Gender and Development" <?php if($committee_info->name=="Gender and Development") echo "selected";?>>Gender and Development</option>

                <?php  
                }
                elseif($cooperator_info->position=='Board of Director' || $committee_info->type =='others')
                {
                ?>
                   <option value="Audit" <?php if($committee_info->name=="Audit") echo "selected";?> disabled>Audit</option>
                  <option value="Election" <?php if($committee_info->name=="Election") echo "selected";?> disabled>Election</option>
                  <option value="Education and Training" <?php if($committee_info->name=="Education and Training") echo "selected";?> disabled>Education and Training</option>
                  <option value="Mediation and Conciliation" <?php if($committee_info->name=="Mediation and Conciliation") echo "selected";?> disabled>Mediation and Conciliation</option>
                  <option value="Ethics" <?php if($committee_info->name=="Ethics") echo "selected";?> disabled>Ethics</option>

                  <option value="Gender and Development" <?php if($committee_info->name=="Gender and Development") echo "selected";?>>Gender and Development</option>

                <?php
                }
                elseif($cooperator_info->position=='Secretary' || $committee_info->type =='others')
                {
                ?>
                  <option value="Audit" <?php if($committee_info->name=="Audit") echo "selected";?> disabled>Audit</option>
                  <option value="Election" <?php if($committee_info->name=="Election") echo "selected";?> disabled>Election</option>
                  <option value="Education and Training" <?php if($committee_info->name=="Education and Training") echo "selected";?> disabled>Education and Training</option>
                  <option value="Mediation and Conciliation" <?php if($committee_info->name=="Mediation and Conciliation") echo "selected";?> disabled>Mediation and Conciliation</option>
                  <option value="Ethics" <?php if($committee_info->name=="Ethics") echo "selected";?> disabled>Ethics</option>

                  <option value="Gender and Development" <?php if($committee_info->name=="Gender and Development") echo "selected";?>>Gender and Development</option>
                <?php
                }
                elseif($cooperator_info->position=='Member' )
                {
                ?>
                   <option value="Audit" <?php if($committee_info->name=="Audit") echo "selected";?> >Audit</option>
                  <option value="Election" <?php if($committee_info->name=="Election") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Election</option>
                  <option value="Education and Training" <?php if($committee_info->name=="Education and Training") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Education and Training</option>
                  <option value="Mediation and Conciliation" <?php if($committee_info->name=="Mediation and Conciliation") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Mediation and Conciliation</option>
                  <option value="Ethics" <?php if($committee_info->name=="Ethics") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Ethics</option>

                  <option value="Gender and Development" <?php if($committee_info->name=="Gender and Development") echo "selected";?> <?=($committee_info->type =='others' ? "disabled" : " ")?>>Gender and Development</option>
                <?php  
                }
                ?>
              
               
               <?php if ($coop_info->type_of_cooperative == 'Credit' || $coop_info->type_of_cooperative == 'Agriculture' || $coop_info->type =='Multipurpose' || $coop_info->type_of_cooperative == 'Advocacy' || $coop_info->type_of_cooperative =='Agrarian Reform'  || $coop_info->type_of_cooperative =='Consumers' || $count_type>1){?>
                  <option id="A" value="Credit">Credit</option>
                <?php } ?>

                <?php foreach ($custom_committees as $custom_committee) : ?>
                  <option value="<?= $custom_committee['name'] ?> " <?php if($committee_info->name==$custom_committee['name']) echo "selected";?> > <?= $custom_committee['name'] ?> </option>
                <?php endforeach; ?>
               <!--  <option value="Others">Others</option> -->
              </select>
              */?>
            </div>
          </div>
        </div>
        
         <?php
          if($committee_info->type=='others')
          {
        ?>
        <div class="row">
          <div class="col-md-6">
            <label> Function and Responsibilities:</label>
               <textarea name="func_and_respons" class="form-control" rows="5"> <?=$committee_info->func_and_respons?>  </textarea>
          </div>
        </div>
        <br>
        <?php
          }
        ?>

      </div>
      <div class="card-footer editCommitteeFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="editCommitteeBtn" name="editCommitteeBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
