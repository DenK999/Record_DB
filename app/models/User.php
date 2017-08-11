<?php

namespace Solveo\Model;

/**
 * class User
 */
class User extends \Solveo\Model {

    /**
     * @var int Id 
     */
    public $id;

    /**
     * @var int Parent id
     */
    public $parent_id;

    /**
     *
     * @var string Name 
     */
    public $name;

    /**
     *
     * @var string Surname 
     */
    public $surname;

    /**
     *
     * @var int Age 
     */
    public $age;

    /**
     *
     * @var int Level
     */
    public $level;

}
