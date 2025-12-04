<?php
require_once __DIR__.'..\..\DB\MSSQL.php';
class Tecaj{

    public static function Tecajevi(): array{
        $db = MSSQL::getInstance()->connsql;
        $sql = "SELECT * FROM dbo.Tecaj";
        $result = $db->query($sql);

        return $result->fetchAll();
    }
}

?>