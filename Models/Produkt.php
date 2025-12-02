<?php
require_once __DIR__.'..\..\DB\DB.php';
require_once "Redirect.php";

class Produkt{

    public static function allProducts(): array{
        $db = DB::getInstance()->conn;
        $sql = "SELECT p.*, k.naziv as kategorija
                from produkti p inner join kategorije k
                on p.kategorijaid = k.id";

        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function insert($naziv,$kolicina,$cijena,$kategorijaid){
        $db = DB::getInstance()->conn;

        try{
            $stmt = $db->prepare("INSERT INTO produkti (naziv,kolicina,cijena,kategorijaid) values (?,?,?,?)");
            $stmt->bind_param("sidi",$naziv,$kolicina,$cijena,$kategorijaid);
            return $stmt->execute();
        }
        catch(mysqli_sql_exception $e){
            $msg="Greška kod unosa: ".$e->getMessage();
            Redirect::redirectToErrorPage($msg);
            exit;
        }
    }
    
}

?>