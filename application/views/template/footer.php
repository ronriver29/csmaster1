<div class="col-md-12" style="color:#cccc;">
  <center><small> <?php print_r(isset($resources) ? $resources : '')?></small></center>
</div>
</div>

<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url();?>assets/js/datatables/dataTables.scroller.min.js"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="<?=base_url();?>assets/js/malibu_scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<!-- <link href="https://allfont.net/allfont.css?fonts=bookman-old-style" rel="stylesheet" type="text/css" /> -->
<script src="<?=base_url();?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script  src="<?=base_url();?>assets/js/sweetalert2.min.js"></script>
<script src="<?=base_url();?>assets/js/custom-script.js"></script>
<script src="<?=base_url();?>assets/js/custom-error-messages.js"></script>
<script src="<?=base_url();?>assets/js/toword.js"></script>
<!-- <script src="<?=base_url();?>assets/js/update_cooperative_info.js"></script> -->
<?php if($this->uri->segment(2) == "registration" && $is_client)   : ?><script src="<?=base_url();?>assets/js/add-registration.js"></script> <?php endif; ?>
<?php if($this->uri->segment(2) == "reservation" && $is_client)   : ?><script src="<?=base_url();?>assets/js/add-reservation.js"></script> <?php endif; ?>
<?php if($this->uri->segment(2) == "application" && $is_client)   : ?><script src="<?=base_url();?>assets/js/add-amendment.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "rupdate" && $is_client)   : ?><script src="<?=base_url();?>assets/js/update-reservation.js"></script> <?php endif; ?>


<?php if($this->uri->segment(3) == "amendment_update" && $is_client)   : ?><script src="<?=base_url();?>assets/js/update-amendment.js"></script> <?php endif; ?>


<?php if($this->uri->segment(3) == "rupdate" && !$is_client)   : ?><script src="<?=base_url();?>assets/js/update-reservation-admin.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "bupdate" && $is_client)   : ?><script src="<?=base_url();?>assets/js/update-branch-reservation.js"></script> <?php endif; ?>

<?php if($this->uri->segment(3) == "amendment_cooperators" && $this->uri->segment(4)=="add")   : ?><script src="<?=base_url();?>assets/js/add_cooperator_amendment.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "amendment_purposes" && $this->uri->segment(4)=="edit")   : ?><script src="<?=base_url();?>assets/js/update_amendment_purposes.js"></script> <?php endif; ?>



<?php if($this->uri->segment(3) == "amendment_cooperators" && $this->uri->segment(5)=="edit")   : ?><script src="<?=base_url();?>assets/js/edit_cooperator_amendment.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "cooperators" && $this->uri->segment(4)=="add")   : ?><script src="<?=base_url();?>assets/js/add_cooperator_custom.js"></script> <?php endif; ?>

<?php if($this->uri->segment(3) == "affiliators_update") : ?><script src="<?=base_url();?>assets/js/edit_affiliator_update_custom.js"></script>
<script src="<?=base_url();?>assets/js/add_affiliator_update_custom.js"></script><?php endif; ?>

<?php if($this->uri->segment(3) == "affiliators") : ?><script src="<?=base_url();?>assets/js/edit_affiliator_custom.js"></script>
<script src="<?=base_url();?>assets/js/add_affiliator_custom.js"></script><?php endif; ?>

<?php if($this->uri->segment(3) == "cooperators" && $this->uri->segment(5)=="edit")   : ?><script src="<?=base_url();?>assets/js/edit_cooperator_custom.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "purposes" && $this->uri->segment(4)=="edit")   : ?><script src="<?=base_url();?>assets/js/update-purposes.js"></script> <?php endif; ?>

<?php if($this->uri->segment(3) == "laboratories_cooperators" && $this->uri->segment(4)=="add")   : ?><script src="<?=base_url();?>assets/js/add_cooperator_lab_custom.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "laboratories_cooperators" && $this->uri->segment(4)=="edit")   : ?><script src="<?=base_url();?>assets/js/update-purposes.js"></script> <?php endif; ?>

<?php if($this->uri->segment(1) == "cooperatives_update" && $this->uri->segment(2)=="update"): ?><script src="<?=base_url();?>assets/js/update_cooperative_info.js"></script> <?php  endif; ?>
<?php if($this->uri->segment(3) == "purposes_update" && $this->uri->segment(4)=="edit"): ?><script src="<?=base_url();?>assets/js/purposes_update.js"></script> <?php  endif; ?>
<?php if($this->uri->segment(5) == "cooperators_update" && $this->uri->segment(6)=="edit"): ?><script src="<?=base_url();?>assets/js/edit_cooperator_update_custom.js"></script> <?php  endif; ?>
<?php if($this->uri->segment(3) == "cooperators_update" && $this->uri->segment(4)=="add"): ?><script src="<?=base_url();?>assets/js/add_cooperator_update_custom.js"></script> <?php  endif; ?>

<?php if($this->uri->segment(1) == "amendment_update" && $this->uri->segment(3)=="update"): ?><script src="<?=base_url();?>assets/js/amendment_update.js"></script> <?php  endif; ?>

<?php if($this->uri->segment(3) == "amendment_cooperator" && $this->uri->segment(4)=="add")   : ?><script src="<?=base_url();?>assets/js/add_cooperator_update_amendment.js"></script> <?php endif; ?>

<script type="text/javascript"> 
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            $(window).on('resize', function(){
               if($(this).width() >= 1024){
                 if($('#sidebar, #content').hasClass('active')){
                   tempwidth = $(this).width();
                    $('#sidebar, #content').toggleClass('active');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                 }
               }
            });
        });
        var i =0;
        $('#addCoop').on('click',function(event){
            var text3 = $('#newName').val();
            var text2 = $('.newName2').val();
            var multi = " Multi-Purpose";
            var text = text3 + multi;
    //            alert(multi_purpose);
//            $('#coopName').val(text);
//            alert(text2);
            if($('.newName2').val() == text3){
                $('#newName').val(text);
            } else {
//                alert($('#coopName').val());
            }
            i++;
//            alert(i);
            
        
        });
        $(document).on('click', '.customDeleleBtn', function () {
            --i;
//            alert(i);
            var text2 = $('.newName2').val();
            var text = $('#newName').val();
            if(i == 0){
                $('#newName').val(text2);
            }
            
        //    alert(text);
        });
        
    </script>
</body>
</html>
