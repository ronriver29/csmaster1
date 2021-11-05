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
}
