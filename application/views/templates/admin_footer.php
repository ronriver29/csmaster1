<!-- <div class="col-md-12" style="color:#cccc;">
  <center><small> <?php print_r(isset($resources) ? $resources : '')?></small></center>
</div> -->
</div>
<!-- <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script> -->
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url();?>assets/js/datatables/dataTables.scroller.min.js"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="<?=base_url();?>assets/js/malibu_scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?=base_url();?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script  src="<?=base_url();?>assets/js/sweetalert2.min.js"></script>
<script src="<?=base_url();?>assets/js/custom-script.js"></script>
<script src="<?=base_url();?>assets/js/custom-error-messages.js"></script>
<script src="<?=base_url();?>assets/js/toword.js"></script>

<?php  if($this->uri->segment(1) !='amendment_update'):?>
<script src="<?=base_url();?>assets/js/add-registration.js"></script>
<?php endif;?>

<!-- <?php if($this->uri->segment(3) == "rupdate" && $is_client)   : ?><script src="<?=base_url();?>assets/js/update-reservation.js"></script> <?php endif; ?> -->
<!-- <?php if($this->uri->segment(3) == "rupdate" && !$is_client)   : ?><script src="<?=base_url();?>assets/js/update-reservation-admin.js"></script> <?php endif; ?> -->
<!-- <?php if($this->uri->segment(3) == "purposes" && $this->uri->segment(4)=="edit")   : ?><script src="<?=base_url();?>assets/js/update-purposes.js"></script> <?php endif; ?> -->
<?php if($this->uri->segment(2) == "reservation" && $is_client)   : ?><script src="<?=base_url();?>assets/js/add-reservation.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "rupdate" && $is_client)   : ?><script src="<?=base_url();?>assets/js/update-reservation.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "rupdate" && !$is_client)   : ?><script src="<?=base_url();?>assets/js/update-reservation-admin.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "cooperators" && $this->uri->segment(4)=="add")   : ?><script src="<?=base_url();?>assets/js/add_cooperator_custom.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "cooperators" && $this->uri->segment(5)=="edit")   : ?><script src="<?=base_url();?>assets/js/edit_cooperator_custom.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "purposes" && $this->uri->segment(4)=="edit")   : ?><script src="<?=base_url();?>assets/js/update-purposes.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "purposes_update" && $this->uri->segment(4)=="edit")   : ?><script src="<?=base_url();?>assets/js/update-purposes.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "amendment_update")   : ?><script src="<?=base_url();?>assets/js/update-amendment.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "amendment_purposes" && $this->uri->segment(4)=="edit")   : ?><script src="<?=base_url();?>assets/js/update_amendment_purposes.js"></script> <?php endif; ?>
<?php if($this->uri->segment(1) == "amendment_update" && $this->uri->segment(3)=="update"): ?><script src="<?=base_url();?>assets/js/amendment_update.js"></script> <?php  endif; ?>
<?php if($this->uri->segment(3) == "amendment_cooperator" && $this->uri->segment(4)=="add")   : ?><script src="<?=base_url();?>assets/js/add_cooperator_update_amendment.js"></script> <?php endif; ?>
<?php if($this->uri->segment(3) == "laboratories_cooperators_update" && $this->uri->segment(4)=="add")   : ?><script src="<?=base_url();?>assets/js/add_cooperator_lab_custom.js"></script> <?php endif; ?>
<?php if($this->uri->segment(1) == "api_access"): ?><script src="<?=base_url();?>assets/js/api_access.js"></script> <?php endif; ?>
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
    </script>
</body>
</html>
