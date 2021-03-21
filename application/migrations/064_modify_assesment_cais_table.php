<?php
class Migration_modify_assesment_cais_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'assessment_year'=>array(
                    'type'=>'INT',
                    'constraint' =>11,
                    ),
                    'compliance'=>array(
                    'type'=>'DOUBLE',
                    // 'constraint' =>11
                    ),
                    'financial'=>array(
                    'type'=>'DOUBLE',
                    // 'constraint' =>11
                    ),
                    'social'=>array(
                    'type'=>'DOUBLE',
                    // 'constraint' =>11
                    ),
                    'total' => array(
                      'type' => 'DOUBLE',
                    ),
                     'totalCompliance' => array(
                      'type' => 'INT',
                      'constraint'=>11
                    ),
                      'credit' => array(
                      'type' => 'TEXT',
                      // 'constraint'=>11
                    ),
                      'transport' => array(
                      'type' => 'TEXT',
                    ),
                      'labor' => array(
                      'type' => 'TEXT',
                    ),
                      'health' => array(
                      'type' => 'TEXT',
                    ),
                      'small' => array(
                      'type' => 'TEXT',
                    ),
                      'electric' => array(
                      'type' => 'TEXT',
                    ),
                      'agrarian' => array(
                      'type' => 'TEXT',
                    ),
                      'producers' => array(
                      'type' => 'TEXT',
                    ),
                    'bank' => array(
                      'type' => 'TEXT',
                    ),
                    'water' => array(
                      'type' => 'TEXT',
                    ),
                    'housing' => array(
                      'type' => 'TEXT',
                    ),  
                     'assesment_id' => array(
                      'type' => 'INT',
                      'constraint'=>11
                    ),                           
                )
        );
        // $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_column('assessment',$field);
    }

    public function down()
    { 
       
           $result = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'assessment_year'");
        // $exists = ($result)?TRUE:FALSE;
          if($result->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'assessment_year');
          }

          $result2 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'compliance'");
          if($result2->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'compliance');
          }

          $result3 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'financial'");

          if($result3->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'financial');
          }

           $result4 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'social'");
          if($result4->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'social'); 
          }

           $result5 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'total'");
          if($result5->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'total'); 
          }

           $result6 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'totalCompliance'");
          if($result6->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'totalCompliance'); 
          }

          $result7 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'credit'");
          if($result7->num_rows()>0)
          { 
             $this->dbforge->drop_column('assessment', 'credit');
          }

           $result8 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'transport'");
          if($result8->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'transport'); 
          }

           $result9 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'labor'");
          if($result9->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'labor'); 
          }

           $result10 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'health'");
          if($result10->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'health'); 
          }

           $result11 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'small'");
          if($result11->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'small'); 
          }

           $result12 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'electric'");
          if($result12->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'electric');
          }

           $result13 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'agrarian'");
          if($result13->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'agrarian'); 
          }

           $result14 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'producers'");
          if($result14->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'producers'); 
          }

           $result15 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'bank'");
          if($result15->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'bank'); 
          }

           $result16 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'water'");
          if($result16->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'water'); 
          }

           $result17 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'housing'");
          if($result17->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'housing'); 
          }

           $result18 = $this->db->query("SHOW COLUMNS FROM `assessment` LIKE 'assesment_id'");
          if($result18->num_rows()>0)
          {
             $this->dbforge->drop_column('assessment', 'assesment_id'); 
          }
     

    }
}
?>