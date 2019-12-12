<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Relation.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog relation object
  $relation = new Relation($db);

  // Get ID
  $relation->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get relation
  $relation->read();

  // Create array
  $relation_arr = array(
    'id' => $relation->id,
    'retailer_id' => $relation->retailer_id,
    'distributor_id' => $relation->distributor_id
  );

  // Make JSON
  print_r(json_encode($relation_arr));