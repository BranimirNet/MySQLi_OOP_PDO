<?php
session_start();
require_once "../Models/Produkt.php";

if(!isset($_GET['id'])){
    die("Nedostaje ID proizvoda!");
}

Produkt::delete($_GET['id']);

header("Location: proizvodi.php");

?>