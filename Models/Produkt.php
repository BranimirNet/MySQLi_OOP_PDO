<?php
require_once __DIR__.'..\..\DB\DB.php';
require_once "Redirect.php";

class Produkt{

    public static function allProducts($sort = "asc"): array
    {
        $db = DB::getInstance()->connpdo;

        $sql = "SELECT p.*, k.naziv AS kategorija 
                FROM produkti p 
                INNER JOIN kategorije k ON p.kategorijaid = k.id 
                ORDER BY p.id $sort";

        $result = $db->query($sql);
        return $result->fetchAll();
    }

    public static function insert($naziv, $kolicina, $cijena, $kategorijaid): bool
{
    $db = DB::getInstance()->connpdo;

    try {
        $sql = "INSERT INTO produkti (naziv, kolicina, cijena, kategorijaid)
                VALUES (:naziv, :kolicina, :cijena, :kategorijaid)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            ':naziv'        => $naziv,
            ':kolicina'     => $kolicina,
            ':cijena'       => $cijena,
            ':kategorijaid' => $kategorijaid
        ]);

    } catch (PDOException $e) {

        $msg = "Greška kod unosa: " . $e->getMessage();
        Redirect::redirectToErrorPage($msg);
        exit;
    }
}
public static function getById($id){
        $db = DB::getInstance()->connpdo;

        $stmt = $db->prepare("SELECT * FROM kategorije where id = :id");
        $stmt->execute([':id'=>$id]);

        $row = $stmt->fetch();
        return $row ?: null;
    }
public static function update($id, $naziv, $kolicina, $cijena, $kategorijaid): bool
{
    $db = DB::getInstance()->connpdo;

    try {

        $sql = "UPDATE produkti
                SET naziv = :naziv,
                    kolicina = :kolicina,
                    cijena = :cijena,
                    kategorijaid = :kategorijaid
                WHERE id = :id";

        $_SESSION["poruka"] = "Proizvod naziva {$naziv} uspješno ažuriran!";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            ':naziv'        => $naziv,
            ':kolicina'     => $kolicina,
            ':cijena'       => $cijena,
            ':kategorijaid' => $kategorijaid,
            ':id'           => $id
        ]);

    } catch (PDOException $e) {

        $msg = "Greška kod ažuriranja: " . $e->getMessage();
        Redirect::redirectToErrorPage($msg);
        exit;
    }
}

public static function insertForTransaction(
    string $naziv,
    int $kolicina,
    float $cijena,
    int $kategorijaid,
    PDO $db
): bool {

    $sql = "INSERT INTO produkti (naziv, kolicina, cijena, kategorijaid)
            VALUES (:naziv, :kolicina, :cijena, :kategorijaid)";

    $stmt = $db->prepare($sql);

    return $stmt->execute([
        ':naziv'        => $naziv,
        ':kolicina'     => $kolicina,
        ':cijena'       => $cijena,
        ':kategorijaid' => $kategorijaid
    ]);
}

    

}

?>