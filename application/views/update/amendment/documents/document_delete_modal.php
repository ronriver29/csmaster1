<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deletePDFModal_amendment" data-backdrop="static" data-hidden.bs.modal="this.form.reset(); "tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('amendment_update_documents/delete_pdf',array('id'=>'deleteDocumentForm','name'=>'deleteDocumentForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="validate[required]" id="amendment_id" name="amendment_id">
              <input type="hidden" class="validate[required]" id="pdfID" name="pdfID">
              <input type="hidden" class="validate[required]" id="file_name" name="file_name">
              <input type="hidden" class="validate[required]" id="doc_type_" name="doc_type_"/>
              <div class="alert alert-warning" role="alert">
               <!--  <strong><b>Warning:</b></strong>
                <p><strong class="pdf-name-text">test</strong> file will be remove in <strong class="pdf-cname-text">test</strong> uploaded documents. There is no way to recover this.</p> -->
                <p><strong class="pdf-name-text"></strong> file will be remove in uploaded documents. There is no way to recover this.</p>

              </div>
            </div>
            <div class="modal-footer deleteCommitteeFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="deleteCommitteeBtn" name="deleteCommitteeBtn" value="Delete">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
