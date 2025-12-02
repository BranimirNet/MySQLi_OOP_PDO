<?php
require_once "header.php";
require_once "Models/Kategorija.php";

$kategorije = Kategorija::allCategories();
?>
<div id="content">
    <h2>Kategorije</h2>

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Akcije</th>
        </tr>
        <?php foreach($kategorije as $k): $id=$k["id"]; ?>
        <tr>
            <td><?= $k["id"]; ?></td>
            <td><?= $k["naziv"]; ?></td>
            <td>
                <a href="nova_kategorija.php?id=<?= $id ?>" class="action-btn">Uredi</a>
                <a href="#" class="action-btn delete">Briši</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="nova_kategorija.php">Dodaj novu kategoriju</a></p>
</div>
<?php
require_once "footer.php";
?>