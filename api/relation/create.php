<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: Post');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Relation.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog relation object
  $relation = new Relation($db);

  // Get raw relationed data
  $data = json_decode(file_get_contents("php://input"));

  $relation->retailer_id = $data->retailer_id;
  $relation->distributor_id = $data->distributor_id;

  // Create relation
  if($relation->create()) {
    echo json_encode(
      array('message' => 'relation Created')
    );
  } else {
    echo json_encode(
      array('message' => 'relation Not Created')
    );
  }

