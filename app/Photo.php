<?php


namespace app;


class Photo
{
    private $fileName;

    public function uploadFile($fileName, $tmp, string $path)
    {
        $uploadFile = $path.$fileName;
        move_uploaded_file($tmp, $uploadFile);
        return $uploadFile;
    }

    public function deletePhoto($pdo, $id)
    {
        $sql = "DELETE FROM photo WHERE status = 0 and id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
    }

    public function addBdPhoto($pdo, $name, string $file, $date)
    {
        $this->fileName = $name;
        $sql = "INSERT INTO photo (name, path, date)  VALUES (?, ?, ?)";
        $query = $pdo->prepare($sql);
        $query->execute([$this->fileName, $file, $date]);
    }

    public  function getInfoPhoto($pdo, $id)
    {
        $sql = "SELECT * FROM photo WHERE id = ? and status = 1";
        $stn = $pdo->prepare($sql);
        $stn->execute([$id]);
        return $stn->fetchAll();
    }

    public function getPhotoAdmin($pdo)
    {
        $sql = "SELECT name, status, path FROM photo WHERE status = 0";
        return $pdo->query($sql);
    }

    public function adminPhoto($pdo, getPhotoAdmin $info)
    {
        $sql = "UPDATE photo SET status=1 WHERE status = ? and name = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$info['status'], $info['name']]);
    }
}