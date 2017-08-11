<?php

namespace Solveo;

class Db {

    /**
     *
     * @var connectionString 
     */
    private $connectionString = '';
    private $user = '';
    private $pass = '';

    function __construct() {
        $config = include $_SERVER['DOCUMENT_ROOT'] . '/app/config/config.php';
        $this->connectionString = "pgsql:host=" . $config->db->host . "; dbname=" . $config->db->dbname;
        $this->pass = $config->db->pass;
        $this->user = $config->db->user;
    }

    public function connect() {
        try {
            $pdo = new \PDO($this->connectionString, $this->user, $this->pass);
        } catch (PDOException $ex) {
            echo($ex->getMessage());
        }

        return $pdo;
    }

    public function query($sql) {
        return $this->connect()->query($sql);
    }

    public function execute($sql) {

        try {
            $statement = $this->connect()->prepare($sql);
            $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
