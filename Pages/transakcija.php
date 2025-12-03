
<?php
require_once "../header.php";
require_once "../Models/Kategorija.php";
require_once "../Models/Produkt.php";
require_once "../Models/Redirect.php";
require_once "../DB/DB.php";


$db=DB::getInstance()->connpdo;
$kategorije=Kategorija::allCategories();
?>

<div id="content">
    <h2>Dodavanje kategorije i proizvoda (transakcija)</h2>

    <form method="POST" action="">
       <label>Kategorija odabir:</label>
<select name="kategorijaid" id="kategorijaid" onchange="change(this.value)">
    <option value="">--Odaberi--</option>

    <?php foreach ($kategorije as $k): ?>
        <option value="<?= $k['id'] ?>">
            <?= $k['id'] ?> - <?= $k['naziv'] ?>
        </option>
    <?php endforeach; ?>

    <option value="new">Nova kategorija</option>
</select>

<div id="nova_kategorija_wrap" style="display:none; margin-top: 10px;">
    <label>Naziv kategorije</label>
    <input type="text" name="kategorija">
</div>

<label>Naziv proizvoda</label>
<input type="text" name="naziv">

<label>Količina</label>
<input type="number" name="kolicina">

<label>Cijena</label>
<input type="number" step="0.01" name="cijena">

<button type="submit">Spremi transakciju</button>
    </form>
    <?php
if ($_POST) {
    $nazivKat = $_POST["kategorija"] ?? null;
    $nazivPro = $_POST["naziv"] ?? null;
    $kolicina = $_POST["kolicina"] ?? null;
    $cijena   = $_POST["cijena"] ?? null;

    try {
    $db->beginTransaction();

    if ($kategorijaid === "new") {
        // Unos nove kategorije
        $nazivkat = $_POST["kategorija"] ?? null;

        if (!$nazivkat) {
            throw new Exception("Naziv kategorije nije unesen.");
        }

        $newCatId = Kategorija::insertForTransaction($nazivkat, $db);

    } else {
        // Postojeća kategorija
        $newCatId = (int)$kategorijaid;
    }

        $db->commit();
        $_SESSION["poruka"]="Transakcija uspjesno prosla";
        header("Location: proizvodi.php");

    } catch (Exception $e) {
        $db->rollBack();
        Redirect::redirectToErrorPage($e->getMessage());
        exit;
    }
}

?>
</div>

<?php
require_once "../footer.php";
?>

<script>
function change(izbor){
    let wrap = document.getElementById("nova_kategorija_wrap");

    if(izbor==="new"){
        wrap.style.display="block";
    }
    else{
        wrap.style.display="none";
    }
}
    </script>