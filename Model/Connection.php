<?php 
    class Connection {
        public $db;
        public function __construct() {
            try {
                $this->db  = new MongoDB\Driver\Manager('mongodb+srv://Agnes:AgnesClusterSorbonne@cluster0.tazf4pn.mongodb.net/test');
            }
            catch (Throwable $e) {
                echo "Catptured Throwable for connection: " . $e->getMessage() . PHP_EOL;
            } 
            
        }
        public function getDb() {
            return $this->db;
        }
    }
?>
