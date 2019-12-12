<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Retailer.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog retailer object
  $retailer = new Retailer($db);

  // Get raw retailered data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $retailer->id = $data->id;
  $retailer->name = $data->name;
  $retailer->shop_name = $data->shop_name;
  $retailer->phone = $data->phone;
  $retailer->email = $data->email;
  $retailer->opening_balance = $data->opening_balance;

  // Update retailer
  if($retailer->update()) {
    echo json_encode(
      array('message' => 'Retailer Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Retailer Not Updated')
    );
  }

