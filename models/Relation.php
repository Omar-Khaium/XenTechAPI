<?php 
  class Relation {
    // DB stuff
    private $conn;
    private $table = 'relation';

    // Post Properties
    public $id;
    public $retailer_id;
    public $distributor_id;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Single Post
    public function read() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->retailer_id = $row['retailer_id'];
          $this->distributor_id = $row['distributor_id'];
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET retailer_id = :retailer_id, distributor_id = :distributor_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->retailer_id = htmlspecialchars(strip_tags($this->retailer_id));
          $this->distributor_id = htmlspecialchars(strip_tags($this->distributor_id));

          // Bind data
          $stmt->bindParam(':retailer_id', $this->retailer_id);
          $stmt->bindParam(':distributor_id', $this->distributor_id);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }