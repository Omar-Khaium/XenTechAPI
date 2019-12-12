<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Distributor.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate distributor object
  $distributor = new Distributor($db);

  // distributor read query
  $result = $distributor->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any distegories
  if($num > 0) {
        // dist array
        $dist_arr = array();
        $dist_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $dist_item = array(
            'id' => $id,
            'name' => $name
          );

          // Push to "data"
          array_push($dist_arr['data'], $dist_item);
        }

        // Turn to JSON & output
        echo json_encode($dist_arr);

  } else {
        // No distegories
        echo json_encode(
          array('message' => 'No Distributors Found')
        );
  }
