<?php

/**
 * Created by PhpStorm.
 * User: LEONARDO TI
 * Date: 03/04/2017
 * Time: 15:51
 */
namespace src;

use mysqli;

class ServiceUser
{
    private $db;
    private $user;
    function  __construct(Mysqli $mysqli,User $user)
    {
        $this->db = $mysqli;
        $this->user = $user;
    }

    public function find($id)
    {
        $stmt = $this->db->stmt_init();
        $stmt->prepare("SELECT * FROM {$this->user->getTable()} WHERE id = ?");
        //Previne SQL INJECTION
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->bind_result($id,$name,$email);
        $stmt->fetch();

        return array("id"=>$id,"name"=>$name,"email"=>$email);
    }

    public function Mylist($order = null)
    {
        if($order){
            $sql = "SELECT * FROM {$this->user->getTable()} ORDER BY {$order}";
        }else{
            $sql = "SELECT * FROM user ";
        }
        $query = $this->db->query($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function insert()
    {
        $stmt = $this->db->stmt_init();
        $stmt->prepare("INSERT INTO {$this->user->getTable()} (name,email) VALUES (?,?)");
        $name = $this->user->getName();
        $email = $this->user->getEmail();
        //Previne SQL INJECTION
        $stmt->bind_param("ss",$name,$email);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function update()
    {
        $stmt = $this->db->stmt_init();
        $stmt->prepare("UPDATE {$this->user->getTable()} SET name = ?, email = ? WHERE id = ?");
        $name = $this->user->getName();
        $email = $this->user->getEmail();
        $id = $this->user->getId();
        //Previne SQL INJECTION
        $stmt->bind_param("ssi",$name,$email,$id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->stmt_init();
        $stmt->prepare("DELETE FROM {$this->user->getTable()} WHERE id = ?");
        //Previne SQL INJECTION
        $stmt->bind_param("i",$id);
        $stmt->execute();
    }
}