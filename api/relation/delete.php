<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Set ID to update
  $relation->id = $data->id;

  // Delete relation
  if($relation->delete()) {
    echo json_encode(
      array('message' => 'relation Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'relation Not Deleted')
    );
  }

