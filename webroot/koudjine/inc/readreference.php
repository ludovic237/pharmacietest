<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/vente.php');
require_once('../Class/en_rayon.php');
require_once('../Class/concerner.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');

global $pdo;
global $conndb;

$vente;
$concerner;
$enrayon;
$caisse;
$venteTotalRange = 0;
$quantiteTotalRange = 0;
$quantiteTotalEnRayon = 0;
$quantiteTotalSameRayonId = 0;
$nom;

$managerProduit = new ProduitManager($pdo);
$managerVente = new VenteManager($pdo);
$managerCaisse = new CaisseManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerConcerner = new ConcernerManager($pdo);


if (!empty($_POST["keyword"])) {
    $keyword = $_POST["keyword"];
    $employe = $managerEmploye->getListKeyword($keyword);
    if (!empty($employe)) {
?>
        <ul class="list-tags" style="width: 100%;list-style: none;padding: 0px;margin: 0px;display: flex;flex-direction: column;height: 100px;overflow: auto;" id="country-list">
            <?php
            foreach ($employe as $k => $s) {
            ?>
                <li>
                    <a style="cursor: pointer;width: 100%;" onClick="selectreferenceproduit('<?php echo $s->identifiant(); ?>','<?php echo $s->id(); ?>');"><?php echo $s->identifiant(); ?></a>
                </li>
            <?php } ?>
        </ul>
<?php }
} ?>


<!-- <li class="xn">
    <a onClick="selectemploye('<?php echo $s->identifiant(); ?>');"><?php echo $s->identifiant(); ?></a>
</li> -->

<!-- <li>
    <a onClick="selectemploye('<?php echo $s->identifiant(); ?>');"><?php echo $s->identifiant(); ?></a>
</li> -->