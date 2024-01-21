<?php

class AccountModel {

    private $database; 
    private $logger; 

    public function __construct($db, $logger) {
        $this->database = $db;
        $this->logger = $logger;
    }

    public function getAccount($params) {
        $query = "SELECT * FROM tbl_accounts WHERE 1";

        if ($params['Email']) {
            $query .= " AND Email = ?";
        } elseif ($params['FirstName']) {
            $query .= " AND FirstName = ?";
        } elseif ($params['LastName']) {
            $query .= " AND LastName = ?";
        } elseif ($params['MiddleName']) {
            $query .= " AND MiddleName = ?";
        } elseif ($params['Role']) {
            $query .= " AND Role = ?";
        } elseif ($params['Group']) {
            $query .= " AND Group = ?";
        }

        $stmt = $this->database->prepare($query);

        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return [];
        }


        if ($params['Email']) {
            $stmt->bind_param("s", $params['Email']);
        } elseif ($params['FirstName']) {
            $stmt->bind_param("s", $params['FirstName']);
        } elseif ($params['LastName']) {
            $stmt->bind_param("s", $params['LastName']);
        } elseif ($params['MiddleName']) {
            $stmt->bind_param("s", $params['MiddleName']);
        } elseif ($params['Role']) {
            $stmt->bind_param("s", $params['Role']);
        } elseif ($params['Group']) {
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

        if ($params['FirstName']) {
            $setColumns[] = "FirstName = ?";
            $setValues[] = $params['FirstName'];
        }

        if ($params['MiddleName']) {
            $setColumns[] = "MiddleName = ?";
            $setValues[] = $params['MiddleName'];
        }

        if ($params['LastName']) {
            $setColumns[] = "LastName = ?";
            $setValues[] = $params['LastName'];
        }

        if ($params['Email']) {
            $setColumns[] = "Email = ?";
            $setValues[] = $params['Email'];
        }

        if ($params['Role']) {
            $setColumns[] = "Role = ?";
            $setValues[] = $params['Role'];
        }

        if ($params['Group']) {
            $setColumns[] = "`Group` = ?"; 
            $setValues[] = $params['Group'];
        }
    

        if ($params['Image']) {
            $setColumns[] = "Image = ?";
            $setValues[] = $params['Image'];
        }

        if (!empty($setColumns)) {
            $query .= ' ' . implode(', ', $setColumns);
            $query .= " WHERE Id = ?";

            $bindingString = str_repeat('s', count($setValues) + 1);

            $setValues[] = $params['Id'];

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

}
?>
