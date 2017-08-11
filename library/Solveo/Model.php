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

    public function copy(string $table, string $filepath) {
        $copySQL = "COPY $table(name, surname, age) FROM '" . $filepath . "' WITH DELIMITER ','";        
        $this->db->execute($copySQL);
    }
    
    public function clearTable(string $table){
        $sql = "TRUNCATE TABLE ".$table;
        $this->db->execute($sql);
    }

}
