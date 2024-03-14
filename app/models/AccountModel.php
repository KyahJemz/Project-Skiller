<?php

class AccountModel {

    private $database; 
    private $logger; 

    public function __construct($db, $logger) {
        $this->database = $db;
        $this->logger = $logger;
    }

    public function getAccountById($params){
        $AccountId = $this->database->escape($params['Account_Id']);
        $query = "SELECT 
            *
        FROM tbl_accounts 
        WHERE tbl_accounts.Id = $AccountId";
    
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return [];
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return [];
        }
    
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        $stmt->close();
    
        return $data;
    }

    public function getGroups(){
        $query = "SELECT DISTINCT 
            tbl_accounts.Group
          FROM tbl_accounts 
          WHERE tbl_accounts.Role = 'Teacher'";
    
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return [];
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return [];
        }
    
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        $stmt->close();
    
        return $data;
    }

    public function getAccountByGroup($params){
        $Group = $this->database->escape($params['Group']);
        $query = "SELECT 
            *
        FROM tbl_accounts 
        WHERE tbl_accounts.Group = $Group";
    
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return [];
        }

        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return [];
        }
    
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        $stmt->close();
    
        return $data;
    }

    public function getAccount($params) {
        $query = "SELECT * FROM tbl_accounts WHERE 1";

        if (isset($params['Email'])) {
            $query .= " AND Email = ?";
        } elseif (isset($params['FirstName'])) {
            $query .= " AND FirstName = ?";
        } elseif (isset($params['LastName'])) {
            $query .= " AND LastName = ?";
        } elseif (isset($params['MiddleName'])) {
            $query .= " AND MiddleName = ?";
        } elseif (isset($params['Role'])) {
            $query .= " AND Role = ?";
        } elseif (isset($params['Group'])) {
            $query .= " AND Group = ?";
        }

        $stmt = $this->database->prepare($query);

        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return [];
        }

        if (isset($params['Email'])) {
            $stmt->bind_param("s", $params['Email']);
        } elseif (isset($params['FirstName'])) {
            $stmt->bind_param("s", $params['FirstName']);
        } elseif (isset($params['LastName'])) {
            $stmt->bind_param("s", $params['LastName']);
        } elseif (isset($params['MiddleName'])) {
            $stmt->bind_param("s", $params['MiddleName']);
        } elseif (isset($params['Role'])) {
            $stmt->bind_param("s", $params['Role']);
        } elseif (isset($params['Group'])) {
            $stmt->bind_param("s", $params['Group']);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return [];
        }

        $data = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $data;
    }

    public function updateAccount($params) {
        $query = "UPDATE tbl_accounts SET";

        $setColumns = [];
        $setValues = [];
        $bindingString = "";

        if (isset($params['FirstName'])) {
            $setColumns[] = "FirstName = ?";
            $setValues[] = $params['FirstName'];
            $bindingString .= "s";
        }

        if (isset($params['MiddleName'])) {
            $setColumns[] = "MiddleName = ?";
            $setValues[] = $params['MiddleName'];
            $bindingString .= "s";
        }

        if (isset($params['LastName'])) {
            $setColumns[] = "LastName = ?";
            $setValues[] = $params['LastName'];
            $bindingString .= "s";
        }

        if (isset($params['Email'])) {
            $setColumns[] = "Email = ?";
            $setValues[] = $params['Email'];
            $bindingString .= "s";
        }

        if (isset($params['Role'])) {
            $setColumns[] = "Role = ?";
            $setValues[] = $params['Role'];
            $bindingString .= "s";
        }

        if (isset($params['Group'])) {
            $setColumns[] = "Group = ?"; 
            $setValues[] = (int)$params['Group'];
            $bindingString .= "i";
        }

        if (isset($params['Disabled'])) {
            $setColumns[] = "Disabled = ?"; 
            $setValues[] = (int)$params['Disabled'];
            $bindingString .= "i";
        }

        if (isset($params['Image'])) {
            $setColumns[] = "Image = ?";
            $setValues[] = $params['Image'];
            $bindingString .= "s";
        }

        if (!empty($setColumns)) {
            $query .= ' ' . implode(', ', $setColumns);
            $query .= " WHERE Id = ?";

            $setValues[] = (int)$params['Id'];
            $bindingString .= "i";

            $this->logger->log('query: '.$query, 'info');
            $this->logger->log('bindingString: '.$bindingString, 'info');

            $stmt = $this->database->prepare($query);

            if (!$stmt) {
                $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
                return [];
            }

            $stmt->bind_param($bindingString, ...$setValues);

            $stmt->execute();

            $affectedRows = $stmt->affected_rows;

            $stmt->close();

            if ($affectedRows > 0) {
                $this->logger->log('Update successful', 'info');
                return [1];
            } else {
                $this->logger->log('No rows were affected. Update may not have found a matching row.', 'info');
                return [];
            }
        } else {
            return [];
        }
    }

    public function addAccount($params){
        $Email = $this->database->escape($params['Email']);
        $Role = $this->database->escape($params['Role']);
        $Group = $this->database->escape($params['Group']);
        $CurrentLesson = $this->database->escape($params['CurrentLesson']);

        $query ="";
        if(empty($Group)){
            $query = "INSERT INTO tbl_accounts (Email, Role) 
            VALUES ('$Email', '$Role')";
        } else {
            if(empty($CurrentChapter)){
                $query = "INSERT INTO tbl_accounts (Email, Role, `Group`) 
                VALUES ('$Email', '$Role', $Group)";
            } else {
                $query = "INSERT INTO tbl_accounts (Email, Role, `Group`, `CurrentLesson`) 
                VALUES ('$Email', '$Role', $Group, '$CurrentLesson')";
            }
        }

        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->execute();
    
        if ($stmt->error) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false;
        }
    
        $stmt->close();
    
        return true;
    }

    public function updateCurrentLesson(){
        $query = "UPDATE tbl_accounts SET CurrentLesson = CurrentLesson + 1 WHERE Id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $_SESSION['User_Id']);
        $stmt->execute();
        $stmt->close();
    }

    public function resetCurrentLesson($params){
        $query = "UPDATE tbl_accounts SET CurrentLesson = 1 WHERE Id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $params['Id']);
        $stmt->execute();
        $stmt->close();
    }
}
?>
