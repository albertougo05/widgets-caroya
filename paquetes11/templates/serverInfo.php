<?php

//isolate the root path for this application
$path = $_SERVER['PHP_SELF'];
$path = explode('/',$path);
array_pop($path);
$path = implode('/',$path);
$path = $path . '/';

//isolate server IP and port (only display PORT if it is something other then 80)
//http://10.1.13.48:8080/path1/path2

$ServerBasePath = $_SERVER["SERVER_NAME"];
if ($_SERVER['SERVER_PORT'] != '80') 
  $serverPath = 'http://' . $ServerBasePath . ':' . $_SERVER['SERVER_PORT'] . $path;
else 
  $serverPath = 'http://' . $ServerBasePath . $path;

/*
if ($_SERVER['SERVER_PORT'] != '80') $serverPath = 'http://' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . $path;
else $serverPath = 'http://' . $_SERVER['SERVER_ADDR'] . $path;
*/
return $serverPath;
?>