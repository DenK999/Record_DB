<?php

namespace Solveo;

class Model {

    /**
     * @var Db 
     */
    protected $db;

    /**
     * construct to Base Model
     */
    function __construct() {

        $this->db = new Db();
    }

    /**
     * 
     * @param int $limit
     * @return array
     */
    public function get(int $limit) {

        $stmt = $this->db->query('SELECT * FROM users LIMIT ' . $limit);
        return $stmt->fetchAll();
    }

    /**
     * 
     * @param string $table
     * @param array $rows
     * @param string $filepath
     */
    public function copy(string $table, array $rows, string $filepath) {
        $rowString = implode(',', $rows);
        $copySQL = "COPY $table($rowString) FROM '" . $filepath . "' WITH DELIMITER ','";
        $this->db->execute($copySQL);
    }

    /**
     * 
     * @param string $table
     */
    public function clearTable(string $table) {
        $sql = "TRUNCATE TABLE " . $table;
        $this->db->execute($sql);
    }

}
