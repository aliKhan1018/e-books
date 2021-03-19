<?php
    include("./inc/utility.inc.php");
    class database
    {
        // local var
        private $host = "localhost";
        private $user = "root";
        private $pswd = "";
        private $db = "ecomdb";
        private $link = null;


        // constructor
        function __construct()
        {
            $this->link = mysqli_connect($this->host, $this->user, $this->pswd, $this->db);
            // log to console
            if($this->link){
                echo Utility::console_log("database connected!");
            }
            else{
                echo Utility::console_log("database not connected!");
                die("<br>mysqli error no: " . mysqli_errno($this->link));
            }
        }

        // getter
        function get_link(){
            return $this->link;
        }

        function query($q){
            $res = mysqli_query($this->link, $q);
            if ($res) {
                echo Utility::console_log("Query Executed Sucessfully ✅");
            } else {
                echo Utility::console_error("Query Error ❌: " . mysqli_errno($this->get_link()));
            }
            return $res;
        }

        public function insert(){
            $q = "INSERT INTO TABLENAME VALUES()"; // query to execute.
            $res = $this->query($q); // run the query.
        }

        public function delete_entity($table_name, $id){
            $q = "SELECT * FROM '$table_name' WHERE ID = $id";
            $res = $this->query($q);
            return $res->fetch_assoc();
        }

        
        public function update_entity($table_name, $col_name, $new_value, $id){
            $q = "UPDATE $table_name SET $col_name = '$new_value' WHERE ID = $id";
            $res = $this->query($q);
        }


        public function get_entity($table_name, $id){
            $q = "SELECT * FROM $table_name WHERE ID = " . $id; 
            $res = $this->query($q);
            return $res->fetch_assoc();
        }

        public function get_entities($table_name){
            $q = "SELECT * FROM $table_name"; 
            $res = $this->query($q);
            return $res;
        }


    }

?>
