<!DOCTYPE html>
<html>

<head>
  <!-- <script data-require="jquery@*" data-semver="2.2.0" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
   <script data-require="jquery@*" data-semver="2.2.0" src="<?=base_url();?>assets/jqueryui-themes-11.3/smoothness/jquery2.2.0.min.js" /></script>
  <!-- <script data-require="bootstrap@*" data-semver="3.3.6" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
   <script data-require="jquery@*" data-semver="2.2.0" src="<?=base_url();?>assets/jqueryui-themes-11.3/smoothness/bootstrap.min.js" /></script>
  <!-- <link data-require="bootstrap-css@3.3.6" data-semver="3.3.6" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" /> -->
   <link data-require="bootstrap-css@3.3.6" data-semver="3.3.6" rel="stylesheet" href="<?=base_url();?>assets/jqueryui-themes-11.3/smoothness/bootstrap.css" />
  <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" /> -->
  <link rel="stylesheet" href="<?=base_url();?>assets/jqueryui-themes-11.3/smoothness/jquery-ui.css" />

</head>

<body>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <?=form_open();?>
            <div class="form-group">
              <label for="recipient-name" class="control-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          <?=form_close();?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script> -->
  <script src="<?=base_url();?>assets/jqueryui-themes-11.3/smoothness/jquery-ui.min.js"></script>
  
  <script type="text/javascript">
    $('.modal-content').resizable({
      //alsoResize: ".modal-dialog",
      minHeight: 300,
      minWidth: 300
    });
    $('.modal-dialog').draggable();

    $('#myModal').on('show.bs.modal', function() {
      $(this).find('.modal-body').css({
        'max-height': '100%'
      });
    });
  </script>
</body>
</html>