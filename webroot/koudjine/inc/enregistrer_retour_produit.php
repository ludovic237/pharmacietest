<?php
require_once('database.php');
require_once('../Class/retour_produit.php');
require_once('../Class/produit_retour.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/vente.php');
global $pdo;


$manager = new RetourProduitManager($pdo);
$managerCa = new ProduitRetourManager($pdo);
$managerConcerner = new ConcernerManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);
$managerProduit = new ProduitManager($pdo);
$managerVente = new VenteManager($pdo);

$id = $_POST['id'];
$qte = $_POST['qte'];

$retour = new ProduitRetour(array(
    'retour_produit_id' => $manager->getLastId()->id(),
    'concerner_id' => $id,
    'quantite' => $qte
));
$managerCa->add($retour);

$qteTotalVente=0;
$reductionParProduit=0;

$concerner= $managerConcerner->get($id);
$vente = $managerVente->get($concerner->vente_id());
$en_rayon= $managerEnRayon->get($concerner->en_rayon_id());
$produitr= $managerProduit->get($en_rayon->produit_id());

//$qteTotalVente=$concerner->quantite()+$qte;
$reductionParProduit=$concerner->reduction()/$concerner->quantite();

//$concerner->setquantite_retourner($qte);
//echo "- concerne qte : ".$concerner->quantite();
//$managerConcerner->update($concerner);


//$vente->setprixTotal($vente->prixTotal()-(($en_rayon->prixVente()-$reductionParProduit)*$qte));
//$managerVente->update($vente);

//$en_rayon->setquantite($en_rayon->quantite()+$qte);
//echo "- rayon qte : ".$en_rayon->quantite();
$en_rayon->setquantiteRestante($en_rayon->quantiteRestante()+$qte);
echo "- rayon qte res: ".$en_rayon->quantiteRestante();
$managerEnRayon->update($en_rayon);


$produitr->setstock($produitr->stock()+$qte);
echo "- produit stock : ".$produitr->stock();
$managerProduit->update($produitr);

echo "pass";

?>