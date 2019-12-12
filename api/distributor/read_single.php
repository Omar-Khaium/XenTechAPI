<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Distributor.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog distributor object
  $distributor = new Distributor($db);

  // Get ID
  $distributor->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $distributor->read_single();

  // Create array
  $distributor_arr = array(
    'id' => $distributor->id,
    'name' => $distributor->name
  );

  // Make JSON
  print_r(json_encode($distributor_arr));
