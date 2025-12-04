<?php
require_once "../header.php";
require_once "../Models/Tecaj.php";

$tecajevi = Tecaj::Tecajevi();
?>
<div id="content">
    <h2>Tečajevi (MSSQL)</h2>
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
            <th>Broj polaznika</th>
        </tr>
        <?php foreach($tecajevi as $t): ?>
        <tr>
            <td><?= $t["TecajId"]; ?></td>
            <td><?= $t["Naziv"]; ?></td>
            <td><?= $t["BrojPolaznika"]; ?></td>

        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php
require_once "../footer.php";
?>