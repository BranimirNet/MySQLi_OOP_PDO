<?php
require_once __DIR__.'..\..\DB\DB.php';
require_once "Redirect.php";
class Kategorija{

    public int $id;
    public string $naziv;

    public static function allCategories(): array{
        $db = DB::getInstance()->connpdo;
        $sql = "SELECT * FROM kategorije";
        $result = $db->query($sql);

        return $result->fetchAll();
    }

    public static function insert($naziv){
        $db = DB::getInstance()->connpdo;

        try {
            $sql="INSERT INTO kategorije (naziv) values (:naziv)";
            $stmt = $db->prepare($sql);

            $ok = $stmt->execute(
                [
                    ':naziv'=>$naziv
                ]
                );
            return $ok;
        } catch (PDOException $e) {
            $msg=$e->getMessage();
            Redirect::redirectToErrorPage($msg);
        }
    }
    
}

?>