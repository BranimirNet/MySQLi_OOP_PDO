<?php
require_once "../header.php";
require_once "../Models/Produkt.php";

$proizvodi = Produkt::allProducts();
?>
<div id="content">
    <h2>Proizvodi</h2>
    <p class="uspjeh">
        <?php
        if(isset($_SESSION["poruka"])){
            echo $_SESSION["poruka"];
            unset($_SESSION["poruka"]);
        }
        ?>
    </p>
    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Količina</th>
            <th>Cijena</th>
            <th>Kategorija</th>
            <th>Akcije</th>
        </tr>
        <?php foreach($proizvodi as $p): $id=$p["id"]; ?>
        <tr>
            <td><?= $p["id"]; ?></td>
            <td><?= $p["naziv"]; ?></td>
            <td><?= $p["kolicina"]; ?></td>
            <td><?= $p["cijena"]; ?></td>
            <td><?= $p["kategorija"]; ?></td>
            <td>
                <a href="adminproizvod.php?id=<?= $id ?>" class="action-btn">Uredi</a>
                <a href="DeleteProizvod.php?id=<?= $id ?>" class="action-btn delete" onclick="return confirm('Da li želite sigurno obrisati proizvod <?= $p['naziv'] ?> ?');">Briši</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="adminproizvod.php" class="nova">Dodaj novi proizvod</a></p>
</div>
<?php
require_once "../footer.php";
?>