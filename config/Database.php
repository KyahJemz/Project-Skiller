<?php

class Database {
    private $host;
    private $username;
    private $password;
    private $dbName;
    private $connection;

    public function __construct($host, $username, $password, $dbName) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;

        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbName);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }

    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    public function close() {
        $this->connection->close();
    }
}





// $email = 'john.doe@example.com';
// $firstName = 'John';
// $lastName = 'Doe';
// $role = 'User';
//
// $query = "INSERT INTO tbl_accounts (Email, FirstName, LastName, Role) VALUES ('$email', '$firstName', '$lastName', '$role')";
//
// $result = $database->query($query);
//
//
// if ($result) {
//     echo "Record inserted successfully!";
// } else {
//     echo "Error inserting record: " . $database->error;
// }
//
// $database->close();



// $query = "SELECT * FROM tbl_accounts";
//
// $result = $database->query($query);
//
// if ($result) {
//     $data = $result->fetch_all(MYSQLI_ASSOC);
//
//     foreach ($data as $row) {
//         echo "ID: {$row['Id']}, Email: {$row['Email']}, Name: {$row['FirstName']} {$row['LastName']}, Role: {$row['Role']}<br>";
//     }
//
//     $result->free();
// } else {
//     echo "Error executing query: " . $database->error;
// }
//
// $database->close();



// $idToUpdate = 1; 
// $newRole = 'Administrator';
//
// $query = "UPDATE tbl_accounts SET Role = '$newRole' WHERE Id = $idToUpdate";
//
// $result = $database->query($query);
//
// if ($result) {
//     echo "Record updated successfully!";
// } else {
//     echo "Error updating record: " . $database->error;
// }
//
// $database->close();



// $idToDelete = 2;
//
// $query = "DELETE FROM tbl_accounts WHERE Id = $idToDelete";
//
// $result = $database->query($query);
//
// if ($result) {
//     echo "Record deleted successfully!";
// } else {
//     echo "Error deleting record: " . $database->error;
// }
//
// $database->close();


?>
