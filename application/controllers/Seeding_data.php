<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeding_data extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function index()
  {
    $data = array(
          array(
            'name' => 'Cooperative Bank',
            'active' => 1
          ),
          array(
            'name' => 'Insurance Cooperative',
            'active' => 1
          ),
          array(
            'name' => 'CSF',
            'active' => 1
          ),

    );

    if($this->db->insert_batch('head_office_coop_type',$data))
    {
      echo"Data seeded successfully";

    }
    else
    {
      echo"failed to seed data";
    }
  }

  public function seed_luba()
  {
    $data = array(
      'id'=>1648,
      'psgcCode' => 140114000,
      'citymunDesc' => 'Luba',
      'regCode' => 014,
      'provCode' => 1401,
      'citymunCode' => 140114
    );
    if($this->db->insert('refcitymun',$data))
    {
      echo" Successfully added City of Luba";
    }
    else
    {
      echo "failed to seed data";
    }
  }

  public function unseed_luba()
  {
    if($this->db->query('delete from refcitymun where id =1648'))
    {
      echo"successfully unseeded luba";
    }
  }
  public function seed_update_reg_officials()
  {
    $this->db->trans_begin();
    $this->db->query("TRUNCATE TABLE regional_officials");
          $data = array(

                      array(
                      'director' => 'JOSEFINA B. BITONIO',
                      'act_supervising' => 'EDILBERTO G. UNSON',
                      'address' => '3/F SIAPNO BLDG., PEREZ BLVD., 2400 DAGUPAN CITY',
                      'contact' => '(075) 522-8285',
                      'email' => 'r1@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdadagupan',
                      'region_code' => '001'
                      ),
                      array(
                      'director' => 'ANGELITO U. SACRO',
                      'act_supervising' => 'ARTEMIO A. GUZMAN',
                      'address' => 'NO. 7 DALAN NA PAGAYAYA CORNER, PUVVURULUN, NO. 7 DALAN NA PAGAYAYA CORNER, PUVVURULUN, REGIONAL GOVERNMENT
                        CENTER, CARIG SUR, 3005 TUGUEGARAO CITY, CAGAYAN',
                      'contact' => '(078) 377-1173',
                      'email' => 'r2@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdatuguegarao',
                      'region_code' => '002'
                      ),
                      array(
                      'director' => 'MARIETA P. HWANG',
                      'act_supervising' => 'MILDRED S. ESGUERRA',
                      'address' => 'MALIKHAIN ST. COR MAHUSAY ST., DIOSDADO, MACAPAGAL GOVERNMENT CENTER, BARANGAY
MAIMPIS, CITY OF SAN FERNANDO, 2000 PAMPANGA',
                      'contact' => '(045) 963-5107',
                      'email' => 'r3@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdaroiii',
                      'region_code' => '003'
                      ),
                      array(
                      'director' => 'SALVADOR V. VALEROSO',
                      'act_supervising' => 'BERNADETTE PRECIOSA G. HORNILLA',
                      'address' => '2/F HECTAN PENTHOUSE BLDG., BRGY. HALANG, CALAMBA CITY, LAGUNA',
                      'contact' => '(049) 306-0470',
                      'email' => 'calabarzon@cda.gov.ph',
                      'social_media' => 'www.facebook.com/cdaroiva',
                      'region_code' => '004'
                      ),
                       array(
                      'director' => 'ATTY. MA. LOURDES P. PACAO, CSEE',
                      'act_supervising' => 'GRACIA P. LAYOSA',
                      'address' => 'CIVIC CENTER COMPUND, DAYANGDANG, NAGA CITY (MARIA CRISTINA ST., CORNER MAYON AVE. EXTENSION, NAGA CITY',
                      'contact' => '(054) 205-0498',
                      'email' => 'r5@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdanaga',
                      'region_code' => '005'
                      ),
                      array(
                      'director' => 'DOREEN C. ANCHETA',
                      'act_supervising' => 'MERCY J. GABAZA',
                      'address' => '92 VALENCIA STREET, 5003 LEGANES, ILOILO',
                      'contact' => '(033) 524-8090, (033) 524-8089',
                      'email' => 'r6@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cda6iloilo',
                      'region_code' => '006'
                      ),
                      array(
                      'director' => 'NORA P. PATRON',
                      'act_supervising' => 'CIPRIANA D. MUMAR',
                      'address' => 'M. VELEZ STREET, CEBU CITY',
                      'contact' => '(032) 263-5425',
                      'email' => 'r7@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cda7cebu',
                      'region_code' => '007'
                      ),
                      array(
                      'director' => 'VENUS M. JORNALES',
                      'act_supervising' => 'PRISCILA A. ACOPIO',
                      'address' => 'NEW BUS TERMINAL COMPOUND, BRGY. 91, ABUCAY, 6500 TACLOBAN CITY',
                      'contact' => '09127099752, 09058839817',
                      'email' => 'r8@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cda8tacloban',
                      'region_code' => '008'
                      ),
                      array(
                      'director' => 'RUBEN L. CUNANAN, DDM, MPA',
                      'act_supervising' => 'WINDELYN A. AVILA',
                      'address' => '2/F, BANCE BLDG., URRO ST., SAN JOSE DISTRICT, 7016 PAGADIAN CITY',
                      'contact' => '(062) 925-0181 / 214-1398',
                      'email' => 'r9@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdaroix',
                      'region_code' => '009'
                      ),
                      array(
                      'director' => 'GLENN S. GARCIA',
                      'act_supervising' => 'MARISSA B. CATUBIG',
                      'address' => 'MACAPAGAL DRIVE-CROSSING CANITOAN, ZONE 2, BARANGAY CANITOAN, 9000 CAGAYAN DE ORO CITY',
                      'contact' => '(088) 850-1891',
                      'email' => 'r10@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdarox',
                      'region_code' => '010'
                      ),
                      array(
                      'director' => 'ELMA R. OGUIS, CSEE',
                      'act_supervising' => 'ANTONIO C. ESCOBAR',
                      'address' => '2/F G.B. CAM BLDG., MONTEVERDE AVENUE 8000 DAVAO CITY',
                      'contact' => ' (082) 225-8064',
                      'email' => 'r11@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cda11davao',
                      'region_code' => '011'
                      ),
                      array(
                      'director' => 'AMINODEN A. ELIAS',
                      'act_supervising' => 'FLORA T. CASTRO',
                      'address' => 'CHRLDC BUILDING, APO SANDAWA HOMES III 9400 KIDAPAWAN CITY, COTABATO',
                      'contact' => '(064) 521-0342',
                      'email' => 'r12@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cda12kidapawan',
                      'region_code' => '012'
                      ),
                      array(
                      'director' => 'PEDRO T. DEFENSOR, JR.',
                      'act_supervising' => 'ANASTACIA A. HORA',
                      'address' => 'LOWER GROUND FLOOR, EDSA GRAND RESIDENCES,
75 CORREGIDOR ST., CORNER EDSA, BAGO BANTAY,
BARANGAY MAGSAYSAY, QUEZON CITY 1105',
                      'contact' => '(02)8442-9539,(02)8291-6422',
                      'email' => 'ncr@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdancro',
                      'region_code' => '013'
                      ),
                      array(
                      'director' => 'ATTY. FRANCO G. BAWANG, JR.',
                      'act_supervising' => 'LETICIA S. CAYANOS',
                      'address' => '4F New Building, Lyman Ogilby Centrum, 358 Magsaysay Avenue, 2600 Baguio City',
                      'contact' => '(074)422-0038',
                      'email' => 'car@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdacordillera',
                      'region_code' => '014'
                      ),
                      array(
                      'director' => 'DIMNATANG M. RADIA, CESO V',
                      'act_supervising' => '',
                      'address' => 'DOOR I GUIAPAL BLDG., 28 A. ABADOY STREET, POBLACION II, COTABATO CITY, 9600, COTABATO',
                      'contact' => '(064) 421-8723',
                      'email' => 'armm@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdaarmm',
                      'region_code' => '015'
                      ),
                      array(
                      'director' => 'GENARO D. POGATA. JR.',
                      'act_supervising' => 'SALLY S. BONGABONG',
                      'address' => 'CHRLDC BUILDING, APO SANDAWA HOMES III 9400 KIDAPAWAN CITY, COTABATO3/F BALEBRIA BLDG., PILI DRIVE, DAGOHOY 8600 BUTUAN CITY',
                      'contact' => '(085) 342-5530',
                      'email' => 'caraga@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdacaragaro',
                      'region_code' => '016'
                      ),
                      array(
                      'director' => 'CRISTINA H. VILLAMIL',
                      'act_supervising' => 'ALBERTO A. SABARIAS',
                      'address' => '2/F FLOOR SANTES BLDG., NATIONAL HIGHWAY, BRGY. BAYANIHAN I, CALAPAN CITY, ORIENTAL MINDORO',
                      'contact' => '(043)738-2496',
                      'email' => 'mimaropa@cda.gov.ph',
                      'social_media' => 'https://www.facebook.com/cdamimaropa',
                      'region_code' => '017'
                      ),



        );
        
        $this->db->insert_batch('regional_officials',$data);

          // if($this->db->insert_batch('regional_officials',$data))
          // {
          //   echo"regional_officials table has been updated successfully";
          // }
          // else
          // {
          //   echo"failed to update regional_officials tables";
          // }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      // return false;
      echo"failed to update regional_officials tables";
    }else{
      $this->db->trans_commit();
      // return true;
      echo"regional_officials table has been updated successfully";
    }
  }

  public function update_migrations($version)
  {
    if($this->db->update('migrations',array('version'=>$version)))
    {
      echo "success";
    }
    else
    {
      echo"failed";
    }
  }

  public function change_coop_type()
  {
    $this->db->set('name', 'Multipurpose');
    $this->db->where('id', 6);
    if($this->db->update('cooperative_type'))
    {
      echo"Multi-purpose to Multipurpose successfully changed.";
    }
    else
    {
      echo"failed to change Multi-purpose to Multipurpose.";
    } 
  }

  public function update_migration_application_id()
  {
    $this->db->query("select @i := 0;");
    // echo $this->db->last_query();
    $this->db->set('application_id', '(select @i := @i + 1)',FALSE);
    $this->db->where('application_id', 0);
    if($this->db->update('registeredcoop'))
    {
      echo"Update Migration successfully changed.";
    }
    else
    {
      echo"Failed to change Update Migration";
    } 
  }

  public function registeredtable()
  {
    $this->db->select('*');
    $this->db->from('registeredcoop');
    $this->db->where('dateRegistered LIKE "%/%"');
    $query = $this->db->get();
    $data = $query->result_array();

    foreach($data as $row){
      // echo date('m-d-Y',strtotime($row['dateRegistered'])).' - '.$row['dateRegistered'].' - '.$row['id'].'<br>';

      $data = array(
        'dateRegistered' => date('Y-m-d',strtotime($row['dateRegistered']))
      );

      $this->db->where(array('id'=>$row['id']));
      $this->db->update('registeredcoop',$data);

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        echo 'failed';
      }else{
        $this->db->trans_commit();
        echo 'success<br>';
      }
    }
  }

  // public function coop_report_trunc()
  // {
  //   $this->db->truncate('coopris_report');
    
  //   if($this->db->trans_status() === FALSE){
  //       $this->db->trans_rollback();
  //       echo 'failed';
  //     }else{
  //       $this->db->trans_commit();
  //       echo 'success<br>';
  //     }
  // }

//   public function seed_update_directors()
//   {
//     $this->db->trans_begin();
//           $admin = array(
//   array(
//     "id" => 231,
//     "full_name" => "Atty. Franco Bawang",
//     "username" => "dir_r14_fbawang",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "014",
//     "created_at" => "2019-11-21 18:46:38",
//     "updated_at" => "2021-07-16 11:32:37",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 241,
//     "full_name" => "Angelito Sacro",
//     "username" => "dir_r2_asacro",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "002",
//     "created_at" => "2019-11-21 19:00:37",
//     "updated_at" => "2021-08-16 12:22:12",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 263,
//     "full_name" => "Christina Villamil",
//     "username" => "dir_r4b_cvillamil",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "017",
//     "created_at" => "2019-11-21 19:39:34",
//     "updated_at" => "2021-07-16 11:32:37",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 287,
//     "full_name" => "Ruben Cunanan",
//     "username" => "dir_r9_rcunanan",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "009",
//     "created_at" => "2019-11-21 20:28:48",
//     "updated_at" => "2021-07-16 11:32:37",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 290,
//     "full_name" => "Atty. Ma. Lourdes Pacao",
//     "username" => "dir_r5_mpacao",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "005",
//     "created_at" => "2019-11-21 20:37:40",
//     "updated_at" => "2021-07-16 11:32:37",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 295,
//     "full_name" => "Elma Oguis",
//     "username" => "dir_r11_eoguis",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "011",
//     "created_at" => "2019-11-21 20:44:26",
//     "updated_at" => "2021-07-16 11:32:37",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 298,
//     "full_name" => "Marieta Hwang",
//     "username" => "dir_r3_mhwang",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "003",
//     "created_at" => "2019-11-21 20:47:53",
//     "updated_at" => "2021-07-16 11:32:37",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 391,
//     "full_name" => "Salvador Valeroso",
//     "username" => "dir_r4a_svaleroso",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "004",
//     "created_at" => "2019-11-22 16:56:22",
//     "updated_at" => "2021-08-23 13:15:59",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 433,
//     "full_name" => "Nora Patron",
//     "username" => "dir_r7_npatron",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "007",
//     "created_at" => "2020-05-16 03:43:57",
//     "updated_at" => "2021-08-23 13:14:00",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 441,
//     "full_name" => "Engr. Doreen Ancheta",
//     "username" => "dir_r6_dancheta",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "006",
//     "created_at" => "2020-05-16 04:02:43",
//     "updated_at" => "2021-07-26 21:21:45",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 446,
//     "full_name" => "Aminoden Elias",
//     "username" => "dir_r12_aelias",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "012",
//     "created_at" => "2020-06-01 18:24:40",
//     "updated_at" => "2021-09-15 14:35:04",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 500,
//     "full_name" => "Pedro T. Defensor, Jr",
//     "username" => "dir_r13_pdefensor",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "013",
//     "created_at" => "2020-09-10 18:41:44",
//     "updated_at" => "2021-10-11 09:30:20",
//     "ord" => 0,
//     "active" => 0,
//   ),
//   array(
//     "id" => 604,
//     "full_name" => "Glenn S. Garcia",
//     "username" => "dir_r10_ggarcia",
//     "password" => '$2y$10$PC6oDnMJy26bTW/xNdBczu6DW.l7NtV1TK/2yFk.9ZS9vyXJtosGa',
//     "email" => "",
//     "access_name" => "Director",
//     "access_level" => 3,
//     "is_director_active" => 0,
//     "region_code" => "010",
//     "created_at" => "2021-05-10 17:05:13",
//     "updated_at" => "2021-07-23 11:59:41",
//     "ord" => 0,
//     "active" => 0,
//   ),
// );

        
//         $this->db->insert_batch('admin',$admin);

//     if($this->db->trans_status() === FALSE){
//       $this->db->trans_rollback();
//       // return false;
//       echo"failed to update admin tables";
//     }else{
//       $this->db->trans_commit();
//       // return true;
//       echo"admin table has been updated successfully";
//     }
//   }

  public function bns_ba_b_comment_trunc()
  {
    $this->db->truncate('branches');
    $this->db->truncate('business_activities_branch');
    $this->db->truncate('branches_comment');

    if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        echo 'failed';
      }else{
        $this->db->trans_commit();
        echo 'success<br>';
      }
  }

  public function lab_coop_comment_trunc()
  {
    $this->db->truncate('laboratories');
    $this->db->truncate('laboratories_cooperators');
    $this->db->truncate('laboratory_comment');

    if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        echo 'failed';
      }else{
        $this->db->trans_commit();
        echo 'success<br>';
      }
  }

  public function seed_amendment()
  {
    $data_amend_coop = Array
            (
            // [id] => 46
            'cooperative_id' => 46836,
            'regNo' => '9520-100400032084',
            'amendmentNo' => 1,
            'counter' => 0,
            'users_id' => 1700,
            'category_of_cooperative' => 'Primary',
            'type_of_cooperative' => 'Credit',
            'cooperative_type_id' => 1,
            'grouping' => '',
            'proposed_name' => 'Jungle Fighter',
            'acronym' => 'JFCC',
            'common_bond_of_membership' => 'Residential',
            'comp_of_membership' => '',
            'field_of_membership' =>'', 
            'name_of_ins_assoc' => '',
            'type' => 'Single',
            'area_of_operation' => 'Provincial',
            'refbrgy_brgyCode' => '045812012',
            'interregional' =>'', 
            'regions' => '',
            'street' => 'Masalat Road',
            'house_blk_no' => 'JMNHAI Village',
            'status' => 1,
            'evaluated_by' => 0,
            'second_evaluated_by' => 0,
            'third_evaluated_by' => 0,
            'tool_yn_answer' => '',
            'tool_remark' => '',
            'tool_findings' => '',
            'tool_comment' => '',
            'evaluation_comment' => '',
            'comment_by_specialist' => '',
            'comment_by_senior' => '',
            'temp_evaluation_comment' =>'',
            'created_at' => '2021-11-15 01:00:43',
            'updated_at' => '2021-11-15 01:00:43',
            'expire_at' => '2021-11-19 01:00:43',
            'ho' => 0,
        );

      $this->db->insert('amend_coop',$data_amend_coop);


      $data_amendment_bylaws = Array
        (
            // 'id' => 53
            'cooperatives_id' => 46836,
            'amendment_id' => 1,
            'amendmentNo' => '',
            'kinds_of_members' => 2,
            'additional_requirements_for_membership' => '',
            'regular_qualifications' => 'Residing in the province of Rizal;Working in the province of Rizal;Working for an employer based in the province of Rizal',
            'associate_qualifications' => 'Spouse and children of regular members aged 18 years old and above, not otherwise qualified as regular members',
            'membership_fee' => 100,
            'act_upon_membership_days' => 30,
            'regular_percentage_shares_subscription' => '',
            'regular_percentage_shares_pay' => '',
            'associate_percentage_shares_subscription' => '',
            'associate_percentage_shares_pay' => '',
            'additional_conditions_to_vote' =>  'Not violated any provision of this By-laws, the terms and conditions of the subscription agreement, and the decisions, guidelines, rules and regulations promulgated by the Board of Directors and the general assembly.',
            'annual_regular_meeting_day' => 'on or before march 30',
            'annual_regular_meeting_day_date' => '2021-08-09',
            'annual_regular_meeting_day_venue' => 'via Zoom/Online Meeting',
            'delegate_powers' => '',
            'members_percent_quorom' => 25,
            'number_of_absences_disqualification' => 3,
            'percent_of_absences_all_meettings' => 50,
            'director_hold_term' => 2,
            'member_invest_per_month' => 150,
            'member_percentage_annual_interest' => 10,
            'member_percentage_service' => 3,
            'percent_reserve_fund' => 10,
            'percent_education_fund' => 10,
            'percent_community_fund' => 3,
            'percent_optional_fund' => 7,
            'non_member_patron_years' => 0,
            'amendment_votes_members_with' => 'Voting Rights',
            'primary_consideration' => '',
            'type' => 'Special'
        );
        $this->db->insert('amendment_bylaws', $data_amendment_bylaws);

      $data_articles = Array
        (
            // 'id' => 34
            'cooperatives_id' => 46836,
            'amendment_id' => 1,
            'years_of_existence' => 50,
            'directors_turnover_days' => 10,
            'authorized_share_capital' => 100000000,
            'common_share' => 750000,
            'par_value_common' => 100,
            'preferred_share' => 250000,
            'par_value_preferred' => 100,
            'guardian_cooperative' => 0,
        );

         $this->db->insert('amendment_articles_of_cooperation',$data_articles);
       
          $cooperator_arra = Array(

          Array
          (
          // 'id] => 76880
          'orig_cooperator_id' => 37121,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Tianzon, Janice Padilla',
          'gender' => 'Female',
          'birth_date' => '1979-05-28',
          'house_blk_no' => '17',
          'streetName' => 'ILANG ILANG ST',
          'addrCode' => '137504019',
          'position' => 'Member',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 25000,
          'number_of_paid_up_shares' => 5250,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'N25-17-024970',
          'proof_date_issued' => '2017-10-11',
          'place_of_issuance' => 'NCR',
          'created_at' => '2021-03-17 07:47:15',
          'updated_at' =>'2021-06-02 00:32:18'
          ),
          Array
          (
          // 'id] => 76881
          'orig_cooperator_id' => 37128,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Ilocto, April Guerra',
          'gender' => 'Female',
          'birth_date' => '1996-04-02',
          'house_blk_no' => '4775',
          'streetName' => 'SANTOLAN ROAD',
          'addrCode' => '137504011',
          'position' => 'Member',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 25000,
          'number_of_paid_up_shares' => 5250,
          'proof_of_identity' => 'PRC ID',
          'proof_of_identity_number' => '0184521',
          'proof_date_issued' => '2017-11-23',
          'place_of_issuance' => 'NCR',
          'created_at' => '2021-03-17 07:53:12',
          'updated_at' => '2021-06-02 00:23:52'
          ),
          Array
          (
          // 'id' => 76882
          'orig_cooperator_id' => 38127,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Jurane, Marvin Magalit',
          'gender' => 'Male',
          'birth_date' => '1970-07-11',
          'house_blk_no' => 'Camp General Mateo Capinpin',
          'streetName' => '',
          'addrCode' => '045812012',
          'position' => 'Member',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 200,
          'number_of_paid_up_shares' => 200,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'N03-074-000891',
          'proof_date_issued' => '2018-07-11',
          'place_of_issuance' => 'TANAY, RIZAL',
          'created_at' => '2021-03-22 03:08:10',
          'updated_at' => '2021-06-02 00:31:20',
          ),
          Array
          (
          // [id] => 76883
          'orig_cooperator_id' => 38129,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name'=> 'Bares, Erlinda Casale',
          'gender' => 'Female',
          'birth_date' => '1959-10-10',
          'house_blk_no' => 'Camp General Mateo Capinpin',
          'streetName' => '',
          'addrCode' => '045812012',
          'position' => 'Member',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 200,
          'number_of_paid_up_shares' => 200,
          'proof_of_identity' => 'Senior Citizen\'s ID',
          'proof_of_identity_number' => 'QUI-0294',
          'proof_date_issued' => '2019-10-14',
          'place_of_issuance' => 'Pililla RIZAL',
          'created_at' => '2021-03-22 03:09:30',
          'updated_at' => '2021-06-01 10:02:30'
          ),
          Array
          (
          // 'id] => 76884
          'orig_cooperator_id' => 38141,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name'=> 'Santos, Rodelio Villagracia',
          'gender' => 'Male',
          'birth_date' => '1959-03-03',
          'house_blk_no' => '',
          'streetName' => 'SO Cabalhin',
          'addrCode' => '045812012',
          'position' => 'Member',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares'=> 18550,
          'number_of_paid_up_shares' => 300,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'A03-85-006723',
          'proof_date_issued' => '2018-01-06',
          'place_of_issuance' => 'RIZAL',
          'created_at' => '2021-03-22 03:20:47',
          'updated_at' => '2021-06-02 00:31:59'
          ),
          Array
          (
          // [id] => 76885
          'orig_cooperator_id'=> 38161,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Percol, Rogelio Pornasdoro',
          'gender' => 'Male',
          'birth_date' => '1963-05-10',
          'house_blk_no' => '',
          'streetName' => 'JMNHAI Village Masalat Road',
          'addrCode' => '045812012',
          'position' => 'Member',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 18550,
          'number_of_paid_up_shares' => 300,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'E09-93-001106',
          'proof_date_issued' => '2018-05-15',
          'place_of_issuance' => 'ANTIPOLO RIZAL',
          'created_at' => '2021-03-22 03:42:03',
          'updated_at' => '2021-06-02 00:31:48'
          ),
          Array
          (
          // 'id' => 76886
          'orig_cooperator_id' => 50261,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Gonzalez, Michael Ver',
          'gender' => 'Male',
          'birth_date' => '1960-12-16',
          'house_blk_no' => '',
          'streetName' => 'Sitio Mayagay',
          'addrCode' => '045812012',
          'position' => 'Vice-Chairperson',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 25000,
          'number_of_paid_up_shares' => 10000,
          'proof_of_identity' => 'Passport',
          'proof_of_identity_number' => 'P4584666A',
          'proof_date_issued' => 'N/A',
          'place_of_issuance' => 'NCR',
          'created_at' => '2021-06-01 06:54:27',
          'updated_at' => '2021-06-02 08:55:22'
          ),
          Array
          (
          // 'id' => 76887
          'orig_cooperator_id' => 50262,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Tello, Rommel Kong',
          'gender' => 'Male',
          'birth_date' => '1967-09-16',
          'house_blk_no' => 'Camp General Mateo Capinpin',
          'streetName' => '',
          'addrCode' => '045812012',
          'position' => 'Chairperson',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 200,
          'number_of_paid_up_shares' => 200,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'C11-90-048175',
          'proof_date_issued' => '2017-10-24',
          'place_of_issuance' => 'QUEZON CITY',
          'created_at' => '2021-06-01 06:56:01',
          'updated_at' => '2021-06-01 06:56:01'
          ),
          Array
          (
          // [id] => 76888
          'orig_cooperator_id' => 50355,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Cabangbang, Randolph Gonzalez',
          'gender' => 'Male',
          'birth_date' => '1968-10-22',
          'house_blk_no' => 'Camp General Mateo Capinpin',
          'streetName' =>'' ,
          'addrCode' => '045812012',
          'position' => 'Board of Director',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 200,
          'number_of_paid_up_shares' => 200,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'L02-01-148978',
          'proof_date_issued' => '2017-07-04',
          'place_of_issuance' => 'Tanay Rizal',
          'created_at' => '2021-06-02 00:09:28',
          'updated_at' => '2021-06-02 00:09:28'
          ),
          Array
          (
          // 'id' => 76889
          'orig_cooperator_id' => 50356,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Dizon, Ramon Mateo Unson',
          'gender' => 'Male',
          'birth_date' => '1957-08-31',
          'house_blk_no' => 'Daraitan Rd',
          'streetName' => 'Sitio Hinadyungan',
          'addrCode' => '045812012',
          'position' => 'Board of Director',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 25000,
          'number_of_paid_up_shares' => 10000,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'K02-75-010667',
          'proof_date_issued' => '2018-08-13',
          'place_of_issuance' => 'NCR',
          'created_at' => '2021-06-02 00:13:54',
          'updated_at' => '2021-06-02 08:53:38',
          ),
          Array
          (
          'orig_cooperator_id' => 50357,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo'=> '',
          'full_name' => "Gan, Precious Rochelle Ocaban",
          'gender' => 'Female',
          'birth_date' => '1990-12-07',
          'house_blk_no' => '',
          'streetName' => 'Sitio Malaanonang',
          'addrCode' => '045812012',
          'position' => 'Secretary',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 25000,
          'number_of_paid_up_shares' => 10000,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'N04-08-010177',
          'proof_date_issued' => '2016-12-21',
          'place_of_issuance' => 'NCR',
          'created_at' => '2021-06-02 00:16:17',
          'updated_at'=> '2021-06-02 00:16:17'
          ),
          Array
          (
          // 'id] => 76891
          'orig_cooperator_id' => 50358,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Gan, Romeo Gali',
          'gender' => 'Male',
          'birth_date' => '1960-11-10',
          'house_blk_no' =>'',
          'streetName' => 'Sitio Malaanonang',
          'addrCode' => '045812012',
          'position' => 'Board of Director',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 18550,
          'number_of_paid_up_shares' => 300,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'A01-84-018960',
          'proof_date_issued' => 'N/A',
          'place_of_issuance' => 'Quezon City',
          'created_at' => '2021-06-02 00:19:30',
          'updated_at' => '2021-06-02 00:19:30'
          ),
          Array
          (
          // [id] => 76892
          'orig_cooperator_id' => 50360,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Herradura, Luisa Gemelga',
          'gender' => 'Female',
          'birth_date' => '1997-11-14',
          'house_blk_no' => '475 B17 L4',
          'streetName' => 'Kabisig Floodway',
          'addrCode' => '045805014',
          'position' => 'Treasurer',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 25000,
          'number_of_paid_up_shares' => 10000,
          'proof_of_identity' => 'TIN',
          'proof_of_identity_number' => '743926920',
          'proof_date_issued' => '2019-05-30',
          'place_of_issuance' => 'Taytay, Rizal',
          'created_at' => '2021-06-02 00:22:08',
          'updated_at' => '2021-06-02 00:22:08',
          )
          ,
          Array
          (
          // 'id] => 76893
          'orig_cooperator_id' => 50363,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Isleta, Danilo Chad Dumlao',
          'gender' => 'Male',
          'birth_date'=> '1963-03-02',
          'house_blk_no' => '',
          'streetName' => 'Sitio Hinadyungan',
          'addrCode' => '045812012',
          'position' => 'Board of Director',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 25000,
          'number_of_paid_up_shares' => 10000,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'N17-82-002761',
          'proof_date_issued' => 'N/A',
          'place_of_issuance' => 'NCR',
          'created_at' => '2021-06-02 00:30:57',
          'updated_at' => '2021-06-02 08:54:26'
          ),
          Array
          (
          'orig_cooperator_id' => 50366,
          'cooperatives_id' => 46836,
          'amendment_id' => 1,
          'amendmentNo' => '',
          'full_name' => 'Visaya, Ricardo Ramoran',
          'gender' => 'Male',
          'birth_date' => '1960-12-08',
          'house_blk_no' => '29',
          'streetName' => 'Jasmin St Town and Country Exec VIillage',
          'addrCode' => '045802004',
          'position' => 'Board of Director',
          'type_of_member' => 'Regular',
          'number_of_subscribed_shares' => 18550,
          'number_of_paid_up_shares' => 300,
          'proof_of_identity' => 'Driver\'s License',
          'proof_of_identity_number' => 'N03-89-074503',
          'proof_date_issued' => 'N/A',
          'place_of_issuance' => 'Rizal',
          'created_at' => '2021-06-02 00:34:06',
          'updated_at' => '2021-06-02 00:34:06'
          )
          );
          $this->db->insert_batch('amendment_cooperators',$cooperator_arra);
          
        $data_capitalization = Array
        (
            'cooperatives_id' => 46836,
            'amendment_id' => 1,
            'regular_members' => 15,
            'associate_members' => 0,
            'authorized_share_capital' => 100000000,
            'par_value' => 100,
            'common_share' => 750000,
            'preferred_share' => 250000,
            'total_amount_of_subscribed_capital' => 25000000,
            'total_no_of_subscribed_capital' => 250000,
            'total_amount_of_paid_up_capital' => 6250000,
            'total_no_of_paid_up_capital' => 62500,
            'minimum_subscribed_share_regular' => 200,
            'minimum_paid_up_share_regular' => 20,
            'minimum_subscribed_share_associate' => 10,
            'minimum_paid_up_share_associate' => 5,
            'amount_of_common_share_subscribed'=> 0,
            'amount_of_common_share_subscribed_pervalue' => 0,
            'amount_of_preferred_share_subscribed' => 0,
            'amount_of_preferred_share_subscribed_pervalue' => 0,
            'amount_of_common_share_paidup' => 0,
            'amount_of_common_share_paidup_pervalue' => 0,
            'amount_of_preferred_share_paidup' => 0,
            'amount_of_preferred_share_paidup_pervalue' => 0
        );
         $this->db->insert('amendment_capitalization',$data_capitalization);

         $data_business =  Array
        (
            // [id] => 94
            'cooperatives_id'=> 46836,
            'amendment_id' => 1,
            'industry_subclass_by_coop_type_id' => 1613,
            'cooperative_type_id' => 24,
            'major_industry_id' => 64,
            'subclass_id' => 64993
        );
        $this->db->insert('business_activities_cooperative_amendment',$data_business);

        $data_purpose = Array
        (
            // 'id' => 21
            'cooperatives_id' => 46836,
            'amendment_id' => 1,
            'cooperative_type' => 'Credit',
            'content' => "Encouraging thriftiness and assisting members to attain financial stability through periodic savings and disciplined financing among members;Generating funds and extending credit to members for productive and providential purposes while ensuring financial and organizational stability through good 
administration and wise management of financial, human, and other resources;Actively supporting the government, other Cooperatives and people-oriented organizations, both local and foreign, in promoting Cooperatives as a practical means towards sustainable socio-economic development under a truly just and democratic society;Developing dynamic savings mobilization and capital build-up schemes to sustain its developmental activities and long-term investments, thereby ensuring optimum economic benefits to the members, their families, and the community;Implementing policy guidelines that will ensure transparency, accountability and equitable access to its resources and services;Promoting the interests of the members;Adopting such other plans as may help foster the welfare of the members, their families, and the community."
        );

         $this->db->insert('amendment_purposes',$data_purpose);

         $data_committees =Array
                    (
                        Array
                            (
                                // 'id' => 325,
                                'orig_committee_id' => 14801,
                                'user_id' => 1700,
                                'name' => 'Credit',
                                'created_at' => '2021-03-23 01:49:41',
                                'updated_at' => '2021-03-23 01:49:41',
                                'orig_cooperators_id' => 37121,
                                'amendment_cooperators_id' => 1,
                                'amendment_id'=> 1,
                                'func_and_respons' => '',
                                'type' => '',
                                'cooperative_id' => 46836,
                                'fullname' => ''
                            ),
                             Array
                            (
                                // 'id' => 326
                                'orig_committee_id' => 14805,
                                'user_id' => 1700,
                                'name' => 'Audit',
                                'created_at' => '2021-03-23 01:50:47',
                                'updated_at' => '2021-03-23 01:50:47',
                                'orig_cooperators_id' => 37128,
                                'amendment_cooperators_id' => 2,
                                'amendment_id' => 1,
                                'func_and_respons' => '',
                                'type' => '',
                                'cooperative_id' => 46836,
                                'fullname' => '',
                            ),
                            Array
                            (
                                // 'id' => 327
                                'orig_committee_id' => 19285,
                                'user_id' => 1700,
                                'name' => 'Mediation and Conciliation',
                                'created_at' => '2021-06-01 08:48:41',
                                'updated_at' => '2021-06-01 09:04:03',
                                'orig_cooperators_id' => 38127,
                                'amendment_cooperators_id' => 3,
                                'amendment_id' => 1,
                                'func_and_respons' => '',
                                'type' => '',
                                'cooperative_id' => 46836,
                                'fullname' => ''
                            ),
                            Array
                            (
                                // [id] => 328
                                'orig_committee_id' => 19287,
                                'user_id' => 1700,
                                'name' => 'Ethics',
                                'created_at' => '2021-06-01 09:05:05',
                                'updated_at' => '2021-06-01 09:05:05',
                                'orig_cooperators_id' => 38129,
                                'amendment_cooperators_id' => 4,
                                'amendment_id' => 1,
                                'func_and_respons' => '',
                                'type' => '',
                                'cooperative_id' => 46836,
                                'fullname' => '',
                            ),
                             Array
                            (
                                // 'id' => 329,
                                'orig_committee_id' => 14807,
                                'user_id' => 1700,
                                'name' => 'Election',
                                'created_at' => '2021-03-23 01:53:12',
                                'updated_at' => '2021-03-24 05:31:02',
                                'orig_cooperators_id' => 38161,
                                'amendment_cooperators_id' => 6,
                                'amendment_id' => 1,
                                'func_and_respons' => '',
                                'type' => '',
                                'cooperative_id' => 46836,
                                'fullname' => ''
                            ),
                             Array
                            (
                                // [id] => 330
                                'orig_committee_id' => 19300,
                                'user_id' => 1700,
                                'name' => 'Gender and Development',
                                'created_at' => '2021-06-02 00:35:01',
                                'updated_at' => '2021-06-02 00:35:01',
                                'orig_cooperators_id' => 50358,
                                'amendment_cooperators_id' => 12,
                                'amendment_id' => 1,
                                'func_and_respons' => '',
                                'type' => '',
                                'cooperative_id' => 46836,
                                'fullname' => ''
                            )

                    );

                  $this->db->insert_batch('amendment_committees',$data_committees);
  }
}
