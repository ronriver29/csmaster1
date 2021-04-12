<?php
class Migration_create_table_regional_officails extends CI_Migration
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
              'director'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50,
                 // 'null' => TRUE,
              ),
              'act_supervising'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50,
                 'null' => TRUE,
              ),
              'address'=> array(
                'type' => 'VARCHAR',
                'constraint' =>150,
                 // 'null' => TRUE,
              ),
              'contact'=> array(
                'type' => 'VARCHAR',
                'constraint' =>'50',
                 // 'null' => TRUE,
              ),
              'email' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '50',
              ),
              'social_media' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 150
              ),
              'region_code' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 20
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('regional_officials');
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
        
    }

    public function down()
    {
        $this->dbforge->drop_table('regional_officials');
    }
}
?>