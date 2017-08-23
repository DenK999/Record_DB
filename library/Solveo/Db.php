<?php

namespace Solveo;

class Db {

    /**
     * 
     * @return \PDO connection
     */
    public static function connect() {

        $connectionString = "pgsql:host=" . Config::get()->db->host . "; dbname=" . Config::get()->db->dbname;
        $pass = Config::get()->db->pass;
        $user = Config::get()->db->user;
        $connection = new \PDO($connectionString, $user, $pass);

        return $connection;
    }

}
