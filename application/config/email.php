<?php
// $config['protocol'] = 'smtp';
// $config['smtp_host'] = 'ssl://smtp.gmail.com';
// // $config['protocol'] = 'ssmtp'; 
// // $config['smtp_host'] = 'ssl://ssmtp.googlemail.com';
// $config['smtp_port'] = '465';
// $config['smtp_user'] = 'cooperative.testing01@gmail.com';
// $config['smtp_pass'] = 'kamote]]';  //sender's password
// $config['mailtype'] = 'html';
// $config['charset'] = 'iso-8859-1';
// $config['wordwrap'] = 'TRUE';
// $config['newline'] = "\r\n";

$config = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.googlemail.com',
    'smtp_port' => 465,
    'smtp_user' => 'cooperative.testing01@gmail.com',
    'smtp_pass' => 'kamote]]',
    'mailtype'  => 'html',
    'charset'   => 'iso-8859-1',
    'wordwrap'  => 'TRUE'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");

// Set to, from, message, etc.
        
$result = $this->email->send();
?>
