<?php
  namespace WebsitePopups;
  defined('ABSPATH') or die("Invalid access!");
  
  /* Gets a randomly generated string */
  function random_string( $length = 16 )
  {
    list( $usec, $sec ) = explode( ' ', microtime() );
    mt_srand( ( float ) $sec + ( (float ) $usec * 100000 ) );
    $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*():;{}[]|+=-_<>?/~`";//length:89
    return random_string_block( $chars, $length );
  }

  function safe_random_string( $length = 16 )
  {
    $random_string = random_string( $length ) . urlencode( php_uname( "n" ) );
    $random_string = hash( 'sha512', $random_string );
    return random_string_block( $random_string, $length );
  }

  function random_string_block( $string, $length)
  {
    $block = "";
    for( $i=0;$i<$length; $i++ )
    {
        $block .= $string[ mt_rand( 0,strlen($string )-1) ];
    }
    return $block;
  }

  function json_message($type, $text) {
    return json_encode(array(
      "message" => array (
        'type' => $type,
        'text' => $text
      )
    ));
  }
?>