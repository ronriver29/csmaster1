<style type="text/css">
  #ul-admin {
  list-style-type: none;
  margin: 0;
  padding: 0;
 
  }
  #ul-admin li a{
    text-decoration:none;
    float:right;
   width: auto;
   margin-left: 5px;
  }
  .page-link{
    height: 3.5rem;
    width: 3.5rem;
    overflow: hidden;
  }
</style>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <?php echo form_open('updated_amendment_info/registered_updated',array('id'=>'amendmentAddForm','name'=>'amendmentAddForm')); ?>
        <div class="row rd-row">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="areaOfOperation">Cooperative Name: </label>
              <input type="text" name="coopName" class="form-control"/>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="areaOfOperation">Registration No.: </label>
              <input type="text" name="regNo" class="form-control">
            </div>
          </div>
        </div>
        <div class="row col-sm-6 col-md-1 align-self-center col-reserve-btn">
          <input class="btn btn-color-blue" type="submit" name="btn-filter" value="search" style="float:left;">
        </div>
        <?php echo form_close(); ?>
        <hr>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Amendment No.</th>
                <th>Name of Cooperative</th>
                <th>Office Address</th>
                <th>Status</th>
                <th>Date Registered</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_cooperatives_registered as $cooperative_registered) : ?>
              <tr>
                <td><?=$cooperative_registered['amendmentNo']?></td>
                <td> <?=$cooperative_registered['coopName']?>
                  <!-- <?php if($cooperative_registered['grouping'] == 'Federation'){?>
                  <?= $cooperative_registered['proposed_name']?> Federation of <?= $cooperative_registered['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative_registered['acronym_name'])){ echo '('.$cooperative_registered['acronym_name'].')';
                  }?>
                  <?php } else if($cooperative_registered['grouping'] == 'Union' && $cooperative_registered['type_of_cooperative'] == 'Union') { ?>
                  <?= $cooperative_registered['proposed_name']?> <?= $cooperative_registered['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative_registered['acronym_name'])){ echo '('.$cooperative_registered['acronym_name'].')';}?>
                  <?php } else { ?>
                  
                  <?= $cooperative_registered['proposed_name']?> <?= $cooperative_registered['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative_registered['acronym_name'])){ echo '('.$cooperative_registered['acronym_name'].')';}?> <?= $cooperative_registered['grouping']?>
                <?php }?> --></td>
                <td>
                  <?php if($cooperative_registered['house_blk_no']==null && $cooperative_registered['street']==null) $x=''; else $x=', ';?>
                  <?=$cooperative_registered['house_blk_no']?> <?=$cooperative_registered['street'].$x?><?=$cooperative_registered['brgy']?>, <?=$cooperative_registered['city']?>, <?= $cooperative_registered['province']?> <?=$cooperative_registered['region']?>
                </td>
                <td>
                  <span class="badge badge-secondary">
                    <?php if($cooperative_registered['status']==41) { echo "REGISTERED"; }?>
                  </span>
                </td>
                <td><?=date("F d, Y",strtotime($cooperative_registered['dateRegistered']))?></td>
                <td>
                  <?php if($cooperative_registered['status']==41): ?>
                  <a href="<?php echo base_url();?>amendment_update/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                  <?php endif; ?>
                </td>
              </ul>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?=$links?>
        </div> <!-- card body -->
      </div>
    </div>
</div> <!-- end of row -->
 
 