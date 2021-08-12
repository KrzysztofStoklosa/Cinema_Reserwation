<?php


define('_DB_HOST_', 				'localhost');
define('_DB_USER_', 				'root');
define('_DB_PASS_', 				'');
define('_DB_DATA_', 				'cinema_db');
define('_DB_CHARSET_', 				'');

define('_SET_CHARACTER_SET_',       'utf8');
define('_SET_NAMES_',               'utf8');


$link = mysqli_connect(_DB_HOST_, _DB_USER_, _DB_PASS_, _DB_DATA_);

//mysqli_query($link, 'SET CHARACTER SET utf8');
//mysqli_query($link, 'SET NAMES utf8');






?>