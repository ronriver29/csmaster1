<?php
class Migration_create_head_office_cooptype_bns_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => true,
                 'auto_increment' => true
              ),
              'name'=> array(
                'type' => 'VARCHAR',
                'constraint' =>45,
                 'null' => TRUE,
              ),
              'active'=> array(
                'type' => 'VARCHAR',
                'constraint' =>45,
                 'null' => TRUE,
                 'default' => '1',
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('head_office_coop_type_branch',TRUE);

        $data = array(
        array(
           'id'=>"1",
           'name'=>'Insurance',
           'active'=>'1'
          ),
        array(
           'id'=>"2",
           'name'=>'Cooperative Bank',
           'active'=>'1'
          ),
        array(
           'id'=>"3",
           'name'=>'CSF',
           'active'=>'1'
          ),
        );

      $this->db->insert_batch('head_office_coop_type_branch',$data);
    }

    public function down()
    {
        $this->dbforge->drop_table('head_office_coop_type_branch');

        $this->db->delete('head_office_coop_type_branch',array('id'=>"1"));
        $this->db->delete('head_office_coop_type_branch',array('id'=>"2"));
        $this->db->delete('head_office_coop_type_branch',array('id'=>"3"));
    }
}
?>
