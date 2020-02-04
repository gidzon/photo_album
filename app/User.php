<?php


namespace app;


class User
{
    private $login;
    private $pass;
    private $name;
    private $surname;
    private $nickname = null;
    private $hash;
    private $status;

    public function regUser($pdo, $login, $pass, $name, $surname, $nickname, $status)
    {
        $this->name = $name;
        $this->login = $login;
        $this->pass = $pass;
        $this->surname = $surname;
        $this->nickname = $nickname;
        $this->status = $status;
        $this->hash = password_hash($this->pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (login, password, name, surname, nickname, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stn = $pdo->prepare($sql);
        $stn->execute([$this->login, $this->hash, $this->name, $this->surname, $this->nickname, $this->status]);
    }

    public function authUser($pdo, $login, $pass)
    {


        $sql = "SELECT login, password, status FROM user WHERE  login = ?";
        $stn = $pdo->prepare($sql);
        $stn->exexute([$this->login]);
        $result = $stn->fetch();

        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $result['password'];
        $this->status = $result['status'];


        if ($this->login == $result['login'] and password_verify($this->pass, $this->hash)) {
            if ($this->status == 'user')
            setcookie('auth', 'user', time()+60*60*24*30, '/');
                elseif ($this->status == 'admin')
                    setcookie('auth', 'admin', time()+60*60*24*30, '/');
        }
    }

    public function deleteUser($pdo, $id)
    {
        $sql = "DELETE FROM user WHERE id = ?";
        $stn = $pdo->prepare($sql);
        $stn->execute([$id]);
    }

    public function updateUser($pdo, $id, $login = null, $pass = null)
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
}