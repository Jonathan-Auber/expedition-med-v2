<?php

namespace models;

use PDO;

class UsersRepository
{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = \config\Database::getpdo();
    }
    public function findAll()
    {
        $select = $this->pdo->prepare("SELECT * FROM user");
        $select->execute();

        return $select->fetchAll();
    }
    public function find($email)
    {
        $select = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $select->execute(array($email));

        return $select->fetch();
    }
    public function checkPassword($password, $result)
    {
        if (password_verify($password, $result["password"])) {
            $_SESSION["id"] = $result["id"];
            return true;
        } else {
            return false;
        }
    }
    public function checkConnexion($id)
    {
        if (!isset($id)) {
            return header("Location: /expedition-med/users/logout");
        }
    }
}
