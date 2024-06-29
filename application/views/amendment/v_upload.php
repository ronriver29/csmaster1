<!DOCTYPE html>
<html>
<head>
<title>Import Excel File</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
<?=form_open_multipart(base_url().'amendment_upload/importFile');?>
Upload excel file : 
<input type="file" name="uploadFile" value="" /><br><br>
<input type="submit" name="submit" value="Upload" />
<?=form_close();?>
</body>
</html>