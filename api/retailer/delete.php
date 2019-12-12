<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Delete retailer
  if($retailer->delete()) {
    echo json_encode(
      array('message' => 'Retailer Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Retailer Not Deleted')
    );
  }

