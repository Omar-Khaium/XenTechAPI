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

  // Blog retailer query
  $result = $retailer->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any retailers
  if($num > 0) {
    // retailer array
    $retailers_arr = array();
    // $retailers_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $retailer_item = array(
        'id' => $id,
        'name' => $name,
        'shop_name' => $shop_name,
        'phone' => $phone,
        'email' => $email,
        'opening_balance' => $opening_balance
      );

      // Push to "data"
      array_push($retailers_arr, $retailer_item);
      // array_push($retailers_arr['data'], $retailer_item);
    }

    // Turn to JSON & output
    echo json_encode($retailers_arr);

  } else {
    // No retailers
    echo json_encode(
      array('message' => 'No Retailers Found')
    );
  }
