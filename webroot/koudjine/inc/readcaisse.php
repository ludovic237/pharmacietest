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


if (!empty($_POST["keywordcaisse"])) {
    $keywordcaisse = $_POST["keywordcaisse"];
    $caisse = $managerCaisse->getListKeywordCaisse($keywordcaisse);
    if (!empty($caisse)) {
?>
        <ul class="list-tags" id="country-list">
            <?php
            foreach ($caisse as $k => $s) {
            ?>
                <li>
                    <a onClick="selectcaisse('<?php echo $s->identifiant(); ?>');"><?php echo $s->identifiant(); ?></a>
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