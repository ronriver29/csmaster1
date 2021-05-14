<?php
class Migration_alter_amendment_coop_type_upload_table extends CI_Migration
{
  public function up()
  {
      if($this->db->query("TRUNCATE amendment_coop_type_upload"))
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
                    //  Array
                    // (
                    //     'cooperative_type_id' => 8,
                    //     'title' => "DAR",
                    //     'description' => "Written verfication from DAR to the effect that the Cooperative organization is needed and desired by the beneficiaries, economically viable, at least",
                    //     'document_num' => 6
                    //   )
                    // ,
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
                    //  Array
                    // (
                    //     'cooperative_type_id' => 17,
                    //     'title' => "Favorable Endorsement",
                    //     'description' => "Favorable endorsement by Office of Transport Cooperatives (OTC)",
                    //     'document_num' => 9
                    // ),
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
        $this->db->insert_batch('amendment_coop_type_upload',$val);
      }
    }  

    public function down()
    {
      $this->db->query("truncate amendment_coop_type_upload");
    }
    
}
?>