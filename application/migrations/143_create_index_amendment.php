<?php
class Migration_create_index_amendment extends CI_Migration
{
	public function up()
    {
    	$this->db->query("ALTER TABLE `registeredamendment` 
CHANGE COLUMN `category` `category` VARCHAR(200) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL ");
    	//amendment table
		$this->db->query("CREATE INDEX regNo ON amend_coop(regNo)");
		// $this->db->query("CREATE INDEX group_ing ON amend_coop(grouping)");
		$this->db->query("CREATE INDEX status ON amend_coop(status)");
		$this->db->query("CREATE INDEX cooperative_id ON amend_coop(cooperative_id)");
		$this->db->query("CREATE INDEX proposed_name ON amend_coop(proposed_name)");
		$this->db->query("CREATE INDEX refbrgy_brgyCode ON amend_coop(refbrgy_brgyCode)");
		$this->db->query("CREATE INDEX migrated ON amend_coop(migrated)");
		$this->db->query("CREATE INDEX ho ON amend_coop(ho)");
		//registered amendmnet table
		$this->db->query("CREATE INDEX cooperative_id ON registeredamendment(cooperative_id)");
		$this->db->query("CREATE INDEX amendment_id ON registeredamendment(amendment_id)");
		$this->db->query("CREATE INDEX coopName ON registeredamendment(coopName)");
		$this->db->query("CREATE INDEX regNo ON registeredamendment(regNo)");
		$this->db->query("CREATE INDEX category ON registeredamendment(category)");
		$this->db->query("CREATE INDEX type ON registeredamendment(type)");
		$this->db->query("CREATE INDEX addrCode ON registeredamendment(addrCode)");
		$this->db->query("CREATE INDEX migrated ON registeredamendment(migrated)");
		//cooperators
		$this->db->query("CREATE INDEX amendment_id ON amendment_cooperators(amendment_id)");	
		$this->db->query("CREATE INDEX type_of_member ON amendment_cooperators(type_of_member)");
		$this->db->query("CREATE INDEX addCode ON amendment_cooperators(addrCode)");
		$this->db->query("CREATE INDEX new ON amendment_cooperators(new)");	
		//capitalization	
		$this->db->query("CREATE INDEX amendment_id ON amendment_capitalization(amendment_id)");
		//docuements
		$this->db->query("CREATE INDEX amendment_id ON amendment_uploaded_documents(amendment_id)");
	}

	 public function down()
    {
       
       // DROP INDEX index_name ON table_name;
    	$this->db->query("DROP INDEX regNo ON amend_coop");
		// $this->db->query("DROP INDEX group_ing ON amend_coop");
		$this->db->query("DROP INDEX status ON amend_coop");
		$this->db->query("DROP INDEX cooperative_id ON amend_coop");
		$this->db->query("DROP INDEX proposed_name ON amend_coop");
		$this->db->query("DROP INDEX refbrgy_brgyCode ON amend_coop");
		$this->db->query("DROP INDEX proposed_name ON amend_coop");
		$this->db->query("DROP INDEX migrated ON amend_coop");
		$this->db->query("DROP INDEX ho ON amend_coop");

    	$this->db->query("DROP INDEX cooperative_id ON registeredamendment");
		$this->db->query("DROP INDEX amendment_id ON registeredamendment");
		$this->db->query("DROP INDEX coopName ON registeredamendment");
		$this->db->query("DROP INDEX regNo ON registeredamendment");
		$this->db->query("DROP INDEX category ON registeredamendment");
		$this->db->query("DROP INDEX type ON registeredamendment");
		$this->db->query("DROP INDEX addrCode ON registeredamendment");
		$this->db->query("DROP INDEX migrated ON registeredamendment");

		$this->db->query("DROP INDEX amendment_id ON amendment_cooperators");	
		$this->db->query("DROP INDEX type_of_member ON amendment_cooperators");	
		$this->db->query("DROP INDEX addCode ON amendment_cooperators");
		$this->db->query("DROP INDEX new ON amendment_cooperators");

		$this->db->query("DROP INDEX amendment_id ON amendment_capitalization");
		$this->db->query("DROP INDEX amendment_id ON amendment_uploaded_documents");

    }
}