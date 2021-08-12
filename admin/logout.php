<?php

	session_start();
	
	session_unset();
	
	header('Location: /Cinema-Reservation/admin/index.php');

?>