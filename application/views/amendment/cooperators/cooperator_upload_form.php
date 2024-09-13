<?=form_open_multipart(base_url().'/amendment_upload/importcptr');?>
	<div class="form-group">
		<input type="file" name="excel_file" class="form-control">
	</div>

	<div class="form-group">
		<input type="submit" value="submit" name="submit">
	</div>
<?=form_close();?>