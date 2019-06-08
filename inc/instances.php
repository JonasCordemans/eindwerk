<?php
include 'lib/session.php';   // include Session file
Session::init();   // Start session with init method
include './lib/database.php'; // include Database file
include './helpers/format.php'; // include Format file

  spl_autoload_register(function($class){
   include_once "classes/".$class.".php";
  });
 
  $db 	= new Database();   // Create Database Class Object 
  $fm 	= new Format();  // Create Format Class Object 
  $pd 	= new Product(); // Create Product Class Object 
  $cat 	= new Category(); // Create Category Class Object 
  $ct 	= new Cart(); // Create Cart Class Object 
  $cmr 	= new User(); // Create Customer class Object 
 
 ?>
