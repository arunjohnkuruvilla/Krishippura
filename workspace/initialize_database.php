<?php 
/**
 * This page is included throughout the CMS as shorthand
 * for establishing database connection and starting a session
 */


//Set up database connection
$mysqli = new mysqli($host,$database_user,$database_password,$database_name);
if ($mysqli->connect_errno)
    die("Connect failed: ".$mysqli->connect_error);

// This function is used as a shorthand for closing the database and exiting
function _exit($s="") {
    global $mysqli;
    $mysqli->close();
    exit($s);
}
?>