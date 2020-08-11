<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enkripsi extends CI_Encrypt{
	
	function encode($string, $key = "SIKASEP12323!@#$%^180818AGUSTUS&*()", $url_safe = TRUE) {
		$ret = parent::encode($string, $key);
		if ($url_safe)
			$ret = strtr($ret, array('+' => '.', '=' => '-', '/' => '~'));
		return $ret;
	}

	function decode($string, $key = "SIKASEP12323!@#$%^180818AGUSTUS&*()"){
		$string = strtr($string, array('.' => '+', '-' => '=', '~' => '/'));
		return parent::decode($string, $key);
	}
}