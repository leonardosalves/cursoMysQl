<?php

/**
 * Created by PhpStorm.
 * User: LEONARDO TI
 * Date: 03/04/2017
 * Time: 09:55
 */
namespace src;

class User extends Database
{
    private $table = "user";
    private $id;
    private $name;
    private $email;

    public function getTable()
    {
        return $this->table;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }



}