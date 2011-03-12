<?php

$hostname = "mongodb://127.0.0.1";
//$hostname = "mongodb://178.32.107.161,127.0.0.1"; // Replicate with Comma
$dbname = "DATABASE";
$dbuser = "USERNAME";
$dbpass = "PASSWORD";
//
class ConnectDB {

    public function __construct()
    {
        global $hostname, $dbname, $dbuser, $dbpass;
        $this->hostname = $hostname;
        $this->dbname = $dbname;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;

       try {
            $this->_link = new Mongo($this->hostname, array("replicaSet" => false));
            // Select the DB
            $this->db = $this->_link->selectDB($this->dbname);
            // Authenticate
            $this->db = $this->db->authenticate($this->dbuser, $this->dbpass);
            if ($this->db['ok'] == 0) {
                // Authentication failed
                $this->error = ($this->db['errmsg'] == 'auth fails') ? "Database Authentication Failure" : $this->db['errmsg'];
                $this->_connected = false;
            } else {
                $this->_connected = true;
            }
            
        } catch (Exception $e) {
            $this->error = (empty($this->error)) ? "Database Connection Error" : $this->error;
        }
    }

    public function findalldata() {
        try {
            $this->db = $this->_link->selectDB($this->dbname);
            $grid = $this->db->getGridFS();
            $cursor = $grid->find();
            return $cursor;

        } catch (Exception $e) {
            $this->error = (empty($this->error)) ? "Find all data error" : $this->error;
        }
    }

    public function findata() {
        try {
            $this->db = $this->_link->selectDB($this->dbname);
            $grid = $this->db->getGridFS();
            return $grid;

        } catch (Exception $e) {
            $this->error = (empty($this->error)) ? "Find data error" : $this->error;
        }
    }

    public function removedata($criteria) {
        try {
            $this->db = $this->_link->selectDB($this->dbname);
            $grid = $this->db->getGridFS();

            //$id = new MongoID($criteria['_id']);
            $grid->remove(array('filename' => $criteria), array('safe' => true));

            $errorArray = $this->db->lastError();
            if ($errorArray['ok'] == 1) {
                $this->error = true;
            }else{
                $this->error = $errorArray['err'];
            }
            return $this->error;

        } catch (Exception $e) {
            $this->error = (empty($this->error)) ? "Remove data error" : $this->error;
        }
    }

    public function close() {
            $this->_link->close();
    }

}

?>
