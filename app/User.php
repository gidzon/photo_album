<?php


namespace app;


class User
{
    protected $pdo;
    protected $login;
    protected $pass;
    protected $name;
    protected $surname;
    protected $hash;
    protected $status;

    public function __construct($pdo, $login = null, $pass = null, 
    $name = null, $surname = null,  $status = null) 
    {
        $this->pdo = $pdo;
        $this->login = $login;
        $this->pass = $pass;
        $this->name = $name;
        $this->surname = $surname;
        $this->status = $status;
    }

    public function regUser()
    {
        
        $this->hash = password_hash($this->pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (login, password, name, surname,  status) 
        VALUES (?, ?, ?, ?, ?)";
        $stn = $pdo->prepare($sql);
        $stn->execute([$this->login, $this->hash, $this->name, 
        $this->surname,  $this->status]);
    }

    public function authUser()
    {


        $sql = "SELECT login, password, status FROM user WHERE  login = ?";
        $stn = $pdo->prepare($sql);
        $stn->exexute([$this->login]);
        $result = $stn->fetch();

        $this->hash = $result['password'];
        $this->status = $result['status'];


        if ($this->login == $result['login'] and password_verify($this->pass, $this->hash)) {
            if ($this->status == '1')
                setcookie('auth', 'user', time()+60*60*24*30, '/');
                    elseif ($this->status == '10')
                        setcookie('auth', 'admin', time()+60*60*24*30, '/');
        }
    }

    public function deleteUser($pdo, $id)
    {
        $sql = "DELETE FROM user WHERE id = ?";
        $stn = $pdo->prepare($sql);
        $stn->execute([$id]);
    }

    public function updateUser($pdo, $id, $login, $pass)
    {
        $this->login = $login;
        $this->pass = password_hash($pass, PASSWORD_DEFAULT);

        if (!empty($login)) {
            $sql = "UPDATE user SET login=? WHERE id = ?";
            $stn = $pdo->prepare($sql);
            $stn->execute([$this->login], $id);
        } elseif (!empty($pass)) {
            $sql = "UPDATE user SET password=? WHERE id = ?";
            $stn = $pdo->prepare($sql);
            $stn->execute([$this->login, $id]);
        }
    }

    public function getUser($id)
    {
        $sql = "SELECT name, surname FROM user WHERE id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getUsersInfo()
    {
        $sql = "SELECT * FROM user";
        $result = $pdo->query($sql);
        return $result;
    }
}