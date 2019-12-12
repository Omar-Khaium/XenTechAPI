<?php 
  class Retailer {
    // DB stuff
    private $conn;
    private $table = 'retailer';

    // Post Properties
    public $id;
    public $name;
    public $shop_name;
    public $phone;
    public $email;
    public $opening_balance;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->name = $row['name'];
          $this->shop_name = $row['shop_name'];
          $this->phone = $row['phone'];
          $this->email = $row['email'];
          $this->opening_balance = $row['opening_balance'];
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name, shop_name = :shop_name, phone = :phone, email = :email, opening_balance = :opening_balance';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->shop_name = htmlspecialchars(strip_tags($this->shop_name));
          $this->phone = htmlspecialchars(strip_tags($this->phone));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->opening_balance = htmlspecialchars(strip_tags($this->opening_balance));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':shop_name', $this->shop_name);
          $stmt->bindParam(':phone', $this->phone);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':opening_balance', $this->opening_balance);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
          SET name = :name, shop_name = :shop_name, phone = :phone, email = :email, opening_balance = :opening_balance
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->shop_name = htmlspecialchars(strip_tags($this->shop_name));
          $this->phone = htmlspecialchars(strip_tags($this->phone));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->opening_balance = htmlspecialchars(strip_tags($this->opening_balance));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':shop_name', $this->shop_name);
          $stmt->bindParam(':phone', $this->phone);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':opening_balance', $this->opening_balance);
          $stmt->bindParam(':id', $this->id);

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