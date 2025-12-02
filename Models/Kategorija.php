<?php
require_once __DIR__.'..\..\DB\DB.php';

class Kategorija{

    public static function allCategories(): array{
        $db = DB::getInstance()->conn;
        $sql = "SELECT * FROM kategorije";
        $result = $db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function insert($naziv){
        $db = DB::getInstance()->conn;

        try{
            $stmt = $db->prepare("INSERT INTO kategorije (naziv) values (?)");
            $stmt->bind_param("s",$naziv);
            return $stmt->execute();
        }
        catch(mysqli_sql_exception $e){
            die("Greška: ".$e->getMessage());
        }
    }

    public static function getById($id){
        $db = DB::getInstance()->conn;

        $stmt = $db->prepare("SELECT * from kategorije WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();      
    }
    
    public static function update($id,$naziv): bool{
        $db=DB::getInstance()->conn;

        $stmt=$db->prepare("UPDATE kategorije set naziv = ? where id = ?");
        $stmt->bind_param("si",$naziv,$id);

        return $stmt->execute();
    }
}

?>