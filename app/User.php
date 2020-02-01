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

    public function regUser($pdo, $login, $pass, $name, $surname, $nickname)
    {
        $this->name = $name;
        $this->login = $login;
        $this->pass = $pass;
        $this->surname = $surname;
        $this->nickname = $nickname;
        $this->hash = password_hash($this->pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (login, password, name, surname, nickname) VALUES (?, ?, ?, ?, ?)";
        $stn = $pdo->prepare($sql);
        $stn->execute([$this->login, $this->hash, $this->name, $this->surname, $this->nickname]);
    }

    public function authUser($pdo, $login, $pass)
    {
        $this->login = $login;
        $this->pass = $pass;

        $sql = "SELECT login, password FROM user WHERE  login = ?";
        $stn = $pdo->prepare($sql);
        $stn->exexute([$this->login]);
        $result = $stn->fetch();

        if ($this->login == $result['login'] and $this->pass == $result['password']) {
            setcookie('auth', 1, time()+60*60*24*30, '/');
            return true;
        } else {
            return false;
        }
    }
}