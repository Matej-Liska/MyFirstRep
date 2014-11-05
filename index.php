<?php
	include_once('function.inc.php');
	include_once('session.inc.php');

	$res = & $db->query("SELECT id_cms_structure FROM cms_structure WHERE id_principal IS NULL");
	if($res && !is_a($res, 'db_error') && ($row = $res->fetchRow())) {
		global $params;
		
		$params[2] = $row['id_cms_structure'].'.html';
		$web = strpos($_SERVER["PHP_SELF"], '/web/') !== false ? '' : 'web';
		if ($web) {
			$http_path = substr($http_path, strpos($http_path, '/')+1);			
		}			
		$_SERVER["PHP_SELF"] = str_replace('index.html', 'index.php', $_SERVER["PHP_SELF"]); 
		$_SERVER["PHP_SELF"] = str_replace('index.php', $web.'/structure/'.$row['id_cms_structure'].'.html', $_SERVER["PHP_SELF"]);
		$_SERVER["SCRIPT_NAME"] = str_replace('index.php', $web, $_SERVER["SCRIPT_NAME"]);
						
		include('structure.php');
		exit;
	}
	
	pageNotFound();
?>