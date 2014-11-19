<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
	echo ! empty($h2_title) ? '<p style = "font-family:verdana; font-size: 14px; margin-left: 10px; margin: 10px;">'. $h2_title.'</p>': '';
	echo ! empty($table) ? $table : '';
?>