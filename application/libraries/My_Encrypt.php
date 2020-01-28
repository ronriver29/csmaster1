<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Encrypt extends CI_Encryption{

  public function __construct(){
    parent::__construct();
  }
    function encrypt($string)
    {
        $ret = parent::encrypt($string);

        if ( !empty($string) )
        {
            $ret = strtr(
                    $ret,
                    array(
                        '+' => '.',
                        '=' => '-',
                        '/' => '~'
                    )
                );
        }
        return $ret;
    }

    /**
     * Decodes the given string.
     *
     * @access public
     * @param string $string The encrypted string to decrypt.
     * @param string $key[optional] The key to use for decryption.
     * @return string
     */
    function decrypt($string)
    {
        $string = strtr(
                $string,
                array(
                    '.' => '+',
                    '-' => '=',
                    '~' => '/'
                )
        );

        return parent::decrypt($string);
    }
  }
  ?>
