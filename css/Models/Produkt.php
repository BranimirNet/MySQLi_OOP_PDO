<?php
require_once __DIR__.'..\..\DB\DB.php';
require_once "Redirect.php";

class Produkt{

    public static function allProducts($sort="asc") : array {
        $db=DB::getInstance()->connpdo;

         $sql = "SELECT p.*, k.naziv as kategorija
                from produkti p inner join kategorije k
                on p.kategorijaid = k.id order by p.id $sort";

        $result = $db->query($sql);
        return $result->fetchAll();
    }

    public static function insert($naziv,$kolicina,$cijena,$kategorijaid){
        $db=DB::getInstance()->connpdo;

         try{
            $sql="INSERT INTO produkti (naziv,kolicina,cijena,kategorijaid) values (:naziv,:kolicina,:cijena,:kategorijaid)";
            $stmt=$db->prepare($sql);

            return $stmt->execute([
                ':naziv'=>$naziv,
                ':kolicina' => $kolicina,
                ':cijena'=>$cijena,
                ':kategorijaid'=>$kategorijaid
            ]);
        }
        catch(PDOException $e){
            $msg="Greška kod unosa: ".$e->getMessage();
            Redirect::redirectToErrorPage($msg);
            exit;
        }
    }

    public static function getById($id){
        $db = DB::getInstance()->connpdo;

        $stmt = $db->prepare("SELECT * FROM produkti where id = :id");
        $stmt->execute([':id'=>$id]);

        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function update($id,$naziv,$kolicina,$cijena,$kategorijaid){
        $db = DB::getInstance()->connpdo;
        try{
            $sql="UPDATE produkti
            SET naziv=:naziv,kolicina=:kolicina,cijena=:cijena,kategorijaid=:kategorijaid
            where id=:id";
            $stmt = $db->prepare($sql);
            $_SESSION["poruka"]="Proizvod naziva {$naziv} uspješno ažuriran!";
            
            return $stmt->execute([
                ':naziv'=>$naziv,
                ':kolicina' => $kolicina,
                ':cijena'=>$cijena,
                ':kategorijaid'=>$kategorijaid,
                ':id'=>$id
            ]);       
        }
        catch(PDOException $e){
            $msg="Greška kod ažuriranja: ".$e->getMessage();
            Redirect::redirectToErrorPage($msg);
            exit;
        }
    }

    public static function delete($id){
        $db = DB::getInstance()->connpdo;
        try{
            $sql = "DELETE from produkti where id = :id";
            $stmt = $db->prepare($sql);
            $_SESSION["poruka"]="Proizvod uspješno izbrisan";
            return $stmt->execute([':id'=>$id]);
        }
        catch(PDOException $e){
            $msg="Greška: ".$e->getMessage();
            Redirect::redirectToErrorPage($msg);
            exit;
        }
    }

    public static function insertForTransaction($naziv,$kolicina,$cijena,$kategorijaid,PDO $db):bool{
        $sql="INSERT INTO produkti (naziv,kolicina,cijena,kategorijaid)
        values (:naziv,:kolicina,:cijena,:kategorijaid)";
        $stmt = $db->prepare($sql);

        return $stmt->execute([
                ':naziv'=>$naziv,
                ':kolicina' => $kolicina,
                ':cijena'=>$cijena,
                ':kategorijaid'=>$kategorijaid
        ]);
    }
}

?>