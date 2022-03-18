<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
      <a style="margin-left:15px;" class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>laboratories" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    </div>
  </div>
<!-- <h3 style="margin-left:30px;">Registered</h3> -->
<div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable2">
            <thead>
              <tr>
                <th>Name of Laboratory</th>
                <th>Name of Cooperative</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
       
              <?php foreach ($list_laboratories as $laboratory1) : ?>
                <td><?='Laboratory Cooperative of '.$laboratory1['laboratoryName']?></td>
                <td><?=$laboratory1['coopName']?></td> 
                <td>
                  <?php if($laboratory1['house_blk_no']==null && $laboratory1['streetName']==null) $x=''; else $x=', ';?>
                  <?=$laboratory1['house_blk_no']?> <?=$laboratory1['streetName'].$x?> <?=$laboratory1['brgy']?>, <?=$laboratory1['city']?>, <?= $laboratory1['province']?> <?=$laboratory1['region']?>
                </td>
                <td><span class="badge badge-secondary">REGISTERED</span></td>
                <td>
                    <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory1['id'])) ?>/laboratories_documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                </td>
          </tbody>
          <?php endforeach;?>
          </table>
        </div>
      </div>
    </div>
</div>
</div>