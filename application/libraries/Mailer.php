<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPMailer/PHPMailer.php";

class Mailer extends PHPMailer {
    public function __construct() {
        parent::__construct();
    }
}