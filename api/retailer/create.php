<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: Post');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Retailer.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Retailer object
  $retailer = new Retailer($db);

  // Get raw Retailered data
  $data = json_decode(file_get_contents("php://input"));

  $retailer->name = $data->name;
  $retailer->shop_name = $data->shop_name;
  $retailer->phone = $data->phone;
  $retailer->email = $data->email;
  $retailer->opening_balance = $data->opening_balance;

  // Create Retailer
  if($retailer->create()) {
    echo json_encode(
      array('message' => 'Retailer Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Retailer Not Created')
    );
  }

