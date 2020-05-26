<?php
class Migration_modify_uploaded_documents_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'document_num'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );

        $this->dbforge->add_column('uploaded_documents',$field);
    }

    public function down()
    {
       $this->dbforge->modify_column('uploaded_documents', 'amendment_id');
    }
}
?>