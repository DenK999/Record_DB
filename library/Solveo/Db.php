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
    
    private $connection;

    function __construct() {
        $this->connectionString = "pgsql:host=" . Config::get()->db->host . "; dbname=" . Config::get()->db->dbname;
        $this->pass = Config::get()->db->pass;
        $this->user = Config::get()->db->user;
    }

    /**
     * 
     * @return \PDO connection
     */
    public function connect() {
        try {
            $this->connection = new \PDO($this->connectionString, $this->user, $this->pass);           
        } catch (\PDOException $ex) {           
            throw new PHPErrorException($ex->getMessage(), 'Nie można polaczyc sie z baza');
        }
        return $this->connection;
    }
}