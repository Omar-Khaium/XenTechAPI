<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Distributor.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $distributor = new Distributor($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $distributor->name = $data->name;

  // Create distributor
  if($distributor->create()) {
    echo json_encode(
      array('message' => 'Distributor Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Distributor Not Created')
    );
  }
