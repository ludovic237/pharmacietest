<?php
require_once('database.php');
require_once('../Class/retour_produit.php');
require_once('../Class/produit_retour.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
global $pdo;


$manager = new RetourProduitManager($pdo);
$managerCa = new ProduitRetourManager($pdo);
$managerConcerner = new ConcernerManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);
$managerProduit = new ProduitManager($pdo);

$id = $_POST['id'];
$qte = $_POST['qte'];

$retour = new ProduitRetour(array(
    'retour_produit_id' => $manager->getLastId()->id(),
    'concerner_id' => $id,
    'quantite' => $qte
));
$managerCa->add($retour);

$concerner= $managerConcerner->get($id);
$concerner->setquantite($concerner->quantite()-$qte);
echo "- concerne qte : ".$concerner->quantite();
$managerConcerner->update($concerner);

$en_rayon= $managerEnRayon->get($concerner->en_rayon_id());
$en_rayon->setquantite($en_rayon->quantite()+$qte);
echo "- rayon qte : ".$en_rayon->quantite();
$en_rayon->setquantiteRestante($en_rayon->quantiteRestante()+$qte);
echo "- rayon qte res: ".$en_rayon->quantiteRestante();
$managerEnRayon->update($en_rayon);


$produitr= $managerProduit->get($en_rayon->produit_id());
$produitr->setstock($produitr->stock()+$qte);
echo "- produit stock : ".$produitr->stock();
$managerProduit->update($produitr);

echo "pass";

?>