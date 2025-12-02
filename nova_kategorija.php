<?php
require "header.php";
require_once "Models/Kategorija.php";
?>

<div id="content">

<h2>Nova kategorija</h2>

<?php

if(isset($_GET["id"])){
    $idkat=$_GET["id"];
    $kategorija = Kategorija::getById($idkat);
}
else
{
    $kategorija=null;
}

?>

<form action="" method="POST">
    <label>Naziv:</label>
    <input type="text" name="naziv" value="<?= $kategorija["naziv"] ?>">
    <button type="submit">Spremi</button>
</form>

<?php
if($_POST){
    Kategorija::insert($_POST["naziv"]);
    echo "<p style='color:green;'>Proizvod spremljen</p>";
    header("refresh: 1; url=kategorije.php");
}
?>
</div>

<?php require "footer.php"; ?>