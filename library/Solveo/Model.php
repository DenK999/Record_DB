<?php

namespace Solveo;

class Model {

    /**
     * @var Db 
     */
    protected $db;

    function __construct() {

        $this->db = new Db();
    }

    public function get(int $limit) {

        $stmt = $this->db->query('SELECT * FROM users LIMIT ' . $limit);
        return $stmt->fetchAll();
    }

    public function copy(string $table, array $rows, string $filepath) {
        $rowString = implode(',', $rows);
        $copySQL = "COPY $table($rowString) FROM '" . $filepath . "' WITH DELIMITER ','";  
        $this->db->execute($copySQL);
    }
    
    public function clearTable(string $table){
        $sql = "TRUNCATE TABLE ".$table;
        $this->db->execute($sql);
    }

}
