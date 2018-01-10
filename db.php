<?php

// ToDo : Vérifier que la connexion est OK
	$db= new PDO('mysql:host=massjuliqeadmin.mysql.db;dbname=massjuliqeadmin;', 'massjuliqeadmin', '123Soleil', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
// Pour éviter d'avoir à réutiliser "global" par la suite
function db() { global $db; return $db; }
