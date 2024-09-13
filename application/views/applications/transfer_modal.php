<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="TransferRegionModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="assignSpecialistLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('bns_transfer/transfer_region',array('id'=>'assignSpecialistForm','name'=>'assignSpecialistForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="assignSpecialistLabel">Transfer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <input type="hidden" name="branchID" id="cooperativesID" value="">
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="cooperativeName" class="font-weight-bold">Transfer Region: </label>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="region">Region</label>
                      <select class="custom-select validate[required]" name="region" id="region">
                        <option value="" selected></option>
                        <?php foreach ($regions_list as $region_list) : ?>
                          <option value ="<?php echo $region_list['regCode'];?>"><?php echo $region_list['regDesc']?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="hidden" class="custom-select validate[required]" name="region2" id="region">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="province">Province</label>
                      <select class="custom-select validate[required]" name="province" id="province" readonly>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="city">City/Municipality</label>
                      <select class="custom-select validate[required]" name="city" id="city" readonly>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="barangay">Barangay</label>
                      <select class="custom-select validate[required]" name="barangay" id="barangay" readonly>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="barangay">House/Lot & Blk No.</label>
                      <input class="form-control" name="transferred_houseblk" id="house_blk">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="barangay">Street Name</label>
                      <input class="form-control" name="transferred_street" id="street">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer assignSpecialistFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="TransferBtn" name="TransferBtn" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
  $('#region').on('change',function(){
      $('#province').empty();
      $("#province").prop("disabled",true);
      $('#city').empty();
      $("#city").prop("disabled",true);
      $('#barangay').empty();
      $("#barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#province").prop("disabled",false);
        var region = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/provinces",
          dataType: "json",
          data : {
            region: region
          },
          success: function(data){
            $('#province').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
            });
          }
        });
      }
    });

    $('#province').on('change',function(){
      $('#city').empty();
      $("#city").prop("disabled",true);
      $('#barangay').empty();
      $("#barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#city").prop("disabled",false);
        var province = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/cities",
          dataType: "json",
          data : {
            province: province
          },
          success: function(data){
            $('#city').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
            });
          }
        });
      }
    });

    $('#city').on('change',function(){
      $('#barangay').empty();
      $("#barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#barangay").prop("disabled",false);
        var cities = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/barangays",
          dataType: "json",
          data : {
            cities: cities
          },
          success: function(data){
            $('#barangay').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
            });
          }
        });
      }
    });
</script>