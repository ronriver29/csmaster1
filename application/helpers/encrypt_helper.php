<?php
if(!defined('BASEPATH'))
exit('No direct script access allowed');
function encrypt_custom($string)
{
  $string = strtr(
                $string,
                array(
                    '+' => '.',
                    '=' => '-',
                    '/' => '~'
                )
            );

    return $string;
}

/**
 * Decodes the given string.
 *
 * @access public
 * @param string $string The encrypted string to decrypt.
 * @param string $key[optional] The key to use for decryption.
 * @return string
 */
function decrypt_custom($string)
{
    $string = strtr(
            $string,
            array(
                '.' => '+',
                '-' => '=',
                '~' => '/'
            )
    );

    return $string;
}

function num_format_custom($num){
  $frmat = new NumberFormatter("en", NumberFormatter::SPELLOUT);
  return $frmat->format($num);
}
?>
