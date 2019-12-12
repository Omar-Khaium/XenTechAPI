<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Retailer.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog retailer object
  $retailer = new Retailer($db);

  // Get ID
  $retailer->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get retailer
  $retailer->read_single();

  // Create array
  $retailer_arr = array(
    'id' => $retailer->id,
    'name' => $retailer->name,
    'shop_name' => $retailer->shop_name,
    'phone' => $retailer->phone,
    'email' => $retailer->email,
    'opening_balance' => $retailer->opening_balance
  );

  // Make JSON
  print_r(json_encode($retailer_arr));