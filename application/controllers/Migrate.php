<?php
class Migrate extends CI_Controller {
    public function index()
    {
        // load migration library
        $this->load->library('migration');
        if(!$this->migration->current())
        {
            echo 'Error' . $this->migration->error_string();
        } 
        else
        {
            // echo 'Migrations ran successfully!';
          $check = $this->db->get('amendment_coop_type_upload');
          if($check->num_rows()>0)
          {
            // echo "success seeding";
          }
          else
          {
            $this->document_type_seeding();
          }
          //next seeding
          $check2 = $this->db->get('coop_type_upload');
          if($check2->num_rows()>0)
          {
              // echo"success seeding";
          }
          else
          {
            $this->document_coop_type_seeding();
          }
          $charter_query = $this->db->get('charter_cities');
          if($charter_query->num_rows()>0)
          {
           
          }
          else
          {
             $this->charter_cities_seeding();
          }
          echo 'Migrations ran successfully!';
        }     
    }    

    public function resetMigration()
    {
        $this->load->library('migration');
        if($this->migration->current()!== FALSE)
        {
          echo 'The migration was revert to the version set in the config file.';
          return TRUE;
        }
        else
        {
          echo 'Couldn\’t reset migration.';
          show_error($this->migration->error_string());
          exit;
        }
    }


  public function undoMigration($version = NULL)
  {
    $this->load->library('migration');
    $migrations = $this->migration->find_migrations();
    $migrationKeys = array();
    foreach($migrations as $key => $migration)
    {
      $migrationKeys[] = $key;
    }
    if(isset($version) && array_key_exists($version,$migrations) && $this->migration->version($version))
    {
      echo 'The migration was undo';
      exit;
    }
    elseif(isset($version) && !array_key_exists($version,$migrations))
    {
      echo 'The migration with selected version doesn’t exist.';
    }
    else
    {
      $penultimate = (sizeof($migrationKeys)==1) ? 0 :  $migrationKeys[sizeof($migrationKeys)-2];
      if($this->migration->version($penultimate))
      {
        echo 'The migration has been reverted successfully.';
        exit;
      }
      else
      {
        echo 'Couldn\’t roll back the migration.';
        exit;
      }
    }
  } 
  private function document_type_seeding()
  {
    $val = Array
    (
        Array
        (
            'cooperative_type_id' => '',
            'title' => "Feasibility Study",
            'description' => "Detailed Feasibility Study",
            'document_num' => 3
          )
        ,
        Array
        (
            'cooperative_type_id' => '',
            'title' => "Books of Account",
            'description' => "Undertaking to maintain separate books of accounts for each business activity",
            'document_num' => 4
          )
        ,
        Array
        (
            'cooperative_type_id' => 8,
            'title' => "CLOA",
            'description' => "Mother CLOA in case of plantation based ARBs",
            'document_num' => 5
          )
        ,
         Array
        (
            'cooperative_type_id' => 8,
            'title' => "DAR",
            'description' => "Written verfication from DAR to the effect that the Cooperative organization is needed and desired by the beneficiaries, economically viable, at least",
            'document_num' => 6
          )
        ,
         Array
        (
            'cooperative_type_id' => 20,
            'title' => "Pre-feasibility Study",
            'description' => "Copy of the Pre-feasibility study of the housing projects undertaking certified as reviewed by National Housing Authorithy",
            'document_num' => 7
        ),
         Array
        (
            'cooperative_type_id' => 17,
            'title' => "Certification of Cooperative Education & Transport",
            'description' => "Certification of Cooperative Education & Transport Operation Seminar (CETOS) By Office of Transport Cooperatives OTC",
            'document_num' => 8
        ),
         Array
        (
            'cooperative_type_id' => 17,
            'title' => "Favorable Endorsement",
            'description' => "Favorable endorsement by Office of Transport Cooperatives (OTC)",
            'document_num' => 9
        ),
         Array
        (
            'cooperative_type_id' => 18,
            'title' => "Proof of Land Ownership",
            'description' => "Proof of Land ownership",
            'document_num' => 10
        ),
         Array
        (
            'cooperative_type_id' => 12,
            'title' => "Detailed Feasibility Study",
            'description' => "Detailed Feasibility Study indicating viability of proposed business activity",
            'document_num' => 11
        ),
         Array
        (
            'cooperative_type_id' => 21,
            'title' => "TIN",
            'description' => "Tax Identification Number (TIN)",
            'document_num' => 12
        ),
         Array
        (
            'cooperative_type_id' => 3,
            'title' => "TIN",
            'description' => "Tax Identification Number (TIN)",
            'document_num' => 13
        ),
         Array
        (
            'cooperative_type_id' => 3,
            'title' => "Individual Profesional License",
            'description' => "Photocopy of valid individual Professional License of all members",
            'document_num' => 14
        ),
         Array
        (
            'cooperative_type_id' => 15,
            'title' => "TIN",
            'description' => "Tax Identification Number (TIN)",
            'document_num' => 15
        ),
         Array
        (
            'cooperative_type_id' => 15,
            'title' => "Detailed Feasibility Study",
            'description' => "Detailed feasibility study (expressly mentioning whether the undertaking is primary, secondary or tertiary level hospital, diagnostic center, spa & we",
            'document_num' => 16
        ),
         Array
        (
            'cooperative_type_id' => 23,
            'title' => "TIN",
            'description' => "Tax Identification Number (TIN)",
            'document_num' => 17
        ),
         Array
        (
            'cooperative_type_id' => 23,
            'title' => "Certification from Mines Geo-Sciende Bureau Region",
            'description' => "Certification from Mines Geo-Science Bureau Regional Office that the members are licensed miners if the area of business operation is within the People",
            'document_num' => 18
        )
    );

      if($this->db->insert_batch('amendment_coop_type_upload',$val))
      {
        $data = true;
      }
      else
      {
        $data =false;
      }
      return $data;
  }

  public function document_coop_type_seeding()
  {
    $val = Array
   (
     Array
        (
            'coop_type_id' => 1,
            'coop_title' => 'CLOA',
            'coop_desc' => 'Mother CLOA in case of plantation based ARBs',
            'document_num' => 5
        ),
     Array
        (
            'coop_type_id' => 1,
            'coop_title' => 'DAR',
            'coop_desc' => 'Written verfication from DAR to the effect that the Cooperative organization is needed and desired by the beneficiaries, economically viable, at least majority of the members are agrarian reform beneficiaries',
            'document_num' => 6
        ),
     Array
        (
            'coop_type_id' => 2,
            'coop_title' => 'Pre-feasibility Study',
            'coop_desc' => 'Copy of the Pre-feasibility study of the housing projects undertaking certified as reviewed by National Housing Authorithy',
            'document_num' => 7
        ),
     Array
        (
            'coop_type_id' => 3,
            'coop_title' => 'Certification of Cooperative Education & Transport',
            'coop_desc' => 'Certification of Cooperative Education & Transport Operation Seminar (CETOS) By Office of Transport Cooperatives OTC',
            'document_num' => 8
        ),
     Array
        (
            'coop_type_id' => 3,
            'coop_title' => 'Favorable Endorsement',
            'coop_desc' => 'Favorable endorsement by Office of Transport Cooperatives (OTC)',
            'document_num' => 9
        ),
     Array
        (
            'coop_type_id' => 4,
            'coop_title' => 'Proof of Land Ownership',
            'coop_desc' => 'Proof of Land ownership',
            'document_num' => 10
        ),
     Array
        (
            'coop_type_id' => 5,
            'coop_title' => 'Detailed Feasibility Study',
            'coop_desc' => 'Detailed Feasibility Study indicating viability of proposed business activity',
            'document_num' => 11
        ),
     Array
        (
            'coop_type_id' => 6,
            'coop_title' => 'TIN',
            'coop_desc' => 'Tax Identification Number (TIN)',
            'document_num' => 12
        ),
     Array
        (
            'coop_type_id' => 7,
            'coop_title' => 'TIN',
            'coop_desc' => 'Tax Identification Number (TIN)',
            'document_num' => 13
        ),
    Array
        (
            'coop_type_id' => 7,
            'coop_title'=> 'Individual Profesional License',
            'coop_desc' => 'Photocopy of valid individual Professional License of all members',
            'document_num' => 14
        ),
     Array
        (
           'coop_type_id'=> 8,
           'coop_title' => 'TIN',
           'coop_desc' => 'Tax Identification Number (TIN)',
           'document_num' => 15
        ),
     Array
        (
            'coop_type_id' => 8,
            'coop_title' => 'Detailed Feasibility Study',
            'coop_desc' => 'Detailed feasibility study (expressly mentioning whether the undertaking is primary, secondary or tertiary level hospital, diagnostic center, spa & wellness center, home for the aged, lying in, drop-off centers, etc.& specifying the financial, techni',
            'document_num' => 16
        ),
     Array
        (
            'coop_type_id' => 9,
            'coop_title' => 'TIN',
            'coop_desc' => 'Tax Identification Number (TIN)',
            'document_num' => 17
        ),
     Array
        (
            'coop_type_id' => 9,
            'coop_title' => 'Certification from Mines Geo-Sciende Bureau Region',
            'coop_desc' => 'Certification from Mines Geo-Science Bureau Regional Office that the members are licensed miners if the area of business operation is within the People Small Scale Mining Area',
            'document_num' => 18
        )

    );

    if($this->db->insert_batch('coop_type_upload',$val))
      {
        $data = true;
      }
      else
      {
        $data =false;
      }
      return $data;

  }
  private function charter_cities_seeding()
  {
    $query = $this->db->get('chartered_cities');
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
       $data[] = $row;
      }
      $this->db->insert_batch('charter_cities',$data);
    }
  }
}
?>